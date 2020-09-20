<?php
session_start();

if (isset($_POST['Tombol'])) {

    require '../dbh.php';
    $CurrentEmail = $_SESSION['Email'];
    $FullName = ucfirst($_POST['FullName']);
    $Address = ucfirst($_POST['Address']);
    $City = ucfirst($_POST['City']);
    $Province = $_POST['Province'];
    $Country = $_POST['Country'];
    $ZipCode = $_POST['ZipCode'];
    $Phone = $_POST['Phone'];
    $Email = $_POST['Email'];
    $NIM = $_POST['NIM'];
    $program_studi = $_POST['program_studi'];
    
    if (empty($FullName) && empty($Address) && empty($City) && empty($Province) && 
    empty($Country) && empty($ZipCode) && empty($Phone) && empty($Email) && empty($Photo) && empty($NIM)) {
        header("Location: ../create/php-create-personaldetail.php?error=emptyfields"."&Email=".$Email."&FullName=".$FullName."&Address=".$Address."&City=".$City.
        "&Province=".$Province."&Country=".$Country."&ZipCode=".$ZipCode."&Phone=".$Phone."&NIM=".$NIM."&program_studi=".$program_studi."&UserEmail=".$CurrentEmail);
    }

    elseif (empty($FullName)) {
        header("Location: ../create/php-create-personaldetail.php?error=emptyfieldsFullName"."&Email=".$Email."&Address=".$Address."&City=".$City.
        "&Province=".$Province."&Country=".$Country."&ZipCode=".$ZipCode."&Phone=".$Phone."&NIM=".$NIM."&program_studi=".$program_studi."&UserEmail=".$CurrentEmail);
        exit();
    }

    elseif (empty($Address)) {
        header("Location: ../create/php-create-personaldetail.php?error=emptyfieldsAddress"."&Email=".$Email."&FullName=".$FullName."&City=".$City.
        "&Province=".$Province."&Country=".$Country."&ZipCode=".$ZipCode."&Phone=".$Phone."&NIM=".$NIM."&program_studi=".$program_studi."&UserEmail=".$CurrentEmail);
        exit();
    }

    elseif (empty($City)) {
        header("Location: ../create/php-create-personaldetail.php?error=emptyfieldsCity"."&Email=".$Email."&FullName=".$FullName."&Address=".$Address.
        "&Province=".$Province."&Country=".$Country."&ZipCode=".$ZipCode."&Phone=".$Phone."&NIM=".$NIM."&program_studi=".$program_studi."&UserEmail=".$CurrentEmail);
        exit();
    }

    elseif (empty($Province)) {
        header("Location: ../create/php-create-personaldetail.php?error=emptyfieldsProvince"."&Email=".$Email."&FullName=".$FullName."&Address=".$Address."&City=".$City.
        "&Country=".$Country."&ZipCode=".$ZipCode."&Phone=".$Phone."&NIM=".$NIM."&program_studi=".$program_studi."&UserEmail=".$CurrentEmail);
        exit();
    }

    elseif (empty($Country)) {
        header("Location: ../create/php-create-personaldetail.php?error=emptyfieldsCountry"."&Email=".$Email."&FullName=".$FullName."&Address=".$Address."&City=".$City.
        "&Province=".$Province."&ZipCode=".$ZipCode."&Phone=".$Phone."&NIM=".$NIM."&program_studi=".$program_studi."&UserEmail=".$CurrentEmail);
        exit();
    }

    elseif (empty($ZipCode)) {
        header("Location: ../create/php-create-personaldetail.php?error=emptyfieldsZipCode"."&Email=".$Email."&FullName=".$FullName."&Address=".$Address."&City=".$City.
        "&Province=".$Province."&Country=".$Country."&Phone=".$Phone."&NIM=".$NIM."&program_studi=".$program_studi."&UserEmail=".$CurrentEmail);
        exit();
    }

    elseif (empty($Phone)) {
        header("Location: ../create/php-create-personaldetail.php?error=emptyfieldsPhone"."&Email=".$Email."&FullName=".$FullName."&Address=".$Address."&City=".$City.
        "&Province=".$Province."&Country=".$Country."&ZipCode=".$ZipCode."&NIM=".$NIM."&program_studi=".$program_studi."&UserEmail=".$CurrentEmail);
        exit();
    }

    elseif (preg_match("/^[a-z] [Z-A]*$/", $Phone)) {
        header("Location: ../create/php-create-personaldetail.php?error=invalidPhone"."&Email=".$Email."&Role=".$Degree."&UserEmail=".$CurrentEmail);
        exit();
    }

    elseif (empty($Email)) {
        header("Location: ../create/php-create-personaldetail.php?error=emptyfieldsEmail"."&FullName=".$FullName."&Address=".$Address."&City=".$City.
        "&Province=".$Province."&Country=".$Country."&ZipCode=".$ZipCode."&Phone=".$Phone."&NIM=".$NIM."&program_studi=".$program_studi."&UserEmail=".$CurrentEmail);
    }

    elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../create/php-create-personaldetail.php?error=invalidEmail&Role=".$Degree."&Recovery=".$Recovery."&UserEmail=".$CurrentEmail);
        exit();
    }

    elseif (empty($NIM)) {
        header("Location: ../create/php-create-personaldetail.php?error=emptyfieldsNIM"."&Email=".$Email."&FullName=".$FullName."&Address=".$Address."&City=".$City.
        "&Province=".$Province."&Country=".$Country."&ZipCode=".$ZipCode."&Phone=".$Phone."&program_studi=".$program_studi."&UserEmail=".$CurrentEmail);
        exit();
    }

    elseif (empty($program_studi)) {
        header("Location: ../create/php-create-personaldetail.php?error=emptyfieldsProgramStudi"."&Email=".$Email."&FullName=".$FullName."&Address=".$Address."&City=".$City.
        "&Province=".$Province."&Country=".$Country."&ZipCode=".$ZipCode."&Phone=".$Phone."&NIM=".$NIM."&UserEmail=".$CurrentEmail);
        exit();
    }

    else {
        $sql = "SELECT us_id FROM users WHERE email = ? ";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../create/php-create-personaldetail.php?error=sqlerror1");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $CurrentEmail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            session_start();
            $_SESSION['us_id'] = $row['us_id'];
            $UserId = $_SESSION['us_id'];
            
            $sql = "INSERT INTO personal_detail (us_id, ps_id, no_induk, nama, alamat, kota, propinsi, negara, kode_pos, no_telpon, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../create/php-create-personaldetail.php?error=sqlerror2");
                exit();
            }
            else {
                $ps_id = $program_studi;

                mysqli_stmt_bind_param($stmt, "iiissssssis", $UserId, $ps_id, $NIM, $FullName, $Address, $City, $Province, $Country, $ZipCode, $Phone, $Email);
                mysqli_stmt_execute($stmt);

                $pd_query = "SELECT * FROM personal_detail WHERE us_id=$UserId";
                if($pd_query_result = mysqli_query($conn, $pd_query)){
                    if(mysqli_num_rows($pd_query_result) > 0){
                        $pd_id_row_new = mysqli_fetch_array($pd_query_result);
                        session_start();
                        $_SESSION['pd_id'] = $pd_id_row_new['pd_id'];
                        $pd_id_ses = $_SESSION['pd_id'];
                        $_SESSION['ps_id'] = $pd_id_row_new['ps_id'];
                        $ps_is_ses = $_SESSION['ps_id'];

                        header("Location: ../form/personaldata.php?personaldata=success"."&UserId=".$UserId."&pd_id=".$pd_id_ses);
                        exit();
                    }
                    else{
                        echo "<p class='lead'><em>No records were found.</em></p>";
                        $_SESSION['pd_id'] = 0;
                        $pd_id_ses = $_SESSION['pd_id'];
                        $_SESSION['ps_id'] = $pd_id_row_new['ps_id'];
                        $ps_id_ses = $_SESSION['ps_id'];
                        
                        header("Location: ../form/personaldata.php?personaldata=success"."&UserId=".$UserId."&pd_id=".$pd_id_ses);
                        exit();
                    }
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
    header("Location: ../form/personaldata.php");
    exit();
}