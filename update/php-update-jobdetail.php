<?php
// Include config file
require_once "../dbh.php";
require "../form/session_time.php";
$ex_id_ses = $_SESSION['ex_id'];
// Define variables and initialize with empty values
$detail_pekerjaan = "";
$detail_pekerjaan_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["dj_id"]) && !empty($_POST["dj_id"])){
    // Get hidden input value
    $dj_id = $_POST["dj_id"];
    
    // Validate Job Detail
    $input_detail_pekerjaan = trim($_POST["detail_pekerjaan"]);
    if(empty($input_detail_pekerjaan)){
        $detail_pekerjaan_err = "Please input the job detail.";
    } else{
        $detail_pekerjaan = ucfirst($input_detail_pekerjaan);
    }
    
    // Check input errors before inserting in database
    if(empty($detail_pekerjaan_err)){
        // Prepare an update statement
        //$sql = "UPDATE award SET pd_id=?, nama=?, tanggal=? WHERE aw_id=?";
        $sql = "UPDATE detail_job SET ex_id=?, detail_pekerjaan=? WHERE dj_id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            $ex_id = $ex_id_ses;
            mysqli_stmt_bind_param($stmt, "isi", $ex_id, $detail_pekerjaan, $dj_id);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: ../form/php-experience-jobdetail.php?ex_id=".$ex_id);
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
    if(isset($_GET["dj_id"]) && !empty(trim($_GET["dj_id"]))){
        // Get URL parameter
        $dj_id =  trim($_GET["dj_id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM detail_job WHERE dj_id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $dj_id);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $detail_pekerjaan = $row["detail_pekerjaan"];
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
                        <h2>Update Job Detail Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the Job Detail record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($detail_pekerjaan_err)) ? 'has-error' : ''; ?>">
                            <label>Job Detail</label>
                            <textarea class="form-control" rows="5" id="detail_pekerjaan" name="detail_pekerjaan" placeholder="Job Detail"><?php echo $detail_pekerjaan; ?></textarea><br>
                            <span class="help-block"><?php echo $detail_pekerjaan_err;?></span>
                        </div>
                        <input type="hidden" name="dj_id" value="<?php echo $dj_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <?php echo "<a href='../form/php-experience-jobdetail.php?ex_id=".$ex_id_ses."' class = 'btn btn-default'>Cancel</a>"?>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>