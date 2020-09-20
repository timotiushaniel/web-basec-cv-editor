<?php
// Include config file
require_once "../dbh.php";
require "../form/session_time.php";
$pd_id_ses = $_SESSION['pd_id'];
// Define variables and initialize with empty values
$nama = $posisi = $detail_job = $tanggal = $detail_perusahaan = "";
$nama_err = $posisi_err = $detail_job_err = $tanggal_err = $detail_perusahaan_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["ox_id"]) && !empty($_POST["ox_id"])){
    // Get hidden input value
    $ox_id = $_POST["ox_id"];
    
    // Validate name
    $input_nama = trim($_POST["nama"]);
    if(empty($input_nama)){
        $nama_err = "Please enter the company name.";
    } else{
        $nama = ucfirst($input_nama);
    }
    
    // Validate posisi
    $input_posisi = trim($_POST["posisi"]);
    if(empty($input_posisi)){
        $posisi_err = "Please enter the position.";     
    } else{
        $posisi = ucfirst($input_posisi);
    }
    
    // Validate detail_job_err
    $input_detail_job = trim($_POST["detail_job"]);
    if(empty($input_detail_job)){
        $detail_job_err = "Please enter the job detail.";     
    } else{
        $detail_job = ucfirst($input_detail_job);
    }

    // Validate tanggal_err
    $input_tanggal = trim($_POST["tanggal"]);
    if(empty($input_tanggal)){
        $tanggal_err = "Please enter the date detail.";     
    } else{
        $tanggal = $input_tanggal;
    }

    // Validate detail_perusahaan
    $input_detail_perusahaan = trim($_POST["detail_perusahaan"]);
    if(empty($input_detail_perusahaan)){
        $posisi_err = "Please enter the company detail.";     
    } else{
        $detail_perusahaan = $input_detail_perusahaan;
    }
    
    // Check input errors before inserting in database
    if(empty($nama_err) && empty($posisi_err) && empty($detail_job_err) && empty($tanggal_err)){
        // Prepare an update statement
        $sql = "UPDATE other_experience SET pd_id=?, nama=?, detail_perusahaan=?, posisi=?, detail_pekerjaan=?, tanggal=? WHERE ox_id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            $pd_id = $pd_id_ses;
            mysqli_stmt_bind_param($stmt, "isssssi", $pd_id, $nama, $detail_perusahaan, $posisi, $detail_job, $tanggal, $ox_id);
            
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
    if(isset($_GET["ox_id"]) && !empty(trim($_GET["ox_id"]))){
        // Get URL parameter
        $ox_id =  trim($_GET["ox_id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM other_experience WHERE ox_id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $ox_id);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $nama = $row["nama"];
                    $posisi = $row["posisi"];
                    $detail_job = $row["detail_pekerjaan"];
                    $tanggal = $row["tanggal"];
                    $detail_perusahaan = $row["detail_perusahaan"];
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
    <title>Update Other Experience Record</title>
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
                        <h2>Update Other Experience Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group <?php echo (!empty($nama_err)) ? 'has-error' : ''; ?>">
                            <label>Company Name</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>">
                            <span class="help-block"><?php echo $nama_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($detail_perusahaan_err)) ? 'has-error' : ''; ?>">
                            <label>Company Detail</label>
                            <input type="text" name="detail_perusahaan" class="form-control" value="<?php echo $detail_perusahaan; ?>">
                            <span class="help-block"><?php echo $detail_perusahaan_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($posisi_err)) ? 'has-error' : ''; ?>">
                            <label>Position</label>
                            <textarea name="posisi" class="form-control"><?php echo $posisi; ?></textarea>
                            <span class="help-block"><?php echo $posisi_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($detail_job_err)) ? 'has-error' : ''; ?>">
                            <label>Job Detail</label>
                            <input type="text" name="detail_job" class="form-control" value="<?php echo $detail_job; ?>">
                            <span class="help-block"><?php echo $detail_job_err;?></span>
                        </div>

                        
                        <div class="form-group <?php echo (!empty($tanggal_err)) ? 'has-error' : ''; ?>">
                            <label>Date</label>
                            <input type="month" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>">
                            <span class="help-block"><?php echo $tanggal_err;?></span>
                        </div>
                        <input type="hidden" name="ox_id" value="<?php echo $ox_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../form/additional_information.php" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>