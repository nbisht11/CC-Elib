<!DOCTYPE html>
<html>
<head>
  <title> CC E-Library </title>
  <style type="text/css">
  body
  {
    background-image: url(/CC-Elib/files/images/bg-blur.jpg);
  }
  </style>
  <link rel="stylesheet" href="/CC-Elib/style/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<?php include('db_config.php');
include('header.php');?>
<?php
$sql="SELECT * FROM `book_details` ORDER BY created_at DESC;";
$result = $conn->query($sql);
?>
<div class="container">
  <div class=  "row" >
    <?php
    while($book=$result->fetch_assoc())
    {?>
      <div class="col s12 m4" style="margin-bottom:20px">
        <div class="card" style="width: 250px; height: 500px">
            <img class="card-img-top" src="<?php echo $book['Book_Cover']?>" width=240px height="360px" >
            <div class='card-body'>
              <h4 class ='card-title' style="color:black;"><?php echo $book['Book_Name']?></h4>
              <h5 class='card-text' style="color:black;"><?php echo $book['Author_Name']?></h5>
              <a class="card-link" href="book_detail.php?id=<?php echo($book['Book_ID'])?>" target="_top"><p> Read More....</p></a>
            </div>
      </div>
    </div>
    <?php
  }
  ?>
  </div>
</div>
<a href="add_book.php" target="bdy"> 
<button type="button"  class="btn btn-primary" style="position: fixed; bottom: 50px; right: 50px; border-radius: 50%;">
<img src="files/images/path10.png"; title="Add New Book" height="100px" width="100px">
</button>
</a>
</div>
<div class="footer"> Copyright 2021 ColoredCow </div>
</body>
</html>
