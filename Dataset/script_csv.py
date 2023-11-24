# -*- coding: utf-8 -*-
"""BasesE3.ipynb

Automatically generated by Colaboratory.

Original file is located at
    https://colab.research.google.com/drive/1vA16L7OeA7ECRD_v_8Pt7YiEPzAQfp_G
"""

import pandas as pd
import numpy as np
import os

"""##Create DB Impares
"""


path_impares = os.path.join(*['Datos sin tratar', 'impares.xlsx'])
impares = pd.ExcelFile('impares.xlsx')

generos_i = pd.read_excel(impares, 'genero')

multimedia_i = pd.read_excel(impares, 'multimedia')

pago_i = pd.read_excel(impares, 'pago')

proveedores_i = pd.read_excel(impares, 'proveedores')
proveedores_i.rename(columns = {'id':'pro_id'}, inplace = True)

suscripciones_i = pd.read_excel(impares, 'suscripciones')
suscripciones_i.rename(columns = {'id':'subs_id'}, inplace = True)

usuarios_i = pd.read_excel(impares, 'usuarios')
usuarios_i.rename(columns = {'id':'uid'}, inplace = True)

visualizacion_i = pd.read_excel(impares, 'visualizaciones')

"""##Edit DB Impares"""

pelicula = multimedia_i[["pid", "titulo", "duracion", "clasificacion", "puntuacion", "a√±o"]]
pelicula = pelicula[pelicula['pid'].notna()]
pelicula.sort_values(by=['pid'], ascending = True, inplace=True)
pelicula = pelicula[~pelicula.duplicated()]
pelicula.rename(columns = {'pid':'id_pelicula'}, inplace = True)
pelicula.reset_index(drop=True, inplace=True)
pelicula.set_index('id_pelicula', inplace=True)
pelicula.rename(columns = {'a√±o':'anho'}, inplace = True)


serie = multimedia_i[["sid", "serie", "clasificacion", "puntuacion", "a√±o"]]
serie = serie[serie['sid'].notna()]
serie.sort_values(by=['sid'], ascending = True, inplace=True)
serie = serie[~serie.duplicated()]
serie.rename(columns = {'sid':'id_serie'}, inplace = True)
serie.reset_index(drop=True, inplace=True)
serie.set_index('id_serie', inplace=True)
serie.rename(columns = {'a√±o':'anho'}, inplace = True)


genero_peli = multimedia_i[["pid", "genero"]]
genero_peli = genero_peli[genero_peli['pid'].notna()]
genero_peli.sort_values(by=['pid'], ascending = True, inplace=True)
genero_peli = genero_peli[~genero_peli.duplicated()]
genero_peli.rename(columns = {'pid' : 'id_pelicula'}, inplace = True)
genero_peli.reset_index(drop=True, inplace=True)
genero_peli.set_index('id_pelicula', inplace=True)



genero_serie = multimedia_i[["sid", "genero"]]
genero_serie = genero_serie[genero_serie['sid'].notna()]
genero_serie.sort_values(by=['sid'], ascending = True, inplace=True)
genero_serie = genero_serie[~genero_serie.duplicated()]
genero_serie.rename(columns = {'sid': 'id_serie'}, inplace = True)
genero_serie.reset_index(drop=True, inplace=True)
genero_serie.set_index('id_serie', inplace=True)


capitulo = multimedia_i[["cid", "sid", "titulo", "duracion", "numero"]]
capitulo = capitulo[capitulo['cid'].notna()]
capitulo.sort_values(by=['sid', 'cid'], ascending = [True, True], inplace=True)
capitulo = capitulo[~capitulo.duplicated()]
capitulo.rename(columns = {'cid':'id_capitulo'}, inplace = True)
capitulo.reset_index(drop=True, inplace=True)
capitulo.set_index('id_capitulo', inplace=True)
capitulo.rename(columns = {'sid':'id_serie'}, inplace = True)



proveedor_ps = proveedores_i[["pro_id", "nombre", "costo"]]
proveedor_ps = proveedor_ps[~proveedor_ps.duplicated()]
proveedor_ps.sort_values(by=['pro_id'], ascending = True, inplace=True)
proveedor_ps.rename(columns = {'pro_id':'id_prov'}, inplace = True)
proveedor_ps.reset_index(drop=True, inplace=True)
proveedor_ps.set_index('id_prov', inplace=True)


