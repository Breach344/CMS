<?php
session_start();

include("news_con.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM TABLENAME WHERE id=$id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);

        $body = $row['body'];
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];

    $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    $query = "UPDATE TABLENAME set 
      body = '$body'
       WHERE id=$id";
    mysqli_query($conn, $query);
    $_SESSION['message'] = 'Data Updated';
    $_SESSION['message_type'] = 'Warning';
    header('Location: ../news.php');
}
include '../../components/header.php';

?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="news_edit.php?id=<?php echo $_GET['id']; ?>" method="POST">

                    <div class="form-group">
                        <input name="body" type="text" class="form-control" value="<?php echo $body; ?>" placeholder="Update Body">
                    </div>

                    <button class="btn-success" name="update">
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include '../../components/footer.php';
