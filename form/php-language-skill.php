<?php
require "session_time.php";
// Check existence of id parameter before processing further
if(isset($_GET["lg_id"]) && !empty(trim($_GET["lg_id"]))){
    // Include config file
    require_once "../dbh.php";
    
    // Prepare a select statement
    //$sql = "SELECT experience.nama_perusahaan , experience.posisi, experience.status, detail_job.detail_pekerjaan FROM experience LEFT JOIN detail_job ON detail_job.lg_id = experience.lg_id WHERE experience.lg_id = ?";
    $sql = "SELECT * FROM language WHERE lg_id = ?";
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $lg_id);
        
        // Set parameters
        $lg_id = trim($_GET["lg_id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $language = $row["language"];
                $language_test = $row["language_test"];
                $language_proficient = $row["Language_proficient"];
                $_SESSION['lg_id'] = $row['lg_id'];
                $lg_id_ses = $_SESSION['lg_id'];
                $score = $row["score"];
                
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: ../error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
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
    <title>View Language Record</title>
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
                        <h1>Language Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Language</label>
                        <p class="form-control-static"><?php echo $row["language"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Language test</label>
                        <p class="form-control-static"><?php echo $row["language_test"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Language proficient</label>
                        <p class="form-control-static"><?php echo $row["Language_proficient"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Skill</label>

                        <?php 
                            require_once "../dbh.php";
                            $language_skill_sql_read = "SELECT * FROM language_skill WHERE lg_id = $lg_id";
                            if($language_skill_result = mysqli_query($conn, $language_skill_sql_read)){
                                if(mysqli_num_rows($language_skill_result) > 0){
                                        while($language_skill_row = mysqli_fetch_array($language_skill_result)){
                                            echo "<li>" . $language_skill_row['skill'];
                                            echo "<a href='../update/php-update-language-skill.php?ls_id=". $language_skill_row['ls_id'] ."&lg_id=" . $language_skill_row["lg_id"] . "' title='Update Record' data-toggle='tooltip'>
                                                    <span class='glyphicon glyphicon-pencil'></span>
                                                  </a>";
                                            echo "<a href='../delete/php-delete-language-skill.php?ls_id=". $language_skill_row['ls_id'] ."&lg_id=" . $language_skill_row["lg_id"] . "' title='Delete Record' data-toggle='tooltip'>
                                            <span class='glyphicon glyphicon-trash'></span>
                                            </a> </li>";
                                        }
                                    // Free result set
                                    mysqli_free_result($language_skill_result);
                                } else{
                                    echo "<p class='lead'><em>No Language records were found.</em></p>";
                                }
                            } else{
                                echo "ERROR: Could not able to execute $language_sql_read. " . mysqli_error($conn);
                            }
                        ?>

                       <!-- <p class="form-control-static"><?php echo $row["skill"]; ?></p> -->
                    </div>
                    <p><a href="../create/php-create-language-skill.php" class="btn btn-success">Add New Language Skill</a>
                    <div class="form-group">
                        <label>Score</label>
                        <p class="form-control-static"><?php echo $row["score"]; ?></p>
                    </div>
                    <a href="language.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>