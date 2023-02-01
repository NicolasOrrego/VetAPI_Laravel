## Documentación de VetAPI.

*Bienvenido a VetAPI, una solución de API-REST que te permite administrar tu clínica veterinaria de manera eficiente y sencilla. Con VetAPI puedes almacenar toda la información importante sobre tus clientes,pacientes,citas y diagnosticos, todo en un mismo lugar.*

*Los clientes pueden solicitar citas en línea y proporcionar información sobre sus mascotas para que los veterinarios puedan tener una aproximación al problema antes de la cita. Los veterinarios también pueden registrar pacientes, crear fichas médicas y registrar información sobre jaulas.*

## Tecnologías utilizadas en VetAPI
*VetAPI ha sido desarrollado utilizando Laravel 9 como framework de PHP y la base de datos se ha implementado en MySQL.*

## Descripción de roles.
*Con VetAPI, puede acceder a diferentes capacidades según su rol. Aquí está una descripción de las capacidades de cada rol:*
> *Rol Administrador:*
> - *Gestiona todos tus clientes, pacientes y funcionarios, agregándolos o actualizándolos.*
> - *Administra todos los registro médicos de los veterinarios.*
> - *Administra todos los registro de jaula de los pacientes.*
> - *Consulta todas las cita médica de los diferentes funcionario.*

> *Rol Funcionario:*
> - *Gestiona todos tus pacientes, registros médicos y de jaulas, agregándolos o actualizándolos.*
> - *Administra todos las fichas médica asignada al veterinario.*
> - *Administra todos los registro de jaula asignada al veterinario.*

> *Rol Cliente:*
> - *Gestiona todos tus pacientes y citas médicas, agregándolos o actualizándolos.*
> - *Consulta todos los pacientes asignada al cliente.*
> - *Consulta todos las cita médica asignada al cliente.*

## Atención importante: restricciones de implementación
*Antes de implementar la API-REST de VetAPI, por favor tenga en cuenta las siguientes restricciones:*
> *Acceso a funciones de la API-REST:*
> - *Para acceder a cualquier funcionalidad de la API-REST, se requerirá un token de autenticación obtenido tras iniciar sesión como administrador, funcionario o cliente.*

> *Gestión de Citas Médicas:*
> - *El administrador solo podrá registrar una cita médica en nombre de un cliente si este existe en la base de datos y su estado es habilitado. En caso contrario, si el cliente no existe o su estado no es habilitado, el administrador no podrá registrar la cita médica. Para actualizar una cita médica, también se deben cumplir estas condiciones.*
> - *No se permitirá registrar una cita médica con la misma hora, ya que se generará un error que indicará que la hora ya se encuentra en uso. Este error afectará tanto al usuario administrador como al usuario cliente, quienes solo podrán registrar una cita médica en una hora que no esté ocupada.*
> - *La cita médica registrada por el usuario cliente será asociada automáticamente con su identificador de usuario siempre y cuando se encuentre autenticado.*
> - *El cliente podrá visualizar todas las citas médicas registradas a su nombre y realizar búsquedas específicas solo si se encuentra autenticado. Si intenta buscar citas médicas que no pertenecen a su nombre, se le informará que la cita buscada no está asociada a su usuario autenticado.*
> - *El cliente podrá actualizar todas las citas médicas registradas a su nombre solo si se encuentra autenticado. Si el usuario cliente intenta actualizar citas médicas que no pertenecen a su nombre, se le informará que la cita no está asociada a su usuario autenticado.*
> - *Solo los usuarios clientes y administradores tienen permiso para registrar citas médicas. Si un usuario diferente intenta registrar una cita, recibirá un mensaje de error indicando que "El usuario especificado no es cliente.*

> *Registros Médicos:*
> - *El administrador solo podrá registrar un registro médico en nombre de un veterinario si este existe en la base de datos y su estado es habilitado. En caso contrario, si el veterinario no existe o su estado no es habilitado, el administrador no podrá registrar el registro médico. Para actualizar un registro médico, también se deben cumplir estas condiciones.*
> - *Antes de crear un registro médico, asegúrese de que el paciente exista en la base de datos, de lo contrario no se permitirá llevar a cabo la creación.*
> - *Solo los usuarios veterinario y administradores tienen permiso para registrar un registro médico. Si un usuario diferente intenta registrar un registro médico, recibirá un mensaje de error indicando que "El usuario especificado no es veterinario.*
> - *El registro médico será asociado automáticamente con el identificador de usuario del veterinario que lo registre, siempre y cuando se encuentre autenticado.*
> - *El veterinario podrá visualizar todos los registro médico registrados a su nombre y realizar búsquedas específicas solo si se encuentra autenticado. Si intenta buscar registro médico que no pertenecen a su nombre, se le informará que el registro médico buscado no está asociado a su usuario autenticado.*
> - *El veterinario podrá actualizar todas los registro médico registrados a su nombre solo si se encuentra autenticado. Si el usuario veterinario intenta actualizar registro médico que no pertenecen a su nombre, se le informará que el registro médico no está asociado a su usuario autenticado.*

