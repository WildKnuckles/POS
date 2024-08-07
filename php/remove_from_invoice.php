<?php
session_start();

$id = $_POST['id'];

if (isset($_SESSION['invoice'][$id])) {
    if ($_SESSION['invoice'][$id]['quantity'] > 1) {
        $_SESSION['invoice'][$id]['quantity'] -= 1;
    } else {
        unset($_SESSION['invoice'][$id]);
    }
}

echo json_encode($_SESSION['invoice']);
?>
