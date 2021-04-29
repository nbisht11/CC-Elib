<?php
include __DIR__ . '/config/db_config.php';
$errors = array('name'=>'','author'=>'','cover'=>'','file'=>'','description'=>'');
$error=0;
$type='add_book';
if(isset($_POST['submit']))
{
  $name=mysqli_real_escape_string($conn,$_POST['name']);
  $author=mysqli_real_escape_string($conn,$_POST['author']);
  $description=mysqli_real_escape_string($conn,$_POST['description']);
  $sql="SELECT * FROM `book_details` WHERE `Book_Name` = '$name' AND `Author_Name` = '$author'";
  $result = $conn->query($sql);
  $row = mysqli_fetch_array($result);
  if($row[0]!=0)
  {
    header("Location: add_book.php?msg=Book Already Present");
    exit();
  }
  else
  {
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
    // check Description
    if(strlen($description)>500)
    {
      $errors['description']= 'Book Description should be less than 500 characters';
      $error=1;
    }
    if($_FILES['B_Cover']['size']==0)
    {
      $errors['cover']= 'Book Cover is required';
      $error=1;
    }
    if($error==0)
    {
      $t=time();
      $dt=date("Y-m-d H:i:s",$t);
      $cover_dir = "C:/xampp/htdocs/CC-Elib/files/Book_Covers/";
      $coverfile = $_FILES['B_Cover']['name'];
      $coverpath = pathinfo($coverfile);
      $covername = $coverpath['filename'];
      $coverext = $coverpath['extension'];
      $cover_temp_name = $_FILES['B_Cover']['tmp_name'];
      $cover_path_filename_ext = $cover_dir.$covername.".".$coverext;
      $cover_host_path="/CC-Elib/files/Book_Covers/".$covername.".".$coverext;
      // Check if file already exists
      if (file_exists($cover_path_filename_ext))
      {
        $errors['file']= "Sorry, Cover file already exists.";
        header('Location: add_book.php?msg=Error in the form');
        exit();
      }
      else
      {
        include('db_config.php');
        $query="INSERT INTO `book_details` (`Book_ID`, `Book_Name`, `Author_Name`, `Book_Description`, `Book_Cover`,`created_at`)
        VALUES (NULL,'$name','$author','$description','$cover_host_path','$dt');";
        echo($query);
        if($conn->query($query)===TRUE)
        {
          move_uploaded_file($cover_temp_name,$cover_path_filename_ext);
          $query="SELECT * FROM `book_details` WHERE Book_Name = '$name' AND Author_Name = '$author';";
          echo($query);
          $result=$conn->query($query);
          $book = $result->fetch_assoc();
          $id = $book['Book_ID'];
          header('Location: book_detail.php?msg=Book Added Successfully&id='.$id);
          exit();
        }
      /*else
      {
        echo ($conn->error);
      }*/
      }
    }
    else
    {
      header('Location: add_book.php?msg=Error in the form');
      exit();
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add New Book</title>
</head>
<body>
  <?php include __DIR__ . '/templates/header.php';
  if(isset($_GET['msg']))
  {
    $msg=$_GET['msg'];
    include('show_alert.php');
  }
  ?>

  <div class="container">
    <div class="col-sd-4 md-4 align-self-center" id=form>
      <center> <b class="hdng">Add New Book</b></center>
      <form action="add_book.php" method="POST" enctype="multipart/form-data">
       <div class="form-group">
          <label for="Book_Name">Book Name*:</label>
          <input class="form-control" type="text" name="name" required>
          <div><?php echo $errors['name']; ?></div>
        </div>
        <div class="form-group">
          <label for="Author_Name">Author Name*:</label>
          <input class="form-control" type="text" name="author" required>
          <div><?php echo $errors['author']; ?></div>
        </div>
        <div class="form-group">
          <label for="Book_Description">Book Description:</label>
          <textarea class="form-control" rows="8" name="description" maxlength="500"
          placeholder="Write Book Description in less than 500 characters"></textarea>
          <div><?php echo $errors['description']; ?></div>
        </div>
        <div class="form-group">
          <label for="Book_Cover">Book Cover*:</label>
          <input class="form-control" type="file" name="B_Cover" accept=".jpeg, .png, .jpg" required>
          <div><?php echo $errors['file']; ?></div>
        </div>
        <input type="submit" name="submit" class="btn btn-primary" value="Add Book">
        <a href="index.php"><input type="button" class="btn btn-secondary" value="Cancel"></a>
      </form>
    </div>
  </div>
<?php include __DIR__ . '/templates/footer.php';?>
</body>
</html>