> *Registros Jaula:*
> - *El administrador solo podrá registrar un registro de jaula en nombre de un veterinario si este existe en la base de datos y su estado es habilitado. En caso contrario, si el veterinario no existe o su estado no es habilitado, el administrador no podrá registrar el registro de jaula. Para actualizar un registro de jaula, también se deben cumplir estas condiciones.*
> - *Antes de crear un registro jaula, asegúrese de que el paciente exista en la base de datos, de lo contrario no se permitirá llevar a cabo la creación.*
> - *Antes de crear un registro jaula, asegúrese de que la jaula exista en la base de datos, de lo contrario no se permitirá llevar a cabo la creación.*
> - *Solo los usuarios veterinario y administradores tienen permiso para registrar un registro de jaula. Si un usuario diferente intenta registrar un registro de jaula, recibirá un mensaje de error indicando que "El usuario especificado no es veterinario.*
> - *El registro de jaula será asociado automáticamente con el identificador de usuario del veterinario que lo registre, siempre y cuando se encuentre autenticado.*
> - *El veterinario podrá visualizar todos los registro de jaula registrados a su nombre y realizar búsquedas específicas solo si se encuentra autenticado. Si intenta buscar un registro de jaula que no pertenecen a su nombre, se le informará que el registro de jaula buscado no está asociado a su usuario autenticado.*
> - *El veterinario podrá actualizar todas los registro de jaula registrados a su nombre solo si se encuentra autenticado. Si el usuario veterinario intenta actualizar un registro de jaula que no pertenecen a su nombre, se le informará que el registro de jaula no está asociado a su usuario autenticado.*

> *Paciente:*
> - *El registro de un paciente a nombre de un cliente solo es posible para los usuarios administrador y veterinario si el cliente correspondiente existe en la base de datos y su estado es habilitado. De lo contrario, el registro o actualización del paciente no será permitido. Por favor, asegúrese de cumplir estas condiciones antes de intentar registrar o actualizar un paciente.*
> - *El registro de un nuevo paciente será asociado automáticamente con el identificador de usuario del cliente que lo registre, siempre y cuando se encuentre autenticado*
> - *El cliente podrá visualizar todos los pacientes registrados a su nombre solo si se encuentra autenticado.
> - *El cliente podrá actualizar todas los pacientes registrados a su nombre solo si se encuentra autenticado. Si el usuario cliente intenta actualizar un paciente que no pertenecen a su nombre, se le informará que el paciente no está asociado a su usuario autenticado.*

## Cómo implementar VetAPI.
> *Clone este repositorio:*
```
https://github.com/NicolasOrrego/API_Veterinaria-Laravel_9.git
```
> *Instalación de dependencias.*
```
composer install
```
> *Instalación de paquetes NPM.*
```
npm install
```
> *Creamos el archivo .env*
```
 copy .env.example .env
```
> *Ejecución de migraciones*
```
 php artisan migrate
```
## Rutas de VetAPI.
1. *Auntenticación*
> - http://127.0.0.1:8000/api/v1/registrarse
> - http://127.0.0.1:8000/api/v1/login
> - http://127.0.0.1:8000/api/v1/logout

2. *Administrador*
> *Informacion personal*
> - http://127.0.0.1:8000/api/v1/administrador
> - http://127.0.0.1:8000/api/v1/administrador/informacion
> - http://127.0.0.1:8000/api/v1/administrador/deshabilitar/cuenta

> *CRUD usuario*
> - http://127.0.0.1:8000/api/v1/administrador/registrar/usuario
> - http://127.0.0.1:8000/api/v1/administrador/lista/usuarios
> - http://127.0.0.1:8000/api/v1/administrador/lista/administradores/usuarios
> - http://127.0.0.1:8000/api/v1/administrador/lista/funcionarios/usuarios
> - http://127.0.0.1:8000/api/v1/administrador/lista/clientes/usuarios
> - http://127.0.0.1:8000/api/v1/administrador/buscar/usuario/{id}
> - http://127.0.0.1:8000/api/v1/administrador/modificar/usuario/{id}
> - http://127.0.0.1:8000/api/v1/administrador/eliminar/usuario/{id}

> *CRUD paciente*
> - http://127.0.0.1:8000/api/v1/administrador/registrar/paciente
> - http://127.0.0.1:8000/api/v1/administrador/lista/pacientes
> - http://127.0.0.1:8000/api/v1/administrador/buscar/paciente/{id}
> - http://127.0.0.1:8000/api/v1/administrador/modificar/paciente/{id}
> - http://127.0.0.1:8000/api/v1/administrador/eliminar/paciente/{id}

