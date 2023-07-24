DROP DATABASE IF EXISTS `slim3-codecourse-auth`;

CREATE DATABASE `slim3-codecourse-auth`;

USE `slim3-codecourse-auth`;

CREATE TABLE `users` (
	`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` varchar(255),
	`email` varchar(255) NOT NULL,
	`password` varchar(255) NOT NULL,
	`created_at` TIMESTAMP,
	`updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO users (`name`, `email`,	`password`) VALUES
('vasya',	'vasya@email.com', 'password');