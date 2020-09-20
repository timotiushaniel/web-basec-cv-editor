<!doctype html>
<html lang="en">
<?php
//compulsary//
$name_highchool = isset($_GET["name_highschool"]) ? $_GET["name_highschool"] : "";
$state_highschool = isset($_GET["state_highschool"]) ? $_GET["state_highschool"] : "";
$city_highschool = isset($_GET["city_highschool"]) ? $_GET["city_highschool"] : "";
$country_highschool = isset($_GET["country_highschool"]) ? $_GET["country_highschool"] : "";
$graduate_highschool = isset($_GET["graduate_highschool"]) ? $_GET["graduate_highschool"] : "";
//end compulsary//
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
        .col-12 {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <!-- START PAGE OF HIGH SCHOOL FORM -->
    <div class="col-12">
        <div class="tab-pane" id="v-pills-compulsary" role="tabpanel" aria-labelledby="v-pills-compulsary-tab">
            <h2 class="alert alert-primary text-center mt-3">Education</h2>
            <hr>
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "emptyfieldscompulsary") {
                    echo '<p style="color:red" align="center">Fill in all!</p>';
                } // smw data di college //
                if ($_GET['error'] == "emptyfieldsname_highchool") {
                    echo '<p style="color:red" align="center">Fill in the Name High School!</p>';
                } else if ($_GET['error'] == "emptyfieldsstate_highschool") {
                    echo '<p style="color:red" align="center">Fill in State High School!</p>';
                } else if ($_GET['error'] == "emptyfieldscity_highschool") {
                    echo '<p style="color:red" align="center">Fill in the city high school!</p>';
                } else if ($_GET['error'] == "emptyfieldscountry_highschool") {
                    echo '<p style="color:red" align="center">Fill in the country high school!</p>';
                } else {
                    echo "<p style='color:green' align='center'>high school are complete, please continue!</p>";
                }
            }

            ?>
            <form action="phphighschool.php" method="POST">
                <div class="form-group mb-3 input-group-sm">
                    <label for="college"><b>High School :</b></label>
                    <input type="text" class="form-control" id="name_highchool" name="name_highchool" placeholder="High School Name">
                    <input type="text" class="form-control" id="state_highschool" name="state_highschool" placeholder="State">
                    <input type="text" class="form-control" id="city_highschool" name="city_highschool" placeholder="City">
                    <input type="text" class="form-control" id="country_highschool" name="country_highschool" placeholder="Country">
                </div>


                <div class="form-group mb-3 input-group-sm">
                    <label for="graduate_ithb">Graduate Date:</label><br>
                    <input type="month" class="form-control" id="graduate_highschool" name="graduate_highschool">
                </div>

                <br>
                <button type="submit" class="btn btn-primary btn-sm" id="co_submit" name="high_school_submit">Submit</button><br><br>
                <button name="previous" class="btn btn-info btn-md" id="previous">Previous</button>
                <button name="next" class="btn btn-warning btn-md float-right" id="next">Next</button>
            </form>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>