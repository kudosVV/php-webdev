<?php
include_once 'config2.php';
if (!$conn) {
    echo "Failed to connect to MySQL: " .mysqli_connect_error();
}

$pageTitle = "Blog";
$postTitle = $postContent = NULL;
$invalid_content = $invalid_title = NULL;
$pageContent = $msg = NULL;
$valid = FALSE;
if(isset($_SESSION['memberID'])) {
    $memberID = $_SESSION['memberID'];

} else {
    $memberID = 28;
}
if(filter_has_var(INPUT_POST, 'edit')) {
    $edit = TRUE;

} else {
    $edit = FALSE;
}
if(filter_has_var(INPUT_POST, 'postID')) {
    $postID = filter_input(INPUT_POST, 'postID');

} elseif(filter_has_var(INPUT_GET, 'postID')) {
    $postID = filter_input(INPUT_GET, 'postID');

} else {
    $postID = NULL;
}




if ($postID) {
    $stmt = $conn->stmt_init();
    if ($stmt->prepare("SELECT `postTitle`, `postContent` FROM `blog` WHERE `postID` = ?")) {
	$stmt->bind_param("i", $postID);
	$stmt->execute();
	$stmt->bind_result($postTitle, $postContent);
	$stmt->fetch();
	$stmt->close();
}
$buttons = <<<HERE
    <div class="form-group">
        <input type="hidden" name="postID" value="$postID">
        <input type="hidden" name="process">
        <input type="submit" name="update" value="Update Post" class="btn btn-success">
    </div>
HERE;
} else {
$buttons = <<<HERE
    <div class="form-group">
    <input type="hidden" name="postID" value="$postID">
        <input type="hidden" name="process">
        <input type="submit" name="insert" value="Save Post" class="btn btn-success">
    </div>
HERE;
}

if(filter_has_var(INPUT_POST, 'delete')) {
    $stmt = $conn->stmt_init(); 
    if ($stmt->prepare("DELETE FROM `blog` WHERE `postID` = ?")){ 
	    $stmt->bind_param("i", $postID); 
	    $stmt->execute(); // execute the script (query)
	    $stmt->close(); // close the connection
        }
header("Location: https://mywebtraining.net/webdev/LouisCK/php/blog-admin.php");
exit();
    }


    if (isset($_POST['process'])) {
    $valid = TRUE;
    $postTitle = mysqli_real_escape_string($conn, trim(filter_input(INPUT_POST, 'title')));
   
   if (empty($postTitle)) {
    $invalid_title = $msg = '<div class="alert alert-danger" role="alert">
    <strong>Required </strong> Field.
    </div>';  
    $valid=FALSE;
    }

$postContent = mysqli_real_escape_string($conn, trim(filter_input(INPUT_POST, 'content')));
if (empty($postContent)) {
    $invalid_content = $msg = '<div class="alert alert-danger" role="alert">
    <strong>Required </strong> Field. 
    </div>';  
    $valid = FALSE;
}
if($valid) {
    if(filter_has_var(INPUT_POST, 'insert')) {
    $stmt = $conn->stmt_init();
        if ($stmt->prepare("INSERT INTO `blog`(`postTitle`, `postContent`, `authorID`) VALUES (?, ?, ?)")) {
	        $stmt->bind_param("ssi", $postTitle, $postContent, $memberID);
	        $stmt->execute();
            $stmt->close();
            }
    $postID = mysqli_insert_id($conn);
    $msg = '<div class="alert alert-success">Blog created!!</div>';
    header("Location: https://mywebtraining.net/webdev/LouisCK/php/blog-admin.php?postID=$postID");
    exit();

}


if(filter_has_var(INPUT_POST, 'update')) {
    $stmt = $conn->stmt_init();
if ($stmt->prepare("UPDATE `blog` SET `postTitle`= ?, `postContent`= ? WHERE `postID`= ?")) {
	$stmt->bind_param("ssi", $postTitle, $postContent, $postID);
	$stmt->execute();
	$stmt->close();
    } 
    header("Location: https://mywebtraining.net/webdev/LouisCK/php/blog-admin.php?postID=$postID");
    exit();
        }
    }
 }

if ($edit) {
    $pageContent .= <<<HERE
    <section class="container">
    $msg
    <p>Please complete the form below </p>
    <form action="blog-admin.php" method="post">
        <div class="form-group">
        <label for="title">Blog Title</label>
        <input type="text" name="title" id="title" value="$postTitle" class="form-control">
        $invalid_title
        </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" id="content" class="form-control">$postContent</textarea>
        $invalid_content
    </div>
    $buttons
    </form>
    <form action="blog-admin.php" method="post">
        <div class="form-group">
            <input type="submit" name="cancel" value="Show Blog List" class="btn btn-primary">
        </div>
    </form>
</section>\n
HERE;
} elseif ($postID) {
    $pageContent = <<<HERE
    <h2>Blog Post</h2>
    <h3>$postTitle</h3>
    <p>$postContent</p>
    <form action="blog-admin.php" method="post">
    <div class="form-group">
        <input type="hidden" name="postID" value="$postID">
        <input type="submit" name="edit" value="Edit Post" class="btn btn-success">
    </div>
</form>
<form action="blog-admin.php" method="post">
    <div class="form-group">
        <input type="submit" name="cancel" value="Show Blog List" class="btn btn-primary">
    </div>
</form>
<form action="blog-admin.php" method="post">
    <input type="hidden" name="postID" value="$postID">
    <div class="form-group">
        <input type="submit" name="delete" value="Delete Post" class="btn btn-danger">
    </div>
</form>
HERE;

} else {
    $where = 1;
  
    $stmt = $conn->stmt_init();
if ($stmt->prepare("SELECT `postID`, `postTitle` FROM `blog` WHERE ?")) {
	$stmt->bind_param("i", $where);
	$stmt->execute();
	$stmt->bind_result($postID, $postTitle);
	$stmt->store_result();
	$classList_row_cnt = $stmt->num_rows();

    if($classList_row_cnt > 0) {
        $selectPost = <<<HERE
        <ul>\n
HERE;
            while($stmt->fetch()) {
                $selectPost .= <<<HERE
                <li><a href="blog-admin.php?postID=$postID">$postTitle</a></li>\n
HERE;
    }
$selectPost .= <<<HERE
    </ul>\n
HERE;
    
    } else {
    $selectPost = "<p>The blog post is available!!</p>";
    }
    $stmt->free_result();
    $stmt->close();
    } else {
    $selectPost = "<p>The blog system is down now. Please try again later.</p>";
}

    $pageContent = <<<HERE
<h2>Blog List</h2>
    $selectPost
<form action="" method="post">
    <div class="form-group">
        
        <input type="submit" name="edit" value="Create New Post" class="btn btn-success">
        
    </div>
</form>
HERE;
}



include 'template.php';
?>