<?php
// Include config file
require_once "dbh.php";
session_start();
$pd_id_ses = $_SESSION['pd_id'];
$UserId = $_SESSION['user_id'];
// Define variables and initialize with empty values
$nama = $kota = $jurusan = $concentration = $gelar = $ipk = $tanggal = $negara = "";
$nama_err = $kota_err = $jurusan_err = $concentration_err = $gelar_err = $ipk_err = $tanggal_err = $negara_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["pd_id"]) && !empty($_POST["pd_id"])){
    // Get hidden input value
    $pd_id = $_POST["pd_id"];
    
    // Validate name
    $input_nama = trim($_POST["college"]);
    if(empty($input_nama)){
        $nama_err = "Please enter the College name.";
    } else{
        $nama = $input_nama;
    }
    
    // Validate nomer induk
    $input_kota = trim($_POST["City_college"]);
    if(empty($input_kota)){
        $kota_err = "Please enter the City College.";     
    } else{
        $kota = $input_kota;
    }

    // Validate nomer induk
    $input_jurusan = trim($_POST["program_studi"]);
    if(empty($input_jurusan)){
        $jurusan_err = "Please enter the Program Studi.";     
    } else{
        $jurusan = $input_jurusan;
    }
    
    // Validate alamat
    $input_concentration = trim($_POST["concentration_of_expertise"]);
    if(empty($input_concentration)){
        $concentration_err = "Please enter the concentration of expertise.";     
    } else{
        $concentration = $input_concentration;
    }

    // Validate kota
    $input_gelar = trim($_POST["graduate_degree"]);
    if(empty($input_gelar)){
        $gelar_err = "Please enter the graduate degree.";     
    } else{
        $gelar = $input_gelar;
    }

    // Validate provinsi
    $input_ipk = trim($_POST["ipk"]);
    if(empty($input_ipk)){
        $ipk_err = "Please enter the IPK.";     
    } else{
        $ipk = $input_ipk;
    }

    // Validate kodepos
    $input_tanggal = trim($_POST["graduate_ithb"]);
    if(empty($input_tanggal)){
        $tanggal_err = "Please enter the graduate date.";     
    } else{
        $tanggal = $input_tanggal;
    }


 
    
    // Check input errors before inserting in database
    if(empty($nama_err) && empty($kota_err) && empty($jurusan_err) && empty($concentration_err) && empty($gelar_err) && empty($ipk_err) && empty($tanggal_err)){
        // Prepare an update statement // baru ampe sini
        $sql = "UPDATE higher_education SET us_id=?, ps_id=?, no_induk=?, nama=?, alamat=?, kota=?, propinsi=?, kode_pos=?, no_telpon=?, email=?, path_image=? WHERE pd_id=?";
         
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
        ///////////////////////////////////////////////////////////////////////////////bingung///////
        // Prepare a select statement
        $sql = "SELECT * FROM higher_education WHERE pd_id = ?";
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
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update College Record</h2>
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

                        <div class="form-group <?php echo (!empty($path_image)) ? 'has-error' : ''; ?>">
                            <label>Foto</label>
                            <input type="file" class="form-control-file border" id="Photo" name="Photo" accept="image/*">
                            <br>
                            <span class="help-block"><?php echo $path_image_err;?></span>
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