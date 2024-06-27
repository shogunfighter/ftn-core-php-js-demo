CREATE DATABASE mydb;

USE mydb;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    birthdate DATE, -- YYYY-MM-DD  
    phone_number VARCHAR(10),
    url VARCHAR(200)
);

INSERT INTO users (username, email, `password`, birthdate, phone_number, `url`) VALUES ('user1', 'user1@abc.xyz', 'password1', '2024-06-27', '0987654321', 'https://www.example.com');
INSERT INTO users (username, email, `password`, birthdate, phone_number, `url`) VALUES ('user2', 'user2@abc.xyz', 'password2', '2024-06-27', '0987654322', 'https://www.example.com');
INSERT INTO users (username, email, `password`, birthdate, phone_number, `url`) VALUES ('user3', 'user3@abc.xyz', 'password3', '2024-06-27', '0987654323', 'https://www.example.com');
INSERT INTO users (username, email, `password`, birthdate, phone_number, `url`) VALUES ('user4', 'user4@abc.xyz', 'password4', '2024-06-27', '0987654324', 'https://www.example.com');
INSERT INTO users (username, email, `password`, birthdate, phone_number, `url`) VALUES ('user5', 'user5@abc.xyz', 'password5', '2024-06-27', '0987654325', 'https://www.example.com');
INSERT INTO users (username, email, `password`, birthdate, phone_number, `url`) VALUES ('user6', 'user6@abc.xyz', 'password6', '2024-06-27', '0987654326', 'https://www.example.com');
INSERT INTO users (username, email, `password`, birthdate, phone_number, `url`) VALUES ('user7', 'user7@abc.xyz', 'password7', '2024-06-27', '0987654327', 'https://www.example.com');
INSERT INTO users (username, email, `password`, birthdate, phone_number, `url`) VALUES ('user8', 'user8@abc.xyz', 'password8', '2024-06-27', '0987654328', 'https://www.example.com');