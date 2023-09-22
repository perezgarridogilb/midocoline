<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About

- Clinical record

| Método  | Ruta                            | Controlador y Método       | Descripción                 |
|---------|---------------------------------|----------------------------|-----------------------------|
| GET     | /v1/medical-records             | MedicalRecordService@show  | Listar todos los registros  |
| GET     | /v1/medical-records/{id}        | MedicalRecordService@index | Mostrar un registro específico |
| POST    | /v1/medical-records             | MedicalRecordService@store | Crear un nuevo registro     |
| PUT     | /v1/medical-records             | MedicalRecordService@update| Actualizar su registro      |
| DELETE  | /v1/medical-records/{id}        | MedicalRecordService@destroy| Eliminar un registro específico |

- Login and Register

| Método | Ruta                  | Controlador Método             |
|--------|-----------------------|--------------------------------|
| POST   | /api/login            | App\Http\Controllers\Api\LoginController@login |
| POST   | /api/register         | App\Http\Controllers\Api\LoginController@register |

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

- composer require laravel/sanctum
