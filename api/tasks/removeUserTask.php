<?php
include_once('../init.php');
include_once('../../classes/Task.php');

header('Content-type: application/json');

if (isset($_GET['id']) && $_GET['id'] != NULL) {
    $Task = new Task();
    $Task->id = $_GET['id'];
    $Task->removeUserTask();

    echo json_encode($Task);
}

?>
