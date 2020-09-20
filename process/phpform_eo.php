<?php
session_start();

if (isset($_POST['Eo_submit'])) {

    require '../dbh.php';
    $CurrentEmail = $_SESSION['Email'];
    $UserId = $_SESSION['user_id'];
    $EmploymentObjective = ucfirst($_POST['EmploymentObjective']);
    
    if (empty($EmploymentObjective)) {
        header("Location: ../form/php-create-employmentobjective.php?error=emptyfieldsEmploymentObjective"."&UserEmail=".$CurrentEmail."&UserId=".$UserId);
    }

    else {
        $sql = "SELECT pd_id FROM personal_detail WHERE us_id = ? ";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../form/php-create-employmentobjective.php?error=sqlerror1");
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
            
            $sql = "INSERT INTO employment_objective (pd_id, objective) VALUES (?, ?)";
            $stmt = mysqli_stmt_init($conn);
            
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../create/php-create-employmentobjective.php?error=sqlerror2");
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt, "is", $PersonalDetailID, $EmploymentObjective);
                mysqli_stmt_execute($stmt);
                header("Location: ../form/employment_objective.php?employmentobjective=success"."&UserId=".$UserId);
                exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
    header("Location: ../form/employment_objective.php");
    exit();
}