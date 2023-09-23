
## About

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

#### Registrar Usuario Titular (POST)

Este endpoint te permite registrar un usuario titular que puede registrar beneficiarios en la aplicación.

##### URL
- **Método:** POST
- **URI:** `/api/auth/register`

##### Encabezados
- **Accept:** application/json

##### Cuerpo (JSON)
```json
{
    "name": "Nombre del Usuario",
    "email": "correo@example.com",
    "password": "password"
}
```

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
    "alergias": "Pruebas POST"
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
    "lugar_nacimiento": "North Gillianville",
    "sexo": "F",
    "edad": 23,
    "tipo_sangre": "AB-",
    "peso": 80.76,
    "estatura": 165,
    "alergias": "Pruebas PUT"
}
```

#### Cálculo de índice de masa corporal al actualizar estatura y/o peso (mutador)
Cada vez que se actualice el peso o la estatura de un expediente médico, el IMC se calculará automáticamente y se actualizará en la base de datos.

##### Respuesta Exitosa
- **Código:** 201 Created
- **Contenido:**

```json
{
    "Status": "Success",
    "Message": "Expediente médico actualizado satisfactoriamente",
    "data": {
        "id": 14,
        "user_id": 1,
        "lugar_nacimiento": "North Gillianville",
        "sexo": "F",
        "edad": 23,
        "tipo_sangre": "AB-",
        "peso": 80.76,
        "estatura": 165,
        "alergias": "Pruebas IMC",
        "imc": 29.66,
        "created_at": "2023-09-22T01:33:02.000000Z",
        "updated_at": "2023-09-22T02:46:10.000000Z"
    }
}
```

- Registrar beneficiarios, Eliminar beneficiarios, Crear expediente clínico para reflejarse como adicional (Titular)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

- composer require laravel/sanctum