<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Datos</title>
</head>
<body>
    <h2>Listado de Usuarios</h2>
    <table border="1">
     

        <?php
        // Conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cemex";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Obtener los datos de la base de datos
        $sql = "SELECT IdOperador,NombreCompleto,Placas,Viaje,Telefono,Fecha,Hora FROM operador";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar datos en una tabla
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["IdOperador"] . "</td>
                        <td>" . $row["NombreCompleto"] . "</td>
						<td>" . $row["Placas"] . "</td>
                        <td>" . $row["Viaje"] . "</td>
                        <td>" . $row["Telefono"] . "</td>
                        <td>" . $row["Fecha"] . "</td>
                        <td>" . $row["Hora"] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No hay datos disponibles</td></tr>";
        }

        // Cerrar conexión
        $conn->close();
        ?>
    </table> 
</body>
</html>
