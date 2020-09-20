<?php
// Include config file
require_once "../dbh.php";
require "../form/session_time.php";
$pd_id_ses = $_SESSION['pd_id'];
$UserId = $_SESSION['user_id'];
// Define variables and initialize with empty values
$nama_lengkap = $nomer_induk = $alamat = $kota = $provinsi = $negara = $kodepos = $nomer_telepon = $alamat_email = $program_studi_id = "";
$nama_lengkap_err = $nomer_induk_err = $alamat_err = $kota_err = $provinsi_err = $negara_err = $kodepos_err = $nomer_telepon_err = $alamat_email_err = $program_studi_id_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["pd_id"]) && !empty($_POST["pd_id"])){
    // Get hidden input value
    $pd_id = $_POST["pd_id"];
    
    // Validate name
    $input_nama_lengkap = trim($_POST["FullName"]);
    if(empty($input_nama_lengkap)){
        $nama_lengkap_err = "Please enter the full name.";
    } else{
        $nama_lengkap = ucwords($input_nama_lengkap);
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
        $alamat = ucfirst($input_alamat);
    }

    // Validate kota
    $input_kota = trim($_POST["City"]);
    if(empty($input_kota)){
        $kota_err = "Please enter the city detail.";     
    } else{
        $kota = ucfirst($input_kota);
    }

    // Validate provinsi
    $input_provinsi = trim($_POST["Province"]);
    if(empty($input_provinsi)){
        $provinsi_err = "Please enter the province detail.";     
    } else{
        $provinsi = $input_provinsi;
    }

    // Validate provinsi
    $input_negara = trim($_POST["negara"]);
    if(empty($input_negara)){
        $negara_err = "Please enter the country detail.";     
    } else{
        $negara = $input_negara;
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

    // Validate program_studi_id
    $input_program_studi_id = trim($_POST["program_studi"]);
    if(empty($input_program_studi_id)){
        $program_studi_id_err = "Please enter the program studi.";     
    } else{
        $program_studi_id = $input_program_studi_id;
    }
    
    // Check input errors before inserting in database
    if(empty($nama_lengkap_err) && empty($nomer_induk_err) && empty($alamat_err) && empty($kota_err) && empty($provinsi_err) && empty($negara_err) && empty($kodepos_err) && empty($nomer_telepon_err) && empty($alamat_email_err) && empty($path_image_err) && empty($program_studi_id_err)){
        // Prepare an update statement
        $sql = "UPDATE personal_detail SET us_id=?, ps_id=?, no_induk=?, nama=?, alamat=?, kota=?, propinsi=?, negara=?, kode_pos=?, no_telpon=?, email=? WHERE pd_id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            $pd_id = $pd_id_ses;
            mysqli_stmt_bind_param($stmt, "iisssssssisi", $UserId, $program_studi_id, $nomer_induk, $nama_lengkap, $alamat, $kota, $provinsi, $negara, $kodepos, $nomer_telepon, $alamat_email, $pd_id_ses);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: ../form/personaldata.php");
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
                    $negara = $row["negara"];
                    $kodepos = $row["kode_pos"];
                    $nomer_telepon = $row["no_telpon"];
                    $alamat_email = $row["email"];
                    $program_studi_id = $row["ps_id"];
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
                            <label>Full Name</label>
                            <input type="text" name="FullName" class="form-control" value="<?php echo $nama_lengkap; ?>">
                            <span class="help-block"><?php echo $nama_lengkap_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($alamat_err)) ? 'has-error' : ''; ?>">
                            <label>Address</label>
                            <input type="text" name="Address" class="form-control" value="<?php echo $alamat; ?>">
                            <span class="help-block"><?php echo $alamat_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($kota_err)) ? 'has-error' : ''; ?>">
                            <label>City</label>
                            <input type="text" name="City" class="form-control" value="<?php echo $kota; ?>">
                            <span class="help-block"><?php echo $kota_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($provinsi_err)) ? 'has-error' : ''; ?>">
                            <label>Province</label>
                            <select class="form-control" name="Province" id="Province">
                                <option disabled selected> Pilih </option>
                                <?php
                                require_once "../dbh.php";
                                $option_sql_read = "SELECT * FROM provinsi";
                                if ($option_result = mysqli_query($conn, $option_sql_read)) {
                                    if(mysqli_num_rows($option_result) > 0){
                                        while ($row = mysqli_fetch_array($option_result)) {
                                        $provinsii = $row["nama_provinsi"];
                                ?>
                                        <option value="<?=$row[0]?>" <?php if ($provinsi == $row[0]) {echo "selected";}?>><?=$provinsii?></option> 
                                <?php
                                        }       
                                    }                                                   
                                }
                                ?>
                            </select>
                            </div>

                            <div class="form-group">
                            <label>Country</label>
                            <select class="form-control" name="negara" id="Country">
                                <option selected> Pilih </option>
                                <?php
                                require_once "../dbh.php";
                                require_once "../konstanta.php";
                                $optionnegara_sql_read = "SELECT * FROM ".NEGARA.";";
                                echo  $optionnegara_sql_read;
                                if ($optionnegara_result = mysqli_query($conn, $optionnegara_sql_read)) {
                                    if(mysqli_num_rows($optionnegara_result) > 0){
                                        while ($row_negara = mysqli_fetch_array($optionnegara_result)) {
                                        $negaraa = $row_negara['nama_negara'];
                                ?>     
                                        <option value="<?=$row_negara[0]?>" <?php if ($negara == $row_negara[0]) {echo "selected";}?>><?=$negaraa?></option> 
                                <?php
                                        }    
                                    }                                                    
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group <?php echo (!empty($kodepos_err)) ? 'has-error' : ''; ?>">
                            <label>Zip Code</label>
                            <input type="text" name="ZipCode" class="form-control" value="<?php echo $kodepos; ?>">
                            <span class="help-block"><?php echo $kodepos_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($nomer_telepon_err)) ? 'has-error' : ''; ?>">
                            <label>Phone Number</label><br>
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
                            <label>ID Number</label>
                            <input type="text" name="NIM" class="form-control" value="<?php echo $nomer_induk; ?>">
                            <span class="help-block"><?php echo $nomer_induk_err;?></span>
                        </div>

                        <div class="form-group <?php // echo (!empty($program_studi_id)) ? 'has-error' : ''; ?>">
                            <label>Study Program</label>
                            <select class="form-control" id="program_studi" name="program_studi">
                                <option value="1" <?php if ($program_studi_id == 1) {echo "selected";} ?>>Mobile Technology</option>
                                <option value="2" <?php if ($program_studi_id == 2) {echo "selected";} ?>>Media Internet Technology</option>
                            </select>
                            <span class="help-block"><?php echo $program_studi_id_err;?></span>
                        </div>                       
                        <input type="hidden" name="pd_id" value="<?php echo $pd_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../form/personaldata.php" class="btn btn-danger">Cancel</a>
                        <br>
                    </form><br>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>