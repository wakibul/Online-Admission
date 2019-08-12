<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Expires: Fri, 4 Jun 2010 12:00:00 GMT");
?>

<?php
session_start();
ini_set("session.cookie_httponly", 1);  
session_regenerate_id();
include('../include/random.php'); //salt is included in the login.php file
include('../include/dbc.php');
$salt=$_SESSION['nonce']; //stored in a variable
header('X-FRAME-OPTIONS: DENY');
?>
<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <?php include('include/head.php');?>
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <script LANGUAGE="javascript" src="assets/js/trimfunction.js"></script>
<script LANGUAGE="javascript" src="assets/js/check.js"></script>
<script LANGUAGE="javascript" src="assets/js/overlib_mini.js"></script>
<script language="javascript" src="assets/js/md5.js"></script>
<script type="text/javascript" src="assets/js/aes.js"></script>
<script type="text/javascript" src="assets/js/aes-ctr.js"></script>
<script type="text/javascript" src="assets/js/base64.js"></script>
<script type="text/javascript" src="assets/js/utf8.js"></script>
<style id="antiClickjack">body{display:none !important;}</style>
    <script type="text/javascript">
       if (self === top) {
           var antiClickjack = document.getElementById("antiClickjack");
           antiClickjack.parentNode.removeChild(antiClickjack);
       } else {
            alert("Error! Invalid request");
           top.location = self.location;
       }
    </script>
<script LANGUAGE="javascript">
function hash() //function to calculate the salted has
{
if(document.getElementById('username').value == ""){
    alert('UserName can\'t be blank!');
    document.getElementById('username').focus();
    return false;
  }
if(document.getElementById('password').value == ""){
    alert('Password can\'t be blank!');
    document.getElementById('password').focus();
    return false;
  } 
var cd = document.form2.randm.value; //php variable stored in a JS variable nonce
var abc=document.form2.password.value;
var abc=hex_md5(abc);
var abc = abc+cd;
document.form2.password.value=hex_md5(abc);
//document.a.submit();
 }
</script>
  </head>
  <body class="">
    <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-login mx-auto">
              <div class="text-center mb-6">
                <img src="./assets/brand/tabler.svg" class="h-6" alt="">
              </div>
              <form class="card" name="form2" id = "form2" autocomplete="off" action="auth.php" method="POST">
                <div class="card-body p-6">
                  <div class="card-title">Login to your account</div>
                  <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Enter Username">
                  </div>
                  <div class="form-group">
                    <label class="form-label">
                      Password
                     <!--  <a href="./forgot-password.html" class="float-right small">I forgot password</a> -->
                    </label>
                    <input type="password" name="password"  class="form-control" id="password" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" />
                      <span class="custom-control-label">Remember me</span>
                    </label>
                  </div>
                  <input type="hidden" name="randm" value = "<?php echo $salt;?>">
                  <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block"  onClick="return hash();">Sign in</button>
                  </div>
                </div>
              </form>
              <div class="text-center text-muted">
              <?php 
                if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
                foreach($_SESSION['ERRMSG_ARR'] as $msg) {
                echo "<div class='alert alert-danger'> ";
                echo $msg; 
               }
              unset($_SESSION['ERRMSG_ARR']);
              echo "</div>"; 
               }

              ?>  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>