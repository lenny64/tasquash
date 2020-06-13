<?php
include_once('./init.php');

header('Content-type: application/json');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $post = json_decode(file_get_contents("php://input"), true);
    if (!$post['username'] || $post['username'] == NULL) { echo json_encode("Pas d'username"); return false; }
    if (!$post['password'] || $post['password'] == NULL) { echo json_encode("Pas de password"); return false; }
    $username = $post['username'];
    $password = $post['password'];
    $out['username'] = $post['username'];
    $out['logged_in'] = true;
    echo json_encode($out);
}

?>
