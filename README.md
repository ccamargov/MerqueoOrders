<p align="center"><img src="https://merqueo.com/assets/img/Logo.svg" width="400"></p>

## Descripción

Este proyecto es un componente backend encargado de exponer APIs RestFULL, las cuales tienen como objetivo brindar información relacionada con la gestión de pedidos, inventarios, productos y transportadores los cuales se manejan dentro de la compañía (Merqueo).

## Especificaciones técnicas

<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

- **Lenguaje de programación:** PHP 7.2.19
- **Framework:** Laravel Framework 6.5.1
- **Database:** MySQL
- **Gestor de versiones - Fuentes:** Git
- **Herramienta de versionamiento remota:** GitHub
- **Herramienta de gestión de requerimientos:** Trello
- **URL Trello:** https://trello.com/b/43r4X7rw/merqueo-prueba-t%C3%A9cnica
- **Metodología:** Agile - Scrum (Carriles estándar).
- **Ambiente de desarrollo:** Laragon.
- **Herramienta para pruebas funcionales:** Postman
- **Herramienta de diagramación:** Draw.io

## Listado de APIs expuestas:
```
| 1 | GET | api/v1/carriers-orders       | carriers.index                 | api,auth:api |
| 2 | GET | api/v1/inventory             | inventory.index                | api,auth:api |
| 3 | GET | api/v1/inventory-updated     | products.inventory-updated     | api,auth:api |
| 4 | GET | api/v1/less-products-sold    | products.less-products-sold    | api,auth:api |
| 5 | GET | api/v1/most-products-sold    | products.most-products-sold    | api,auth:api |
| 6 | GET | api/v1/products-availability | products.products-availability | api,auth:api |
```
Listado de parámetros de entrada (Usar como referencia el número de la primera columna de la tabla anterior):

### API 3
- Campo 1: date_sales
- Formato: "YYYY-mm-DD"
- Tipo: QueryParam

- Campo 2: date
- Formato: "YYYY-mm-DD"
- Tipo: QueryParam

### API 4
- Campo 1: date
- Formato: "YYYY-mm-DD"
- Tipo: QueryParam

### API 5
- Campo 1: date
- Formato: "YYYY-mm-DD"
- Tipo: QueryParam

### API 6
- Campo 1: order_id
- Formato: número
- Tipo: QueryParam

## Modelo de datos

<p align="center"><img src="https://i.ibb.co/Gk6VSM8/image.png" width="400"></p>

## Consideraciones técnicas
### Configuración del ambiente para ejecutar la aplicación

