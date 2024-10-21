
<?php

$default = NULL; // sticky form default value
$defaultError = NULL; // supress error messages
$instrument = NULL; // for the radio button form list
$empty = NULL;
$email = NULL;
$activity = null;
$name = NULL;
$nameError = NULL;
$typeError = NULL;
$type = NULL;

$drumsChecked = NULL;
$pianoChecked = NULL;
$violinChecked = NULL;
$activity = NULL;
$guitarChecked = NULL;
$countAnimal = NULL;
$animal = NULL;
$animalError = NULL;
$animal1 = $animal2 = NULL; // variables used in the redirect
$animalError = NULL; // error for incorrect input by user
$animalList = NULL;
$state = NULL;
 // sticky form default value
$activityError = NULL; // supress error messages
$activityList = NULL; // for the radio button form list
$valid = false;



$animalArray = array('Dog', 'Cat', 'Hamster', 'Horse', 'Beaver', 'Rabbit');
foreach ($animalArray as $animalIndex => $animalName){
	$animalChecked[$animalIndex] = NULL;
}










if (isset($_POST['submit'])) {
    $valid = true;
    $name = htmlspecialchars($_POST['fname']);
    $nameTrim = trim($name);
    $nameUppercase = ucfirst($nameTrim);
   
    if (empty($name)) {
        $nameError = '<div class="alert alert-danger">Please provide a valid name.</div>';
        $valid = false;
    }
    $email = htmlspecialchars($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = '<div class="alert alert-danger">Invalid format <br> Please use @email .</div>';
    }
    if (empty($email)) {
        
      $defaultError = '<div class="alert alert-danger">Please enter an email address.</div>';
      $valid = false;
    }
    if (isset($_POST['type'])) {
      // if set, get the type. No need for htmlspecialchars here, since the user can only select a value we provided.
      $instrument = $_POST['type'];
    
      if ($instrument == "drums") {$drumsChecked = "checked";}
      if ($instrument == "guitar") {$guitarChecked = "checked";}
      if ($instrument == "piano") {$pianoChecked = "checked";}
      if ($instrument == "violin") {$violinChecked = "checked";}
      
    }
 else {
      $typeError = '<div class="alert alert-danger">Please click an instrument.</div>';
      $valid = false;
    }

  
    
    if (isset($_POST['animal'])){ // check to see if user selected any items
      $countAnimal = COUNT($_POST['animal']); // count number of items user selected
      foreach ($_POST['animal'] as $index => $animal) { // step through the form data
          $selectedAnimal[] = $animal; // create a new array of user selected items
          if (in_array($animal, $animalArray)) { // check to see if user selceted matches list
              $animalChecked[$index] = "checked"; // check any items user selected
          } // end if
      } // end foreach
      if ($countAnimal == 2){ // check to see if selected the appropriate number of items
          $animal1 = $selectedAnimal[0]; // set selected items to individual variables (optional)
          $animal2 = $selectedAnimal[1]; // set selected items to individual variables (optional)
      } else { // set error for inaccurate number of items
          $animalError = '<span class="text-danger">Must Select Only 2</span>';
          $valid = false;
      }
  } else { // set error for no selection
      $animalError = '<span class="text-danger">Required</span>';
      $valid = false;
  }

if( NULL != $_POST['state'] ) {
    $state = $_POST['state'];
     if ($state == "drums") {$drumsChecked = "checked";}
    if ($state == "guitar") {$guitarChecked = "checked";}
    if ($state == "piano") {$pianoChecked = "checked";}
    if ($state == "violin") {$violinChecked = "checked";}
  }
 


  else {
    $activityError = '<div class="alert alert-danger">Select an activity</div>';
    $valid = false;
  }
}





if ($valid) {

echo  <<<EOD

"Welcome ";
"$nameUppercase";
"<br><br>";
"Your email is "  .$email;
"<br><br>";


"Your favorite musical instrument is $instrument";
"<br><br>";
"Your favorite animals are ";
$animal1 ." and " .$animal2;
"<br><br>";
"Your favorite activity is $state";
"<br><br>";
EOD;


} else {

 
	foreach ($animalArray as $animalIndex => $animalName) {
		$animalList .= <<<HERE
		<input type="checkbox" name="animal[$animalIndex]" id="$animalIndex" value="$animalName" $animalChecked[$animalIndex]>
		<label for="$animalIndex">$animalName</label> \n
HERE;

  }
    

$pageContent = <<<HERE

<fieldset style= "text-align: center;" >
  <legend> php validation</legend>
  <form method="post" action="form-validation.php" class="col-lg-6 offset-lg-3">
    <p>$nameError
      <label for="fname">Enter your Name: </label>
      <br>
      <input type="text" name="fname" id="Name" value="$name">
    </p>
    <p>$defaultError $emailError
      <label for="email">Enter your email: </label>
      <br>
      <input type="text" name="email" id="Email" value="$email">
    </p>
    <p>
    </p>
    
    <p> <b>Click your favorite instrument: </b><p>
      <input type="radio" name="type" id="typedrums" value="drums" $drumsChecked>
      <label for="typecd">Drums</label>
      <input type="radio" name="type" id="typedguitar" value="guitar" $guitarChecked>
      <label for="typedl">Guitar</label>
	  <input type="radio" name="type" id="typepiano" value="piano" $pianoChecked>
      <label for="typepiano">Piano</label>
      <input type="radio" name="type" id="typedviolin" value="violin" $violinChecked>
      <label for="typedviolin">Violin</label>$typeError
    </p><br>

  
<div class="form-group">
		<label for="cars">Pick 2 of your favorite animals-- $animalError</label><br>
		$animalList
	</div>
	


    	 $activityError
      <p><b>  Select your favorite activity </b> </p>
            <select name="state" >
           <option name = "typex" value="" >---Please pick an activity---</option>
            <option name="typex" value ="football" $footballChecked>Football</option>
            <option name="typex"  value ="basketball" $basketballChecked>Basketball</option>
            <option name="typex"  value ="soccer" $soccerChecked>Soccer</option>
            <option name="typex" value ="baseball" $baseballChecked>Baseball</option>
            <option name="typex"  value ="swimming" $swimChecked>Swimming</option>
           
            </select>
			
			
		
        <p><p>
	
  
 <div class="form-group">
		<button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
	</div>
    </p>
  </form>
</fieldset>

HERE;

}





if(isset($_POST['submit'])){
	$pageContent .= "<pre>";
	
	$pageContent .= "</pre>";
}
$pageTitle = "Radio Button Validation";
include 'template.php';
?>