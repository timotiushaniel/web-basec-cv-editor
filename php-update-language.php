<?php
// Include config file
require_once "dbh.php";
session_start();
$pd_id_ses = $_SESSION['pd_id'];
// Define variables and initialize with empty values
$language = $language_test = $Language_proficient = $skill = $score = "";
$language_err = $language_test_err = $Language_proficient_err = $skill_err = $score_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["lg_id"]) && !empty($_POST["lg_id"])){
    // Get hidden input value
    $lg_id = $_POST["lg_id"];
    
    // Validate language
    $input_language = trim($_POST["language"]);
    if(empty($input_language)){
        $language_err = "Please enter the language.";
    } else{
        $language = $input_language;
    }
    
    // Validate language test
    $input_language_test = trim($_POST["language_test"]);
    if(empty($input_language_test)){
        $posisi_err = "Please enter the language test.";     
    } else{
        $language_test = $input_language_test;
    }
    
    // Validate language proficient
    $input_Language_proficient = trim($_POST["Language_proficient"]);
    if(empty($input_Language_proficient)){
        $Language_proficient_err = "Please enter the language proficient.";     
    } else{
        $Language_proficient = $input_Language_proficient;
    }

    // Validate tanggal_err
    $input_score = trim($_POST["score"]);
    if(empty($input_score)){
        $score_err = "Please enter the score.";     
    } else{
        $score = $input_score;
    }
    
    // Check input errors before inserting in database
    if(empty($language_err) && empty($language_test_err) && empty($Language_proficient_err) && empty($skill_err) && empty($score_err)){
        // Prepare an update statement
        $sql = "UPDATE language SET pd_id=?, language=?, language_test=?, Language_proficient=?, skill=?, score=? WHERE lg_id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            $pd_id = $pd_id_ses;
            mysqli_stmt_bind_param($stmt, "issssii", $pd_id, $language, $language_test, $Language_proficient, $skill, $score, $lg_id);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: form.php");
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
    if(isset($_GET["lg_id"]) && !empty(trim($_GET["lg_id"]))){
        // Get URL parameter
        $lg_id =  trim($_GET["lg_id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM language WHERE lg_id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $lg_id);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $language = $row["language"];
                    $language_test = $row["language_test"];
                    $Language_proficient = $row["Language_proficient"];
                    $skill = $row["skill"];
                    $score = $row["score"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
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
        header("location: error.php");
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
                        <h2>Update Language Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group <?php echo (!empty($language_err)) ? 'has-error' : ''; ?>">
                            <label>Language</label>
                            <input type="text" name="language" class="form-control" value="<?php echo $language; ?>">
                            <span class="help-block"><?php echo $language_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($language_test_err)) ? 'has-error' : ''; ?>">
                            <label>Language test</label>
                            <input type="text" name="language_test" class="form-control" value="<?php echo $language_test; ?>">
                            <span class="help-block"><?php echo $language_test_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($Language_proficient_err)) ? 'has-error' : ''; ?>">
                            <label>Language proficient</label><br>                           
                                <input type="radio" class="form-check-input" name="Language_proficient" <?php echo ($Language_proficient == "Proficient") ?  "checked" : ""?> value="Proficient" id="provicient1"> Proficient <br>
                                <input type="radio" class="form-check-input" name="Language_proficient" <?php echo ($Language_proficient == "High Profecient") ?  "checked" : ""?> value="High Profecient" id="provicient2"> High Profecient
                            <span class="help-block"><?php echo $Language_proficient_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($score_err)) ? 'has-error' : ''; ?>">
                            <label>Test score</label>
                            <input type="text" name="score" class="form-control" value="<?php echo $score; ?>">
                            <span class="help-block"><?php echo $score_err;?></span>
                        </div>
                        <input type="hidden" name="lg_id" value="<?php echo $lg_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="form.php" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>