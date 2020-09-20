<?php
if (isset($_POST['btn-submit'])) {
    require '../dbh.php';

    $Email = $_POST['Email'];
    $Password = $_POST['konPass'];

    if (empty($Email) || empty($Password)) {
        header("Location: ../signin.php?error=emptyfields");
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE Email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signin.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $Email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($Password, $row['password']);                
                if ($pwdCheck == FALSE) {
                    header("Location: ../signin.php?error=WrongPassword&Email=".$Email);
                    exit();
                }
                else if ($pwdCheck == TRUE) {
                    session_start();
                    $_SESSION['Email'] = $row['email'];
                    $UserEmail = $_SESSION['Email'];
                    $_SESSION['last_login_time'] = time();
                    $_SESSION['user_id'] = $row['us_id'];
                    $us_id_ses = $_SESSION['user_id'];

                    $pd_query = "SELECT * FROM personal_detail WHERE us_id=$us_id_ses";
                    if($pd_query_result = mysqli_query($conn, $pd_query)){
                        if(mysqli_num_rows($pd_query_result) > 0){
                            $pd_id_row = mysqli_fetch_array($pd_query_result);
                            session_start();
                            $_SESSION['pd_id'] = $pd_id_row['pd_id'];
                            $pd_id_ses = $_SESSION['pd_id'];

                            header("Location: ../form/personaldata.php?login=success&Hi=".$UserEmail."&pd_id=".$pd_id_ses);
                            exit();
                        }
                        else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                            $_SESSION['pd_id'] = 0;
                            $pd_id_ses = $_SESSION['pd_id'];
                            header("Location: ../form/personaldata.php?login=success&Hi=".$UserEmail."&pd_id=".$pd_id_ses);
                            exit();
                        }
                    }
                    else{
                        echo "ERROR: Could not able to execute $pd_query. " . mysqli_error($conn);
                    }
                }
                else {
                    header("Location: ../signin.php?error=WrongPassword&Email=".$Email);
                    exit();
                }
            }else {
                header("Location: ../signin.php?error=UserNotFound");
                exit();
            }

        }
    }
}

else {
    header("Location: ../signin.php");
    exit();
}