<?php


include_once 'config.php';
$pageTitle = 'Delete Page';

if ((isset($_GET['memberID'])) && (is_numeric($_GET['memberID'])) ) {

    $memberID = $_GET['memberID'];
} elseif ((isset($_POST['memberID'])) && (is_numeric($_POST['memberID'])) ) {
    $memberID = $_POST['memberID'];
} else {
    $pageContent .=  '<p class="error">No member ID has been passed.</p>';
    exit();
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['sure'] == 'Yes') {

        $query = "SELECT * FROM `membership` WHERE `memberID` = $memberID;";
        $result = mysqli_query($conn,$query);
        if (!$result) {
            die(mysqli_error($conn));
        }
        if ($row = mysqli_fetch_assoc($result)) {
            // set the database field values to local variables for futher use in the script
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $username = $row['username'];
            $email = $row['email'];
            $password = $row['password'];
            $image = $row['image'];
        }

    


$query = "DELETE FROM `membership` WHERE `memberID` = $memberID LIMIT 1";
$result = mysqli_query($conn, $query);
 $row_count = mysqli_affected_rows($conn);
    if($row_count == 1) {

                        $Path = $image;
                        if (unlink($Path)) {    
                            echo "image file unlinked";
                        } else {
                            echo "image file still there";    
                        }
    $pageContent .=    '<div class="alert alert-success" role="alert">
                        <strong>Success! </strong>Record Deleted! 
                        </div>';
    $pageContent .=
                        '<div class="container" style="text-align:center;">
                        <h3>Do you wish to submit the form again?</h3>
                        <br>
                         <a href="profile.php"><button type="button" class="btn-primary">Submit Again</button></a>
                        
                        </div>';
                        
    } else {
        $pageContent .=  "<p>Delete failed</p>";
        $pageContent .=  '<p>' . mysqli_error($conn) . '<br>Query: ' . $query . '</p>'; //Debug
    }
} else {
    $pageContent .=  'user has not been deleted';
}

  }  else {
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
     '<div class="container w-50" style="border-style:solid;text-align:center;margin: 100px;">
     <form action="delete-verify.php" method="post">
     <div class="col-12">
     <div class="row-3">
     <h3>Hello ' . $firstname . ", userID: " . $memberID . '</h3>
     </div>
    <div class="row-3">
    Are you sure you want to delete this user?<br>
    </div>
   <div class="row-3" style="text-align:center;">
   <div class="col-6">
    <input type="radio" name="sure" value="Yes"> Yes
    </div>
    <div class="col-6">
    <input type="radio" name="sure" value="No" checked="checked"> No
    </div>
    </div>
    <div class="row-3" style="text-align:center;">
    <div class="col-12">
    <input type="submit" name="submit" value="Submit">
    <input type="hidden" name="memberID" value="' . $memberID . '">
    </div>
   </div>
   </form>
    </div>
    </div>';
} else {
    $pageContent .= '<p> class="error">This page has been accessed in error.</p>';
}
 }
mysqli_close($conn);
include_once 'template.php';

?>