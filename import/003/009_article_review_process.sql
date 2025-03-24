ALTER TABLE article 
ADD COLUMN status ENUM('draft', 'review_requested', 'in_review', 'revision_requested', 'approved', 'declined') 
NOT NULL DEFAULT 'draft';