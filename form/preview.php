<style type="text/css">
table{
    width:  100%;
    margin-top: 0mm;
    margin-bottom:0mm;
}

td{
    text-align: left;
    margin-top: 0mm;
    margin-bottom:0mm;
}

img {
    width: 20mm;
    height: 30mm;
    margin-top: -13mm;
}

.garis {
    margin-top: 2mm;
    border-top: 1px solid;
    margin-left: -1mm;
}

#name {
    text-align: center;
    font-size: 10pt;
    line-height: normal;
}

#address {
    text-align: center;
    font-size: 10pt;
    margin-top: 2pt;
    line-height: normal;
    margin-left: -10mm;
}

#kota {
    line-height: normal;
    text-align: justify;
    font-size: 10pt;
    margin-top: 2pt;
    margin-left: -10mm;
}

#hpemail {
    line-height: normal;
    text-align: center;
    font-size: 10pt;
    margin-top: 2pt;
    margin-left: -10mm;
}

#emp {
    line-height: normal;
    text-align: justify;
    font-size: 10pt;
    margin-left: -1mm;
}

#obj {
    line-height: normal;
    text-align: justify;
    font-size: 10pt;
    margin-top: 1px;
    margin-left: 6mm;
    padding-right: 0.5mm;
}

#edu {
    line-height: normal;
    text-align: justify;
    font-size: 10pt;
    margin-left: -1mm;
}

#kampus {
    line-height: normal;
    text-align: justify;
    font-size: 10pt;
    margin-top: 1px;
    margin-left: 6mm;
}

#certi {
    line-height: normal;
    text-align: justify;
    font-size: 10pt;
    margin-top: 1px;
    margin-left: 6mm;
}

#cerplus {
    line-height: normal;
    text-align: justify;
    font-size: 10pt;
    margin-top: 1px;
    margin-left: 6mm;
}

#cisco {
    line-height: normal;
    text-align: justify;
    font-size: 10pt;
    margin-top: 1px;
    margin-left: 6mm;
}

#cisnet {
    line-height: normal;
    text-align: justify;
    font-size: 10pt;
    margin-top: 1px;
    margin-left: 6mm;
}

#sma {
    line-height: normal;
    text-align: justify;
    font-size: 10pt;
    margin-top: 1px;
    margin-left: 6mm;
}

#exprience {
    line-height: normal;
    text-align: justify;
    font-size: 10pt;
    margin-top: 1px;
    margin-left: -1mm;
}

#ex {
    line-height: normal;
    text-align: justify;
    font-size: 10pt;
    margin-left: 6mm;
    margin-bottom: -10px;
}

#additional {
    line-height: normal;
    text-align: justify;
    font-size: 10pt;
    margin-top: 1px;
    margin-left: -1mm;
}

#add {
    line-height: normal;
    text-align: justify;
    font-size: 10pt;
    margin-top: 1px;
    margin-left: 7mm;
    margin-right: -9.15mm;
}

#addtech {
    line-height: normal;
    text-align: justify;
    font-size: 10pt;
    margin-top: 1px;
    margin-left: 13mm;
    margin-right: -9.15mm;
}

#tanggal {
    line-height: normal;
    text-align: right;
    margin-right: -1mm;
}

li {
    list-style-position: outside;
    margin-left: -8mm;
    margin-top: -10mm;
    margin-bottom: -10mm;
    padding-left: 13px;
}

ul {
    margin-left: -13mm;
    margin-top: -16px;
    margin-bottom:-10mm;
    font-size: 6pt;
}

li span {
    font-size: 10pt;
    margin-top: 1pt;
}
</style>

