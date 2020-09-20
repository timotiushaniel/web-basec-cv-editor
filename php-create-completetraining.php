<?php
// Include config file
require_once "dbh.php";
session_start();
$ex_id_ses = $_SESSION['ex_id'];
// Define variables and initialize with empty values
$detail_pekerjaan = "";
$detail_pekerjaan_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_detail_pekerjaan = trim($_POST["detail_pekerjaan"]);
    if(empty($input_detail_pekerjaan)){
        $detail_pekerjaan_err = "Please input the job detail.";
    } else{
        $detail_pekerjaan = $input_detail_pekerjaan;
    }
    
    // Check input errors before inserting in database
    if(empty($detail_pekerjaan_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO detail_job (ex_id, detail_pekerjaan) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            $ex_id = $ex_id_ses;
            mysqli_stmt_bind_param($stmt, "is", $ex_id, $detail_pekerjaan);
            
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
                        <h2>Insert Complete Training Record</h2>
                    </div>
                    <p>Please fill this form and submit to add Complete Training record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($detail_pekerjaan_err)) ? 'has-error' : ''; ?>">
                            <br> Completed training:<br>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="computer" id="computer" checked value="">Computer
              </label>
            </div><br>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="communication" id="communication" checked value="">Communication
              </label>
            </div><br>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="java_mobile" id="java_mobile" checked value="">Java Mobile
              </label>
            </div><br>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="leadership" id="leadership" checked value="">Leadership
              </label>
            </div><br>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="Entrepreneurship" id="Entrepreneurship" checked value="">Entrepreneurship
              </label>
            </div><br>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="Career_planning_skills" id="Career_planning_skills" checked value="">Career planning skills
              </label>
            </div>
        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="form.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>