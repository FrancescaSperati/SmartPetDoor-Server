<?php
header("Access-Control-Allow-Origin: *");

header('Content-type: application/json');

$killall = shell_exec("sudo killall retrain.py");

$startretrain = shell_exec("cd .. && sudo -u francescasperati python retrain.py --image_dir photos --output_graph=model/output_graph.pb --intermediate_output_graphs_dir=model/ntermediate_graph/ --output_labels=model/output_labels.txt --summaries_dir=model/retrain_logs --bottleneck_dir=model/bottleneck --saved_model_dir=model/saved_models/$(date +%s) > /dev/null 2>/dev/null &");

echo json_encode("retrain started");

?>