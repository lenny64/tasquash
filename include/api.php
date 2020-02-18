<?php

header('Content-type: application/json');
header("HTTP/1.1 200 OK");

$command = escapeshellcmd('../test.py');
$output = shell_exec($command);
echo json_encode($output);

?>
