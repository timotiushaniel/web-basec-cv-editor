<!doctype html>
<html lang="en">
    <?php
        //EMPLOYMENT OBJECTIVE//
        $EmploymentObjectve = isset($_GET["EmploymentObjective"]) ? $_GET["EmploymentObjective"] : "";
        //END EMPLOYMENT OBJECTIVE//
    ?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="StyleForm.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
    <title>Curiculum Vitae</title>
	
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                    <form action="phpform_eo.php" method="POST">
                        <h2 class="alert alert-primary text-center mt-3">Employment Objective</h2>
                        <hr>
                        <?php
                        if (isset($_GET['error'])) {
                            if ($_GET['error'] == "emptyfieldsEmploymentObjective") {
                                echo '<p style="color:red" align="center">Fill in Employment Objective!</p>';
                            }
                        }
                        ?>
                        <textarea class="form-control" rows="5" id="EmploymentObjective" name="EmploymentObjective" placeholder="Employment objective"></textarea><br>
                        <button type="submit" class="btn btn-primary" id="Eo_submit" name="Eo_submit">Submit</button>
                        <button href="form.php" class="btn btn-danger">Cancel</button>
                    </form>
                </div>
            </div>        
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>