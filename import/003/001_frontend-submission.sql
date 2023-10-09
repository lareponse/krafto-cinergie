-- STRUCTURE
DROP TABLE IF EXISTS `submissions`;

CREATE TABLE `submissions` (
  `id` int NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `submitted` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `emitted` text COLLATE utf8mb4_general_ci NOT NULL,
  `professional_id` int DEFAULT NULL,
  `organisation_id` int DEFAULT NULL,
  `job_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subMayHaveOrganisation` (`organisation_id`),
  ADD KEY `subMayHaveProfessional` (`professional_id`),
  ADD KEY `subMayHaveJob` (`job_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `subMayHaveJob` FOREIGN KEY (`job_id`) REFERENCES `job` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `subMayHaveOrganisation` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `subMayHaveProfessional` FOREIGN KEY (`professional_id`) REFERENCES `professional` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
