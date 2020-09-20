<?php
// Include config file
require_once "dbh.php";
session_start();
$pd_id_ses = $_SESSION['pd_id'];
// Define variables and initialize with empty values
$nama = $posisi = $detail_organisasi = $tanggal = $detail_pekerjaan = "";
$nama_err = $posisi_err = $detail_organisasi_err = $tanggal_err = $detail_pekerjaan_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["or_id"]) && !empty($_POST["or_id"])){
    // Get hidden input value
    $or_id = $_POST["or_id"];
    
    // Validate name
    $input_nama = trim($_POST["nama"]);
    if(empty($input_nama)){
        $nama_err = "Please enter the organization name.";
    } else{
        $nama = $input_nama;
    }
    
    // Validate posisi
    $input_posisi = trim($_POST["posisi"]);
    if(empty($input_posisi)){
        $posisi_err = "Please enter the position.";     
    } else{
        $posisi = $input_posisi;
    }
    
    // Validate detail_organisasi_err
    $input_detail_organisasi = trim($_POST["detail_organisasi"]);
    if(empty($input_detail_organisasi)){
        $detail_organisasi_err = "Please enter the organization detail.";     
    } else{
        $detail_organisasi = $input_detail_organisasi;
    }

    // Validate tanggal_err
    $input_tanggal = trim($_POST["tanggal"]);
    if(empty($input_tanggal)){
        $tanggal_err = "Please enter the date detail.";     
    } else{
        $tanggal = $input_tanggal;
    }

    // Validate detail_pekerjaan
    $input_detail_pekerjaan = trim($_POST["detail_pekerjaan"]);
    if(empty($input_detail_pekerjaan)){
        $detail_pekerjaan_err = "Please enter the job detail.";     
    } else{
        $detail_pekerjaan = $input_detail_pekerjaan;
    }
    
    // Check input errors before inserting in database
    if(empty($nama_err) && empty($posisi_err) && empty($detail_organisasi_err) && empty($tanggal_err) && empty($detail_pekerjaan_err)){
        // Prepare an update statement
        $sql = "UPDATE organization SET pd_id=?, nama=?, posisi=?, detail_organisasi=?, tanggal=?, detail_pekerjaan=? WHERE or_id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            $pd_id = $pd_id_ses;
            mysqli_stmt_bind_param($stmt, "isssssi", $pd_id, $nama, $posisi, $detail_organisasi, $tanggal, $detail_pekerjaan, $or_id);
            
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
    if(isset($_GET["or_id"]) && !empty(trim($_GET["or_id"]))){
        // Get URL parameter
        $or_id =  trim($_GET["or_id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM organization WHERE or_id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $or_id);
            
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
                    $detail_organisasi = $row["detail_organisasi"];
                    $tanggal = $row["tanggal"];
                    $detail_pekerjaan = $row["detail_pekerjaan"];
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
                        <h2>Update Organization Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Nama Organisasi</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>">
                            <span class="help-block"><?php echo $nama_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($detail_organisasi_err)) ? 'has-error' : ''; ?>">
                            <label>Detail Organisasi</label>
                            <input type="text" name="detail_organisasi" class="form-control" value="<?php echo $detail_organisasi; ?>">
                            <span class="help-block"><?php echo $detail_organisasi_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($posisi_err)) ? 'has-error' : ''; ?>">
                            <label>Posisi</label>
                            <textarea name="posisi" class="form-control"><?php echo $posisi; ?></textarea>
                            <span class="help-block"><?php echo $posisi_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($detail_pekerjaan_err)) ? 'has-error' : ''; ?>">
                            <label>Detail Pekerjaan</label>
                            <input type="text" name="detail_pekerjaan" class="form-control" value="<?php echo $detail_pekerjaan; ?>">
                            <span class="help-block"><?php echo $detail_pekerjaan_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($tanggal_err)) ? 'has-error' : ''; ?>">
                            <label>Tanggal</label>
                            <input type="month" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>">
                            <span class="help-block"><?php echo $tanggal_err;?></span>
                        </div>
                        <input type="hidden" name="or_id" value="<?php echo $or_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="form.php" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>