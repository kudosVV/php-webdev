



<!DOCTYPE html>
<html lang="en">





<head> 
   
    

    <script>

    function checkform(maxPicks) {
  maxPicks = maxPicks || 2; //default

  //make sure all picks have a checked value
  var checkedCount = 0;
  var allR = document.getElementsById('checkboxgroup').setAttribute('max', 2);

  for(var i = 0; i < $animal.length; i++) {
    var rad = $animal[i];

    if (rad.checked) checkedCount++;
  }

  if (checkedCount < maxPicks) {
    return confirm('Not all picks entered... Submit anyway?');
  } else if (checkedCount > maxPicks) {
    alert('You may only choose up to ' + maxPicks + ' picks.');
    return false;
  }
  return true;
}
</script>

<script>
    checkform();
</script>
 

    <?php 
    $page_title = "Validation form site ";
    include('template.php');


    

$options = array(
    "Basketball",
    "Football",
    "Soccer",
    "Poker",
    "Swimming"
);


    ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


        


</head>
<body>

    <div class="container" >
    
        <h2>Basic Web Form with php</h2>
        <form method = "POST" action ="validationform.php" id ="phpform"> 
            <div class="form-group">
                <label for="fname">Please enter your name: </label>
                <input type="name" class="form-control" id="name" placeholder="Enter name" name="fname">
              </div>
         
            <div class="form-group">
            <label for="email">Please enter your email address: </label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
          </div>
          > Pick your favorite instrument
          <div class="form-check">
            <input class="form-check-input" value="Guitar" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
             Guitar
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" value="Violin" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
            <label class="form-check-label" for="flexRadioDefault2">
              Violin
            </label>
          </div>
          <div class="form-check">

         
            <input class="form-check-input" value="Drums" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
            <label class="form-check-label" for="flexRadioDefault3">
              Drums
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" value="Piano" type="radio" name="flexRadioDefault" id="flexRadioDefault4" >
            <label class="form-check-label" for="flexRadioDefault4">
             Piano
            </label>
          </div>
         <p></p>> Pick your favorite animal<p></p>
         <br>
         <script>
            readInput();
         </script>
         <div id="checkboxgroup">
          <div class="form-check form-check-inline" >
            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="check[]" value="dogs" >
            <label class="form-check-label" for="inlineCheckbox1">dogs</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="check[]" value="cats" >
            <label class="form-check-label" for="inlineCheckbox2">cats</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="check[]" value="horses">
            <label class="form-check-label" for="inlineCheckbox3">horses</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="check[]" value="kangaroos">
            <label class="form-check-label" for="inlineCheckbox4">kangaroos</label>
          </div>
          <br><br>
        
        > Select your favorite activity: 
        <br><br>
        <div class="dropdown">
           
            <select name="activity">
    <?php foreach ($options as $option): ?>
        <option value="<?php echo $option; ?>">
            <?php echo $option; ?>
        </option>
    <?php endforeach; ?>
</select>
  
              </div>
<br><br>

          <button type="submit" class="btn btn-default">Submit</button>
         
        </form>
      </div>

    </body>
</html>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!empty($_REQUEST['fname'])) {
        $name = $_REQUEST['fname'];
    
    } else {
        $name = NULL;
        echo '<p class="error">You forgot to
        enter your name!</p>';
    }
    
    if (!empty($_REQUEST['email'])) {
        $email = $_REQUEST['email'];
    
    } else {
        $email = NULL;
        echo '<p class="error">You forgot to
        enter your email!</p>';
    }
    if (!empty($_REQUEST['flexRadioDefault'])) {
        $instrument = $_REQUEST['flexRadioDefault'];
    
    } else {
        $instrument = NULL;
        echo '<p class="error">You forgot to
        pick your instrument!</p>';
    }
    
    if (!empty($_REQUEST['check'])) {
        $animal = $_REQUEST['check'];
    
    } else {
        $animal = NULL;
        echo '<p class="error">You forgot to
        pick your instrument!</p>';
    }

   

    
    if (!empty($_REQUEST['activity'])) {
        $activity = $_REQUEST['activity'];
    
    } else {
        $activity = NULL;
        echo '<p class="error">You forgot to
        pick your activity!</p>';
    }

















echo "<center>";
echo "Welcome " .$name;
echo "<br><br>";
echo "Your email is " .$email;
echo "<br><br>";
echo "Your favorite musical instrument is ";
echo $instrument;
echo "<br><br>";
echo "Your favorite animals are ";
echo implode(' ', $animal);
echo "<br><br>";
echo "Your favorite activity is " .$activity;
echo "<br><br>";
echo "</center>";
}












