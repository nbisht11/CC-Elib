<?php
include __DIR__ . '/config/db_config.php';;
$id=($_GET['id']);
$query="SELECT * FROM `book_details` WHERE `book_details`.`Book_ID` = $id;";
$result=$conn->query($query);
$book=$result->fetch_assoc();
$path="C:/xampp/htdocs".$book['Book_Cover'];
unlink($path);
$query= "DELETE FROM `book_details` WHERE `book_details`.`Book_ID` = $id;";
if($conn->query($query)===TRUE)
{
  header("Location: index.php?msg=Book Deleted Successfully");
  exit();
}
else
{
  header("Location: index.php?msg=Error in code");
  exit();
};
?>
