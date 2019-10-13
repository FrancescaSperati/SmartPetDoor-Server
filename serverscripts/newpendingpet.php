<?php
header("Access-Control-Allow-Origin: *");

if(!empty($_FILES['file']['tmp_name'])){

    $file_name = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];

    if (move_uploaded_file($tmp_name, "../pendingpet/".$file_name)) {

        $classify = shell_exec("cd .. && python classify.py --image=pendingpet/".$file_name);
        $classifyScores = explode(PHP_EOL, $classify);
        array_pop($classifyScores);

        $petAllowed = false;
        $txtScores = ' -- ';

        foreach($classifyScores as $score){
            $txtScores .= $score;
            $txtScores .= " | ";
            $nameScore = explode("=", $score);

            // FIX THE PERCENTAGE !!!!!!!!!!!!!!!!!!!!

            if ( strrpos($nameScore[0], " y") && floatval($nameScore[1]) > 0.80 ){
                $petAllowed = true;
            }
            
        }

        if($petAllowed){

            unlink("../pendingpet/".$file_name);

            echo shell_exec("sudo -u francescasperati ssh -i /home/francescasperati/rpisshkey pi@10.8.0.2 'python3 Documents/SmartPetDoor-Flap/openclose.py' > /dev/null 2>/dev/null &");

            echo "-> allowed $txtScores";

            die;
        }

        $push_string = '{"to": "/topics/newpet","priority": "high","notification": {"title": "Hey! New Pet!","body": "A pet is waiting in front of your door!", "sound": "default"}}';

        $chh = curl_init('https://fcm.googleapis.com/fcm/send');
        curl_setopt($chh, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($chh, CURLOPT_POSTFIELDS, $push_string);
        curl_setopt($chh, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($chh, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization: key=AAAAzCHi0mo:APA91bE0XzM2p_bjX-ngo9DyZYdqMYBgv7VtFsE90p5g-a9um7WO8--SkkP1yh4NnRkhO7xLK-uNPihHU1NOJq6GeuYfXsmUlqhbOBHV-BvfZ8EONTspVVbkTbXGtxjoL-VmKv0rzLtW')
            );
        $resulth = curl_exec($chh);

        // $data_string = json_encode(array('text' => 'New Pending Pet!!!'));
        // $ch = curl_init('https://hooks.slack.com/services/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');
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        //         'Content-Type: application/json',
        //         'Content-Length: ' . strlen($data_string))
        //     );
        // $result = curl_exec($ch);
    
        echo "-> denied, sent to app $txtScores";
    
    } else {
        echo "-> failed";
    }

} else {
    echo "-> missing";
}

?>