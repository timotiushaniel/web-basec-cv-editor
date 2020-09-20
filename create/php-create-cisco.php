<!doctype html>
<html lang="en">
    <?php
          require "../form/session_time.php";
          $pd_id_ses = $_SESSION['pd_id'];
          // Include config file
          require_once "../dbh.php";

          // Define variables and initialize with empty values
          $Cisco_Networking_Academy_place = "";
          $Cisco_Networking_Academy_place_err = "";
          
          // Processing form data when form is submitted
          if($_SERVER["REQUEST_METHOD"] == "POST"){
              // Validate place
              $input_Cisco_Networking_Academy_place = trim($_POST["Cisco_Networking_Academy_place"]);
              if(empty($input_Cisco_Networking_Academy_place)){
                  $Cisco_Networking_Academy_place_err = "Please enter the place name.";
              } else{
                  $Cisco_Networking_Academy_place = $input_Cisco_Networking_Academy_place;
              }

              // Validate date
              $input_graduate_cisco = trim($_POST["graduate_cisco"]);
              if(empty($input_graduate_cisco)){
                  $graduate_cisco_err = "Please enter the graduate date.";     
              } else{
                  $graduate_cisco = $input_graduate_cisco;
              }
              
              // Check input errors before inserting in database
              if(empty($Cisco_Networking_Academy_place_err)){
                  // Prepare an insert statement
                  $sql = "INSERT INTO certification (pd_id, type_id, nama, sumber, tanggal) VALUES (?, ?, ?, ?, ?)";
                  
                  if($stmt = mysqli_prepare($conn, $sql)){
                      // Bind variables to the prepared statement as parameters
                      $pd_id = $pd_id_ses;
                      $type_id = 2;
                      $cisco_program = implode(", ", $_POST['cisco_program']);
                      mysqli_stmt_bind_param($stmt, "iisss", $pd_id, $type_id, $cisco_program, $Cisco_Networking_Academy_place, $graduate_cisco);
                      
                      // Attempt to execute the prepared statement
                      if(mysqli_stmt_execute($stmt)){
                          // Records created successfully. Redirect to landing page
                          header("location: ../form/cisco_networking_academy.php");
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

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/css/StyleForm.css">

    <title>Curiculum Vitae</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <style type="text/css">
        .col-12{
          width: 500px;
          margin: 0 auto;
        }
  </style>
</head>

<body>
    <!-- START PAGE OF CISCO NETWORK ACADEMY FORM -->
    <div class="col-12">
        <div class="tab-pane" id="v-pills-cisco" role="tabpanel" aria-labelledby="v-pills-cisco-tab">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h2 class="alert alert-primary text-center mt-3">Education</h2>
                <div class="form-group mb-3 input-group-sm">
                <label><b>Cisco Networking Academy :</b></label>
                <input type="text" class="form-control" id="Cisco Networking Academy place" name="Cisco_Networking_Academy_place" placeholder="Cisco Networking Academy place">
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                    <input id="Routing" type="checkbox" class="form-check-input" name="cisco_program[]" value="Routing and Switching Essentials">Routing and Switching Essentials
                    </label>
                </div><br>
                <div class="form-check-inline">
                    <label class="form-check-label">
                    <input id="Introduction" type="checkbox" class="form-check-input" name="cisco_program[]" value="Introduction to Network">Introduction to Network
                    </label>
                </div>
                <div class="form-group mb-3 input-group-sm">
                <label for="graduate_cisco">Graduate Date: </label><br>
                <input type="month" class="form-control" id="graduate_cisco" name="graduate_cisco">
                </div>
                <br>
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="../form/cisco_networking_academy.php" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
<!-- END PAGE OF CISCO NETWORK ACADEMY FORM -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>