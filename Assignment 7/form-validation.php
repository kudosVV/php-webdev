


<?php



$email = NULL;
$instrument = NULL;
$name = NULL;
$nameError = NULL;
$typeError = NULL;
$type = NULL;
$invalid_email_format = NULL;
$invalid_email = NULL;
$activity = NULL;
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
$instrumentArray = array("drums", "guitar", "piano", "violin", "bassist");
foreach($instrumentArray as $instrumentName) {
  $isntrumentChecked[$instrumentName] = NULL;
}
$activityArray = array("soccer", "swimming", "basketball", "baseball", "wrestling");
foreach($activityArray as $activityName) {
  $activityChecked[$activityName] = NULL;
}
 









if (isset($_POST['submit'])) {
  $valid = true;
  if (empty($_POST['fname'])) {
      $invalid_fname = '<div class="alert alert-danger">Please enter a valid first name</div>';
      $valid = false;
  } else {
      $fname = ucfirst(htmlspecialchars(trim($_POST['fname'])));
  }
  if (empty($_POST['email'])) {
    $invalid_email = '<div class="alert alert-danger">Please enter a valid email</div>';
    $valid = false;
} else {
    $email = trim($_POST['email']);
    // validate email using a regular expression
    if (!preg_match('/[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}/', $email)) {
        // returns 1 (true) for match, 0 (false) for no match
        $invalid_email_format = '<div class="alert alert-danger">Invalid email format</div>';
        $valid = false;
    }
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
      $animalError = '<div class="alert alert-danger">Only select 2 please</div>';
      $valid = false;
  }
} else { // set error for no selection
  $animalError = '<div class="alert alert-danger">Must select 2 animals</div>';
  $valid = false;
}

if(empty($_POST['activity'])) {
  $activityError = '<div class="alert alert-danger">Select an activity</div>';
 $valid = false;
} else {
    $activity= $_POST['activity'];
    if (in_array($activity, $activityArray)) { // check to see if user selceted matches list
     $activityChecked[$activity] = "selected"; 
 
}

}

if (!isset($_POST['instrument'])) {
  // if set, get the type. No need for htmlspecialchars here, since the user can only select a value we provided.

   $typeError = '<div class="alert alert-danger">Please click an instrument.</div>';
  $valid = false;


 
}  else {


  $instrument = $_POST['instrument'];
  if (in_array($instrument, $instrumentArray)) { // check to see if user selceted matches list
    $instrumentChecked[$instrument] = "checked";
}
}
  
} 


if ($valid) {

$pageContent = <<<HERE

"Welcome $fname ";

"<br><br>";
"Your email is "  .$email;

 
"<br><br>";

"Your favorite musical instrument is $instrument";
"<br><br>";
"Your favorite animals are ";
$animal1 ." and " .$animal2;

"<br><br>";
"Your favorite activity is $activity";

 
HERE;



} else {

 
	foreach ($animalArray as $animalIndex => $animalName) {
		$animalList .= <<<HERE
		<input type="checkbox" name="animal[$animalIndex]" id="$animalIndex" value="$animalName" $animalChecked[$animalIndex]>
		<label for="$animalIndex">$animalName</label> \n
HERE;

  }
  foreach($instrumentArray as $instrumentName) {
    $instrumentList .= <<<HERE
  <input type="radio" name="instrument"  value="$instrumentName" $instrumentChecked[$instrumentName]>
    <label for="$instrument">$instrumentName</label>&emsp;\n


HERE;
  }

  foreach($activityArray as $activityName) {
    $activityList .= <<<HERE
    <option value="$activityName" $activityChecked[$activityName]>$activityName</option>\n
    HERE;
  }


    

$pageContent = <<<HERE

<fieldset style= "text-align: center;" >
  <legend> php validation</legend>
  <form action="form-validation.php" method= "post"  class="col-lg-6 offset-lg-3">
  <div class="form-group">
			<label for="fname">Enter your name: </label>
			<input type="text" name="fname" id="fname" value="$fname" class="form-control"> $invalid_fname
		</div>
<div class="form-group">
			<label for="email">Enter your email: </label>
			<input type="text" name="email" id="email" value="$email" class="form-control"> $invalid_email $invalid_email_format
		</div>

    <div class="form-group">
   <label for "instrument">Favorite Instrument - Pick 1 $typeError</label><br>
   $instrumentList
</div>
  
<div class="form-group">
		<label for="cars">Pick 2 of your favorite animals-- $animalError</label><br>
		$animalList
	</div>
	

<div class="form-group">
    	
     <label for="activity"> Select your favorite activity  $activityError</label><br>
           <select name="activity">Favorite Activity" class="form-control">
           <option value=""&larr; Please Select an Activity &rarr;</option>
           $activityList
           
            </select>
			
		</div>	
		
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
	$pageContent .= print_r($_POST, TRUE);
	$pageContent .= "</pre>";
}
$pageTitle = "form-validation page";
include 'template.php';
?>