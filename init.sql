CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;
CREATE TABLE IF NOT EXISTS account (
  id INT(11) NOT NULL AUTO_INCREMENT,
  login VARCHAR(20) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (ID)
);

INSERT INTO account(login, password) VALUES("admin", "{SHA}0DPiKuNIrrVmD8IUCuw1hQxNqZc=");
INSERT INTO account(login, password) VALUES("user", "{SHA}Et6pb+wgWTVmq3VpLJlJWWgzrck=");

CREATE TABLE IF NOT EXISTS weather_report (
  id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  timestamp DATETIME NOT NULL,
  temperature DOUBLE NOT NULL,
  wind_speed DOUBLE NOT NULL,
  pressure INT NOT NULL,
  FOREIGN KEY (user_id)
        REFERENCES account(id),
  PRIMARY KEY (id)
);

INSERT INTO weather_report(user_id, timestamp, temperature, wind_speed, pressure) 
                    VALUES(1, '2020-12-11 05:54:39', -5.5, 10.2, 1900);
INSERT INTO weather_report(user_id, timestamp, temperature, wind_speed, pressure) 
                    VALUES(1, '2020-12-11 08:34:29', -3.5, 9.2, 1910);
INSERT INTO weather_report(user_id, timestamp, temperature, wind_speed, pressure) 
                    VALUES(1, '2020-12-11 11:17:45', -2.4, 0.5, 1950);

INSERT INTO weather_report(user_id, timestamp, temperature, wind_speed, pressure) 
                    VALUES(2, '2020-12-11 05:54:39', -5.5, 10.2, 1900);
INSERT INTO weather_report(user_id, timestamp, temperature, wind_speed, pressure) 
                    VALUES(2, '2020-12-11 08:34:29', -3.5, 9.2, 1910);
INSERT INTO weather_report(user_id, timestamp, temperature, wind_speed, pressure) 
                    VALUES(2, '2020-12-11 11:17:45', -2.4, 0.5, 1950);

                    