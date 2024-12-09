<?php
session_start();
include_once 'config.php';
$valid=false;
$username = $password = $pageContent = NULL;
$invalid_password = $invalid_username = NULL;
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_POST['login'])) {
    if (empty($_POST['username'])) {
        $invalid_username = '<div class="alert alert-danger">Please enter a valid username</div>';
        $errors = 'error';
        $valid = false;
    } else {
        $username = validate($_POST['username']);
        $valid = true;
}
if (empty($_POST['password'])) {
    $invalid_password = '<div class="alert alert-danger">Please enter a password</div>';
    $errors = 'error';
    $valid = false;
} else {
    $password = validate(($_POST['password']));
    $valid = true;
}
if (!$conn) {
    echo "Failed to connect to MySQL: ".mysqli_connect_error($conn);
    $valid = false;
}
    if ($valid) {
        setcookie('memberID', 
        $data['memberID']);
        setcookie('firstname',
        $data['firstname']);

	$query = "SELECT `memberID`, `firstname`, `lastname` FROM `membership` WHERE `username` = '$username' AND `password` = '$password';";
	// run query and return matching record
	$result = mysqli_query($conn,$query);
	if (!$result) {
		die(mysqli_error($conn));
	}
	if ($row = mysqli_fetch_assoc($result)) {
		// set the database field values to session variables for futher use in the script
		$_SESSION['memberID'] = $row['memberID'];
		$_SESSION['firstname'] = $row['firstname'];
		$_SESSION['lastname'] = $row['lastname'];
        echo '<div class="alert alert-success">Logged on!!</div>';
	} else {
        echo '<div class="alert alert-danger"><strong>Failure! </strong>We cannot find you in the system.<br>
        Please Try Again.</div>';
	    } 
    }
}
$pageContent = <<<HERE
<form action="" enctype="multipart/form-data" method="post">
    <h3>Please enter your details</h3>
    <div class="form-group">
    <label for="username">Username</label>
    <input type="text" name="username" class="form-control" value="$username" id="username">$invalid_username
    </div>
    <div class="form-group">
    <label for="password">Password: </label>
    <input type="password"aria-describedby="Help" name="password" id="password" value ='' class="form-control">$invalid_password
    <small id="Help" class="form-text text-muted">We'll never share your details with anyone else.</small>
    </div>
    <input type="submit" name="login" value="Login" class="btn btn-primary">
     <a href="logout.php">
        <input type="button" name="logout"  value="Logout" class="btn btn-secondary btn-md center-block method="post">
		</div>
</form>
HERE;
include 'template.php'
?>