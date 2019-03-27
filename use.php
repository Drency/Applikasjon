<?php 
if (isset($_SESSION['user'])) {
    session_start();
}
    
    require_once __DIR__ . '/include/header.php';
?>



<?php
    require_once __DIR__ . '/include/footer.php';