<?php
    // Include config file
    require_once "../dbh.php";
    require "session_time.php";

    $PersonalDataId = $_SESSION['pd_id'];
    
    // START OF QUERY FOR PERSONAL DETAIL AND EMPLOYMENT OBJECTIVE
    $pd_eo_sql_read = "SELECT personal_detail.pd_id AS pd_id, personal_detail.us_id AS us_id, personal_detail.ps_id AS ps_id, personal_detail.no_induk AS no_induk, 
    personal_detail.nama AS nama, personal_detail.alamat AS alamat, personal_detail.kota AS kota, personal_detail.propinsi AS propinsi_id, personal_detail.negara AS negara_id, 
    personal_detail.kode_pos AS kode_pos, personal_detail.no_telpon AS no_telpon, personal_detail.email AS email, employment_objective.objective AS employment_objective,
    employment_objective.eo_id AS eo_id
    FROM personal_detail LEFT JOIN employment_objective
    ON employment_objective.pd_id = personal_detail.pd_id WHERE personal_detail.pd_id = $PersonalDataId";
        if ($pd_eo_result = mysqli_query($conn, $pd_eo_sql_read)) {
            if (mysqli_num_rows($pd_eo_result) > 0) {
                while ($pd_eo_row = mysqli_fetch_array($pd_eo_result)) {
                    $pd_id = $pd_eo_row['pd_id'];
                    $us_id = $pd_eo_row['us_id'];
                    $ps_id = $pd_eo_row['ps_id'];
                    $no_induk = $pd_eo_row['no_induk'];
                    $pd_nama = $pd_eo_row['nama'];
                    $pd_alamat = $pd_eo_row['alamat'];
                    $pd_kota = $pd_eo_row['kota'];
                    $pd_propinsi_id = $pd_eo_row['propinsi_id'];
                    $pd_negara_id = $pd_eo_row['negara_id'];
                    $pd_kode_pos = $pd_eo_row['kode_pos'];
                    $pd_no_telpon = $pd_eo_row['no_telpon'];
                    $pd_email = $pd_eo_row['email'];
                    $employment_objective_raw = $pd_eo_row['employment_objective'];
                    if(empty($employment_objective_raw)){
                        $employment_objective = "";
                    }
                    else{
                        $employment_objective = $employment_objective_raw;
                    }
                    $eo_id_temp = $pd_eo_row['eo_id'];
                    if ($eo_id_temp != '0') {
                        $eo_id = $eo_id_temp;
                    } 
                    else {
                        $eo_id = 0;
                    }
                    $provinsi_sql_read = "SELECT * FROM provinsi WHERE pr_id = $pd_propinsi_id";
                    if ($provinsi_result = mysqli_query($conn, $provinsi_sql_read)) {
                        if (mysqli_num_rows($provinsi_result) > 0) {
                            while ($provinsi_row = mysqli_fetch_array($provinsi_result)) {
                                $pd_provinsi = $provinsi_row['nama_provinsi'];
                            }
                        } else {
                            $pd_provinsi = "Provinsi unknown";
                          }
                    } else {
                        echo "ERROR: Could not able to execute $provinsi_sql_read. " . mysqli_error($conn);
                    }
                    $negara_sql_read = "SELECT * FROM negara WHERE ne_id = $pd_negara_id";  
                    if ($negara_result = mysqli_query($conn, $negara_sql_read)) {
                        if (mysqli_num_rows($negara_result) > 0) {
                            while ($negara_row = mysqli_fetch_array($negara_result)) {
                                $pd_negara = $negara_row['nama_negara'];
                            }
                        } else {
                            $pd_negara = "Negara unknown";
                          }
                    } else {
                        echo "ERROR: Could not able to execute $negara_sql_read. " . mysqli_error($conn);
                    }
                    $image_sql_read = "SELECT * FROM picture WHERE us_id = $us_id";
                    if($image_result = mysqli_query($conn, $image_sql_read)){
                        if(mysqli_num_rows($image_result) > 0){
                            while($image_row = mysqli_fetch_array($image_result)){
                                $photo_path = $image_row['picture'];                    
                            }                  
                        }
                    } else {
                            echo "ERROR: Could not able to execute $image_sql_read. " . mysqli_error($conn);
                        }  
                }   
            // Free result set
            mysqli_free_result($pd_eo_result);
            }
        } 
        else {
            echo "ERROR: Could not able to execute $pd_eo_sql_read. " . mysqli_error($conn);
        }
    // END OF QUERY FOR PERSONAL DETAIL AND EMPLOYMENT OBJECTIVE


    // START OF QUERY FOR HIGHER EDUCATION
    $he_sql_read = "SELECT * FROM higher_education WHERE pd_id = $PersonalDataId";
        if ($he_result = mysqli_query($conn, $he_sql_read)) {
            if (mysqli_num_rows($he_result) > 0) {
                while ($he_row = mysqli_fetch_array($he_result)) {
                    $he_id = $he_row['he_id'];
                    $he_nama = $he_row['nama'];
                    $he_kota = $he_row['kota'];
                    $he_jurusan_id = $he_row['jurusan'];
                    $he_concentration = $he_row['concentration'];
                    $he_gelar = $he_row['gelar'];
                    $he_ipk = $he_row['ipk']; 
                    $he_tgl_raw = $he_row['tanggal'];
                    $he_tanggal = date("F o", strtotime($he_tgl_raw));
                    $he_negara = $he_row['negara'];
                }   
            // Free result set
            mysqli_free_result($he_result);
            }
            else {
                $he_id = 0;
                $he_nama = "UNIVERSITY NAME";
                $he_kota = "CITY NAME";
                $he_jurusan_id = 0;
                $he_concentration = "CONCENTRATION";;
                $he_gelar = "DEGREE";
                $he_ipk = "0.00"; 
                $he_tgl_raw = "";
                $he_tanggal = "DATE";
                $he_negara = "COUNTRY";
            }
        } 
        else {
            echo "ERROR: Could not able to execute $he_sql_read. " . mysqli_error($conn);
        }
    // END OF QUERY FOR HIGHER EDUCATION


    // START OF QUERY FOR CERTIPLUS
    $certiplus_sql_read = "SELECT * FROM certiplus_detail WHERE pd_id = $PersonalDataId";
        if ($certiplus_result = mysqli_query($conn, $certiplus_sql_read)) {
            if (mysqli_num_rows($certiplus_result) > 0) {
                while ($certiplus_row = mysqli_fetch_array($certiplus_result)) {
                    $certiplus_ce_id = $certiplus_row['ce_id'];
                    $certiplus_type_id = $certiplus_row['type_id'];
                    $certiplus_nama = $certiplus_row['nama'];
                    $certiplus_sumber = $certiplus_row['sumber'];
                    $certiplus_tgl_raw = $certiplus_row['tanggal'];
                    $certiplus_tanggal = date("F o", strtotime($certiplus_tgl_raw));
                }   
            // Free result set
            mysqli_free_result($certiplus_result);
            } else{
                $certiplus_ce_id = 0;
                $certiplus_type_id = 0;
                $certiplus_nama = "";
                $certiplus_sumber = "";
                $certiplus_tgl_raw = "";
                $certiplus_tanggal = "";   
            }
        } 
        else {
            echo "ERROR: Could not able to execute $certiplus_sql_read. " . mysqli_error($conn);
        }
    // END OF QUERY FOR CERTIPLUS


    // START OF QUERY FOR PROFESSIONAL CERTIFICATION

                # QUERY FOR LOOKING PTC ID
                $type_id_default = 2;
                $ptc_id_sql = "SELECT * FROM pd_to_ctd WHERE pd_id = $PersonalDataId and type_id = $type_id_default";
                if ($ptc_id_result = mysqli_query($conn, $ptc_id_sql)) {
                    if (mysqli_num_rows($ptc_id_result) > 0) {
                        while ($ptc_id_row = mysqli_fetch_array($ptc_id_result)) {
                            $ptc_id = $ptc_id_row['ptc_id'];
                        }
                    }
                    else {
                        $ptc_id = 0;
                    }
                } else {
                    echo "ERROR: Could not able to execute $ptc_id_sql. " . mysqli_error($conn);
                }
                # END QUERY FOR LOOKING PTC ID

    $procer_sql_read = "SELECT ptc_to_procer.ctd_id AS ctd_id, pd_to_ctd.ptc_id AS ptc_id, pd_to_ctd.pd_id AS pd_id, pd_to_ctd.type_id AS type_id, certification_type.certification_name AS source_name, ptc_to_procer.tanggal AS tanggal
    FROM certification_type, pd_to_ctd LEFT JOIN ptc_to_procer
    ON pd_to_ctd.ptc_id = ptc_to_procer.ptc_id
    WHERE certification_type.type_id = pd_to_ctd.type_id AND pd_to_ctd.pd_id = $PersonalDataId AND pd_to_ctd.ptc_id = $ptc_id";
        if ($procer_result = mysqli_query($conn, $procer_sql_read)) {
            if (mysqli_num_rows($procer_result) > 0) {
                while ($procer_row = mysqli_fetch_array($procer_result)) {
                    $procer_ctd_id = $procer_row['ctd_id'];
                    $procer_ptc_id = $procer_row['ptc_id'];
                    $procer_pd_id = $procer_row['pd_id'];
                    $procer_type_id = $procer_row['type_id'];
                    $procer_source_name = $procer_row['source_name'];
                    
                    # START QUERY UNTUK NAMA COURSE DI PROFESSIONAL CERTIFICATION
                    $course_sql_read = "SELECT * FROM cer_type_detail WHERE type_id = $procer_type_id;";  
                    $procer_course_name_array = array();
                    if ($course_result = mysqli_query($conn, $course_sql_read)) {
                        if (mysqli_num_rows($course_result) > 0) {
                            while ($course_row = mysqli_fetch_array($course_result)) {
                                $procer_course_name_array[] = $course_row['certi_name'];
                            }
                        }
                        else {
                            $procer_course_name_array = array("","","");
                          }
                    } else {
                        echo "ERROR: Could not able to execute $course_sql_read. " . mysqli_error($conn);
                    }
                    # END QUERY UNTUK NAMA COURSE DI PROFESSIONAL CERTIFICATION

                    # START QUERY UNTUK TANGGAL COURSE DI PROFESSIONAL CERTIFICATION
                    $date_course_sql_read = "SELECT * FROM ptc_to_procer WHERE ptc_id = $ptc_id";  
                    $procer_date_course_name_array = array();
                    if ($date_course_result = mysqli_query($conn, $date_course_sql_read)) {
                        if (mysqli_num_rows($date_course_result) > 0) {
                            while ($date_course_row = mysqli_fetch_array($date_course_result)) {
                                $procer_date_course_name_array[] = $date_course_row['tanggal'];
                            }
                        }
                        else {
                            $procer_date_course_name_array = array("","","");
                          }
                    } else {
                        echo "ERROR: Could not able to execute $date_course_sql_read. " . mysqli_error($conn);
                    }
                    # END QUERY UNTUK TANGGAL COURSE DI PROFESSIONAL CERTIFICATION
                    
                    
                    $procer_tgl_raw = $procer_row['tanggal'];
                    $procer_tanggal = date("F o", strtotime($procer_tgl_raw));
                }
            // Free result set
            mysqli_free_result($procer_result);
            } else{
                $procer_ctd_id = 0;
                $procer_ptc_id = 0;
                $procer_pd_id = 0;
                $procer_type_id = 0;
                $procer_source_name = "";
                $procer_tgl_raw = "";
                $procer_tanggal = "";
                $procer_course_name_array = array("","","");
                $procer_date_course_name_array = array("","","");  
            }
        } 
        else {
            echo "ERROR: Could not able to execute $procer_sql_read. " . mysqli_error($conn);
        }
    // END OF QUERY FOR PROFESSIONAL CERTIFICATION


    // START OF QUERY FOR COMPULSARY EDUCATION (HIGH SCHOOL)
    $co_sql_read = "SELECT * FROM compulsary WHERE pd_id = $PersonalDataId";
        if ($co_result = mysqli_query($conn, $co_sql_read)) {
            if (mysqli_num_rows($co_result) > 0) {
                while ($co_row = mysqli_fetch_array($co_result)) {
                    $co_id = $co_row['co_id'];
                    $co_nama = $co_row['nama'];
                    $co_negara = $co_row['negara'];
                    $co_provinsi = $co_row['provinsi'];
                    $co_kota = $co_row['kota'];
                    $co_tgl_raw = $co_row['tanggal'];
                    $co_tanggal = date("F o", strtotime($co_tgl_raw));
                }   
            // Free result set
            mysqli_free_result($co_result);
            }
            else {
                $co_id = 0;
                $co_nama = "HIGH SCHOOL NAME";
                $co_negara = "COUNTRY";
                $co_provinsi = "PROVINCE";
                $co_kota = "CITY";
                $co_tgl_raw = "";
                $co_tanggal = "DATE";
            }
        } 
        else {
            echo "ERROR: Could not able to execute $co_sql_read. " . mysqli_error($conn);
        }
    // END OF QUERY FOR COMPULSARY EDUCATION (HIGH SCHOOL)

    
    
