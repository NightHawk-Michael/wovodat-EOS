<?php

// If the user has not log in yet
if (!isset($_SESSION['login'])) {
header('Location:/precursor/index_unrest.php');
}

?>   