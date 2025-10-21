<?php
@ob_start();
session_start();
?>
<?php
if(isset($_SESSION['login_user']))
{
include("includes/db.conn.php");
$id=$_GET['id'];

$result = mysql_query("SELECT * FROM register JOIN tc WHERE register.id=tc.id && register.id='$id' && tc.id='$id'");
while($row = mysql_fetch_array($result)) 
 {
$course=$row['course'];
$shift=$row['shift'];
$doa=$row['doa'];
$name=$row['name'];
$sex=$row['sex'];
$dob=$row['dob'];
$comm=$row['comm'];
$subc=$row['subc'];
$pschool=$row['pschool'];
$national=$row['national'];
$religion=$row['religion'];
$fm=$row['fm'];
$tho=$row['tho'];
$income=$row['income'];
$handi=$row['handi'];
$exser=$row['exser'];
$orgin=$row['orgin'];
$sports=$row['sports'];
$addr=$row['addr'];
$tags=$row['tags'];
$photo=$row['photo'];
$dist=$row['dist'];
$adno=$row['adno'];
$batch=$row['batch'];
$status=$row['status'];
$dobw=$row['dobw'];
$sublev=$row['sublev'];
$aucsub=$row['aucsub'];
$part1=$row['part1'];
$medium=$row['medium'];
$paid=$row['paid'];
$scholar=$row['scholar'];
$medical=$row['medical'];
$dol=$row['dol'];
$char=$row['chara'];
$apply=$row['apply'];
$idate=$row['idate'];
$noy=$row['noy'];
$academic=$row['academic'];
$flang=$row['flang'];
$tmedium=$row['tmedium'];
$date=$row['date']; 	
}

if (isset($_POST['submit'])) 
{
$dobw=$_POST['dobw'];
$sublev=$_POST['sublev'];
$aucsub=$_POST['aucsub'];
$part1=$_POST['part1'];
$medium=$_POST['medium'];
$paid=$_POST['paid'];
$scholar=$_POST['scholar'];
$medical=$_POST['medical'];
$dol=$_POST['dol'];
$char=$_POST['char'];
$apply=$_POST['apply'];
$idate=$_POST['idate'];
$noy=$_POST['noy'];
$sdate=$_POST['sdate'];
$edate=$_POST['edate'];
$academic=$sdate+"-"+$edate;
$flang=$_POST['flang'];
$tmedium=$_POST['tmedium'];
$nnn=Date('d-m-Y'); 	

//$status="Not Issued";


//$query1="insert into tc(dobw,sublev,aucsub,part1,medium,paid,scholar,medical,dol,char,apply,idate,noy,academic,flang,tmedium,id,date) values('$dobw','$sublev','$aucsub','$part1','$medium','$paid','$scholar','$medical','$dol','$char','$apply','$idate','$noy','$academic','$flang','$tmedium','$id','$nnn')";
//$result1 = mysql_query($query1) or die(mysql_error());
//header("location: view.php");
}

function convertNumber($num)
{
//list($num, $dec) = explode(".", $num);

$output = "";

if($num{0} == "-")
{
$output = "negative ";
$num = ltrim($num, "-");
}
else if($num{0} == "+")
{
$output = "positive ";
$num = ltrim($num, "+");
}

if($num{01} == "01")
{
$output .= "one";
}
else
{
$num = str_pad($num, 36, "0", STR_PAD_LEFT);
$group = rtrim(chunk_split($num, 3, " "), " ");
$groups = explode(" ", $group);

$groups2 = array();
foreach($groups as $g) $groups2[] = convertThreeDigit($g{0}, $g{1}, $g{2});

for($z = 0; $z < count($groups2); $z++)
{
if($groups2[$z] != "")
{
$output .= $groups2[$z].convertGroup(11 - $z).($z < 11 && !array_search('', array_slice($groups2, $z + 1, -1))
&& $groups2[11] != '' && $groups[11]{0} == '0' ? " and " : ", ");
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
switch($index)
{
case 11: return " decillion";
case 10: return " nonillion";
case 9: return " octillion";
case 8: return " septillion";
case 7: return " sextillion";
case 6: return " quintrillion";
case 5: return " quadrillion";
case 4: return " trillion";
case 3: return " billion";
case 2: return " million";
case 1: return " thousand";
case 0: return "";
}
}

function convertThreeDigit($dig1, $dig2, $dig3)
{
$output = "";

if($dig1 == "0" && $dig2 == "0" && $dig3 == "0") return "";

if($dig1 != "0")
{
$output .= convertDigit($dig1)." hundred";
if($dig2 != "0" || $dig3 != "0") $output .= " and ";
}

if($dig2 != "0") $output .= convertTwoDigit($dig2, $dig3);
else if($dig3 != "0") $output .= convertDigit($dig3);

return $output;
}

function convertTwoDigit($dig1, $dig2)
{
if($dig2 == "0")
{
switch($dig1)
{
case "1": return "ten";
case "2": return "twenty";
case "3": return "thirty";
case "4": return "forty";
case "5": return "fifty";
case "6": return "sixty";
case "7": return "seventy";
case "8": return "eighty";
case "9": return "ninety";
}
}
else if($dig1 == "1")
{
switch($dig2)
{
case "1": return "eleven";
case "2": return "twelve";
case "3": return "thirteen";
case "4": return "fourteen";
case "5": return "fifteen";
case "6": return "sixteen";
case "7": return "seventeen";
case "8": return "eighteen";
case "9": return "nineteen";
}
}
else
{
$temp = convertDigit($dig2);
switch($dig1)
{
case "2": return "twenty-$temp";
case "3": return "thirty-$temp";
case "4": return "forty-$temp";
case "5": return "fifty-$temp";
case "6": return "sixty-$temp";
case "7": return "seventy-$temp";
case "8": return "eighty-$temp";
case "9": return "ninety-$temp";
}
}
}

function convertDigit($digit)
{
switch($digit)
{
case "0": return "zero";
case "1": return "one";
case "2": return "two";
case "3": return "three";
case "4": return "four";
case "5": return "five";
case "6": return "six";
case "7": return "seven";
case "8": return "eight";
case "9": return "nine";
}
}

?>
<div style="line-height:14px;">
<center>
<center><h4><b><font face="Bamini">jkpo;ehL muR</font><br><Br>Government of Tamil Nadu<br><br><font face="Bamini">fy;Y}hpj; fy;tpj; Jiw</font><br><br>Department of Collegiate Education</b> <H4><center><B><font face="Bamini"> khw;Wr; rhd;wpjo; </font> - TRANSFER CERTIFICATE</B></center></H4></h4></center>

</center>

<pre><font face="Bamini">		thpir vz;        					  						  Nrh;f;if vz;</pre></font>
<pre><font face="arial">    	      Serial No. 			<b><font size=5><?php echo $id+6000;?></font></b>						    Admission No. &nbsp;&nbsp;&nbsp; <font size=5> <b><?php echo $adno;?></b></pre></font><br><br>
<table width=90% border=0 align=center cellspacing=0>
<tr style="line-height:25px;">
<td width=50%><pre>1. <font face="Bamini">(m) fy;Y}hpapd; ngah;  </font><br>
<font face="arial" size=2>            Name of the College</font><br>
<font face="Bamini">      (M) khtl;lj;jpd; ngah; </font><br>
<font face="arial" size=2>            Name of the District </font></pre>
</td>
<td width=50% align=center><b>GOVT. ARTS COLLEGE<br><br>PARAMAKUDI-623701<br><br>RAMANTHAPURAM</td>
</tr>

<tr style="line-height:30px;">
<td><pre>2. <font face="Bamini">khzth; ngah;(jdpj;jdp vOj;Jf;fspy;) </font>
<font face="arial" size=2>      Name of public (in BLOCK LETTERS)<br>      (as entered in +2 or equivalent certificate)</font>
</td>
<td><center><b><?php echo strtoupper($name); ?></center></td>
<td><img width="150px" height="100px" src="<?php echo $photo;?>" alt="" /></td>
</tr >
<tr style="line-height:30px;">
<td><pre>3. <font face="Bamini">je;ij my;yJ jhahhpd; ngah;</font>
<font face="arial" size=2>      Name of Father or Mother</font></pre></td>
<td><b><center><?php echo  strtoupper($fm); ?></center></td>
</tr>
<tr style="line-height:30px;"><br>
<td><pre>4. <font face="Bamini">Njrpa ,dk;> rkak; kw;Wk; rhjp</font>
<font face="arial" size=2>      Nationality Religion and Caste</font></pre></td>
<td><center><b><?php echo "<br>".strtoupper($national).", ".strtoupper($religion)." ,".strtoupper($comm);?></center></td>
</tr>
<tr style="line-height:30px;">
<td><pre>5. <font face="Bamini">,dk;</font><font face="arial" size=2>(community)</font>
<font face="Bamini">     mtd;</font><font face="arial" size=2>/</font><font face="Bamini">mts; gpd;tUk; Ie;J gphpTfspy;<br>      vitNaDk; xd;iwr; rhh;e;jtuh</font><font face="arial" size=2>?</font> 
<font face="arial" size=2>      Whether he/she belongs to-</font>
<font face="Bamini">  (m) Mjp jpuhtplh; my;yJ goq;Fb :</font>
<font face="arial" size=2>        Adi Dravidar (Shcheduled Caste or Schedule Tribe)</font>
<font face="Bamini">  (M) gpd;jq;fpa tFg;G :</font>
<font face="arial" size=2>        Backward Class</font>
<font face="Bamini">  (,) kpfTk; gpd;jq;fpa tFg;G :</font>
<font face="arial" size=2>        Most Backward Class</font>
<font face="Bamini">  (<) Mjpjpuhtplh; ,dj;jpypUe;J fpwpj;Jt<br>       kjj;jpw;F khwpath my;yJ  :</font>
<font face="arial" size=2>        Converted to Christianity from Scheduled Caste or</font>
<font face="Bamini">  (c) ml;ltizapypue;J ePf;fg;gl;l ,dk; :</font>
<font face="arial" size=2>        Denotified Tribes</font>
<font face="Bamini">   	khzth;</font><font face="arial">/</font><font face="Bamini">khztpah; Nkw;Fwpg;gpl;l Ie;J gphpTfspy; VjhtJ 
	xd;iwr rhh;e;jtuhf ,Ue;jhy; me;j gphpTf;F vjpNu 
	"Mk;" vd;W vOj Ntz;Lk;.</font>
<font face="arial" size=2>         If the belongs to any one of the five catagories mentioned
        above. Write "Yes" against the relevent column:</font></pre>
<td align=center valign="top">
<?php
$a = "";
$sc="";
$st="";
$bc="";
$mbc="";
$other="";

if($comm=="OC")
$other="Yes, OC Category";
else
if($comm=="BC")
$bc="<br><br>Yes, Backward Class";
else if($comm=="BC Muslim")
$bc="<br><br>Yes, Backward Class Muslim";
else
if($comm=="SC")
$sc="Yes, Scheduled Caste";
else
if($comm=="ST")
$sc="Yes, Scheduled Tribe";
else
if($comm=="MBC")
$mbc="<br><br><br>Yes, Most Backward Class";
else
if($comm=="DNC")
$mbc="<br><br><br>Yes, Most Backward Class";


echo "<br>$a<br><br>$sc$st<br><br>$bc<br><br>$mbc<br><br>$other";
?>
</pre>
</td>
</tr> 
<tr style="line-height:30px;"><td><pre>6. <font face="Bamini">ghypdk; :</font>
<font face="arial" size=2>      Sex :</font></pre></td>
<td align=center><b><center><?php echo strtoupper($sex); ?></center></td>
</tr>
<tr style="line-height:30px;"><td><pre><font face="Bamini">7.   gpwe;j Njjp (vz;zpYk; vOj;jpYk;) :
      (khzth; Nrh;f;if gjpNtl;by; cs;sgb)</font>
<font face="arial" size=2>      Date of Birth as entered in the Admission Register
      in figures and words</font> </pre></td>  
<td align=center><b><center><?php

list($d,$m,$y)=explode("-",$dob);
$d2 = convertNumber($d);
$m2 = convertNumber($m);
$y2 = convertNumber($y);


echo "$dob <br> $d2~$m2~$y2"; ?></center></td>
</tr>
<tr style="line-height:30px;"><td><pre><font face="Bamini">8.   clypy; mike;j milahsf; Fwpfs; :</font>
<font face="arial" size=2>      Personal Marks of Identification</font>
</td>
<td align=center><?php list($m1, $m2) = explode(",", $tags);?><font face="Bamini">   (m)</font><font face="arial">(a)</font><?php echo strtoupper($m1);?><br><font face="Bamini">   (M)</font><font face="arial">(b)</font><?php echo strtoupper($m2);	 ?>
</pre></td></tr>
<tr style="line-height:20px;">
<td><pre><font face="Bamini">9.  fy;Y}hpapy; Nrh;f;fg;gl;l Njjp kw;Wk; Nrh;f;fg;gl;l tFg;G
    (tUlj;jpw;F vOj;jhy; vOjTk;)</font>
<font face="arial" size=2>    Date of admission and Class in which admitted
    (the year to be entered in words)</font><pre></td>
<td align=center><center>
<?php
$da = convertNumber($batch);
echo "<b>".strtoupper($doa)."<br>".$da."<br>";
?>
<br></td>
</tr>
<tr style="line-height:20px;"><td><pre><font face="Bamini">10. (m) khzth; fy;Y}hpia tpl;L ePq;Fk; fhyj;jpy; 
           gapd;W te;j tFg;G (vOj;jhy;)</font>
