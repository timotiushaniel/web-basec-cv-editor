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
          
          <form action="phpform.php" method="POST">
					  <div class="form-group mb-3 input-group-sm">
                        <label for="Name"><b>Full Name :</b></label>
                        <input type="text" class="form-control" id="FullName" name="FullName" placeholder="Full Name">
            </div>
          
					  <div class="form-group mb-3 input-group-sm">
                        <label for="address"><b>Address :</b></label>
                        <input type="text" class="form-control" id="Address" name="Address"  placeholder="Address">
                        <input type="text" class="form-control" id="City" name="City"  placeholder="City">
                        <input type="text" class="form-control" id="Province" name="Province"  placeholder="State/province">
                        <input type="text" class="form-control" id="Country" name="Country"  placeholder="Country">
                        <input type="text" class="form-control" id="ZipCode" name="ZipCode"  placeholder="Zip code">
            </div>
          
					  <div class="form-group mb-3 input-group-sm">
                        <label><b>Nomer Telepon</b></label><br>
                            <table width=100%>
                                <tr>
                                    <td width="10%" style="text-align:center">+62</td>
                                    <td><input type="text" class="form-control" id="Phone" name="Phone"  placeholder="Phone"></td>
                                <tr>
                            </table>
            </div>
          
					  <div class="form-group mb-3 input-group-sm">
                        <label for="email"><b>Email :</b></label>
                        <input type="text" class="form-control" placeholder="Enter Email" id="Email" name="Email">
            </div>

            <div class="form-group mb-3 input-group-sm">
                        <label for="NIM"><b>NIM :</b></label>
                        <input type="text" class="form-control" placeholder="Enter NIM" id="NIM" name="NIM">
            </div>


            <div class="form-group">
                <label for="program_studi"><b>Program Studi</b></label>
                <select class="form-control" id="program_studi" name="program_studi">
                    <option value="1">Mobile Technology</option>
                    <option value="2">Media Internet Technology</option>
                    </select>
            </div>
            <button type="submit" class="btn btn-primary btn-sm" id="Tombol" name="Tombol">Submit</button> 
            <button href="form.php" class="btn btn-danger btn-sm">Cancel</button>
          </form>	
                <br>
        </div>
        <!-- END PAGE OF PERSONAL DATA FORM -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>