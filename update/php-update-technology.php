<?php
// Include config file
require_once "../dbh.php";
require "../form/session_time.php";
$PersonalDataId = $_SESSION['pd_id'];
// Define variables and initialize with empty values
$nama_teknologi = "";
$nama_teknologi_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["te_id"]) && !empty($_POST["te_id"])){
    // Get hidden input value
    $te_id = $_POST["te_id"];
    
    // Validate name
    $input_nama_teknologi = trim($_POST["nama_teknologi"]);
    if(empty($input_nama_teknologi)){
        $nama_teknologi_err = "Please enter the Technology name.";
    } else{
        $nama_teknologi = ucwords($input_nama_teknologi);
    }
    
    // Check input errors before inserting in database
    if(empty($nama_teknologi_err)){
        // Prepare an update statement
        $sql = "UPDATE technology SET pd_id=?, nama_teknologi=? WHERE te_id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            $pd_id = $PersonalDataId;
            mysqli_stmt_bind_param($stmt, "isi", $PersonalDataId, $nama_teknologi, $te_id);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: ../form/additional_information.php");
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
    if(isset($_GET["te_id"]) && !empty(trim($_GET["te_id"]))){
        // Get URL parameter
        $te_id =  trim($_GET["te_id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM technology WHERE te_id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $te_id);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $nama_teknologi = $row["nama_teknologi"];
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
                        <h2>Update Technology Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nama_teknologi_err)) ? 'has-error' : ''; ?>">
                            <label>Technology Name</label>
                            <input type="text" name="nama_teknologi" class="form-control" value="<?php echo $nama_teknologi; ?>">
                            <span class="help-block"><?php echo $nama_teknologi_err;?></span>
                        </div>
                        <input type="hidden" name="te_id" value="<?php echo $te_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../form/additional_information.php" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>