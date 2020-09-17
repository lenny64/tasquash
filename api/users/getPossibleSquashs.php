<?php
include_once('../init.php');
include_once('../../classes/User.php');
include_once('../../classes/Task.php');

header('Content-type:application/json');

$User = new User();
$User->id = $_GET['user_id'];
$squashs_list = Array();
foreach ($User->getPossibleSquashs() as $squash) {
    $Taskmaster = new User();
    $Taskmaster->id = $squash['taskmaster'];
    $Taskmaster->getFromId();
    $squash['taskmaster'] = $Taskmaster;
    $Squash = new Task();
    $Squash->id = $squash['id'];
    $Squash->getFromId();
    $squash['offers'] = $Squash->getApplicantsOffers();
    $squashs_list[] = $squash;
}
// $squashs = $User->getPossibleSquashs();
echo json_encode($squashs_list);

?>
