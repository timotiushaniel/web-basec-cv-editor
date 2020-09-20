<?php
// Check existence of id parameter before processing further
if(isset($_GET["ox_id"]) && !empty(trim($_GET["ox_id"]))){
    // Include config file
    require_once "dbh.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM other_experience WHERE ox_id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $ox_id);
        
        // Set parameters
        $ox_id = trim($_GET["ox_id"]);
        
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
                $detail_pekerjaan = $row["detail_pekerjaan"];
                $tanggal = $row["tanggal"];
                $detail_perusahaan = $row["detail_perusahaan"]; 
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
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
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Other Experience Record</title>
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
                        <h1>View Other Experience Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Nama Perusahaan</label>
                        <p class="form-control-static"><?php echo $row["nama"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Detail Perusahaan</label>
                        <p class="form-control-static"><?php echo $row["detail_perusahaan"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Posisi</label>
                        <p class="form-control-static"><?php echo $row["posisi"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Detail Pekerjaan</label>
                        <p class="form-control-static"><?php echo $row["detail_pekerjaan"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <p class="form-control-static"><?php echo $row["tanggal"]; ?></p>
                    </div>
                    <p><a href="form.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>