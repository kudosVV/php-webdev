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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <style>
.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: black;
   color: white;
   text-align: center;
}
</style>
</head>
<header>
    <div class="container">
        <div class="page-header">
          <h1>$pageTitle</h1>
          <br>
          <h3> $Welcome</h3>      
        </div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="template.php">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="invoice.php">invoice</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="form-validation.php">validation</a>
         <li class="nav-item">
        <a class="nav-link" href="file-uploads.php">FileUpload</a>
         <li class="nav-item">
        <a class="nav-link" href="calendar.php">Calendar</a>
         <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
         <li class="nav-item">
        <a class="nav-link" href="profile.php">Profile</a>
      </li>
         <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
    </ul>
  </div>
</header>
<div class="container">



HERE;








$footer = <<<HERE
<div class="footer">
  <p>Randall Kopp $college</p>
  </div>
</div>
HERE;
echo $Head;
echo $pageContent;
echo $footer;


?>