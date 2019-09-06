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

To run the Retrain: 
python retrain.py --image_dir photos \
 --output_graph=model/output_graph.pb \
 --intermediate_output_graphs_dir=model/ntermediate_graph/ \
 --output_labels=model/output_labels.txt \
 --summaries_dir=model/retrain_logs \
 --bottleneck_dir=model/bottleneck \
 --saved_model_dir=model/saved_models/$(date +%s)


To classify a picture: (example of a daisi)
python classify.py --image=margherita.jpg