<font face="arial" size=2>      (a) Class in which the pupil was studying at the time of
           leaving (in words)</font><br>
<font face="Bamini">      (M) Njh;e;njLf;fg;gl;l ghlk; kw;Wk; Jizg;ghlk; :</font>
<font face="arial" size=2>      (b)   The course offered  Main and Ancillary </font><br>
<font face="Bamini">      (,) gFjp 1,y; Njh;e;njLf;fg;gl;l nkhop:</font>
<font face="arial" size=2>      (c)   Language offered under Part-1</font><br>
<font face="Bamini">      (<) gapw;W nkhop :</font>
<font face="arial" size=2>      (d)  Medium of Instruction</font></pre>
</td>
<td align=center><pre>
<?php echo "<b>".strtoupper($sublev).
"<br><br><br><br><br>".strtoupper($aucsub)."<br><br><br>".strtoupper($part1)."<br><br><br>".strtoupper($medium)."<br>";?>
</pre></td>
<tr  style="line-height:20px;"><td>
<pre><font face="Bamini">11.  fy;Y}hpf;Fr; nrYj;jNtz;ba fl;lz njhif midj;ijAk;
      khzth; nrYj;jp tpl;lhuh?</font>
<font face="arial" size=2>      Whether the student has paid all the fees due to the college</font>

