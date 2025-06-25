ALTER TABLE `movie_theme` 
DROP FOREIGN KEY `movie_theme-hasMovie`; 

ALTER TABLE `movie_theme` 
ADD CONSTRAINT `movie_theme-hasMovie` 
FOREIGN KEY (`movie_id`) 
REFERENCES `movie`(`id`) 
ON DELETE CASCADE ON UPDATE RESTRICT; 

ALTER TABLE `movie_theme` DROP FOREIGN KEY `movie_theme-hasTag`;
ALTER TABLE `movie_theme` 
ADD CONSTRAINT `movie_theme-hasTag` 
FOREIGN KEY (`tag_id`) 
REFERENCES `tag`(`id`) 
ON DELETE CASCADE ON UPDATE RESTRICT;


-- Shows all rows with parent_id = 1, indicating if they'll be kept or deleted
SELECT id, 
       label,
       CASE WHEN label LIKE '--%' THEN 'KEEP' ELSE 'DELETE' END AS action
FROM tag 
WHERE parent_id = 1;

-- Delete all rows where parent_id is 1 and label doesn't start with "--"
-- This removes categories that don't follow the expected format
DELETE FROM tag 
WHERE parent_id = 1
AND label NOT LIKE '--%';

-- Shows both original and updated labels for comparison
SELECT id, 
       label AS current_label, 
       SUBSTRING(label, 4) AS will_become 
FROM tag 
WHERE label LIKE '--%';

-- Update remaining rows by removing the "-- " prefix from the label
-- This transforms labels from "-- Category" format to just "Category"
UPDATE tag 
SET label = SUBSTRING(label, 4) 
WHERE label LIKE '--%';

