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

        <a class="nav-link ml-5 my-1 active" id="v-pills-college-tab" data-toggle="pill" href="college.php" role="tab" aria-controls="v-pills-college" aria-selected="false">College</a>
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

<!-- START PAGE OF EDUCATION FORM -->
        <div class="col-9">
        <div class="tab-pane" id="v-pills-college" role="tabpanel" aria-labelledby="v-pills-college-tab">
            <h2 class="alert alert-primary text-center mt-3">College</h2>
            <hr>
            <?php
            // Include config file
            require_once "../dbh.php";
            // Attempt select query execution
            $he_sql_read = "SELECT * FROM higher_education WHERE pd_id = $PersonalDataId";
            if ($he_result = mysqli_query($conn, $he_sql_read)) {
                if (mysqli_num_rows($he_result) > 0) {
                    while ($he_row = mysqli_fetch_array($he_result)) {
                        $nama = $he_row['nama'];
                        $he_id_temp = $he_row['he_id'];
                        $kota = $he_row['kota'];
                        $gelar = $he_row['jurusan'];
                        $concentration = $he_row['concentration'];
                        $gelar = $he_row['gelar'];
                        $ipk = $he_row['ipk'];
                        $tanggal = $he_row['tanggal'];
                        $negara = $he_row['negara'];
                        $tgl = date("F o", strtotime($tanggal));
                        
                        if ($he_id_temp != '0') {
                        $he_id = $he_id_temp;
                        } else {
                        $he_id = 0;
                        }
                        echo "<div class=' col-md-9 col-lg-9'> ";
                        echo "<table class='table table-user-information'>";
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<td>College Name</td>";
                        echo "<td>:</td>";
                        echo "<td>" . $nama . "</td>";
                        echo "</tr>";
        
                        echo "<tr>";
                        echo "<td>College City</td>";
                        echo "<td>:</td>";
                        echo "<td>" . $kota . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>Country</td>";
                        echo "<td>:</td>";
                        echo "<td>" . $negara . "</td>";
                        echo "</tr>";
        
                        echo "<tr>";
                        echo "<td>Degree</td>";
                        echo "<td>:</td>";
                        echo "<td>". $gelar ."</td>";
                        echo "</tr>";
        
                        echo "<tr>";
                        echo "<td>Concentration</td>";
                        echo "<td>:</td>";
                        echo "<td>". $concentration . "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>Grade-point average</td>";
                        echo "<td>:</td>";
                        echo "<td>". $ipk . "</td>";
                        echo "</tr>";
        
                        echo "<td>Date</td>";
                        echo "<td>:</td>";
                        echo "<td>". $tgl . "</td>";
                        echo "</tr>";
                        echo "</tbody>
                            </table>
                            </div>";
                    }
                    // Free result set
                    mysqli_free_result($he_result);
                } else {
                    $he_id = 0;
                    echo "<p class='lead'><em>College record were not found. Please add College record first.</em></p>";
                }
            } else {
                echo "ERROR: Could not able to execute $he_sql_read. " . mysqli_error($conn);
            }
            ?>
            <br><br>

            <a href="../create/php-create-college.php">
            <button type="submit" class="btn btn-success btn-md" id="TombolSubmitHe" name="TombolSubmitHe" <?php if ($he_id != '0') {
                                                                                                                    echo "hidden";
                                                                                                                } else {
                                                                                                                    echo "enable";
                                                                                                                } ?>>Add College</button>
            </a>
            <?php echo "<a href='../update/php-update-college.php?he_id=" . $he_id . "'>" ?>
            <button type="submit" class="btn btn-primary btn-md" id="TombolUpdateHe" name="TombolUpdateHe" <?php if ($he_id == '0') {
                                                                                                                    echo "hidden";
                                                                                                                } else {
                                                                                                                    echo "enable";
                                                                                                                } ?>>Update College</button>
            </a><br><br><br>
            <a href="employment_objective.php" name="previousHe" class="btn btn-info btn-md" id="previous">Previous</a>
            <a href="certiplus_program.php" name="next" class="btn btn-warning btn-md float-right" id="next">Next</a>
        </div>
    </div>
</div>