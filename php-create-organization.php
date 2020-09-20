<?php
// Include config file
require_once "dbh.php";
session_start();
$pd_id_ses = $_SESSION['pd_id'];
// Define variables and initialize with empty values
$nama = $posisi = $detail_organisasi = $tanggal = $detail_pekerjaan = "";
$nama_err = $posisi_err = $detail_organisasi_err = $tanggal_err = $detail_pekerjaan_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
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
        // Prepare an insert statement
        $sql = "INSERT INTO organization (pd_id, nama, posisi, detail_organisasi, tanggal, detail_pekerjaan) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            $pd_id = $pd_id_ses;
            mysqli_stmt_bind_param($stmt, "isssss", $pd_id, $nama, $posisi, $detail_organisasi, $tanggal, $detail_pekerjaan);
            
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
                        <h2>Insert Organization Record</h2>
                    </div>
                    <p>Please fill this form and submit to add Organization record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nama_err)) ? 'has-error' : ''; ?>">
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

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="form.php" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>