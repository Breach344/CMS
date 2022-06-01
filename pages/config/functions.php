<?php


function check_login($conn)
{
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $query = "select * from TABLENAME where id = '$id' limit 1";

        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    header("Location: login.php");
    die;
}


function check_loggout()
{
    if (isset($_SESSION['id'])) {
        header("Location: index.php");
    }
}


function news_out()
{
    if (!isset($_SESSION['id'])) {
        header("Location: ../../index.php");
    }
}


function news_in()
{
    if (isset($_SESSION['id'])) {
        header("Location: admin/news.php");
    }
}


function calendar_out()
{
    if (!isset($_SESSION['id'])) {
        header("Location: ../../index.php");
    }
}


function calendar_in()
{
    if (isset($_SESSION['id'])) {
        header("Location: admin/calendar.php");
    }
}


function check_login_out()
{
    if (isset($_SESSION['id'])) {
        header("Location: index.php");
    } else {
        header("Location: login.php");
    }
}


function random_num($length)
{
    $text = "";
    if ($length < 5) {
        $length = 5;
    }

    $len = rand(4, $length);

    for ($i = 0; $i < $len; $i++) {
        $text .= rand(0, 9);
    }
    return $text;
}
