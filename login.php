<?php
session_start();

include("pages/config/login_con.php");
include("pages/config/functions.php");

check_loggout();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if (!empty($username) && !empty($password) && !is_numeric($username)) {

        $query = "select * from c_users where username = '$username' limit 1";

        $result = mysqli_query($conn, $query);

        if ($result) {

            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                if (password_verify($password, $hashed_password)) {

                    $_SESSION['id'] = $user_data['id'];
                    header("Location: index.php");
                    die;
                }
            }
        }
        echo "Incorrect username or password";
    } else {
        echo "Incorrect username or password";
    }
}
?>

<html>

<body>
    <h1>Login Page</h1>

    <div id="login-form">
        <h2>Login</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username..."><br><br>
            <input type="password" name="password" placeholder="Password..."><br><br>

            <input type="submit" value="Login"><br><br>
        </form>
    </div>
</body>

</html>