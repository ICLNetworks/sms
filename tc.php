<?php
@ob_start();
@session_start();
?>
<?php
if (isset($_SESSION['login_user'])) {
    include("includes/db.conn.php");
    $id = $_GET['id'];

    $result = mysqli_query($conn, "SELECT * FROM register1 JOIN tc WHERE register1.id=tc.id && register1.id='$id' && tc.id='$id'");
    while ($row = mysqli_fetch_array($result)) {
        $course = $row['course'];
        $shift = $row['shift'];
        $doa = $row['doa'];
        $umisno = $row['umisno'];
        $name = $row['name'];
        $sex = $row['sex'];
        $dob = $row['dob'];
        $comm = $row['comm'];
        $subc = $row['subc'];
        //$pschool=$row['pschool'];
        $national = $row['national'];
        $religion = $row['religion'];
        $fm = $row['fm'];
        //$tho=$row['tho'];
        // $income=$row['income'];
        // $handi=$row['handi'];
        // $exser=$row['exser'];
        // $orgin=$row['orgin'];
        // $sports=$row['sports'];
        // $addr=$row['addr'];
        $tags = $row['tags'];
        $photo = $row['photo'];
        $dist = $row['dist'];
        $adno = $row['adno'];
        $batch = $row['batch'];
        $status = $row['status'];
        $dobw = $row['dobw'];
        $sublev = $row['sublev'];
        $aucsub = $row['aucsub'];
        $part1 = $row['part1'];
        $medium = $row['medium'];
        $paid = $row['paid'];
        $scholar = $row['scholar'];
        $medical = $row['medical'];
        $dol = $row['dol'];
        $char = $row['chara'];
        $apply = $row['apply'];
        $idate = $row['idate'];
        $noy = $row['noy'];
        $academic = $row['academic'];
        $flang = $row['flang'];
        $tmedium = $row['tmedium'];
        $date = $row['date'];
        $mark = $row['mark'];
        $sublevyear = $row['sublevyear'];
        $regid = $row['id'];
        $dis = $row['dis'];
    }
    function convertNumber($num)
    {
        //list($num, $dec) = explode(".", $num);

        $output = "";

        if ($num[0] == "-") {
            $output = "negative ";
            $num = ltrim($num, "-");
        } else if ($num[0] == "+") {
            $output = "positive ";
            $num = ltrim($num, "+");
        }

        if ($num[01] == "01") {
            $output .= "One";
        } else {
            $num = str_pad($num, 36, "0", STR_PAD_LEFT);
            $group = rtrim(chunk_split($num, 3, " "), " ");
            $groups = explode(" ", $group);

            $groups2 = array();
            foreach ($groups as $g) $groups2[] = convertThreeDigit($g[0], $g[1], $g[2]);

            for ($z = 0; $z < count($groups2); $z++) {
                if ($groups2[$z] != "") {
                    $output .= $groups2[$z] . convertGroup(11 - $z) . ($z < 11 && !array_search('', array_slice($groups2, $z + 1, -1))
                        && $groups2[11] != '' && $groups[11][0] == '0' ? " and " : ", ");
                    //&& $groups2[11] != '' && $groups[11]{0} == '0' ? "  " : ", ");
                }
            }

            $output = rtrim($output, ", ");
        }

        /*if($dec > 0)
{
$output .= " point";
for($i = 0; $i < strlen($dec); $i++) $output .= " ".convertDigit($dec{$i});
}*/

        return $output;
    }

    function convertGroup($index)
    {
        switch ($index) {
            case 11:
                return " Decillion";
            case 10:
                return " Nonillion";
            case 9:
                return " Octillion";
            case 8:
                return " Septillion";
            case 7:
                return " Sextillion";
            case 6:
                return " Quintrillion";
            case 5:
                return " Quadrillion";
            case 4:
                return " Trillion";
            case 3:
                return " Billion";
            case 2:
                return " Million";
            case 1:
                return " Thousand";
            case 0:
                return "";
        }
    }

    function convertThreeDigit($dig1, $dig2, $dig3)
    {
        $output = "";

        if ($dig1 == "0" && $dig2 == "0" && $dig3 == "0") return "";

        if ($dig1 != "0") {
            $output .= convertDigit($dig1) . " Hundred";
            if ($dig2 != "0" || $dig3 != "0") $output .= "  ";
        }

        if ($dig2 != "0") $output .= convertTwoDigit($dig2, $dig3);
        else if ($dig3 != "0") $output .= convertDigit($dig3);

        return $output;
    }

    function convertTwoDigit($dig1, $dig2)
    {
        if ($dig2 == "0") {
            switch ($dig1) {
                case "1":
                    return "Ten";
                case "2":
                    return "Twenty";
                case "3":
                    return "Thirty";
                case "4":
                    return "Forty";
                case "5":
                    return "Fifty";
                case "6":
                    return "Sixty";
                case "7":
                    return "Seventy";
                case "8":
                    return "Eighty";
                case "9":
                    return "Ninety";
            }
        } else if ($dig1 == "1") {
            switch ($dig2) {
                case "1":
                    return "Eleven";
                case "2":
                    return "Twelve";
                case "3":
                    return "Thirteen";
                case "4":
                    return "Fourteen";
                case "5":
                    return "Fifteen";
                case "6":
                    return "Sixteen";
                case "7":
                    return "Seventeen";
                case "8":
                    return "Eighteen";
                case "9":
                    return "Nineteen";
            }
        } else {
            $temp = convertDigit($dig2);
            switch ($dig1) {
                case "2":
                    return "Twenty $temp";
                case "3":
                    return "Thirty $temp";
                case "4":
                    return "Forty $temp";
                case "5":
                    return "Fifty $temp";
                case "6":
                    return "Sixty $temp";
                case "7":
                    return "Seventy $temp";
                case "8":
                    return "Eighty $temp";
                case "9":
                    return "Ninety $temp";
            }
        }
    }

    function convertDigit($digit)
    {
        switch ($digit) {
            case "0":
                return "Zero";
            case "1":
                return "One";
            case "2":
                return "Two";
            case "3":
                return "Three";
            case "4":
                return "Four";
            case "5":
                return "Five";
            case "6":
                return "Six";
            case "7":
                return "Seven";
            case "8":
                return "Eight";
            case "9":
                return "Nine";
        }
    }


?>
    <html>

    <head>
        <title>TC2</title>
        <style>
            body {
                /* to centre page on screen */
                height: 842px;
                width: 650px;
                margin-left: auto;
                margin-right: auto;
                margin-top: 30px;
                
                
            }
            
            .one {
                margin-left: -60px;
            }
            
            .page {
                page-break-a fter: always;
                margin: 10px 0;
                padding: 10px 0;

            }

            @media print {

                button {
                    display: none;
                }

                .page {
                    page-break-after: always;
                    page-break-inside: avoid;
                    /* padding: 20mm; */
                    /* min-width: 100%; */
                    /* height: 100%; */
                    /* border: 2px solid red; */
                }

            }

            /*
	.leftcolor{
		color: #9C27B0!important;
	}
	.maincolor{
		color: #3F51B5!important;
	}
	.notecolor{
		color: #E91E63!important;
	}
	*/
        </style>
        <style type="text/css" media="print">
            @page {
                size: auto;
                /* auto is the initial value */
                margin-top: 0mm;
                /* this affects the margin in the printer settings */
                margin-bottom: 0mm;
                margin-left: 0.5mm;
                margin-right: 1mm;
            }
        </style>
    </head>

    <body style="font-family: arial black; font-weight: bold;">
        <button style="margin-left: -160px;" onclick="window.location.href='home.php'">Back</button>
        <button style="margin-right: -600px; margin-top: -220px;" onclick="window.print();">Print</button>
        <center>
            <b>
                <div class="page">
                    <table width="80%">
                        <tr>
                            <td></td>
                            <td> <img width="90px" height="80px" height="auto" src="js/clg.jpg" /></td>
                            <td><img width="80%" height="auto" src="js/tc.jpg" /></td>
                            <td></td>
                            <td><img width="70px" height="80px" src="<?php echo $photo; ?>" alt="" /></td>
                        </tr>
                    </table>
                    <br>
                    <table width="100%" >
                        <tr>
                            <td width="100px;" class="leftcolor">Serial No.</td>
                            <td style="font-size: 20px;" class="maincolor"><?php echo $regid; ?></td>
                            <td width="100px;"></td>
                            <td width="150px;" class="leftcolor">Admission No.</td>
                            <td style="font-size: 20px;" class="maincolor"><?php echo strtoupper($adno); ?></td>
                            <td width="100px;"></td>
                            <td width="100px;" class="leftcolor">UMIS No.</td>
                            <td style="font-size: 20px;" class="maincolor"><?php echo strtoupper($umisno); ?></td>

                        </tr>
                    </table>
                    <br>
                    <div class="one">
                        <table width="100%" style="font-size: 11px!important;">
                            <tr>
                                <td valign="top" width="50px" class="leftcolor">1. (அ)</td>
                                <td class="leftcolor"><b>கல்லூரியின் பெயர் </b><br> Name of the College</td>
                                <td width="12px"></td>
                                <td align="center" class="maincolor" style="font-size:11px!Important;"><b>GOVT. ARTS COLLEGE FOR WOMEN<br>RAMANATHAPURAM -623501</b></td>
                            </tr>
                            <tr>
                                <td width="50px" class="leftcolor">&nbsp; &nbsp; (ஆ)</td>
                                <td class="leftcolor"><b>மாவட்டத்தின் பெயர் </b><br> Name of the District </td>
                                <td width="12px"></td>
                                <td align="center" style="font-size:16px!Important;" class="maincolor"><b>Ramanathapuram</b></td>
                            </tr>
                            <tr> </tr>
                            <tr> </tr>
                            <tr> </tr>
                            <tr>
                                <td valign="top" width="50px" class="leftcolor">2. </td>
                                <td class="leftcolor"><b>மாணவர் பெயர் (தனித்தனி எழுத்துக்களில் ) </b><br> Name of public (in BLOCK LETTERS)
                                    <br>(as entered in +2 or equivalent certificate)
                                </td>
                                <td width="12px"></td>
                                <td align="center" style="font-size:18px!Important;" class="maincolor"><b><?php echo strtoupper($name); ?></b></td>
                            </tr>
                            <tr> </tr>
                            <tr> </tr>
                            <tr> </tr>
                            <tr>
                                <td class="leftcolor" valign="top" width="50px">3. </td>
                                <td class="leftcolor"><b>தந்தை அல்லது தாயாரின் பெயர் </b><br> Name of Father or Mother</td>
                                <td width="12px"></td>
                                <td align="center" style="font-size:16px!Important;" class="maincolor"><b><?php echo strtoupper($fm); ?></b></td>
                            </tr>
                            <tr> </tr>
                            <tr> </tr>
                            <tr> </tr>
                            <tr>
                                <td class="leftcolor" valign="top" width="50px">4. </td>
                                <td class="leftcolor"><b>தேசிய இனம், சமயம் </b><br> Nationality, Religion </td>
                                <td width="12px"></td>
                                <td align="center" style="font-size:14px!Important;" class="maincolor"><b><?php echo strtoupper($national); ?> REFER TO COMMUNITY CERTIFICATE</b></td>
                            </tr>
                            <tr> </tr>
                            <tr> </tr>
                            <tr> </tr>
                            <tr>
                                <td class="leftcolor" valign="top" width="50px">5. </td>
                                <td class="leftcolor"><b>இனம் <br> (Community)<br>
                                        அவன் / அவள் பின்வரும் ஐந்து பிரிவுகளில் எவையேனும் ஒன்றைச் சார்ந்தவரா?<br> Whether he/she belongs to-<br>
                                        அ) ஆதி திராவிடர் அல்லது பழங்குடி :
                                        <br>
                                        &nbsp;&nbsp; &nbsp; &nbsp;Adi Dravidar (Shcheduled Caste or Schedule Tribe)<br>
                                        ஆ) பின் தங்கிய வகுப்பு :<br>
                                        &nbsp;&nbsp; &nbsp;&nbsp; Backward Class:<br>
                                        இ) மிகவும் பின் தங்கிய வகுப்பு :<br>
                                        &nbsp;&nbsp; &nbsp;&nbsp; Most Backward Class:<br>
                                        ஈ) ஆதிதிராவிடர் இனத்திலிருந்து கிறித்துவ மதத்திற்கு <br>&nbsp;&nbsp; &nbsp;&nbsp; மாறியவர் அல்லது :<br>
                                        &nbsp;&nbsp; &nbsp;&nbsp; Converted to Christianity from Scheduled Caste or<br>
                                        உ) அட்டவணையிலிருந்து நீக்கப்பட்ட இனம் :<br>
                                        &nbsp;&nbsp; &nbsp;&nbsp; Denotified Tribes:<br>



                                    </b>
                                </td>
                                <td valign="top" width="12px"></td>
                                <td align="center" valign="top" style="font-size:12.5px!Important;" class="maincolor"><b><?php
                                                                                                                            echo "<br><br>";
                                                                                                                            $a = "";
                                                                                                                            $sc = "";
                                                                                                                            $st = "";
                                                                                                                            $bc = "";
                                                                                                                            $mbc = "";
                                                                                                                            $other = "";
                                                                                                                            $dnc = "";
                                                                                                                            $scst = "";

                                                                                                                            $comm = "YES";

                                                                                                                            /*

if($comm=="OC")
$other="Yes, OC Category";
else
if($comm=="BC")
echo $bc="<br><br><br>Yes<BR> Backward Class";
else if($comm=="BC Muslim")
echo $bc="<br><br><br>Yes<BR> Backward Class Muslim";
else
if($comm=="SC")
echo $sc="Yes<br> Scheduled Caste";
else
if($comm=="ST")
echo $sc="Yes<br> Scheduled Tribe";
else
if($comm=="MBC")
echo $mbc="<br><br><br><br><br><br>Yes<BR> Most Backward Class";
else
if($comm=="DNC")
echo $dnc="<br><br><br><br><br><br>Yes<br> Denotified Community";
else
echo $scst="<br><br><br><br><br><br>Yes<br> Converted to Christianity from Sc/ST"; 

*/

                                                                                                                            echo "$comm";
                                                                                                                            ?></b></td>
                            </tr>

                            <tr>
                                <td class="leftcolor" valign="top" width="50px">6. </td>
                                <td class="leftcolor"><b>தாய்மொழி :</b><br> Mother Tangue</td>
                                <td width="10px"></td>
                                <td align="center" style="font-size:12.5px!Important;" class="maincolor"><b>Tamil</b></td>
                            </tr>

                            <tr>
                                <td class="leftcolor" valign="top" width="50px">6. </td>
                                <td class="leftcolor"><b>பாலினம் :</b><br> Gender</td>
                                <td width="10px"></td>
                                <td align="center" style="font-size:12.5px!Important;" class="maincolor"><b><?php echo strtoupper($sex); ?></b></td>
                            </tr>

                            <tr>
                                <td valign="top" width="50px" class="leftcolor">7. </td>
                                <td class="leftcolor"><b>பிறந்த தேதி (எண்ணிலும், எழுத்திலும் ):</b><br>
                                    (மாணவர் சேர்க்கை பதிவேட்டில் உள்ளபடி ) <br> Date of Birth as entered in the Admission Register
                                    in figures and words </td>
                                <td width="10px"></td>
                                <td align="center" class="maincolor"><b><?php echo strtoupper($dob); ?>
                                        <?php

                                        list($d, $m, $y) = explode("-", $dob);
                                        //$d2 = convertNumber($d);
                                        //$m2 = convertNumber($m);



                                        if ($y >= "2000") {
                                            $y1 = convertNumber($y);
                                            echo "<br>" . date("jS M", strtotime("$dob"));
                                            echo ", " . "$y1";
                                        } else {
                                            $y1 = substr($y, 0, 2);
                                            $y2 = substr($y, 2, 2);
                                            $y1 = convertNumber($y1);
                                            $y2 = convertNumber($y2);
                                            echo "<br>" . date("jS M", strtotime("$dob"));
                                            echo ", " . "$y1 $y2";
                                        }




                                        ?>
                                    </b></td>
                            </tr>

                        </table>

                        <table width="100%" style="font-size: 11px!important;">
                            <tr>
                                <td class="leftcolor" valign="top" width="50px">8. </td>
                                <td class="leftcolor"><b>உடலில் அமைந்த அடையாளக் குறிகள் :</b><br> Personal Marks of Identification:</td>
                                <!-- <td width="150px" style="border:2px solid red;"></td> -->
                                <td style="font-size:12.5px!Important;" class="maincolor"><b>
                                        <?php
                                        list($m1, $m2) = explode("&", $tags);
                                        if ($mark == "tam") {
                                            echo "<div style='font-family: Bamini;'>" . $m1 . "<br>" . $m2 . "</div>";
                                        } else {
                                            echo "<div>" . $m1 . "<br>" . $m2 . "</div>";
                                        }

                                        ?>
                                    </b></td>
                            </tr>
                        </table>

                        <table width="100%" style="font-size: 11px!important; margin-top: px;">
                            <tr>
                                <td class="leftcolor" valign="top" width="50px">9. </td>
                                <td class="leftcolor"><b>கல்லூரியில் சேர்க்கப்பட்ட தேதி மற்றும் சேர்க்கப்பட்ட வகுப்பு :

                                        <br>(வருடத்திற்கு எழுத்தால் எழுதவும் )
                                    </b><br> Date of admission and Class in which admitted<br>
                                    (the year to be entered in words)</td>
                                <td width="12px"></td>
                                <td valign="top" width="250px;" align="center" class="maincolor"><b><?php
                                                                                                    $da = convertNumber($batch);
                                                                                                    echo "<b>" . strtoupper($doa) . "<br>" . $da . "<br>";
                                                                                                    echo "Ist 	" . strtoupper($course);
                                                                                                    ?>
                                    </b></td>
                            </tr>
                        </table>
                        <table width="100%" style="font-size: 11px!important; margin-top: -05px;">
                            <tr>
                                <td class="leftcolor" valign="top" width="50px">10. அ)<br><br> &nbsp; &nbsp; &nbsp; a)</td>
                                <td class="leftcolor"> <b>மாணவர் கல்லூரியை விட்டு நீங்கும் காலத்தில் பயின்று வந்த வகுப்பு (எழுத்தால்) :</b><br> Class in which the pupil was studying at the time of
                                    leaving (in words)
                                </td>
                                <td align="" valign="top" style="float:left;" class="maincolor"><b>
                                        <?php
                                        /* if($sublevyear=="III")
                                {
                                	echo "$sublevyear " .strtoupper($sublev)." Completed";	
                                } else if($mp=="M.Phil")
                                {
                                	echo "$sublevyear " .strtoupper($sublev)."  Completed";	
                                } else if($mp1=="M.Sc" && $sublevyear=="II") 
                                {
                                    echo "$sublevyear " .strtoupper($sublev)." Completed";	
                                }
                                else if($mp2=="MA" && $sublevyear=="II")	
                                {
                                	echo "$sublevyear " .strtoupper($sublev)." Completed";	
                                }
                                else if($mp3=="M.Com" && $sublevyear=="II")	
                                {
                                    echo "$sublevyear " .strtoupper($sublev)." Completed";	
                                }
                                else if($mp3=="MBA" && $sublevyear=="II")	
                                {
                                    echo "$sublevyear " .strtoupper($sublev)." Completed";	
                                }
                                else {
                                	echo "$sublevyear " .strtoupper($sublev)." Completed";		
                                }	*/ ?>
                                        <?php echo "$sublevyear " . strtoupper($sublev) . " $dis"; ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td class="leftcolor" valign="top" width="50px">&nbsp; &nbsp; &nbsp; ஆ)<br>&nbsp; &nbsp; &nbsp; b)</td>
                                <td class="leftcolor" width=""><b>தேர்ந்தெடுத்த பாடம் மற்றும் துணைப் பாடம் :</b><br> The course offered Main and Ancillary:</td>
                                <td align="" valign="top" class="maincolor"><b><?php echo strtoupper($aucsub); ?></b><br><br></td>
                            </tr>
                        </table>
                        <table width="100%" style="font-size: 11px!important;">
                            <!-- <tr>
                                <td class="leftcolor" valign="top" width="50px">&nbsp; &nbsp; &nbsp; ஆ)<br>&nbsp; &nbsp; &nbsp; b)</td>
                                <td class="leftcolor" width="400px;"><b>தேர்ந்தெடுத்த பாடம் மற்றும் துணைப் பாடம் :</b><br> The course offered Main and Ancillary:</td>
                                <td align="center" valign="top" class="maincolor"><b><?php echo strtoupper($aucsub); ?></b><br><br></td>
                            </tr> -->
                            <!-- </table> -->
                    </div>
                </div>
                <div class="page">
                    <table width="100%" style="font-size: 11px!important; margin-top:50px;" >
                   
                        <tr>
                            <td valign="top" width="50px" class="leftcolor"><br>&nbsp; &nbsp; &nbsp; இ)<br>&nbsp; &nbsp; &nbsp; c)</td>
                            <td class="leftcolor"><br><b>பகுதி 1-இல் தேர்ந்தெடுத்த மொழி :</b><br> Language offered under Part-1:</td>
                            <td width="12px"></td>
                            <td valign="top" class="maincolor"><br><b><?php echo strtoupper($part1); ?></b></td>
                        </tr>
                        <tr>
                            <td valign="top" width="50px" class="leftcolor">&nbsp; &nbsp; &nbsp; ஈ)<br>&nbsp; &nbsp; &nbsp; d)</td>
                            <td class="leftcolor"><b>பயிற்று மொழி :</b><br> Medium of Instruction:</td>
                            <td width="12px"></td>
                            <td valign="top" class="maincolor"><b><?php echo strtoupper($medium); ?></b></td>
                        </tr>

                        <tr>
                            <td valign="top" width="50px">11. </td>
                            <td class="leftcolor"><b>கல்லூரிக்கு செலுத்த வேண்டிய கட்டணத் தொகை அனைத்தையும்<br> மாணவர் செலுத்தி விட்டாரா ? :</b><br> Whether the student has paid all the fees due to the college:</td>
                            <td width="12px"></td>
                            <td valign="top" class="maincolor"><b><?php echo strtoupper($paid); ?></b></td>
                        </tr>

                        <tr>
                            <td class="leftcolor" valign="top" width="50px">12. </td>
                            <td class="leftcolor"><b>மாணவர் படிப்பு உதவித் தொகை அல்லது கல்விச் சலுகை எதுவும் பெற்றவரா? (அதன் விவரத்தைக் குறிப்பிடுக )</b><br> Whether the student was in receipt of any scholarship (Nature of
                                the Scholarship to be specified) or any Educational Concessions:</td>
                            <td width="12px"></td>
                            <td valign="top" class="maincolor"><b><?php echo strtoupper($scholar); ?></b></td>
                        </tr>

                        <tr>
                            <td valign="top" width="50px" class="leftcolor">13. </td>
                            <td class="leftcolor"><b>மாணவர் கல்வியாண்டில் மருத்துவ ஆய்வுக்குச் சென்றவரா? (முதல் தடவை அல்லது அதற்கு மேல் குறிப்பிட்டு எழுதவும் ) </b><br>Whether the student as undergone medical inspection if any going the academic year (first or repeat to be specified) :</td>
                            <td width="12px"></td>
                            <td valign="top" class="maincolor"><b><?php echo strtoupper($medical); ?></b></td>
                        </tr>

                    </table>


                    <table width="100%" style="font-size: 11px!important; margin-top: px;">
                        <tr>
                            <td valign="top" width="50px" class="leftcolor">14. </td>
                            <td class="leftcolor"><b>மாணவர் கல்லூரியை விட்டு விலகிய நாள் : <br> Date of which the student actually left to the college :
                            </td>
                            <td width="210px"></td>
                            <td valign="top" class="maincolor"><b><?php echo strtoupper($dol); ?></b></td>
                        </tr>
                    </table>


                    <table width="100%" style="font-size: 11px!important; margin-top: px;">
                        <tr>
                            <td valign="top" width="50px" class="leftcolor">15. </td>
                            <td class="leftcolor"><b>மாணவரின் ஒழுக்கமும் பண்பும் : <br> The students Conduct and Character :
                            </td>
                            <td width="12px"></td>
                            <td width="75px" align="center"><b></b></td>
                        </tr>

                        <tr>
                            <td valign="top" width="50px" class="leftcolor">16. </td>
                            <td class="leftcolor"><b>பெற்றோர் அல்லது பாதுகாவலர் மாணவரின் மாற்றுச் சான்றிதழ் <br>கோரி விண்ணப்பித்த நாள் : <br> Date on which application for Transfer Certificate was made on
                                    behalf of the student by his parent or guardian :
                            </td>
                            <td width="24px"></td>
                            <td valign="top" class="maincolor"><b><?php echo strtoupper($apply); ?></b></td>
                        </tr>


                        <tr>
                            <td valign="top" width="50px" class="leftcolor">17. </td>
                            <td class="leftcolor"><b>மாற்றுச் சான்றிதழ் நாள் : <br> Date of the Transfer Certificate :
                            </td>
                            <td width="12px"></td>
                            <td valign="top" class="maincolor"><b><?php echo strtoupper($idate); ?></b></td>
                        </tr>



                        <tr>
                            <td valign="top" width="50px" class="leftcolor">18. </td>
                            <td class="leftcolor"><b>படிப்பு காலம் :<br> Course of Study :
                            </td>
                            <td width="12px"></td>
                            <td valign="top" class="maincolor"><b><?php echo strtoupper($noy); ?> Year(s)</b></td>
                        </tr>
                    </table>


                    <center>
                        <table width="80%" border="1px" style="font-size: 11px!important;">
                            <tr align="center" class="leftcolor">
                                <td><b>கல்லூரியின் பெயர்</b></td>
                                <td><strong><b>கல்வி ஆண்டுகள்</b></strong></td>
                                <td><strong><b>படித்த வகுப்பு </b></strong></td>
                                <td><strong><b>முதல் மொழி</b></strong></td>
                                <td><strong><b>பயிற்று மொழி </b></strong></td>
                            </tr>
                            <tr align="center" class="maincolor">
                                <td width="200px;"><strong>GOVERNMENT ARTS COLLEGE FOR WOMEN<br>RAMANATHAPURAM -623501<br><b>Ramanathapuram</strong></td>
                                <td><strong><?php echo strtoupper($academic); ?></strong></td>
                                <td><strong><?php


                                            $mp = substr($course, 0, 6);
                                            $mp1 = substr($course, 0, 4);
                                            $mp2 = substr($course, 0, 2);
                                            $mp3 = substr($course, 0, 5);
                                            $mp4 = substr($course, 0, 3);


                                            /*
	if($sublevyear=="III")
	{
	echo "$sublevyear " .strtoupper($sublev)." Completed";	
	}	
	else if($mp=="M.Phil")
	{
		echo "$sublevyear " .strtoupper($sublev)." Completed";	
	}else if($mp1=="M.Sc" && $sublevyear=="II")
	{
			echo "$sublevyear " .strtoupper($sublev)." Completed";	
	}
	else if($mp2=="MA" && $sublevyear=="II")	
	{
			echo "$sublevyear " .strtoupper($sublev)." Completed";	
	}
	else if($mp3=="M.Com" && $sublevyear=="II")	
	{
			echo "$sublevyear " .strtoupper($sublev)." Completed";	
	}
	else if($mp3=="MBA" && $sublevyear=="II")	
	{
			echo "$sublevyear " .strtoupper($sublev)." Completed";	
	}
	else {
		echo "$sublevyear " .strtoupper($sublev)." Completed";		
	}
*/


                                            echo "$sublevyear " . strtoupper($sublev) . " $dis";

                                            ?> </strong></td>
                                <td><strong><?php echo strtoupper($flang); ?></strong></td>
                                <td><strong><?php echo strtoupper($tmedium); ?> </strong></td>
                            </tr>
                        </table>

                        <table width="100%" style="font-size: 11px!important; margin-top: px;">
                            <tr>
                                <td valign="top" width="50px" class="leftcolor">19. </td>
                                <td class="leftcolor"><b>பல்கலைக்கழக மேலாண்மை தகவல் எண் : <br> UMIS Number :
                                </td>
                                <td width="12px"></td>
                                <td valign="top" class="maincolor"><b><strong><?php echo strtoupper($umisno); ?></b></td>
                            </tr>

                    </center>
                    <table width="100%" style="font-size: 11px!important;">
                        <tr>
                            <td class="leftcolor" valign="top" width="50px">20. </td>
                            <td class="leftcolor"><b>கல்லூரி முதல்வரின் கையொப்பம்

                                    <br>(நாள் மற்றும் கல்லுரி முத்திரையுடன் ) :
                                </b><br> Signature ofthe Principal with date and with College Seal:</td>
                            <td width="12px"></td>
                            <td align="center"><b></b></td>
                        </tr>
                    </table>
                    
                    <table width="100%" style="font-size: 11px!important;">
                        <tr>
                            <td width=50%>
                            <td class="leftcolor" align="center"><b>PRINCIPAL <BR> GOVERNMENT ARTS COLLEGE FOR WOMEN <BR> RAMANATHAPURAM
                            </td>
                        </tr>
                    </table>

                    <br>
                    <table width="120%" style="font-size: 11px!important;" class="notecolor">
                        <tr>
                            <td valign="top" width="50px"><b>குறிப்பு : </b></td>
                            <td valign="top">
                                1 ) இச்சான்றிதழ்கள் அழித்தல்கள் மற்றும் நம்பகமற்ற அல்லது மோசடியான திருத்தங்கள் செய்வது சான்றிதழை<br>&nbsp; &nbsp; &nbsp; &nbsp; ரத்து செய்ய வழி வகுப்பதாகும் .<br>&nbsp; &nbsp; &nbsp; Erasures and unauthenticated or fraudulent alterations in the certificate will lead to its cancellation.


                                <br>2 ) கல்லூரி முதல்வரால் மையினால், கையொப்பமிட வேண்டும். பதிவு செய்யப்பட்ட விவரங்கள் சரியானவை<br> &nbsp; &nbsp; &nbsp;&nbsp; என்பதற்கு அவரே பொறுப்பானவர் .<br>&nbsp; &nbsp; &nbsp; Should be signed in ink by the Head of the Institution who will be held responsible for the correctness of the entries.

                                <br>3 ) பெற்றோர் அல்லது பாதுகாவலர் அளிக்கும் உறுதி மொழி <br>&nbsp; &nbsp; &nbsp; Declaration by the Parent or guardian.

                            </td>


                        </tr>
                        <tr>
                            <td colspan="2"><br>
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; மேலே 2 முதல் 8 வரையுள்ள இனங்களுக்கெனப் பதிவு செய்யப்பட்டுள்ள விவரங்கள் சரியானவை மற்றும் என்றும் <br>எதிர்காலத்தில் அவற்றில் மாற்றம் எதுவும் கேட்கமாட்டேன் என்றும் நான் உறுதியளிக்கின்றேன். <br>
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; I hereby declare that the particulars recorded against items 2 to 8 are correct and that no change will be demanded<br> by me in future.
                            </td>
                        </tr>
                    </table>
                    <br><br>
                    <table width="100%" style="font-size: 11px!important;">
                        <tr>
                            <td width="400px;" class="maincolor" style="font-size: 13px!important;">மாணவர் கையொப்பம்<br>Signature of the Student
            </b></td>
            <td width="100px;"></td>
            <td width="500px;" align="center " class="maincolor"><b>பெற்றோர் அல்லது பாதுகாவலரின் கையொப்பம் <br>Signature of the Parent/Guardian.</b></td>
            </tr>
            </table>


        </center>
        </b>
        <button onclick="window.print()">Print</button>
        </div>
    </body>

    </html>
<?php
} else {
    header("Location:index.php");
}
?>