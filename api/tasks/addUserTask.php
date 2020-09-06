<?php
include_once('../init.php');
include_once('../../classes/User.php');
include_once('../../classes/Task.php');

header('Content-type: application/json');

if ($_SERVER['REQUEST_METHOD'] == "PUT") {
    $post = json_decode(file_get_contents("php://input"), true);
    if (!$post['taskmaster'] || $post['taskmaster'] == NULL) { echo json_encode("Pas de user id"); return false; }
    if (!$post['description'] || $post['description'] == NULL) { echo json_encode("Pas de description"); return false; }
    if (!$post['category_id'] || $post['category_id'] == NULL) { echo json_encode("Pas de category id"); return false; }
    $Task = new Task();
    $Task->taskmaster = $post['taskmaster'];
    $Task->description = $post['description'];
    $Task->category_id = $post['category_id'];
    $Task->title = $post['title'];
    $Task->deadline = $post['deadline'];
    $Task->addUserTask();

    echo json_encode($Task);
}

?>
