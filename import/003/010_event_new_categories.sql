START TRANSACTION;

-- 1) Parent for all event‐categories
SET @parent_id = (
  SELECT id
  FROM `cinergie`.`tag`
  WHERE slug = 'event_category'
);

-- 2) Insert only the two missing super‐tags
INSERT INTO `cinergie`.`tag`
  (parent_id, slug,                 label,      public, pick, listable, searchable)
VALUES
  (@parent_id, 'event-cat-sorties', 'Sorties',  1,      1,    1,         1),
  (@parent_id, 'event-cat-seance',  'Séance',   1,      1,    1,         1);


-- 3) Capture the IDs of all three super‐tags
--    – “Événement” already exists as slug=event-cat-evenement_agenda
SET @event_type_evt = (
  SELECT id FROM `cinergie`.`tag`
  WHERE slug = 'event-cat-evenement_agenda'
);
SET @event_type_out = (
  SELECT id FROM `cinergie`.`tag`
  WHERE slug = 'event-cat-sorties'
);
SET @event_type_sit = (
  SELECT id FROM `cinergie`.`tag`
  WHERE slug = 'event-cat-seance'
);
SET @event_type_tv = (
  SELECT id FROM `cinergie`.`tag`
  WHERE slug = 'event-cat-programmation_tv'
);


-- 4) Capture the IDs of the old leaf tags by slug
SET @old_avant     = (SELECT id FROM `cinergie`.`tag` WHERE slug = 'event-cat-avant_premiere');
SET @old_festival  = (SELECT id FROM `cinergie`.`tag` WHERE slug = 'event-cat-festival');
SET @old_sortie    = (SELECT id FROM `cinergie`.`tag` WHERE slug = 'event-cat-sortie_en_salle');
SET @old_cineclub  = (SELECT id FROM `cinergie`.`tag` WHERE slug = 'event-cat-cineclub');
SET @old_seances   = (SELECT id FROM `cinergie`.`tag` WHERE slug = 'event-cat-_autre_agenda');
SET @old_tv        = (SELECT id FROM `cinergie`.`tag` WHERE slug = 'event-cat-programmation_tv');


-- 5) Remap existing events into the new categories
UPDATE `cinergie`.`event`
SET type_id = @event_type_evt
WHERE type_id IN (@old_avant, @old_festival, @old_tv)
   OR type_id IS NULL
   OR type_id = 0;

UPDATE `cinergie`.`event`
SET type_id = @event_type_out
WHERE type_id = @old_sortie;

UPDATE `cinergie`.`event`
SET type_id = @event_type_sit
WHERE type_id IN (@old_cineclub, @old_seances);


-- 6) Prefix “xx” on the old leaf‐tags’ labels and deprecate them
UPDATE `cinergie`.`tag`
SET
  label       = CONCAT('xx20250704-', label),
  public      = 0,
  listable    = 0,
  searchable  = 0
WHERE slug IN (
  'event-cat-avant_premiere',
  'event-cat-festival',
  'event-cat-sortie_en_salle',
  'event-cat-cineclub',
  'event-cat-programmation_tv',
  'event-cat-_autre_agenda'
);


COMMIT;