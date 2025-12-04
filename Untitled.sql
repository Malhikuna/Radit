CREATE TABLE `users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `email` varchar(255) UNIQUE,
  `password` varchar(255),
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `posts` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `title` varchar(255),
  `category` varchar(255),
  `content` text,
  `status` enum(draft,published),
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `images` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `post_id` int,
  `file_path` varchar(255),
  `created_at` timestamp
);

CREATE TABLE `votes` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `post_id` int,
  `value` int,
  `created_at` timestamp
);

CREATE TABLE `login_logs` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `login_at` timestamp,
  `ip_address` varchar(255),
  `user_agent` text
);

CREATE INDEX `posts_index_0` ON `posts` (`title`);

CREATE INDEX `posts_index_1` ON `posts` (`category`);

CREATE INDEX `posts_index_2` ON `posts` (`status`);

CREATE UNIQUE INDEX `votes_index_3` ON `votes` (`user_id`, `post_id`);

ALTER TABLE `posts` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `images` ADD FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

ALTER TABLE `votes` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `votes` ADD FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

ALTER TABLE `login_logs` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
