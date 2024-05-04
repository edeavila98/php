<?php
// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $edad = $_POST["edad"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    
    // Configuración de la conexión a SQL Server
    $servidor = "localhost"; // Cambia esto por la dirección del servidor de SQL Server
    $usuario = "sa"; // Cambia esto por el nombre de usuario de SQL Server
    $contrasena = "123456"; // Cambia esto por la contraseña de SQL Server
    $base_datos = "ejemplo_php"; // Nombre de la base de datos
    
    // Establecer la conexión a SQL Server
    $conexion = sqlsrv_connect($servidor, array("UID" => $usuario, "PWD" => $contrasena, "Database" => $base_datos));
    
    // Verificar la conexión
    if ($conexion === false) {
        die("Error al conectar a la base de datos: " . sqlsrv_errors());
    }
    
    // Preparar la consulta SQL para insertar los datos en la tabla personas
    $sql_insert = "INSERT INTO personas (nombre, apellido, edad, direccion, telefono) VALUES (?, ?, ?, ?, ?)";
    
    // Parámetros de la consulta de inserción
    $params_insert = array($nombre, $apellido, $edad, $direccion, $telefono);
    
    // Ejecutar la consulta de inserción
    $stmt_insert = sqlsrv_query($conexion, $sql_insert, $params_insert);
    
    // Verificar si la consulta de inserción se ejecutó correctamente
    if ($stmt_insert === false) {
        die("Error al guardar los datos en la base de datos: " . sqlsrv_errors());
    } else {
        echo "Los datos se han guardado correctamente en la base de datos.<br>";
    }
    
    // Consulta SQL para seleccionar todos los datos de la tabla personas
    $sql_select = "SELECT * FROM personas";
    
    // Ejecutar la consulta de selección
    $stmt_select = sqlsrv_query($conexion, $sql_select);
    
    // Verificar si la consulta de selección se ejecutó correctamente
    if ($stmt_select === false) {
        die("Error al obtener los datos de la base de datos: " . sqlsrv_errors());
    }
    
    // Mostrar los resultados en una tabla HTML
    if (sqlsrv_has_rows($stmt_select)) {
        echo "<h2>Datos Guardados en la Base de Datos</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Edad</th><th>Dirección</th><th>Teléfono</th></tr>";
        while ($fila = sqlsrv_fetch_array($stmt_select, SQLSRV_FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $fila["id"] . "</td>";
            echo "<td>" . $fila["nombre"] . "</td>";
            echo "<td>" . $fila["apellido"] . "</td>";
            echo "<td>" . $fila["edad"] . "</td>";
            echo "<td>" . $fila["direccion"] . "</td>";
            echo "<td>" . $fila["telefono"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron datos en la base de datos.";
    }
    
    // Cerrar la conexión
    sqlsrv_free_stmt($stmt_insert);
    sqlsrv_free_stmt($stmt_select);
    sqlsrv_close($conexion);
}
?>