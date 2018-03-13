# Server

Live Server: https://hanifso.dev.fast.sheridanc.on.ca/Pi/

Sensor Cloud <br>
&emsp; •	Collect data from tag sensors <br>
•	Call InsertSensorData API when information is received <br>

InsertSensorData API <br>
•	Receives raw data with Tag ID, Flowerpot ID = Tag Manager Serial Number, Timestamp, and if Motion was detected.  <br>
•	Place information in Sensor Data Table. <br>

Sensor Data Table <br>
•	Contains Tag ID, FlowerPotID = Tag Manager Serial Number, Timestamp, and if Motion was detected. <br>

Rules Table<br>
•	Contains Rule ID, Tag ID, Flowerpot ID, and Rule Number.<br>

Rules Engine<br>
•	Creates rules and adds them to Rules Table.<br>
•	Uses Rule Table’s Rule Number to determine which rules a given tag sensor needs to be checked against.<br>
•	Compares data from Sensor Data against rules to be checked in order to determine if rule was broken.<br>
•	If rule was broken, create an alert.<br>

Alerts Table<br>
•	  Contains AlertID, Flowerpot ID, Received Timestamp, Acknowledged Timestamp, Short Description, Long Description, Alert Level, Image, and Sound<br>

GetAlerts API<br>
•	Take Flowerpot ID from URL<br>
•	Get all associated alerts from database for the Flowerpot ID given that the alert was not previously acknowledged<br>
•	Convert alerts into a JSON object that contains an array of JSON objects<br>
•	Echo alerts JSON object to screen<br>

Acknowledge Alerts API<br>
•	Take Alert ID from URL<br>
•	Change Alert table acknowledge column to current time<br>

GenerateData<br>
•	Creates random tag data and inserts it into the Sensor Data table for testing purposes.<br>


GenerateRules<br>
•	Creates rule to detect for motion for each of the tag sensors in the Sensor Data table, and inserts it into the Rules table for testing purposes.<br>

GenerateAlerts<br>
•	Creates duplicate alert for each of the alerts in the Alerts table for testing purposes.<br>

