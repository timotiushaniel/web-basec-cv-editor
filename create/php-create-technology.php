<?php
// Include config file
require_once "../dbh.php";
require "../form/session_time.php";
$pd_id_ses = $_SESSION['pd_id'];
// Define variables and initialize with empty values
$nama_teknologi = "";
$nama_teknologi_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_nama_teknologi = trim($_POST["nama_teknologi"]);
    if(empty($input_nama_teknologi)){
        $nama_teknologi_err = "Please enter the technology name.";
    } else{
        $nama_teknologi = ucwords($input_nama_teknologi);
    }

    // Check input errors before inserting in database
    if(empty($nama_teknologi_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO technology (pd_id, nama_teknologi) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            $pd_id = $pd_id_ses;
            mysqli_stmt_bind_param($stmt, "is", $pd_id, $nama_teknologi);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
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
                        <h2>Insert Technology Record</h2>
                    </div>
                    <p>Please fill this form and submit to add technology record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nama_err)) ? 'has-error' : ''; ?>">
                            <label>Technology</label>
                            <input type="text" name="nama_teknologi" class="form-control" placeholder="Example: Programming Language" value="<?php echo $nama_teknologi; ?>">
                            <span class="help-block"><?php echo $nama_teknologi_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../form/additional_information.php" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>