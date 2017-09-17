# Verificador de Actas de Nacimiento (Perú)

## Version 1.0

Verifica la fecha de nacimiento de una persona en un rango de años

Datos Ingresados: Apellido Paterno, Apellido Materno, Nombre , Mes y Dia.

*Ingresar todo en minusculas

$anioi = Primer año del rango

$aniof = Ultimo año del rango

$galletita = Es la cookie necesaria para hacer las consultas. Por ahora debes colocarla manualmente haciendo una consulta de prueba en https://www.reniec.gob.pe/concer/concer.do , puedes usar Http Live Headers o HttpFox.

* Con el tiempo se mejorará el programa para así solo se necesite de ingresar el nombre completo.

## Version 1.1

El Script ya cuenta con parte grafica para mayor comodidad de ingreso de valores requeridos.

## Version 1.2 (Actualización)

El Script ya cuenta con un mensaje cuando no se encuentra resultados.

El Script ya cuenta con la automatización en las cookies. En las versiones pasada se debia ingresar la cookie manualmente, ahora ya usa una funcion para obtener la cookie automaticamente (función cookie) y otra funcion para saltar el seleccionado de acta de nacimiento (función ini)

*Obs Por ahora se deja los input con los valores por defecto de Humala Tasso Ollanta , puesto que si el parametro value cambiara al ingresado, el script seria vulnerable a XSS, pontro se parchará ese error.
