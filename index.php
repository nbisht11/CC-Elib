<!DOCTYPE html>
<html>
<head>
  <title> CC E-Library </title>
  <link rel="stylesheet" href="/CC-Elib/style/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body style="background-color: lightblue;">
<a href="index.php"><p ><img  width=auto; height=40px; src="/CC-Elib/files/images/logo.png"></img>
  <img width=auto; height=61px; src="/CC-Elib/files/images/logo1.png"></img></p></a>
<div class="embed-responsive embed-responsive-16by9">
  <iframe name= "bdy" class="embed-responsive-item" src="/CC-Elib/book_list.php"  frameborder="0" style="overflow: hidden;
  height: 100%; width: 99%; position: absolute; left: 10px; right: 10px;">
</iframe>
<a href="add_book.php" target="bdy"> <button type="button"  class="btn btn-primary" style="position: absolute; bottom: 50px; right: 50px; border-radius: 50%;"><img src="files/images/path10.png";
  title="Add New Book" height="100px" width="100px" href="add_book.php"></button></a>
</div>
<div class="footer"> Copyright 2021 ColoredCow </div>
</body>
</html>
