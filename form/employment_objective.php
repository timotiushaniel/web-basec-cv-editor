<?php
require "session_time.php";

if (empty($PersonalDataId)) {
  $PersonalDataId = 0;
} else {
  $PersonalDataId = $_SESSION['pd_id'];
}
?>

<!doctype html>
<html lang="en">
<?php
//EMPLOYMENT OBJECTIVE//
$EmploymentObjectve = isset($_GET["EmploymentObjective"]) ? $_GET["EmploymentObjective"] : "";
//END EMPLOYMENT OBJECTIVE//
?>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../assets/css/StyleForm.css">

  <title>Curriculum Vitae</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
</head>

<body>
<?php require_once "header.php";?>

<div class="row">
    <div class="col-3">
      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <?php
      if (!empty($PersonalDataId)) {
        echo '
        <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="personaldata.php" role="tab" aria-controls="v-pills-home" aria-selected="true">Personal Data</a>
        <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="employment_objective.php" role="tab" aria-controls="v-pills-profile" aria-selected="false">Employment Objective</a>
        <a class="nav-link" id="v-pills-messages-tab" href="#" role="tab" aria-controls="v-pills-messages" aria-selected="false">Education</a>

        <a class="nav-link ml-5 my-1" id="v-pills-college-tab" data-toggle="pill" href="college.php" role="tab" aria-controls="v-pills-college" aria-selected="false">College</a>
        <a class="nav-link ml-5 my-1" id="v-pills-certiplus-tab" data-toggle="pill" href="certiplus_program.php" role="tab" aria-controls="v-pills-certiplus" aria-selected="false">Certiplus Program</a>
        <a class="nav-link ml-5 my-1" id="v-pills-cisco-tab" data-toggle="pill" href="professional_certification.php" role="tab" aria-controls="v-pills-cisco" aria-selected="false">Professional Certification</a>
        <a class="nav-link ml-5 my-1" id="v-pills-school-tab" data-toggle="pill" href="high_school.php" role="tab" aria-controls="v-pills-school" aria-selected="false">High School</a>

        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="experience.php" role="tab" aria-controls="v-pills-settings" aria-selected="false">Experience</a>
        <a class="nav-link" id="v-pills-add-tab" data-toggle="pill" href="additional_information.php" role="tab" aria-controls="v-pills-add" aria-selected="false">Additional Information</a>
        <a class="nav-link" id="v-pills-language-tab" data-toggle="pill" href="language.php" role="tab" aria-controls="v-pills-language" aria-selected="false">Language</a>
        <br><div><hr color="black"></div><br> 
        <a class="nav-link alert alert-dark" id="v-pills-school-tab" data-toggle="pill" href="../process/preview.php" role="tab" aria-controls="v-pills-#" aria-selected="false"> &emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&ensp;PREVIEW</a>
        ';
      } else {
        echo '<a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="personaldata.php" role="tab" aria-controls="v-pills-home" aria-selected="true">Personal Data</a>';
      }
      ?>
      </div>
    </div>

<!-- START PAGE OF EMPLOYMENT OBJECTIVE FORM -->
    <div class="col-9">
        <div class="tab-pane" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
            <h2 class="alert alert-primary text-center mt-3">Employment Objective</h2>
                <?php
                // Include config file
                require_once "../dbh.php";
                // Attempt select query execution
                $eo_sql_read = "SELECT * FROM employment_objective WHERE pd_id = $PersonalDataId";
                if ($eo_result = mysqli_query($conn, $eo_sql_read)) {
                    if (mysqli_num_rows($eo_result) > 0) {
                        while ($eo_row = mysqli_fetch_array($eo_result)) {
                          $objective = $eo_row['objective'];
                          $eo_id_temp = $eo_row['eo_id'];
                          if ($eo_id_temp != '0') {
                            $eo_id = $eo_id_temp;
                          } else {
                            $eo_id = 0;
                          }
                          echo "<article>";
                          echo "<p>";
                          echo "$objective";
                          echo "</p>";
                          echo "</article>";
                        }   
                        // Free result set
                        mysqli_free_result($eo_result);
                    } else {
                        $eo_id = 0;
                        echo "<p class='lead'><em>Employment Objective record were not found. Please add Employment Objective record first.</em></p>";
                      }
                } else {
                    echo "ERROR: Could not able to execute $eo_sql_read. " . mysqli_error($conn);
                }
                ?>
            <br><br>

            <a href="../create/php-create-employmentobjective.php">
                <button type="submit" class="btn btn-success btn-md" id="TombolSubmitEo" name="TombolSubmitEo" <?php if ($eo_id != '0') {
                                                                                                                          echo "hidden";
                                                                                                                      } else {
                                                                                                                          echo "enable";
                                                                                                                      } ?>>Add Employment Objective</button>
            </a>
                <?php echo "<a href='../update/php-update-employmentobjective.php?eo_id=" . $eo_id . "'>" ?>
                <button type="submit" class="btn btn-primary btn-md" id="TombolUpdateEo" name="TombolUpdateEo" <?php if ($eo_id == '0') {
                                                                                                                        echo "hidden";
                                                                                                                      } else {
                                                                                                                        echo "enable";
                                                                                                                      } ?>>Update Employment Objective</button>
            </a><br><br><br>
                <a href="personaldata.php" name="previous" class="btn btn-info btn-md" id="previous">Previous</a>
                <a href="college.php" name="next" class="btn btn-warning btn-md float-right" id="next">Next</a>
          </div>
    </div>
</div>
<!-- END PAGE OF EMPLOYMENT OBJECTIVE FORM -->