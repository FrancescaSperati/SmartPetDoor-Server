<?php

$photos = realpath("../photos");
$retrain = realpath("../retrain.py");

echo shell_exec("sudo -u francescasperati python $retrain --image_dir $photos --output_graph=model/output_graph.pb --intermediate_output_graphs_dir=model/ntermediate_graph/ --output_labels=model/output_labels.txt --summaries_dir=model/retrain_logs --bottleneck_dir=model/bottleneck --saved_model_dir=model/saved_models/$(date +%s) > /dev/null 2>/dev/null &");

header('Content-type: application/json');
echo json_encode("openclose");

?>