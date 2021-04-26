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
</head>
<?php
$pages='';
include('links.php'); 
include('db_config.php');
include('header.php');
if(isset($_GET['msg']))
{
  $msg=$_GET['msg'];
  include('show_alert.php');
}
$sql="SELECT COUNT(*) FROM `book_details`";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);
$pages = $row[0]/9;
if($pages<1)
$pages=1;
?>

<?php
if(isset($_GET['s']))
{
  $sql="SELECT * FROM `book_details` WHERE `Book_Name` LIKE '%".$_GET['s']."%' OR `Author_Name` LIKE  '%".$_GET['s']."%'";
}
else
{
  $para=$OrdBy=$sort='';
  if(isset($_GET['page']))
  {
    $page=$_GET['page']*8;
    $ofset=($_GET['page']-1)*8;
  }
  else
  {
    $page=1*8;
    $ofset=0;
  }
  if(isset($_GET['sort']))
  {
    if($_GET['sort']=='NAME_ASC')
    {
      $sort='NAME_ASC';
      $para='Book_Name';
      $OrdBy='ASC';
    }
    elseif($_GET['sort']=='NAME_DESC')
    {
      $sort='NAME_DESC';
      $para='Book_Name';
      $OrdBy='DESC';
    }
    elseif($_GET['sort']=='Date')
    {
      $sort='Date'; 
      $para='created_at';
      $OrdBy='DESC';
    }
    else
    {
      $sort='Date';
      $para='created_at';
      $OrdBy='DESC';
    }
  }
  else
  {
    $sort='Date';
    $para='created_at';
    $OrdBy='DESC';
  }
  $sql="SELECT * FROM `book_details` ORDER BY $para $OrdBy LIMIT $page OFFSET $ofset";
}
//echo($sql);
$result = $conn->query($sql);
?>
<?php if(!isset($_GET['s']))
{?>
<div class="dropdown text-right">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Sort
  </button>
  <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="index.php?sort=Date">Date Added(Newest First)</a>
    <a class="dropdown-item" href="index.php?sort=NAME_ASC">Name(A-Z)</a>
    <a class="dropdown-item" href="index.php?sort=NAME_DESC">Name(Z-A)</a>
  </div>
</div>
<?php
}?>
<div class="container">
  <div class=  "row justify-content-left" >
    <?php
    while($book=$result->fetch_assoc())
    {?>
      <div class="col-md-3 col-sm-12" style="margin-bottom:20px">
        <div class="card h-100">
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
<?php if(!isset($_GET['s']))
{?>
<nav aria-label="Page navigation" style="display:flex; justify-content:center">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="index.php?sort=<?php echo($sort)?>">First</a></li>
    <?php if($pages>1)
     {for($i=1; $i<=$pages; $i++) 
      {?>
      <li class="page-item"><a class="page-link" href="index.php?page=<?php echo($i)?>&sort=<?php echo($sort)?>"><?php echo($i)?></a></li>
      <?php 
      }
    }?>
    <li class="page-item"><a class="page-link" href="index.php?page=<?php echo($pages)?>&sort=<?php echo($sort)?>">Last</a></li>
  </ul>
</nav>
<?php
} ?>
<a href="add_book.php"> 
<button type="button"  class="btn btn-primary" style="position: fixed; bottom: 50px; right: 50px; border-radius: 50%;">
<img src="files/images/path10.png"; title="Add New Book" height="100px" width="100px">
</button>
</a>
</div>
<?php include('footer.php')?>
</body>
</html>
