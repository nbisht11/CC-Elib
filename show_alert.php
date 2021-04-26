<?php 
include('links.php');
if (isset($_GET['msg'])) 
    {?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong><?php echo $_GET['msg']?></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <?php 
    } 
?>