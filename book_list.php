<?php include('db_config.php')?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<style type="text/css">
  body
  {
    background-image: url(/CC-Elib/files/images/bg-blur.jpg);
  }
</style>
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
