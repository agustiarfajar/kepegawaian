<?php 
session_id("basdat2");
session_start();
session_destroy();
header("Location: index.php");
?>