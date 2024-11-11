<?php

include_once 'config.php';
$valid = false;
$insert_success= false;
$firstname = $lastname = $email = $pageContent = NULL;

$invalid_fname = $invalid_lname = $invalid_email = $invalid_email_format = $invalid_image = $invalid_password = NULL;
$errors = [];

if (isset($_POST['submit'])) {
    $valid = true;
    if (empty($_POST['firstname'])) {
        $invalid_fname = '<div class="alert alert-danger">Please enter a valid first name</div>';
        $errors = 'error';
        $valid = false;
    } else {
        $firstname = ucfirst(htmlspecialchars(trim($_POST['firstname'])));
        $firstname = mysqli_real_escape_string($conn, trim($_POST['firstname']));
       
    }
    if (empty($_POST['lastname'])) {
        $invalid_lname = '<div class="alert alert-danger">Please enter a valid last name</div>';
        $errors = 'error';
        $valid = false;
    } else {
        $lastname = ucfirst(htmlspecialchars(trim($_POST['lastname'])));
        $lastname = mysqli_real_escape_string($conn, trim($_POST['lastname']));
    }
    if (empty($_POST['email'])) {
        $invalid_email = '<div class="alert alert-danger">Please enter a valid email</div>';
        $errors = 'error';
        $valid = false;
    } else {
        $email = trim($_POST['email']);
        $email = mysqli_real_escape_string($conn, trim($_POST['email']));
        // validate email using a regular expression
        if (!preg_match('/[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}/', $email)) {
            // returns 1 (true) for match, 0 (false) for no match
            $invalid_email_format = '<div class="alert alert-danger">Invalid email format</div>';
            $errors = 'error';
            $valid = false;
        }
    }
    if (empty($_POST['password'])) {
        $invalid_password = '<div class="alert alert-danger">Please enter a password</div>';
        $errors = 'error';
        $valid = false;

    } else {
        $password = trim($_POST['password']);
    }
    if (empty($_POST['verifypassword'])) {
        $invalid_password_verify = '<div class="alert alert-danger">Please verify your password</div>';
        $errors = 'error';
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
            $errors = 'error';
        }  
$fullname = $firstname . " " . $lastname;
$username = strtolower(substr($firstname, 0, 1) . $lastname);
$username = mysqli_real_escape_string($conn, trim($username));
$query1="SELECT username FROM `membership` WHERE username='$username'";
$resulted = mysqli_query($conn, $query1);
$ranything_found = mysqli_num_rows($resulted);
if($ranything_found>0){
	$invalid_lname = '<div class="alert alert-danger">Username is already taken.</div>';
	$valid = false;
} else {
	$valid=true;
}
$filetype = pathinfo($_FILES['profilePic']['name'],PATHINFO_EXTENSION);
if ((($filetype == "gif") or ($filetype == "jpg") or ($filetype == "png")) and $_FILES['profilePic']['size'] < 100000) {
	// check to make sure there is no error on the upload. If so, display the errror 
	if ($_FILES["profilePic"]["error"] > 0) {
		$invalid_image .= '<div class="alert alert-danger">' . "Return Code: " . $_FILES["profilePic"]["error"] . "<br>" . '</div>';
        $errors = 'error';
	} else {
		// display information about the file 
		// = "Upload: " . $_FILES["profilePic"]["name"] . "<br>";
		//$pageContent .= "Type: " . $_FILES["profilePic"]["type"] . "<br>";
		//$pageContent .=  "Size: " . ($_FILES["profilePic"]["size"] / 1024) . " Kb<br>";
		//$pageContent .=  "Temp file: " . $_FILES["profilePic"]["tmp_name"] . "<br>";
		// if the file already exists in the upload directory, give an error
		if (file_exists("upload/" . $_FILES["profilePic"]["name"])) {
			$invalid_image .= '<div class="alert alert-danger">' . $_FILES["profilePic"]["name"] . " already exists. " . '</div>';
            $valid = false;
            $insert_success = false;
            $errors = 'error'; 
		} else {
			// move the file to a permanent location
			move_uploaded_file($_FILES["profilePic"]["tmp_name"],"upload/" . $_FILES["profilePic"]["name"]);
            $invalid_image .= '<div class="alert alert-danger">' . "Stored in " . "upload/" . $FILES["profilePic"]["name"] . '</div>';
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
	     $errors .= "Your information was not saved. Please try again at another time."; 
    }
        $fp = fclose($fp); // close the file
        $imagePath = "upload/" . $_FILES["profilePic"]["name"];
	 }
	}
} else {
	    $invalid_image .= '<div class="alert alert-danger">Invalid file</div>';
        $valid = false;
    }
    if (!$conn) {
		echo "Failed to connect to MySQL: ".mysqli_connect_error($conn);
	}
    if ($valid) {
	$query = "INSERT INTO `membership` VALUES (DEFAULT,'$firstname','$lastname','$username','$email','$password', '$imagePath');";
	$result2 = mysqli_query($conn, $query) or die(mysqli_error($conn));
	if (!$result2) {
		die(mysqli_error($conn));
	} else {
		$row_count = mysqli_affected_rows($conn);
		if ($row_count == 1) {
			// retrieve the last record inserted id
			$memberID = mysqli_insert_id($conn);
			$insert_success = TRUE;
			echo '<div class="alert alert-danger">Record inserted!!</div>';

		} else {
            $valid = false;
			echo '<div class="alert alert-danger">record failed!!</div>';
           
			}
		}
	}
}  
if ($insert_success) {
    $query = "SELECT * FROM `membership` WHERE `memberID` = $memberID;";
    $result = mysqli_query($conn,$query);
    if (!$result) {
        die(mysqli_error($conn));
    }
    if ($row = mysqli_fetch_assoc($result)) {
        // set the database field values to local variables for futher use in the script
        $memberID = $row['memberID'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $username = $row['username'];
        $email = $row['email'];
        $password = $row['password'];
        $image = $row['image'];
    $pageContent = <<<HERE
    <table style="width:100%" class="table">
    <tr style="background-color: #D6EEEE" class="table-primary">
        <th>Membership ID</th>
        <th>first name</th>
        <th>last name</th>
        <th>username</th>
        <th>email</th>
        <th>password</th>
        <th>image</th>
    </tr><br><br>
    <tr class="table-secondary">
        <th>$memberID</th>
        <th>$firstname</th>
        <th>$lastname</th>
        <th>$username</th>
        <th>$email</th>
        <th>$password</th>
        <th>$image</th>
    </tr>
    </table>
    HERE;
    }
    } else {
$pageContent = <<<HERE
<section class="container">
	<p>Please register if you are a new member</p>
	<form action="register.php" enctype="multipart/form-data" method="post">
		<div class="form-group">
			<label for="firstname">First Name:</label>
			<input type="text" name="firstname" id="firstname" value="$firstname" class="form-control"> $invalid_fname
		</div>
		<div class="form-group">
			<label for="lastname">Last Name:</label>
			<input type="text" name="lastname" id="lastname" value="$lastname" class="form-control"> $invalid_lname
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
$pageTitle = "register page";
include_once 'template.php';
?>