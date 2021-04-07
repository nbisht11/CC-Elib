<?php
include('db_config.php');
$id=($_GET['id']);
$query="SELECT * FROM `book_details` WHERE `book_details`.`Book_ID` = $id;";
$result=$conn->query($query);
$book=$result->fetch_assoc();
$path="C:/xampp/htdocs".$book['Book_Cover'];
unlink($path);
$query= "DELETE FROM `book_details` WHERE `book_details`.`Book_ID` = $id;";
if($conn->query($query)===TRUE)
{?>
  <script>
  alert("Book Deleted Successfully");
  window.location.href="book_list1.php";
  </script>
<?php
}
else
{?>
  <script>alert("Error in code");</script>
<?php
};
?>
