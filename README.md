# Server

Live Server: https://hanifso.dev.fast.sheridanc.on.ca/Pi/

Sensor Cloud <br>
&emsp; &emsp;•  Collect data from tag sensors <br>
&emsp; &emsp;•	Call InsertSensorData API when information is received <br>

InsertSensorData API <br>
&emsp; &emsp;•	Receives raw data with Tag ID, Flowerpot ID = Tag Manager Serial Number, Timestamp, and if Motion was detected.  <br>
&emsp; &emsp;•	Place information in Sensor Data Table. <br>

Sensor Data Table <br>
&emsp; &emsp;•	Contains Tag ID, FlowerPotID = Tag Manager Serial Number, Timestamp, and if Motion was detected. <br>

Rules Table<br>
&emsp; &emsp;•	Contains Rule ID, Tag ID, Flowerpot ID, and Rule Number.<br>

Rules Engine<br>
&emsp; &emsp;•	Creates rules and adds them to Rules Table.<br>
&emsp; &emsp;•	Uses Rule Table’s Rule Number to determine which rules a given tag sensor needs to be checked against.<br>
&emsp; &emsp;•	Compares data from Sensor Data against rules to be checked in order to determine if rule was broken.<br>
&emsp; &emsp;•	If rule was broken, create an alert.<br>

Alerts Table<br>
&emsp; &emsp;•	  Contains AlertID, Flowerpot ID, Received Timestamp, Acknowledged Timestamp, Short Description, Long Description, Alert Level, Image, and Sound<br>

GetAlerts API<br>
&emsp; &emsp;•	Take Flowerpot ID from URL<br>
&emsp; &emsp;•	Get all associated alerts from database for the Flowerpot ID given that the alert was not previously acknowledged<br>
&emsp; &emsp;•	Convert alerts into a JSON object that contains an array of JSON objects<br>
&emsp; &emsp;•	Echo alerts JSON object to screen<br>

Acknowledge Alerts API<br>
&emsp; &emsp;•	Take Alert ID from URL<br>
&emsp; &emsp;•	Change Alert table acknowledge column to current time<br>

GenerateData<br>
&emsp; &emsp;•	Creates random tag data and inserts it into the Sensor Data table for testing purposes.<br>


GenerateRules<br>
&emsp; &emsp;•	Creates rule to detect for motion for each of the tag sensors in the Sensor Data table, and inserts it into the  Rules table for testing purposes.<br>

GenerateAlerts<br>
&emsp; &emsp;•	Creates duplicate alert for each of the alerts in the Alerts table for testing purposes.<br>

