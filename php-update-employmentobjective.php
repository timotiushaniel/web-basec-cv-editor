<?php
// Include config file
require_once "dbh.php";
session_start();
$pd_id_ses = $_SESSION['pd_id'];
$UserId = $_SESSION['user_id'];
// Define variables and initialize with empty values
$objective = "";
$objective_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["eo_id"]) && !empty($_POST["eo_id"])){
    // Get hidden input value
    $eo_id = $_POST["eo_id"];
    
    // Validate objective
    $input_objective = trim($_POST["EmploymentObjective"]);
    if(empty($input_objective)){
        $objective_err = "Please enter the objective.";
    } else{
        $objective = $input_objective;
    }
    
    // Check input errors before inserting in database
    if(empty($objective_err)){
        // Prepare an update statement
        $sql = "UPDATE employment_objective SET pd_id=?, objective=? WHERE eo_id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            $pd_id = $pd_id_ses;
            mysqli_stmt_bind_param($stmt, "isi", $pd_id_ses, $objective, $eo_id);
            
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
    if(isset($_GET["eo_id"]) && !empty(trim($_GET["eo_id"]))){
        // Get URL parameter
        $eo_id =  trim($_GET["eo_id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM employment_objective WHERE eo_id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $eo_id);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $objective = $row["objective"];
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="StyleForm.css">
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
                        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                            <h2 class="alert alert-primary text-center mt-3">Employment Objective</h2>
                            <hr>
                            <div class="form-group <?php echo (!empty($objective_err)) ? 'has-error' : ''; ?>">
                                <textarea class="form-control" rows="5" id="EmploymentObjective" name="EmploymentObjective" placeholder="Employment objective"><?php echo $objective; ?></textarea>
                                <span class="help-block"><?php echo $objective_err;?></span>
                            </div>
                            
                            <input type="hidden" name="eo_id" value="<?php echo $eo_id; ?>"/>
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <a href="form.php" class="btn btn-danger">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>