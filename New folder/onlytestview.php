<?php
//require("head.php");
include("includes/db.conn.php");

$admno= $_GET['id'];



$res=mysql_query("select * from application1 where admno='$admno'");
while($row=mysql_fetch_array($res))
{
 $admno =$row["admno"];
  $name=$row["name"];
  $sex=$row["sex"];
  $dob1=$row["dob"];
 $y=substr($dob1,0,4);
 $m=substr($dob1,5,2);
 $d=substr($dob1,8,2);
 $dob="$d-$m-$y";

     $guide=$row["guide"];
  $address=$row["address"];
  $nationality=$row["nationality"];
  $religion=$row["religion"];
  $community=$row["community"];
  $caste=$row["caste"];
  $school=$row["school"];

	$dist = $row['dist'];

  $course=$row["course"];  
  $doa=$row["doa"];

$y1=substr($doa,0,4);
 $m1=substr($doa,5,2);
 $d1=substr($doa,8,2);
 $doa1="$d1-$m1-$y1";

  $shift=$row["shift"];

   $id1 = $row["id1"];
   $id2 = $row["id2"];

   $yy = date('Y');

   $yea = $y1 +3;

    if($yea<=$yy)
     $yr = "3 years";
   else
    $yr = "Dis-continue";

  //echo "$yy";

}




?>


<center>
<img src="assets/img/tc.jpg" width=500 height=150> <br>

</center>
<pre><font face="SunTommy">	thpir vz;          						 Nrh;f;if vz;</pre></font>
<pre><font face="arial">    	        Serial No. 										               		              Admission No. &nbsp;&nbsp;&nbsp; <font size=5> <? echo "$admno";?></pre></font><br><br>
<table width=90% border=0 align=center cellspacing=0>
<tr>
<td width=50%><pre>1. <font face="SunTommy">(m) fy;Y}hpapd; ngah;  </font><br>
<font face="arial" size=2>            Name of the College</font><br>
<font face="SunTommy">  (M) khtl;lj;jpd; ngah; </font><br>
<font face="arial" size=2>            Name of the District </font></pre>
</td>
<td width=50% align=center><b>GOVT. ARTS COLLEGE<br>PARAMAKUDI-623701<br><br><br>
<b><? echo "$dist"; ?></td>
</tr>
<tr>
<td><pre>2. <font face="SunTommy">khzth; ngah;(jdpj;jdp vOj;Jf;fspy;) </font><br>
<font face="arial" size=2>     Name of public (in BLOCK LETTERS)<br>    (as entered in +2 or equivalent certificate)</font>
</td>
<td><center><b><? echo "$name"; ?></center></td>
</tr>

<tr>
<td><pre>3. <font face="SunTommy">je;ij my;yJ jhahhpd; ngah;</font><br>
<font face="arial" size=2>     Name of Father or Mother</font></pre></td>
<td><b><center><? echo "$guide"; ?></center></td>
</tr>
<tr>
<td><pre>4. <font face="SunTommy">Njrpa ,dk;> rkak; kw;Wk; rhjp</font><br>
<font face="arial" size=2>     Nationality Religion and Caste</font></pre></td>
<td><center><b><? echo "$nationality  <br>$religion <br> $caste"; ?></center></td>
</tr>
<tr>
<td><pre>5. <font face="SunTommy">,dk;</font><font face="arial" size=2>(community)</font>
<font face="SunTommy">  mtd;</font><font face="arial" size=2>/</font><font face="SunTommy">mts; gpd;tUk; Ie;J gphpTfspy;<br>    vitNaDk; xd;iwr; rhh;e;jtuh</font><font face="arial" size=2>?</font> 
<font face="arial" size=2>    Whether he/she belongs to-</font>
<font face="SunTommy">  (m) Mjp jpuhtplh; my;yJ goq;Fb :</font>
<font face="arial" size=2>             Adi Dravidar (Shcheduled Caste or Schedule Tribe)</font>
<font face="SunTommy">  (M) gpd;jq;fpa tFg;G :</font>
<font face="arial" size=2>             Backward Class</font>
<font face="SunTommy">  (,) kpfTk; gpd;jq;fpa tFg;G :</font>
<font face="arial" size=2>            Most Backward Class</font>
<font face="SunTommy">  (<) Mjpjpuhtplh; ,dj;jpypUe;J fpwpj;Jt<br>     kjj;jpw;F khwpath my;yJ  :</font>
<font face="arial" size=2>           Converted to Christianity from Scheduled Caste or</font>
<font face="SunTommy">  (c) ml;ltizapypue;J ePf;fg;gl;l ,dk; :</font>
<font face="arial" size=2>              Denotified Tribes</font>
<font face="SunTommy">   khzth;</font><font face="arial">/</font><font face="SunTommy">khztpah; Nkw;Fwpg;gpl;l Ie;J gphpTfspy; VjhtJ 
   xd;iwr rhh;e;jtuhf ,Ue;jhy; me;j gphpTf;F vjpNu 
   "Mk;" vd;W vOj Ntz;Lk;.</font>
