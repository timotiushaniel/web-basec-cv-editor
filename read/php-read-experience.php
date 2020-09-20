<?php
require "../form/session_time.php";
// Check existence of id parameter before processing further
if(isset($_GET["ex_id"]) && !empty(trim($_GET["ex_id"]))){
    // Include config file
    require_once "../dbh.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM experience WHERE ex_id = ?";
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $ex_id);
        
        // Set parameters
        $ex_id = trim($_GET["ex_id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $nama_perusahaan = $row["nama_perusahaan"];
                $kota = $row["kota"];
                $negara = $row["negara"];
                $tanggal_mulai = $row["tanggal_mulai"];
                $tanggal_selesai = $row["tanggal_selesai"];
                $tgl_mulai = date("F o", strtotime($tanggal_mulai));
                if ($tanggal_selesai == "Present") {
                    $tgl_selesai = $tanggal_selesai;
                } else {
                    $tgl_selesai = date("F o", strtotime($tanggal_selesai));
                };
                $posisi = $row["posisi"];
                $status = $row["status"];
                $detail_perusahaan = $row["detail_perusahaan"];
                $scoping_statement = $row["scoping_statement"];
                
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: ../error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again.";
        }
    }
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: ../error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Experience Record</title>
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
                        <h1>View Experience Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Company Name</label>
                        <p class="form-control-static"><?php echo $row["nama_perusahaan"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Company City</label>
                        <p class="form-control-static"><?php echo $row["kota"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Company Country</label>
                        <p class="form-control-static"><?php echo $row["negara"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Start Date</label>
                        <p class="form-control-static"><?php echo $tgl_mulai; ?></p>
                    </div>
                    <div class="form-group">
                        <label>End Date</label>
                        <p class="form-control-static"><?php echo $tgl_selesai; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Position in Company</label>
                        <p class="form-control-static"><?php echo $row["posisi"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <p class="form-control-static"><?php echo $row["status"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Company Detail</label>
                        <p class="form-control-static"><?php echo $row["detail_perusahaan"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Scoping Statement / General Job Description</label>
                        <p class="form-control-static"><?php echo $row["scoping_statement"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Job Detail</label>
                        <?php 
                            require_once "../dbh.php";
                            $job_detail_sql_read = "SELECT * FROM detail_job WHERE ex_id = $ex_id";
                            if($job_detail_result = mysqli_query($conn, $job_detail_sql_read)){
                                if(mysqli_num_rows($job_detail_result) > 0){
                                        while($job_detail_row = mysqli_fetch_array($job_detail_result)){
                                            echo "<li>" . $job_detail_row['detail_pekerjaan'] . "</li>";
                                        }
                                    // Free result set
                                    mysqli_free_result($job_detail_result);
                                } else{
                                    echo "<p class='lead'><em>No Job Detail records were found.</em></p>";
                                }
                            } else{
                                echo "ERROR: Could not able to execute $job_detail_sql_read. " . mysqli_error($conn);
                            }
                            // Close statement
                            mysqli_stmt_close($stmt);
                            
                            // Close connection
                            mysqli_close($conn);
                        ?>
                    </div>
                    
                    <p><a href="../form/experience.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>