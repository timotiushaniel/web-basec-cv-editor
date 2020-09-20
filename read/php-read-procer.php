<?php
require "../form/session_time.php";
$PersonalDataId = $_SESSION['pd_id'];
// Check existence of id parameter before processing further
if(isset($_GET["ptc_id"]) && !empty(trim($_GET["ptc_id"]))){
    // Include config file
    require_once "../dbh.php";
    
    // Prepare a select statement
    $sql = "SELECT pd_to_ctd.ptc_id AS ptc_id, pd_to_ctd.pd_id AS pd_id, pd_to_ctd.type_id AS type_id, certification_type.certification_name AS source_name, cer_type_detail.certi_name AS certi_name, ptc_to_procer.tanggal AS tanggal
    FROM certification_type, pd_to_ctd 
    LEFT JOIN (ptc_to_procer LEFT JOIN cer_type_detail ON cer_type_detail.ctd_id = ptc_to_procer.ctd_id) ON pd_to_ctd.ptc_id = ptc_to_procer.ptc_id
    WHERE certification_type.type_id = pd_to_ctd.type_id AND pd_to_ctd.ptc_id = ?";
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $ptc_id);
        
        // Set parameters
        $ptc_id = trim($_GET["ptc_id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) > 0){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $ptc_id = $row["ptc_id"];
                $pd_id = $row["pd_id"];
                $type_id = $row["type_id"];
                $source_name = $row["source_name"];
                $certi_name = $row["certi_name"];
                $tanggal = $row["tanggal"];
                $tgl = date("F o", strtotime($tanggal));
                
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
    <title>View <?php echo $source_name ?> Certification Record</title>
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
                        <h1>View <?php echo $source_name ?> Certification Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Authority Name</label>
                        <p class="form-control-static"><?php echo $source_name; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Course Detail: </label>

                        <?php 
                            require_once "../dbh.php";
                            $procer_detail_sql_read = "SELECT pd_to_ctd.ptc_id AS ptc_id, certification_type.type_id AS type_id, ptc_to_procer.ctd_id AS ctd_id, certification_type.certification_name AS source_name, cer_type_detail.certi_name AS certi_name, ptc_to_procer.tanggal AS tanggal
                            FROM certification_type, cer_type_detail, ptc_to_procer, pd_to_ctd
                            WHERE certification_type.type_id = cer_type_detail.type_id AND certification_type.type_id = pd_to_ctd.type_id 
                            AND cer_type_detail.ctd_id = ptc_to_procer.ctd_id AND pd_to_ctd.ptc_id = ptc_to_procer.ptc_id AND pd_to_ctd.pd_id = $PersonalDataId AND pd_to_ctd.type_id = $type_id";
                            if($procer_detail_result = mysqli_query($conn, $procer_detail_sql_read)){
                                if(mysqli_num_rows($procer_detail_result) > 0){
                                        while($procer_detail_row = mysqli_fetch_array($procer_detail_result)){
                                            echo "<li>" . $procer_detail_row['certi_name']; "</li>";
                                            echo "<ul>
                                                    <li>Date: ".date("F o", strtotime($procer_detail_row['tanggal']))."</li>
                                                  </ul>";
                                        }
                                    // Free result set
                                    mysqli_free_result($procer_detail_result);
                                } else{
                                    echo "<p class='lead'><em>No " . $source_name . " course detail records were found.</em></p>";
                                }
                            } else{
                                echo "ERROR: Could not able to execute $procer_detail_sql_read. " . mysqli_error($conn);
                            }
                        ?>
                    </div>
                    
                    <p><a href="../form/professional_certification.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>