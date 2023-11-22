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
CREATE OR REPLACE FUNCTION credenciales_usuario (n_usuario varchar, contrasena) RETURNS boolean AS $$ 
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

-- [AGREGAR LOS PARAMETROS DEL USUARIO]
CREATE OR REPLACE Function agregar_usuario (***parametro tipo, …**) RETURNS void AS $$
BEGIN
    INSERT INTO usuarios VALUES (**nombre de los parametros**)
END
$$ language plpgsql 

agregar_usuario()

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
    SELECT * 
    FROM subscripciones_juego as sj 
    WHERE $id_usuario == sj.id_usuario 

    -- Parte 3: Listado de subscripciones streaming
    SELECT * 
    FROM subscripciones_pelis as sp 
    WHERE $id_usuario == sp.id_usuario 

    --Parte 4: Tiempo visto en streaming
    SELECT SUM(streaming.duracion)
    FROM (
        -- Parte 4.1: Tiempo visto en peliculas
        SELECT SUM(p.duracion) as duracion
        FROM visualizaciones_pelis as vp, peliculas as p 
        WHERE $id_usuario == vp.id_usuario 
        
        UNION
        -- Parte 4.2: Tiempo visto en series
        SELECT SUM(c.duracion) as duracion
        FROM visualizaciones_capitulos as vc, capitulo as c  
        WHERE $id_usuario == vc.id_usuario
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
FROM  proveedores_peli 

-- =================================
-- detalle del proveedor (valor sub, cantidad pelis y series)
$id_proveedor 

CREATE OR REPLACE FUNCTION detalle_proveedor(id_proveedor integer)
RETURNS TABLE(monto integer, cantidad_pelis integer, cantidad_series integer) AS $$
BEGIN 
    -- Parte 1: Obtención del monto del valor de subscripción
    -- Parte 2: Cantidad de pelis
    -- Parte 3: Cantidad de series
    RETURN QUERY EXECUTE'
        SELECT m.monto, p.cantidad_pelis, s.cantidad_series
        FROM 
            (
                SELECT UNIQUE(psp.monto) as monto
                FROM  subscripciones_pelis as sp, pagos_sub_peli as psp 
                WHERE sp.id_prove == id_proveedor) as m,
            (
                SELECT COUNT(p.titulo) as cantidad_pelis
                FROM pelis_proveedor_peli as ppp, peliculas as p 
                WHERE ppp.id_prove == id_proveedor) as p,
            (
                SELECT COUNT(s.serie) as cantidad_series
                FROM series_proveedor_peli as ssp, series as s 
                WHERE ssp.id_prove == id_proveedor) as s
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
        FROM visualizaciones_capitulos as vc, series_proveedor_peli as ssp, capitulo as c
        WHERE ssp.id_prove == $id_proveedor
        GROUP BY c.id_serie
        ) as vs
    WHERE s.id == vs.id_serie
    ORDER BY vs.n_visualizaciones) as datos

-- =================================
-- top 3 peliculas del proveedor

-- [OJO: Tengo la sensación de que aquí será necesario agregar el ON para
--  dar más detalles de cómo es el join]
SELECT TOP 3 *
FROM (
    SELECT p.titulo, p.puntuacion, vp.n_visualizaciones
    FROM peliculas as p, (
        SELECT  (c.id_peli, COUNT(*) as n_visualizaciones)
        FROM visualizaciones_peli as vp, pelis_proveedor_peli as ppp
        WHERE ppp.id_prove == $id_proveedor
        ) as vp
    WHERE p.id_peli == vp.id_peli
    ORDER BY vp.n_visualizaciones) as datos

-- =================================
-- buscador de contenido (serie o película) en proveedor

$n_proveedor 

$n_contenido 

-- Caso serie 
SELECT EXISTS( 
	SELECT 1 
    FROM series_proveedor_peli as spp, serie as s, proveedores_peli as pp 
    WHERE pp.nombre == $n_proveedor 
    AND s.serie == $n_contenido 
    AND spp.id_prov == pp.id 
    AND s.id_serie == spp.id_serie 
) 

-- Caso película 

SELECT EXISTS( 
	SELECT 1 
    FROM pelis_proveedor_peli as ppp, pelicula as p, proveedores_peli as pp 
    WHERE pp.nombre == $n_proveedor 
    AND p.titulo == $n_contenido 
    AND ppp.id_prov == pp.id 
    AND p.id_peli == ppp.id_peli 
) 

-- Hacerlo case insensitive
-- Aplicar matching parcial