<?php
require "../form/session_time.php";
$lg_id_ses = $_SESSION['lg_id'];
// Process delete operation after confirmation
if(isset($_POST["ls_id"]) && !empty($_POST["ls_id"])){
    // Include config file
    require_once "../dbh.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM language_skill WHERE ls_id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $ls_id);
        
        // Set parameters
        $ls_id = trim($_POST["ls_id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
            header("location: ../form/php-language-skill.php?lg_id=".$lg_id_ses);
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    //mysqli_stmt_close($stmt);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["ls_id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: ../error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Language Skill Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Delete Language Skill Record</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="ls_id" value="<?php echo trim($_GET["ls_id"]); ?>"/>
                            <p>Are you sure you want to delete this Language Skill record?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <?php echo "<a href='../form/php-language-skill.php?lg_id=".$lg_id_ses."' class = 'btn btn-default'>No</a>"?>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>