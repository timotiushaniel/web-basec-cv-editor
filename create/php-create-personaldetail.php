<!doctype html>
<html lang="en">
<?php
require "../form/session_time.php";
    //Personal Data//
    $FullName = isset($_GET["FullName"]) ? $_GET["FullName"] : "";
    $Address = isset($_GET["Address"]) ? $_GET["Address"] : "";
    $City = isset($_GET["City"]) ? $_GET["City"] : "";
    $Province = isset($_GET["Province"]) ? $_GET["Province"] : "";
    $Country = isset($_GET["Country"]) ? $_GET["Country"] : "";
    $ZipCode = isset($_GET["ZipCode"]) ? $_GET["ZipCode"] : "";
    $Phone = isset($_GET["Phone"]) ? $_GET["Phone"] : "";
    $Email = isset($_GET["Email"]) ? $_GET["Email"] : "";
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
      <link rel="stylesheet" type="text/css" href="StyleForm.css">

      <title>Curiculum Vitae</title>
	    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	    <script src="form.js"></script>
      <style type="text/css">
        .col-12{
          width: 500px;
          margin: 0 auto;
        }
        a{
          width:50%;
        }
      </style>
  </head>

  <body>
        <!-- START PAGE OF PERSONAL DATA FORM -->
        <div class="col-12">
          <div class="tab-content" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
	        <p><b>Please fill in this form.</b></p>
          <h2 class="alert alert-primary text-center mt-3">Personal data</h2><hr>

          <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                echo '<p style="color:red" align="center">Fill in all!</p>';
            }
            else if ($_GET['error'] == "emptyfieldsFullName") {
                echo '<p style="color:red" align="center">Fill in the Full Name!</p>';
            }

            else if ($_GET['error'] == "emptyfieldsAddress") {
                echo '<p style="color:red" align="center">Fill in the address!</p>';
            }

            else if ($_GET['error'] == "emptyfieldsCity") {
                echo '<p style="color:red" align="center">Fill in the city!</p>';
            }

            else if ($_GET['error'] == "emptyfieldsProvince") {
                echo '<p style="color:red" align="center">Fill in the State/province!</p>';
            }

            else if ($_GET['error'] == "emptyfieldsCountry") {
                echo '<p style="color:red" align="center">Fill in the country!</p>';
            }

            else if ($_GET['error'] == "emptyfieldsZipCode") {
                echo "<p style='color:red' align='center'>Fill in the zip code!</p>";
            }

            else if ($_GET['error'] == "emptyfieldsPhone") {
              echo "<p style='color:red' align='center'>Fill in the phone!</p>";
            }

            else if ($_GET['error'] == "invalidPhone") {
              echo "<p style='color:red' align='center'>Invalid phone number!</p>";
            }

            else if ($_GET['error'] == "invalidEmail") {
              echo '<p style="color:red" align="center">invalid email!</p>';
            }

            else if ($_GET['error'] == "emptyfieldsEmail") {
              echo '<p style="color:red" align="center">Fill in the Email!</p>';
            }

            else if ($_GET['error'] == "emptyfieldsNIM") {
              echo "<p style='color:red' align='center'>Fill in the NIM!</p>";
            }

            else if ($_GET['error'] == "emptyfieldsProgramStudi") {
              echo "<p style='color:red' align='center'>Fill in the Program Studi!</p>";
            }

            else {
              echo "<p style='color:green' align='center'>Personal details are complete, please continue!</p>";
            }
            
        }
        
        ?>
          
          <form action="../process/phpform.php" method="POST">
					  <div class="form-group mb-3 input-group-sm">
                        <label for="Name"><b>Full Name :</b></label>
                        <input type="text" class="form-control" id="FullName" name="FullName" placeholder="Full Name" value="<?=$FullName;?>">
            </div>
          
					  <div class="form-group mb-3 input-group-sm">
                        <label for="address"><b>Address :</b></label>
                        <input type="text" class="form-control" id="Address" name="Address"  placeholder="Address" value="<?=$Address;?>">
                        <input type="text" class="form-control" id="City" name="City"  placeholder="City" value="<?=$City;?>">
                        <select class="custom-select" name="Province" id="Province" onmousedown="if(this.options.length>5){this.size=5;}"  onchange='this.size=0;' onblur="this.size=0;">
                            <option disabled selected> Choose </option>
                            <?php
                            require_once "../dbh.php";
                            $option_sql_read = "SELECT * FROM provinsi;";
                            if ($option_result = mysqli_query($conn, $option_sql_read)) {
                              if(mysqli_num_rows($option_result) > 0){
                                while ($row = mysqli_fetch_array($option_result)) {
                                  $provinsi = $row["nama_provinsi"];
                                  ?>
                                    <option value="<?=$row[0]?>" <?php if ($Province == $row[0]) {echo "selected";}?>><?=$provinsi?></option> 
                            <?php
                                }       
                              }                                                   
                            }
                            ?>
                        </select>
                        <select class="form-control" name="Country" id="Country">
                            <option selected> Choose </option>
                            <?php
                            require_once "../dbh.php";
                            require_once "../konstanta.php";
                            $optionnegara_sql_read = "SELECT * FROM ".NEGARA.";";
                            if ($optionnegara_result = mysqli_query($conn, $optionnegara_sql_read)) {
                              if(mysqli_num_rows($optionnegara_result) > 0){
                                while ($row_negara = mysqli_fetch_array($optionnegara_result)) {
                                  $negara = $row_negara['nama_negara'];
                                  ?>
                                  
                                    <option value="<?=$row_negara[0]?>" <?php if ($Country == $row_negara[0]) {echo "selected";}?>><?=$negara?></option> 
                            <?php
                                }    
                              }  mysqli_close($conn);                                                         
                            }
                            ?>
                        </select>
                        <input type="text" class="form-control" id="ZipCode" name="ZipCode"  placeholder="Zip code" value="<?=$ZipCode;?>">
            </div>
          
					  <div class="form-group mb-3 input-group-sm">
                        <label><b>Phone Number :</b></label><br>
                            <table width=100%>
                                <tr>
                                    <td width="10%" style="text-align:center">+62</td>
                                    <td><input type="text" class="form-control" id="Phone" name="Phone"  placeholder="Phone" value="<?=$Phone;?>"></td>
                                <tr>
                            </table>
            </div>
          
					  <div class="form-group mb-3 input-group-sm">
                        <label for="email"><b>Email :</b></label>
                        <input type="text" class="form-control" placeholder="Enter Email" id="Email" name="Email" value="<?=$Email;?>">
            </div>

            <div class="form-group mb-3 input-group-sm">
                        <label for="NIM"><b>NIM :</b></label>
                        <input type="text" class="form-control" placeholder="Enter NIM" id="NIM" name="NIM" value="<?=$NIM;?>">
            </div>


            <div class="form-group">
                <label for="program_studi"><b>Study Program :</b></label>
                <select class="form-control" id="program_studi" name="program_studi">
                    <option value="1" <?php if (isset($_GET['program_studi']) == 1) {echo "selected";}?>>Mobile Technology</option>
                    <option value="2" <?php if (isset($_GET['program_studi']) == 2) {echo "selected";}?>>Media Internet Technology</option>
                    </select>
            </div>
            <button type="submit" class="btn btn-primary" id="Tombol" name="Tombol">Submit</button> 
            <button href="../form/personaldata.php" class="btn btn-danger">Cancel</button>
          </form>	
                <br>
        </div>
        <!-- END PAGE OF PERSONAL DATA FORM -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>