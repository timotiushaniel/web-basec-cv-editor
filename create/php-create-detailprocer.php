<?php
// Include config file
require_once "../dbh.php";
require "../form/session_time.php";
$ptc_id_ses = $_SESSION['ptc_id'];
$type_id_ses = $_SESSION['type_id'];
// Define variables and initialize with empty values
$certi_name = $tanggal = "";
$certi_name_err = $tanggal_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_certi_name = trim($_POST["certi_name"]);
    if(empty($input_certi_name)){
        $certi_name_err = "Please input the course detail.";
    } else{
        $certi_name = ucfirst($input_certi_name);
    }

    $input_tanggal = trim($_POST["tanggal"]);
    if(empty($input_tanggal)){
        $tanggal_err = "Please input the date detail.";
    } else{
        $tanggal= ucfirst($input_tanggal);
    }
    
    // Check input errors before inserting in database
    if(empty($certi_name_err) && empty($tanggal_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO ptc_to_procer (ptc_id, ctd_id, tanggal) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            $ptc_id = $ptc_id_ses;
            mysqli_stmt_bind_param($stmt, "iis", $ptc_id, $certi_name, $tanggal);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: ../form/php-procer-detail.php?ptc_id=".$ptc_id_ses);
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

<?php
    require_once "../dbh.php";
    // MySQL suggests using 18446744073709551615 as the number of records in the limit
    $sql = "SELECT * FROM certification_type WHERE type_id = $type_id_ses;";
        if ($res = mysqli_query($conn, $sql)) {
            if(mysqli_num_rows($res) > 0){
                while ($row = mysqli_fetch_array($res)) {
                     $source = $row["certification_name"];
                }       
            }                                                   
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
                        <h2>Insert <?php echo $source ?> Certification Detail Record</h2>
                    </div>
                    <p>Please fill this form and submit to add <?php echo $source ?> Certification Detail record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($certi_name_err)) ? 'has-error' : ''; ?>">
                            <label>Certification</label><br>
                            <select class="form-control" name="certi_name" id="certi_name" onmousedown="if(this.options.length>5){this.size=5;}"  onchange='this.size=0;' onblur="this.size=0;">
                            <option disabled selected>Pilih</option>
                            <?php
                            require_once "../dbh.php";
                            // MySQL suggests using 18446744073709551615 as the number of records in the limit
                            $option_sql_read = "SELECT * FROM cer_type_detail WHERE type_id = $type_id_ses;";
                            if ($option_result = mysqli_query($conn, $option_sql_read)) {
                              if(mysqli_num_rows($option_result) > 0){
                                while ($row = mysqli_fetch_array($option_result)) {
                                  $certi_name = $row["certi_name"];
                                  ?>
                                    <option value="<?=$row[0]?>" <?php if ($certi_name == $row[0]) {echo "selected";}?>><?=$certi_name?></option> 
                            <?php
                                }
                              }                                                   
                            }
                            ?>
                            </select>
                            <span class="help-block"><?php echo $certi_name_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($tanggal_err)) ? 'has-error' : ''; ?>">
                            <label>Date</label>
                            <input type="month" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>">
                            <span class="help-block"><?php echo $tanggal_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <?php echo "<a href='../form/php-procer-detail.php?ptc_id=".$ptc_id_ses."' class = 'btn btn-danger'>Cancel</a>"?>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>