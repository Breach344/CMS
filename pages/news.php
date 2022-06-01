<?php
session_start();

include '../components/header.php';
include 'config/news_con.php';
include("config/functions.php");

news_in();

$sql = 'SELECT * FROM news ORDER BY date DESC LIMIT 3';

$result = mysqli_query($conn, $sql);

$news = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>


<h2>News</h2>



<?php if (empty($news)) : ?>
    <p class="lead mt-3">There are no news entries</p>
<?php endif; ?>



<?php foreach ($news as $item) : ?>
    <div class="card my-3 w-75">
        <div class="card-body text-center">
            <?php echo $item['body']; ?>
        </div>
    </div>
<?php
endforeach;
include '../components/footer.php';
?>