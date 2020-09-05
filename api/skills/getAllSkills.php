<?php
include_once('../init.php');
include_once('../../classes/Skill.php');

header('Content-type:application/json');

$Skill = new Skill();
$skills = $Skill->getAll();
echo json_encode($skills);

?>
