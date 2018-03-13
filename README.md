# Server

Sensor Cloud <br>
•	Collect data from tag sensors
•	Call InsertSensorData API when information is received

InsertSensorData API
•	Receives raw data with Tag ID, Flowerpot ID = Tag Manager Serial Number, Timestamp, and if Motion was detected. 
•	Place information in Sensor Data Table.

Sensor Data Table
•	Contains Tag ID, FlowerPotID = Tag Manager Serial Number, Timestamp, and if Motion was detected.

Rules Table
•	Contains Rule ID, Tag ID, Flowerpot ID, and Rule Number.

Rules Engine
•	Creates rules and adds them to Rules Table.
•	Uses Rule Table’s Rule Number to determine which rules a given tag sensor needs to be checked against.
•	Compares data from Sensor Data against rules to be checked in order to determine if rule was broken.
•	If rule was broken, create an alert.

Alerts Table
•	  Contains AlertID, Flowerpot ID, Received Timestamp, Acknowledged Timestamp, Short Description, Long Description, Alert Level, Image, and Sound

GetAlerts API
•	Take Flowerpot ID from URL
•	Get all associated alerts from database for the Flowerpot ID given that the alert was not previously acknowledged
•	Convert alerts into a JSON object that contains an array of JSON objects
•	Echo alerts JSON object to screen

Acknowledge Alerts API
•	Take Alert ID from URL
•	Change Alert table acknowledge column to current time

GenerateData
•	Creates random tag data and inserts it into the Sensor Data table for testing purposes.


GenerateRules
•	Creates rule to detect for motion for each of the tag sensors in the Sensor Data table, and inserts it into the Rules table for testing purposes.

GenerateAlerts
•	Creates duplicate alert for each of the alerts in the Alerts table for testing purposes.

