
    <?php 
    
    
    
    
    $page_title = 'Welcome, to the form-invoice page'; 
    include('template.php');
    
   
    




  



$albumArray = array("Bad Bunny" => "Oasis");
$albumArray += ['Dr Dre' =>  "Chronic"] ;
$albumArray += ["Tupac" => "All Eyez on Me"];
$albumArray += ["Nas" => "Illmatic"];
$albumArray += ['Green Day' => 'Lonely Road'];
$albumArray += ['Adele' => '21'];
$albumArray += ['Kendrick Lamar' => 'DAMN'];
$albumArray += ['Jay-Z' => 'BluePrint'];
$albumArray += ['Nirvana' => 'Nevermind'];
$albumArray += ['Beatles' => 'The White Album'];



?>


<body style="text-align: center";>
<h3>Invoice form</h3>

<form method="POST" style = "border-style: solid; display: inline-block;"  class= "needs-validation" action="handle-invoice.php">
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


