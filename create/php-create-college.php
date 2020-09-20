<!doctype html>
<html lang="en">
    <?php
    require "../form/session_time.php";
        //college//
            $college = isset($_GET["college"]) ? $_GET["college"] : "";
            $City_college = isset($_GET["City_college"]) ? $_GET["City_college"] : "";
            $graduate_degree = isset($_GET["graduate_degree"]) ? $_GET["graduate_degree"] : "";
            $concentration_of_expertise = isset($_GET["concentration_of_expertise"]) ? $_GET["concentration_of_expertise"] : "";
            $ipk = isset($_GET["ipk"]) ? $_GET["ipk"] : "";
            $graduate_ithb = isset($_GET["graduate_ithb"]) ? $_GET["graduate_ithb"] : "";
            $negara = isset($_GET["negara"]) ? $_GET["negara"] : "";
//end college//
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
      <div class="tab-pane" id="v-pills-college" role="tabpanel" aria-labelledby="v-pills-college-tab">
          <h2 class="alert alert-primary text-center mt-3">Education</h2>
          <hr>
          <?php
          if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfieldscollege") {
              echo '<p style="color:red" align="center">Fill in all!</p>';
            } // smw data di college //
            if ($_GET['error'] == "emptyfieldscollege") {
              echo '<p style="color:red" align="center">Fill in the college!</p>';
            } else if ($_GET['error'] == "emptyfieldsCity_college") {
              echo '<p style="color:red" align="center">Fill in City college!</p>';
            } else if ($_GET['error'] == "emptyfieldsgraduate_degree") {
              echo '<p style="color:red" align="center">Fill in the graduated degree!</p>';
            } else if ($_GET['error'] == "emptyfieldsconcentration_of_expertise") {
              echo '<p style="color:red" align="center">Fill in the concentration of expertise!</p>';
            } else if ($_GET['error'] == "emptyfieldsipk") {
              echo '<p style="color:red" align="center">Fill in the IPK!</p>';
            } else if ($_GET['error'] == "emptyfieldsnegara") {
              echo '<p style="color:red" align="center">Fill in the Negara!</p>';
            } else if ($_GET['error'] == "emptyfieldsdate") {
              echo '<p style="color:red" align="center">Fill in the Graduate Date!</p>';
            } else if ($_GET['error'] == "invalidipk") {
              echo '<p style="color:red" align="center">IPK must be between 0 and 4!</p>';
            } else {
              echo "<p style='color:green' align='center'>college are complete, please continue!</p>";
            }
          }

          ?>
          <form action="../process/phpcollege.php" method="POST">
            <div class="form-group mb-3 input-group-sm">
              <label for="college"><b>College Place:</b></label><br>
              <input type="text" class="form-control" id="college" name="college" placeholder="College Name" value="<?=$college;?>">
              <input type="text" class="form-control" id="City_college" name="City_college" placeholder="City" value="<?=$City_college;?>">
              <input type="text" class="form-control" id="negara" name="negara" placeholder="Country" value="<?=$negara;?>">
              <br>
              <label for="college"><b>Graduated Degree:</b></label>
              <input type="text" class="form-control" id="graduate_degree" name="graduate_degree" placeholder="Graduate degree" value="<?=$graduate_degree;?>">
              <br>
              <label for="college"><b>Concentration Of Expertise :</b></label>
              <input type="text" class="form-control" id="concentration_of_expertise" name="concentration_of_expertise" placeholder="Concentration of expertise" value="<?=$concentration_of_expertise;?>">
              <input type="number" step="0.01" min="0" max="4" class="form-control" id="ipk" name="ipk" placeholder="Indeks Prestasi Kumulatif" value="<?=$ipk;?>">
            </div>


            <div class="form-group mb-3 input-group-sm">
              <label for="graduate_ithb"><b>Graduate Date:</b></label><br>
              <input type="month" class="form-control" id="graduate_ithb" name="graduate_ithb">
            </div>

            <br>
            <button type="submit" class="btn btn-primary btn-sm" id="he_submit" name="college_submit">Submit</button>            
            <a href="../form/college.php" class="btn btn-danger btn-sm">Cancel</a>
          </form>
      </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>