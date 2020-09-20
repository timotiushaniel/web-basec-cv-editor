<?php

if (isset($_POST["reset_submit"])) {
    $userEmail = $_POST["email"];
    if (empty($userEmail)) {
        header("Location: ../form/forgot-password.php?error=emptyfields");
        exit();
    }

    else {
        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);
        $url = "http://localhost/proyek-cv/proyek-cv/create/create-new-password.php?selector=" . $selector . "&validator=" .bin2hex($token);
        $expires = date("U") + 1800;

        require '../dbh.php';
        
        $sql = "DELETE FROM pwdReset WHERE pwdResetEmail = ?;";
        $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../form/forgot-password.php?error=sqlerror1");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $userEmail);
                mysqli_stmt_execute($stmt);
            }
        
        $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../form/forgot-password.php?error=sqlerror2");
            exit();
        } else {
            $hashedToken = password_hash($token, PASSWORD_DEFAULT) ;
            mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        require_once('PHPMailer/PHPMailerAutoload.php');
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '465';
        $mail->isHTML();
        $mail->Username = 'cvgeneratorITHB@gmail.com';
        $mail->Password = 'projectcv1' ;
        $mail->setFrom("no-reply@test.org", "No-Reply");
        $mail->Subject = 'Reset Password';
        $mail->Body = '
        <p>We recieved a password reset request.</p>
        <p>The link to reset your password is below. If you did not make this request, you can ignore this email</p>
        <p>Here is your password reset link: </br>
        <a href="' . $url . '">' . $url . '</a></p>
        ';
        $mail->AddAddress("$userEmail");
        if ($mail->send()){
            header("Location: ../form/forgot-password.php?request=success");
        } else {
            header("Location: ../form/forgot-password.php?request=failed");
        }
    }
    
 } else {
    header("Location: ../signin.php");
 }