?>


<page >
    <table>
    <colgroup>
        <col style="width: 20%">
        <col style="width: 80%">
    </colgroup>
        <tr>
            <td> <?php if(!empty($photo_path)){echo "<img src='../assets/profile-picture/$photo_path'>";}else{echo "<img src='../assets/image/preview.png'>";} ?>
            </td>
            <td>
                <div id="name"><b><?php echo strtoupper($pd_nama) ?></b></div>
                <div id="address"><?php echo $pd_alamat ?>, <?php echo $pd_kota ?>, <?php echo $pd_kode_pos ?>, <?php echo $pd_provinsi ?>, <?php echo $pd_negara ?> </div>
                <div id="hpemail">(+62) <?php echo $pd_no_telpon ?>, <?php echo $pd_email ?></div>
            </td>
        </tr>
    </table>    
    <table>
        <tr>
            <td><div class="garis"></div> </td>
        </tr>
    </table>
    <table>
        <tr>
            <td><div id="emp"><b>EMPLOYMENT OBJECTIVE</b></div></td>
        </tr>
        <tr>
            <td><div id="obj"><span style="margin-left: 0mm;"><?php echo $employment_objective ?></span></div></td>
        </tr>
    </table>
    <table>
        <tr>
            <td></td>
        </tr>
    </table>
    <table>
    <colgroup>
        <col style="width: 80%">
        <col style="width: 20%">
    </colgroup>
        <tr>
            <td><div id="edu"><b>EDUCATION</b></div></td>
        </tr>
        <?php 
        if($he_id == 0){
            echo "";
        }else{
            echo "<tr>";
                echo "<td><div id='kampus'><span><b>$he_nama, </b>$he_kota, $he_negara</span></div></td>";
                echo "<td><div id='tanggal'><span>$he_tanggal</span></div></td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td><div id='kampus'><span>$he_gelar. Concentration: $he_concentration</span></div></td>";
            echo "</tr>";
            echo "<tr>";
                echo "<td><div id='kampus'><span>GPA $he_ipk</span></div></td>";
            echo "</tr>";
        } 
        ?>
    </table>
    <table>
        <tr>
            <td></td>
        </tr>
    </table>
    <table>
    <colgroup>
        <col style="width: 80%">
        <col style="width: 20%">
    </colgroup>
        <?php 
            if($certiplus_ce_id == 0){
                echo "";
            } else{
                echo "<tr>";
                    echo "<td><div id='certi'><b>Certiplus Program</b></div></td>";
                    echo "<td><div id='tanggal'><span id='tanggal'>$certiplus_tanggal</span></div></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td><div id='cerplus'><span>at ITHB Career Resource Center</span></div></td>";
                echo "</tr>";
            }
        ?>
    </table>
    <table>
        <?php 
            if($certiplus_ce_id == 0){
                echo "";
            } else {
                echo "<tr>";
                    echo "<td><div id='cerplus'><span>Completed a series of professional training in $certiplus_nama</span></div></td>";
                echo "</tr>";
            };
        ?>
    </table>
    <table>
        <tr>
            <td></td>
        </tr>
    </table>
    <table>
    <colgroup>
        <col style="width: 80%">
        <col style="width: 20%">
    </colgroup>
        <?php 
            if($certiplus_ce_id == 0){
                echo "";
            } else {
                echo "<tr>";
                    echo "<td><div id='cisco'><b>$procer_source_name</b></div></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td><div id='cisnet'><span>at ITHB Career Resource Center</span></div></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td><div id='cisnet'><span>Completed the $procer_course_name_array[1]</span></div></td>";
                    $date_1 = date("F o", strtotime($procer_date_course_name_array[1]));
                    echo "<td><div id='tanggal'><span>$date_1</span></div></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td><div id='cisnet'><span>Completed the $procer_course_name_array[0]</span></div></td>";
                    $date_0 = date("F o", strtotime($procer_date_course_name_array[0]));
                    echo "<td><div id='tanggal'><span>$date_0</span></div></td>";
                echo "</tr>";
            }
        ?>
    </table>
    <table>
        <tr>
            <td></td>
        </tr>
    </table>
    <table>
    <colgroup>
        <col style="width: 80%">
        <col style="width: 20%">
    </colgroup>
        <?php 
            if($co_id == 0){
                echo "";
            } else {
                echo "<tr>";
                    echo "<td><div id='sma'><b>$co_nama</b>, $co_kota, $co_negara</div></td>";
                    echo "<td><div id='tanggal'><span>$co_tanggal</span></div></td>";
                echo "</tr>";
            }
        ?>
    </table>
    <table>
        <tr>
            <td></td>
        </tr>
    </table>
    <table>
        <tr>
            <td><div id="exprience"><b>EXPERIENCE</b></div></td>
        </tr>
    </table>
    <table>
        <?php
        // START OF QUERY FOR EXPERIENCE
        $ex_sql_read = "SELECT * FROM experience WHERE pd_id = $PersonalDataId";
        if ($ex_result = mysqli_query($conn, $ex_sql_read)) {
            if (mysqli_num_rows($ex_result) > 0) {
                while ($ex_row = mysqli_fetch_array($ex_result)) {
                    $ex_ex_id = $ex_row['ex_id'];
                    $ex_nama_perusahaan = $ex_row['nama_perusahaan'];
                    $ex_kota = $ex_row['kota'];
                    $ex_negara = $ex_row['negara'];
                    $ex_detail_perusahaan = $ex_row['detail_perusahaan'];
                    $ex_scoping_statement = $ex_row['scoping_statement'];
                    $ex_posisi = $ex_row['posisi'];
                    $ex_status = $ex_row['status'];
                    $ex_tgl_mulai_raw = $ex_row['tanggal_mulai'];
                    $ex_tgl_selesai_raw = $ex_row['tanggal_selesai'];
                    if($ex_tgl_selesai_raw == "Present"){
                        $ex_tanggal_selesai = $ex_tgl_selesai_raw;
                    }
                    else{
                        $ex_tanggal_selesai = date("F o", strtotime($ex_tgl_selesai_raw));
                    }
                    $ex_tanggal_mulai = date("F o", strtotime($ex_tgl_mulai_raw));?>
                        <colgroup>
                                <col style='width: 65%'>
                                <col style='width: 35%'>
                        </colgroup>
                        <tr>
                            <td><div id='ex'><span><b><?=$ex_nama_perusahaan;?>, </b><?=$ex_kota;?>.</span></div></td>
                            <td><div id='tanggal'><span id='tanggal'><?=$ex_tanggal_mulai;?> - <?=$ex_tanggal_selesai;?></span></div></td>
                        </tr>
                        <tr>
                            <td colspan="2"><div id='ex'><span><i><?=$ex_detail_perusahaan;?></i></span></div></td>
                        </tr>
                        <tr>
                            <?php if($ex_status == "Not intern"){
                                echo "<td colspan='2'><div id='ex'><span><u>$ex_posisi</u></span></div></td>";
                            }else{
                                echo "<td colspan='2'><div id='ex'><span><u>$ex_status</u>, $ex_posisi</span></div></td>";
                            }?>
                        </tr>
                        <tr>
                            <td colspan="2"><div id='ex'><span><?=$ex_scoping_statement;?></span></div></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div id='ex'>
                                    <ul>
                                        <?php $dj_sql_read = "SELECT * FROM detail_job WHERE ex_id = $ex_ex_id";
                                            if ($dj_result = mysqli_query($conn, $dj_sql_read)) {
                                                if (mysqli_num_rows($dj_result) > 0) {
                                                    while ($dj_row = mysqli_fetch_array($dj_result)) {
                                                        $dj_dj_id = $dj_row['dj_id'];
                                                        $dj_detail_pekerjaan = $dj_row['detail_pekerjaan'];?>
                                                        <li style='margin-left: -0.6cm;'><span><?=$dj_detail_pekerjaan;?></span></li>
                                                    <?php }   
                                                    // Free result set 
                                                    mysqli_free_result($dj_result);
                                                }
                                                else {
                                                    $dj_dj_id = 0;
                                                    $dj_detail_pekerjaan = "Data Not Found";
                                                }
                                        } 
                                        else {
                                            echo "ERROR: Could not able to execute $dj_sql_read. " . mysqli_error($conn);
                                        }?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
            <?php    }
            // Free result set
            mysqli_free_result($ex_result);
            }
            else {
                $ex_ex_id = 0;
                $ex_nama_perusahaan = "Data Not Found";
                $ex_kota = "Data Not Found";
                $ex_negara = "Data Not Found";
                $ex_detail_perusahaan = "Data Not Found";
                $ex_scoping_statement = "Data Not Found";
                $ex_posisi = "Data Not Found";
                $ex_status = "Data Not Found";
                $ex_tgl_mulai_raw = "Data Not Found";
                $ex_tgl_selesai_raw = "Data Not Found";
                $ex_tanggal_mulai = "Data Not Found";
                $ex_tanggal_selesai = "Data Not Found";?>
                <tr><td><div id='obj'><span></span></div></td></tr><?php
            }
        } 
        else {
            echo "ERROR: Could not able to execute $ex_sql_read. " . mysqli_error($conn);
        }
        // END OF QUERY FOR EXPERIENCE
        ?>
    </table>

    <table>
        <tr>
            <td>
                <div id="additional"><b>ADDITIONAL INFORMATION</b></div>
            </td>
        </tr>
    </table>

    <?php 
        // START OF QUERY FOR TECHNOLOGY (ADDITIONAL INFORMATION)
        $tech_sql_read = "SELECT * FROM technology WHERE pd_id = $PersonalDataId";
        if ($tech_result = mysqli_query($conn, $tech_sql_read)) {
            if (mysqli_num_rows($tech_result) > 0) {
                echo "<div id='add'><ul><li><span>Highly proficient in the following technologies:</span></li></ul></div>";
                while ($tech_row = mysqli_fetch_array($tech_result)) {
                    $tech_te_id = $tech_row['te_id'];
                    $tech_nama_teknologi = $tech_row['nama_teknologi'];
                    
                    ######## START DETAIL TEKNOLOGI ###########
                    $det_tech_sql_read = "SELECT * FROM detail_technology WHERE te_id = $tech_te_id";
                    $detail_teknologi_array = array();
                    if ($det_tech_result = mysqli_query($conn, $det_tech_sql_read)) {
                        if (mysqli_num_rows($det_tech_result) > 0) {
                            while ($det_tech_row = mysqli_fetch_array($det_tech_result)) {
                                $det_tech_dt_id = $det_tech_row['dt_id'];
                                $detail_teknologi_array[] = $det_tech_row['detail_teknologi'];
                            }   
                        // Free result set
                        mysqli_free_result($det_tech_result);
                        }
                        else {
                            $det_tech_dt_id = 0;
                            $detail_teknologi_array[] = array("Data Not Found","Data Not Found","Data Not Found",
                            "Data Not Found","Data Not Found","Data Not Found","Data Not Found","Data Not Found");
                        }
                    } 
                    else {
                        echo "ERROR: Could not able to execute $det_tech_sql_read. " . mysqli_error($conn);
                    }
                    ######## END DETAIL TEKNOLOGI ###########
                    
                    $detail_teknologi_imp=implode(", ",$detail_teknologi_array);?>
                    <div id='addtech'><ul><li><span><?=$tech_nama_teknologi;?>: <?=$detail_teknologi_imp;?></span></li></ul></div><?php

                }   
            // Free result set
            mysqli_free_result($tech_result);
            } else{
                $tech_te_id = 0;
                $tech_nama_teknologi = "Data Not Found.";
            }
        } 
        else {
            echo "ERROR: Could not able to execute $tech_sql_read. " . mysqli_error($conn);
        }
        // END OF QUERY FOR TECHNOLOGY (ADDITIONAL INFORMATION)
    
        // START OF QUERY FOR AWARD (ADDITIONAL INFORMATION)
        $award_sql_read = "SELECT * FROM award WHERE pd_id = $PersonalDataId";
        if ($award_result = mysqli_query($conn, $award_sql_read)) {
            if (mysqli_num_rows($award_result) > 0) {
                while ($award_row = mysqli_fetch_array($award_result)) {
                    $award_aw_id = $award_row['aw_id'];
                    $award_nama = $award_row['nama'];
                    $award_tanggal = $award_row['tanggal'];?>

                    <div id='add'><ul><li><span><?=$award_nama;?></span></li></ul></div><?php
                }   
            // Free result set
            mysqli_free_result($award_result);
            }
            else {
                $award_aw_id = 0;
                $award_nama = "Data Not Found";
                $award_tanggal = "Data Not Found";
            }
        } 
        else {
            echo "ERROR: Could not able to execute $award_sql_read. " . mysqli_error($conn);
        }
        // END OF QUERY FOR AWARD (ADDITIONAL INFORMATION)

        // START OF QUERY FOR ORGANIZATION (ADDITIONAL INFORMATION)
        $org_sql_read = "SELECT * FROM organization WHERE pd_id = $PersonalDataId";
        if ($org_result = mysqli_query($conn, $org_sql_read)) {
            if (mysqli_num_rows($org_result) > 0) {
                while ($org_row = mysqli_fetch_array($org_result)) {
                    $org_or_id = $org_row['or_id'];
                    $org_nama = $org_row['nama'];
                    $org_posisi = $org_row['posisi'];
                    $org_detail_organisasi = $org_row['detail_organisasi'];
                    $org_tgl_mulai_raw = $org_row['tanggal_mulai'];
                    $org_tgl_selesai_raw = $org_row['tanggal_selesai'];
                    $org_detail_pekerjaan = $org_row['detail_pekerjaan'];
                    $org_tanggal_mulai = date("F o", strtotime($org_tgl_mulai_raw));
                    if($org_tgl_selesai_raw == "Present"){
                        $org_tanggal_selesai = "Present";
                    } else{
                        $org_tanggal_selesai = date("F o", strtotime($org_tgl_selesai_raw));
                    }?>

                    <div id='add'><ul><li><span><?=$org_posisi;?> at <?=$org_nama;?> (<?=$org_tanggal_mulai;?> - <?=$org_tanggal_selesai;?>); <?=$org_detail_organisasi;?>; acted as <?=$org_posisi;?> to <?=$org_detail_pekerjaan;?>.</span></li></ul></div><?php
                }   
            // Free result set
            mysqli_free_result($org_result);
            }
            else {
                $org_or_id = 0;
                $org_nama = "Data Not Found";
                $org_posisi = "Data Not Found";
                $org_detail_organisasi = "Data Not Found";
                $org_tgl_mulai_raw = "Data Not Found";
                $org_tgl_selesai_raw = "Data Not Found";
                $org_detail_pekerjaan = "Data Not Found";
                $org_tanggal_mulai = "Data Not Found";
                $org_tanggal_selesai = "Data Not Found";
            }
        } 
        else {
            echo "ERROR: Could not able to execute $org_sql_read. " . mysqli_error($conn);
        }
        // END OF QUERY FOR ORGANIZATION (ADDITIONAL INFORMATION)

        // START OF QUERY FOR LANGUAGE (ADDITIONAL INFORMATION)
        $language_sql_read = "SELECT * FROM language WHERE pd_id = $PersonalDataId";
        if ($language_result = mysqli_query($conn, $language_sql_read)) {
            if (mysqli_num_rows($language_result) > 0) {
                while ($language_row = mysqli_fetch_array($language_result)) {
                    $language_lg_id = $language_row['lg_id'];
                    $language_language = $language_row['language'];
                    $language_language_test = $language_row['language_test'];
                    $language_language_proficient = $language_row['Language_proficient'];
                    $language_score = $language_row['score'];
                    $language_tgl_raw = $language_row['date'];
                    $language_tanggal = date("F o", strtotime($language_tgl_raw));?>

                    <div id='add'><ul><li><span>Achieved <?=$language_language_test;?> Test Score (<?=$language_tanggal;?>): <?=$language_score;?></span></li></ul></div><?php
                }   
            // Free result set
            mysqli_free_result($language_result);
            }
            else {
                $language_lg_id = 0;
                $language_language = "Data Not Found";
                $language_language_test = "Data Not Found";
                $language_language_proficient = "Data Not Found";
                $language_score = "Data Not Found";
                $language_tgl_raw = "Data Not Found";
                $language_tanggal = "Data Not Found";
            }
        } 
        else {
            echo "ERROR: Could not able to execute $language_sql_read. " . mysqli_error($conn);
        }
        // END OF QUERY FOR LANGUAGE (ADDITIONAL INFORMATION)

        if($tech_te_id == 0 && $org_or_id == 0 && $language_lg_id == 0 && $award_aw_id == 0){
            echo "<div id='obj'><span></span></div>";
        }
    ?>
</page>