</pre></td>
<td align=center><?php echo strtoupper($paid);?></td>
</tr>
<tr style="line-height:20px;"><td>
<pre><font face="Bamini">12.  khzth; gbg;Gjtpj; njhif my;yJ fy;tpr; rYif vJTk;
      ngw;wtuh ? (mjd; tptuj;ij Fwpg;gpLj):  </font>
<font face="arial" size=2>      Whether the student was in receipt of any scholarship (Nature of
       the Scholarship to be specified) or any Educational Concessions :       </font>
</pre></td> 
<td align=center><?php echo strtoupper($scholar);?></td></tr>
<tr><td><pre><font face="Bamini">13.  khzth; fy;tpahz;by; kUj;Jt Ma;Tf;Fr; nrd;whuh ?
      (Kjy; jlit my;yJ mjw;F Nky; Fwpg;gpl;L vOjTk;)   </font>
<font face="arial" size=2>      Whether the student as undergone medical inspection if any 
      going the academic year (first or repeat to be specified) :              </font>
</pre></td> 
<td align=center><?php echo strtoupper($medical);?></td></tr>
<tr style="line-height:20px;"><td><pre><font face="Bamini">14.  khzth; fy;Y}hpia tpl;L tpyfpa ehs; :     </font>
<font face="arial" size=2>      Date of which the student actually left to the college :  </font></pre></td>     
<td align=center><?php echo strtoupper($dol);?></td></tr>
<tr><td><pre><font face="Bamini">15.  khzthpd; xOf;fKk;> gz;Gk; :    </font>
<font face="arial" size=2>      The student Conduct and Character :                      </font>
</pre></td> 
<td align=center><?php echo strtoupper($char);?></td></tr>
<tr style="line-height:20px;"><td><pre><font face="Bamini">16.  ngw;Nwhh; my;yJ ghJfhtyh; khzthpd; khw;Wr; rhd;wpjo; Nfhhp
      tpz;zg;gj;j ehs; :   </font>
