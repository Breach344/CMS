<?php
session_start();

include '../../components/header.php';
include('../config/news_con.php');
include('../config/functions.php');

news_out();


$sql = 'SELECT * FROM news ORDER BY date DESC LIMIT 3';

$result = mysqli_query($conn, $sql);

$news = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>


<a href="http://localhost/logout.php">Logout</a>


<h2>News</h2>



<?php if (empty($news)) : ?>
    <p class="lead mt-3">There are no news entries</p>
<?php endif; ?>



<?php foreach ($news as $item) : ?>
    <div class="card my-3 w-75">
        <div class="card-body text-center">
            <?php echo $item['body']; ?>
            <a href="../config/news_edit.php?id=<?php echo $item['id'] ?>">
                <p>Update</p>
            </a>
            <a href="../config/news_delete.php?id=<?php echo $item['id'] ?>">
                <p>Delete</p>
            </a>
        </div>
    </div>
<?php endforeach;
?>










<?php
// Setting attributes to an empty string for everything
$body = '';
// Just to let bootstrap show the error underneath
$bodyErr = '';


// Form submit
if (isset($_POST['submit'])) {

    // Validate body
    if (empty($_POST['body'])) {
        $bodyErr = 'Body is required';
    } else {
        // $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $body = filter_input(
            INPUT_POST,
            'body',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
    }

    if (empty($bodyErr)) {
        // add to database
        $sql = "INSERT INTO news (body) VALUES ('$body')";
        if (mysqli_query($conn, $sql)) {
            // success
            header('Location: news.php');
        } else {
            // error
            echo 'Error: ' . mysqli_error($conn);
        }
    }
}
?>



<h2>Add News Entry</h2>

<form method="POST" action="<?php echo htmlspecialchars(
                                $_SERVER['PHP_SELF']
                            ); ?>" class="mt-4 w-75">
    <div class="mb-3">
        <textarea class="form-control <?php echo !$bodyErr ?:
                                            'is-invalid'; ?>" id="body" name="body" placeholder="Enter your news entry"><?php echo $body; ?></textarea>
    </div>
    <div class="mb-3">
        <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
    </div>
</form>



<?php
include '../../components/footer.php';
