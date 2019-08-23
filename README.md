Smart Pet Door

2019 - Advanced Studio Project @ AIT
6431 Francesca Sperati - 6590 Charlie Chiu

Server:
Tensorflow-server
https://console.cloud.google.com/compute/instancesDetail/zones/australia-southeast1-b/instances/tensorflow-server?project=cool-monolith-248401&authuser=2


To connect to the server from terminal:
ssh -i ~/.ssh/googleserver francescasperati@35.244.89.241

To open the editor VisualStudioCodeOnline:
https://35.244.89.241/

To run the Retrain: (example with flowers)
python retrain.py --image_dir flower_photos --output_graph=test1/output_graph.pb --intermediate_output_graphs_dir=test1/ntermediate_graph/ --output_labels=test1/output_labels.txt --summaries_dir=test1/retrain_logs --bottleneck_dir=test1/bottleneck --saved_model_dir=test1/saved_models/$(date +%s)

To classify a picture: (example of a daisi)
python classify.py --image=margherita.jpg