catalogo_s = proveedores_i[["pro_id", "sid"]]
catalogo_s = catalogo_s[catalogo_s['sid'].notna()]
catalogo_s = catalogo_s[~catalogo_s.duplicated()]
catalogo_s.sort_values(by=['sid'], ascending = True, inplace=True)
catalogo_s.rename(columns = {'pro_id':'id_prov'}, inplace = True)
catalogo_s.reset_index(drop=True, inplace=True)
catalogo_s.set_index('id_prov', inplace=True)
catalogo_s.rename(columns = {'sid':'id_serie'}, inplace = True)


catalogo_p = proveedores_i[["pro_id", "pid", "precio"]]
catalogo_p = catalogo_p[~catalogo_p['precio'].notna()]
catalogo_p_incluida = catalogo_p[["pro_id", "pid"]]
catalogo_p_incluida = catalogo_p_incluida[catalogo_p_incluida['pid'].notna()]
catalogo_p_incluida.sort_values(by=['pid'], ascending = True, inplace=True)
catalogo_p_incluida.rename(columns = {'pro_id':'id_prov'}, inplace = True)
catalogo_p_incluida.reset_index(drop=True, inplace=True)
catalogo_p_incluida.set_index('id_prov', inplace=True)
catalogo_p_incluida.rename(columns = {'pid':'id_pelicula'}, inplace = True)

catalogo_p_arriendo = proveedores_i[["pro_id", "pid", "precio", "disponibilidad"]]
catalogo_p_arriendo = catalogo_p_arriendo[catalogo_p_arriendo['precio'].notna()]
catalogo_p_arriendo.sort_values(by=['pid'], ascending = True, inplace=True)
catalogo_p_arriendo.rename(columns = {'pro_id':'id_prov'}, inplace = True)
catalogo_p_arriendo.reset_index(drop=True, inplace=True)
catalogo_p_arriendo.set_index('id_prov', inplace=True)
catalogo_p_arriendo.rename(columns = {'pid':'id_pelicula'}, inplace = True)


visualizacion_p = visualizacion_i[["uid", "pid", "fecha"]]
visualizacion_p = visualizacion_p[visualizacion_p['pid'].notna()]
visualizacion_p.sort_values(by=['uid'], ascending = True, inplace=True)
visualizacion_p.rename(columns = {'uid':'id_usuario'}, inplace = True)
visualizacion_p.reset_index(drop=True, inplace=True)
visualizacion_p.set_index('id_usuario', inplace=True)
visualizacion_p.rename(columns = {'pid':'id_pelicula'}, inplace = True)


visualizacion_c = visualizacion_i[["uid", "cid", "fecha"]]
visualizacion_c = visualizacion_c[visualizacion_c['cid'].notna()]
visualizacion_c.sort_values(by=['uid'], ascending = True, inplace=True)
visualizacion_c.rename(columns = {'uid':'id_usuario'}, inplace = True)
visualizacion_c.reset_index(drop=True, inplace=True)
visualizacion_c.set_index('id_usuario', inplace=True)
visualizacion_c.rename(columns = {'cid':'id_capitulo'}, inplace = True)


subscripcion_ps = suscripciones_i[["subs_id", "uid", "pro_id", "estado", "fecha_inicio"]]
subscripcion_ps.sort_values(by=['subs_id'], ascending = True, inplace=True)
subscripcion_ps.rename(columns = {'subs_id':'id_sub'}, inplace = True)
subscripcion_ps.reset_index(drop=True, inplace=True)
subscripcion_ps.set_index('id_sub', inplace=True)
subscripcion_ps.rename(columns = {'uid':'id_usuario'}, inplace = True)
subscripcion_ps.rename(columns = {'pro_id':'id_prov'}, inplace = True)


subscripcion_ps_terminada = suscripciones_i[["subs_id", "fecha_termino"]]
subscripcion_ps_terminada = subscripcion_ps_terminada[subscripcion_ps_terminada['fecha_termino'].notna()]
subscripcion_ps_terminada.sort_values(by=['subs_id'], ascending = True, inplace=True)
subscripcion_ps_terminada.rename(columns = {'subs_id':'id_sub'}, inplace = True)
subscripcion_ps_terminada.reset_index(drop=True, inplace=True)
subscripcion_ps_terminada.set_index('id_sub', inplace=True)


