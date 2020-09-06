<?php
include_once('../init.php');
include_once('../../classes/Skill.php');

header('Content-type: application/json');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $post = json_decode(file_get_contents("php://input"), true);
    if (!$post['user_id'] || $post['user_id'] == NULL) { echo json_encode("Pas de user id"); return false; }
    if (!$post['category_id'] || $post['category_id'] == NULL) { echo json_encode("Pas de category id"); return false; }
    $Skill = new Skill();
    $Skill->category_id = $post['category_id'];
    $Skill->text = $post['text'];
    $Skill->user_id = $post['user_id'];
    $Skill->removeUserSkill();

    echo json_encode($Skill);
}

?>
