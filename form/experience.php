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
        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="employment_objective.php" role="tab" aria-controls="v-pills-profile" aria-selected="false">Employment Objective</a>
        <a class="nav-link" id="v-pills-messages-tab" href="#" role="tab" aria-controls="v-pills-messages" aria-selected="false">Education</a>

        <a class="nav-link ml-5 my-1" id="v-pills-college-tab" data-toggle="pill" href="college.php" role="tab" aria-controls="v-pills-college" aria-selected="false">College</a>
        <a class="nav-link ml-5 my-1" id="v-pills-certiplus-tab" data-toggle="pill" href="certiplus_program.php" role="tab" aria-controls="v-pills-certiplus" aria-selected="false">Certiplus Program</a>
        <a class="nav-link ml-5 my-1" id="v-pills-cisco-tab" data-toggle="pill" href="professional_certification.php" role="tab" aria-controls="v-pills-cisco" aria-selected="false">Professional Certification</a>
        <a class="nav-link ml-5 my-1" id="v-pills-school-tab" data-toggle="pill" href="high_school.php" role="tab" aria-controls="v-pills-school" aria-selected="false">High School</a>

        <a class="nav-link active" id="v-pills-settings-tab" data-toggle="pill" href="experience.php" role="tab" aria-controls="v-pills-settings" aria-selected="false">Experience</a>
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

<!-- START EXPERIENCE !-->
    <div class="col-9">
        <div class="tab-pane" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
            <h2 class="alert alert-primary text-center mt-3">Experience</h2>
            <hr>
            <!-- EXPERIENCE TABLE START -->
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="page-header clearfix">
                                <label><b>Experience :</b></label><br>
                                    <a href="../create/php-create-experience.php" class="btn btn-success pull-right">Add New Experience</a>
                            </div>
                            <?php
                            // Include config file
                            require_once "../dbh.php";

                            // Attempt select query execution
                            $experience_sql_read = "SELECT * FROM experience WHERE pd_id = $PersonalDataId";
                            if ($experience_result = mysqli_query($conn, $experience_sql_read)) {
                                if (mysqli_num_rows($experience_result) > 0) {
                                    echo "<table class='table table-bordered table-striped'>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<br>";
                                    echo "<th style='width:26%; text-align:center'>Company Name</th>";
                                    echo "<th style='width:27%; text-align:center'>Position in Company</th>";
                                    echo "<th style='width:20%; text-align:center'>Date Start - End</th>";
                                    echo "<th style='width:13%; text-align:center'>Job Detail</th>";
                                    echo "<th style='width:14%; text-align:center'>Action</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while ($experience_row = mysqli_fetch_array($experience_result)) {
                                        $tanggal_mulai = $experience_row['tanggal_mulai'];
                                        $tanggal_selesai = $experience_row['tanggal_selesai'];
                                        $tgl_mulai = date("F o", strtotime($tanggal_mulai));
                                        if ($tanggal_selesai == "Present") {
                                            $tgl_selesai = $tanggal_selesai;
                                        } else {
                                            $tgl_selesai = date("F o", strtotime($tanggal_selesai));
                                        };
                                        $ex_id = $experience_row['ex_id'];
                                        echo "<tr>";
                                        echo "<td>" . $experience_row['nama_perusahaan'] . "</td>";
                                        echo "<td>" . $experience_row['posisi'] . "</td>";
                                        echo "<td style='text-align:center'>".$tgl_mulai." - ".$tgl_selesai."</td>";
                                        echo "<td style='text-align:center'>";
                                        echo "<a href='php-experience-jobdetail.php?ex_id=" . $experience_row['ex_id'] . "' title='View Record' data-toggle='tooltip'>
                                                    <span class='glyphicon glyphicon-eye-open'>Details</span>
                                                    </a><br>";
                                        $jobdetail_sql_read = "SELECT * FROM detail_job WHERE ex_id = $ex_id";
                                        if ($jobdetail_result = mysqli_query($conn, $jobdetail_sql_read)) {
                                            if (mysqli_num_rows($jobdetail_result) < 1) {
                                                echo "<p style='color:red'>No job details were found</p>";
                                            }
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        echo "<a href='../read/php-read-experience.php?ex_id=" . $experience_row['ex_id'] . "' title='View Record' data-toggle='tooltip'>
                                                                    <span class='bi bi-trash'>👁️</span>
                                                                </a>";
                                        echo "<a href='../update/php-update-experience.php?ex_id=" . $experience_row['ex_id'] . "' title='Update Record' data-toggle='tooltip'>
                                                                    <span>✏️</span>
                                                                </a>";
                                        echo "<a href='../delete/php-delete-experience.php?ex_id=" . $experience_row['ex_id'] . "' title='Delete Record' data-toggle='tooltip'>
                                                                    <span>🗑️</span>
                                                                </a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                    // Free result set
                                    mysqli_free_result($experience_result);
                                } else {
                                    echo "<p class='lead'><em>No records were found.</em></p>";
                                }
                            } else {
                                echo "ERROR: Could not able to execute $experience_sql_read. " . mysqli_error($conn);
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- EXPERIENCE TABLE END -->
            <a href="high_school.php" name="previous" class="btn btn-info btn-md" id="previous">Previous</a>
            <a href="additional_information.php" name="next" class="btn btn-warning btn-md float-right" id="next">Next</a>
        </div>
    </div>
</div>
          <!-- END EXPERIENCE !-->