<?php
// Include config file
require_once "../dbh.php";
require "../form/session_time.php";
$lg_id_ses = $_SESSION['lg_id'];
// Define variables and initialize with empty values
$language_skill = "";
$language_skill_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["ls_id"]) && !empty($_POST["ls_id"])){
    // Get hidden input value
    $ls_id = $_POST["ls_id"];
    
    // Validate Job Detail
    $input_language_skill = trim($_POST["language_skill"]);
    if(empty($input_language_skill)){
        $language_skill_err = "Please input the job detail.";
    } else{
        $language_skill = ucfirst($input_language_skill);
    }
    
    // Check input errors before inserting in database
    if(empty($language_skill_err)){
        // Prepare an update statement
        //$sql = "UPDATE award SET pd_id=?, nama=?, tanggal=? WHERE aw_id=?";
        $sql = "UPDATE language_skill SET lg_id=?, skill=? WHERE ls_id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            $lg_id = $lg_id_ses;
            mysqli_stmt_bind_param($stmt, "isi", $lg_id, $language_skill, $ls_id);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: ../form/php-language-skill.php?lg_id=".$lg_id_ses."");
                exit();
            } else{
                echo "Something went wrong. Please try again.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["ls_id"]) && !empty(trim($_GET["ls_id"]))){
        // Get URL parameter
        $ls_id =  trim($_GET["ls_id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM language_skill WHERE ls_id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $ls_id);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $language_skill = $row["skill"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: ../error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($conn);
    }  else{
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
    <title>Update Record</title>
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
                        <h2>Update Language Skill Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the Language Skill record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($language_skill_err)) ? 'has-error' : ''; ?>">
                            <label>Language Skill</label>
                            <input type="text" name="language_skill" class="form-control" value="<?php echo $language_skill; ?>">
                            <span class="help-block"><?php echo $language_skill_err;?></span>
                        </div>
                        <input type="hidden" name="ls_id" value="<?php echo $ls_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <?php echo "<a href='../form/php-language-skill.php?lg_id=".$lg_id_ses."' class = 'btn btn-default'>Cancel</a>"?>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>