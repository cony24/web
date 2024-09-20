<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Datos - Operadores</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #34495e;
            margin-top: 0;
        }
        #container {
            width: 90%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        header {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-bottom: 20px;
        }
        header img {
    position: absolute;
    left: 13px;
    top: 15px;
    transform: translateY(-50%);
    width: 160px;
    height: 56px;
        }
        header h2 {
            flex-grow: 1;
            margin: 0;
            text-align: center;
            font-size: 2em;
        }
        input[type="text"], input[type="date"] {
            width: 48%;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="text"] {
            margin-right: 4%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #2c3e50;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<div id="container">
  <header>
        <img src="cemex_oficial.png" alt="Cemex Logo">
	
      <h2><center>
        <p>&nbsp;</p>
        <p>Operadores</p>
      </center></h2>
  </header>

    <p>
      <!-- Campos de búsqueda y filtro de fecha -->
      <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Buscar por nombre, placas o teléfono...">
      <input type="date" id="dateFilter" onchange="filterByDate()">
    </p>
    <p>
      <a href="estatus.php">ESTATUS</a> &nbsp;    &nbsp;  <a href="ver_datos.php">VIGILANCIA</a> 

      <!-- Tabla de operadores -->
    </p>
    <table id="operadoresTable">
      <thead>
            <tr>
                <th>Id Operador</th>
                <th>Nombre Completo</th>
                <th>Placas</th>
                <th>Viaje</th>
                <th>Teléfono</th>
                <th>Fecha</th>
                <th>Hora</th>
            </tr>
      </thead>
        <tbody>
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
                // Mostrar datos en la tabla
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
        </tbody>
  </table>
</div>

<script>
// Función para buscar en la tabla
function searchTable() {
    let input = document.getElementById("searchInput").value.toLowerCase();
    let table = document.getElementById("operadoresTable");
    let trs = table.getElementsByTagName("tr");

    for (let i = 1; i < trs.length; i++) {
        let show = false;
        let tds = trs[i].getElementsByTagName("td");
        for (let j = 0; j < tds.length; j++) {
            if (tds[j].textContent.toLowerCase().includes(input)) {
                show = true;
                break;
            }
        }
        trs[i].style.display = show ? "" : "none";
    }
}

// Función para filtrar por fecha
function filterByDate() {
    let input = document.getElementById("dateFilter").value;
    let table = document.getElementById("operadoresTable");
    let trs = table.getElementsByTagName("tr");

    for (let i = 1; i < trs.length; i++) {
        let dateCell = trs[i].getElementsByTagName("td")[5].textContent;
        trs[i].style.display = dateCell.startsWith(input) ? "" : "none";
    }
}
</script> 

</body>
</html>
