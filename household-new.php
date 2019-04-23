<?php
if (!isset($_SESSION['userInfo'])) {
    $auth->redirect('index.php');
}

