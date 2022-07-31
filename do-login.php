<?php 
include_once("pages/functions.php");
?>
<?php 
if(isset($_POST["btnLogin"]))
{
    $db = dbConnect();
    if($db->connect_errno==0)
    {
        $pesansalah = "";
        $v_user = trim($_POST["username"]);
        $v_pass = trim($_POST["pass"]);

        if(strlen($v_user) == 0)
        {
            $pesansalah .= "Username tidak boleh kosong.";
        }
        if(strlen($v_pass) == 0)
        {
            $pesansalah .= "Password tidak boleh kosong.";
        }

        if($pesansalah == "")
        {
            $username = $db->escape_string($_POST["username"]);
            $password = $db->escape_string($_POST["pass"]);
            $sql = "SELECT * FROM user WHERE username='$username' AND pass=PASSWORD('$password')";
            $res = $db->query($sql);
            if($res)
            {
                if($res->num_rows==1)
                {
                    $data=$res->fetch_assoc();
                    session_start();
                    $_SESSION["kode_user"]=$data["kode_user"];
                    $_SESSION["nama"]=$data["nama"];
                    $_SESSION["no_telp"]=$data["no_telp"];
                    $_SESSION["level"]=$data["level"];
                    $_SESSION["username"]=$data["username"];
                    header("Location: pages/dashboard.php");
                }
                else 
                    header("Location: index.php?error=1");
            }       
            else 
                header("Location: index.php?error=2");
        }
        else 
            header("Location: index.php?error=input");
        
    }
    else 
        header("Location: index.php?error=koneksi");  
}
else 
    header("Location: index.php?error=proses");
?>