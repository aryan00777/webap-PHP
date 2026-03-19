<?php
// Keep old URL working, forward to MVC controller.
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
header('Location: index.php?route=student/programme&id=' . $id);
exit;

