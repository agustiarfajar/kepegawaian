<?php
session_id("basdat2");
session_start();
include_once("functions.php");
$db = dbConnect();
if($db->connect_errno==0)
{
    if($_POST["no_slip"])
    {
        $no_slip = $_POST["no_slip"];

        $sql = "DELETE FROM penggajian
                WHERE no_slip='$no_slip'";
        $res = $db->query($sql);
        if($res)
        {
            if($db->affected_rows>0)
            {
                header("Location: penggajian.php?success=3");
            }
        }
        else
            echo "Error ".(DEVELOPMENT?":".$db->error:"");            
    }   
}
else 
    header("Location: penggajian.php?error=koneksi");
?>