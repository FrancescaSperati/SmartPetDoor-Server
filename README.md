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

(unfortunately, operating with the server includes expenses, so the access it will not be shared on this page)

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


Into the serverscripts folder, there is a collection of all the scripts necessary to link the three projects (SmartPetDoor-Server, SmartPetDoor-Flap, and SmartPetDoor-App)

- newpendingpet.php 
 creates a new file representing the pet picture, and sends it to the Firebase Cloud Messaging API
- newpet.php 
 creates a new folder into photos, having the pet's name_y, and containing all puctures uploaded with unique names (date stamp)
- deletependingpet.php
 deletes the newpet picture from the pendingpet folder
- opendoor.php
 executes the openclose.py script on the raspberry pi
- pendingpet.php 
 encodes the base_64 pictures from the pendingpet folder, so they can be sent to the Firebase API and red from the App
- startretrain.php
 executes the retrain.py of all pictures contained into the photos folder



All code of this repository is property and copyright of Francesca Sperati and Charlie Chiu, 
Licence is proprietary and all rights are reserved
