Consignas:
----------

Ejercicio 1: Instale el Sistema Gestor de Bases de Datos MySQL y las extensiones necesarias para poder interactuar con la misma desde PHP. Documente brevemente los pasos realizados y cómo verificó que el driver se instaló correctamente (vía phpinfo y vía un script de prueba).

Ejercicio 2: Genere un objeto que construya y gestione la conexión a la base de datos. El objeto debe permitir vía constructor la provisión de los datos de acceso. Los datos de acceso deben estar en un archivo de configuración específico y fuera del control de versiones.

Ejercicio 3: Extienda el sistema de gestión de turnos médicos para que los datos sean persistidos sobre una base de datos. La generación del número de turno debe hacerse vía motor de base de datos. ¿Qué cambios hubo que realizar para la generación del ID?

Ejercicio 4: Modifique el sistema para permitir que las imágenes sean persistidas sobre la base de datos. El software debe permitir cargar imágenes de hasta 10 MB.

Ejercicio 5: ¿Qué es un motor de persistencia ORM (Object-Relational Mapping; Mapeo objeto-relacional=? ¿Qué problemática resuelve? Realice una evaluación de cuánto le costaría modificar el código para implementar uno en el sistema de turnos por usted desarrollado. Si pára realizar la evaluación necesita elegir un producto particular, aclárelo.

Ejercicio 6: Implemente Modificación y Baja de los registros del sistema de turnos.

--------------------------------------------------------------------------------

Respuestas:
-----------

Ejercicio 1: Para desarrollar el TP instalé XAMPP, el cual ya incluye todas las extensiones necesarias para interactuar con el SGBD. Creé el script 'PAW/modelos/p1.php', el cual intenta establecer una conexión a la base de datos 'Test' (creada por defecto por XAMPP), y devuelve en el navegador el phpinfo y el resultado del intento de conexión. En el phpinfo, buscamos el header que dice 'PDO' y ahí nos indica las extensiones que están instaladas.

Ejercicio 2: El objeto creado está en 'PAW/modelos/Conexion.php', y el archivo de configuración está en 'PAW/config/Connection.json'.

Ejercicio 3: Cuando se crea la tabla en la base de datos, se indica que el campo ID debe ser autoincrementable, así cada vez que insertemos un registro, toma automáticamente un valor de ID que se va incrementando a medida que se ingresan turnos.

Ejercicio 5: Un ORM es un modelo de programación que permite mapear las tablas de una base de datos relacional a una estructura lógica de "entidades" con el fin de simplificar las tareas de desarrollo relacionadas con la persistencia. Podemos pensar las entidades como los objetos que deseamos persistir.
    Un ORM nos libera de escribir código SQL en nuestra aplicación, además de independizarnos del SGBD que se utilice detrás, ya que las acciones que tengamos que hacer (por ejemplo cualquier acción CRUD) se realizan fácilmente de manera indirecta por medio del ORM.
    No costaría demasiado modificar el código para implementar un ORM, se debería reemplazar las consultas SQL y la ejecución de las mismas por los métodos del ORM.

--------------------------------------------------------------------------------

Aclaraciones:
-------------

El contenido del directorio 'app' debe ser volcado en el document root para que algunos enlaces funcionen correctamente.