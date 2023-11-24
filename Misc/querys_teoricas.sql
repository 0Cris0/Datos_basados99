-- =================================
-- checkear la existencia de usuarios
    
$n_usuario -- nombre del usuario a consultar

CREATE OR REPLACE FUNCTION repeticion_usuario (n_usuario varchar) RETURNS boolean AS $$ 
BEGIN 
    RETURN EXISTS ( 
        SELECT 1 
        FROM usuarios 
        WHERE n_usuario == usuarios.nombre 
    ) 
END 
$$ language plpgsql 

repeticion_usuario($n_usuario)
-- =================================
-- checkeo de que usuario tenga las credenciales correctas
$n_usuario -- nombre del usuario a consultar 

$contrasena -- contrasena ingresada 
CREATE OR REPLACE FUNCTION credenciales_usuario (n_usuario varchar, contrasena varchar) RETURNS boolean AS $$ 
BEGIN
    RETURN EXISTS (
        SELECT 1
        FROM usuarios 
        WHERE n_usuario == usuarios.nombre 
        AND contrasena = usuarios.contrasena
    )
END 
$$ language plpgsql 

credenciales_usuario($n_usuario, $contrasena)
-- =================================
-- agregación de un nuevo usuario

$nombre 
$mail 
$contrasena 
$username
$fecha_nacimiento

CREATE OR REPLACE Function agregar_usuario (nombre varchar, mail varchar, contrasena varchar, username varchar, fecha_nacimiento date) RETURNS void AS $$
BEGIN
    INSERT INTO usuarios VALUES (nombre, mail, contrasena, username, fecha_nacimiento)
END
$$ language plpgsql 

agregar_usuario($nombre, $mail, $contrasena, $username, $fecha_nacimiento)

-- =================================
-- obtener información personal del usuario

-- [OJO: Ver que se cumplan las condiciones de JOIN, sino definirlas
--  de manera explícita]
$n_usuario -- nombre del usuario a consultar 

CREATE MATERIALIZED VIEW info_perfil AS
    -- Parte 1: Info del usuario
    SELECT u.id, u.nombre, u.mail, u.username
    FROM usuarios as u
    WHERE $n_usuario == u.nombre 

    -- Parte 2: Listado de las subscripciones a juegos
    SELECT sj.id, vs.titulo
    FROM subscripciones_juego as sj, videojuegos_sub as vs
    WHERE $id_usuario == sj.id_usuario 
    AND vs.id_juego == sj.id_juego

    -- Parte 3: Listado de subscripciones streaming
    SELECT sp.id_sub, pp.nombre
    FROM subscripciones_ps as sp, proveedores_ps as pp
    WHERE $id_usuario == sp.id_usuario 
    AND sp.id_prov == pp.id_prov

    --Parte 4: Tiempo visto en streaming
    SELECT SUM(streaming.duracion)
    FROM (
        -- Parte 4.1: Tiempo visto en peliculas
        SELECT SUM(p.duracion) as duracion
        FROM visualizaciones_p as vp, peliculas as p 
        WHERE $id_usuario == vp.id_usuario 
        AND p.id_pelicula == vp.id_pelicula
        
        UNION
        -- Parte 4.2: Tiempo visto en series
        SELECT SUM(c.duracion) as duracion
        FROM visualizaciones_c as vc, capitulo as c  
        WHERE $id_usuario == vc.id_usuario
        AND c.id_capitulo == vc.id_capitulo
    ) AS streaming

    -- Parte 5: Tiempo visto en juegos
    SELECT SUM(vu.duracion) as duracion
    FROM videojuegos_usuario as vu
    WHERE $id_usuario == vu.id_usuario 

    -- Parte 6: Edad
    SELECT DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), u.fecha_nacimiento)), '%Y')
    FROM usuarios as u 
    WHERE $id_usuario == u.id 

























-- =================================
-- obtener proveedores de streaming
SELECT * 
FROM  proveedores_ps 

-- =================================
-- detalle del proveedor (valor sub, cantidad pelis y series)
$id_proveedor 

CREATE OR REPLACE FUNCTION detalle_proveedor(id_proveedor integer)
RETURNS TABLE(monto integer, cantidad_pelis integer, cantidad_series integer) AS $$
BEGIN 
    -- Parte 1: Obtención del monto del valor de subscripción

        -- DUDA: EL costo es el del propio proveedores peli???

    -- Parte 2: Cantidad de pelis
    -- Parte 3: Cantidad de series
    RETURN QUERY EXECUTE'
        SELECT m.monto, p.cantidad_pelis, s.cantidad_series
        FROM 
            (
                SELECT pp.costo as monto
                FROM  proveedores_ps as pp
                WHERE pp.id_prov == id_proveedor) as m,
            (
                SELECT COUNT(p.titulo) as cantidad_pelis
                FROM catalogo_p_incluida as cpi
                WHERE cpi.id_prov == id_proveedor) as p,
            (
                SELECT COUNT(s.serie) as cantidad_series
                FROM catalogo_s as cs
                WHERE cs.id_prove == id_proveedor) as s
        ';
    RETURN;
