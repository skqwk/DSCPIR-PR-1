CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;
CREATE TABLE IF NOT EXISTS user (
  id INT(11) NOT NULL AUTO_INCREMENT,
  login VARCHAR(20) NOT NULL,
  password VARCHAR(20) NOT NULL,
  PRIMARY KEY (ID)
);

INSERT INTO user(login, password) VALUES("admin", "admin");
INSERT INTO user(login, password) VALUES("user", "user");

CREATE TABLE IF NOT EXISTS weather_report (
  id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  timestamp DATETIME NOT NULL,
  temperature DOUBLE NOT NULL,
  wind_speed DOUBLE NOT NULL,
  pressure INT NOT NULL,
  FOREIGN KEY (user_id)
        REFERENCES user(id),
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

                    