# Temperature Alarms README

This project has been developed to utilize NodeMCU SOCs & Temperature Sensors (DS18B20) to report temperatures of specified locations every 30 minutes.

-------------

CONFIGURE & DEPLOY WEB SERVER
I. Deploy Web Server with PHP/MySQL - this project was developed using Bitnami LAMP.
II. Execute SQL commands from the data.sql file within this repository.
III. Replace all instances of the database password 'T3mp12' with your SQL password.
IV. Modify the "Create the Transport" section with your email details for email notifications of specified temperatures.
V. Deploy the PHP/CSS/JS files to your web server directory.

CONFIGURE & DEPLOY NODEMCU
I. Modify the Arduino Code to utilize your network configuration and server IP.
II. Flash your NodeMCU with the modified code.
III. Review mcu pinout for connecting NodeMCU and Temperature Sensor.

CONFIGURE WEB INTERFACE
I. Connect to your web server IP via Web Browser.
II. Click the Settings icon in top right.
III. Configure Location.
IV. Configure Device.
    a. Name must be the reported hostname, default is ESP_123456 - where 123456 is the last 6 digits of the Mac Address.
    b. Shortcode must match shortcode of a configured location.
V. Configure Alarms



