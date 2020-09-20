<?php
// Include config file
require_once "../dbh.php";
require "../form/session_time.php";
$te_id_ses = $_SESSION['te_id'];
// Define variables and initialize with empty values
$detail_teknologi = "";
$detail_teknologi_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_detail_teknologi = trim($_POST["detail_teknologi"]);
    if(empty($input_detail_teknologi)){
        $detail_teknologi_err = "Please input the technology detail.";
    } else{
        $detail_teknologi = ucfirst($input_detail_teknologi);
    }
    
    // Check input errors before inserting in database
    if(empty($detail_teknologi_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO detail_technology (te_id, detail_teknologi) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            $te_id = $te_id_ses;
            mysqli_stmt_bind_param($stmt, "is", $te_id, $detail_teknologi);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: ../form/php-technology-technologydetail.php?te_id=".$te_id_ses);
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
                        <h2>Insert Technology Detail Record</h2>
                    </div>
                    <p>Please fill this form and submit to add Technology Detail record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($detail_teknologi_err)) ? 'has-error' : ''; ?>">
                            <label>Detail Teknologi</label>
                            <textarea class="form-control" rows="5" id="detail_teknologi" name="detail_teknologi" placeholder="Ex: Java (For Programming Language) or Linux (For OS)"></textarea><br>
                            <span class="help-block"><?php echo $detail_teknologi_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <?php echo "<a href='../form/php-technology-technologydetail.php?te_id=".$te_id_ses."' class = 'btn btn-default'>Cancel</a>"?>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>