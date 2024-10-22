<?php

$college = "Dallas College, 1601 Botham Jean Blvd, Dallas, TX 75215";
$Welcome = "welcome, Guest ";

$Head = <<<HERE
<!DOCTYPE html>
<html lang="en">


<head>
   
  <title>$pagetitle</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<header>
    <div class="container">
        <div class="page-header">
          <h1>$pageTitle</h1>
          <br>
          <h3> $Welcome</h3>      
        </div>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">PhP NavBar</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="template.php">Home</a></li>
      
      
      <li><a href="invoice.php">invoice</a></li>
      <li><a href="form-validation.php">validation</a></li>
      <li><a href="file-uploads.php">file uploads</a></li>
    </ul>
  </div>
</nav>


</header>
 


<div class="container">


HERE;

echo $Head;
echo $pageContent;

echo <<<HERE

</div>
    <footer class="footer fixed-bottom">
        <div class="container text-center">
            <span class="text-white">
                Randall Kopp $college 
            </span>
        </div>
    </footer>

</body>
</html>
HERE;
?>