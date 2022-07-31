<?php 
define("DEVELOPMENT", TRUE);
function dbConnect()
{
    $db = new mysqli("localhost","root","","basdat2_kepegawaian");
    return $db;
}
?>