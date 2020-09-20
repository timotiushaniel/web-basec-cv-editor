<?php
session_start();

if (isset($_POST['cisco_submit'])) {

    require 'dbh.php';
    $CurrentEmail = $_SESSION['Email'];
    $UserId = $_SESSION['us_id'];
    $Cisco_Networking = $_POST['Cisco_Networking'];
    $Box1 = $_POST['Box1'];
    $Box2 = $_POST['Box2'];


    if (
        empty($Cisco_Networking) && empty($Box1) && empty($Box2)
    ) {
        header("Location: ./form.php?error=emptyfields&Email=" . $CurrentEmail);
        exit();
    } elseif (empty($Cisco_Networking)) {
        header("Location: ./form.php?error=emptyfieldsCisco_Networking" . "&Cisco_Networking=" . $Cisco_Networking . "&Box1=" . $Box1 . "&Box2=" . $Box2);
        exit();
    } elseif (empty($Box1)) {
        header("Location: ./form.php?error=emptyfieldsBox1" . "&Cisco_Networking=" . $Cisco_Networking . "&Box1=" . $Box1 . "&Box2=" . $Box2);
        exit();
    } elseif (empty($Box2)) {
        header("Location: ./form.php?error=emptyfieldsBox1e" . "&Cisco_Networking=" . $Cisco_Networking . "&Box1=" . $Box1 . "&Box2=" . $Box2);
        exit();
    } else {
        $sql = "SELECT us_id FROM users WHERE email = ? ";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ./form.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $CurrentEmail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            session_start();
            $_SESSION['us_id'] = $row['us_id'];
            $UserId = $_SESSION['us_id'];

            $sql = "INSERT INTO certification (ce_id, pd_id, nama, tanggal) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ./form.php?error=sqlerror2");
                exit();
            } else {
                $ps_id = 2;
                $nim = 1418001;

                mysqli_stmt_bind_param($stmt, "iiisssssiss", $UserId, $ps_id, $Cisco_Networking, $Box1, $Box2);
                mysqli_stmt_execute($stmt);
                header("Location: ./form.php?certification=success" . "&UserId=" . $UserId);
                exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ./form.php");
    exit();
}