<font face="arial" size=2>       If the belongs to any one of the five catagories mentioned
      above. Write "Yes" against the relevent column:</font></pre>
<td align=center valign="top">
<?
$a = "";
$sc="";
$st="";
$bc="";
$mbc="";
$other="";

if($community=="OC")
$other="OC Category";
else
if($community=="BC")
$bc="Backward Class";
else
if($community=="SC")
$sc="Scheduled Caste";
else
if($community=="ST")
$sc="Scheduled Tribe";
else
if($community=="MBC/DNC")
$mbc="Most Backward Class";


echo "<br>$a<br><br>$sc$st<br><br>$bc<br><br>$mbc<br><br>$other";
?>
</pre>
</td>
</tr> 
<tr><td><pre>6.   <font face="SunTommy">ghypdk; :</font>
<font face="arial" size=2>         Sex :</font></pre></td>
<td align=center><b><center><? echo "$sex"; ?></center></td>
</tr>
<tr><td><pre><font face="SunTommy">7.   gpwe;j Njjp (vz;zpYk; vOj;jpYk;) :
    (khzth; Nrh;f;if gjpNtl;by; cs;sgb)</font>
<font face="arial" size=2>         Date of Birth as entered in the Admission Register
	 in figures and words</font> </pre></td>
<td align=center><b><center><?

$d2 = convertNumber($d);
$m2 = convertNumber($m);
$y2 = convertNumber($y);


 echo "$dob <br> $d2 - $m2 - $y2"; ?></center></td>
</tr>
<tr><td><pre><font face="SunTommy">8.  clypy; mike;j milahsf; Fwpfs; :</font>
<font face="arial" size=2>       Personal Marks of Identification</font>
<font face="SunTommy">   (m)</font><font face="arial">(a)</font><br>
<font face="SunTommy">   (M)</font><font face="arial">(b)</font>
</td>
<td align=center>

<? echo "$id1"; ?> <br><br>
<? echo "$id2"; ?>
</pre></td></tr>
<tr>
<td><pre><font face="SunTommy">9.  fy;Y}hpapy; Nrh;f;fg;gl;l Njjp kw;Wk; Nrh;f;fg;gl;l tFg;G
   (tUlj;jpw;F vOj;jhy; vOjTk;)</font>
<font face="arial" size=2>      Date of admission and Class in which admitted
      (the year to be entered in words)</font><pre></td>
<td align=center><center>
<? 
$da = convertNumber($y1);

echo "$doa1 <br> $da"; ?> <br></td>
</tr>
<tr><td><pre><font face="SunTommy">10. (m) khzth; fy;Y}hpia tpl;L ePq;Fk; fhyj;jpy; 
       gapd;W te;j tFg;G (vOj;jhy;)</font>
<font face="arial" size=2>       (a)    Class in which the pupil was studying at the time of
               leaving (in words)</font><br>
<font face="SunTommy">   (M) Njh;e;njLf;fg;gl;l ghlk; kw;Wk; Jizg;ghlk; :</font>
<font face="arial" size=2>        (b)   The course offered  Main and Ancillary </font><br>
<font face="SunTommy">   (,) gFjp 1,y; Njh;e;njLf;fg;gl;l nkhop:</font>
<font face="arial" size=2>       (c)   Language offered under Part-1</font><br>
<font face="SunTommy">   (<) gapw;W nkhop :</font>
<font face="arial" size=2>       (d)  Medium of Instruction</font></pre>
</td>
<td align=center><pre>
<input type="text" size=30>



<input type="text" size=30>



<input type="text" size=30>



<input type="text" size=30>
</pre></td>
<tr><td>
<pre><font face="SunTommy">11.  fy;Y}hpf;Fr; nrYj;jNtz;ba fl;lz njhif midj;ijAk;
    khzth; nrYj;jp tpl;lhuh?</font>
<font face="arial" size=2>        Whether the student has paid all the fees due to the college</font>

</pre></td>
<td align=center><input type="text" size=30></td>
</tr>
<tr><td>
<pre><font face="SunTommy">12.  khzth; gbg;Gjtpj; njhif my;yJ fy;tpr; rYif vJTk;
    ngw;wtuh ? (mjd; tptuj;ij Fwpg;gpLj):  </font>
<font face="arial" size=2>         Whether the student was in receipt of any scholarship (Nature of
         the Scholarship to be specified) or any Educational Concessions :       </font>
