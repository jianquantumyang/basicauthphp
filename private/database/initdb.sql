CREATE TABLE `users`(
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(64) UNIQUE NOT NULL,
    `password` VARCHAR(64) NOT NULL,
    `email` VARCHAR(128) NOT NULL UNIQUE,
    
    
    PRIMARY KEY (`id`));