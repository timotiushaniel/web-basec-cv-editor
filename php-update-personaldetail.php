<?php
// Include config file
require_once "dbh.php";
session_start();
$pd_id_ses = $_SESSION['pd_id'];
$UserId = $_SESSION['user_id'];
// Define variables and initialize with empty values
$nama_lengkap = $nomer_induk = $alamat = $kota = $provinsi = $kodepos = $nomer_telepon = $alamat_email = $path_image = $program_studi_id = "";
$nama_lengkap_err = $nomer_induk_err = $alamat_err = $kota_err = $provinsi_err = $kodepos_err = $nomer_telepon_err = $alamat_email_err = $path_image_err = $program_studi_id_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["pd_id"]) && !empty($_POST["pd_id"])){
    // Get hidden input value
    $pd_id = $_POST["pd_id"];
    
    // Validate name
    $input_nama_lengkap = trim($_POST["FullName"]);
    if(empty($input_nama_lengkap)){
        $nama_lengkap_err = "Please enter the full name.";
    } else{
        $nama_lengkap = $input_nama_lengkap;
    }
    
    // Validate nomer induk
    $input_nomer_induk = trim($_POST["NIM"]);
    if(empty($input_nomer_induk)){
        $nomer_induk_err = "Please enter the identity number.";     
    } else{
        $nomer_induk = $input_nomer_induk;
    }
    
    // Validate alamat
    $input_alamat = trim($_POST["Address"]);
    if(empty($input_alamat)){
        $alamat_err = "Please enter the address.";     
    } else{
        $alamat = $input_alamat;
    }

    // Validate kota
    $input_kota = trim($_POST["City"]);
    if(empty($input_kota)){
        $kota_err = "Please enter the city detail.";     
    } else{
        $kota = $input_kota;
    }

    // Validate provinsi
    $input_provinsi = trim($_POST["Province"]);
    if(empty($input_provinsi)){
        $provinsi_err = "Please enter the province detail.";     
    } else{
        $provinsi = $input_provinsi;
    }

    // Validate kodepos
    $input_kodepos = trim($_POST["ZipCode"]);
    if(empty($input_kodepos)){
        $kodepos_err = "Please enter the ZIP Code.";     
    } else{
        $kodepos = $input_kodepos;
    }

    // Validate nomer_telepon
    $input_nomer_telepon = trim($_POST["Phone"]);
    if(empty($input_nomer_telepon)){
        $nomer_telepon_err = "Please enter the phone number.";     
    } else{
        $nomer_telepon = $input_nomer_telepon;
    }

    // Validate alamat_email
    $input_alamat_email = trim($_POST["Email"]);
    if(empty($input_alamat_email)){
        $alamat_email_err = "Please enter the email address.";     
    } else{
        $alamat_email = $input_alamat_email;
    }

    // Validate path_image
    $input_path_image = trim($_POST["Photo"]);
    if(empty($input_path_image)){
        $path_image_err = "Please enter the path image.";     
    } else{
        $path_image = $input_path_image;
    }

    // Validate program_studi_id
    $input_program_studi_id = trim($_POST["program_studi"]);
    if(empty($input_program_studi_id)){
        $program_studi_id_err = "Please enter the program studi.";     
    } else{
        $program_studi_id = $input_program_studi_id;
    }
    
    // Check input errors before inserting in database
    if(empty($nama_lengkap_err) && empty($nomer_induk_err) && empty($alamat_err) && empty($kota_err) && empty($provinsi_err) && empty($kodepos_err) && empty($nomer_telepon_err) && empty($alamat_email_err) && empty($path_image_err) && empty($program_studi_id_err)){
        // Prepare an update statement
        $sql = "UPDATE personal_detail SET us_id=?, ps_id=?, no_induk=?, nama=?, alamat=?, kota=?, propinsi=?, kode_pos=?, no_telpon=?, email=?, path_image=? WHERE pd_id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            $pd_id = $pd_id_ses;
            mysqli_stmt_bind_param($stmt, "iissssssissi", $UserId, $program_studi_id, $nomer_induk, $nama_lengkap, $alamat, $kota, $provinsi, $kodepos, $nomer_telepon, $alamat_email, $path_image, $pd_id_ses);
            
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
    if(isset($_GET["pd_id"]) && !empty(trim($_GET["pd_id"]))){
        // Get URL parameter
        $pd_id =  trim($_GET["pd_id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM personal_detail WHERE pd_id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $pd_id);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $nama_lengkap = $row["nama"];
                    $nomer_induk = $row["no_induk"];
                    $alamat = $row["alamat"];
                    $kota = $row["kota"];
                    $provinsi = $row["propinsi"];
                    $kodepos = $row["kode_pos"];
                    $nomer_telepon = $row["no_telpon"];
                    $alamat_email = $row["email"];
                    $path_image = $row["path_image"];
                    $program_studi_id = $row["ps_id"];
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
        header("location: sss.php");
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
        a{
          width:50%;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Personal Data Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nama_lengkap_err)) ? 'has-error' : ''; ?>">
                            <label>Nama Lengkap</label>
                            <input type="text" name="FullName" class="form-control" value="<?php echo $nama_lengkap; ?>">
                            <span class="help-block"><?php echo $nama_lengkap_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($alamat_err)) ? 'has-error' : ''; ?>">
                            <label>Alamat</label>
                            <input type="text" name="Address" class="form-control" value="<?php echo $alamat; ?>">
                            <span class="help-block"><?php echo $alamat_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($kota_err)) ? 'has-error' : ''; ?>">
                            <label>Kota</label>
                            <input type="text" name="City" class="form-control" value="<?php echo $kota; ?>">
                            <span class="help-block"><?php echo $kota_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($provinsi_err)) ? 'has-error' : ''; ?>">
                            <label>Propinsi</label>
                            <input type="text" name="Province" class="form-control" value="<?php echo $provinsi; ?>">
                            <span class="help-block"><?php echo $provinsi_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($kodepos_err)) ? 'has-error' : ''; ?>">
                            <label>Kode Pos</label>
                            <input type="text" name="ZipCode" class="form-control" value="<?php echo $kodepos; ?>">
                            <span class="help-block"><?php echo $kodepos_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($nomer_telepon_err)) ? 'has-error' : ''; ?>">
                            <label>Nomer Telepon</label><br>
                                <table width=100%>
                                    <tr>
                                        <td width="10%" style="text-align:center">+62</td>
                                        <td><input type="text" name="Phone" class="form-control" value="<?php echo $nomer_telepon; ?>"></td>
                                    <tr>
                                </table>
                            <span class="help-block"><?php echo $nomer_telepon_err;?></span>
                        </div>

                        
                        <div class="form-group <?php echo (!empty($alamat_email_err)) ? 'has-error' : ''; ?>">
                            <label>Email</label>
                            <input type="text" name="Email" class="form-control" value="<?php echo $alamat_email; ?>">
                            <span class="help-block"><?php echo $alamat_email_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($nomer_induk_err)) ? 'has-error' : ''; ?>">
                            <label>Nomer Induk</label>
                            <input type="text" name="NIM" class="form-control" value="<?php echo $nomer_induk; ?>">
                            <span class="help-block"><?php echo $nomer_induk_err;?></span>
                        </div>

                        <div class="form-group <?php // echo (!empty($program_studi_id)) ? 'has-error' : ''; ?>">
                            <label>Program Studi</label>
                            <select class="form-control" id="program_studi" name="program_studi">
                                <option value="1" <?php if ($program_studi_id == 1) {echo "selected";} ?>>Mobile Technology</option>
                                <option value="2" <?php if ($program_studi_id == 2) {echo "selected";} ?>>Media Internet Technology</option>
                            </select>
                            <span class="help-block"><?php echo $program_studi_id_err;?></span>
                        </div>

                        <div class="form-group">
						      <label><b>Photo :</b></label>
                              <a type="button" href="php-create-photo.php" class="btn btn-success">Add Photo</a>
                                <br>
                        </div>
                        
                        
                        <input type="hidden" name="pd_id" value="<?php echo $pd_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="form.php" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>