END
$$ language plpgsql

detalle_proveedor($id_proveedor)

-- =================================
-- top 3 series del proveedor

-- [OJO: Tengo la sensación de que aquí será necesario agregar el ON para
--  dar más detalles de cómo es el join]
SELECT TOP 3 *
FROM (
    SELECT s.serie, s.puntuacion, vs.n_visualizaciones
    FROM series as s, (
        SELECT c.id_serie, COUNT(*) as n_visualizaciones
        FROM visualizacion_c as vc, catalogo_s as cs, capitulo as c
        WHERE cs.id_prove == $id_proveedor
        AND c.id_capitulo == vc.id_capitulo
        GROUP BY c.id_serie
        ) as vs
    WHERE s.id_serie == vs.id_serie
    ORDER BY vs.n_visualizaciones) as datos

-- =================================
-- top 3 peliculas del proveedor

-- [OJO: Tengo la sensación de que aquí será necesario agregar el ON para
--  dar más detalles de cómo es el join]
SELECT TOP 3 *
FROM (
    SELECT p.titulo, p.puntuacion, vp.n_visualizaciones
    FROM peliculas as p, (
        SELECT  (cpi.id_pelicula, COUNT(*) as n_visualizaciones)
        FROM visualizacion_p as vp, catalogo_p_incluida as cpi
        WHERE cpi.id_prove == $id_proveedor
        AND vp.id_pelicula == cpi.id_pelicula
        ) as vp
    WHERE p.id_pelicula == vp.id_pelicula
    ORDER BY vp.n_visualizaciones) as datos

-- =================================
-- buscador de contenido (serie o película) en proveedor

$n_proveedor 

$n_contenido 

-- Caso serie 
SELECT EXISTS( 
	SELECT 1 
    FROM catalogo_s as cs, serie as s, proveedores_ps as pp 
    WHERE pp.nombre == $n_proveedor 
    AND cs.id_serie == s.id_serie
    AND cs.id_prov == pp.id_prov
    AND s.serie == $n_contenido 
) 

-- Caso película 

SELECT EXISTS( 
	SELECT 1 
    FROM catalogo_p_incluida as cpi, pelicula as p, proveedores_ps as pp 
    WHERE pp.nombre == $n_proveedor 
    AND cpi.id_pelicula == p.id_pelicula
    AND cpi.id_prov == pp.id_prov
    AND p.titulo == $n_contenido 
) 

-- Hacerlo case insensitive
-- Aplicar matching parcial













-- LISTO HACIA ARRIBA (hace sentido) ------------------------------------------------------------------------------------------------------------




-- Compras
-- =================================
-- listado de peliculas y juegos de PU

-- Caso juego
	SELECT vp.titulo -- Ver si entregar más datos o no
    FROM videojuegos_pun as vp

-- Caso película 

	SELECT p.titulo -- Ver si entregar más datos o no
    FROM arriendos_proveedor_peli as app, peliculas as p
    WHERE app.id_peli == p.id_peli


-- =================================
-- detalle de un juego seleccionado

$id_juego

    SELECT * -- Aquí no saco nada con pedir info específica ya que necesito todo
    FROM proveedores_juego as pj, catalogo_j as cj, videojuegos_pun as vp
    WHERE pj.id_prov == cj.id_prov
    AND cj.id_juego == $id_juego
    AND cj.id_juego == vp.id_juego


-- detalle de un pelicula seleccionada

$id_peli

    SELECT * -- Aquí no saco nada con pedir info específica ya que necesito todo
    FROM proveedores_ps as pp, catalogo_p_arriengo as cpa, peliculas as p
    WHERE p.id_peli == cpa.id_peli
    AND pp.id_prov == cpa.id_prov
    AND cpa.id_peli == $id_peli


        -- Con ambos debería trabajar el cómo se muestra


-- LISTO HACIA ARRIBA (hace sentido) ------------------------------------------------------------------------------------------------------------


-- =================================
-- compra videojuego
$id_usuario
$id_juego
$id_prov
$precio
$precio_preorden -- ???? Irá????

    -- Ver que la subscripción esté activa
        -- Cómo hacer esto?? --> Qué tablas ocupar
    
    -- 1] Compruebo que la subs esté vigente
    SELECT 
    --FROM subscripciones_juego as sj
    --WHERE sj.fecha_termino >= CONVERT(DATE,GETDATE())
    --AND 


    -- 2] Compruebo que ya no lo tenga el usuario
    SELECT EXISTS(
        SELECT 1
        FROM videojuegos_usuario as vu
        WHERE vu.id_juego == $id_juego
    )



-- =================================
-- compra pelicula 
$id_usuario
$id_peli
$id_prov
$precio
$disponibilidad -- Para qué sirve????????

    -- 1] Compruebo que la subs esté vigente
    SELECT EXISTS(
        SELECT 1
        FROM subscripciones_pelis_terminadas as spt
        WHERE spt.fecha_termino >= CONVERT(DATE,GETDATE())
    )

    -- 2] Compruebo que ya no lo tenga el usuario

        -- COMO PUEDO SABER ESO?????????????'''

    -- 3] Generar compra
