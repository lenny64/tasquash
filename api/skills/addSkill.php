<?php
include_once('../init.php');
include_once('../../classes/Skill.php');

header('Content-type: application/json');

if ($_SERVER['REQUEST_METHOD'] == "PUT") {
    $post = json_decode(file_get_contents("php://input"), true);
    if (!$post['skill_name'] || $post['skill_name'] == NULL) { echo json_encode("Pas de skill name"); return false; }
    $Skill = new Skill();
    $Skill->name = $post['skill_name'];
    $Skill->addSkill();

    echo json_encode($Skill);
}

?>
