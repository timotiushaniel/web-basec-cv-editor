<?php
if (isset($_POST['submitnewpass'])) {

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["newpass"];
    $passwordrepeat = $_POST["konnewpass"];

    if (empty($password) || empty($passwordrepeat)) {
        header("Location: ../create/create-new-password.php?error=emptyfields&selector=" . $selector . "&validator=" .$validator);
        exit();
    }
    elseif ($password !== $passwordrepeat) {
        header("Location: ../create/create-new-password.php?error=passworddontmatch&selector=" . $selector . "&validator=" .$validator);
        exit();
    }

    elseif (strlen($password) < 8) {
        header("Location: ../create/create-new-password.php?error=PasswordToShort&selector=" . $selector . "&validator=" .$validator);
        exit();
    }

    $currentDate = date("U");
    require '../dbh.php';
    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result)) {
            echo "You need to re-submit your reset request.";
            exit();
        } else {
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row[ "pwdResetToken"]);
            if ($tokenCheck === false) {
                echo "You need to re-submit your reset request.";
                exit();
            } elseif ($tokenCheck === true) {
                $tokenEmail = $row[ 'pwdResetEmail'] ;
                $sql = "SELECT * FROM users WHERE email=?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "There was an error!";
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)) {
                        echo "There was an error.";
                        exit();
                    } else {
                        $sql = "UPDATE users SET password=? WHERE email=?";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "There was an error!";
                            exit();
                        } else {
                            $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                            mysqli_stmt_execute($stmt);

                            $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "There was an error!";
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../signin.php?newpwdpasswordupdated");
                            }
                        }
                    }
                }   
            }
        }
    }
} else {
    header("Location: ../form/forgot-password.php?error=emptytoken");
}