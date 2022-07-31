<?php 
define("DEVELOPMENT", TRUE);
function dbConnect()
{
    $db = new mysqli("localhost","root","","basdat2_kepegawaian");
    return $db;
}

function showError($msg)
{
    ?>
    <div class="alert alert-light-danger color-danger alert-dismissible show fade">
        <i class="bi bi-exclamation-circle"></i>
        <?php echo $msg ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
    </div>
    <?php
}
?>