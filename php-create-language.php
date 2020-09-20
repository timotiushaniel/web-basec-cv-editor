<?php
// Include config file
require_once "dbh.php";
session_start();
$pd_id_ses = $_SESSION['pd_id'];
// Define variables and initialize with empty values
$language = $language_test = $Language_proficient = $skill = $score = "";
$language_err = $language_test_err = $Language_proficient_err = $skill_err = $score_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){ 
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

    // Validate test score
    $input_score = trim($_POST["score"]);
    if(empty($input_score)){
        $score_err = "Please enter the score.";     
    } else{
        $score = $input_score;
    }

    // Check input errors before inserting in database
    if(empty($language_err) && empty($language_test_err) && empty($Language_proficient_err) && empty($skill_err) && empty($score_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO language (pd_id, language, language_test, Language_proficient, skill, score) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            $pd_id = $pd_id_ses;
             
            mysqli_stmt_bind_param($stmt, "isssss", $pd_id, $language, $language_test, $Language_proficient, $skill, $score);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
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
                        <h2>Insert Language Record</h2>
                    </div>
                    <p>Please fill this form and submit to add Language record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                            <label>Language proficient</label>
                            <div class="form-check" id="language">
                                <label class="form-check-label ">
                                <input type="radio" class="form-check-input" name="Language_proficient" value="Proficient" id="languagep4"> Proficient
                                </label>
                            </div>
                            <div class="form-check" id="language">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="Language_proficient" value="High Profecient" id="languagep4"> High Profecient
                                </label>
                            </div>
                            <span class="help-block"><?php echo $Language_proficient_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($score_err)) ? 'has-error' : ''; ?>">
                            <label>Test score</label>
                            <input type="text" name="score" class="form-control" value="<?php echo $score; ?>">
                            <span class="help-block"><?php echo $score_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="form.php" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>