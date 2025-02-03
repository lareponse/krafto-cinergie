CREATE TABLE `image` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,          -- Unique identifier for each image
    `path` VARCHAR(333) NOT NULL,                 -- Path to the image file (e.g., /uploads/profiles/123.jpg)
    `name` VARCHAR(255) NOT NULL,                 -- Original file name (e.g., my_photo.jpg)
    `extension` VARCHAR(10) NOT NULL,             -- File extension (e.g., jpg, png)
    `size` BIGINT NOT NULL,                       -- File size in bytes
    `error` TEXT DEFAULT NULL,                    -- Error message if file analysis failed
    `width` INT DEFAULT NULL,                         -- Image width in pixels
    `height` INT DEFAULT NULL,                        -- Image height in pixels
    `mime` VARCHAR(50) DEFAULT NULL,                  -- MIME type (e.g., image/jpeg, image/png)
    `uploaded_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Timestamp of upload
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Timestamp of last update
    `is_active` TINYINT(1) DEFAULT 1              -- Soft delete flag (1 = active, 0 = inactive)
);