"""##Create DB Pares"""

pares = pd.ExcelFile('paresv2.xlsx')


generos_p = pd.read_excel(pares, 'genero')


suscripciones_p = pd.read_excel(pares, 'subscripciones')
suscripciones_p.rename(columns = {'id':'subs_id'}, inplace = True)


pagos_p = pd.read_excel(pares, 'pagos')


proveedores_p = pd.read_excel(pares, 'proveedores')
proveedores_p.rename(columns = {'id':'id_proveedor'}, inplace = True)


usuario_proveedor_p = pd.read_excel(pares, 'usuario proveedor')


usuario_actividades_p = pd.read_excel(pares, 'usuario actividades')


genero_v_p = pd.read_excel(pares, 'videojuego genero')


videojuego_p = pd.read_excel(pares, 'videojuego')


"""##Edit DB pares"""

videojuego = videojuego_p[["id_videojuego"]]
videojuego.sort_values(by=['id_videojuego'], ascending = True, inplace=True)
videojuego = videojuego[~videojuego.duplicated()]
videojuego.rename(columns = {'id_videojuego':'id_juego'}, inplace = True)
videojuego.reset_index(drop=True, inplace=True)
videojuego.set_index('id_juego', inplace=True)


videojuego_sub = videojuego_p[['id_videojuego', 'titulo', 'puntuacion', 'clasificacion', 'fecha_de_lanzamiento', 'mensualidad']]
videojuego_sub.sort_values(by=['id_videojuego'], ascending = True, inplace=True)
videojuego_sub = videojuego_sub[videojuego_sub['mensualidad'].notna()]
videojuego_sub = videojuego_sub[~videojuego_sub.duplicated()]
videojuego_sub.rename(columns = {'id_videojuego':'id_juego'}, inplace = True)
videojuego_sub.reset_index(drop=True, inplace=True)
videojuego_sub.set_index('id_juego', inplace=True)
videojuego_sub.rename(columns = {'fecha_de_lanzamiento':'fecha_lanzamiento'}, inplace = True)


videojuego_pun = videojuego_p[['id_videojuego', 'titulo', 'puntuacion', 'clasificacion', 'fecha_de_lanzamiento', 'beneficio_preorden']]
videojuego_pun.sort_values(by=['id_videojuego'], ascending = True, inplace=True)
videojuego_pun = videojuego_pun[videojuego_pun['beneficio_preorden'].notna()]
videojuego_pun = videojuego_pun[~videojuego_pun.duplicated()]
videojuego_pun.rename(columns = {'id_videojuego':'id_juego'}, inplace = True)
videojuego_pun.reset_index(drop=True, inplace=True)
videojuego_pun.set_index('id_juego', inplace=True)
videojuego_pun.rename(columns = {'fecha_de_lanzamiento':'fecha_lanzamiento'}, inplace = True)
videojuego_pun.rename(columns = {'beneficio_preorden':'beneficio'}, inplace = True)


proveedor_juego = proveedores_p[['id_proveedor', 'nombre', 'plataforma']]
proveedor_juego.sort_values(by=['id_proveedor'], ascending = True, inplace=True)
proveedor_juego = proveedor_juego[~proveedor_juego.duplicated()]
proveedor_juego.rename(columns = {'id_proveedor':'id_prov'}, inplace = True)
proveedor_juego.reset_index(drop=True, inplace=True)
proveedor_juego.set_index('id_prov', inplace=True)


usuarios_proveedor_juego = usuario_proveedor_p[['id_usuario', 'id_proveedor']]
usuarios_proveedor_juego.sort_values(by=['id_usuario'], ascending = True, inplace=True)
usuarios_proveedor_juego = usuarios_proveedor_juego[~usuarios_proveedor_juego.duplicated()]
usuarios_proveedor_juego.reset_index(drop=True, inplace=True)
usuarios_proveedor_juego.set_index('id_usuario', inplace=True)
usuarios_proveedor_juego.rename(columns = {'id_proveedor':'id_prov'}, inplace = True)


