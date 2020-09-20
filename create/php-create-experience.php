<?php
// Include config file
require_once "../dbh.php";
require "../form/session_time.php";
$pd_id_ses = $_SESSION['pd_id'];
// Define variables and initialize with empty values
$nama = $kota = $negara = $tanggal_mulai = $tanggal_selesai = $posisi = $status = $deskripsi = $scoping_statement =  "";
$nama_err = $kota_err = $negara_err = $tanggal_mulai_err = $tanggal_selesai_err = $posisi_err = $status_err = $deskripsi_err = $scoping_statement_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_nama = trim($_POST["nama"]);
    if(empty($input_nama)){
        $nama_err = "Please enter the company name.";
    } else{
        $nama = ucfirst($input_nama);
    }
    
    // Validate kota
    $input_kota = trim($_POST["kota"]);
    if(empty($input_kota)){
        $kota_err = "Please enter the City of Company.";     
    } else{
        $kota = ucfirst($input_kota);
    }
    
    // Validate negara_err
    $input_negara = trim($_POST["negara"]);
    if(empty($input_negara)){
        $detail_negara_err = "Please enter the Country in Company.";     
    } else{
        $negara = ucfirst($input_negara);
    }

    // Validate tanggal_mulai_err
    $input_tanggal_mulai = trim($_POST["tanggal_mulai"]);
    if(empty($input_tanggal_mulai)){
        $tanggal_mulai_err = "Please enter the date detail.";     
    } else{
        $tanggal_mulai = $input_tanggal_mulai;
    }

    // Validate tanggal_selesai_err
    $input_tanggal_selesai = trim($_POST["tanggal_selesai"]);
    $input_tanggal_selesaii = trim($_POST["tanggal_selesaii"]);
    if ($input_tanggal_selesaii == "Present") {
        $tanggal_selesai = "Present";
    }else {
        if(empty($input_tanggal_selesai)){
            $tanggal_selesai_err = "Please enter the date detail.";     
        } else{
            $tanggal_selesai = $input_tanggal_selesai;
            }
        }

    // Validate posisi_err
    $input_posisi = trim($_POST["posisi"]);
    if(empty($input_posisi)){
        $detail_posisi_err = "Please enter the position in Company.";     
    } else{
        $posisi = ucfirst($input_posisi);
    }

    // Validate status_err
    $input_status = trim($_POST["status"]);
    if(empty($input_status)){
        $detail_status_err = "Please enter the status in Company.";     
    } else{
        $status = ucfirst($input_status);
    }

    // Validate deskripsi_err
    $input_deskripsi = trim($_POST["deskripsi"]);
    if(empty($input_deskripsi)){
        $detail_deskripsi_err = "Please describe your Company.";     
    } else{
        $deskripsi = ucfirst($input_deskripsi);
    }

    // Validate scoping_statement_err
    $input_scoping_statement = trim($_POST["scoping_statement"]);
    if(empty($input_scoping_statement)){
        $scoping_statement_err = "Please describe your general job description.";     
    } else{
        $scoping_statement = ucfirst($input_scoping_statement);
    }

    // Check input errors before inserting in database
    if(empty($nama_err) && empty($kota_err) && empty($detail_negara_err) && empty($tanggal_mulai_err) && empty($tanggal_selesai_err) && empty($detail_posisi_err) && empty($detail_status_err) && empty($detail_deskripsi_err) && empty($scoping_statement_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO experience (pd_id, nama_perusahaan, kota, negara, detail_perusahaan, scoping_statement, posisi, status, tanggal_mulai, tanggal_selesai) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            $pd_id = $pd_id_ses;
            mysqli_stmt_bind_param($stmt, "isssssssss", $pd_id, $nama, $kota, $negara, $deskripsi, $scoping_statement, $posisi, $status, $tanggal_mulai, $tanggal_selesai);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: ../form/experience.php");
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
                        <h2>Insert Experience Record</h2>
                    </div>
                    <p>Please fill this form and submit to add Organization record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nama_err)) ? 'has-error' : ''; ?>">
                            <label>Company Name</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>">
                            <span class="help-block"><?php echo $nama_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($kota_err)) ? 'has-error' : ''; ?>">
                            <label>Company City</label>
                            <input type="text" name="kota" class="form-control" value="<?php echo $kota; ?>">
                            <span class="help-block"><?php echo $kota_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($negara_err)) ? 'has-error' : ''; ?>">
                            <label>Company State</label>
                            <input type="text" name="negara" class="form-control" value="<?php echo $negara; ?>">
                            <span class="help-block"><?php echo $negara_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($deskripsi_err)) ? 'has-error' : ''; ?>">
                            <label>Company Detail</label>
                            <textarea name="deskripsi" class="form-control" value="<?php echo $deskripsi; ?>"></textarea> <!-- textarea bukan nya juga dalam value ya?!-->
                            <span class="help-block"><?php echo $deskripsi_err;?></span>
                        </div>
                        
                        <input type="checkbox" class="form-check-input" name="tanggal_selesaii" value="Present" id="myCheck" onclick="myFunction()"><span> I am currently working in this role</span><br>
                        <table width = 100%>
                            <colgroup>
                                <col style="width: 40%">
                                <col style="width: 20%">
                                <col style="width: 40%">
                            </colgroup>
                            <tr>
                                <th style="text-align: center;"><label>Start Date</label></th>
                                <th style="text-align: center;">-</th>
                                <th style="text-align: center;"><label>End Date</label><br></th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group <?php echo (!empty($tanggal_mulai_err)) ? 'has-error' : ''; ?>">
                                        <input type="month" name="tanggal_mulai" class="form-control" value="<?php echo $tanggal_mulai; ?>">
                                        <span class="help-block"><?php echo $tanggal_mulai_err;?></span>
                                    </div>
                                </td>
                                <td>
                                </td>
                                <td style="text-align: center;">
                                    <div class="form-group" id="now" style="display:none; text align: right;">
                                        <span>Present</span>
                                    </div>
                                    <div style="display:block" class="form-group <?php echo (!empty($tanggal_selesai_err)) ? 'has-error' : ''; ?>" id="nope" >
                                        <input type="month" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="<?php echo $tanggal_selesai; ?>">
                                        <span class="help-block"><?php echo $tanggal_selesai_err;?></span>
                                    </div>
                                <script>
                                function myFunction() {
                                    var checkBox = document.getElementById("myCheck");
                                    var text = document.getElementById("now");
                                    var date = document.getElementById("nope");
                                    if (checkBox.checked == true){
                                        text.style.display = "block";
                                        date.style.display = "none";
                                    } else {
                                        text.style.display = "none";
                                        date.style.display = "block";
                                    }
                                }
                                </script>
                                </td>
                            </tr>
                        </table>

                        <div class="form-group <?php echo (!empty($posisi_err)) ? 'has-error' : ''; ?>">
                            <label>Position in Company</label>
                            <input type="text" name="posisi" class="form-control" value="<?php echo $posisi; ?>">
                            <span class="help-block"><?php echo $posisi_err;?></span>
                        </div>

                        <div class="form-check <?php echo (!empty($status_err)) ? 'has-error' : ''; ?>">
                            <label>Status</label><br>
                            <input type="radio" class="form-check-input" name="status" id="intern0" value="Summer Intern"> Summer Intern<br>
                            <input type="radio" class="form-check-input" name="status" id="intern1" value="Intern"> Intern <br>
                            <input type="radio" class="form-check-input" name="status" id="intern2" value="Not intern"> Not Intern
                            <span class="help-block"><?php echo $status_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($scoping_statement_err)) ? 'has-error' : ''; ?>">
                            <label>Scoping Statement / General Job Description</label>
                            <textarea name="scoping_statement" class="form-control" value="<?php echo $scoping_statement; ?>"></textarea> <!-- textarea bukan nya juga dalam value ya?!-->
                            <span class="help-block"><?php echo $scoping_statement_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../form/experience.php" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>