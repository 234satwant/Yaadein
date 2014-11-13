<?php 
include("db.php");
include("raiSED.php");


$OneBranch ='Production';
$PrintFlag = 0 ;                                                         // Print messages during development, if it is !=0

$PageWidth = 17.8; $PageHeight = 22.13;                                     //Page specifications

$CommentX = 1; $CommentY = -6; $CommentWidth = "8.5cm";               //Comment Specifications

$PerInfoWidth = "5.5cm";						    //Basic Info. Width

$GapX = "0.0"; $Gap2X = "1.2" ;
$CoorX ="-1.2" ;

$PhotoX = 1; $PhotoY = 0; $PhotoWidth = "2.2cm";$PhotoHeight="3.5cm";   //Photo specifications

$itemInSequence = 8 ;                                                  // Name, FN, MN, address, Email etc

$pagecounter=24;

$tox= 0; $toy = 0; 

$OffSetX = 0; $StartX = 0 ; $ScaleX = 1;                                 //X-coord of the page
$OffSetY = 0; $StartY = $PageHeight; $ScaleY = 1;                      //Y-coord of the page

$Columns = 2; $Rows = 5; $RecordPerPage = $Columns * $Rows;             //No. of rows,columns and records on one page

$RecordFrom = 0;

$BoxX = $PageWidth / $Columns; $BoxY = $PageHeight / $Rows;		// X and Y coord. of a box of single record


for ($i = 0 ; $i < 20 ; $i++)
{
 $flagSED[$i] = 0;
}

$flagSED[5] = 1;               // Perfoem SED on address1
$flagSED[6] = 1;              // Perfoem SED on email
$flagSED[7] = 1;             // Perfoem SED on contact
$flagSED[8] = 1;            // Perfoem SED on comments
$flagSED[9] = 1;           // Perfoem SED on Photo



$PhotoPath = "/var/www/html/Yaad/Yaadein/uploads/resized";
include("querydav.php");

//$sqlquery .= "limit 10 ";
//$Onebranch=$row[11];
//echo"\chapter*{{$OneBranch}}";
//echo"\pagebreak";

// echo $sqlquery;
//$sqlquery .= " branch = 'Civil' ";
//`$sqltmp = $sqlquery;
$result = mysql_query($sqlquery);
$rows = mysql_num_rows($result);
$cols = mysql_num_fields($result);

$PagePerBranch = ceil( $rows / $RecordPerPage);




