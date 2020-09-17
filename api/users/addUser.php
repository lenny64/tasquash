<?php
include_once('../init.php');
include_once('../../classes/User.php');

header('Content-type: application/json');

if ($_SERVER['REQUEST_METHOD'] == "PUT") {
    $post = json_decode(file_get_contents("php://input"), true);
    if (!$post['pseudo'] || $post['pseudo'] == NULL) { echo json_encode("Pas de pseudo"); return false; }
    if (!$post['email'] || $post['email'] == NULL) { echo json_encode("Pas de email"); return false; }
    if (!$post['password'] || $post['password'] == NULL) { echo json_encode("Pas de password"); return false; }
    $User = new User();
    $User->pseudo = $post['pseudo'];
    $User->email = $post['email'];
    $User->password = $post['password'];
    $User->firstname = $post['firstname'];
    $User->lastname = $post['lastname'];
    $User->addUser();

    echo json_encode($User);
}

?>
