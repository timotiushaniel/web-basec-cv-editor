<?php
// Include config file
require_once "../dbh.php";
require "../form/session_time.php";
$te_id_ses = $_SESSION['te_id'];
// Define variables and initialize with empty values
$detail_teknologi = "";
$detail_teknologi_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["dt_id"]) && !empty($_POST["dt_id"])){
    // Get hidden input value
    $dt_id = $_POST["dt_id"];
    
    // Validate Job Detail
    $input_detail_teknologi = trim($_POST["detail_teknologi"]);
    if(empty($input_detail_teknologi)){
        $detail_teknologi_err = "Please input the technology detail.";
    } else{
        $detail_teknologi = ucfirst($input_detail_teknologi);
    }
    
    // Check input errors before inserting in database
    if(empty($detail_teknologi_err)){
        // Prepare an update statement
        //$sql = "UPDATE award SET pd_id=?, nama=?, tanggal=? WHERE aw_id=?";
        $sql = "UPDATE detail_technology SET te_id=?, detail_teknologi=? WHERE dt_id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            $te_id = $te_id_ses;
            mysqli_stmt_bind_param($stmt, "isi", $te_id, $detail_teknologi, $dt_id);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: ../form/php-technology-technologydetail.php?te_id=".$te_id);
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
    if(isset($_GET["dt_id"]) && !empty(trim($_GET["dt_id"]))){
        // Get URL parameter
        $dt_id =  trim($_GET["dt_id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM detail_technology WHERE dt_id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $dt_id);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $detail_teknologi = $row["detail_teknologi"];
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
                        <h2>Update Technology Detail Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the Technology Detail record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($detail_teknologi_err)) ? 'has-error' : ''; ?>">
                            <label>Technology Detail</label>
                            <textarea class="form-control" rows="5" id="detail_teknologi" name="detail_teknologi" placeholder="Technology Detail"><?php echo $detail_teknologi; ?></textarea><br>
                            <span class="help-block"><?php echo $detail_teknologi_err;?></span>
                        </div>
                        <input type="hidden" name="dt_id" value="<?php echo $dt_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <?php echo "<a href='../form/php-technology-technologydetail.php?te_id=".$te_id_ses."' class = 'btn btn-default'>Cancel</a>"?>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>