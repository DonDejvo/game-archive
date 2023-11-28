CREATE TABLE `games`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) NULL,
    `created_at` DATETIME NOT NULL,
    `genre_id` BIGINT NOT NULL,
    `updated_at` DATETIME NOT NULL
);
ALTER TABLE
    `games` ADD PRIMARY KEY `games_id_primary`(`id`);
CREATE TABLE `game_stars`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT NOT NULL,
    `game_id` BIGINT NOT NULL
);
ALTER TABLE
    `game_stars` ADD PRIMARY KEY `game_stars_id_primary`(`id`);
CREATE TABLE `game_genres`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `game_genres` ADD PRIMARY KEY `game_genres_id_primary`(`id`);
ALTER TABLE
    `game_genres` ADD UNIQUE `game_genres_name_unique`(`name`);
CREATE TABLE `game_comments`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT NOT NULL,
    `game_id` BIGINT NOT NULL,
    `created_at` DATETIME NOT NULL,
    `updated_at` DATETIME NOT NULL,
    `message` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `game_comments` ADD PRIMARY KEY `game_comments_id_primary`(`id`);
CREATE TABLE `users`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255) NOT NULL,
    `bio` VARCHAR(255) NULL,
    `created_at` DATETIME NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `updated_at` DATETIME NOT NULL,
    `active` TINYINT(1) NOT NULL DEFAULT '1',
    `avatar_url` VARCHAR(255) NULL
);
ALTER TABLE
    `users` ADD PRIMARY KEY `users_id_primary`(`id`);
ALTER TABLE
    `users` ADD UNIQUE `users_username_unique`(`username`);
ALTER TABLE
    `game_comments` ADD CONSTRAINT `game_comments_game_id_foreign` FOREIGN KEY(`game_id`) REFERENCES `games`(`id`)
     ON DELETE CASCADE;
ALTER TABLE
    `games` ADD CONSTRAINT `games_user_id_foreign` FOREIGN KEY(`user_id`) REFERENCES `users`(`id`)
     ON DELETE CASCADE;
ALTER TABLE
    `game_stars` ADD CONSTRAINT `game_stars_game_id_foreign` FOREIGN KEY(`game_id`) REFERENCES `games`(`id`)
     ON DELETE CASCADE;
ALTER TABLE
    `game_stars` ADD CONSTRAINT `game_stars_user_id_foreign` FOREIGN KEY(`user_id`) REFERENCES `users`(`id`)
     ON DELETE CASCADE;
ALTER TABLE
    `game_comments` ADD CONSTRAINT `game_comments_user_id_foreign` FOREIGN KEY(`user_id`) REFERENCES `users`(`id`)
     ON DELETE CASCADE;
ALTER TABLE
    `games` ADD CONSTRAINT `games_genre_id_foreign` FOREIGN KEY(`genre_id`) REFERENCES `game_genres`(`id`);

INSERT INTO `game_genres`
    (`name`)
VALUES
    ("Action"),
    ("Adventure"),
    ("Strategy"),
    ("Puzzle"),
    ("Simulation"),
    ("Sports"),
    ("Role-playing");