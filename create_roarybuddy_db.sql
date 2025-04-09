-- USERS table
CREATE TABLE Users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash TEXT NOT NULL,
    role ENUM('student', 'admin') DEFAULT 'student'
);

-- STUDYROOMS table
CREATE TABLE StudyRooms (
    room_id INT PRIMARY KEY AUTO_INCREMENT,
    room_name VARCHAR(100) NOT NULL,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES Users(user_id)
);

-- SESSIONS table
CREATE TABLE Sessions (
    session_id INT PRIMARY KEY AUTO_INCREMENT,
    room_id INT,
    session_topic VARCHAR(255),
    session_time DATETIME,
    FOREIGN KEY (room_id) REFERENCES StudyRooms(room_id)
);

-- MESSAGES table
CREATE TABLE Messages (
    message_id INT PRIMARY KEY AUTO_INCREMENT,
    session_id INT,
    sender_id INT,
    message_text TEXT,
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (session_id) REFERENCES Sessions(session_id),
    FOREIGN KEY (sender_id) REFERENCES Users(user_id)
);

-- FILES table
CREATE TABLE Files (
    file_id INT PRIMARY KEY AUTO_INCREMENT,
    session_id INT,
    uploaded_by INT,
    file_name VARCHAR(255),
    file_url TEXT,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (session_id) REFERENCES Sessions(session_id),
    FOREIGN KEY (uploaded_by) REFERENCES Users(user_id)
);

-- PROGRESS table
CREATE TABLE Progress (
    progress_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    session_id INT,
    task_description TEXT,
    status ENUM('not started', 'in progress', 'completed') DEFAULT 'not started',
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (session_id) REFERENCES Sessions(session_id)
);
