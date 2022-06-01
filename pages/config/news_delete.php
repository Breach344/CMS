<?php


include("news_con.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM TABLENAME WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query Failed.");
    }

    $_SESSION['message'] = 'Deleted';
    $_SESSION['message_type'] = 'danger';
    header('Location: ../news.php');
}
