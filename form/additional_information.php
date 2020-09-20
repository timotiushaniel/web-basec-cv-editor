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

        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="experience.php" role="tab" aria-controls="v-pills-settings" aria-selected="false">Experience</a>
        <a class="nav-link active" id="v-pills-add-tab" data-toggle="pill" href="additional_information.php" role="tab" aria-controls="v-pills-add" aria-selected="false">Additional Information</a>
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

<!-- START ADDITIONAL INFORMATION -->
    <div class="col-9">
        <div class="tab-pane" id="v-pills-add" role="tabpanel" aria-labelledby="v-pills-add-tab">
            <h2 class="alert alert-primary text-center mt-3">Additional Information</h2>

            <?php
            // Include config file
            require_once "../dbh.php";

            // Attempt select query execution
            $organization_sql_read = "SELECT * FROM organization WHERE pd_id = $PersonalDataId";
            ?>

            <!-- TECHNOLOGY TABLE START -->
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="page-header clearfix">
                                <label><b>Technology :</b></label><br>
                                    <a href="../create/php-create-technology.php" class="btn btn-success pull-right">Add New Technology</a>
                            </div>
                            <?php
                            // Include config file
                            require_once "../dbh.php";

                            // Attempt select query execution
                            $technology_sql_read = "SELECT * FROM technology WHERE pd_id = $PersonalDataId";
                            if ($technology_result = mysqli_query($conn, $technology_sql_read)) {
                                if (mysqli_num_rows($technology_result) > 0) {
                                    echo "<table class='table table-bordered table-striped'>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<br>";
                                    echo "<th style='text-align:center'>Technology</th>";
                                    echo "<th style='width:18%; text-align:center'>Details</th>";
                                    echo "<th style='width:14%; text-align:center'>Action</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while ($technology_row = mysqli_fetch_array($technology_result)) {
                                        $te_id = $technology_row['te_id'];
                                        echo "<tr>";
                                        echo "<td>" . $technology_row['nama_teknologi'] . "</td>";
                                        echo "<td style='text-align:center'>";
                                        echo "<a href='php-technology-technologydetail.php?te_id=" . $technology_row['te_id'] . "' title='View Record' data-toggle='tooltip'>
                                                    <span class='glyphicon glyphicon-eye-open'>Details</span>
                                                    </a><br>";
                                        $detail_technology_sql_read = "SELECT * FROM detail_technology WHERE te_id = $te_id";
                                        if ($detail_technology_result = mysqli_query($conn, $detail_technology_sql_read)) {
                                            if (mysqli_num_rows($detail_technology_result) < 1) {
                                                echo "<p style='color:red'>No technologies detail were found</p>";
                                            }
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        echo "<a href='../read/php-read-technology.php?te_id=" . $technology_row['te_id'] . "' title='View Record' data-toggle='tooltip'>
                                                                    <span class='bi bi-trash'>👁️</span>
                                                                </a>";
                                        echo "<a href='../update/php-update-technology.php?te_id=" . $technology_row['te_id'] . "' title='Update Record' data-toggle='tooltip'>
                                                                    <span>✏️</span>
                                                                </a>";
                                        echo "<a href='../delete/php-delete-technology.php?te_id=" . $technology_row['te_id'] . "' title='Delete Record' data-toggle='tooltip'>
                                                                    <span>🗑️</span>
                                                                </a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                    // Free result set
                                    mysqli_free_result($technology_result);
                                } else {
                                    echo "<p class='lead'><em>No records were found.</em></p>";
                                }
                            } else {
                                echo "ERROR: Could not able to execute $technology_sql_read. " . mysqli_error($conn);
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- TECHNOLOGY TABLE END -->

            <!-- ORGANIZATION TABLE START -->
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="page-header clearfix">
                                <label><b>Organization :</b></label><br>
                                <a href="../create/php-create-organization.php" class="btn btn-success pull-right">Add New Organization</a>
                            </div>
                            <?php
                            // Include config file
                            require_once "../dbh.php";

                            // Attempt select query execution
                            $organization_sql_read = "SELECT * FROM organization WHERE pd_id = $PersonalDataId";
                            if ($organization_result = mysqli_query($conn, $organization_sql_read)) {
                                if (mysqli_num_rows($organization_result) > 0) {
                                    echo "<table class='table table-bordered table-striped'>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<br>";
                                    echo "<th style='width:37%; text-align:center'>Organization Name</th>";
                                    echo "<th style='width:31%; text-align:center'>Position on Organization</th>";
                                    echo "<th style='width:18%; text-align:center'>Date</th>";
                                    echo "<th style='width:14%; text-align:center'>Action</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while ($organization_row = mysqli_fetch_array($organization_result)) {
                                        $or_tanggal_mulai_raw = $organization_row['tanggal_mulai'];
                                        $or_tanggal_selesai_raw = $organization_row['tanggal_selesai'];
                                        $or_tanggal_mulai = date("F o", strtotime($or_tanggal_mulai_raw));
                                        if($or_tanggal_selesai_raw == "Present"){
                                            $or_tanggal_selesai = $or_tanggal_selesai_raw;
                                        }else{
                                            $or_tanggal_selesai = date("F o", strtotime($or_tanggal_selesai_raw));
                                        }
                                        echo "<tr>";
                                        echo "<td>" . $organization_row['nama'] . "</td>";
                                        echo "<td>" . $organization_row['posisi'] . "</td>";
                                        echo "<td style='text-align:center'>" . $or_tanggal_mulai . " - " . $or_tanggal_selesai . "</td>";
                                        echo "<td>";
                                        echo "<a href='../read/php-read-organization.php?or_id=" . $organization_row['or_id'] . "' title='View Record' data-toggle='tooltip'>
                                                                    <span class='glyphicon glyphicon-eye-open'>👁️</span>
                                                                </a>";
                                        echo "<a href='../update/php-update-organization.php?or_id=" . $organization_row['or_id'] . "' title='Update Record' data-toggle='tooltip'>
                                                                    <span class='glyphicon glyphicon-pencil'>✏️</span>
                                                                </a>";
                                        echo "<a href='../delete/php-delete-organization.php?or_id=" . $organization_row['or_id'] . "' title='Delete Record' data-toggle='tooltip'>
                                                                    <span class='glyphicon glyphicon-trash'>🗑️</span>
                                                                </a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                    // Free result set
                                    mysqli_free_result($organization_result);
                                } else {
                                    echo "<p class='lead'><em>No records were found.</em></p>";
                                }
                            } else {
                                echo "ERROR: Could not able to execute $organization_sql_read. " . mysqli_error($conn);
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ORGANIZATION TABLE END -->

            <!-- AWARD TABLE START -->
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="page-header clearfix">
                                <label><b>Award :</b></label><br>
                                <a href="../create/php-create-award.php" class="btn btn-success pull-right">Add New Award</a>
                            </div>
                            <?php
                            // Include config file
                            require_once "../dbh.php";

                            // Attempt select query execution
                            $award_sql_read = "SELECT * FROM award WHERE pd_id = $PersonalDataId";
                            if ($award_result = mysqli_query($conn, $award_sql_read)) {
                                if (mysqli_num_rows($award_result) > 0) {
                                    echo "<table class='table table-bordered table-striped'>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<br>";
                                    echo "<th style='text-align:center'>Award</th>";
                                    echo "<th style='width:18%; text-align:center'>Date</th>";
                                    echo "<th style='width:14%; text-align:center'>Action</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while ($award_row = mysqli_fetch_array($award_result)) {
                                        $tanggal = $award_row['tanggal'];
                                        $tgla = date("F o", strtotime($tanggal));
                                        echo "<tr>";
                                        echo "<td>" . $award_row['nama'] . "</td>";
                                        echo "<td style='text-align:center'>" . $tgla . "</td>";
                                        echo "<td>";
                                        echo "<a href='../read/php-read-award.php?aw_id=" . $award_row['aw_id'] . "' title='View Record' data-toggle='tooltip'>
                                                                    <span class='glyphicon glyphicon-eye-open'>👁️</span>
                                                                    </a>";
                                        echo "<a href='../update/php-update-award.php?aw_id=" . $award_row['aw_id'] . "' title='Update Record' data-toggle='tooltip'>
                                                                    <span class='glyphicon glyphicon-pencil'>✏️</span>
                                                                    </a>";
                                        echo "<a href='../delete/php-delete-award.php?aw_id=" . $award_row['aw_id'] . "' title='Delete Record' data-toggle='tooltip'>
                                                                    <span class='glyphicon glyphicon-trash'>🗑️</span>
                                                                    </a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                    // Free result set
                                    mysqli_free_result($award_result);
                                } else {
                                    echo "<p class='lead'><em>No records were found.</em></p>";
                                }
                            } else {
                                echo "ERROR: Could not able to execute $award_sql_read. " . mysqli_error($conn);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- AWARD TABLE END -->

            <!-- Other Experience TABLE START -->
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="page-header clearfix">
                                <label><b>Other Experience :</b></label><br>
                                <a href="../create/php-create-other-experience.php" class="btn btn-success pull-right">Add New Other Experience</a>
                            </div>
                            <?php
                            // Include config file
                            require_once "../dbh.php";

                            // Attempt select query execution
                            $other_experience_sql_read = "SELECT * FROM other_experience WHERE pd_id = $PersonalDataId";
                            if ($other_experience_result = mysqli_query($conn, $other_experience_sql_read)) {
                                if (mysqli_num_rows($other_experience_result) > 0) {
                                    echo "<table class='table table-bordered table-striped'>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<br>";
                                    echo "<th style='width:34%; text-align:center'>Company Name</th>";
                                    echo "<th style='width:34%; text-align:center'>Position on Company</th>";
                                    echo "<th style='width:18%; text-align:center'>Date</th>";
                                    echo "<th style='width:14%; text-align:center'>Action</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while ($other_experience_row = mysqli_fetch_array($other_experience_result)) {
                                        $tanggal = $other_experience_row['tanggal'];
                                        $tgloe = date("F o", strtotime($tanggal));
                                        echo "<tr>";
                                        echo "<td>" . $other_experience_row['nama'] . "</td>";
                                        echo "<td>" . $other_experience_row['posisi'] . "</td>";
                                        echo "<td style='text-align:center'>" . $tgloe . "</td>";
                                        echo "<td>";
                                        echo "<a href='../read/php-read-other-experience.php?ox_id=" . $other_experience_row['ox_id'] . "' title='View Record' data-toggle='tooltip'>
                                                                    <span class='glyphicon glyphicon-eye-open'>👁️</span>
                                                                    </a>";
                                        echo "<a href='../update/php-update-other-experience.php?ox_id=" . $other_experience_row['ox_id'] . "' title='Update Record' data-toggle='tooltip'>
                                                                    <span class='glyphicon glyphicon-pencil'>✏️</span>
                                                                    </a>";
                                        echo "<a href='../delete/php-delete-other-experience.php?ox_id=" . $other_experience_row['ox_id'] . "' title='Delete Record' data-toggle='tooltip'>
                                                                    <span class='glyphicon glyphicon-trash'>🗑️</span>
                                                                    </a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                    // Free result set
                                    mysqli_free_result($other_experience_result);
                                } else {
                                    echo "<p class='lead'><em>No records were found.</em></p>";
                                }
                            } else {
                                echo "ERROR: Could not able to execute $other_experience_sql_read. " . mysqli_error($conn);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <a href="experience.php" name="previous" class="btn btn-info btn-md" id="previous">Previous</a>
            <a href="language.php" name="next" class="btn btn-warning btn-md float-right" id="next">Next</a>
            <!-- Other Experience TABLE END -->
        </div>
    </div>
</div>
<!-- END ADDITIONAL INFORMATION -->