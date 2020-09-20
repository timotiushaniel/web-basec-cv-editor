<?php
session_start();

if (isset($_POST['Tombol'])) {

    require 'dbh.php';
    $CurrentEmail = $_SESSION['Email'];
    $FullName = $_POST['FullName'];
    $Address = $_POST['Address'];
    $City = $_POST['City'];
    $Province = $_POST['Province'];
    $Country = $_POST['Country'];
    $ZipCode = $_POST['ZipCode'];
    $Phone = $_POST['Phone'];
    $Email = $_POST['Email'];
    $NIM = $_POST['NIM'];
    $program_studi = $_POST['program_studi'];
    
    if (empty($FullName) && empty($Address) && empty($City) && empty($Province) && 
    empty($Country) && empty($ZipCode) && empty($Phone) && empty($Email) && empty($Photo) && empty($NIM)) {
        header("Location: ./form.php?error=emptyfields&Email=".$CurrentEmail);
        exit();
    }

    elseif (empty($FullName)) {
        header("Location: ./form.php?error=emptyfieldsFullName"."&Email=".$Email."&LastName=".$LastName."&UserEmail=".$CurrentEmail);
        exit();
    }

    elseif (empty($Address)) {
        header("Location: ./form.php?error=emptyfieldsAddress"."&Email=".$Email."&FirstName=".$FirstName."&UserEmail=".$CurrentEmail);
        exit();
    }

    elseif (empty($City)) {
        header("Location: ./form.php?error=emptyfieldsCity"."&Email=".$Email."&Role=".$Degree."&UserEmail=".$CurrentEmail);
        exit();
    }

    elseif (empty($Province)) {
        header("Location: ./form.php?error=emptyfieldsProvince"."&Email=".$Email."&Role=".$Degree."&UserEmail=".$CurrentEmail);
        exit();
    }

    elseif (empty($Country)) {
        header("Location: ./form.php?error=emptyfieldsCountry"."&Email=".$Email."&Role=".$Degree."&UserEmail=".$CurrentEmail);
        exit();
    }

    elseif (empty($ZipCode)) {
        header("Location: ./form.php?error=emptyfieldsZipCode"."&Email=".$Email."&Role=".$Degree."&UserEmail=".$CurrentEmail);
        exit();
    }

    elseif (empty($Phone)) {
        header("Location: ./form.php?error=emptyfieldsPhone"."&Email=".$Email."&Role=".$Degree."&UserEmail=".$CurrentEmail);
        exit();
    }

    elseif (preg_match("/^[a-z] [Z-A]*$/", $Phone)) {
        header("Location: ./form.php?error=invalidPhone"."&Email=".$Email."&Role=".$Degree."&UserEmail=".$CurrentEmail);
        exit();
    }

    elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ./form.php?error=invalidEmail&Role=".$Degree."&Recovery=".$Recovery."&UserEmail=".$CurrentEmail);
        exit();
    }

    elseif (empty($NIM)) {
        header("Location: ./form.php?error=emptyfieldsNIM"."&Email=".$Email."&Role=".$Degree."&UserEmail=".$CurrentEmail);
        exit();
    }

    elseif (empty($program_studi)) {
        header("Location: ./form.php?error=emptyfieldsProgramStudi"."&Email=".$Email."&Role=".$Degree."&UserEmail=".$CurrentEmail);
        exit();
    }

    else {
        $sql = "SELECT us_id FROM users WHERE email = ? ";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ./form.php?error=sqlerror1");
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
            
            $sql = "INSERT INTO personal_detail (us_id, ps_id, no_induk, nama, alamat, kota, propinsi, kode_pos, no_telpon, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ./form.php?error=sqlerror2");
                exit();
            }
            else {
                $ps_id = $program_studi;

                mysqli_stmt_bind_param($stmt, "iiisssssis", $UserId, $ps_id, $NIM, $FullName, $Address, $City, $Province, $ZipCode, $Phone, $Email);
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

                        header("Location: ./form.php?personaldata=success"."&UserId=".$UserId."&pd_id=".$pd_id_ses);
                        exit();
                    }
                    else{
                        echo "<p class='lead'><em>No records were found.</em></p>";
                        $_SESSION['pd_id'] = 0;
                        $pd_id_ses = $_SESSION['pd_id'];
                        $_SESSION['ps_id'] = $pd_id_row_new['ps_id'];
                        $ps_id_ses = $_SESSION['ps_id'];
                        
                        header("Location: ./form.php?personaldata=success"."&UserId=".$UserId."&pd_id=".$pd_id_ses);
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
    header("Location: ./form.php");
    exit();
}