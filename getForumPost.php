<?php
include "connection.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $forumPostID = $_GET['id'];
    $sql = "SELECT * FROM videogamesForum WHERE ID_Post = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $forumPostID);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $foeumPostData = $result->fetch_assoc();
            echo json_encode($foeumPostData);
        } else {
            echo json_encode(array("error" => "No se encontró ningún post con el ID proporcionado."));
        }
    } else {
        echo json_encode(array("error" => "Error al obtener los datos del post."));
    }
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(array("error" => "No se proporcionó un ID de post válido."));
}
?>
