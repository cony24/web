<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Usuario de MySQL
$password = ""; // Contraseña de MySQL, por defecto está en blanco
$dbname = "cemex"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$NombreCompleto = $_POST['NombreCompleto'];
$Placas = $_POST['Placas'];
$Viaje = $_POST['Viaje'];
$Telefono = $_POST['Telefono'];
$Fecha = $_POST['Fecha'];
$Hora = $_POST['Hora'];



// Insertar los datos en la base de datos
$sql = "INSERT INTO usuarios (NombreCompleto,Placas,Viaje,Telefono,Fecha,Hora) VALUES ('$NombreCompleto', '$Placas', '$Viaje', '$Telefono', '$Fecha', '$Hora')";

if ($conn->query($sql) === TRUE) {
    echo "Datos guardados exitosamente.";
} else {
    echo "Error al guardar los datos: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>