<?php
include '../includes/dblogin.php'; 


//successfuly get multiple data from for loop use ajax
$ndclid = 8201;
$nddtentered = $_POST["nddtentered"];
$ndaccnum = $_POST["ndaccnum"];
$ndlname = $_POST["ndlname"];
$ndfname = $_POST["ndfname"];
$nddtaccopened = $_POST["nddtaccopened"];
$ndprincipal = $_POST["ndprincipal"];
$ndowing = $_POST["ndowing"];
$nddtaccpastdue = $_POST["nddtaccpastdue"];
$ndrlname = $_POST["ndrlname"];
$ndrfname = $_POST["ndrfname"];
$ndraddress = $_POST["ndraddress"];
$ndrcity = $_POST["ndrcity"];
$ndrstate = $_POST["ndrstate"];
$ndrzipcode = $_POST["ndrzipcode"];
$ndrhphone = $_POST["ndrhphone"];
$ndrwphone = $_POST["ndrwphone"];
$ndcomment = $_POST["ndcomment"];
$ndrssn = $_POST["ndrssn"];
$ndltseries = 'STC';
$ndcollreason = 13;

//print_r($ndaccnum);
echo "DONE with ".$nddtentered;
echo "DONE with ".$ndaccnum;
echo "DONE with ".$ndlname;
echo "DONE with ".$ndfname;
echo "DONE with ".$nddtaccopened;
echo "DONE with ".$ndprincipal;
echo "DONE with ".$ndowing;
echo "DONE with ".$nddtaccpastdue;
echo "DONE with ".$ndrlname;
echo "DONE with ".$ndrfname;
echo "DONE with ".$ndraddress;
echo "DONE with ".$ndrcity;
echo "DONE with ".$ndrstate;
echo "DONE with ".$ndrzipcode;
echo "DONE with ".$ndrhphone;
echo "DONE with ".$ndrwphone;
echo "DONE with ".$ndcomment;
echo "DONE with ".$ndrssn;

//insert to DB with ndclid = 8201
////WORKKKKK!!!!
/*$query = "INSERT INTO a_newdebtors (ndclid,nddtentered,ndaccnum,ndlname,ndfname,nddtaccopened,ndprincipal,ndowing,nddtaccpastdue,ndrlname,ndrfname,ndraddress,ndrcity,ndrstate,ndrzipcode,ndrhphone,ndrwphone,ndcomment,ndrssn,ndraddrsearch,ndrssnsearch,ndltseries,ndcollreason,ndpromocode,nddbid,ndmname,ndrmname,ndrcountry,ndremail,ndrcphone,ndrfphone,ndrdobdate,ndinterest,ndcollfee)
		VALUES ('".$ndclid."','".$nddtentered."','".$ndaccnum."','".$ndlname."','".$ndfname."','".$nddtaccopened."','".$ndprincipal."','".$ndowing."','".$nddtaccpastdue."','".$ndrlname."','".$ndrfname."','".$ndraddress."','".$ndrcity."','".$ndrstate."','".$ndrzipcode."','".$ndrhphone."','".$ndrwphone."','".$ndcomment."','".$ndrssn."','0','0','".$ndltseries."','".$ndcollreason."','0','','','','','','','','0000-00-00','','')";
echo $query;
		
$qresult = mysql_query($query);
echo $qresult;
// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$qresult) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
}else if ($qresult>0)
{
    echo 'successful';
}*/

?>



