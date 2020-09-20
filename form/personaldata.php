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
//Personal Data//
$FullName = isset($_GET["FullName"]) ? $_GET["FullName"] : "";
$Address = isset($_GET["Address"]) ? $_GET["Address"] : "";
$City = isset($_GET["City"]) ? $_GET["City"] : "";
$Province = isset($_GET["Province"]) ? $_GET["Province"] : "";
$Country = isset($_GET["Country"]) ? $_GET["Country"] : "";
$ZipCode = isset($_GET["ZipCode"]) ? $_GET["ZipCode"] : "";
$Phone = isset($_GET["Phone"]) ? $_GET["Phone"] : "";
$Email = isset($_GET["Email"]) ? $_GET["Email"] : "";
$Photo = isset($_GET["Photo"]) ? $_GET["Photo"] : "";
$NIM = isset($_GET["NIM"]) ? $_GET["NIM"] : "";
$program_studi = isset($_GET["program_studi"]) ? $_GET["program_studi"] : "";
//End Personal Data//
?>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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
        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="personaldata.php" role="tab" aria-controls="v-pills-home" aria-selected="true">Personal Data</a>
        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="employment_objective.php" role="tab" aria-controls="v-pills-profile" aria-selected="false">Employment Objective</a>
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

<!-- START PAGE OF PERSONAL DATA FORM -->
    <div class="col-9">
        <div class="tab-content" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

            <h2 class="alert alert-primary text-center mt-3">Personal Data</h2>
            <hr>

            <?php
            if (isset($_GET['error'])) {
              if ($_GET['error'] == "emptyfields") {
                echo '<p style="color:red" align="center">Fill in all!</p>';
              } else if ($_GET['error'] == "emptyfieldsFullName") {
                echo '<p style="color:red" align="center">Fill in the Full Name!</p>';
              } else if ($_GET['error'] == "emptyfieldsAddress") {
                echo '<p style="color:red" align="center">Fill in the address!</p>';
              } else if ($_GET['error'] == "emptyfieldsCity") {
                echo '<p style="color:red" align="center">Fill in the city!</p>';
              } else if ($_GET['error'] == "emptyfieldsProvince") {
                echo '<p style="color:red" align="center">Fill in the State/province!</p>';
              } else if ($_GET['error'] == "emptyfieldsCountry") {
                echo '<p style="color:red" align="center">Fill in the country!</p>';
              } else if ($_GET['error'] == "emptyfieldsZipCode") {
                echo "<p style='color:red' align='center'>Fill in the zip code!</p>";
              } else if ($_GET['error'] == "emptyfieldsPhone") {
                echo "<p style='color:red' align='center'>Fill in the phone!</p>";
              } else if ($_GET['error'] == "invalidPhone") {
                echo "<p style='color:red' align='center'>Invalid phone number!</p>";
              } else if ($_GET['error'] == "invalidEmail") {
                echo '<p style="color:red" align="center">invalid email!</p>';
              } else if ($_GET['error'] == "emptyfieldsPhoto") {
                echo "<p style='color:red' align='center'>Fill in the photo!</p>";
              } else if ($_GET['error'] == "emptyfieldsNIM") {
                echo "<p style='color:red' align='center'>Fill in the NIM!</p>";
              } else if ($_GET['error'] == "emptyfieldsProgramStudi") {
                echo "<p style='color:red' align='center'>Fill in the Program Studi!</p>";
              } else {
                echo "<p style='color:green' align='center'>Personal details are complete, please continue!</p>";
              }
            }
            ?>

            <?php
            // Include config file
            require_once "../dbh.php";

            // Attempt select query execution
            $personaldetail_sql_read = "SELECT * FROM personal_detail WHERE us_id = $UserId";
            if ($personaldetail_result = mysqli_query($conn, $personaldetail_sql_read)) {
              if (mysqli_num_rows($personaldetail_result) > 0) {
                echo "<div class='container'>";
                echo "<div class='row'>";
                echo "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad'>";
                echo "<div class='panel panel-info'>";
                echo "<div class='panel-heading'>";
                while ($personaldetail_row = mysqli_fetch_array($personaldetail_result)) {
                  $nama_lengkap = $personaldetail_row['nama'];
                  $nomer_induk = $personaldetail_row['no_induk'];
                  $alamat = $personaldetail_row['alamat'];
                  $kota = $personaldetail_row['kota'];
                  $provinsi = $personaldetail_row['propinsi'];
                  $provinsi_sql_read = "SELECT * FROM provinsi WHERE pr_id = $provinsi";
                  if ($provinsi_result = mysqli_query($conn, $provinsi_sql_read)) {
                    if (mysqli_num_rows($provinsi_result) > 0) {
                      while ($provinsi_row = mysqli_fetch_array($provinsi_result)) {
                        $provinsi_name = $provinsi_row['nama_provinsi'];
                      }
                    } else {
                      $provinsi_name = "Province unknown";
                    }
                  } else {
                    echo "ERROR: Could not able to execute $provinsi_sql_read. " . mysqli_error($conn);
                  }       
                  $country = $personaldetail_row['negara'];   
                  $negara_sql_read = "SELECT * FROM negara WHERE ne_id = $country";  
                  if ($negara_result = mysqli_query($conn, $negara_sql_read)) {
                    if (mysqli_num_rows($negara_result) > 0) {
                      while ($negara_row = mysqli_fetch_array($negara_result)) {
                        $negara_name = $negara_row['nama_negara'];
                      }
                    } else {
                      $negara_name = "Country unknown";
                    }
                  } else {
                    echo "ERROR: Could not able to execute $negara_sql_read. " . mysqli_error($conn);
                  }   
                  $kodepos = $personaldetail_row['kode_pos'];
                  $nomer_telepon = $personaldetail_row['no_telpon'];
                  $alamat_email = $personaldetail_row['email'];
                  $program_studi_id = $personaldetail_row['ps_id'];
                  $programstudi_sql_read = "SELECT * FROM program_studi WHERE ps_id = $program_studi_id";
                  if ($programstudi_result = mysqli_query($conn, $programstudi_sql_read)) {
                      if (mysqli_num_rows($programstudi_result) > 0) {
                        while ($programstudi_row = mysqli_fetch_array($programstudi_result)) {
                          $program_studi_name = $programstudi_row['nama'];
                        }
                      } else {
                        $program_studi_name = "Study Program unknown";
                      }
                    } else {
                      echo "ERROR: Could not able to execute $programstudi_sql_read. " . mysqli_error($conn);
                    }                  
                $image_sql_read = "SELECT * FROM picture WHERE us_id = $UserId";
                if($image_result = mysqli_query($conn, $image_sql_read)){
                  if(mysqli_num_rows($image_result) > 0){
                    while($image_row = mysqli_fetch_array($image_result)){
                      $image = $image_row['picture'];
                                          
                    }                  
                  }
                } else {
                  echo "ERROR: Could not able to execute $image_sql_read. " . mysqli_error($conn);
                }
                }
                
                echo "<h3 class='panel-title'>" . $nama_lengkap . "</h3><br>";
                echo "</div>";
                echo "<div class='panel-body'>";
                echo "<div class='row'>";
                echo "<div class='col-md-3 col-lg-3' align='center'>";
                if (!empty ($image)){
                  echo "<img alt='User Pic' style='width:100%' src='../assets/profile-picture/".$image."' class='img-circle img-responsive'><br>";
                  echo "<a href='../update/php-update-photo.php' id='update' name='update'>✏️ Update Photo</a></div>";
        
                } else{
                  echo "<a href='../create/php-create-photo.php'>";
                  echo "<img alt='User Pic' style='width:100%' src='../assets/image/add.png' class='img-circle img-responsive'></div>";
                  echo "</a>";
                }
                echo "<div class=' col-md-9 col-lg-9'> ";
                echo "<table class='table table-user-information'>";
                echo "<tbody>";
                echo "<tr>";
                echo "<td>ID Number</td>";
                echo "<td>:</td>";
                echo "<td>" . $nomer_induk . "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Study Program</td>";
                echo "<td>:</td>";
                echo "<td>" . $program_studi_name . "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Full Address</td>";
                echo "<td>:</td>";
                echo "<td>" . $alamat . ", " . $kota . ", " . $kodepos . ", " . $provinsi_name . ", " . $negara_name ."</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Email</td>";
                echo "<td>:</td>";
                echo "<td><a href='mailto:" . $alamat_email . "'>" . $alamat_email . "</a></td>";
                echo "</tr>";

               
                
                echo "<td>Phone Number</td>";
                echo "<td>:</td>";
                echo "<td>" . "+62" . $nomer_telepon . " (Mobile)</td>";
                echo "</tr>";
                echo "</tbody>
                                            </table>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>";
                // Free result set
                mysqli_free_result($personaldetail_result);
              } else {
                echo "<p class='lead'><em>Personal Data record were not found. Please add personal data record first.</em></p>";
              }
            } else {
              echo "ERROR: Could not able to execute $personaldetail_sql_read. " . mysqli_error($conn);
            }
            ?>
            <br>
            <a href="../create/php-create-personaldetail.php">
              <button type="submit" class="btn btn-success btn-md" id="TombolSubmit" name="TombolSubmit" <?php if ($PersonalDataId != '0') {
                                                                                                            echo "hidden";
                                                                                                          } else {
                                                                                                            echo "enable";
                                                                                                          } ?>>Add Personal Data</button>
            </a>
            <?php echo "<a href='../update/php-update-personaldetail.php?pd_id=" . $PersonalDataId . "'>" ?>
            <button type="submit" class="btn btn-primary btn-md" id="TombolUpdate" name="TombolUpdate" <?php if ($PersonalDataId == '0') {
                                                                                                          echo "hidden";
                                                                                                        } else {
                                                                                                          echo "enable";
                                                                                                        } ?>>Update Personal Data</button>
            </a>

            <br><br><br>
            <?php
                if (!empty($PersonalDataId)) {
                  echo '<a href="employment_objective.php" name="next" class="btn btn-warning btn-md float-right" id="next">Next</a>';
                }
                ?>
          </div>
          <!-- END PAGE OF PERSONAL DATA FORM -->
        </div>
    </div>
  </div>
</html>