<?php
session_start();

if (isset($_POST['certiplus_submit'])) {

    require 'dbh.php';
    $CurrentEmail = $_SESSION['Email'];
    $UserId = $_SESSION['us_id'];
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
    // sisanya klo empty gpp kan checkbox bsk tanyain//
    elseif (empty($City_college)) {
        header("Location: ./form.php?error=emptyfieldsCity_college"."&college=".$college."&graduate_degree=".$graduate_degree."&concentration_of_expertise=".$concentration_of_expertise."&ipk=".$ipk."&graduate_ithb=".$graduate_ithb);
        exit();
    }

    elseif (empty($graduate_degree)) {
        header("Location: ./form.php?error=emptyfieldsgraduate_degree"."&City_college=".$City_college."&college=".$college."&concentration_of_expertise=".$concentration_of_expertise."&ipk=".$ipk."&graduate_ithb=".$graduate_ithb);
        exit();
    }

    elseif (empty($concentration_of_expertise)) {
        header("Location: ./form.php?error=emptyfieldsconcentration_of_expertise"."&City_college=".$City_college."&graduate_degree=".$graduate_degree."&college=".$college."&ipk=".$ipk."&graduate_ithb=".$graduate_ithb);
        exit();
    }

    elseif (empty($ipk)) {
        header("Location: ./form.php?error=emptyfieldsipk"."&City_collage=".$City_collage."&graduate_degree=".$graduate_degree."&concentration_of_expertise=".$concentration_of_expertise."&college=".$college."&graduate_ithb=".$graduate_ithb);
        exit();
    }

    elseif (empty($graduate_ithb)) {
        header("Location: ./form.php?error=emptyfieldsgraduate_ithb"."&City_collage=".$City_collage."&graduate_degree=".$graduate_degree."&concentration_of_expertise=".$concentration_of_expertise."&ipk=".$ipk."&college=".$college);
        exit();
    }

    elseif (empty($graduate_ithb)) {
        header("Location: ./form.php?error=emptyfieldsgraduate_ithb"."&City_collage=".$City_collage."&graduate_degree=".$graduate_degree."&concentration_of_expertise=".$concentration_of_expertise."&ipk=".$ipk."&college=".$college);
        exit();
    }

    elseif (empty($graduate_ithb)) {
        header("Location: ./form.php?error=emptyfieldsgraduate_ithb"."&City_collage=".$City_collage."&graduate_degree=".$graduate_degree."&concentration_of_expertise=".$concentration_of_expertise."&ipk=".$ipk."&college=".$college);
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
            //jgn lupa ubah name nya sesuai database//
            $sql = "INSERT INTO personal_detail (us_id, ps_id, no_induk, nama, alamat, kota, propinsi, kode_pos, no_telpon, email, path_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ./form.php?error=sqlerror2");
                exit();
            }
            else {
                $ps_id = 2;
                $nim = 1418001;
                        //jgn lupa ubah name nya sesuai database//
                mysqli_stmt_bind_param($stmt, "iiisssssiss", $UserId, $ps_id, $nim, $FirstName, $Address, $City, $Province, $ZipCode, $Phone, $Email, $Photo);
                mysqli_stmt_execute($stmt);
                header("Location: ./form.php?personaldata=success"."&UserId=".$UserId);
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