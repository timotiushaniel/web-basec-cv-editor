<?php
// Include config file
require_once "../dbh.php";
require "../form/session_time.php";
$pd_id_ses = $_SESSION['pd_id'];
// Define variables and initialize with empty values
$nama =  $negara = $provinsi = $kota = $tanggal = "";
$nama_err =  $negara_err = $provinsi_err = $kota_err = $tanggal_err = "";

// Processing form data when form is submitted
if (isset($_POST["co_id"]) && !empty($_POST["co_id"])) {
    // Get hidden input value
    $co_id = $_POST["co_id"];

    $input_nama = trim($_POST["name_highschool"]);
    if (empty($input_nama)) {
        $nama_err = "Please enter the High School name.";
    } else {
        $nama = ucfirst($input_nama);
    }

    $input_negara = trim($_POST["country_highschool"]);
    if (empty($input_negara)) {
        $negara_err = "Please enter the country name.";
    } else {
        $negara = ucfirst($input_negara);
    }

    $input_kota = trim($_POST["city_highschool"]);
    if (empty($input_kota)) {
        $kota_err = "Please enter the City name.";
    } else {
        $kota = ucfirst($input_kota);
    }

    $input_provinsi = trim($_POST["province_highschool"]);
    if (empty($input_provinsi)) {
        $provinsi_err = "Please enter the province name.";
    } else {
        $provinsi = ucfirst($input_provinsi);
    }

    $input_tanggal = trim($_POST["graduate_highschool"]);
    if (empty($input_tanggal)) {
        $tanggal_err = "Please enter the graduate date.";
    } else {
        $tanggal = $input_tanggal;
    }




    // Check input errors before inserting in database
    if (empty($nama_err) && empty($negara_err) && empty($kota_err) && empty($provinsi_err) && empty($tanggal_err)) {
        // Prepare an update provincement // baru ampe sini
        $sql = "UPDATE compulsary SET nama=?, negara=?, provinsi=?, kota=?, tanggal=? WHERE pd_id=?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared provincement as parameters
            $pd_id = $pd_id_ses;
            mysqli_stmt_bind_param($stmt, "sssssi", $nama, $negara, $provinsi, $kota, $tanggal, $pd_id);

            // Attempt to execute the prepared provincement
            if (mysqli_stmt_execute($stmt)) {
                // Records updated successfully. Redirect to landing page
                header("location: ../form/high_school.php");
                exit();
            } else {
                echo "Something went wrong. Please try again.";
            }
        }

        // Close provincement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($conn);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["co_id"]) && !empty(trim($_GET["co_id"]))) {
        // Get URL parameter
        $co_id =  trim($_GET["co_id"]);
        // Prepare a select provincement
        $sql = "SELECT * FROM compulsary WHERE co_id = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared provincement as parameters
            mysqli_stmt_bind_param($stmt, "i", $co_id);

            // Attempt to execute the prepared provincement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $nama = $row["nama"];
                    $province_highschool = $row["provinsi"];
                    $city_highschool = $row["kota"];
                    $country_highschool = $row["negara"];
                    $graduate_highschool = $row["tanggal"];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: ../error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again.";
            }
        }

        // Close provincement
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
                            <label>Senior High School</label>
                            <input type="text" name="name_highschool" class="form-control" value="<?php echo $nama; ?>">
                            <span class="help-block"><?php echo $nama_err; ?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($kota_err)) ? 'has-error' : ''; ?>">
                            <label>City</label>
                            <input type="text" name="city_highschool" class="form-control" value="<?php echo $city_highschool; ?>">
                            <span class="help-block"><?php echo $kota_err; ?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($provinsi_err)) ? 'has-error' : ''; ?>">
                            <label>Province</label>
                            <input type="text" name="province_highschool" class="form-control" value="<?php echo $province_highschool; ?>">
                            <span class="help-block"><?php echo $provinsi_err; ?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($negara_err)) ? 'has-error' : ''; ?>">
                            <label>Country</label>
                            <input type="text" name="country_highschool" class="form-control" value="<?php echo $country_highschool; ?>">
                            <span class="help-block"><?php echo $negara_err; ?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($tanggal_err)) ? 'has-error' : ''; ?>">
                            <label>Date</label>
                            <input type="month" name="graduate_highschool" class="form-control" value="<?php echo $graduate_highschool; ?>">
                            <span class="help-block"><?php echo $tanggal_err; ?></span>
                        </div>


                        <input type="hidden" name="co_id" value="<?php echo $co_id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../form/high_school.php" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>