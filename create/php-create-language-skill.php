<?php
// Include config file
require_once "../dbh.php";
require "../form/session_time.php";
$lg_id_ses = $_SESSION['lg_id'];
// Define variables and initialize with empty values
$language_skill = "";
$language_skill_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_language_skill = trim($_POST["language_skill"]);
    if(empty($input_language_skill)){
        $language_skill_err = "Please input the job detail.";
    } else{
        $language_skill = ucfirst($input_language_skill);
    }
    
    // Check input errors before inserting in database
    if(empty($language_skill_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO language_skill (lg_id, skill) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            $lg_id = $lg_id_ses;
            mysqli_stmt_bind_param($stmt, "is", $lg_id, $language_skill);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: ../form/php-language-skill.php?lg_id=".$lg_id);
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
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                        <h2>Insert Language Skill Record</h2>
                    </div>
                    <p>Please fill this form and submit to add Language Skill record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($language_skill_err)) ? 'has-error' : ''; ?>">
                            <label>Job Detail</label><br>
                            
                            <input type="text" name="language_skill" class="form-control" placeholder="Example: Reading" value="<?php echo $language_skill; ?>">
                            <span class="help-block"><?php echo $language_skill_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <?php echo "<a href='../form/php-language-skill.php?lg_id=".$lg_id_ses."' class = 'btn btn-default'>Cancel</a>"?>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>