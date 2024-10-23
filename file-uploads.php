




<?php
$valid = false;
$fname = $lname = $email = $pageContent = NULL;

$invalid_fname = $invalid_lname = $invalid_email = $invalid_email_format = $invalid_image = $invalid_password = NULL;


if (isset($_POST['submit'])) {
    $valid = true;
    if (empty($_POST['fname'])) {
        $invalid_fname = '<div class="alert alert-danger">Please enter a valid first name</div>';
        $valid = false;
    } else {
        $fname = ucfirst(htmlspecialchars(trim($_POST['fname'])));
    }

    if (empty($_POST['lname'])) {
        $invalid_lname = '<div class="alert alert-danger">Please enter a valid last name</div>';
        $valid = false;
    } else {
        $lname = ucfirst(htmlspecialchars(trim($_POST['lname'])));
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
    if (empty($_POST['password'])) {
        $invalid_password = '<div class="alert alert-danger">Please enter a password</div>';
        $valid = false;

    } else {
        $password = trim($_POST['password']);
    }
    if (empty($_POST['verifypassword'])) {
        $invalid_password_verify = '<div class="alert alert-danger">Please verify your password</div>';
    }
    else {
        
         $passwordVerify = trim($_POST['verifypassword']);
         if ($_POST['password'] !== $_POST['verifypassword']) {
        
        $invalid_password_key = '<div class="alert alert-danger">Passwords do not match</div>';
        $valid = false;

        }


    }
$fullname = $fname . " " . $lname;
$username = strtolower(substr($fname, 0, 1) . $lname);
$filetype = pathinfo($_FILES['profilePic']['name'],PATHINFO_EXTENSION);
if ((($filetype == "gif") or ($filetype == "jpg") or ($filetype == "png")) and $_FILES['profilePic']['size'] < 100000) {
	// check to make sure there is no error on the upload. If so, display the errror 
	
	if ($_FILES["profilePic"]["error"] > 0) {
		echo "Return Code: " . $_FILES["profilePic"]["error"] . "<br>";
	} else {
		// display information about the file 
		$pageContent = "Upload: " . $_FILES["profilePic"]["name"] . "<br>";
		$pageContent .= "Type: " . $_FILES["profilePic"]["type"] . "<br>";
		$pageContent .=  "Size: " . ($_FILES["profilePic"]["size"] / 1024) . " Kb<br>";
		$pageContent .=  "Temp file: " . $_FILES["profilePic"]["tmp_name"] . "<br>";
		
		// if the file already exists in the upload directory, give an error
		if (file_exists("upload/" . $_FILES["profilePic"]["name"])) {
			$pageContent =  $_FILES["profilePic"]["name"] . " already exists. ";
		} else {
			// move the file to a permanent location
			move_uploaded_file($_FILES["profilePic"]["tmp_name"],"upload/" . $_FILES["profilePic"]["name"]);
            

		$filename = "membership.txt";

// format the form data to be saved to the txt file
        $data_entry = $fullname . "," . $email . "," . $password . "," . $username . "\n";

// open the txt file ($filename) to append (a) and assign it to a file handle ($fp)
        $fp = fopen($filename, "a") or die ("Couldn't open file, sorry.");
// write (fwrite) the data ($data_entry) to the file using the file handle ($fp)
        if (fwrite($fp, $data_entry) > 0) { // successful write operation returns 1, failure returns 0
	// do this on success
	    $logged_in = TRUE; // sets a login trigger for the program to switch from form display to content display
    } else {
	// do this on failure
	     echo "Your information was not saved. Please try again at another time.";
    }
        $fp = fclose($fp); // close the file
        $imagePath = "upload/" . $_FILES["profilePic"]["name"];
	 }
	 }
    } else {
	    $pageContent .= "Invalid file";
        $valid = false;
    }

     }

 if($valid) {



$poem = "poem.txt";

// open the txt file ($poem) to read (r) and assign it to a file handle ($fp)
$fp = fopen($poem, "r") or die ("Couldn't open file, sorry.");
if (($fp)) { // keep reading the open file ($fp) until the end of file (foef)
	// do this on success
	$poemText = fgets($fp); // assign the file content to a variable for later use in the program
} else {
	// do this on failure
	echo "Your information was not found. Please try again at another time.";
}
$fp = fclose($fp); // close the file

            $pageContent = <<<HERE
            <h1>Success!</h1>

            <h1>Welcome $fname!</h1>
            <p>We registered you as username: $username and email: $email and password: $password.</p>
            <img src="$imagePath">
            <h2>Poetry Corner</h2>
            <p>$poemText</p>

HERE;





} else {


$pageContent = <<<HERE
<section class="container">
	<p>Please register if you are a new member</p>
	<form action="file-uploads.php" enctype="multipart/form-data" method="post">
		<div class="form-group">
			<label for="fname">First Name:</label>
			<input type="text" name="fname" id="fname" value="$fname" class="form-control"> $invalid_fname
		</div>
		<div class="form-group">
			<label for="lname">Last Name:</label>
			<input type="text" name="lname" id="lname" value="$lname" class="form-control"> $invalid_lname
		</div>
		<div class="form-group">
			<label for="email">E-Mail:</label>
			<input type="text" name="email" id="email" value="$email" class="form-control"> $invalid_email $invalid_email_format
		</div>
        <div class="form-group">
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" value ='' class="form-control">$invalid_password
        </div>
          <div class="form-group">
        <label for="verifypassword">Verify Password: </label>
        <input type="password" name="verifypassword" id="verifypassword" value ='' class="form-control">$invalid_password_verify $invalid_password_key
        </div>
		<p>Please select an image for your profile.</p>
		<div class="form-group">
			<input type="hidden" name="MAX_FILE_SIZE" value="100000">
			<label for="profilePic">File to Upload:</label> $invalid_image
			<input type="file" name="profilePic" id="profilePic" class="form-control">
		</div>
		<div class="form-group">
			<input type="submit" name="submit" value="Submit Profile" class="btn btn-primary">
		</div>
	</form>
</section>\n
HERE;

}


$pageTitle = "file-uploads Page";
include_once 'template.php';
?>