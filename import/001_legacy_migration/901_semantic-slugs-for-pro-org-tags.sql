UPDATE `tag` SET `slug` = CONCAT(SUBSTR(`slug`, 1,3), '-praxis-',
    REPLACE(
    REGEXP_REPLACE(
    REGEXP_REPLACE(
    REGEXP_REPLACE(
    REGEXP_REPLACE(LOWER(TRIM(label))
    , 'è|é|ê|ë', 'e')
    ,'á|à|â|ä', 'a')
    ,'/|\\s|\'|,', '-')
    ,'\\(-lere\\)|\\(-lère\\)|\\(-iere\\)|\\(-ière\\)|\\(-ive\\)|\\(-trice\\)|\\(-euse\\)|\\(e\\)|\\(fe\\)|\\(ne\\)|wo\\)', '')
    , ' ', '-')
)
WHERE `slug` LIKE ('pro_praxis_%') or `slug` LIKE ('org_praxis_%')