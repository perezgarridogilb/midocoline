
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
| DELETE  | /v1/medical-records/{id}        | MedicalRecordService@destroy| Eliminar su registro |

- Estructura de métodos de escritura

#### Crear un nuevo registro (POST)

Este endpoint te permite crear un nuevo registro clínico.

##### URL
- **Método:** POST
- **URI:** `/v1/medical-records`

##### Encabezados
- **Accept:** application/json
- **Authorization:** Bearer {tu_token_de_autenticación}
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
- **Authorization:** Bearer {tu_token_de_autenticación}
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

| Método | URI                                | Controlador y Método           | Descripción                          |
|--------|------------------------------------|--------------------------------|--------------------------------------|
| POST   | `/v1/beneficiaries`               | `BeneficiaryController@store`  | Crear un beneficiario asociado al titular |
| GET    | `/v1/beneficiaries`               | `BeneficiaryController@show`   | Listar todos los beneficiarios        |
| DELETE | `/v1/beneficiaries/{id}`          | `BeneficiaryController@destroy`| Eliminar un beneficiario específico   |

## Crear beneficiarios

Este endpoint te permite crear beneficiarios asociados a tu usuario. Asegúrate de incluir el token de autenticación del usuario dueño de los beneficiarios en el encabezado "Authorization".

**URL**
- **Método:** POST
- **URI:** `/v1/beneficiaries`

**Encabezados**
- **Accept:** application/json
- **Authorization:** Bearer {tu_token_de_autenticación}

**Cuerpo (JSON)**
```json
{
    "beneficiary_name": "Nombre del Beneficiario",
    "relationship": "Parentesco",
    "email": "correo@example.com",
    "password": "password"
}
```
## Eliminar beneficiario

Este endpoint te permite eliminar un beneficiario asociado a tu cuenta. Asegúrate de incluir el token de autenticación del usuario dueño del beneficiario en el encabezado "Authorization".

**URL**
- **Método:** DELETE
- **URI:** `/v1/beneficiaries/{id_del_beneficiario_a_eliminar}`

**Encabezados**
- **Accept:** application/json
- **Authorization:** Bearer {tu_token_de_autenticación}

## Obtener todos los beneficiarios

Este endpoint te permite obtener todos los beneficiarios asociados a tu cuenta. Asegúrate de incluir el token de autenticación del usuario dueño de los beneficiarios en el encabezado "Authorization".

**URL**
- **Método:** GET
- **URI:** `/v1/beneficiaries/`

**Encabezados**
- **Accept:** application/json
- **Authorization:** Bearer {tu_token_de_autenticación}

Este endpoint te permite obtener todos los beneficiarios asociados a tu cuenta. Asegúrate de proporcionar el token de autenticación adecuado en los encabezados.

La respuesta esperada es un código de estado HTTP 200, que indica que la solicitud se ha completado con éxito. A continuación, se muestra un ejemplo de la estructura JSON de la respuesta:

```json
{
    "Status": "Success",
    "Beneficiaries": [
        {
            "id": 3,
            "primary_user_id": 1,
            "beneficiary_name": "Nombre del Beneficiario",
            "relationship": "Parentesco",
            "email": "correo@example.com",
            "password": "password",
            "remember_token": null,
            "created_at": "2023-09-23T18:04:45.000000Z",
            "updated_at": "2023-09-23T18:04:45.000000Z"
        }
    ]
}
```
- Nota: En la lógica se encuentra la restricción a sólo tres beneficiarios por usuario asociado a la sesión.

## Base de Datos

### Modelos

![Descripción de la imagen](https://github.com/perezgarridogilb/midocoline/assets/56992179/ed258105-aaad-4211-8c9a-504c68838bb5)


### Importar Base de Datos

Para configurar la Base de Datos, simplemente importa el archivo [`api_full.sql`](https://drive.google.com/file/d/1V-ArFhVjhM8Niq9wNvW8A4fU5bVGdxWV/view?usp=sharing) en phpMyAdmin siguiendo estos pasos:

1. Abre phpMyAdmin.

2. Ve a la pestaña "Importar".

3. Selecciona el archivo `api_full.sql`.

4. Haz clic en "Continuar" para importar.

¡Listo! La Base de Datos estará lista para su uso. Si necesitas más detalles, puedes consultar [este tutorial en video](https://www.youtube.com/watch?v=yK1ODvRwgHY&t=166s).


## Permisos
Sólo se pueden eliminar beneficiarios asociados a la sesión. Se puede cerrar sesión en caso de probar con otro usuario. Sólo se pueden eliminar los expedientes asociados a la sesión.

### Bliblioteca utilizada para permisos

- composer require laravel/sanctum

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