<font face="arial" size=2>      Date on which application for Transfer Certificate was made on
      behalf of the student by his parent or guardian :                    </font>
</pre></td> 
<td align=center><?php echo strtoupper($apply);?></td></tr>
<tr style="line-height:20px;"><td><pre><font face="Bamini">17.  khw;Wr; rhd;wpjopd; ehs; : </font>
<font face="arial" size=2>      Date of the Transfer Certificate :             </font>
</pre></td> 
<td align=center><?php echo strtoupper($idate);?></td></tr>
<tr style="line-height:20px;"><td><pre><font face="Bamini">18.  gbg;Gf; fhyk; : </font>
<font face="arial" size=2>      Course of Study :             </font>
</pre></td> 
<td align=center><?php echo strtoupper($noy);?> Year(s)</td></tr>
</table>
<table  border=1 align=center cellspacing=0 width=80%>
<tr><td colspan=5><hr size=3></td></tr>
<tr align=center ><td><font face="bamini">fy;Y}hpapd; ngah;</font><br>
<font face="arial">Name of the College</font></td>
<td><font face="bamini">fy;tp Mz;Lfs;</font><br>
<font face="arial">Academic Year</font></td>
<td><font face="bamini">gbj;j tJg;G</font><br>
<font face="arial">Classes studied</font></td>
<td><font face="bamini">Kjy; nkhop</font><br>
<font face="arial">First language</font></td>
<td><font face="bamini">gapw;W nkhop</font><br>
<font face="arial">Medium of Instruction</font></td>
</tr>
<tr><td colspan=5><hr size=3></td></tr>
<tr align="center" height=60>
<td><b>GOVT. ARTS COLLEGE<br>PARAMAKUDI-623701<br><b>Ramanathapuram</td>
<td><?php echo strtoupper($academic);?></td>

