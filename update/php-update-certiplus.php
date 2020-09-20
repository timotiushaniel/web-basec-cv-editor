<?php
// Include config file
require_once "../dbh.php";
require "../form/session_time.php";
$pd_id_ses = $_SESSION['pd_id'];
// Define variables and initialize with empty values
$Certiplus_Program_place = $graduate_certiplus = "";
$Certiplus_Program_place_err = $graduate_certiplus_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["ce_id"]) && !empty($_POST["ce_id"])){
    // Get hidden input value
    $ce_id = $_POST["ce_id"];
    
    // Validate place
    $input_Certiplus_Program_place = trim($_POST["Certiplus_Program_place"]);
    if(empty($input_Certiplus_Program_place)){
        $Certiplus_Program_place_err = "Please enter the place name.";
    } else{
        $Certiplus_Program_place = $input_Certiplus_Program_place;
    }
    
    // Validate date
    $input_graduate_certiplus = trim($_POST["graduate_certiplus"]);
    if(empty($input_graduate_certiplus)){
        $graduate_certiplus_err = "Please enter the graduate date.";     
    } else{
        $graduate_certiplus = $input_graduate_certiplus;
    }
    
    // Check input errors before inserting in database
    if(empty($Certiplus_Program_place_err) && empty($graduate_certiplus_err)){
        // Prepare an update statement
        $sql = "UPDATE certiplus_detail SET pd_id=?, type_id=?, nama=?, sumber=?, tanggal=? WHERE ce_id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            $pd_id = $pd_id_ses;
            $type_id = 1;
            $certiplus_program = implode(", ", $_POST['certiplus_program']);
            mysqli_stmt_bind_param($stmt, "iisssi", $pd_id, $type_id, $certiplus_program, $Certiplus_Program_place, $graduate_certiplus, $ce_id);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: ../form/certiplus_program.php");
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
    if(isset($_GET["ce_id"]) && !empty(trim($_GET["ce_id"]))){
        // Get URL parameter
        $ce_id =  trim($_GET["ce_id"]);
        $type_id = 1;
        
        // Prepare a select statement
        $sql = "SELECT * FROM certiplus_detail WHERE ce_id = ? AND type_id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ii", $ce_id, $type_id);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    // Retrieve individual field value
                    $certiplus_program = explode(', ', $row['nama']);
                    $Certiplus_Program_place = $row['sumber'];
                    $graduate_certiplus = $row['tanggal'];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: ../error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
        
        // Close connection
        mysqli_close($conn);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: ../error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="StyleForm.css">
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
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <h2 class="alert alert-primary text-center mt-3">Certiplus Program</h2>
                        <div class="form-group mb-3 input-group-sm">
                        <label><b>Place:</b></label>
                        <input type="text" class="form-control" id="Certiplus_Program_place" name="Certiplus_Program_place" placeholder="Certiplus Program place" value="<?php echo $Certiplus_Program_place; ?>">
                        </div>
                        Completed training:<br>
                        <div class="form-check-inline">
                        <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="certiplus_program[]" id="computer" value="computer" checked>Computer
                        </label>
                        </div><br>
                        <div class="form-check-inline">
                        <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="certiplus_program[]" id="communication" value="communication" checked>Communication
                        </label>
                        </div><br>
                        <div class="form-check-inline">
                        <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="certiplus_program[]" id="java mobile" value="java mobile" checked>Java Mobile
                        </label>
                        </div><br>
                        <div class="form-check-inline">
                        <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="certiplus_program[]" id="leadership" value="leadership" checked>Leadership
                        </label>
                        </div><br>
                        <div class="form-check-inline">
                        <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="certiplus_program[]" id="Entrepreneurship" value="entrepreneurship" checked>Entrepreneurship
                        </label>
                        </div><br>
                        <div class="form-check-inline">
                        <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="certiplus_program[]" id="Career planning skills" value="and career planning skills" checked>Career planning skills
                        </label>
                        </div><br><br>

                        <div class="form-group mb-3 input-group-sm">
                        <label for="graduate_certiplus">Graduate Date:</label><br>
                        <input type="month" class="form-control" id="graduate_certiplus" name="graduate_certiplus" value="<?php echo $graduate_certiplus; ?>">
                        </div>

                        <input type="hidden" name="ce_id" value="<?php echo $ce_id; ?>"/>
                        <input type="submit" class="btn btn-primary btn-sm" value="Submit">
                        <a href="../form/certiplus_program.php" class="btn btn-danger btn-sm">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>