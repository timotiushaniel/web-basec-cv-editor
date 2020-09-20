<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="StyleRegist.css">
    <title>REGISTER PAGE </title>
</head>

<?php
$Email = isset($_GET["Email"]) ? $_GET["Email"] : "";
$Degree = isset($_GET["Degree"]) ? $_GET["Degree"] : "";
$Recovery = isset($_GET["Recovery"]) ? $_GET["Recovery"] : "";
$Password = "";
$ConPass = "";

?>

<main>
    <div class="container">
        <h3 class="alert alert-primary text-center mt-3">FORM REGISTER</h3>

        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfieldsEmail") {
                echo '<p style="color:red" align="center">Fill in the email!</p>';
            }

            else if ($_GET['error'] == "emptyfieldsRole") {
                echo '<p style="color:red" align="center">Fill in the Role!</p>';
            }

            else if ($_GET['error'] == "emptyfieldsRecovery-question") {
                echo '<p style="color:red" align="center">Fill in the Recovery question!</p>';
            }

            else if ($_GET['error'] == "emptyfieldsPassword") {
                echo '<p style="color:red" align="center">Fill in the password!</p>';
            }

            else if ($_GET['error'] == "emptyfieldsConfirm-password") {
                echo '<p style="color:red" align="center">Fill in the Confirm password!</p>';
            }

            else if ($_GET['error'] == "invalidEmail") {
                echo '<p style="color:red" align="center">invalid email!</p>';
            }

            else if ($_GET['error'] == "PasswordToShort") {
                echo '<p style="color:red" align="center">Please enter the password at least 6 characters!</p>';
            }

            else if ($_GET['error'] == "Passwordcheck") {
                echo "<p style='color:red' align='center'>Password don't match!</p>";
            }
        }
        
        ?>

        <form action="process/phpsignup.php" method="POST">
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="text" name="Email" class="form-control" placeholder="Enter Your Email" id="Email" value="<?=$Email;?>">
            </div>
            <div class="form-group">
                <label for="Role">Role</label>
                <select class="form-control" id="Degree" name="Degree" value="<?=$Degree;?>">
                    <option value="1" <?php if (isset($_GET['Role']) == 1) {echo "selected";}?> >Mahasiswa</option>
                    <option value="2" <?php if (isset($_GET['Role']) == 2) {echo "selected";}?> >Dosen</option>
                    </select>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" name="Password" class="form-control" placeholder="Enter Your Password" id="Password">
                        <small>Password must be at least 8 characters.</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="konPass">Confirm Password</label>
                        <input type="password" name="konPass" class="form-control" placeholder="Confirm Your Password" id="konPass">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="Recovery Question">Recovery Question </label>
                <input type="text" name="Recovery" class="form-control" placeholder="Enter Your Recovery Question" id="recovery_question" value="<?=$Recovery;?>">
            </div>

            <button type="submit" name="btn-registrasi" class="btn-primary">REGISTER</button>
        </form>
</main>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</html>

