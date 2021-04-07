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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <style type="text/css">
  body
  {
    background-image: url(/CC-Elib/files/images/bg-blur.jpg);
  }
  </style>

</head>
<a href="index.php"><input type="submit" name="submit" value="Back to BookShelf"></a>
<div class="card mb-3" style="background-color: grey; width: auto; height: auto; margin-left:10%;margin-right: 10%;margin-top:5%">
  <div class="row">
    <div class="col-md-4">
      <img class="card-img-left" src="<?php echo($book['Book_Cover'])?>"; width="340px" height="450px" >
      <a href="edit_book.php?id=<?php echo($book['Book_ID'])?>" title="Edit Book Information"><img src="/CC-Elib/files/images/edit.png" widtht=30px height=30px
        style="float: right;border: 2px solid black;border-radius: 3px; position: absolute; top: 10px; right: 100px;"></a>
      <a href="remove_book.php?id=<?php echo($book['Book_ID'])?>" title="Remove Book" input type="submit" name="Delete" onClick='return confirm("Sure you want Delete this Book?")'>
      <img src="/CC-Elib/files/images/remove.jpg" widtht=30px height=30px
        style="float: right; border: 2px solid black;border-radius: 3px;position: absolute; top: 10px; right: 68px; "></a>

    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h1 class="card-title"><?php echo($book['Book_Name']);?></h1>
        <h3 class="card-text"><?php echo($book['Author_Name']);?></h3><br>
        <p class="card-text"><?php echo($book['Book_Description']);?></p>
        <a class="btn btn-success" href="<?php $p="https://"; echo($p.$book['Book_File'])?>" target="_blank">Read Here</a>
      </div>
    </div>
  </div>
</div>
</html>