for ($page = 0; $page < $PagePerBranch; $page++)     //to give pge break AFTER EACH BRANCH
{

// $RecordPerPage = 2;

$sqlQP2 = " order by classrollno limit 
$RecordFrom , $RecordPerPage ";  
$sqlQP1 = $sqltmp . $sqlQP2 ;

$result = mysql_query( $sqlQP1 );

$rows = mysql_num_rows($result);  
$cols=mysql_num_fields($result);  
if ( $PrintFlag !=0 ) echo $sqlQP1;
if ( $PrintFlag !=0 ) {echo "\n Row $rows \n $cols \n Page $page \n"; echo "";}

echo "\\begin{pspicture}($PageWidth,$PageHeight)";  
echo "\\rput[c|](8.9,23){{\includegraphics[width=22.2cm]{headfoot/sgeachpehead.eps}}}";

echo "\\\\";


if($pagecounter%2==0)
{

echo "\\psline{-}(-2.8,-1.73)(-2.2,-1.73)";
echo "\\\\";
echo "\\psline{-}(-1.5,-2.33)(-1.5,-2.93)";
echo "\\\\";
}
else
{
echo "\\psline{-}(20,-1.73)(20.6,-1.73)";
echo "\\\\";
echo "\\psline{-}(19.4,-2.33)(19.4,-2.93)";
echo "\\\\";


}


$i = 0;
while ($i<$Rows)
{
$j = 0;
while ($j<$Columns)
{

if ( $PrintFlag !=0 ) echo "row: $i col : $j";

$BoxI1 = ($StartX +$j * $BoxX + $OffSetX)*$ScaleX ;
$BoxJ1 = ($StartY - $i * $BoxY + $OffSetY)*$ScaleY ;
$BoxI2 = ($StartX +($j+1) * $BoxX + $OffSetX)*$ScaleX ;
$BoxJ2 = ($StartY - ($i+1) * $BoxY + $OffSetY)*$ScaleY ;
$ii=$i+1; $jj=$j+1; 
//echo "\\rput($BoxI1,$BoxJ1){(($ii) X($jj))}";
echo"\n";
// echo"\psframe[fillcolor=lightgray]($BoxI1,$BoxJ1)($BoxI2,$BoxJ2)"; echo "\n";
$j++;
}
$i++;
}

echo "\n";
$i = 0; $j=0;
while (
$row = mysql_fetch_row($result)
//$row = mysql_fetch_assoc($result)
)
{

//$SEDi = 0;
//while ($row[$SEDi]) // for each field
for ($SEDi = 0; $SEDi < $cols; $SEDi++)
{
    $rowRai[$SEDi] = $row[$SEDi];
 if ($flagSED[$SEDi] != 0)
 {
//  $SEDj = 0;
//echo " $row[$SEDi] \n";
//  while ($OrgText[$SEDj])
  for ($SEDj=0; $SEDj < 14 ; $SEDj++)
  { 


    if ( $PrintFlag !=0 )  echo " SEDj $SEDj | inside sed \n";
   $rowRai[$SEDi] = str_replace($OrgText[$SEDj] , $ReplacedText[$SEDj] , $rowRai[$SEDi]);
//   $SEDj++;
  }
if ( $PrintFlag !=0 )   echo " $rowRai[$SEDi] outside sed \n"; 
//  $SEDi++ ;

}
}
    
// ================================================================= Basic personal information =============

echo "\\\\";
if ( $PrintFlag !=0 ) echo "row: $i col : $j";
 
$BoxI1 = ($StartX +$j * $BoxX + $GapX + $OffSetX)*$ScaleX ;
$BoxJ1 = ($StartY - $i * $BoxY + $OffSetY)*$ScaleY ;
$BoxI2 = ($StartX +($j+1) * $BoxX + $OffSetX)*$ScaleX ;
$BoxJ2 = ($StartY - ($i+1) * $BoxY + $OffSetY)*$ScaleY ;
$ii=$i+1; $jj=$j+1; 

$item = 0;

$Bx[$item] = $BoxI1+$tox + $PhotoWidth + ( ( ($PageWidth / $Columns) - $PhotoWidth) / 2.) + $Gap2X;
$By[$item] = $BoxJ1+$item * $toy;
$tempCorr = $Bx[$item] + $CoorX ;
//echo "\\rput[t|]($tempCorr ,$By[$item])";
//echo "{\psframebox{\parbox[l]{{$PerInfoWidth}}{\\raggedright ";

for ($item = 0; $item < $itemInSequence; $item++)
{
//echo $rowRai[$item]; 
echo " ";
//echo " \\\\ \n";
}
//echo "}}}\n";

$Ix=$BoxI1+$PhotoWidth+2.5;

$Iy=$BoxJ1+$toy;

//echo "\\rput[t|]($Ix ,$Iy)";
//echo "{\psframebox*{\parbox[l]{{$PerInfoWidth}}{\\raggedright ";
$linegap=0.3;
$Bxx = $BoxI1+$PhotoWidth+3.; $Byy = $BoxJ1+$toy; //NAME


$row[2]=ucwords(strtolower($row[2]));
$row[2] = str_replace(" ","~",$row[2]);

$row[1]=ucwords(strtolower($row[1]));
$row[1] = str_replace(" ","~",$row[1]);

echo "\\rput[t|]($Bxx,$Byy){";
echo "{\psframebox[linecolor=white,linestyle=dotted,dotsep=100pt,linewidth=0pt]{\parbox[l]{{$PerInfoWidth}}{\\raggedright ";
//echo "Name: ";
echo ucwords(strtolower($row[0])); echo " ("; echo $row[3] ; echo  ")"; 
if ($row[11]=="M")
echo " S/o ";
else
echo " D/o ";echo $row[2]  ; echo  " and "; echo $row[1] ;
//echo "\\\\DoB: " ; echo date(' jS  F Y ', strtotime($row[5])); echo " ";
echo "\\\\DoB: "; echo $row[4];echo " ";
echo"\\";
echo " \mbox{";echo $rowRai[6],"}"; echo " "; echo"\\\\Ph. "; echo $rowRai[7]; echo "\\\\";

echo $rowRai[5];
echo "}";
echo "}}}\n";


// Coordinates of Photo and Comment ==================================================================


$Cnewx=$BoxI1+4*$PhotoWidth/2;
$Cnewy=$BoxJ1-3.45;

// Photo here

//$PhotoName = $rowRai[3];
$PhotoName = "S2014";
$PhotoName .= $rowRai[3];
$PhotoName .= ".eps";
$PhotoEPS = $PhotoName;
//$PhotoName = "S2014".$row[3];
//$PhotoEPS =  $PhotoName[0] . ".eps" ;
// ===================================================== Photo ===============
//$PhotoURL = $PhotoPath . $PhotoEPS ;
$PhotoURL = $PhotoEPS ;
//echo"\psframe*($Px1,$Py1)($BoxI1,$BoxJ1)";
 //echo "\n";

$Pnew1=$BoxI1+$PhotoWidth/2.;
$Pnew2=$BoxJ1-0.02;
echo "\\rput[t|]($Pnew1,$Pnew2)";
echo "{\psframebox[framesep=0pt,boxsep=false,linecolor=white]{\parbox[c]{{$PhotoWidth}}{\\raggedright ";
echo "{\includegraphics[width=$PhotoWidth]{{$PhotoURL}}";

//echo "{\includegraphics[width=$PhotoWidth]{{$PhotoURL}}";
//echo "{\includegraphics[width=$PhotoWidth]{{files/kinda.eps}}";
echo "}}}";
echo "}\n";

// ===================================================== Comment =================
//$Cnewx = $Pnew1*4;
echo "\\rput[t|]($Cnewx,$Cnewy)";
//echo "{\psframebox[framesep=1pt,boxsep=false,linewidth=0pt,linestyle=dotted,linecolor=white]{\parbox[t]{{$CommentWidth}}{ ";
echo "{\psframebox[framesep=1pt,boxsep=false,linecolor=white,linestyle=dotted,dotsep=100pt,linewidth=0pt]{\parbox[t]{{$CommentWidth}}{";
echo $rowRai[8]; 
echo "}}}\n";
$j++;
if ($j >= $Columns) { $j = 0;  $i++; }
}
echo "\\rput[c|](8.9,0){{\includegraphics[width=22.2cm]{headfoot/footer.eps}}}";

//echo $pagecounter;

echo "\\end{pspicture}";
//$pagecounter =$pagecounter++;
if ( ($page + 1 ) != $PagePerBranch) {echo "\n \pagebreak  \n";}

$RecordFrom += $RecordPerPage;
$pagecounter =$pagecounter + 1;
}

mysql_close();

?>
