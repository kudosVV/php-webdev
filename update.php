<?php

if ((isset($_GET['memberID'])) && (is_numeric($_GET['memberID'])) ) {

    $memberID = $_GET['memberID'];
} elseif ((isset($_POST['memberID'])) && (is_numeric($_POST['memberID'])) ) {
    $memberID = $_POST['memberID'];
} else {
    $pageContent .=  '<p class="error">No member ID has been passed.</p>';
    exit();
}

require 'config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$insert_success= false;
$invalid_fname = $invalid_password = $invalid_lname = $invalid_email = $invalid_image = NULL;
$errors = [];
if (empty($_POST['firstname'])) {
    $invalid_fname = '<div class="alert alert-danger">Please enter a valid first name</div>';
    $errors[] = 'no first name';
    
    $valid = false;
} else {
    $firstname = ucfirst(htmlspecialchars(trim($_POST['firstname'])));
    $firstname = mysqli_real_escape_string($conn, trim($_POST['firstname']));
   
}
if (empty($_POST['lastname'])) {
    $invalid_lname = '<div class="alert alert-danger">Please enter a valid last name</div>';
    $errors[] = 'error last name';
    $valid = false;
} else {
    $lastname = ucfirst(htmlspecialchars(trim($_POST['lastname'])));
    $lastname = mysqli_real_escape_string($conn, trim($_POST['lastname']));
}
if (empty($_POST['email'])) {
    $invalid_email = '<div class="alert alert-danger">Please enter a valid email</div>';
    $errors[] = 'error email';
    $valid = false;
} else {
    $email = trim($_POST['email']);
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    // validate email using a regular expression
    if (!preg_match('/[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}/', $email)) {
        // returns 1 (true) for match, 0 (false) for no match
        $invalid_email_format = '<div class="alert alert-danger">Invalid email format</div>';
        $errors[] = 'error invalid email';
        $valid = false;
    }
}
if (empty($_POST['password'])) {
    $invalid_password = '<div class="alert alert-danger">Please enter a password</div>';
    $errors[] = 'error password';
    $valid = false;

} else {
    $password = trim($_POST['password']);
}
if (empty($_POST['verifypassword'])) {
    $invalid_password_verify = '<div class="alert alert-danger">Please verify your password</div>';
    $errors[] = 'error';
}
else {
    
     $passwordVerify = trim($_POST['verifypassword']);
}
     if(strcmp($_POST['password'], $_POST['verifypassword']) == 0) {  
        $password = $_POST['password']; 
        $password = mysqli_real_escape_string($conn, trim($_POST['password'])); 
       $valid = true;
    } else {  
        $invalid_password_verify = '<div class="alert alert-danger">password mismatch!!</div>';  
        $valid = false;
        $errors[] = 'error';
        $errors = 'error';
    }  
