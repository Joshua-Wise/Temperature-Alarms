# Temperature Alarms README

This project utilizes NodeMCU SOCs & Temperature Sensors (DS18B20) to report temperatures of specified locations every 30 minutes.

-------------

CONFIGURE & DEPLOY WEB SERVER <br>
I. Deploy Web Server with PHP/MySQL - this project was developed using Bitnami LAMP.<br>
II. Execute SQL commands from the data.sql file within this repository.<br>
III. Replace all instances of the database password 'T3mp12' with your SQL password.<br>
IV. Modify the "Create the Transport" section with your email details for email notifications of specified temperatures.<br>
V. Deploy the PHP/CSS/JS files to your web server directory.<br>

CONFIGURE & DEPLOY NODEMCU<br>
I. Modify the Arduino Code to utilize your network configuration and server IP.<br>
II. Flash your NodeMCU with the modified code.<br>
III. Review mcu pinout for connecting NodeMCU and Temperature Sensor.<br>

CONFIGURE WEB INTERFACE<br>
I. Connect to your web server IP via Web Browser.<br>
II. Click the Settings icon in top right.<br>
III. Configure Location.<br>
IV. Configure Device.<br>
    a. Name must be the reported hostname, default is ESP_123456 - where 123456 is the last 6 digits of the Mac Address.<br>
    b. Shortcode must match shortcode of a configured location.<br>
V. Configure Alarms<br>



