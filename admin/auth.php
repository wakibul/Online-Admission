<?php
 ob_start();
 session_start();
include('../include/dbc.php');
include('../include/functions.php');
//include('../include/random.php');
function filter1($data) {
	$data = trim(htmlentities(strip_tags($data)));
	return $data;
}
header('X-FRAME-OPTIONS: DENY');
foreach($_POST as $key => $value) {
$data[$key] = filter1($value);
} 
 	$errmsg_arr = array();	
	$errflag = false;

if (($data['username'] =="") || ($data['password']==""))
{
 		$errmsg_arr[] = 'Blank is not Allowed in Mandetary Field';
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: index.php");
  		exit();
  }
  ?>
<script language="javascript" src="js/md5.js">
</script>
<?php
  $user = $_POST['username'];
  $pass = $_POST['password'];  
  $regdate= date("Y/m/d");
  $ip = $_SERVER['REMOTE_ADDR'];
  $hostaddress = $_SERVER['REMOTE_ADDR'];
  $rs_stime = mysqli_query($conn,"select count(*) as tlock from `lastlogin` where `user` ='$user' and status ='failed' and date='$regdate'") or die(mysql_error());
  list($tlock ) = mysqli_fetch_row($rs_stime);
  if($tlock >= '10')
  {
  $rs_ltime = mysqli_query($conn,"select ltime from `lastlogin` where `user` ='$user' and status ='failed' and date='$regdate' order by id desc limit 1 ") or die(mysql_error());
  list($ltime ) = mysqli_fetch_row($rs_ltime);
  if(time()-$ltime < 60*20){
   $errmsg_arr[] = 'your account has been locked for 20 Minutes due to incorrect logon attempts.<br/> please try after  20 Minutes';
  $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
  session_write_close();
  header("location: index.php");
   exit();
   }
   }
	 
  $comp2= array("$user","$pass");
foreach($comp2 AS $comp3)
{
if (trim($comp3)=="")
{
 
?>
<script>
alert ("Blank is not Allowed in Mandetary Field");
window.location = "index.php";
</script>
<?php exit(0);
}}
$user1=array("$user");
$symb1= array("`","~","!","#","$","%","^","&","*","(",")","+","=","{","}","[","]","|",":",";","\"","'","<",">",",","?","\\");
foreach($user1 AS $user2)
{
foreach($symb1 AS $try1)
{
$pos1 = strpos($user2,$try1 );
if($pos1 !== false)
{
 $errmsg_arr[] = 'Specail charecters are not allowed here';
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: index.php");
  		exit();
		 }}} 
if (($data['username'] =="") || ($data['password']==""))
{
 		$errmsg_arr[] = 'Blank is not Allowed in Mandetary Field';
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		 mysql_close($conn);
		header("location: index.php");
  		exit();
  }
 if (($data['username'] !="") || ($data['password']!=""))
	{
 		 $user=$data['username'];
		 $pass=$data['password'];
 		 $salt=$_SESSION['nonce'];
		//$sql = "Select * from employee_mst where BINARY email_address ='$user'"; 
$sql= "Select * from tbllogin where BINARY UserName ='$user' and 	UserStatus='1'"; 
$result = mysqli_query($conn,$sql) or die (mysqli_error());
$bt=0;
 if ($result)
{
while($row = mysqli_fetch_array($result))  
{
	 $temp=$row['UserPwd'].$salt;

	 //echo md5($temp);
	 //exit();
	if (($user == $row['UserName']) && ($pass == md5($temp)))
	{
	    session_start();
	    session_regenerate_id (true);
		$_SESSION['user_id']= $row['UserID'];
		$_SESSION['username'] = $row['UserName'];	
		$_SESSION['user_level'] = $row['user_level'];	
		$_SESSION['UserGrp'] = $row['UserGrp'];
			   
		$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
 		$stamp = time();
		$ckey = GenKey();
		mysqli_query($conn,"update tbllogin set `ctime`='$stamp', `ckey` = '$ckey' ,stime='$stamp' where UserID='".$_SESSION['user_id']."'") or die(mysql_error());
 				  setcookie("user_id", $_SESSION['user_id'], time()+60*60*24*COOKIE_TIME_OUT, "/",'',httpOnly);
				  setcookie("user_key", sha1($ckey), time()+60*60*24*COOKIE_TIME_OUT, "/",'',httpOnly);
				  setcookie("user_name",$_SESSION['username'], time()+60*60*24*COOKIE_TIME_OUT, "/",'',httpOnly);
				  mysqli_query($conn,"INSERT INTO lastlogin(user,date,ip,atmpt,status) VALUES('$user' ,'$regdate','$hostaddress','0','success')") or die(mysql_error());
				 header("location: dashboard");	
				 // echo "successfull";
 				$bt=1;
		}
    }
 } //while ends

if ($bt == 0)
        {
  ?>
                                
<?php 
$ltime = time();
mysqli_query($conn,"INSERT INTO lastlogin(user,date,ip,atmpt,status,ltime) VALUES('$user' ,'$regdate','$hostaddress','1','failed','$ltime')") or die(mysqli_error());
	 $errmsg_arr[] = 'Incorrect User name and Password not allowed';
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header("location: index.php");
exit();     
}
?>
<html>
</html>
<?php }
else {exit(0);}
?>
