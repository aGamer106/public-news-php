CREATE TABLE user (
                      userid INT PRIMARY KEY,
                      email VARCHAR(255),
                      first_name VARCHAR(255),
                      last_name VARCHAR(255),
                      password VARCHAR(255),
                      subscription_status VARCHAR(255)
);

CREATE TABLE admin (
                       id INT PRIMARY KEY,
                       email VARCHAR(255),
                       first_name VARCHAR(255),
                       last_name VARCHAR(255),
                       password VARCHAR(255)
);

CREATE TABLE journalist (
                            authorid INT PRIMARY KEY,
                            email VARCHAR(255),
                            first_name VARCHAR(255),
                            last_name VARCHAR(255),
                            password VARCHAR(255),
                            no_of_articles INT
);

CREATE TABLE article (
                         articleid INT PRIMARY KEY,
                         date DATE,
                         description TEXT,
                         status VARCHAR(255),
                         title VARCHAR(255),
                         authorid INT
);

CREATE TABLE `article_read` (
                                `id` INT NOT NULL AUTO_INCREMENT,
                                `user_id` INT NOT NULL,
                                `article_id` INT NOT NULL,
                                `read_date` DATE NOT NULL DEFAULT CURRENT_DATE,
                                PRIMARY KEY (`id`),
                                FOREIGN KEY (`user_id`) REFERENCES `user`(`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
                                FOREIGN KEY (`article_id`) REFERENCES `article`(`articleid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;



