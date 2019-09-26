<?php

echo shell_exec("sudo -u francescasperati ssh -i /home/francescasperati/rpisshkey pi@10.8.0.2 'python3 Documents/SmartPetDoor-Flap/openclose.py' > /dev/null 2>/dev/null &");

header('Content-type: application/json');
echo json_encode("openclose");

?>