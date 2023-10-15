select reference, label, CONCAT(SUBSTR(reference, 1,3), '-praxis-',
REPLACE(
REGEXP_REPLACE(
REGEXP_REPLACE(
REGEXP_REPLACE(
REGEXP_REPLACE(LOWER(TRIM(label))
, 'è|é|ê|ë', 'e')
,'á|à|â|ä', 'a')
,'/|\\s|\'|,', '-')
,'\\(-lere\\)|\\(-lère\\)|\\(-iere\\)|\\(-ière\\)|\\(-ive\\)|\\(-trice\\)|\\(-euse\\)|\\(e\\)|\\(fe\\)|\\(ne\\)|wo\\)', '')
, ' ', '-')) as new_reference
from tag
WHERE reference LIKE ('pro_praxis_%') or reference LIKE ('org_praxis_%')



UPDATE tag SET reference = CONCAT(SUBSTR(reference, 1,3), '-praxis-',
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
WHERE reference LIKE ('pro_praxis_%') or reference LIKE ('org_praxis_%')