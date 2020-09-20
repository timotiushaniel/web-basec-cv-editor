<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../assets/css/StyleLogin.css">
    <title>RESET PASSWORD PAGE</title>
  </head>

  <body>
    <div class="container">
        <h4 class="text-center">Reset your password</h4>
        <?php
            if (isset($_GET['request'])) {
                if ($_GET['request'] == "success") {
                    echo '<p style="color:green" align="center">Check your E-mail!</p>';
                }
              }
            if (isset($_GET['error'])) {
              if ($_GET['error'] == "emptyfields") {
                  echo '<p style="color:red" align="center">Please enter the E-mail!</p>';
              }

              elseif ($_GET['error'] == "expired") {
                echo '<p style="color:red" align="center">Could not validate your request, please request again!</p>';
               } 
            }?>
            <hr>
            <form action="../process/reset-request.php" method="POST">
                <div class="form-group">
                    <label for="user_id">Email </label>
                    <input type="email" name="email" class="form-control" placeholder="Enter Your Email" id="email">
                </div>
                <button type="submit" name="reset_submit" class="btn btn-primary ">Request</button>
            </form>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html