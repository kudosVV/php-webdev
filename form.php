<!DOCTYPE html>
<html>
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

<?php

$albumArray = array("Beatles" => "Abbey Road");
$albumArray += ['Dr Dre' =>  "Chronic"] ;
$albumArray += ["Tupac" => "All Eyez on Me"];
$albumArray += ["Nas" => "Illmatic"];
$albumArray += ['Green Day' => 'Lonely Road'];



?>
<h1>Display Radio Buttons</h1>

<form method="POST" class= "needs-validation" action="handle-form.php">
   <label for="fname">First name</label><br>
  <input type="text" id="fname" name="fname" value="enter your name" required><br>


</select>
<br><br>
<select class="form-select" aria-label="Default select example" name="albumPicked" required>
  <option selected>Pick the albums you want </option>
  <?php
foreach($albumArray as $value => $key):
echo '<option value='. $key.'>'. $value. '-'. $key.'</option>'; 
endforeach;
?>
</select>
<br>
<br>
<label for="albumnumber">Number of albums: </label><br>
  <input type="text" id="numAlbums" name="num" value="# of albums you want.." required><br>
     <p>Choose between CD or download:</p>
     <div class="form-check">
  <input class="form-check-input"  type="radio" id="cd" name="flexRadioDefault" value="CD" >
  <label class="form-check-label"  for="flexRadioDefault1">CD</label><br>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" id="download" name="flexRadioDefault" value="Download" checked>
  <label class="form-check-label"  for="flexRadioDefault2">Download</label>
  
</div>
  <br><br>
  
  <input type="submit" value="Submit">
 
</form> 



</body>
</html>