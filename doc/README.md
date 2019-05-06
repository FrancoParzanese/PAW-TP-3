Consignas:
----------

Ejercicio 1: Instale el Sistema Gestor de Bases de Datos MySQL y las extensiones necesarias para poder interactuar con la misma desde PHP. Documente brevemente los pasos realizados y c�mo verific� que el driver se instal� correctamente (v�a phpinfo y v�a un script de prueba).

Ejercicio 2: Genere un objeto que construya y gestione la conexi�n a la base de datos. El objeto debe permitir v�a constructor la provisi�n de los datos de acceso. Los datos de acceso deben estar en un archivo de configuraci�n espec�fico y fuera del control de versiones.

Ejercicio 3: Extienda el sistema de gesti�n de turnos m�dicos para que los datos sean persistidos sobre una base de datos. La generaci�n del n�mero de turno debe hacerse v�a motor de base de datos. �Qu� cambios hubo que realizar para la generaci�n del ID?

Ejercicio 4: Modifique el sistema para permitir que las im�genes sean persistidas sobre la base de datos. El software debe permitir cargar im�genes de hasta 10 MB.

Ejercicio 5: �Qu� es un motor de persistencia ORM (Object-Relational Mapping; Mapeo objeto-relacional=? �Qu� problem�tica resuelve? Realice una evaluaci�n de cu�nto le costar�a modificar el c�digo para implementar uno en el sistema de turnos por usted desarrollado. Si p�ra realizar la evaluaci�n necesita elegir un producto particular, acl�relo.

Ejercicio 6: Implemente Modificaci�n y Baja de los registros del sistema de turnos.

--------------------------------------------------------------------------------

Respuestas:
-----------

Ejercicio 1: Para desarrollar el TP instal� XAMPP, el cual ya incluye todas las extensiones necesarias para interactuar con el SGBD. Cre� el script 'PAW/modelos/p1.php', el cual intenta establecer una conexi�n a la base de datos 'Test' (creada por defecto por XAMPP), y devuelve en el navegador el phpinfo y el resultado del intento de conexi�n. En el phpinfo, buscamos el header que dice 'PDO' y ah� nos indica las extensiones que est�n instaladas.

Ejercicio 2: El objeto creado est� en 'PAW/modelos/Conexion.php', y el archivo de configuraci�n est� en 'PAW/config/Connection.json'.

Ejercicio 3: Cuando se crea la tabla en la base de datos, se indica que el campo ID debe ser autoincrementable, as� cada vez que insertemos un registro, toma autom�ticamente un valor de ID que se va incrementando a medida que se ingresan turnos.

Ejercicio 5: Un ORM es un modelo de programaci�n que permite mapear las tablas de una base de datos relacional a una estructura l�gica de "entidades" con el fin de simplificar las tareas de desarrollo relacionadas con la persistencia. Podemos pensar las entidades como los objetos que deseamos persistir.
    Un ORM nos libera de escribir c�digo SQL en nuestra aplicaci�n, adem�s de independizarnos del SGBD que se utilice detr�s, ya que las acciones que tengamos que hacer (por ejemplo cualquier acci�n CRUD) se realizan f�cilmente de manera indirecta por medio del ORM.
    No costar�a demasiado modificar el c�digo para implementar un ORM, se deber�a reemplazar las consultas SQL y la ejecuci�n de las mismas por los m�todos del ORM.

--------------------------------------------------------------------------------

Aclaraciones:
-------------

El contenido del directorio 'app' debe ser volcado en el document root para que algunos enlaces funcionen correctamente.