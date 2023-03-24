<!DOCTYPE html>
<html>
<head>
  <title> CC E-Library </title>
</head>
<?php
$pages='';
$type='index';
include __DIR__ . '/config/db_config.php';
include __DIR__ . '/templates/header.php';
if(isset($_GET['msg']))
{
  $msg=$_GET['msg'];
  include('show_alert.php');
}
$sql="SELECT COUNT(*) FROM `book_details`";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);
$pages = ceil($row[0]/8);
if($pages<1)
$pages=1;
if(isset($_GET['s']))
{
  $sql="SELECT * FROM `book_details` WHERE `Book_Name` LIKE '%".$_GET['s']."%' OR `Author_Name` LIKE  '%".$_GET['s']."%'";
  $result = $conn->query($sql);
  $row = $result->num_rows;
  if($row==0)
  {
    header("Location: index.php?msg=Nothing Found For the search");
    exit();
  }
  $pages = ceil($row/8);
  if($pages<1)
  {
    $pages=1;
  }
  $page=8;
  if(isset($_GET['page']))
  {
    $ofset=($_GET['page']-1)*8;
  }
  else
  {
    $ofset=0;
  }
  $sql="SELECT * FROM `book_details` WHERE `Book_Name` LIKE '%".$_GET['s']."%' OR `Author_Name` LIKE  
  '%".$_GET['s']."%' LIMIT $page OFFSET $ofset";

}
else
{
  $page=8;
  $para=$OrdBy=$sort='';
  if(isset($_GET['page']))
  {
    $ofset=($_GET['page']-1)*8;
  }
  else
  {
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
$result = $conn->query($sql);
?>
<body>
  <?php if(!isset($_GET['s']))
  {?>
  <nav aria-label="Page navigation" class="pgn">
    <ul class="pagination">
      <li class="page-item"><a class="page-link" href="index.php?sort=<?php echo($sort)?>">First</a></li>
      <?php if($pages>1)
      {for($i=2; $i<=$pages-1; $i++) 
        {?>
          <li class="page-item"><a class="page-link" href="index.php?page=<?php echo($i)?>&sort=<?php echo($sort)?>"><?php echo($i)?></a></li>
          <?php 
        }
      }?>
      <li class="page-item"><a class="page-link" href="index.php?page=<?php echo($pages)?>&sort=<?php echo($sort)?>">Last</a></li>
    </ul>
  </nav>
  <?php
  } 
  else
  {?>
  <nav aria-label="Page navigation" class="pgn">
    <ul class="pagination">
      <li class="page-item"><a class="page-link" href="index.php?s=<?php echo($_GET['s'])?>">First</a></li>
      <?php if($pages>1)
      {for($i=2; $i<=$pages-1; $i++) 
        {?>
          <li class="page-item"><a class="page-link" href="index.php?page=<?php echo($i)?>&s=<?php echo($_GET['s'])?>"><?php echo($i)?></a></li>
          <?php 
        }
      }?>
      <li class="page-item"><a class="page-link" href="index.php?page=<?php echo($pages)?>&s=<?php echo($_GET['s'])?>">Last</a></li>
    </ul>
  </nav>
  <?php 
  }
  ?>
    <a href="add_book.php"> 
      <button type="button"  class="btn adb">
        <img src="files/images/path10.png"; title="Add New Book" height="70%" width="70vh">
      </button>
    </a>
  </div>
  <?php include __DIR__ . '/templates/footer.php';?>
  </body>
</html>
