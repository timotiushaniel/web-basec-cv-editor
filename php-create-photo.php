<?php
session_start();
require_once "dbh.php";
$UserId = $_SESSION['user_id'];
$PersonalDataId = $_SESSION['pd_id'];

if (isset($_POST['upload'])) {
    $file = $_FILES['Foto'];
    $filename = $_FILES['Foto']['name'];
    $filetmpname = $_FILES['Foto']['tmp_name'];
    $filesize = $_FILES['Foto']['size'];
    $fileerror = $_FILES['Foto']['error'];
    $filetype = $_FILES['Foto']['type'];
    $fileext = explode('.', $filename);
    $fileactualext = strtolower(end($fileext));
    $allowed = array('png', 'jpg', 'jpeg');
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (in_array($fileactualext, $allowed)) {
            if ($fileerror === 0) {
                if ($filesize < 2000000) {
                    $filenamenew = "profile-user".$UserId.".".$fileactualext;
                    $filedestination = 'profile-picture/'.$filenamenew;
                    move_uploaded_file($filetmpname, $filedestination);
                    $sql = "INSERT INTO picture (us_id, picture) VALUES (?, ?)";

                    if($stmt = mysqli_prepare($conn, $sql)){
                        // Bind variables to the prepared statement as parameters
                        $us_id = $UserId;
                        mysqli_stmt_bind_param($stmt, "is", $us_id, $filenamenew);
                                
                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            // Records created successfully. Redirect to landing page
                            header("location: php-create-personaldetail.php");
                            exit();
                        } else{
                            echo "Something went wrong. Please try again.";
                        }    
                    }
                } else {
                    echo "Your file is to big!";
                }
            } else {
                echo "There was an error uploading your file!";
            }
        } else {
            echo "You cannot upload file of this type!";
        }      
        
    }
}
?>



<!doctype html>
<html lang="en">
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
      </style>
</head>

<body>
    <!-- START PAGE OF PERSONAL DATA FORM -->
    <div class="col-12">
    <h2 class="alert alert-primary text-center mt-3">Personal data</h2><hr>
        <div class="form-group">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <table width=100%>
                <tr>
                    <td><input type="file" class="form-control-file border" id="Foto" name="Foto" accept="image/*"></td>
                    <td width="10%" style="text-align:center"><button type="submit" class="btn btn-primary btn-sm" id="upload" name="upload">Upload</button> </td>
                <tr>
            </table>
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "emptyfieldsPhoto") {
                    echo "<p style='color:red' align='center'>Fill in the photo!</p>";
                  }
            }
            ?>            
            </form><br>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>