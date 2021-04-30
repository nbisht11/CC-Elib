<?php
include __DIR__ . '/config/db_config.php';;
$id=($_GET['id']);
$query="SELECT * FROM `book_details` WHERE `book_details`.`Book_ID` = $id;";
$result=$conn->query($query);
$book=$result->fetch_assoc();
$type='detail';
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Book Details</title>
  </head>
  <?php include __DIR__ . '/templates/header.php';
  if(isset($_GET['msg']))
  {
    $msg=$_GET['msg'];
    include('show_alert.php');
  }
  ?>
  <div class="bdtlcrd card mb-3">
    <div class="row">
      <div class="col-md-4">
        <img class="card-img-left" src="<?php echo($book['Book_Cover'])?>"; width=100%; height=auto >
          <div class="card-footer text-center">
            <a href="edit_book.php?id=<?php echo($book['Book_ID'])?>">
              <button class="btn btn-primary float-left">Edit Book Details</button></a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#delete">Delete Book
                </button>
                <!-- Modal -->
                <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="DeleteModalLabel">Delete Book</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                        Are you sure, you want to delete this book?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <a href="remove_book.php?id=<?php echo($book['Book_ID'])?>">
                        <button type="button" class="btn btn-danger">Delete</button></a>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h1 class="card-title"><?php echo($book['Book_Name']);?></h1>
            <h3 class="card-text"><?php echo($book['Author_Name']);?></h3><br>
            <p class="card-text"><?php echo nl2br($book['Book_Description']);?></p>
          </div>
        </div>
    </div>
  </div>
<?php include __DIR__ . '/templates/footer.php';?>
</html>
