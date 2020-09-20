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
        <a class="nav-link ml-5 my-1 active" id="v-pills-cisco-tab" data-toggle="pill" href="professional_certification.php" role="tab" aria-controls="v-pills-cisco" aria-selected="false">Professional Certification</a>
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

<!-- START PROFESSIONAL CERTIFICATION -->
    <div class="col-9">
        <div class="tab-pane" id="v-pills-add" role="tabpanel" aria-labelledby="v-pills-add-tab">
            <h2 class="alert alert-primary text-center mt-3">Professional Certification</h2>

            <!-- TECHNOLOGY TABLE START -->
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="page-header clearfix">
                                <label><b>Professional Certification :</b></label><br>
                                    <a href="../create/php-create-professional_certification.php" class="btn btn-success pull-right">Add New Certification</a>
                            </div>
                            <?php
                            // Include config file
                            require_once "../dbh.php";

                            // Attempt select query execution
                            $pro_cer_sql_read = "SELECT certification_type.certification_name AS certi_name, pd_to_ctd.ptc_id AS ptc_id, pd_to_ctd.type_id AS type_id, pd_to_ctd.pd_id AS pd_id 
                            FROM certification_type, pd_to_ctd
                            WHERE certification_type.type_id = pd_to_ctd.type_id AND pd_id = $PersonalDataId";
                            if ($pro_cer_result = mysqli_query($conn, $pro_cer_sql_read)) {
                                if (mysqli_num_rows($pro_cer_result) > 0) {
                                    echo "<table class='table table-bordered table-striped'>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<br>";
                                    echo "<th style='text-align:center'>Certification Authority</th>";
                                    echo "<th style='width:18%; text-align:center'>Details</th>";
                                    echo "<th style='width:14%; text-align:center'>Action</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while ($pro_cer_row = mysqli_fetch_array($pro_cer_result)) {
                                        $type_id = $pro_cer_row['type_id'];
                                        $pd_id = $pro_cer_row['pd_id'];
                                        echo "<tr>";
                                        echo "<td>" . $pro_cer_row['certi_name'] . "</td>";
                                        echo "<td style='text-align:center'>";
                                        echo "<a href='php-procer-detail.php?ptc_id=" . $pro_cer_row['ptc_id'] . "' title='View Record' data-toggle='tooltip'>
                                                    <span class='glyphicon glyphicon-eye-open'>Details</span>
                                                    </a><br>";
                                        $detail_procer_sql_read = "SELECT pd_to_ctd.ptc_id, pd_to_ctd.pd_id, pd_to_ctd.type_id, certification_type.certification_name, ptc_to_procer.tanggal
                                        FROM certification_type, pd_to_ctd LEFT JOIN ptc_to_procer
                                        ON pd_to_ctd.ptc_id = ptc_to_procer.ptc_id
                                        WHERE certification_type.type_id = pd_to_ctd.type_id AND pd_to_ctd.pd_id = $PersonalDataId AND pd_to_ctd.type_id = $type_id AND tanggal IS NULL";
                                        if ($detail_procer_result = mysqli_query($conn, $detail_procer_sql_read)) {
                                            if (mysqli_num_rows($detail_procer_result) > 0) {
                                                echo "<p style='color:red'>No certification course detail were found</p>";
                                            }
                                        }
                                        echo "</td>";
                                        echo "<td style='text-align:center'>";
                                        echo "<a href='../read/php-read-procer.php?ptc_id=" . $pro_cer_row['ptc_id'] . "' title='View Record' data-toggle='tooltip'>
                                                                    <span class='bi bi-trash'>👁️</span>
                                                                </a>";
                                        echo "<a href='../delete/php-delete-procer.php?ptc_id=" . $pro_cer_row['ptc_id'] . "' title='Delete Record' data-toggle='tooltip'>
                                                                    <span>🗑️</span>
                                                                </a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                    // Free result set
                                    mysqli_free_result($pro_cer_result);
                                } else {
                                    echo "<p class='lead'><em>No records were found.</em></p>";
                                }
                            } else {
                                echo "ERROR: Could not able to execute $pro_cer_sql_read. " . mysqli_error($conn);
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- TECHNOLOGY TABLE END -->
            <a href="certiplus_program.php" name="previous" class="btn btn-info btn-md" id="previous">Previous</a>
            <a href="high_school.php" name="next" class="btn btn-warning btn-md float-right" id="next">Next</a>
            <!-- Other Experience TABLE END -->
        </div>
    </div>
</div>
<!-- END ADDITIONAL INFORMATION -->