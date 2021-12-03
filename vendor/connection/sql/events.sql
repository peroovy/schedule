CREATE TABLE events
(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    date DATE NOT NULL,

    UNIQUE KEY (title, date),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);