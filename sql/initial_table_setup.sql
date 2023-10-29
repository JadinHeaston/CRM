USE crm;

-- Permission
CREATE TABLE IF NOT EXISTS `Permission` (
	id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(64) NOT NULL,
	description VARCHAR(256) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

-- Priority
CREATE TABLE IF NOT EXISTS `Priority` (
	id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(64) NOT NULL,
	description VARCHAR(256) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

-- Result
CREATE TABLE IF NOT EXISTS `Result` (
	id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(64) NOT NULL,
	description VARCHAR(256) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

-- Status
CREATE TABLE IF NOT EXISTS `Status` (
	id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(64) NOT NULL,
	description VARCHAR(256) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

-- Type
CREATE TABLE IF NOT EXISTS `Type` (
	id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(64) NOT NULL,
	description VARCHAR(256) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

-- User
CREATE TABLE IF NOT EXISTS `User` (
	id BINARY(16) NOT NULL DEFAULT UUID() PRIMARY KEY,
	username VARCHAR(64) NOT NULL,
	first_name VARCHAR(64) NOT NULL,
	last_name VARCHAR(64) NOT NULL,
	email VARCHAR(254) NOT NULL,
	permission TINYINT UNSIGNED NOT NULL,
	CONSTRAINT `fk_permission` FOREIGN KEY (permission) REFERENCES Permission (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
	INDEX ix_permission (permission)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

-- Change
CREATE TABLE IF NOT EXISTS `Change` (
	id BINARY(16) NOT NULL DEFAULT UUID() PRIMARY KEY,
	owner BINARY(16) NOT NULL,
	requestor BINARY(16) NOT NULL,
	description TEXT(65535) NOT NULL,
	business_case TEXT(65535) NOT NULL,
	business_impact TEXT(65535) NOT NULL,
	it_impact TEXT(65535) NULL,
	service_impact TEXT(65535) NULL,
	communication_plan TEXT(65535) NULL,
	risk TEXT(65535) NULL,
	regulatory_compliance TEXT(65535) NULL,
	documentation TEXT(65535) NOT NULL,
	recovery_procedure TEXT(6553),
	test_procudure TEXT(65535) NULL,
	change_date DATETIME NOT NULL,
	changers json NOT NULL,
	expected_time MEDIUMINT UNSIGNED NOT NULL,
	expected_duration MEDIUMINT UNSIGNED NOT NULL,
	priority TINYINT UNSIGNED NOT NULL,
	type TINYINT UNSIGNED NOT NULL,
	review_date DATETIME NULL,
	reviewers json NULL,
	status TINYINT UNSIGNED NOT NULL,
	result TINYINT UNSIGNED NULL,
	notes TEXT(65535) NULL,
	creation_date DATETIME NOT NULL,
	completion_date DATETIME NULL,
	CONSTRAINT `fk_priority` FOREIGN KEY (priority) REFERENCES Priority (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT `fk_type` FOREIGN KEY (type) REFERENCES Type (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT `fk_status` FOREIGN KEY (status) REFERENCES Status (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT `fk_result` FOREIGN KEY (result) REFERENCES Result (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
	INDEX ix_owner (owner),
	INDEX ix_requestor (requestor),
	INDEX ix_status (status),
	INDEX ix_change_date (change_date),
	INDEX ix_priority (priority),
	INDEX ix_type (type),
	INDEX ix_review_date (review_date),
	INDEX ix_result (result),
	INDEX ix_creation_date (creation_date),
	INDEX ix_completion_date (completion_date)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;