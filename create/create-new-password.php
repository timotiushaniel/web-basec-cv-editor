<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../assets/css/StyleLogin.css">
    <title>CREATE NEW PASSWORD</title>
  </head>

  <?php
    $Email = isset($_GET["Email"]) ? $_GET["Email"] : "";
  ?>

  <body>
   <div class="container">
    <h4 class="text-center">CREATE NEW PASSWORD</h4>
    <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                echo '<p style="color:red" align="center">Please enter the new password!</p>';
            }

            else if ($_GET['error'] == "passworddontmatch") {
              echo "<p style='color:red' align='center'>Password don't match!</p>";
            }
        }

        $selector = $_GET["selector"];
        $validator = $_GET["validator"];
        if (empty($selector) || empty($validator)) {
            header("Location: ../form/forgot-password.php?error=expired");
            echo "Could not validate your request, please request again!";
            exit();
        } else {
            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
        
        ?>
		<hr>
		<form action="../process/reset-password.php" method="POST">
            <div class="form-group">
                <label for="konPass">Password</label>
                <input type="hidden" name="selector" value="<?php echo $selector ?>">
                <input type="hidden" name="validator" value="<?php echo $validator ?>">
                <input type="password" name="newpass" class="form-control" placeholder="Enter New Password" id="newpass"><br>
                <input type="password" name="konnewpass" class="form-control" placeholder="Confirm New Password" id="konnewpass">
                <?php
                    if (isset($_GET['error']) == "PasswordToShort") {
                      echo "<small style='color:red'>Password must be at least 8 characters.</small>";
                    }
                    ?>
                
            </div>
                <button type="submit" name="submitnewpass" class="btn btn-primary">RESET PASSWORD</button>
        </form>
        <?php
            }
        }
        ?>
	</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>