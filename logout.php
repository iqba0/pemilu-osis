<?php
session_start();
// Hapus session
session_unset();
session_destroy();
// Redirect ke halaman login setelah logout
header("Location: index.php");
exit();
?>
