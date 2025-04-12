-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 06:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roarybuddy_db`
--

-- --------------------------------------------------------



-- USERS table
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    name varchar(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('student', 'tutor', 'admin') DEFAULT 'student'
);

-- STUDY_GROUP table 
-- These are the study rooms that users can create and join
-- Within these study rooms the users can create sessions and schedule events
CREATE TABLE study_group (
    group_id INT PRIMARY KEY AUTO_INCREMENT,
    group_name VARCHAR(100) NOT NULL,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(user_id)
);

-- USER_STUDYGROUP table 
-- Keeps the relationship we had in the orignal user_studygroup table
CREATE TABLE user_studygroup (
    user_id INT NOT NULL,
    group_id INT NOT NULL,
    studygroup_role ENUM('participant', 'moderator') DEFAULT 'participant',
    joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (group_id) REFERENCES study_group(group_id)
);

-- SESSIONS table
CREATE TABLE sessions (
    session_id INT PRIMARY KEY AUTO_INCREMENT,
    group_id INT,
    session_topic VARCHAR(255),
    session_time DATETIME,
    FOREIGN KEY (group_id) REFERENCES study_group(group_id)
);

-- SCHEDULE table
-- This table is used to schedule and manage sessions within study rooms    
CREATE TABLE schedule (
   schedule_id INT PRIMARY KEY AUTO_INCREMENT, 
   event_name VARCHAR(100) NOT NULL,          
   event_description VARCHAR(255),            
   group_id INT NOT NULL,                       
   session_id INT NOT NULL,                    
   event_time TIMESTAMP NOT NULL,              
   created_by INT,                    
   FOREIGN KEY (group_id) REFERENCES study_group(group_id) ON DELETE CASCADE,
   FOREIGN KEY (session_id) REFERENCES sessions(session_id) ON DELETE CASCADE,
   FOREIGN KEY (created_by) REFERENCES users(user_id) ON DELETE SET NULL
);

-- MESSAGES table
CREATE TABLE messages (
    message_id INT PRIMARY KEY AUTO_INCREMENT,
    session_id INT,
    sender_id INT,
    message_text TEXT,
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (session_id) REFERENCES sessions(session_id),
    FOREIGN KEY (sender_id) REFERENCES users(user_id)
);

-- FILES table
CREATE TABLE files (
    file_id INT PRIMARY KEY AUTO_INCREMENT,
    session_id INT,
    uploaded_by INT,
    file_name VARCHAR(255),
    file_url VARCHAR(100),
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (session_id) REFERENCES sessions(session_id),
    FOREIGN KEY (uploaded_by) REFERENCES users(user_id)
);

-- PROGRESS table
CREATE TABLE progress (
    progress_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    session_id INT,
    task_description TEXT,
    status ENUM('not started', 'in progress', 'completed') DEFAULT 'not started',
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (session_id) REFERENCES sessions(session_id)
);
