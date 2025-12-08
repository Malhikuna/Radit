-- MySQL database export
START TRANSACTION;

CREATE TABLE IF NOT EXISTS `login_logs` (
    `id` INT AUTO_INCREMENT,
    `user_id` INT,
    `login_at` DATETIME,
    `ip_address` VARCHAR(255),
    `user_agent` TEXT,
    PRIMARY KEY (`id`)
);



CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT,
    `name` VARCHAR(255),
    `email` VARCHAR(255) UNIQUE,
    `password` VARCHAR(255),
    `role` VARCHAR(50) DEFAULT 'member',
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
);



CREATE TABLE IF NOT EXISTS `images` (
    `id` INT AUTO_INCREMENT,
    `post_id` INT,
    `file_path` VARCHAR(255),
    `created_at` DATETIME,
    PRIMARY KEY (`id`)
);



CREATE TABLE IF NOT EXISTS `community_members` (
    `id` INT AUTO_INCREMENT,
    `community_id` INT,
    `user_id` INT,
    `role` VARCHAR(50) DEFAULT 'member',
    `joined_at` DATETIME,
    PRIMARY KEY (`id`)
);



CREATE TABLE IF NOT EXISTS `votes` (
    `id` INT AUTO_INCREMENT,
    `user_id` INT,
    `post_id` INT,
    `comment_id` INT,
    `value` INT,
    `created_at` DATETIME,
    PRIMARY KEY (`id`)
);

-- Indexes
CREATE INDEX `idx_votes_post_id` ON `votes` (`post_id`);
CREATE INDEX `idx_votes_comment_id` ON `votes` (`comment_id`);


CREATE TABLE IF NOT EXISTS `communities` (
    `id` INT AUTO_INCREMENT,
    `name` VARCHAR(255) UNIQUE,
    `description` TEXT,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
);



CREATE TABLE IF NOT EXISTS `comments` (
    `id` INT AUTO_INCREMENT,
    `post_id` INT,
    `user_id` INT,
    `parent_id` INT,
    `content` TEXT,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
);

-- Indexes
CREATE INDEX `idx_comments_post_id` ON `comments` (`post_id`);


CREATE TABLE IF NOT EXISTS `posts` (
    `id` INT AUTO_INCREMENT,
    `user_id` INT,
    `community_id` INT,
    `title` VARCHAR(255),
    `content` TEXT,
    `status` VARCHAR(50),
    `views` INT DEFAULT 0,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
);

-- Indexes
CREATE INDEX `idx_posts_title` ON `posts` (`title`);
CREATE INDEX `idx_posts_status` ON `posts` (`status`);

-- Foreign key constraints
ALTER TABLE `comments` ADD CONSTRAINT `fk_comments_parent_id` FOREIGN KEY(`parent_id`) REFERENCES `comments`(`id`);
ALTER TABLE `comments` ADD CONSTRAINT `fk_comments_post_id` FOREIGN KEY(`post_id`) REFERENCES `posts`(`id`);
ALTER TABLE `comments` ADD CONSTRAINT `fk_comments_user_id` FOREIGN KEY(`user_id`) REFERENCES `users`(`id`);
ALTER TABLE `community_members` ADD CONSTRAINT `fk_community_members_community_id` FOREIGN KEY(`community_id`) REFERENCES `communities`(`id`);
ALTER TABLE `community_members` ADD CONSTRAINT `fk_community_members_user_id` FOREIGN KEY(`user_id`) REFERENCES `users`(`id`);
ALTER TABLE `images` ADD CONSTRAINT `fk_images_post_id` FOREIGN KEY(`post_id`) REFERENCES `posts`(`id`);
ALTER TABLE `login_logs` ADD CONSTRAINT `fk_login_logs_user_id` FOREIGN KEY(`user_id`) REFERENCES `users`(`id`);
ALTER TABLE `posts` ADD CONSTRAINT `fk_posts_community_id` FOREIGN KEY(`community_id`) REFERENCES `communities`(`id`);
ALTER TABLE `posts` ADD CONSTRAINT `fk_posts_user_id` FOREIGN KEY(`user_id`) REFERENCES `users`(`id`);
ALTER TABLE `votes` ADD CONSTRAINT `fk_votes_comment_id` FOREIGN KEY(`comment_id`) REFERENCES `comments`(`id`);
ALTER TABLE `votes` ADD CONSTRAINT `fk_votes_post_id` FOREIGN KEY(`post_id`) REFERENCES `posts`(`id`);
ALTER TABLE `votes` ADD CONSTRAINT `fk_votes_user_id` FOREIGN KEY(`user_id`) REFERENCES `users`(`id`);

COMMIT;
