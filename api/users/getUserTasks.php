<?php
include_once('../init.php');
include_once('../../classes/User.php');
include_once('../../classes/Task.php');

header('Content-type:application/json');

$User = new User();
$User->id = $_GET['user_id'];
$tasks_list = Array();
foreach ($User->getTasks() as $task) {
    $Task = new Task();
    $Task->id = $task['id'];
    $Task->getFromId();
    $Task->getApplicantsOffers();
    $Taskmaster = new User();
    $Taskmaster->id = $Task->taskmaster;
    $Taskmaster->getFromId();
    $Task->taskmaster = $Taskmaster;
    $Quasher = new User();
    $Quasher->id = $Task->quasher;
    $Quasher->getFromId();
    $Task->quasher = $Quasher;
    $tasks_list[] = $Task;
}
// $tasks = $User->getTasks();
echo json_encode($tasks_list);

?>
