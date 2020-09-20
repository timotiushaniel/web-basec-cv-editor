<?php
session_start();
$UserEmail = $_SESSION['Email'];
$PersonalDataId = $_SESSION['pd_id'];
$UserId = $_SESSION['user_id'];

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
//EMPLOYMENT OBJECTIVE//
$EmploymentObjectve = isset($_GET["EmploymentObjective"]) ? $_GET["EmploymentObjective"] : "";
//END EMPLOYMENT OBJECTIVE//
//EDUCATION//


//certiplus//
$Certiplus_Program_place = isset($_GET["Certiplus_Program_place"]) ? $_GET["Certiplus_Program_place"] : "";
$computer = isset($_GET["computer"]) ? $_GET["computer"] : "";
$communication = isset($_GET["communication"]) ? $_GET["communication"] : "";
$java_mobile = isset($_GET["java_mobile"]) ? $_GET["java_mobile"] : "";
$leadership = isset($_GET["leadership"]) ? $_GET["leadership"] : "";
$Entrepreneurship = isset($_GET["Entrepreneurship"]) ? $_GET["Entrepreneurship"] : "";
$Career_planning_skills = isset($_GET["Career_planning_skills"]) ? $_GET["Career_planning_skills"] : "";
$graduate_certiplus = isset($_GET["graduate_certiplus"]) ? $_GET["graduate_certiplus"] : "";

//end certiplus//

?>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="StyleForm.css">

  <title>Curriculum Vitae</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script src="form.js"></script>
</head>

