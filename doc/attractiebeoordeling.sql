-- Drop the database if it exists
DROP DATABASE IF EXISTS `attractiebeoordeling`;

-- Create the database
CREATE DATABASE IF NOT EXISTS `attractiebeoordeling` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Use the created database
USE `attractiebeoordeling`;

-- Create the Users table
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(255) NOT NULL,
  `username` VARCHAR(255) NOT NULL UNIQUE,
  `password` TEXT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

-- Insert users
INSERT INTO `users` (`naam`, `username`, `password`) VALUES 
('Testgebruiker 1', 'user1', '$2y$10$XQwbcsOWgM0KvAbya2Ad2efBwTLra2CzeduJtAuY8.BW9EHx.cFKa'),
('Testgebruiker 2', 'user2', '$2y$10$HoDxSJa/4NcFcJ.U.kj9N.cSBgcm75IwUkdgxJhLjRXY/K2cP8Fl.'),
('Testgebruiker 3', 'user3', '$2y$10$M7vkYfdWMYqLzvCqjlOh7.nPc79zwDxtItUOh/91teGikS/XrpNuO');

-- Create the Attractions table
CREATE TABLE IF NOT EXISTS `attractions` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(255) NOT NULL,
  `beschrijving` TEXT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

-- Create the Ratings table
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `attraction_id` INT(11) NOT NULL,
  `rating` TINYINT(1) NOT NULL CHECK (`rating` BETWEEN 1 AND 10),
  `beschrijving` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
  FOREIGN KEY (`attraction_id`) REFERENCES `attractions`(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;
