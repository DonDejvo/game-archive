CREATE TABLE `games`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `created_at` DATETIME NOT NULL,
    `genre_id` BIGINT UNSIGNED NOT NULL,
    `updated_at` DATETIME NOT NULL,
    `cover_image_url` VARCHAR(255) NOT NULL,
    PRIMARY KEY(`id`)
);
CREATE TABLE `game_stars`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `game_id` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY(`id`)
);
CREATE TABLE `game_genres`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    PRIMARY KEY(`id`)
);
ALTER TABLE
    `game_genres` ADD UNIQUE `game_genres_name_unique`(`name`);
CREATE TABLE `users`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255) NOT NULL,
    `bio` VARCHAR(255),
    `created_at` DATETIME NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `updated_at` DATETIME NOT NULL,
    `active` TINYINT(1) NOT NULL DEFAULT '1',
    PRIMARY KEY(`id`)
);
ALTER TABLE
    `users` ADD UNIQUE `users_username_unique`(`username`);
ALTER TABLE
    `games` ADD CONSTRAINT `games_user_id_foreign` FOREIGN KEY(`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE;
ALTER TABLE
    `game_stars` ADD CONSTRAINT `game_stars_game_id_foreign` FOREIGN KEY(`game_id`) REFERENCES `games`(`id`) ON DELETE CASCADE;
ALTER TABLE
    `game_stars` ADD CONSTRAINT `game_stars_user_id_foreign` FOREIGN KEY(`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE;
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