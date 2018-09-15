<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
    <head>
        <title>ใบกำกับการรับ - ส่งผ้าผู้ป่วยบริการจ้างเหมาซัก อบ รีด</title>
        <meta content="MSHTML 6.00.2900.5726" name="GENERATOR">
        <meta http-equiv=Content-Type content="text/html; charset=utf-8">
        <!-- <link href="print_php_files/styles.css" type="text/css" rel="stylesheet" media="screen"> -->

        <style type=text/css>
            body {
                PADDING-RIGHT: 0px; 
                PADDING-LEFT: 0px; 
                PADDING-BOTTOM: 0px; 
                MARGIN: 0px; 
                PADDING-TOP: 0px;
                background-color: #ffffff;
                height: 842px;
            }
            a:link {
                COLOR: #0000ff; 
                TEXT-DECORATION: none
            }
            a:visited {
                COLOR: #005ca2; 
                TEXT-DECORATION: none
            }
            a:active {
                COLOR: #0099ff; 
                TEXT-DECORATION: underline
            }
            a:hover {
                COLOR: #0099ff; 
                TEXT-DECORATION: underline
            }

            @media Print {
                div.page {
                    MARGIN: 0px; 
                    HEIGHT: 100%
                }

                body {
                    -webkit-print-color-adjust: exact;
                }
            }
            .UnderLine {
                FONT-WEIGHT: normal;
                MARGIN: 1px;
                COLOR: #0000ff;
                BORDER-TOP-STYLE: none;
                BORDER-BOTTOM: black 1px dotted;
                FONT-FAMILY: "TH SarabunPSK";
                BORDER-RIGHT-STYLE: none;
                BORDER-LEFT-STYLE: none;
                HEIGHT: 18px;
                TEXT-ALIGN: center
            }
            .UnderLineLeft {
                FONT-WEIGHT: normal; 
                MARGIN: 1px; 
                COLOR: #0000ff; 
                BORDER-TOP-STYLE: none; 
                BORDER-BOTTOM: black 1px dashed; 
                FONT-FAMILY: "TH SarabunPSK"; 
                BORDER-RIGHT-STYLE: none; 
                BORDER-LEFT-STYLE: none; 
                HEIGHT: 18px; 
                TEXT-ALIGN: left
            }
            .formthaitext {
                FONT-WEIGHT: bold; 
                FONT-SIZE: 15px; 
                COLOR: #000000; 
                FONT-FAMILY: "TH SarabunPSK";
            }
            .textform {
                FONT-SIZE: 11px; 
                COLOR: #000000; 
                FONT-FAMILY: Verdana
            }
            .thaitext {
                FONT-SIZE: 13px; 
                COLOR: #000000; 
                FONT-FAMILY: "TH SarabunPSK";
            }
            .thaitext_small {
                FONT-SIZE: 10px; 
                COLOR: #000000; 
                FONT-FAMILY: "TH SarabunPSK";
            }
            .headthaitext {
                FONT-SIZE: 15px; 
                COLOR: #000000; 
                FONT-FAMILY: "TH SarabunPSK";
            }
            .CordiaUPC {
                FONT-SIZE: 12px; 
                COLOR: #000000; 
                FONT-FAMILY: "TH SarabunPSK";
            }
            .buntuekkorkuam {
                font-size: 29pt; 
                color: #000000; 
                font-family: "TH SarabunPSK"; 
                font-weight:bold;  
                margin-left: -100px;
            }
            .txt-content {
                font-size: 16pt; 
                color: #000000; 
                font-family: "TH SarabunPSK";
            }
            .trh1 {
                height: 30px;
            }
            .trh0 {
                height: 5px;
            }
            p {
                font-size: 16pt; 
                color: #000000; 
                font-family: "TH SarabunPSK"; 
                font-weight: normal;
            }
            .p16 {
                font-size: 16pt; 
                color: #000000; 
                font-family: "TH SarabunPSK"; 
                font-weight: bold;
            }
            .p18 {
                font-size: 18pt; 
                color: #000000; 
                font-family: "TH SarabunPSK"; 
                font-weight: bold;
            }
            .p20 {
                font-size: 20pt; 
                color: #000000; 
                font-family: "TH SarabunPSK"; 
                font-weight: bold;
            }
            .formnumber {
                font-size: 11pt; 
                color: #000000; 
                font-family: "TH SarabunPSK"; 
                font-weight: bold;
                text-align: center;
                border: 1px solid #000000;
                padding: 0 5 0 5px;
            }
            .indent {
                margin-left: 94px;
            }
            .indent2 {
                margin-left: 30px;
            }
            .hasborder { border:1px solid #F00;  }
            .table {
                border: 1px solid #000000;
                border-collapse: collapse;
            }

            p.MsoNormal, li.MsoNormal, div.MsoNormal,span.MsoNormal {
                border-bottom: 1px dashed #000000;
                margin-top:0cm;
                margin-right:0cm;
                margin-bottom:10.0pt;
                margin-left:0cm;
                line-height:115%;
                font-size:16pt;
                font-family:"TH SarabunPSK";
            }
            .UnderlineTagp {
                border-bottom: 1px dashed #000000; 
                padding: 0px; 
                margin:0px;
                height: 20px
            }

            .datatable {
                border-collapse: collapse; 
                border: 1px solid black;
                font-family:"TH SarabunPSK";
                font-size:16pt;
            }
        </style>
        
        <script language=JavaScript src="print_php_files/script.js"></script>
        <script language=JavaScript>
            // window.print();
        </script>
            
    </head>

    <body>
        <?php
        $vehicle_type = [
            '1' => 'รถกระบะ', 
            '2' => 'รถตู้ 12 ที่นั่ง', 
            '3' => 'รถพยาบาล'
        ];
        
        // Set connect db
        $db = new PDO("mysql:host=192.168.20.4; dbname=laundry_db; charset=utf8", 'root', '1');
        $db->exec("set names utf8");
        $db->exec("COLLATE utf8_general_ci");
        
        // Set the PDO error mode to exception
        $sql = "select DATE_FORMAT(date,'%d') AS date,
                DATE_FORMAT(date,'%m') AS month,
                DATE_FORMAT(date,'%Y')+543 AS year, 
                id, invoice_no, total
                from sentout_daily 
                where id=:id ";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $_GET['id']);
        try {
            $stmt->execute();
           // var_dump($stmt);
            $sentoutDaily = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
           echo $e->getMessage();
        }
        ?>
        <div class="page" align="center">
            <div style="width: 660px; margin-left: 30px; margin-right: 15px; margin-top: 0px; padding: 5px;">
                <div style="padding: 0 5 0 5px;">

<!--                    <table width="100%">
                        <tr>
                            <td width="527"></td>
                            <td>
                                <p align="right" class="formnumber">QF-ICT-45 <br> updated 20/10/2559</p>
                            </td>
                        </tr>
                    </table>-->

                    <table width="100%" border="0">
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <b class="p20"><center>ใบกำกับการรับ - ส่งผ้าผู้ป่วยบริการจ้างเหมาซัก อบ รีด
                                    <br>โรงพยาบาลเทพรัตน์นครราชสีมา</center></b>
                                </td>
                            </tr>                            
                            <tr class="trh1">
                                <td width="80%">
                                    <p style="margin-left: 230px;">
                                        ประจำวันที่
                                        <?php echo (int)$sentoutDaily['date']; ?>  <?php echo thaimonth($sentoutDaily['month']); ?>  <?php echo $sentoutDaily['year']; ?>
                                    </p>
                                </td>
                                <td style="text-align: right;">
                                    <p>เลขที่ <?php echo $sentoutDaily['invoice_no'] ?> </p>
                                </td>
                            </tr>
                            
                            <!-- <tr class="trh1">
                                <td colspan="2">
                                    <p>
                                        <b class="p18">เรียน</b>&nbsp;&nbsp;ผู้อำนวยการโรงพยาบาลเทพรัตน์นครราชสีมา
                                    </p>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div><!-- /HEADER -->
                
                <div style="padding: 0 5 5 5px;"><!-- DETAIL -->
                    <table width="100%">
                        <tr>
                            <td>
                                
                                <table border="1" width="100%" class="datatable">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รายการ</th>
                                        <th>น้ำหนัก (กก.)</th>
                                        <th>นับชิ้น (ผืน)</th>
                                        <th>หมายเหตุ</th>
                                    </tr>
                                    <?php 
                                        $sql = "select * from sentout_type";
                                        $stmt = $db->prepare($sql);
                                        $stmt->execute();
                                        $sentoutTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);            
                                        
                                        foreach ($sentoutTypes as $sentoutType) :        
                                            // Set the PDO error mode to exception
                                            $sql = "select * from sentout_daily_detail 
                                                    where (sentout_daily_id=:sentoutdailyid) 
                                                    and (sentout_type_id=:sentouttypeid) ";

                                            $stmt = $db->prepare($sql);
                                            $stmt->bindValue(':sentoutdailyid', $sentoutDaily['id']);
                                            $stmt->bindValue(':sentouttypeid', $sentoutType['sentout_type_id']);
                                            $stmt->execute();
                                            $detail = $stmt->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                            <tr>
                                                <td style="text-align: center;"><?=$sentoutType['sentout_type_id']?></td>
                                                <td style="padding-left: 5px;"><?=$sentoutType['sentout_type_name']?></td>
                                                <td style="text-align: center; <?=(($sentoutType['count_method'] == '2') ? 'background-color: #848484;' : '')?>">
                                                    <?=(($sentoutType['count_method'] == '1' || $sentoutType['count_method'] == '3') ? $detail['amount'] : '') ?>
                                                </td>
                                                <td style="text-align: center; <?=(($sentoutType['count_method'] == '1' || $sentoutType['count_method'] == '3') ? 'background-color: #848484;' : '')?>">
                                                    <?=(($sentoutType['count_method'] == '2') ? $detail['amount'] : '') ?>
                                                </td>
                                                <td><?=$detail['remark']?></td>
                                            </tr>
                                    <?php endforeach; ?>

                                    <tr>
                                        <td style="text-align: center;" colspan="2">รวมน้ำหนัก</td>
                                        <td style="text-align: center;"><?=$sentoutDaily['total']?></td>
                                        <td style="background-color: #848484 !important;" colspan="2"></td>
                                    </tr>

                                </table>
                                		 
                            </td>
                        </tr>               
                    </table>

                    <table width="100%" border="0">
                        <tr>
                            <td>
                                <p style="margin: 5 0 0 15px; padding: 2px;">
                                    หมายเหตุ : ...............................................................................................................................................................
                                    ..................................................................................................................................................................................
                                </p>
                            </td>
                        </tr>
                    </table><br>

                    <table width="100%" border="0">
                        <tbody>
                            <tr>
                                <td width="50%">
                                    <p style="margin: 5 0 0 15px; padding: 2px;">
                                        ลงชื่อ.....................................................ผู้ส่ง
                                    </p>
                                    <p style="margin: -3 2 2 -40px; padding: 0px; text-align: center;">
                                        (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
                                    </p>
                                    <p style="margin: -3 2 2 80px; padding: 0px;">
                                        เจ้าหน้าที่โรงพยาบาล
                                    </p>
                                    
                                </td>
                                <td width="50%">
                                    <p style="margin: 5 0 0 15px; padding: 0px;">
                                        ลงชื่อ.....................................................ผู้รับ
                                    </p>
                                    <p style="margin: -3 2 2 -40px; padding: 0px; text-align: center;">
                                        (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
                                    </p>
                                    <p style="margin: -3 2 2 70px; padding: 0px;">
                                        เจ้าหน้าที่จากบริษัทซักผ้า
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table><br>                    
                
                </div><!-- /DETAIL -->

            </div> <!-- end page -->
        </div>	<!-- end page -->
        <?php
        function thainumDigit($num) {
            return str_replace(
                    array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), 
                    array("๐", "๑", "๒", "๓", "๔", "๕", "๖", "๗", "๘", "๙"), 
                    $num
            );
        }

        function thaimonth($monthparam) {
            switch ($monthparam) {
                case 1:
                    $month = 'มกราคม';
                    return $month;
                    break;
                case 2:
                    $month = 'กุมภาพันธ์';
                    return $month;
                    break;
                case 3:
                    $month = 'มีนาคม';
                    return $month;
                    break;
                case 4:
                    $month = 'เมษายน';
                    return $month;
                    break;
                case 5:
                    $month = 'พฤษภาคม';
                    return $month;
                    break;
                case 6:
                    $month = 'มิถุนายน';
                    return $month;
                    break;
                case 7:
                    $month = 'กรกฎาคม';
                    return $month;
                    break;
                case 8:
                    $month = 'สิงหาคม';
                    return $month;
                    break;
                case 9:
                    $month = 'กันยายน';
                    return $month;
                    break;
                case 10:
                    $month = 'ตุลาคม';
                    return $month;
                    break;
                case 11:
                    $month = 'พฤศจิกายน';
                    return $month;
                    break;
                case 12:
                    $month = 'ธันวาคม';
                    return $month;
                    break;
            }
        }
        ?>

    </body>
</html>