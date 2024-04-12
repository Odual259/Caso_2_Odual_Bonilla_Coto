<?php
include "connection.php"; 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["process"])) {
    $process = $_POST["process"];
    $clientId = $_POST["cliente"];
    $entityId = $_POST["entity"];
    $clusterId = $_POST["cluster"];
    $countryId = $_POST["country"];
    $areaId = $_POST["area"];
    $categoryId = $_POST["category"];
    $periodicityId = $_POST["periodicity"];
    $approverId = $_POST["approver"];
    $analystId = $_POST["analyst"];
    $period = $_POST["period"];
    $year = $_POST["year"];
    $dueDate = $_POST["dueDate"]; 
    $finalStatus = $_POST["finalStatus"];

    if(isset($_POST["process-id"]) && !empty($_POST["process-id"])) {
        $processId = $_POST["process-id"];
        $sql = "UPDATE processes SET Process=?, ID_Client=?, ID_Entity=?, ID_Cluster=?, ID_Country=?, ID_Area=?, ID_Category=?, ID_Periodicity=?, ID_User_Approver=?, ID_User_Analyst=?, Period=?, Year=?, Due_date=?, Final_Status=? WHERE ID_Process=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siiiiiiiiissssi", $process, $clientId, $entityId, $clusterId, $countryId, $areaId, $categoryId, $periodicityId, $approverId, $analystId, $period, $year, $dueDate, $finalStatus, $processId);
    } else {
        $sql = "INSERT INTO processes (Process, ID_Client, ID_Entity, ID_Cluster, ID_Country, ID_Area, ID_Category, ID_Periodicity, ID_User_Approver, ID_User_Analyst, Period, Year, Due_date, Final_Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siiiiiiiiissss", $process, $clientId, $entityId, $clusterId, $countryId, $areaId, $categoryId, $periodicityId, $approverId, $analystId, $period, $year, $dueDate, $finalStatus);
    }

    if ($stmt->execute()) {
        header("Location: processes.php");
        exit();
    } else {
        echo "Error al guardar los datos: " . $stmt->error;
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $processIdToDelete = $_POST["delete"];

    $deleteSql = "DELETE FROM processes WHERE ID_Process = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("i", $processIdToDelete);

    if ($deleteStmt->execute()) {
        header("Location: processes.php");
        exit();
    } else {
        echo "Error al eliminar el proceso: " . $deleteStmt->error;
    }
    $deleteStmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videogames</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Sección del título -->
        <div class="row">
            <div class="col-md-12 text-center mt-5">
                <h1>Videojuegos</h1>
            </div>
        </div>

        <!-- Sección de la imagen de cabecera -->
        <div class="row">
            <div class="col-md-12">
                <img src="ruta/a/imagen_de_cabecera.jpg" alt="Imagen de cabecera" class="img-fluid">
            </div>
        </div>

        <!-- Sección del contenido -->
        <div class="row">
            <div class="col-md-8 offset-md-2 mt-5">
                <p>Contenido sobre videojuegos...</p>
            </div>
        </div>

        <!-- Sección para agregar preguntas -->
        <div class="row">
            <div class="col-md-8 offset-md-2 mt-5" id="preguntas-seccion">
                <h2>Preguntas</h2>
                <form id="preguntas-form">
                    <div class="form-group">
                        <label for="pregunta1">Pregunta 1:</label>
                        <input type="text" class="form-control pregunta-input" id="pregunta1" name="pregunta1">
                    </div>
                    <!-- Agrega más campos de preguntas según sea necesario -->
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
