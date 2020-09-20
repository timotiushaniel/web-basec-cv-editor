<?php
// Include config file
require_once "../dbh.php";
require "../form/session_time.php";
$pd_id_ses = $_SESSION['pd_id'];
$UserId = $_SESSION['user_id'];
// Define variables and initialize with empty values
$nama = $kota = $concentration = $gelar = $ipk = $tanggal = $negara = "";
$nama_err = $kota_err = $concentration_err = $gelar_err = $ipk_err = $tanggal_err = $negara_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["he_id"]) && !empty($_POST["he_id"])){
    // Get hidden input value
    $he_id = $_POST["he_id"];
    
    // Validate name
    $input_nama = trim($_POST["college"]);
    if(empty($input_nama)){
        $nama_err = "Please enter the College name.";
    } else{
        $nama = ucfirst($input_nama);
    }
    
    // Validate city college
    $input_kota = trim($_POST["City_college"]);
    if(empty($input_kota)){
        $kota_err = "Please enter the city details.";     
    } else{
        $kota = ucfirst($input_kota);
    }
    
    // Validate gelar
    $input_gelar = trim($_POST["graduate_degree"]);
    if(empty($input_gelar)){
        $gelar_err = "Please enter the graduate degree.";     
    } else{
        $gelar = ucfirst($input_gelar);
    }

    // Validate concentration_of_expertise
    $input_concentration = trim($_POST["concentration_of_expertise"]);
    if(empty($input_concentration)){
        $concentration_err = "Please enter the concentration detail.";     
    } else{
        $concentration = ucfirst($input_concentration);
    }

    // Validate ipk
    $input_ipk = trim($_POST["ipk"]);
    if(empty($input_ipk)){
        $ipk_err = "Please enter the ipk detail.";  
    } 
    elseif (($input_ipk < '0') && ($input_ipk > '4')) {
        $ipk_err = "Please enter the ipk between 0 and 4.";
    }  
    else{
        $ipk = $input_ipk;
    }

    // Validate tanggal
    $input_tanggal = trim($_POST["graduate_ithb"]);
    if(empty($input_tanggal)){
        $tanggal_err = "Please enter the date detail."; //belum jalan    
    } else{
        $tanggal = $input_tanggal;
    }

    // Validate negara
    $input_negara = trim($_POST["negara"]);
    if(empty($input_negara)){
        $negara_err = "Please enter the country detail.";     
    } else{
        $negara = ($input_negara);
    }
    
    // Check input errors before inserting in database
    if(empty($nama_err) && empty($kota_err) && empty($concentration_err) && empty($gelar_err) && empty($ipk_err) && empty($tanggal_err) && empty($negara_err)){
        // Prepare an update statement
        $sql = "UPDATE higher_education SET pd_id=?, nama=?, kota=?, jurusan=?, concentration=?, gelar=?, ipk=?, tanggal=?, negara=? WHERE he_id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            $pd_id = $pd_id_ses;
            mysqli_stmt_bind_param($stmt, "ississdssi", $pd_id_ses, $nama, $kota, $ps_id_ses, $concentration, $gelar, $ipk, $tanggal, $negara, $he_id);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: ../form/college.php");
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
    if(isset($_GET["he_id"]) && !empty(trim($_GET["he_id"]))){
        // Get URL parameter
        $he_id =  trim($_GET["he_id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM higher_education WHERE he_id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $he_id);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $nama = $row["nama"];
                    $kota = $row["kota"];
                    $jurusan = $row["jurusan"];
                    $concentration = $row["concentration"];
                    $gelar = $row["gelar"];
                    $ipk = $row["ipk"];
                    $tanggal = $row["tanggal"];
                    $negara = $row["negara"];
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
                        <div class="form-group <?php echo (!empty($nama_err)) ? 'has-error' : ''; ?>">
                            <label>College Name</label>
                            <input type="text" name="college" class="form-control" value="<?php echo $nama; ?>">
                            <span class="help-block"><?php echo $nama_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($kota_err)) ? 'has-error' : ''; ?>">
                            <label>College City</label>
                            <input type="text" name="City_college" class="form-control" value="<?php echo $kota; ?>">
                            <span class="help-block"><?php echo $kota_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($negara_err)) ? 'has-error' : ''; ?>">
                            <label>Country</label>
                            <input type="text" name="negara" class="form-control" value="<?php echo $negara; ?>">
                            <span class="help-block"><?php echo $negara_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($gelar_err)) ? 'has-error' : ''; ?>">
                            <label>Degree</label>
                            <input type="text" name="graduate_degree" class="form-control" value="<?php echo $gelar; ?>">
                            <span class="help-block"><?php echo $gelar_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($concentration_err)) ? 'has-error' : ''; ?>">
                            <label>Concentration</label>
                            <input type="text" name="concentration_of_expertise" class="form-control" value="<?php echo $concentration; ?>">
                            <span class="help-block"><?php echo $concentration_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($ipk_err)) ? 'has-error' : ''; ?>">
                            <label>Grade-point average</label>
                            <input type="number" step="0.01" min="0" max="4" name="ipk" class="form-control" value="<?php echo $ipk; ?>">
                            <span class="help-block"><?php echo $ipk_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($tanggal_err)) ? 'has-error' : ''; ?>">
                            <label>Graduate Date:</label><br>
                            <input type="month" class="form-control" id="graduate_ithb" name="graduate_ithb" value="<?php echo $tanggal; ?>">
                            <span class="help-block"><?php echo $tanggal_err;?></span>
                        </div>

                        <input type="hidden" name="he_id" value="<?php echo $he_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../form/college.php" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>