juegos_proveedor_juego = proveedores_p[['id_proveedor', 'id_videojuego', 'precio', 'precio_preorden']]
juegos_proveedor_juego = juegos_proveedor_juego[~juegos_proveedor_juego.duplicated()]
juegos_proveedor_juego.rename(columns = {'id_proveedor':'id_prov'}, inplace = True)
juegos_proveedor_juego.reset_index(drop=True, inplace=True)
juegos_proveedor_juego.set_index('id_prov', inplace=True)
juegos_proveedor_juego.rename(columns = {'id_videojuego':'id_juego'}, inplace = True)


subscripcion_vj = suscripciones_p[['subs_id', 'estado', 'fecha_inicio', 'id_usuario', 'fecha_termino', 'id_videojuego']]
subscripcion_vj.sort_values(by=['subs_id'], ascending = True, inplace=True)
subscripcion_vj = subscripcion_vj[~subscripcion_vj.duplicated()]
subscripcion_vj.rename(columns = {'subs_id':'id_sub'}, inplace = True)
subscripcion_vj.reset_index(drop=True, inplace=True)
subscripcion_vj.set_index('id_sub', inplace=True)
subscripcion_vj.rename(columns = {'id_videojuego':'id_juego'}, inplace = True)



videojuegos_usuario = usuario_actividades_p[['id_usuario', 'id_videojuego', 'fecha v', 'cantidad']]
videojuegos_usuario.sort_values(by=['id_usuario'], ascending = True, inplace=True)
videojuegos_usuario = videojuegos_usuario[videojuegos_usuario['id_videojuego'].notna()]
videojuegos_usuario = videojuegos_usuario[~videojuegos_usuario.duplicated()]
videojuegos_usuario.reset_index(drop=True, inplace=True)
videojuegos_usuario.set_index('id_usuario', inplace=True)
videojuegos_usuario.rename(columns = {'id_videojuego':'id_juego'}, inplace = True)
videojuegos_usuario.rename(columns = {'cantidad':'horas_juego'}, inplace = True)
videojuegos_usuario.rename(columns = {'fecha v':'fecha_visualizacion'}, inplace = True)


resenas = usuario_actividades_p[['id_usuario', 'id_videojuego', 'veredicto', 'titulo', 'texto']]
resenas = resenas[resenas['veredicto'].notna()]
resenas = resenas[~resenas.duplicated()]
resenas.reset_index(drop=True, inplace=True)
resenas['id_res'] = range(1, len(resenas) + 1)
resenas = resenas[['id_res'] + [col for col in resenas.columns if col != 'id_res']]
resenas.set_index('id_res', inplace=True)
resenas.rename(columns = {'id_videojuego':'id_juego'}, inplace = True)


genero_juego = genero_v_p[['id_videojuego', 'nombre']]
genero_juego.sort_values(by=['id_videojuego'], ascending = True, inplace=True)
genero_juego = genero_juego[~genero_juego.duplicated()]
genero_juego.rename(columns = {'id_videojuego':'id_juego'}, inplace = True)
genero_juego.reset_index(drop=True, inplace=True)
genero_juego.set_index('id_juego', inplace=True)
genero_juego.rename(columns = {'nombre':'genero'}, inplace = True)


"""##Create DB común"""

usuarios_i2 = usuarios_i[['uid', 'nombre', 'mail', 'password', 'username', 'fecha_nacimiento']]
usuarios_i2.sort_values(by=['uid'], ascending = True, inplace=True)
usuarios_i2.rename(columns = {'uid':'id_usuario'}, inplace = True)
usuarios_i2.reset_index(drop=True, inplace=True)
usuarios_i2.set_index('id_usuario', inplace=True)
usuarios_i2.rename(columns = {'password':'contrasena'}, inplace = True)


usuarios_p = usuario_actividades_p[['id_usuario', 'nombre', 'mail', 'password', 'username', 'fecha_nacimiento']]
usuarios_p.sort_values(by=['id_usuario'], ascending = True, inplace=True)
usuarios_p = usuarios_p[~usuarios_p.duplicated()]
usuarios_p.reset_index(drop=True, inplace=True)
usuarios_p.set_index('id_usuario', inplace=True)
usuarios_p = usuarios_p.drop_duplicates(subset='nombre', keep='first')
usuarios_p.rename(columns = {'password':'contrasena'}, inplace = True)


