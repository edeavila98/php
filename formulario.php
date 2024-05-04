<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Datos Personales</title>
</head>
<body>
    <h2>Formulario de Datos Personales</h2>
    <form action="procesar_formulario.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br><br>
        
        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" min="1" required><br><br>
        
        <label for="direccion">Dirección:</label><br>
        <textarea id="direccion" name="direccion" required></textarea><br><br>
        
        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono" required><br><br>
        
        <input type="submit" value="Enviar">
    </form>
</body>
</html>