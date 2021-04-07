<?php
$errors = array('name'=>'','author'=>'','cover'=>'','description'=>'','file'=>'');
$error=0;
if(isset($_POST['submit']))
{
  $ISBN=$_POST['ISBN'];
  $name=$_POST['name'];
  $author=$_POST['author'];
  $description=$_POST['description'];
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
  // check ISBN
  if(strlen($description)>250)
  {
    $errors['description']= 'Book Description should be less than 250 characters';
    $error=1;
  }
  if($_FILES['B_Cover']['size']==0)
  {
    $errors['cover']= 'Book Cover is required';
    $error=1;
  }
  if($error==0)
  {
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
    }
    else
    {
      include('db_config.php');
      $query="INSERT INTO `book_details` (`Book_ID`, `ISBN`, `Book_Name`, `Author_Name`, `Book_Description`, `Book_Cover`, `Book_File`)
      VALUES (NULL,'$ISBN','$name','$author','$description','$cover_host_path','');";
      $conn->query($query);
      move_uploaded_file($cover_temp_name,$cover_path_filename_ext);
      ?>
      <script>
        alert("Book Added Successfully");
        window.location.href = "book_list1.php";
      </script>
      <?php
    }
  }
  else
  {
    echo "Error in the form";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add New Book</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <style type="text/css">

  #form
    {
      background-color: #84e184;
      height: 100%;
      min-height:800px;
      padding: 5px 40px 40px 40px;
    }
    body
    {
      background-image: url(/CC-Elib/files/images/bg-blur.jpg);
    }
    </style>

</head>
<body>
  <div class="container">
    <div class="row-md-6 offset-3">
      <div class="col-md-8" id=form>
        <center> <b style="font-size: 55px; font-family: Agency FB; font-weight:700;">Add New Book</b></center>
  <form action="add_book.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
    <label for="ISBN">Book ISBN:</label>
    <input class="form-control" type="text" name="ISBN">
    </div>
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
    <textarea class="form-control" rows="8" name="description" maxlength="250"
    placeholder="Write Book Description in less than 250 characters"></textarea>
    <div><?php echo $errors['description']; ?></div>
    </div>
    <div class="form-group">
    <label for="Book_Cover">Book Cover*:</label>
    <input class="form-control" type="file" name="B_Cover" accept=".jpeg, .png, .jpg" required>
    <div><?php echo $errors['cover']; ?></div>
    </div>
    <div class="form-group">
    <label for="Book_File">Book File:</label>
    <input class="form-control" type="text" name="Book_File">
    </div>
    <input type="submit" name="submit" value="Add Book">
    <a href="index.php" target="_top"><input type="button" value="Cancel"></a>
  </form>
</div>
</div>
</div>
</body>
</html>