pago_i2 = pago_i[['pago_id', 'monto', 'fecha', 'uid']]
pago_i2.rename(columns = {'uid':'id_usuario'}, inplace = True)
pago_i2.rename(columns = {'pago_id':'id_pago'}, inplace = True)
pago_i2.sort_values(by=['id_pago'], ascending = True, inplace=True)
pago_i2 = pago_i2[~pago_i2.duplicated()]
pago_i2.reset_index(drop=True, inplace=True)
pago_i2.set_index('id_pago', inplace=True)


pago_p2 = pagos_p[['pago_id', 'monto', 'fecha', 'id_usuario']]
pago_p2.rename(columns = {'pago_id':'id_pago'}, inplace = True)
pago_p2.sort_values(by=['id_pago'], ascending = True, inplace=True)
pago_p2 = pago_p2[~pago_p2.duplicated()]
pago_p2.reset_index(drop=True, inplace=True)
pago_p2.set_index('id_pago', inplace=True)


pagos = pd.concat([pago_p2, pago_i2])


pago_nan = pago_i[["pago_id", "subs_id", "pid"]]
pago_nan = pago_nan[~pago_nan['pid'].notna()]
pago_subs_peli = pago_nan[["pago_id", "subs_id"]]
pago_subs_peli.sort_values(by=['pago_id'], ascending = True, inplace=True)
pago_subs_peli.rename(columns = {'pago_id':'id_pago'}, inplace = True)
pago_subs_peli.reset_index(drop=True, inplace=True)
pago_subs_peli.set_index('id_pago', inplace=True)
pago_subs_peli.rename(columns = {'subs_id':'id_sub'}, inplace = True)


pago_a_peli = pago_i[["pago_id", "pid", "pro_id"]]
pago_a_peli = pago_a_peli[pago_a_peli['pid'].notna()]
pago_a_peli.sort_values(by=['pago_id'], ascending = True, inplace=True)
pago_a_peli.rename(columns = {'pago_id':'id_pago'}, inplace = True)
pago_a_peli.reset_index(drop=True, inplace=True)
pago_a_peli.set_index('id_pago', inplace=True)
pago_a_peli.rename(columns = {'pid':'id_pelicula'}, inplace = True)
pago_a_peli.rename(columns = {'pro_id':'id_prov'}, inplace = True)


pago_subs_juego = pagos_p[["pago_id", "subs_id"]]
pago_subs_juego= pago_subs_juego[pago_subs_juego['subs_id'].notna()]
pago_subs_juego.sort_values(by=['pago_id'], ascending = True, inplace=True)
pago_subs_juego.rename(columns = {'pago_id':'id_pago'}, inplace = True)
pago_subs_juego.reset_index(drop=True, inplace=True)
pago_subs_juego.set_index('id_pago', inplace=True)
pago_subs_juego.rename(columns = {'subs_id':'id_sub'}, inplace = True)


pago_pun = pagos_p[['pago_id', 'preorden', 'id_proveedor', 'id_videojuego']]
pago_pun = pago_pun[pago_pun['preorden'].notna()]
pago_pun.sort_values(by=['pago_id'], ascending = True, inplace=True)
pago_pun.rename(columns = {'pago_id':'id_pago'}, inplace = True)
pago_pun.reset_index(drop=True, inplace=True)
pago_pun.set_index('id_pago', inplace=True)
pago_pun.rename(columns = {'id_proveedor':'id_prov'}, inplace = True)
pago_pun.rename(columns = {'id_videojuego':'id_juego'}, inplace = True)



generos_i2 = generos_i[['genero', 'nombre_subgenero']]
generos_i2.rename(columns = {'nombre_subgenero':'subgenero'}, inplace = True)


generos_p2 = generos_p[['genero', 'subgenero']]


genero_subgenero = pd.concat([generos_i2, generos_p2], ignore_index=True)
genero_subgenero = genero_subgenero[~genero_subgenero.duplicated()]



