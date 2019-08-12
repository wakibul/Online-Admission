<?php
date_default_timezone_set('Asia/Kolkata'); 	
function fillData($c,$fld,$tbl,$cond)
{
	global $conn;
		if($c == 1)
			$SqlB = "Select ".$fld." from ".$tbl." WHERE ".$cond;
		elseif($c == 2)
			$SqlB = "Select ".$fld." from ".$tbl;	
		elseif($c == 3)
			$SqlB = "Select distinct(".$fld.") from ".$tbl;
		elseif($c == 4)
			$SqlB = "Select distinct(".$fld.") from ".$tbl." WHERE ".$cond;			//if($tbl == "jh_tripbookingtrans")
		//echo $SqlB;			
			$resB = mysqli_query($conn,$SqlB);
			$xx = mysqli_num_fields($resB);
			$dispArray = array();
			if(mysqli_num_rows($resB))
				{
					$r=0;
					while($rowB = mysqli_fetch_array($resB))
						{
							for($c=0;$c<$xx;$c++) {
								$dispArray[$r][$c] = $rowB[$c];
							}
							$r++;
						}
				}
				return $dispArray;
}

function left($str, $length) {
     return substr($str, 0, $length);
}
function GenKey($length = 7)
{
  $password = "";
  $possible = "0123456789abcdefghijkmnopqrstuvwxyz"; 
  
  $i = 0; 
    
  while ($i < $length) { 

    
    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
       
    
    if (!strstr($password, $char)) { 
      $password .= $char;
      $i++;
    }

  }

  return $password;

}	
function filter($data) {
	$data = trim(htmlentities(strip_tags($data)));
	
	if (get_magic_quotes_gpc())
		$data = stripslashes($data);
	return $data;
}	

function logout()
{
global $conn;
if(isset($_SESSION['user_id']) || isset($_COOKIE['user_id'])) {
mysqli_query($conn,"update tbllogin set ckey= '', ctime= '' where UserID='".$_SESSION['user_id']."' OR  UserID = '".$_COOKIE[user_id]."'") or die(mysqli_error());
}			

/************ Delete the sessions****************/
unset($_SESSION['user_id']);
unset($_SESSION['username']);
unset($_SESSION['user_level']);
unset($_SESSION['HTTP_USER_AGENT']);
session_unset();
session_destroy(); 

/* Delete the cookies*******************/
setcookie("user_id", '', time()-60*60*24*COOKIE_TIME_OUT, "/");
setcookie("user_name", '', time()-60*60*24*COOKIE_TIME_OUT, "/");
setcookie("user_key", '', time()-60*60*24*COOKIE_TIME_OUT, "/");
header("Location: ".$webUrl."index.php");
}


function page_protect() {
global $conn;
session_start();	
$rs_stime = mysqli_query($conn,"select `stime` from `tbllogin` where UserID='$_SESSION[user_id]'") or die(mysqli_error());
$row = mysqli_fetch_array($rs_stime);
$stime = $row['stime'];
if(time()-$stime < 60*30)
 {
  $stamp = time();
  mysqli_query($conn,"update tbllogin set `stime`='$stamp' where UserID='$_SESSION[user_id]'") or die(mysqli_error());
 }else{
  ?>
 <script>
 alert("Your login session is timed out. please login again.");
	window.location.href="logout.php";
 </script>
 <?php   
  logout();
 exit;
 }
 

/* Secure against Session Hijacking by checking user agent */
if (isset($_SESSION['HTTP_USER_AGENT']))
{
    if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT']))
    {
        logout();
        exit;
    }
}

// before we allow sessions, we need to check authentication key - ckey and ctime stored in database

/* If session not set, check for cookies set by Remember me */
if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_name']) ) 
{
	if(isset($_COOKIE['user_id']) && isset($_COOKIE['user_key'])){
	/* we double check cookie expiry time against stored in database */
	
	$cookie_user_id  = filter($_COOKIE['user_id']);
	$rs_ctime = mysqli_query($conn,"select ckey,ctime from users where id ='$cookie_user_id'") or die(mysqli_error());
	list($ckey,$ctime) = mysqli_fetch_row($rs_ctime);
	// coookie expiry
	if( (time() - $ctime) > 60*60*24*COOKIE_TIME_OUT) {
		logout();
		}
/* Security check with untrusted cookies - dont trust value stored in cookie. 		
/* We also do authentication check of the ckey stored in cookie matches that stored in database during login*/

	 if( !empty($ckey) && is_numeric($_COOKIE['user_id']) && isUserID($_COOKIE['user_name']) && $_COOKIE['user_key'] == sha1($ckey)  ) {
	 	  session_regenerate_id(); //against session fixation attacks.
	
		  $_SESSION['user_id'] = $_COOKIE['user_id'];
		  $_SESSION['user_name'] = $_COOKIE['user_name'];
		/* query user level from database instead of storing in cookies */	
		if($cn == false)
			connect3db();
		  list($user_level) = mysqli_fetch_row($conn,mysqli_query("select user_level from users where id='".$_SESSION[user_id]."'"));

		  $_SESSION['user_level'] = $user_level;
		  $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
		  
	   } else {
	   logout();
	   }

  } else {
	header("Location: ".$webUrl."admin/");
	exit();
	}
}
}
function GenerateIds($f,$t)
		{
			global $conn;
			$sql = "Select ifnull(max(".$f."),0) from ".$t;
			$res = mysqli_query($conn,$sql);
			$row = mysqli_fetch_array($res);
			$n = $row[0] + 1;
			//mysql_close();
			return $n;		
		}

function getNameByID($f,$t,$c,$id)
		{
		global $conn;
		$sql = "Select ".$f." from ".$t." where ".$c." = '$id'";	
		//echo $sql;
		$v = "";				
		$res = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($res);
		$v = $row[0];
		return $v;
		}	
function getTotal($m){
	global $conn;
	$sql = "select sum(bookSeat) as num from view_ticketprint where tripDate like '%".date('Y-').$m."%' and bookingstatus='1'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res))
    {
    	$row = mysqli_fetch_array($res);
    	$x = $row['num'];
    	if($x == null)
    		$x = 0;

    	return $x;
    }
}

function getTotalCancel($m){
	global $conn;
	$sql = "select SUM(totNoCancel) as num1 from  tbl_canelticket where CancelDate like '%".date('Y-').$m."%'";
    $res = mysqli_query($conn,$sql);
    if(mysqli_num_rows($res))
    {
    	$row = mysqli_fetch_array($res);
    	$x = $row['num1'];
    	if($x == null)
    		$x = 0;

    	return $x;
    }
}
function sms($messg,$mobile)
{
  $user='nambor';
  $password='travel';
  $m='91' . $mobile;
  $mobileno=$m;
  $messg=urlencode($messg);
  $ch = curl_init("http://trans.instaclicksms.in/sendsms.jsp?user=$user&password=$password&mobiles=$m&sms=".$messg);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $ch     = curl_exec($ch);
}
?>