1. Instalar Laragon (O el ambiente de desarrollo que prefiera).
2. Instalar Composer (Si el ambiente no lo tiene incluido).
3. Instalar laravel desde la terminal:
```
composer global require "laravel/installer"
```
4. Dentro de la carpeta www del servidor o ambiente que haya configurado, hacer clone de este repositorio.
```
git clone https://github.com/...
```
5. Ingresar a la carpeta del aplicativo e instalar dependencias
```
composer install
```
6. Ingresar a la consola de MySQL mediante el terminal
```
mysql -u root
```
7. Crear el usuario de BD
```
CREATE USER 'merqueo' IDENTIFIED BY 'm3rq30';
```
8. Brindar permisos al usuario creado
```
GRANT ALL PRIVILEGES ON *.* TO 'merqueo';
```
9. Crear base de datos
```
CREATE DATABASE merqueo_orders;
```
10. Ejecutar migraciones de base de datos
```
php artisan migrate
```
11. Ejecutar DUMP / Populado automático de datos.
Considerando que se utilizó el framework de **Laravel** para la construcción del aplicativo, se empleó el uso de **FACTORYS** y **SEEDS** para el llenado automático de las bases de datos. El comando es:
```
php artisan db:seed
```
12. Ejecución de pruebas unitarias (Es posible que se deban actualizar algunos valores dummy alohados allí. Considerando que la data que se ingresa se genera de manera automática y cambia por ejecución):
```
vendor\bin\phpunit.bat
```
13. Validación de APIs expuestas:
```
php artisan route:list
```
## Consideraciones finales
Para la correcta conclusión de la evaluación se utilizó **TRELLO** para organizar todas y cada una de las actividades necesarias para concluir con el proyecto, tareas comprendidas entre: Análisis, diseño, desarrollo, documentación. Los invito a ingresar al [tablero](https://trello.com/b/43r4X7rw/merqueo-prueba-t%C3%A9cnica), se encuentra público. Allí podrán encontrar detalle de mis actividades, material adjunto que utilicé para organizar los recursos, de esta forma podrán evaluar también mi método de trabajo en temas no técnicos.

Para el versionamiento del código se utilizó el método GitFlow base, el cual comprende el manejo de las siguientes ramas base:

- master: Rama con el códiguo productivo, cuyas funcionalidades han sido certificadas en etapas previas.
- test: Rama con el código en evaluación, cuyas funcionalidades se encuentran en validación y testing, para luego pasar a la rama productiva (test->master).
- develop: Rama con el código en desarrollo centralizado, allí desembocan todos los feature que se vayan desarrollando, para luego disponerlos en la rama de test para la ejecución de pruebas funcionales.
- feature/[xxx]: Ramas que descienden de develop, las cuales tienen un propósito específico (eg. feature/api_inventory, etc)

El modelo de integración de cambios se basa en el uso de **PULL REQUESTS** de manera ascendente, de tal forma que, la rama featre/[xxx] llegará en algún momento a la rama master, pasando por las ramas intermedias develop y test. Los pull request se utilizan para validar el código a integrar. TODO PULL REQUEST está relacionado en una tarea puntual en TRELLO (Integración de tecnologías).

Dentro de este repositorio, se han dejado todas las ramas empleadas para al conclusión de este proyecto, con el objetivo de manejar un histórico de ramas de tal forma que la evaluación sea más sencilla.

Por otro lado, se implementó un sistema de seguridad básico con el método **api_token**. Se agregó un campo api_token en el modelo de datos BASE de laravel denominado users, y luego se configuró un proxy para controlar el consumo de las APIs. Este parámetro siempre debe enviarse dentro de cada una de las peticiones, de lo contrario las APIs responderá con código **401 Unauthorized**. PAra evitar inconvenientes de tipo de contenido, es recomendable consumir las APIs incluyendo los siguientes HEADERS:

- Content-Type: application/json
- Accept: application/json

Considerando que todas las APIs tienen como finalidad consultar información, todas están definidas para ser consumidas por el método **GET**.

La arquitectura utilizada es la que el framework presenta por defecto, haciendo énfasis en el uso de los siguientes componentes:

- **routes/api.php:** Definición de todas las rutas asociadas a las APIs generadas. Aquí está incluido el filtro de validación de API_KEY.
- **database/migrations:** Creación de tablas, inserción de campos, validación de campos, inclusión de constraints, definición de llaves foráneas, etc.
- **database/factories:** Definición de factorías mediante la librería **Faker** de PHP, para la inserción automática de datos para cada modelo.
- **database/seeds:** Definición de algoritmos para implemetnar las factorias configuradas. Aquí se ejecuta la populación de data sobre la BD.
- **tests/Feature:** Definición de todas las pruebas unitarias a ejecutar, para validar la ingridad de las APIs. Se encuentran agrupadas por modelo.
- **.env:** Definición de variables de entorno asociadas a la configuración del ambiente sobre el que será desplegado el aplicativo. Definición de datos de conexión a BD, nombre de aplicación, etc.
- **app/Http/Resources:** Definición de clases de naturaleza JsonResource, encargadas de dar forma a la salida de algunos objetos anidados, como respuestas de algunas APIs (No se emplea para todos los casos, pues hay consultas más complejas que manejan su propio output).
- **app/Http/Controllers:** Definición de clases controladoras. Allí se definen los métodos asociados en el archivo de rutas para las APIs creadas. Cada método cuenta con validación. Esta clase invoca la configuración efectuada en los Resources (JsonResources).
- **app/Models:** Definición de clases con el modelo de datos de cada objeto creado en la base de datos. Allí se definen querys avanzados para consultar información, se configura la asociación entre modelos, etc.

TODO EL CÓDIGO ESTÁ DOCUMENTADO, CON DISTINTAS CLASES DE COMENTARIOS LOS CUALES FACILITAN EL DESARROLLO Y ENTENDIMIENTO DEL CÓDIGO.

## Agradecimientos
A Merqueo por haberme brindado la oportunidad de presentar esta evaluación, con el objetivo de avanzar en el proceso de selección y así buscar entrar en el equipo de trabajo de la empresa.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
