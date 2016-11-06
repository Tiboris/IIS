<?php
   include("config.php");
   if (!isset($_SESSION)) {
      session_start();
   }
   $error = "";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 

      $myusername = mysqli_real_escape_string($db, $_POST['username']);
      $mypassword = mysqli_real_escape_string($db, $_POST['password']); 

      $sql = "SELECT login, meno, priezvisko, veduci FROM zamestnanci WHERE login='$myusername' and pass='$mypassword'";
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      // $active = $row['active'];

      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {
         $_SESSION['login_user'] = $myusername;
         $_SESSION['meno'] = $row['meno'];
         $_SESSION['priezvisko'] = $row['priezvisko'];
         $_SESSION['veduci'] = $row['veduci'];
         $_SESSION['time'] = time();
         header("location: ?page=welcome");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<h1>Login</h1>
<div align="center">
   <div style="margin:30px">
      <form action="" method="post">
         <table>
            <tr>
               <td><label>Prihlasovacie meno:</label></td>
               <td><input type="text" name="username" placeholder="admin" /></td>            
            </tr>
            <tr>
               <td><label>Heslo:</label></td>
               <td><input type="password" name="password" placeholder="nimda"/></td>
            </tr>
         </table>
         <br>
         <input type="submit" value=" Potvrdiť "/>
         <br>
      </form> 
      <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
   </div>
</div>