<td><b><?php echo strtoupper($course);?></b></td>
<td><b><?php echo strtoupper($flang);?></b></td>
<td><b><?php echo strtoupper($tmedium);?></b></td>
</tr>
<tr><td colspan=5><hr size=3></td></tr>
</table>
<table width=100% align=center><br><br>
<br><tr><td><pre><font face="Bamini"> 		19. fy;Y}hp Kjy;thpd ifnahg;gk; : 
		     (ehs; kw;Wk; Kj;jpiuAld;) :   </font></td>
<td></td>
<td align=center><font face="arial" size=2>    <b>  Signature of the Principle with date and with College Seal</b>               </font></td></tr>
</pre></td> </table>
<pre>
<font face="Bamini">
	Fwpg;G : (1) ,r;rhd;wpjopy; mopj;jy;fs; kw;Wk; ek;gfkw;w my;yJ Nkhrbahd jpUj;jq;fs; nra;tJ rhd;wpjio uj;J nra;a top tFg;gjhFk;.</font><br>
<font face="arial" size=2>			Erasures and unauthenticated or fraudulent alterations in the certificate will lead to its cancellation.</font>
<br><font face="Bamini">
		    (2) fy;Y}hp Kjy;tuhy; ikapdhy; ifnahg;gkpl Ntz;Lk;. gjpT nra;ag;gl;l tptuq;fs; rhpahdit vd;gjw;F mtNu nghWg;ghdth;.</font><br>
<font face="arial" size=2> 			Should be signed in ink by the Head of the Institution who will be held responsible for the correctness of the entries.</font><br>
<font face="Bamini"> 		  (3) ngw;Nwhh; my;yJ ghJfhtyh; mspf;Fk; cWjp nkhop.<br>
<font face="arial" size=2> 			Declaration by the Parent or guardian.</font><br><br>
<font face="Bamini"> 			NkNy 2 Kjy; 8 tiuapYs;s ,dq;fSf;nfdg; gjpT nra;ag;gl;Ls;s tptuq;fs; rhpahdit vd;Wk;> vjph;fhyj;jpy; mtw;wpy;  khw;wk; vJTk; Nfl;fkhl;Nld; vd;Wk; ehd; cWjpaspf;fpd;Nwd;.</font><br>
<font face="arial" size=2> 			I hereby declare that the particulars recorded against items 2 to 8 are correct and that no change will be demanded by me in future.</font>
</pre>
<pre><br><br><br><b><font face="Bamini"><p> 																					ngw;Nwhh; my;yJ ghJfhthpd; ifnahg;gk;</font>
<font face="arial" size=2><p>													 					 		 							Signature of the Parent/Guardian.</font></b></pre>


<br>
</form>
</div>


<?php 
}
else {
header("Location:index.php");
}
?>