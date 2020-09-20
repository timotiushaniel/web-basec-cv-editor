<?php
// Include config file
require_once "dbh.php";
session_start();
$pd_id_ses = $_SESSION['pd_id'];
// Define variables and initialize with empty values
$nama =  $negara = $provinsi = $kota = "";
$nama_err =  $negara_err = $provinsi_err = $kota_err = "";

// Processing form data when form is submitted
if (isset($_POST["co_id"]) && !empty($_POST["co_id"])) {
    // Get hidden input value
    $pd_id = $_POST["co_id"];

    $input_nama = trim($_POST["name_highschool"]);
    if (empty($input_nama)) {
        $nama_err = "Please enter the High School name.";
    } else {
        $nama = $input_nama;
    }

    $input_negara = trim($_POST["state_highschool"]);
    if (empty($input_negara)) {
        $negara_err = "Please enter the State.";
    } else {
        $negara = $input_negara;
    }

    $input_kota = trim($_POST["city_highschool"]);
    if (empty($input_kota)) {
        $kota_err = "Please enter the City.";
    } else {
        $kota = $input_kota;
    }

    $input_provinsi = trim($_POST["country_highschool"]);
    if (empty($input_provinsi)) {
        $provinsi_err = "Please enter the Country.";
    } else {
        $provinsi = $input_provinsi;
    }

    $input_tanggal = trim($_POST["graduate_highschool"]);
    if (empty($input_tanggal)) {
        $tanggal_err = "Please enter the graduate date.";
    } else {
        $tanggal = $input_tanggal;
    }




    // Check input errors before inserting in database
    if (empty($nama_err) && empty($negara_err) && empty($kota_err) && empty($provinsi_err) && empty($tanggal_err)) {
        // Prepare an update statement // baru ampe sini
        $sql = "UPDATE compulsary SET co_id=?, pd_id=?, nama=?, negara=?, provinsi=?, kota=?, tanggal=? WHERE co_id=?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            $pd_id = $pd_id_ses;
            mysqli_stmt_bind_param($stmt, "isi", $pd_id, $co_id, $nama, $negara, $provinsi, $kota, $tanggal);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records updated successfully. Redirect to landing page
                header("location: form.php");
                exit();
            } else {
                echo "Something went wrong. Please try again.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($conn);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["co_id"]) && !empty(trim($_GET["co_id"]))) {
        // Get URL parameter
        $pd_id =  trim($_GET["co_id"]);
        ///////////////////////////////////////////////////////////////////////////////bingung///////
        // Prepare a select statement
        $sql = "SELECT * FROM compulsary WHERE co_id = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $co_id);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $nama = $row["nama"];
                    $state_highschool = $row["state_highschool"];
                    $city_highschool = $row["city_highschool"];
                    $country_highschool = $row["country_highschool"];
                    $graduate_highschool = $row["graduate_highschool"];
                    $program_studi_id = $row["pd_id"];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($conn);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: sss.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update High School Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nama_err)) ? 'has-error' : ''; ?>">
                            <label>Nama</label>
                            <input type="text" name="name_highschool" class="form-control" value="<?php echo $name_highschool; ?>">
                            <span class="help-block"><?php echo $nama_err; ?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($state_highschoolt_err)) ? 'has-error' : ''; ?>">
                            <label>State</label>
                            <input type="text" name="State" class="form-control" value="<?php echo $state_highschool; ?>">
                            <span class="help-block"><?php echo $state_highschoolt_err; ?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($city_highschool_err)) ? 'has-error' : ''; ?>">
                            <label>City</label>
                            <input type="text" name="City" class="form-control" value="<?php echo $city_highschool; ?>">
                            <span class="help-block"><?php echo $city_highschool_err; ?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($country_highschool_err)) ? 'has-error' : ''; ?>">
                            <label>Provinsi</label>
                            <input type="text" name="Province" class="form-control" value="<?php echo $country_highschool; ?>">
                            <span class="help-block"><?php echo $country_highschool_err; ?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($graduate_highschool_err)) ? 'has-error' : ''; ?>">
                            <label>Tanggal</label>
                            <input type="date" name="Tanggal" class="form-control" value="<?php echo $graduate_highschool; ?>">
                            <span class="help-block"><?php echo $graduate_highschool_err; ?></span>
                        </div>


                        <input type="hidden" name="pd_id" value="<?php echo $pd_id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="form.php" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>