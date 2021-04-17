<?php
include ('db_config.php');
$id=($_GET['id']);
$query="SELECT * FROM `book_details` WHERE `book_details`.`Book_ID` = $id;";
$result=$conn->query($query);
$book=$result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Book Details</title>
  <style type="text/css">
  body
  {
    background-image: url(/CC-Elib/files/images/bg-blur.jpg);
  }
  </style>

</head>
<a href="index.php" target="_top"> <button type="button"  class="btn btn-success"><img src="files/images/back.png";
  title="Back to BookShelf" height="30px" width="30px"></button></a>
<div class="card mb-3" style="background-color: grey; width: auto; height: auto; margin-left:10%;margin-right: 10%;margin-top:2%">
  <div class="row">
    <div class="col-md-4">
      <img class="card-img-left" src="<?php echo($book['Book_Cover'])?>"; width=100%; height=auto >
        <div class="card-footer text-center">
          <a href="edit_book.php?id=<?php echo($book['Book_ID'])?>">
            <button class="btn btn-primary float-left" style="word-wrap: break-word;">Edit Book Details</button></a>
          <a href="remove_book.php?id=<?php echo($book['Book_ID'])?>" target="_top" title="Remove Book" input type="submit" name="Delete"
            onClick='return confirm("Are you sure you want Delete this Book?")'>
              <button class="btn btn-danger float-right" style="word-wrap: break-word;" type="button">Delete Book </button></a>
          </div>
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h1 class="card-title"><?php echo($book['Book_Name']);?></h1>
        <h3 class="card-text"><?php echo($book['Author_Name']);?></h3><br>
        <p class="card-text"><?php echo($book['Book_Description']);?></p>
      </div>
    </div>
  </div>
</div>
</html>
