<?php
include('db_config.php');
include('links.php');
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
  $name=mysqli_real_escape_string($conn,$_POST['name']);
  $author=mysqli_real_escape_string($conn,$_POST['author']);
  $description=mysqli_real_escape_string($conn,$_POST['description']);
  $old_cover=mysqli_real_escape_string($conn,$_POST['old_cover']);
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
    $errors['description']= 'Book Description should be less than 500 characters';
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
    {
      header("Location:book_detail.php?id=".$id."&msg=Book Updated Successfully");
      exit();
    }
    else
    {
      echo($query);
      echo($conn->error);
      header("Location:book_detail.php?id=".$id."&msg=Book Updatiom Failed");
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Book Information</title>
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
<?php include('header.php')?>
  <a href="book_detail.php?id=<?php echo($book['Book_ID'])?>"> <button type="button"  class="btn btn-success">
    <img src="files/images/back.png"; title="Back to BookShelf", height="30px" width="30px"></button></a>
  <div class="container">
    <div class="col-sd-4 col-sm-12 align-self-center" id=form>
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
      <input type="submit" class="btn btn-primary" name="submit" value="Update">
      <a href="book_detail.php?id=<?php echo($book['Book_ID'])?>"><input type="button" class="btn btn-secondary" value="Cancel"></a>
      </form>
    </div>
  </div>
  <?php include('footer.php')?>
</body>
</html>
