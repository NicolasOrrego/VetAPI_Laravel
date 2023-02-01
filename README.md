## Documentación del sistema VetAPI.

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
> - *El cliente podrá visualizar todos los pacientes registrados a su nombre y realizar búsquedas específicas solo si se encuentra autenticado. Si intenta buscar un paciente que no pertenecen a su nombre, se le informará que el paciente buscado no está asociado a su usuario autenticado.*
> - *El cliente podrá actualizar todas los pacientes registrados a su nombre solo si se encuentra autenticado. Si el usuario cliente intenta actualizar un paciente que no pertenecen a su nombre, se le informará que el paciente no está asociado a su usuario autenticado.*


