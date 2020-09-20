<?php

if (isset($_POST['high_school_submit'])) {

    session_start();
    $us_id_ses = $_SESSION['user_id'];
    $pd_id_ses = $_SESSION['pd_id'];
    require '../dbh.php';
    $CurrentEmail = $_SESSION['Email'];
    $UserId = $us_id_ses;
    $name_highschool = ucfirst($_POST['name_highschool']);
    $province_highschool = ucfirst($_POST['province_highschool']);
    $city_highschool = ucfirst($_POST['city_highschool']);
    $country_highschool = ucfirst($_POST['country_highschool']);
    $graduate_highschool = $_POST['graduate_highschool'];


    if (
        empty($province_highschool) && empty($city_highschool) && empty($country_highschool) && empty($graduate_highschool)
    ) {
        header("Location: ./form.php?error=emptyfields&Email=" . $CurrentEmail);
        exit();
    } elseif (empty($name_highschool)) {
        header("Location: ./form.php?error=emptyfieldsname_highschool" . "&name_highschool=" . $name_highschool . "&province_highschoole=" . $province_highschool . "&city_highschool=" . $city_highschool . "&country_highschool=" . $country_highschool . "&graduate_highschool=" . $graduate_highschool);
        exit();
    } elseif (empty($province_highschool)) {
        header("Location: ./form.php?error=emptyfieldsprovince_highschoole" . "&name_highschool=" . $name_highschool . "&province_highschoole=" . $province_highschool . "&city_highschool=" . $city_highschool . "&country_highschool=" . $country_highschool . "&graduate_highschool=" . $graduate_highschool);
        exit();
    } elseif (empty($city_highschool)) {
        header("Location: ./form.php?error=emptyfieldscity_highschool" . "&name_highschool=" . $name_highschool . "&province_highschool=" . $province_highschool . "&city_highschool=" . $city_highschool . "&country_highschool=" . $country_highschool . "&graduate_highschool=" . $graduate_highschool);
        exit();
    } elseif (empty($country_highschool)) {
        header("Location: ./form.php?error=emptyfieldscountry_highschool" . "&name_highschool=" . $name_highschool . "&province_highschoole=" . $province_highschool . "&city_highschool=" . $city_highschool . "&country_highschool=" . $country_highschool . "&graduate_highschool=" . $graduate_highschoolb);
        exit();
    } elseif (empty($graduate_highschool)) {
        header("Location: ./form.php?error=emptyfieldsgraduate_highschool" . "&name_highschool=" . $name_highschool .  "&province_highschoole=" . $province_highschool . "&city_highschool=" . $city_highschool . "&country_highschool=" . $country_highschool . "&graduate_highschool=" . $graduate_highschool);
        exit();
    } else {
        $sql = "SELECT pd_id FROM personal_detail WHERE us_id = ? ";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../create/php-create-high-school.php?error=sqlerror1");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "i", $UserId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            session_start();
            $_SESSION['pd_id'] = $row['pd_id'];
            $PersonalDetailID = $_SESSION['pd_id'];
            $sql = "INSERT INTO compulsary (pd_id, nama, negara, provinsi, kota, tanggal) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../create/php-create-high-school.php?error=sqlerror2");
                exit();
            } else {
                $pd_id = $PersonalDetailID;
                mysqli_stmt_bind_param($stmt, "isssss", $pd_id, $name_highschool, $country_highschool, $province_highschool, $city_highschool, $graduate_highschool);
                mysqli_stmt_execute($stmt);
                header("Location: ../form/high_school.php?compulsary=success" . "&PersonalId=" . $pd_id  . "&UserID" . $us_id_ses);
                exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ../form/high_school.php");
    exit();
}