<body>
  <nav class="navbar navbar-light bg-light">


    <a href='https://ithb.ac.id/'><img src="ithb.png" alt="logo" style="height:35px; width:70px;"></a>
    <h4 style="letter-spacing: 12px; word-spacing: 20px;">•  CURRICULUM VITAE  •</h4>
    <form class="form-inline" action="logout.php" method="POST">
      <button class="btn btn-outline-dark my-2 my-sm-0" type="submit" name="logout_button">Logout</button>
    </form>

  </nav>
  <div class="row">
    <div class="col-3">
      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Personal Data</a>
        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Employment Objective</a>
        <a class="nav-link" id="v-pills-messages-tab" href="#" role="tab" aria-controls="v-pills-messages" aria-selected="false">Education</a>

        <a class="nav-link ml-5 my-1" id="v-pills-college-tab" data-toggle="pill" href="#v-pills-college" role="tab" aria-controls="v-pills-college" aria-selected="false">College</a>
        <a class="nav-link ml-5 my-1" id="v-pills-certiplus-tab" data-toggle="pill" href="#v-pills-certiplus" role="tab" aria-controls="v-pills-certiplus" aria-selected="false">Certiplus Program</a>
        <a class="nav-link ml-5 my-1" id="v-pills-cisco-tab" data-toggle="pill" href="#v-pills-cisco" role="tab" aria-controls="v-pills-cisco" aria-selected="false">Cisco Networking Academy</a>
        <a class="nav-link ml-5 my-1" id="v-pills-school-tab" data-toggle="pill" href="#v-pills-school" role="tab" aria-controls="v-pills-school" aria-selected="false">High School</a>




        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Experience</a>
        <a class="nav-link" id="v-pills-add-tab" data-toggle="pill" href="#v-pills-add" role="tab" aria-controls="v-pills-add" aria-selected="false">Additional Information</a>
        <a class="nav-link" id="v-pills-language-tab" data-toggle="pill" href="#v-pills-language" role="tab" aria-controls="v-pills-language" aria-selected="false">Language</a>
      </div>
    </div>

    <!-- START PAGE OF PERSONAL DATA FORM -->
    <div class="col-9">
      <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

          <h2 class="alert alert-primary text-center mt-3">Personal Detail</h2>
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
          require_once "dbh.php";

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
                    $program_studi_name = "Program studi unknown";
                  }
                } else {
                  echo "ERROR: Could not able to execute $programstudi_sql_read. " . mysqli_error($conn);
                }
              }
              $image_sql_read = "SELECT * FROM picture WHERE us_id = $UserId";
              if($image_result = mysqli_query($conn, $image_sql_read)){
                if(mysqli_num_rows($image_result) > 0){
                  while($image_row = mysqli_fetch_array($image_result)){
                    $image = $image_row['picture'];
                  }
                }
                else{
                  $image = "Unknown Picture";
                }
              } else {
                echo "ERROR: Could not able to execute $image_sql_read. " . mysqli_error($conn);
              }
              
              echo "<h3 class='panel-title'>" . $nama_lengkap . "</h3><br>";
              echo "</div>";
              echo "<div class='panel-body'>";
              echo "<div class='row'>";
              echo "<div class='col-md-3 col-lg-3' align='center'> <img alt='User Pic' style='width:100%' src='profile-picture/".$image."' class='img-circle img-responsive'></div>";
              echo "<div class=' col-md-9 col-lg-9'> ";
              echo "<table class='table table-user-information'>";
              echo "<tbody>";
              echo "<tr>";
              echo "<td>Nomer Induk</td>";
              echo "<td>:</td>";
              echo "<td>" . $nomer_induk . "</td>";
              echo "</tr>";

              echo "<tr>";
              echo "<td>Program Studi</td>";
              echo "<td>:</td>";
              echo "<td>" . $program_studi_name . "</td>";
              echo "</tr>";

              echo "<tr>";
              echo "<td>Alamat Lengkap</td>";
              echo "<td>:</td>";
              echo "<td>" . $alamat . ", " . $kota . ", " . $provinsi . ", " . $kodepos . "</td>";
              echo "</tr>";

              echo "<tr>";
              echo "<td>Email</td>";
              echo "<td>:</td>";
              echo "<td><a href='mailto:" . $alamat_email . "'>" . $alamat_email . "</a></td>";
              echo "</tr>";

              echo "<td>Nomer Telepon</td>";
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
          <a href="php-create-personaldetail.php">
            <button type="submit" class="btn btn-primary btn-md" id="TombolSubmit" name="TombolSubmit" <?php if ($PersonalDataId != '0') {
                                                                                                          echo "hidden";
                                                                                                        } else {
                                                                                                          echo "enable";
                                                                                                        } ?>>Add Personal Data</button>
          </a>
          <?php echo "<a href='php-update-personaldetail.php?pd_id=" . $PersonalDataId . "'>" ?>
          <button type="submit" class="btn btn-success btn-md" id="TombolUpdate" name="TombolUpdate" <?php if ($PersonalDataId == '0') {
                                                                                                        echo "hidden";
                                                                                                      } else {
                                                                                                        echo "enable";
                                                                                                      } ?>>Update Personal Data</button>
          </a>

          <br><br><br>
          <button name="next" class="btn btn-warning btn-md float-right" id="next">Next</button>
        </div>
        <!-- END PAGE OF PERSONAL DATA FORM -->

        <!-- START PAGE OF EMPLOYMENT OBJECTIVE FORM -->
        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
          <h2 class="alert alert-primary text-center mt-3">Employment Objective</h2>

          <?php
          // Include config file
          require_once "dbh.php";
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

          <a href="php-create-employmentobjective.php">
            <button type="submit" class="btn btn-primary btn-md" id="TombolSubmitEo" name="TombolSubmitEo" <?php if ($eo_id != '0') {
                                                                                                              echo "hidden";
                                                                                                            } else {
                                                                                                              echo "enable";
                                                                                                            } ?>>Add Employment Objective</button>
          </a>
          <?php echo "<a href='php-update-employmentobjective.php?eo_id=" . $eo_id . "'>" ?>
          <button type="submit" class="btn btn-success btn-md" id="TombolUpdateEo" name="TombolUpdateEo" <?php if ($eo_id == '0') {
                                                                                                            echo "hidden";
                                                                                                          } else {
                                                                                                            echo "enable";
                                                                                                          } ?>>Update Employment Objective</button>
          </a><br><br><br>
          <button name="previous" class="btn btn-info btn-md" id="previous">Previous</button>
          <button name="next" class="btn btn-warning btn-md float-right" id="next">Next</button>
        </div>
        <!-- END PAGE OF EMPLOYMENT OBJECTIVE FORM -->

        <!-- START PAGE OF EDUCATION FORM -->
        <div class="tab-pane fade" id="v-pills-college" role="tabpanel" aria-labelledby="v-pills-college-tab">
          <h2 class="alert alert-primary text-center mt-3">Education</h2>
          <hr>
          <?php
          // Include config file
          require_once "dbh.php";
          // Attempt select query execution
          $he_sql_read = "SELECT * FROM higher_education WHERE pd_id = $PersonalDataId";
          if ($he_result = mysqli_query($conn, $he_sql_read)) {
            if (mysqli_num_rows($he_result) > 0) {
              while ($he_row = mysqli_fetch_array($he_result)) {
                $nama = $he_row['nama'];
                $he_id_temp = $he_row['he_id'];
                $kota = $he_row['kota'];
                $jurusan = $he_row['jurusan'];
                $concentration = $he_row['concentration'];
                $gelar = $he_row['gelar'];
                $ipk = $he_row['ipk'];
                $tanggal = $he_row['tanggal'];
                $negara = $he_row['negara'];
                
                if ($he_id_temp != '0') {
                  $he_id = $he_id_temp;
                } else {
                  $he_id = 0;
                }
                echo "<div class=' col-md-9 col-lg-9'> ";
                echo "<table class='table table-user-information'>";
                echo "<tbody>";
                echo "<tr>";
                echo "<td>Nama perguruan tinggi</td>";
                echo "<td>:</td>";
                echo "<td>" . $nama . "</td>";
                echo "</tr>";
  
                echo "<tr>";
                echo "<td>Kota</td>";
                echo "<td>:</td>";
                echo "<td>" . $kota . "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Negara</td>";
                echo "<td>:</td>";
                echo "<td>" . $negara . "</td>";
                echo "</tr>";
  
                echo "<tr>";
                echo "<td>Sarjana</td>";
                echo "<td>:</td>";
                echo "<td>". $jurusan ."</td>";
                echo "</tr>";
  
                echo "<tr>";
                echo "<td>Keahlian</td>";
                echo "<td>:</td>";
                echo "<td>". $concentration . "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>IPK</td>";
                echo "<td>:</td>";
                echo "<td>". $ipk . "</td>";
                echo "</tr>";
  
                echo "<td>Tanggal</td>";
                echo "<td>:</td>";
                echo "<td>".$tanggal."</td>";
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

          <a href="php-create-college.php">
            <button type="submit" class="btn btn-primary btn-md" id="TombolSubmitHe" name="TombolSubmitHe" <?php if ($he_id != '0') {
                                                                                                              echo "hidden";
                                                                                                            } else {
                                                                                                              echo "enable";
                                                                                                            } ?>>Add College</button>
          </a>
          <?php echo "<a href='php-update-college.php?eo_id=" . $he_id . "'>" ?>
          <button type="submit" class="btn btn-success btn-md" id="TombolUpdateHe" name="TombolUpdateHe" <?php if ($he_id == '0') {
                                                                                                            echo "hidden";
                                                                                                          } else {
                                                                                                            echo "enable";
                                                                                                          } ?>>Update College</button>
          </a><br><br><br>
          <button name="previousHe" class="btn btn-info btn-md" id="previous">Previous</button>
          <button name="next" class="btn btn-warning btn-md float-right" id="next">Next</button>
        
        </div>

        <div class="tab-pane fade" id="v-pills-certiplus" role="tabpanel" aria-labelledby="v-pills-certiplus-tab">
          
        <?php
          // Include config file
          require_once "dbh.php";
          // Attempt select query execution
          $cp_sql_read = "SELECT * FROM higher_education WHERE pd_id = $PersonalDataId";
          if ($cp_result = mysqli_query($conn, $cp_sql_read)) {
            if (mysqli_num_rows($cp_result) > 0) {
              while ($he_row = mysqli_fetch_array($cp_result)) {
                $nama = $he_row['nama'];
                $he_id_temp = $he_row['he_id'];
                $kota = $he_row['kota'];
                $jurusan = $he_row['jurusan'];
                $concentration = $he_row['concentration'];
                $gelar = $he_row['gelar'];
                $ipk = $he_row['ipk'];
                $tanggal = $he_row['tanggal'];
                $negara = $he_row['negara'];
                
                if ($he_id_temp != '0') {
                  $he_id = $he_id_temp;
                } else {
                  $he_id = 0;
                }
                echo "<div class=' col-md-9 col-lg-9'> ";
                echo "<table class='table table-user-information'>";
                echo "<tbody>";
                echo "<tr>";
                echo "<td>Nama perguruan tinggi</td>";
                echo "<td>:</td>";
                echo "<td>" . $nama . "</td>";
                echo "</tr>";
  
                echo "<tr>";
                echo "<td>Kota</td>";
                echo "<td>:</td>";
                echo "<td>" . $kota . "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Negara</td>";
                echo "<td>:</td>";
                echo "<td>" . $negara . "</td>";
                echo "</tr>";
  
                echo "<tr>";
                echo "<td>Sarjana</td>";
                echo "<td>:</td>";
                echo "<td>". $jurusan ."</td>";
                echo "</tr>";
  
                echo "<tr>";
                echo "<td>Keahlian</td>";
                echo "<td>:</td>";
                echo "<td>". $concentration . "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>IPK</td>";
                echo "<td>:</td>";
                echo "<td>". $ipk . "</td>";
                echo "</tr>";
  
                echo "<td>Tanggal</td>";
                echo "<td>:</td>";
                echo "<td>".$tanggal."</td>";
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
          
            <a href="php-create-certiplus.php">
                <button type="submit" class="btn btn-primary btn-md" id="TombolSubmitCp" name="TombolSubmitCp" <?php if (//$he_id != '0') {
                                                                                                                  echo "hidden";
                                                                                                                } else {
                                                                                                                  echo "enable";
                                                                                                                } ?>>Add Certiplus</button>
              </a>
              <?php echo "<a href='php-update-certiplus.php?eo_id=" . $he_id . "'>" ?>
              <button type="submit" class="btn btn-success btn-md" id="TombolUpdateCp" name="TombolUpdateCp" <?php if (//$he_id == '0') {
                                                                                                                echo "hidden";
                                                                                                              } else {
                                                                                                                echo "enable";
                                                                                                              } ?>>Update Certiplus</button>
              </a><br><br><br>
              <button name="previousCp" class="btn btn-info btn-md" id="previousCp">Previous</button>
              <button name="nextCp" class="btn btn-warning btn-md float-right" id="nextCp">Next</button>

        </div>

        <div class="tab-pane fade" id="v-pills-cisco" role="tabpanel" aria-labelledby="v-pills-cisco-tab">
          <form action="phpcisco.php" method="POST">
            <h2 class="alert alert-primary text-center mt-3">Education</h2>
            <div class="form-group mb-3 input-group-sm">
              <label><b>Cisco Networking Academy :</b></label>
              <input type="text" class="form-control" id="Cisco Networking Academy place" name="Cisco Networking Academy place" placeholder="Cisco Networking Academy place">
            </div>
          </form>
          <div class="form-check-inline">
            <label class="form-check-label">
              <input id="Routing" type="checkbox" class="form-check-input" value="Routing">Routing and Switching Essentials
            </label>
          </div>
          <div id="Box1" style="display: none;">
            <input class="form-control" type="month">
          </div>
          <br>
          <!-- tulisannya bisa ngilang dl diawal karena style display nya none, klo ga none dia bakal langsung muncul --->
          <div class="form-check-inline">
            <label class="form-check-label">
              <input id="Introduction" type="checkbox" class="form-check-input" value="Introduction">Introduction to Network
            </label>
          </div>
          <div id="Box2" style="display: none;">
            <input class="form-control" type="month">
          </div>
          <br><br>
          <button type="submit" class="btn btn-primary btn-sm" id="Eo_submit" name="certiplus_submit">Submit</button><br><br>
          <button name="previous" class="btn btn-info btn-md" id="previous">Previous</button>
          <button name="next" class="btn btn-warning btn-md float-right" id="next">Next</button>
        </div>
        <div class="tab-pane fade" id="v-pills-school" role="tabpanel" aria-labelledby="v-pills-school-tab">
          <form action="phphighschool.php" method="POST">
            <h2 class="alert alert-primary text-center mt-3">Education</h2>
            <div class="form-group mb-3 input-group-sm">
              <label><b>High School :</b></label>
              <input type="text" class="form-control" id="name_highschool" name="name_highschool" placeholder="Highschool Name">
              <input type="text" class="form-control" id="state_highschool" name="state_highschool" placeholder="State Highschool">
              <input type="text" class="form-control" id="city_highschool" name="City_highschool" placeholder="City Highschool">
              <input type="text" class="form-control" id="country_highschool" name="country_highschool" placeholder="Country Highschool">
            </div>
            <div class="form-group mb-3 input-group-sm">
              <label for="graduate_highschool">Graduate date:</label><br>
              <input type="month" class="form-control" id="graduate_highschool">
            </div>
          </form>

          <button name="previous" class="btn btn-info btn-md" id="previous">Previous</button>
          <button name="next" class="btn btn-warning btn-md float-right" id="next">Next</button>
        </div>


        <!-- START EXPERIENCE !-->
        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
          <h2 class="alert alert-primary text-center mt-3">Experience</h2>
          <hr>
          <!-- EXPERIENCE TABLE START -->
          <div class="wrapper">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div class="page-header clearfix">
                    <label><b>Experience :</b></label><br>
                    <a href="php-create-experience.php" class="btn btn-success pull-right">Add New Experience</a>
                  </div>
                  <?php
                  // Include config file
                  require_once "dbh.php";

                  // Attempt select query execution
                  $experience_sql_read = "SELECT * FROM experience WHERE pd_id = $PersonalDataId";
                  if ($experience_result = mysqli_query($conn, $experience_sql_read)) {
                    if (mysqli_num_rows($experience_result) > 0) {
                      echo "<table class='table table-bordered table-striped'>";
                      echo "<thead>";
                      echo "<tr>";
                      echo "<br>";
                      echo "<th>Experience Id</th>";
                      echo "<th>Company Name</th>";
                      echo "<th>Date</th>";
                      echo "<th>Position in Company</th>";
                      echo "<th>Job Detail</th>";
                      echo "<th>Action</th>";
                      echo "</tr>";
                      echo "</thead>";
                      echo "<tbody>";
                      while ($experience_row = mysqli_fetch_array($experience_result)) {
                        echo "<tr>";
                        echo "<td>" . $experience_row['ex_id'] . "</td>";
                        echo "<td>" . $experience_row['nama_perusahaan'] . "</td>";
                        echo "<td>" . $experience_row['tanggal'] . "</td>";
                        echo "<td>" . $experience_row['posisi'] . "</td>";
                        echo "<td>";
                        echo "<a href='php-experience-jobdetail.php?ex_id=" . $experience_row['ex_id'] . "' title='View Record' data-toggle='tooltip'>
                                                  <span class='glyphicon glyphicon-eye-open'>Details</span>
                                                  </a><br>";
                        $jobdetail_sql_read = "SELECT * FROM detail_job";
                        if ($jobdetail_result = mysqli_query($conn, $jobdetail_sql_read)) {
                          if (mysqli_num_rows($jobdetail_result) < 1) {
                            echo "<p style='color:red'>No detail job were found</p>";
                          }
                        }
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='php-read-experience.php?ex_id=" . $experience_row['ex_id'] . "' title='View Record' data-toggle='tooltip'>
                                                    <span class='bi bi-trash'>👁️</span>
                                                  </a>";
                        echo "<a href='php-update-experience.php?ex_id=" . $experience_row['ex_id'] . "' title='Update Record' data-toggle='tooltip'>
                                                    <span>✏️</span>
                                                  </a>";
                        echo "<a href='php-delete-experience.php?ex_id=" . $experience_row['ex_id'] . "' title='Delete Record' data-toggle='tooltip'>
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
          <!-- END EXPERIENCE !-->


          <button name="previous" class="btn btn-info btn-md" id="previous">Previous</button>
          <button name="next" class="btn btn-warning btn-md float-right" id="next">Next</button>
        </div>


        <!-- START ADDITIONAL INFORMATION -->
        <div class="tab-pane fade" id="v-pills-add" role="tabpanel" aria-labelledby="v-pills-add-tab">
          <h2 class="alert alert-primary text-center mt-3">Additional Information</h2>

          <?php
          // Include config file
          require_once "dbh.php";

          // Attempt select query execution
          $organization_sql_read = "SELECT * FROM organization WHERE pd_id = $PersonalDataId";
          echo "personal data id: $PersonalDataId<br>";
          echo "user id: $UserId";
          ?>

          <!-- ORGANIZATION TABLE START -->
          <div class="wrapper">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div class="page-header clearfix">
                    <label><b>Organization :</b></label><br>
                    <a href="php-create-organization.php" class="btn btn-success pull-right">Add New Organization</a>
                  </div>
                  <?php
                  // Include config file
                  require_once "dbh.php";

                  // Attempt select query execution
                  $organization_sql_read = "SELECT * FROM organization WHERE pd_id = $PersonalDataId";
                  if ($organization_result = mysqli_query($conn, $organization_sql_read)) {
                    if (mysqli_num_rows($organization_result) > 0) {
                      echo "<table class='table table-bordered table-striped'>";
                      echo "<thead>";
                      echo "<tr>";
                      echo "<br>";
                      echo "<th>Organization Id</th>";
                      echo "<th>Organization Name</th>";
                      echo "<th>Position on Organization</th>";
                      echo "<th>Date</th>";
                      echo "<th>Action</th>";
                      echo "</tr>";
                      echo "</thead>";
                      echo "<tbody>";
                      while ($organization_row = mysqli_fetch_array($organization_result)) {
                        echo "<tr>";
                        echo "<td>" . $organization_row['or_id'] . "</td>";
                        echo "<td>" . $organization_row['nama'] . "</td>";
                        echo "<td>" . $organization_row['posisi'] . "</td>";
                        echo "<td>" . $organization_row['tanggal'] . "</td>";
                        echo "<td>";
                        echo "<a href='php-read-organization.php?or_id=" . $organization_row['or_id'] . "' title='View Record' data-toggle='tooltip'>
                                                    <span class='glyphicon glyphicon-eye-open'>👁️</span>
                                                  </a>";
                        echo "<a href='php-update-organization.php?or_id=" . $organization_row['or_id'] . "' title='Update Record' data-toggle='tooltip'>
                                                    <span class='glyphicon glyphicon-pencil'>✏️</span>
                                                  </a>";
                        echo "<a href='php-delete-organization.php?or_id=" . $organization_row['or_id'] . "' title='Delete Record' data-toggle='tooltip'>
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
                    <a href="php-create-award.php" class="btn btn-success pull-right">Add New Award</a>
                  </div>
                  <?php
                  // Include config file
                  require_once "dbh.php";

                  // Attempt select query execution
                  $award_sql_read = "SELECT * FROM award WHERE pd_id = $PersonalDataId";
                  if ($award_result = mysqli_query($conn, $award_sql_read)) {
                    if (mysqli_num_rows($award_result) > 0) {
                      echo "<table class='table table-bordered table-striped'>";
                      echo "<thead>";
                      echo "<tr>";
                      echo "<br>";
                      echo "<th>Award Id</th>";
                      echo "<th>Award Name</th>";
                      echo "<th>Date</th>";
                      echo "<th>Action</th>";
                      echo "</tr>";
                      echo "</thead>";
                      echo "<tbody>";
                      while ($award_row = mysqli_fetch_array($award_result)) {
                        echo "<tr>";
                        echo "<td>" . $award_row['aw_id'] . "</td>";
                        echo "<td>" . $award_row['nama'] . "</td>";
                        echo "<td>" . $award_row['tanggal'] . "</td>";
                        echo "<td>";
                        echo "<a href='php-read-award.php?aw_id=" . $award_row['aw_id'] . "' title='View Record' data-toggle='tooltip'>
                                                      <span class='glyphicon glyphicon-eye-open'>👁️</span>
                                                    </a>";
                        echo "<a href='php-update-award.php?aw_id=" . $award_row['aw_id'] . "' title='Update Record' data-toggle='tooltip'>
                                                      <span class='glyphicon glyphicon-pencil'>✏️</span>
                                                    </a>";
                        echo "<a href='php-delete-award.php?aw_id=" . $award_row['aw_id'] . "' title='Delete Record' data-toggle='tooltip'>
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
                    <a href="php-create-other-experience.php" class="btn btn-success pull-right">Add New Other Experience</a>
                  </div>
                  <?php
                  // Include config file
                  require_once "dbh.php";

                  // Attempt select query execution
                  $other_experience_sql_read = "SELECT * FROM other_experience WHERE pd_id = $PersonalDataId";
                  if ($other_experience_result = mysqli_query($conn, $other_experience_sql_read)) {
                    if (mysqli_num_rows($other_experience_result) > 0) {
                      echo "<table class='table table-bordered table-striped'>";
                      echo "<thead>";
                      echo "<tr>";
                      echo "<br>";
                      echo "<th>Other experience Id</th>";
                      echo "<th>Company Name</th>";
                      echo "<th>Position on company</th>";
                      echo "<th>Date</th>";
                      echo "<th>Action</th>";
                      echo "</tr>";
                      echo "</thead>";
                      echo "<tbody>";
                      while ($other_experience_row = mysqli_fetch_array($other_experience_result)) {
                        echo "<tr>";
                        echo "<td>" . $other_experience_row['ox_id'] . "</td>";
                        echo "<td>" . $other_experience_row['nama'] . "</td>";
                        echo "<td>" . $other_experience_row['posisi'] . "</td>";
                        echo "<td>" . $other_experience_row['tanggal'] . "</td>";
                        echo "<td>";
                        echo "<a href='php-read-other-experience.php?ox_id=" . $other_experience_row['ox_id'] . "' title='View Record' data-toggle='tooltip'>
                                                      <span class='glyphicon glyphicon-eye-open'>👁️</span>
                                                    </a>";
                        echo "<a href='php-update-other-experience.php?ox_id=" . $other_experience_row['ox_id'] . "' title='Update Record' data-toggle='tooltip'>
                                                      <span class='glyphicon glyphicon-pencil'>✏️</span>
                                                    </a>";
                        echo "<a href='php-delete-other-experience.php?ox_id=" . $other_experience_row['ox_id'] . "' title='Delete Record' data-toggle='tooltip'>
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
          <button name="previous" class="btn btn-info btn-md" id="previous">Previous</button>
          <button name="next" class="btn btn-warning btn-md float-right" id="next">Next</button>
          <!-- Other Experience TABLE END -->
        </div>
        <!-- END ADDITIONAL INFORMATION -->


        <!-- START LANGUAGE -->
        <div class="tab-pane fade" id="v-pills-language" role="tabpanel" aria-labelledby="v-pills-language-tab">
          <h2 class="alert alert-primary text-center mt-3">Language List</h2>

          <!-- LANGUAGE TABLE START -->
          <div class="wrapper">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div class="page-header clearfix">
                    <label><b>Language List :</b></label><br>
                    <a href="php-create-language.php" class="btn btn-success pull-right">Add New Language List</a>
                  </div>
                  <?php
                  // Include config file
                  require_once "dbh.php";

                  // Attempt select query execution
                  $language_sql_read = "SELECT * FROM language WHERE pd_id = $PersonalDataId";
                  if ($language_result = mysqli_query($conn, $language_sql_read)) {
                    if (mysqli_num_rows($language_result) > 0) {
                      echo "<table class='table table-bordered table-striped'>";
                      echo "<thead>";
                      echo "<tr>";
                      echo "<br>";
                      echo "<th>Language Id</th>";
                      echo "<th>Language</th>";
                      echo "<th>Language test</th>";
                      echo "<th>Language proficient</th>";
                      echo "<th>skill</th>";
                      echo "<th>Test Score'</th>";
                      echo "<th>Action</th>";
                      echo "</tr>";
                      echo "</thead>";
                      echo "<tbody>";
                      while ($language_row = mysqli_fetch_array($language_result)) {
                        echo "<tr>";
                        echo "<td>" . $language_row['lg_id'] . "</td>";
                        echo "<td>" . $language_row['language'] . "</td>";
                        echo "<td>" . $language_row['language_test'] . "</td>";
                        echo "<td>" . $language_row['Language_proficient'] . "</td>";
                        echo "<td>";
                        echo "<a href='php-language-skill.php?lg_id=" . $language_row['lg_id'] . "' title='View Record' data-toggle='tooltip'>
                                                  <span class='glyphicon glyphicon-eye-open'>Skill</span>
                                                  </a><br>";
                        $language_skill_sql_read = "SELECT * FROM language_skill";
                        if ($language_skill_result = mysqli_query($conn, $language_skill_sql_read)) {
                          if (mysqli_num_rows($language_skill_result) < 1) {
                            echo "<p style='color:red'>No detail job were found</p>";
                          }
                        }
                        echo "</td>";
                        echo "<td>" . $language_row['score'] . "</td>";
                        echo "<td>";
                        echo "<a href='php-read-language.php?lg_id=" . $language_row['lg_id'] . "' title='View Record' data-toggle='tooltip'>
                                                        <span class='glyphicon glyphicon-eye-open'>👁️</span>
                                                      </a>";
                        echo "<a href='php-update-language.php?lg_id=" . $language_row['lg_id'] . "' title='Update Record' data-toggle='tooltip'>
                                                        <span class='glyphicon glyphicon-pencil'>✏️</span>
                                                      </a>";
                        echo "<a href='php-delete-language.php?lg_id=" . $language_row['lg_id'] . "' title='Delete Record' data-toggle='tooltip'>
                                                        <span class='glyphicon glyphicon-trash'>🗑️</span>
                                                      </a>";
                        echo "</td>";
                        echo "</tr>";
                      }
                      echo "</tbody>";
                      echo "</table>";
                      // Free result set
                      mysqli_free_result($language_result);
                    } else {
                      echo "<p class='lead'><em>No records were found.</em></p>";
                    }
                  } else {
                    echo "ERROR: Could not able to execute $language_sql_read. " . mysqli_error($conn);
                  }

                  // Close connection
                  mysqli_close($conn);

                  ?>
                </div>
              </div>
            </div>
          </div>
          <!-- LANGUAGE TABLE END -->

          <button name="previous" class="btn btn-info btn-md" id="previous">Previous</button>
        </div>
        <br><br>

      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>