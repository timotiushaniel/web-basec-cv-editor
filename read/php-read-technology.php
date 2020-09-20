<?php
require "../form/session_time.php";
// Check existence of id parameter before processing further
if(isset($_GET["te_id"]) && !empty(trim($_GET["te_id"]))){
    // Include config file
    require_once "../dbh.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM technology WHERE te_id = ?";
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $te_id);
        
        // Set parameters
        $te_id = trim($_GET["te_id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $nama_teknologi = $row["nama_teknologi"];
                
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
    <title>View Technology Record</title>
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
                        <h1>View Technology Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Technology Name</label>
                        <p class="form-control-static"><?php echo $row["nama_teknologi"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Technology Detail</label>
                        <?php 
                            require_once "../dbh.php";
                            $technology_detail_sql_read = "SELECT * FROM detail_technology WHERE te_id = $te_id";
                            if($technology_detail_result = mysqli_query($conn, $technology_detail_sql_read)){
                                if(mysqli_num_rows($technology_detail_result) > 0){
                                        while($technology_detail_row = mysqli_fetch_array($technology_detail_result)){
                                            echo "<li>" . $technology_detail_row['detail_teknologi'] . "</li>";
                                        }
                                    // Free result set
                                    mysqli_free_result($technology_detail_result);
                                } else{
                                    echo "<p class='lead'><em>No Technology Detail records were found.</em></p>";
                                }
                            } else{
                                echo "ERROR: Could not able to execute $technology_detail_sql_read. " . mysqli_error($conn);
                            }
                            // Close statement
                            mysqli_stmt_close($stmt);
                            
                            // Close connection
                            mysqli_close($conn);
                        ?>
                    </div>
                    
                    <p><a href="../form/additional_information.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>