<?php
include('db_config.php');
if(!isset($_POST['submit']))
{
  $id=($_GET['id']);
  $query="SELECT * FROM `book_details` WHERE `book_details`.`Book_ID` = $id;";
  $result=$conn->query($query);
  $book=$result->fetch_assoc();
}
?>
<?php
$errors = array('name'=>'','author'=>'','cover'=>'','description'=>'');
$error=0;
if(isset($_POST['submit']))
{
  $id=$_POST['bid'];
  $query="SELECT * FROM `book_details` WHERE `book_details`.`Book_ID` = $id;";
  $result=$conn->query($query);
  $book=$result->fetch_assoc();
  $name=$_POST['name'];
  $author=$_POST['author'];
  $description=$_POST['description'];
  $old_cover=$_POST['old_cover'];
  if(empty($name))
  {
    $errors['name'] = 'Book Name is required';
    $error=1;
  }
  // check author
  if(empty($author))
  {
    $errors['author'] = "Author's Name is required";
    $error=1;
  }
  if(strlen($description)>500)
  {
    $errors['description']= 'Book Description should be less than 250 characters';
    $error=1;
  }
  if($error==0)
  {
    if($_FILES['B_Cover']['size']!=0)
    {
      $path="C:/xampp/htdocs".$book['Book_Cover'];
      unlink($path);
      $cover_dir = "C:/xampp/htdocs/CC-Elib/files/Book_Covers/";
      $coverfile = $_FILES['B_Cover']['name'];
      $coverpath = pathinfo($coverfile);
      $covername = $coverpath['filename'];
      $coverext = $coverpath['extension'];
      $cover_temp_name = $_FILES['B_Cover']['tmp_name'];
      $cover_path_filename_ext = $cover_dir.$covername.".".$coverext;
      $cover_host_path="/CC-Elib/files/Book_Covers/".$covername.".".$coverext;
      $query="UPDATE `book_details` SET `Book_Name` = '$name', `Author_Name` = '$author',
      `Book_Description` = '$description', `Book_Cover` = '$cover_host_path'
      WHERE `book_details`.`Book_ID` = $id;";
      move_uploaded_file($cover_temp_name,$cover_path_filename_ext);
    }
    else
    {
      $query="UPDATE `book_details` SET `Book_Name` = '$name', `Author_Name` = '$author',
      `Book_Description` = '$description' WHERE `book_details`.`Book_ID` = $id;";
    }
    if($conn->query($query)===TRUE)
    {?>
      <script>
      alert("Book Updated Successfully");
      window.location.href = "book_detail.php?id=<?php echo($book['Book_ID'])?>";
      </script>
      <?php
    }
    else
    {
      echo($query);
      echo($conn->error);
      ?>
      <script>
      alert("Book Updation Failed");
      </script>
      <?php
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Book Information</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <style type="text/css">

  #form
    {
      background-color: #84e184;
      height: 100%;
      min-height:1000px;
      padding: 5px 40px 40px 40px;
    }
    body
    {
      background-image: url(/CC-Elib/files/images/bg-blur.jpg);
    }
    </style>

</head>
<body>
  <a href="book_detail.php?id=<?php echo($book['Book_ID'])?>"> <button type="button"  class="btn btn-success">
    <img src="files/images/back.png"; title="Back to BookShelf", height="30px" width="30px"></button></a>
  <div class="container">
    <div class="row-md-6 offset-3">
      <div class="col-md-8" id=form>
        <center> <b style="font-size: 55px; font-family: Agency FB; font-weight:700;">Edit Book Information</b></center>
  <form action="edit_book.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
    <label for="Book_Name">Book Name*:</label>
    <input class="form-control" type="text" name="name" value="<?php echo($book['Book_Name'])?>" required>
    <div><?php echo $errors['name']; ?></div>
    </div>
    <div class="form-group">
    <label for="Author_Name">Author Name*:</label>
    <input class="form-control" type="text" name="author" value="<?php echo($book['Author_Name'])?>" required>
    <div><?php echo $errors['author']; ?></div>
    </div>
    <div class="form-group">
    <label for="Book_Description">Book Description:</label>
    <textarea class="form-control" rows="8"
    name="description" maxlength="500"><?php echo($book['Book_Description'])?></textarea>
    <div><?php echo $errors['description']; ?></div>
    </div>
    <img src="<?php echo($book['Book_Cover'])?>" height="150px", width=auto>
    <div class="form-group">
    <label for="Book_Cover">Book Cover*:</label>
    <input class="form-control" type="file" name="B_Cover" accept=".jpeg, .png, .jpg">
    <div><?php echo $errors['cover']; ?></div>
    </div>
    <div style="display: none;">
      <input type="text" name="old_cover" value="<?php echo($book['Book_Cover'])?>">
      <input type="text" name="bid" value="<?php echo($book['Book_ID'])?>">
    </div>
    <input type="submit" name="submit" value="Update">
    <a href="book_detail.php/?id=<?php echo($book['Book_ID'])?>"><input type="button" value="Cancel"></a>
  </form>
</div>
</div>
</div>
</body>
</html>