$fullname = $firstname . " " . $lastname;
$username = strtolower(substr($firstname, 0, 1) . $lastname);
$username = mysqli_real_escape_string($conn, trim($username));
$valid= true;
$filetype = pathinfo($_FILES['profilePic']['name'],PATHINFO_EXTENSION);
if ((($filetype == "gif") or ($filetype == "jpg") or ($filetype == "png")) and $_FILES['profilePic']['size'] < 100000) {
// check to make sure there is no error on the upload. If so, display the errror 
if ($_FILES["profilePic"]["error"] > 0) {
    $invalid_image .= '<div class="alert alert-danger">' . "Return Code: " . $_FILES["profilePic"]["error"] . "<br>" . '</div>';
    $errors[] = 'error';
} else {
    // display information about the file 
    // = "Upload: " . $_FILES["profilePic"]["name"] . "<br>";
    //$pageContent .= "Type: " . $_FILES["profilePic"]["type"] . "<br>";
    //$pageContent .=  "Size: " . ($_FILES["profilePic"]["size"] / 1024) . " Kb<br>";
    //$pageContent .=  "Temp file: " . $_FILES["profilePic"]["tmp_name"] . "<br>";
    // if the file already exists in the upload directory, give an error
    
        // move the file to a permanent location
        move_uploaded_file($_FILES["profilePic"]["tmp_name"],"upload/" . $_FILES["profilePic"]["name"]);
        $invalid_image .= "Stored in " . "upload/" . $FILES["profilePic"]["name"];
        $valid = true;
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
     $pageContent .= "Your information was not saved. Please try again at another time."; 
     $errors[] = 'information not saved';
}
    $fp = fclose($fp); // close the file
    $imagePath = "upload/" . $_FILES["profilePic"]["name"];
 }

} else {
    $invalid_image .= '<div class="alert alert-danger">Invalid file</div>';
    $valid = false;
    $errors[] = 'you forgot to enter a valid file';
}

    if (empty($errors)) {
        
        $query = "SELECT * FROM `membership` WHERE `memberID` = $memberID;";
        $result = mysqli_query($conn,$query);
        if (mysqli_num_rows($result) == 1) {

        $q = "UPDATE `membership` SET `firstname`='$firstname',`lastname`=
        '$lastname',`username`='$username',`email`='$username',`password`='$password',`image`='$image' WHERE `memberID`= $memberID LIMIT 1";
        $r = mysqli_query($conn, $q);
       if (mysqli_affected_rows($conn) == 1) {
       
                $pageContent .= '<div class="alert alert-success" role="alert">
                        <strong>Success! </strong>Record updated!
                        </div>';
                $insert_success = true;
            } else {
                $pageContent .= '<div class="alert alert-danger" role="alert">Record not updated!!</div>';
                }
               } else {
                $pageContent .= '<div class="alert alert-danger" role="alert"You have already updated your details!!</div>';
            }
        } else {
            echo '<p class="error">The Following error(s) occurred';
            foreach ($errors as $msg) {
                echo " = $msg<br>\n";
            }
            echo '</p><p>Please try again</p>';
            }
        }
    


    $query = "SELECT * FROM `membership` WHERE `memberID` = $memberID;";
    $result = mysqli_query($conn,$query);
    
    if ($row = mysqli_fetch_assoc($result)) {
    // set the database field values to local variables for futher use in the script
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $username = $row['username'];
        $email = $row['email'];
        $password = $row['password'];
        $image = $row['image'];
    }

    if (mysqli_num_rows($result) == 1) {
     $row = mysqli_fetch_array($result, MYSQLI_NUM);
$pageContent .= 
'<section class="container">
	<p>Update your details</p>
	<form action="update.php" enctype="multipart/form-data" method="post">
		<div class="form-group">
			<label for="firstname">First Name:</label>
			<input type="text" name="firstname" id="firstname" value="' . $firstname .'" class="form-control">' . $invalid_fname .'
		</div>
		<div class="form-group">
			<label for="lastname">Last Name:</label>
			<input type="text" name="lastname" id="lastname" value="' . $lastname .'" class="form-control">' . $invalid_lname .'
		</div>
		<div class="form-group">
			<label for="email">E-Mail:</label>
			<input type="text" name="email" id="email" value="' . $email .'" class="form-control">' . $invalid_email . $invalid_email_format . '
		</div>
        <div class="form-group">
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" value ="' . $password .'" class="form-control"> ' .$invalid_password .'
        </div>
          <div class="form-group">
        <label for="verifypassword">Verify Password: </label>
        <input type="password" name="verifypassword" id="verifypassword" value="" class="form-control"> ' . $invalid_password_verify . $invalid_password_key . '
        </div>
		<p>Please select an image for your profile.</p>
		<div class="form-group">
			<input type="hidden" name="MAX_FILE_SIZE" value="100000">
			<label for="profilePic">File to Upload:' . $image . '</label>' . $invalid_image . '
			<input type="file" name="profilePic" id="profilePic" class="form-control">
		</div>
		<div class="form-group">
         <input type="hidden" name="memberID" value="' . $memberID . '">
		<input type="submit" name="Update" value="Update Profile" class="btn btn-primary">
		</div>
	</form>
</section>
<br><br><br>';
    
    } else {
        echo 'error';
    }
     
    
mysqli_close($conn);

if ($insert_success) {
    session_start();
    $_SESSION['message'] = '<div class="alert alert-success" role="alert">
                        <strong>Success! </strong>Record Updated!! 
                        </div>';  
    header( "Location: https://mywebtraining.net/webdev/LouisCK/php/profile.php" );
       die();
     }
$pageTitle = "Profile page";
include_once 'template.php';

?>