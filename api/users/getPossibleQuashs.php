<?php
include_once('../init.php');
include_once('../../classes/User.php');
include_once('../../classes/Task.php');

header('Content-type:application/json');

$User = new User();
$User->id = $_GET['user_id'];
$quashs_list = Array();
foreach ($User->getPossibleQuashs() as $quash) {
    $Taskmaster = new User();
    $Taskmaster->id = $quash['taskmaster'];
    $Taskmaster->getFromId();
    $quash['taskmaster'] = $Taskmaster;
    $Quash = new Task();
    $Quash->id = $quash['id'];
    $Quash->getFromId();
    $quash['offers'] = $Quash->getApplicantsOffers();
    $quashs_list[] = $quash;
}
// $quashs = $User->getPossibleQuashs();
echo json_encode($quashs_list);

?>