> *CRUD jaula*
> - http://127.0.0.1:8000/api/v1/administrador/registrar/jaula
> - http://127.0.0.1:8000/api/v1/administrador/lista/jaulas
> - http://127.0.0.1:8000/api/v1/administrador/buscar/jaula/{id}
> - http://127.0.0.1:8000/api/v1/administrador/modificar/jaula/{id}
> - http://127.0.0.1:8000/api/v1/administrador/eliminar/jaula/{id}

> *CRUD cita médica*
> - http://127.0.0.1:8000/api/v1/administrador/registrar/cita
> - http://127.0.0.1:8000/api/v1/administrador/lista/citas
> - http://127.0.0.1:8000/api/v1/administrador/buscar/cita/{id}
> - http://127.0.0.1:8000/api/v1/administrador/modificar/cita/{id}
> - http://127.0.0.1:8000/api/v1/administrador/eliminar/cita/{id}

> *CRUD ficha médica*
> - http://127.0.0.1:8000/api/v1/administrador/registrar/ficha
> - http://127.0.0.1:8000/api/v1/administrador/lista/fichas
> - http://127.0.0.1:8000/api/v1/administrador/buscar/ficha/{id}
> - http://127.0.0.1:8000/api/v1/administrador/modificar/ficha/{id}
> - http://127.0.0.1:8000/api/v1/administrador/eliminar/ficha/{id}

> *CRUD registro jaula*
> - http://127.0.0.1:8000/api/v1/administrador/registrar/registro/jaula
> - http://127.0.0.1:8000/api/v1/administrador/lista/registro/jaulas
> - http://127.0.0.1:8000/api/v1/administrador/buscar/registro/jaula/{id}
> - http://127.0.0.1:8000/api/v1/administrador/modificar/registro/jaula/{id}
> - http://127.0.0.1:8000/api/v1/administrador/eliminar/registro/jaula/{id}

3. *Veterinario*
> *Informacion personal*
> - http://127.0.0.1:8000/api/v1/funcionario
> - http://127.0.0.1:8000/api/v1/funcionario/informacion
> - http://127.0.0.1:8000/api/v1/funcionario/deshabilitar/cuenta

> *CRUD ficha médica*
> - http://127.0.0.1:8000/api/v1/funcionario/registrar/ficha
> - http://127.0.0.1:8000/api/v1/funcionario/lista/fichas
> - http://127.0.0.1:8000/api/v1/funcionario/buscar/ficha/{id}
> - http://127.0.0.1:8000/api/v1/funcionario/modificar/ficha/{id}
> - http://127.0.0.1:8000/api/v1/funcionario/eliminar/ficha/{id}

> *CRUD paciente*
> - http://127.0.0.1:8000/api/v1/funcionario/registrar/paciente
> - http://127.0.0.1:8000/api/v1/funcionario/lista/pacientes
> - http://127.0.0.1:8000/api/v1/funcionario/buscar/paciente/{id}
> - http://127.0.0.1:8000/api/v1/funcionario/modificar/paciente/{id}
> - http://127.0.0.1:8000/api/v1/funcionario/eliminar/paciente/{id}

> *CRUD registro jaula*
> - http://127.0.0.1:8000/api/v1/funcionario/registrar/registro/jaula
> - http://127.0.0.1:8000/api/v1/funcionario/lista/registro/jaulas
> - http://127.0.0.1:8000/api/v1/funcionario/buscar/registro/jaula/{id}
> - http://127.0.0.1:8000/api/v1/funcionario/modificar/registro/jaula/{id}
> - http://127.0.0.1:8000/api/v1/funcionario/eliminar/registro/jaula/{id}

4. *Cliente*
> *Informacion personal*
> - http://127.0.0.1:8000/api/v1/cliente
> - http://127.0.0.1:8000/api/v1/cliente/informacion
> - http://127.0.0.1:8000/api/v1/cliente/deshabilitar/cuenta

> *Paciente*
> - http://127.0.0.1:8000/api/v1/cliente/registrar/paciente
> - http://127.0.0.1:8000/api/v1/cliente/lista/pacientes
> - http://127.0.0.1:8000/api/v1/cliente/modificar/paciente/{id}

> *CRUD cita médica*
> - http://127.0.0.1:8000/api/v1/cliente/registrar/cita
> - http://127.0.0.1:8000/api/v1/cliente/lista/citas
> - http://127.0.0.1:8000/api/v1/cliente/buscar/cita/{id}
> - http://127.0.0.1:8000/api/v1/cliente/modificar/cita/{id}
> - http://127.0.0.1:8000/api/v1/cliente/eliminar/cita/{id}


## Ejemplo de solicitud





