<?php
// Include config file
require_once "../dbh.php";
require "../form/session_time.php";
$ptc_id_ses = $_SESSION['ptc_id'];
// Define variables and initialize with empty values
$tanggal = "";
$tanggal_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["pcr_id"]) && !empty($_POST["pcr_id"])){
    // Get hidden input value
    $pcr_id = $_POST["pcr_id"];

    $input_tanggal = trim($_POST["tanggal"]);
    if(empty($input_tanggal)){
        $tanggal_err = "Please input the date detail.";
    } else{
        $tanggal= ucfirst($input_tanggal);
    }
    
    // Check input errors before inserting in database
    if(empty($tanggal_err)){
        $ctd_read_sql = "SELECT * FROM ptc_to_procer WHERE pcr_id = ?";
        if($ctd_stmt = mysqli_prepare($conn, $ctd_read_sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($ctd_stmt, "i", $pcr_id);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($ctd_stmt)){
                $ctd_res = mysqli_stmt_get_result($ctd_stmt);
    
                if(mysqli_num_rows($ctd_res) == 1){
                    $ctd_row = mysqli_fetch_array($ctd_res, MYSQLI_ASSOC);
                    
                    $ctd_id_data = $ctd_row["ctd_id"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    $ctd_id_data = 0;
                    header("location: ../error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again.";
            }
        }

        // Prepare an update statement
        //$sql = "UPDATE award SET pd_id=?, nama=?, tanggal=? WHERE aw_id=?";
        $sql = "UPDATE ptc_to_procer SET ptc_id=?, ctd_id=?, tanggal=? WHERE pcr_id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            $ptc_id = $ptc_id_ses;
            $ctd_id = $ctd_id_data;
            mysqli_stmt_bind_param($stmt, "iisi", $ptc_id, $ctd_id, $tanggal, $pcr_id);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: ../form/php-procer-detail.php?ptc_id=".$ptc_id_ses);
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
    if(isset($_GET["pcr_id"]) && !empty(trim($_GET["pcr_id"]))){
        // Get URL parameter
        $pcr_id =  trim($_GET["pcr_id"]);
        
        // Prepare a select statement
        $sql = "SELECT ptc_to_procer.ctd_id AS ctd_id, ptc_to_procer.pcr_id AS pcr_id, cer_type_detail.certi_name AS certi_name, ptc_to_procer.tanggal AS tanggal
        FROM cer_type_detail, pd_to_ctd, ptc_to_procer
        WHERE cer_type_detail.ctd_id = ptc_to_procer.ctd_id AND pd_to_ctd.ptc_id = ptc_to_procer.ptc_id AND pcr_id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $pcr_id);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $certi_name = $row["certi_name"];
                    $tanggal = $row["tanggal"];
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
                        <h2>Update Course Detail Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the Course Detail record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                        <div class="form-group">
                            <label>Course Name</label>
                            <p class="form-control-static"><?php echo $certi_name; ?></p>
                        </div>

                        <div class="form-group <?php echo (!empty($tanggal_err)) ? 'has-error' : ''; ?>">
                            <label>Date:</label><br>
                            <input type="month" class="form-control" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>">
                            <span class="help-block"><?php echo $tanggal_err;?></span>
                        </div>

                        <input type="hidden" name="pcr_id" value="<?php echo $pcr_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <?php echo "<a href='../form/php-procer-detail.php?ptc_id=".$ptc_id_ses."' class = 'btn btn-default'>Cancel</a>"?>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>