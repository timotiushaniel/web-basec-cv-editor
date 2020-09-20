<?php
session_start();
if (isset($_POST['college_submit'])) {

    $us_id_ses = $_SESSION['user_id'];
    $ps_id_ses = $_SESSION['ps_id'];
    require '../dbh.php';
    $CurrentEmail = $_SESSION['Email'];
    $UserId = $us_id_ses;
    $college = ucfirst($_POST['college']);
    $City_college = ucfirst($_POST['City_college']);
    $graduate_degree = ucfirst($_POST['graduate_degree']);
    $concentration_of_expertise = ucfirst($_POST['concentration_of_expertise']);
    $ipk = $_POST['ipk'];
    $graduate_ithb = $_POST['graduate_ithb'];
    $negara = ucfirst($_POST['negara']);
    
    
    if (empty($college) && empty($City_college) && empty($graduate_degree) && empty($concentration_of_expertise) && empty($ipk) && 
    empty($graduate_ithb) && empty($negara)) {
        header("Location: ../create/php-create-college.php?error=emptyfields&Email=".$CurrentEmail);
        exit();
    }

    elseif (empty($college)) {
        header("Location: ../create/php-create-college.php?error=emptyfieldscollege"."&City_college=".$City_college."&graduate_degree=".$graduate_degree."&negara=".$negara."&concentration_of_expertise=".$concentration_of_expertise."&ipk=".$ipk."&graduate_ithb=".$graduate_ithb);
        exit();
    }

    elseif (empty($City_college)) {
        header("Location: ../create/php-create-college.php?error=emptyfieldsCity_college"."&college=".$college."&graduate_degree=".$graduate_degree."&negara=".$negara."&concentration_of_expertise=".$concentration_of_expertise."&ipk=".$ipk."&graduate_ithb=".$graduate_ithb);
        exit();
    }

    elseif (empty($negara)) {
        header("Location: ../create/php-create-college.php?error=emptyfieldsnegara"."&City_college=".$City_college."&graduate_degree=".$graduate_degree."&concentration_of_expertise=".$concentration_of_expertise."&ipk=".$ipk."&college=".$college);
        exit();
    }

    elseif (empty($graduate_degree)) {
        header("Location: ../create/php-create-college.php?error=emptyfieldsgraduate_degree"."&City_college=".$City_college."&college=".$college."&negara=".$negara."&concentration_of_expertise=".$concentration_of_expertise."&ipk=".$ipk."&graduate_ithb=".$graduate_ithb);
        exit();
    }

    elseif (empty($concentration_of_expertise)) {
        header("Location: ../create/php-create-college.php?error=emptyfieldsconcentration_of_expertise"."&City_college=".$City_college."&graduate_degree=".$graduate_degree."&negara=".$negara."&college=".$college."&ipk=".$ipk."&graduate_ithb=".$graduate_ithb);
        exit();
    }

    elseif (empty($ipk)) {
        header("Location: ../create/php-create-college.php?error=emptyfieldsipk"."&City_college=".$City_college."&graduate_degree=".$graduate_degree."&negara=".$negara."&concentration_of_expertise=".$concentration_of_expertise."&college=".$college."&graduate_ithb=".$graduate_ithb);
        exit();
    }

    elseif (($ipk < "0") and ($ipk > "4")) {//belum jalan
        header("Location: ../create/php-create-college.php?error=invalidipk"."&City_college=".$City_college."&graduate_degree=".$graduate_degree."&negara=".$negara."&concentration_of_expertise=".$concentration_of_expertise."&college=".$college."&graduate_ithb=".$graduate_ithb);
        exit();
    }

    elseif (empty($graduate_ithb)) {
        header("Location: ../create/php-create-college.php?error=emptyfieldsdate"."&City_college=".$City_college."&graduate_degree=".$graduate_degree."&negara=".$negara."&concentration_of_expertise=".$concentration_of_expertise."&ipk=".$ipk."&college=".$college);
        exit();
    }

    else {
        $sql = "SELECT pd_id, ps_id FROM personal_detail WHERE us_id = ? ";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../form/php-create-college.php?error=sqlerror1");
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
            $_SESSION['ps_id'] = $row['ps_id'];
            $ps_id_row = $_SESSION['ps_id'];
            $sql = "INSERT INTO higher_education (pd_id, nama, kota, jurusan, concentration, gelar, ipk, tanggal, negara) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../form/php-create-college.php?error=sqlerror2");
                exit();
            }
            else {
                $ps_id_session = $ps_id_ses ;
                mysqli_stmt_bind_param($stmt, "ississdss", $PersonalDetailID, $college, $City_college, $ps_id_row, $concentration_of_expertise, $graduate_degree, $ipk, $graduate_ithb, $negara);
                mysqli_stmt_execute($stmt);
                header("Location: ../form/college.php?college=success"."&PersonalId=".$PersonalDetailID."&Ps_id=".$ps_id_row."&UserID".$us_id_ses);
                exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
    header("Location: ../form/college.php");
    exit();
}