def replace_mistaken_encoding(df):
    # Define mapping for replacements
    replacement_map = {
        '√≠': 'í',
        '√≥': 'ó',
        '√©': 'é',
        '√°': 'á',
        '√∫': 'ú',
        '√±': 'ñ'
    }
    
    # Iterate through columns and apply replacements
    for col in df.columns:
        for wrong_char, correct_char in replacement_map.items():
            df[col] = df[col].astype(str).str.replace(wrong_char, correct_char)
    
    return df

# List of DataFrames to apply replacements
dataframes_list = [
    pelicula, serie, genero_peli, genero_serie, capitulo, proveedor_ps, catalogo_s,
    catalogo_p_incluida, catalogo_p_arriendo, visualizacion_p, visualizacion_c,
    subscripcion_ps, subscripcion_ps_terminada, videojuego, videojuego_pun,
    videojuego_sub, proveedor_juego, usuarios_proveedor_juego, juegos_proveedor_juego,
    subscripcion_vj, videojuegos_usuario, resenas, genero_juego, pagos,
    pago_subs_peli, pago_a_peli, pago_subs_juego, pago_pun, usuarios_i2, genero_subgenero
]

# Apply replacements to all DataFrames
for df in dataframes_list:
    df = replace_mistaken_encoding(df)



##Create CSV


pelicula.to_csv('peliculas.csv', sep=',', encoding='utf-8')
serie.to_csv('series.csv', sep=',', encoding='utf-8')
genero_peli.to_csv('generos_p.csv', sep=',', encoding='utf-8')
genero_serie.to_csv('generos_s.csv', sep=',', encoding='utf-8')
capitulo.to_csv('capitulos.csv', sep=',', encoding='utf-8')
proveedor_ps.to_csv('proveedores_ps.csv', sep=',', encoding='utf-8')
catalogo_s.to_csv('catalogo_s.csv', sep=',', encoding='utf-8')
catalogo_p_incluida.to_csv('catalogo_p_incluida.csv', sep=',', encoding='utf-8')
catalogo_p_arriendo.to_csv('catalogo_p_arriendo.csv', sep=',', encoding='utf-8')
visualizacion_p.to_csv('visualizacion_p.csv', sep=',', encoding='utf-8')
visualizacion_c.to_csv('visualizacion_c.csv', sep=',', encoding='utf-8')
subscripcion_ps.to_csv('subscripcion_ps.csv', sep=',', encoding='utf-8')
subscripcion_ps_terminada.to_csv('subscripciones_ps_terminadas.csv', sep=',', encoding='utf-8')

videojuego.to_csv('videojuegos.csv', sep=',', encoding='utf-8')
videojuego_pun.to_csv('videojuegos_pun.csv', sep=',', encoding='utf-8')
videojuego_sub.to_csv('videojuegos_sub.csv', sep=',', encoding='utf-8')
proveedor_juego.to_csv('proveedores_juego.csv', sep=',', encoding='utf-8')
usuarios_proveedor_juego.to_csv('usuarios_proveedor_juego.csv', sep=',', encoding='utf-8')    # FALTA CREATE TABLE
juegos_proveedor_juego.to_csv('juegos_proveedor_juego.csv', sep=',', encoding='utf-8')        # FALTA CREATE TABLE
subscripcion_vj.to_csv('subscripciones_juego.csv', sep=',', encoding='utf-8')
videojuegos_usuario.to_csv('videojuegos_usuario.csv', sep=',', encoding='utf-8')
resenas.to_csv('resenas.csv', sep=',', encoding='utf-8')
genero_juego.to_csv('generos_juego.csv', sep=',', encoding='utf-8')
pagos.to_csv('pagos.csv', sep=',', encoding='utf-8')
pago_subs_peli.to_csv('pagos_subs.csv', sep=',', encoding='utf-8')
pago_a_peli.to_csv('pagos_p.csv', sep=',', encoding='utf-8')
pago_subs_juego.to_csv('pago_subs_juego.csv', sep=',', encoding='utf-8')                      # FALTA CREATE TABLE
pago_pun.to_csv('pago_pun.csv', sep=',', encoding='utf-8')                                    # FALTA CREATE TABLE

usuarios_i2.to_csv('usuarios.csv', sep=',', encoding='utf-8')
genero_subgenero.to_csv('genero_subgenero.csv', sep=',', encoding='utf-8')