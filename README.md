<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About

- Registros clínicos

| Método  | Ruta                            | Controlador y Método       | Descripción                 |
|---------|---------------------------------|----------------------------|-----------------------------|
| GET     | /v1/medical-records             | MedicalRecordService@show  | Listar todos los registros  |
| GET     | /v1/medical-records/{id}        | MedicalRecordService@index | Mostrar un registro específico |
| POST    | /v1/medical-records             | MedicalRecordService@store | Crear un nuevo registro     |
| PUT     | /v1/medical-records             | MedicalRecordService@update| Actualizar su registro      |
| DELETE  | /v1/medical-records/{id}        | MedicalRecordService@destroy| Eliminar un registro específico |

- Estructura de métodos de escritura

#### Crear un nuevo registro (POST)

Este endpoint te permite crear un nuevo registro clínico.

##### URL
- **Método:** POST
- **URI:** `/v1/medical-records`

##### Encabezados
- **Accept:** application/json
- **Authorization:** Bearer 2|iCQHkzTEnzDlLb1BKYHBXZ1zqGCfxIorAy7qkWbZ
  - Nota: Agregar la palabra "Bearer" seguida de un espacio y luego el token.

##### Cuerpo (JSON)
```json
{
    "lugar_nacimiento": "North Gillianville",
    "sexo": "F",
    "edad": 24,
    "tipo_sangre": "AB-",
    "peso": 77.76,
    "estatura": 177,
    "alergias": "Pruebas"
}
```

#### Actualizar su registro (PUT)

Este endpoint te permite actualizar tu registro médico existente. El sistema identifica automáticamente tu expediente clínico, por lo que no es necesario incluir un identificador (ID).

##### URL
- **Método:** PUT
- **URI:** `/v1/medical-records`

##### Encabezados
- **Accept:** application/json
- **Authorization:** Bearer 2|iCQHkzTEnzDlLb1BKYHBXZ1zqGCfxIorAy7qkWbZ
  - Nota: Agregar la palabra "Bearer" seguida de un espacio y luego el token.

##### Cuerpo (JSON)
```json
{
    "lugar_nacimiento": "Testing12PruebasPut1",
    "sexo": "F",
    "edad": 23,
    "tipo_sangre": "AB-",
    "peso": 80.76,
    "estatura": 165,
    "alergias": "PruebasPruebas1"
}
```

- Login, Logout and Register (Titular)

| Método | URI                     | Controlador                    | Descripción                |
|--------|-------------------------|--------------------------------|----------------------------|
| POST   | /auth/login             | LoginController@login           | Iniciar sesión             |
| POST   | /auth/register          | LoginController@register        | Registrar usuario          |
| POST   | /auth/logout            | LoginController@logout (con autenticación Sanctum) | Cerrar sesión   |

- Estructura de métodos de escritura

#### Iniciar Sesión (POST)

Este endpoint te permite iniciar sesión en la aplicación.

##### URL
- **Método:** POST
- **URI:** `/api/auth/login`

##### Encabezados
- **Accept:** application/json

##### Cuerpo (form-data)
- **email:** hilbert.bailey@example.org
- **password:** password
- **name:** Nombre del dispositivo (ejemplo: iPhone, Smart Watch, etc.)

##### Respuesta Exitosa
- **Código:** 202 Accepted
- **Contenido:**
```json
{
    "Status": "Success",
    "Message": "El usuario inició sesión",
    "Token": "TOKEN_GENERADO"
}
```

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

- composer require laravel/sanctum
