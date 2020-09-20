<!doctype html>
<html lang="en">
    <?php
          require "../form/session_time.php";
          $pd_id_ses = $_SESSION['pd_id'];
          // Include config file
          require_once "../dbh.php";

          // Define variables and initialize with empty values
          $Certiplus_Program_place = $graduate_certiplus = "";
          $Certiplus_Program_place_err = $graduate_certiplus_err = "";
          
          // Processing form data when form is submitted
          if($_SERVER["REQUEST_METHOD"] == "POST"){
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
                  // Prepare an insert statement
                  $sql = "INSERT INTO certiplus_detail (pd_id, type_id, nama, sumber, tanggal) VALUES (?, ?, ?, ?, ?)";
                  
                  if($stmt = mysqli_prepare($conn, $sql)){
                      // Bind variables to the prepared statement as parameters
                      $pd_id = $pd_id_ses;
                      $type_id = 1;
                      $certiplus_program = implode(", ", $_POST['certiplus_program']);
                      mysqli_stmt_bind_param($stmt, "iisss", $pd_id, $type_id, $certiplus_program, $Certiplus_Program_place, $graduate_certiplus);
                      
                      // Attempt to execute the prepared statement
                      if(mysqli_stmt_execute($stmt)){
                          // Records created successfully. Redirect to landing page
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
    <!-- START PAGE OF PERSONAL DATA FORM -->
    <div class="col-12">
      <div class="tab-pane" id="v-pills-certiplus" role="tabpanel" aria-labelledby="v-pills-certiplus-tab">
          <?php
          if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfieldscertiplus") {
              echo '<p style="color:red" align="center">Fill in all!</p>';
            } // smw data di certiplus //
            if ($_GET['error'] == "emptyfieldsCertiplus_Program_place") {
              echo '<p style="color:red" align="center">Fill in the Certiplus Program place!</p>';
            }
            // karena ini checkbox gausa pake error kayanya bsk tanya //
            else if ($_GET['error'] == "emptyfieldscomputer") {
              echo '<p style="color:red" align="center">Fill in Computer!</p>';
            } else if ($_GET['error'] == "emptyfieldscommunication") {
              echo '<p style="color:red" align="center">Fill in the communication!</p>';
            } else if ($_GET['error'] == "emptyfieldsjava_mobile") {
              echo '<p style="color:red" align="center">Fill in the java mobile!</p>';
            } else if ($_GET['error'] == "emptyfieldsleadership") {
              echo '<p style="color:red" align="center">Fill in the leadership!</p>';
            } else if ($_GET['error'] == "emptyfieldsEntrepreneurship") {
              echo '<p style="color:red" align="center">Fill in the Entrepreneurship!</p>';
            } else if ($_GET['error'] == "emptyfieldsCareer_planning_skills") {
              echo '<p style="color:red" align="center">Fill in the Career planning skills!</p>';
            } else if ($_GET['error'] == "emptyfieldsgraduate_certiplus") {
              echo '<p style="color:red" align="center">Fill in the certiplus graduate date!</p>';
            } else {
              echo "<p style='color:green' align='center'>certiplus are complete, please continue!</p>";
            }
          }

          ?>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2 class="alert alert-primary text-center mt-3">Certiplus Program</h2>
            <div class="form-group mb-3 input-group-sm">
              <label><b>Place:</b></label>
              <input type="text" class="form-control" id="Certiplus_Program_place" name="Certiplus_Program_place" placeholder="Certiplus Program place">
            </div>

            <br> Completed training:<br>
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
              <input type="month" class="form-control" id="graduate_certiplus" name="graduate_certiplus">
            </div>

            <br>
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="../form/certiplus_program.php" class="btn btn-danger">Cancel</a>
          </form>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>