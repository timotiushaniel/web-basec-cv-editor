<?php

if (isset($_POST['certiplus_submit'])) {

    session_start();

    require 'dbh.php';
    $CurrentEmail = $_SESSION['Email'];
    $Certiplus_Program_place = $_POST['Certiplus_Program_place'];
    $computer = $_POST['computer'];
    $communication = $_POST['communication'];
    $java_mobile = $_POST['java_mobile'];
    $leadership = $_POST['leadership'];
    $Entrepreneurship = $_POST['Entrepreneurship'];
    $Career_planning_skills = $_POST['Career_planning_skills'];
    $graduate_certiplus = $_POST['graduate_certiplus'];
    
    
    if (empty($Certiplus_Program_place) && empty($computer) && empty($communication) && empty($java_mobile) && empty($leadership) && 
    empty($Entrepreneurship) && empty($Career_planning_skills) && empty($graduate_certiplus)) {
        header("Location: ./form.php?error=emptyfields&Email=".$CurrentEmail);
        exit();
    }

    elseif (empty($Certiplus_Program_place)) {
        header("Location: ./form.php?error=emptyfieldsCertiplus_Program_place"."&computer=".$computer."&communication=".$communication."&java_mobile=".$java_mobile."&leadership=".$leadership."&Entrepreneurship=".$Entrepreneurship."&Career_planning_skills=".$Career_planning_skills."&graduate_certiplus=".$graduate_certiplus);
        exit();
    }

    elseif (empty($computer)) {
        header("Location: ./form.php?error=emptyfieldscomputer"."&Certiplus_Program_place=".$Certiplus_Program_place."&communication=".$communication."&java_mobile=".$java_mobile."&leadership=".$leadership."&Entrepreneurship=".$Entrepreneurship."&Career_planning_skills=".$Career_planning_skills."&graduate_certiplus=".$graduate_certiplus);
        exit();
    }

    elseif (empty($communication)) {
        header("Location: ./form.php?error=emptyfieldscommunication"."&computer=".$computer."&Certiplus_Program_place=".$Certiplus_Program_place."&java_mobile=".$java_mobile."&leadership=".$leadership."&Entrepreneurship=".$Entrepreneurship."&Career_planning_skills=".$Career_planning_skills."&graduate_certiplus=".$graduate_certiplus);
        exit();
    }

    elseif (empty($java_mobile)) {
        header("Location: ./form.php?error=emptyfieldsjava_mobile"."&computer=".$computer."&communication=".$communication."&Certiplus_Program_place=".$Certiplus_Program_place."&leadership=".$leadership."&Entrepreneurship=".$Entrepreneurship."&Career_planning_skills=".$Career_planning_skills."&graduate_certiplus=".$graduate_certiplus);
        exit();
    }

    elseif (empty($leadership)) {
        header("Location: ./form.php?error=emptyfieldsleadership"."&computer=".$computer."&communication=".$communication."&java_mobile=".$java_mobile."&Certiplus_Program_place=".$Certiplus_Program_place."&Entrepreneurship=".$Entrepreneurship."&Career_planning_skills=".$Career_planning_skills."&graduate_certiplus=".$graduate_certiplus);
        exit();
    }

    elseif (empty($Entrepreneurship)) {
        header("Location: ./form.php?error=emptyfieldsEntrepreneurship"."&computer=".$computer."&communication=".$communication."&java_mobile=".$java_mobile."&leadership=".$leadership."&Certiplus_Program_place=".$Certiplus_Program_place."&Career_planning_skills=".$Career_planning_skills."&graduate_certiplus=".$graduate_certiplus);
        exit();
    }

    elseif (empty($Career_planning_skills)) {
        header("Location: ./form.php?error=emptyfieldsCareer_planning_skills"."&computer=".$computer."&communication=".$communication."&java_mobile=".$java_mobile."&leadership=".$leadership."&Entrepreneurship=".$Entrepreneurship."&Certiplus_Program_place=".$Certiplus_Program_place."&graduate_certiplus=".$graduate_certiplus);
        exit();
    }

    elseif (empty($graduate_certiplus)) {
        header("Location: ./form.php?error=emptyfieldsgraduate_certiplus"."&computer=".$computer."&communication=".$communication."&java_mobile=".$java_mobile."&leadership=".$leadership."&Entrepreneurship=".$Entrepreneurship."&Career_planning_skills=".$Career_planning_skills."&Certiplus_Program_place=".$Certiplus_Program_place);
        exit();
    }

    
    else {
        $sql = "SELECT pd_id, ps_id FROM personal_detail WHERE us_id = ? ";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ./form.php?error=sqlerror1");
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
                header("Location: ./form.php?error=sqlerror2");
                exit();
            }
            else {
                $negara = "Indonesia";
                $ps_id_session = $ps_id_ses ;
                mysqli_stmt_bind_param($stmt, "issississ", $PersonalDetailID, $college, $City_college, $ps_id_row, $concentration_of_expertise, $graduate_degree, $ipk, $graduate_ithb, $negara);
                mysqli_stmt_execute($stmt);
                header("Location: ./form.php?college=success"."&PersonalId=".$PersonalDetailID."&Ps_id=".$ps_id_row."&UserID".$us_id_ses);
                exit();
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