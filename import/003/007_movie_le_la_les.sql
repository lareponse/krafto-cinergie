-- 1) Add the new column (implicit commit in MySQL)
ALTER TABLE `movie`
  ADD `label_indexed` VARCHAR(257) NOT NULL
  COMMENT 'label with post Le, La, Les'
  AFTER `prix_cinergie`;

START TRANSACTION;

UPDATE movie
SET label_indexed = CASE
    WHEN LOWER(LEFT(label, 3)) = 'le ' THEN
        CONCAT(SUBSTRING(label, 4), ', ', LEFT(label, 2))
        
    WHEN LOWER(LEFT(label, 3)) = 'la ' THEN
        CONCAT(SUBSTRING(label, 4), ', ', LEFT(label, 2))
        
    WHEN LOWER(LEFT(label, 4)) = 'les ' THEN
        CONCAT(SUBSTRING(label, 5), ', ', LEFT(label, 3))
        
    WHEN LOWER(LEFT(label, 2)) = 'l\'' THEN
        CONCAT(SUBSTRING(label, 3), ', ', LEFT(label, 2))
    
    ELSE label
END;

SELECT label, label_indexed
FROM movie
WHERE label_indexed <> label
LIMIT 1000;

COMMIT;
