<?php
// Nella session toglie user_id e username e eindirizza in index.php passando il messaggio che è stato eseguito il logout
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['logout']) && $_POST['logout'] === "1") {
    session_destroy();
    header("Location: index.php?logout=success");
}
