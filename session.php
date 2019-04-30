<?php
session_name('test');
session_start();
//var_dump(session_id());
if (!isset($_SESSION['connecter']) || ! $_SESSION['connecter']) {
  header('location:success.php?success=0');
}
 ?>
