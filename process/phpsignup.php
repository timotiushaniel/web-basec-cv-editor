<?php
if (isset($_POST['btn-registrasi'])) {

    require '../dbh.php';

    $Email = $_POST['Email'];
    $Degree = $_POST['Degree'];
    $Password = $_POST['Password'];
    $ConPass = $_POST['konPass'];
    $Recovery = $_POST['Recovery'];

    if (empty($Email) && empty($Degree) && empty($Password) && empty($ConPass) && empty($Recovery)) {
        header("Location: ../signup.php?error=emptyfields&Email=".$Email."&Recovery=".$Recovery);
        exit();
    }

    elseif (empty($Email)) {
        header("Location: ../signup.php?error=emptyfieldsEmail"."&Role=".$Degree."&Recovery=".$Recovery);
        exit();
    }

    elseif (empty($Degree)) {
        header("Location: ../signup.php?error=emptyfieldsRole"."&Email=".$Email."&Recovery=".$Recovery);
        exit();
    }

    elseif (empty($Recovery)) {
        header("Location: ../signup.php?error=emptyfieldsRecovery-question"."&Email=".$Email."&Role=".$Degree);
        exit();
    }

    elseif (empty($Password)) {
        header("Location: ../signup.php?error=emptyfieldsPassword"."&Email=".$Email."&Role=".$Degree."&Recovery=".$Recovery);
        exit();
    }

    elseif (empty($ConPass)) {
        header("Location: ../signup.php?error=emptyfieldsConfirm-password"."&Email=".$Email."&Role=".$Degree."&Recovery=".$Recovery);
        exit();
    }

    elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidEmail&Role=".$Degree."&Recovery=".$Recovery);
        exit();
    }

    elseif (strlen($Password) < 8) {
        header("Location: ../signup.php?error=PasswordToShort&Email=".$Email."&Role=".$Degree."&Recovery=".$Recovery);
        exit();
    }


    elseif ($Password !== $ConPass) {
        header("Location: ../signup.php?error=Passwordcheck&Email=".$Email."&Role=".$Degree."&Recovery=".$Recovery);
        exit();
    }

    else {
        $sql = "SELECT Email FROM users WHERE Email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $Email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck = mysqli_stmt_num_rows($stmt);
            if ($resultcheck > 0) {
                header("Location: ../signup.php?error=Emailtaken&Role=".$Degree."&Recovery=".$Recovery);
                exit();
            }
            else {
                $sql = "INSERT INTO users (email, password, role, recovery_question	) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }
                else {
                    $hasedpwd = password_hash($Password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "ssss", $Email, $hasedpwd, $Degree, $Recovery);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../signin.php?signup=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
    header("Location: ../signup.php");
    exit();
}