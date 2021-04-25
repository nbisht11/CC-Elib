<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/CC-Elib/style/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<nav class="navbar navbar-default" style ="height:60px; width: auto; background-color: lightblue;">
  <div class="container-fluid" >
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">
      <img src="/CC-Elib/files/images/logo.png" class="rounded float-left"; height=40px; width=100px; title="BookShelf"; align=left>
      </a>
    </div>
    <ul class="nav navbar-nav">
    <form action="index.php" method="GET">
    <div class="input-group">
      <input type="text" class="form-control" name="search" placeholder="Search">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Search</button>
      </span>
    </div>
    </form>
    </ul>
  </div>
</nav>

<nav class="navbar navbar-fixed-top" style ="height:60px; width: auto; background-color: lightblue;">
    <div class="container topnav">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">
      <img src="/CC-Elib/files/images/logo1.png";  class="rounded"; height=40px; width=100px; title="BookShelf";>
      </a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
      <form class="form-inline">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-light my-sm-0" type="submit">Search</button>
    </form>
      </div>
    </div>
  </nav>
  <div class="dropdown text-right">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Sort
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="index.php?sort=Date">Date Added(Newest First)</a>
    <a class="dropdown-item" href="index.php?sort=NAME_ASC">Name(A-Z)</a>
    <a class="dropdown-item" href="index.php?sort=NAME_DESC">Name(Z-A)</a>
  </div>
</div>