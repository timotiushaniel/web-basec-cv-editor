<?php
// Include config file
require_once "../dbh.php";
require "../form/session_time.php";
$pd_id_ses = $_SESSION['pd_id'];
// Define variables and initialize with empty values
$nama_sumber = "";
$nama_sumber_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_nama_sumber = trim($_POST["nama_sumber"]);
    if(empty($input_nama_sumber)){
        $nama_sumber_err = "Please enter the authority name.";
    } else{
        $nama_sumber = ucwords($input_nama_sumber);
    }

    // Check input errors before inserting in database
    if(empty($nama_sumber_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO pd_to_ctd (pd_id, type_id) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            $pd_id = $pd_id_ses;
            mysqli_stmt_bind_param($stmt, "ii", $pd_id, $nama_sumber);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: ../form/professional_certification.php");
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
                        <h2>Insert Certification Authority Name</h2>
                    </div>
                    <p>Please fill this form and submit to add certification authority record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nama_err)) ? 'has-error' : ''; ?>">
                            <label>Certificate Authority</label><br>
                            <select class="form-control" name="nama_sumber" id="nama_sumber" onmousedown="if(this.options.length>5){this.size=5;}"  onchange='this.size=0;' onblur="this.size=0;">
                            <option disabled selected>Choose</option>
                            <?php
                            require_once "../dbh.php";
                            // MySQL suggests using 18446744073709551615 as the number of records in the limit
                            $option_sql_read = "SELECT * FROM certification_type LIMIT 18446744073709551614 OFFSET 1;";
                            if ($option_result = mysqli_query($conn, $option_sql_read)) {
                              if(mysqli_num_rows($option_result) > 0){
                                while ($row = mysqli_fetch_array($option_result)) {
                                  $nama_sumber = $row["certification_name"];
                                  ?>
                                    <option value="<?=$row[0]?>" <?php if ($nama_sumber == $row[0]) {echo "selected";}?>><?=$nama_sumber?></option> 
                            <?php
                                }       
                              }                                                   
                            }
                            ?>
                            </select>
                            <span class="help-block"><?php echo $nama_sumber_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../form/professional_certification.php" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>