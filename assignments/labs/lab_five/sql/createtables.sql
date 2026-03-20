DROP TABLE IF EXISTS filePaths;
        CREATE TABLE filePaths(
        file_id INT AUTO_INCREMENT PRIMARY KEY,
        filePath VARCHAR(255),
        user_id INT NOT NULL
    );
    
DROP TABLE IF EXISTS users;

    CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );