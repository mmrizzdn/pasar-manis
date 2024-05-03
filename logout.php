<?php
session_start();

// Hapus semua data sesi
session_unset();
session_destroy();

// Redirect ke halaman login atau halaman lain yang diinginkan setelah log out
header("Location: login.php"); // Ganti "login.php" dengan halaman yang sesuai
exit();
?>