-- Run this SQL once to create the certificate_issue table (issued certificates with date)
-- Then the Issued Certificate Report will show only students who were actually issued that certificate, with issue date.

CREATE TABLE IF NOT EXISTS `certificate_issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `certificate_id` int(11) NOT NULL,
  `issued_date` date NOT NULL,
  `session_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `certificate_issue_student_id` (`student_id`),
  KEY `certificate_issue_certificate_id` (`certificate_id`),
  KEY `certificate_issue_issued_date` (`issued_date`),
  KEY `certificate_issue_session_id` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