</pre></td> 
<td align=center><input type="text" size=30></td></tr>
<tr><td><pre><font face="SunTommy">13.  khzth; fy;tpahz;by; kUj;Jt Ma;Tf;Fr; nrd;whuh ?
    (Kjy; jlit my;yJ mjw;F Nky; Fwpg;gpl;L vOjTk;)   </font>
<font face="arial" size=2>        Whether the student as undergone medical inspection if any 
        going the academic year (first or repeat to be specified) :              </font>
</pre></td> 
<td align=center><input type="text" size=30></td></tr>
<tr><td><pre><font face="SunTommy">14.  khzth; fy;Y}hpia tpl;L tpyfpa ehs; :     </font>
<font face="arial" size=2>         Date of which the student actually left to the college :  </font></pre></td>     
<td align=center><input type="text" size=30></td></tr>
<tr><td><pre><font face="SunTommy">15.  khzthpd; xOf;fKk;> gz;Gk; :    </font>
<font face="arial" size=2>        The student Conduct and Character :                      </font>
</pre></td> 
<td align=center><input type="text" size=30></td></tr>
<tr><td><pre><font face="SunTommy">16.  ngw;Nwhh; my;yJ ghJfhtyh; khzthpd; khw;Wr; rhd;wpjo; Nfhhp
    tpz;zg;gj;j ehs; :   </font>
<font face="arial" size=2>         Date on which application for Transfer Certificate was made on
         behalf of the student by his parent or guardian :                    </font>
</pre></td> 
<td align=center><input type="date" size=30></td></tr>
<tr><td><pre><font face="SunTommy">17.  khw;Wr; rhd;wpjopd; ehs; : </font>
<font face="arial" size=2>         Date of the Transfer Certificate :             </font>
</pre></td> 
<td align=center><input type="date" size=30></td></tr>
<tr><td><pre><font face="SunTommy">18.  gbg;Gf; fhyk; : </font>
<font face="arial" size=2>        Course of Study :             </font>
</pre></td> 
<td align=center><input type="text" size=30 value='<? echo $yr; ?>'></td></tr>
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
<tr height=60>
<td></td><td></td><td></td><td></td><td></td>
</tr>
<tr><td colspan=5><hr size=3></td></tr>
</table>
<table width=80% align=center>
<tr><td><pre><font face="SunTommy">19. fy;Y}hp Kjy;thpd ifnahg;gk; : 
   (ehs; kw;Wk; Kj;jpiuAld;) :   </font>
<font face="arial" size=2>      Signature of the Principle with date and with College Seal :               </font></td>
<td></td>
<td align=right><input type="text" size=30></td></tr>
</pre></td> </table>
<pre>
<font face="bamini">
Fwpg;G : (1) ,r;rhd;wpjopy; mopj;jy;fs; kw;Wk; ek;gfkw;w my;yJ Nkhrbahd jpUj;jq;fs; nra;tJ rhd;wpjio uj;J nra;a
	     top tFg;gjhFk;.</font>
<font face="arial" size=2>Erasures and unauthenticated or fraudulent alterations in the certificate will lead to its cancellation.</font>
<font face="bamini"> (2) fy;Y}hp Kjy;tuhy; ikapdhy; ifnahg;gkpl Ntz;Lk;. gjpT nra;ag;gl;l tptuq;fs; rhpahdit vd;gjw;F
                     mtNu nghWg;ghdth;.</font>
<font face="arial" size=2> Should be signed in ink by the Head of the Institution who will be held responsible for the correctness of the entries.</font>
<font face="bamini"> (3) ngw;Nwhh; my;yJ ghJfhtyh; mspf;Fk; cWjp nkhop.
<font face="arial" size=2> Declaration by the Parent or guardian.</font><br><br>
<font face="bamini"> NkNy 2 Kjy; 8 tiuapYs;s ,dq;fSf;nfdg; gjpT nra;ag;gl;Ls;s tptuq;fs; rhpahdit vd;Wk;> vjph;fhyj;jpy; mtw;wpy; 
khw;wk; vJTk; Nfl;fkhl;Nld; vd;Wk; ehd; cWjpaspf;fpd;Nwd;.</font>
<font face="arial" size=2> I hereby declare that the particulars recorded against items 2 to 8 are correct and that no change will be demanded by me in future.</font>
</pre>
<font face="bamini"><p align=right> ngw;Nwhh; my;yJ ghJfhthpd; ifnahg;gk;</font><br>
<font face="arial" size=2><p align=right> Signature of the Parent/Guardian.</font>


<br>
<center>
<input type="submit" value="Submit" name="submit">
<input type="reset" value="Reset" name="reset">
</center>
</form>