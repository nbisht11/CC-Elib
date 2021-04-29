<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/CC-Elib/style/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
<?php
if($type=='index')
{?>
    <nav class="navbar navbar-light navbar-expand-md bg">
        <div class="container">
           
            <a class="navbar-brand" href="index.php">
                <img src="/CC-Elib/files/images/logo1.png";  class="rounded"; height=40px; width=100px; title="BookShelf";>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
                aria-expanded="false" aria-controls="navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto"></ul>
                <form action="index.php" method="GET">
                    <div class="input-group">
                        <input  type="text" name='s' class="form-control" placeholder="Search" value=
                        "<?php if(isset($_GET['s'])) echo($_GET['s'])?>">
                            <div class="input-group-append">                        
                            <button class="btn btn-primary mr-3" type="submit"><i class="bi bi-search"></i></button>
                                <?php 
                                if(isset($_GET['s']))
                                {?>
                                    <a href="index.php">
                                        <button type="button" class="btn btn-light close mr-3" data-dismiss="form-control" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </a>
                                    <?php
                                }
                                else
                                {?>
                                    </div>
                                        <div class="dropdown text-left">
                                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" 
                                            aria-haspopup="true" aria-expanded="false">Sort
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="index.php?sort=Date">Date Added(Newest First)</a>
                                                <a class="dropdown-item" href="index.php?sort=NAME_ASC">Name(A-Z)</a>
                                                <a class="dropdown-item" href="index.php?sort=NAME_DESC">Name(Z-A)</a>
                                            </div>
                                        <div>
                                    </div><?php
                                }?>
                </form>
            </div>
        </div>
    </nav>
<?php
}
else
{?>
    <nav class="navbar navbar-light navbar-expand-md bg">
    <div class="container">
        <div class="bbtn">
            <button type="button"  class="btn bg" onclick="goBack()">
                <img src="files/images/back.png"; title="Back" height="30%" width="30vh">
            </button>
        </div>
        <a class="navbar-brand" href="index.php">
            <img src="/CC-Elib/files/images/logo1.png";  class="rounded"; height=40px; width=100px; title="BookShelf";>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
            aria-expanded="false" aria-controls="navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto"></ul>
            <form action="index.php" method="GET">
                <div class="input-group">
                    <input  type="text" name='s' class="form-control" placeholder="Search">
                        <div class="input-group-append">                        
                        <button class="btn btn-primary mr-3" type="submit"><i class="bi bi-search"></i></button>
                            <?php 
                            if(isset($_GET['s']))
                            {?>
                                <a href="index.php">
                                    <button type="button" class="btn btn-light close mt-2 mr-3" data-dismiss="form-control" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                                <?php
                            }?>
                        </div>
                </div>
            </form>
        </div>
    </div>
</nav>
<?php
}
?>