# Database Schema <!-- omit in toc -->

## ToC <!-- omit in toc -->

1. [Database](#database)
2. [Tables](#tables)
	1. [Change](#change)
		1. [SQL Creation](#sql-creation)
	2. [Permission](#permission)
		1. [SQL Command](#sql-command)
		2. [Values](#values)
			1. [SQL Insert](#sql-insert)
	3. [Priority](#priority)
		1. [SQL Creation](#sql-creation-1)
		2. [Values](#values-1)
			1. [SQL Insert](#sql-insert-1)
	4. [Result](#result)
		1. [SQL Creation](#sql-creation-2)
		2. [Values](#values-2)
			1. [SQL Insert](#sql-insert-2)
	5. [Status](#status)
		1. [SQL Creation](#sql-creation-3)
		2. [Values](#values-3)
			1. [SQL Insert](#sql-insert-3)
	6. [Type](#type)
		1. [SQL Creation](#sql-creation-4)
		2. [Values](#values-4)
			1. [SQL Insert](#sql-insert-4)
	7. [User](#user)
		1. [SQL Creation](#sql-creation-5)
3. [Views](#views)
	1. [Metric](#metric)

## Database

```sql
CREATE OR REPLACE DATABASE crm;
```

## Tables

### Change

| Column Name           | Description                                                                  | Datatype           |
| --------------------- | ---------------------------------------------------------------------------- | ------------------ |
| id                    |                                                                              | BINARY(16)         |
| owner                 | Change Owner (`ID`)                                                          | BINARY(16)         |
| requestor             | Change Requestor (`ID`)                                                      | BINARY(16)         |
| description           | Description of change being requested.                                       | TEXT(65535)        |
| business_case         | Business case for the change.                                                | TEXT(65535)        |
| business_impact       | Business units impacted by the change?                                       | TEXT(65535)        |
| it_impact             | IT Infrastructure Systems Impacted by the Change.                            | TEXT(65535)        |
| service_impact        | Services impacted by the change?                                             | TEXT(65535)        |
| communication_plan    | What is the communication plan for the change?                               | TEXT(65535)        |
| risk                  | What are the risks to business operations?                                   | TEXT(65535)        |
| regulatory_compliance | Select any regulatory compliance items that may be impacted.                 | TEXT(65535)        |
| documentation         | Describe the implementation plan or list SOP for the process.                | TEXT(65535)        |
| recovery_procedure    | Describe the back out procedure in case of failure.                          | TEXT(65535)        |
| test_procudure        | Describe the test procedure to be used prior to implementation in production | TEXT(65535)        |
| change_date           | Proposed Implementation Date                                                 | DATETIME           |
| changers              | Who are the required personnel to complete the change?                       | JSON               |
| expected_time         | What is the estimated hours to complete the change?                          | mediumint unsigned |
| expected_duration     | If a system outage is expected, what is the duration?                        | mediumint unsigned |
| priority              | Normal or Emergency                                                          | TINYINT UNSIGNED   |
| type                  | Low, Medium, High, Emergency                                                 | TINYINT UNSIGNED   |
| review_date           |                                                                              | DATETIME           |
| reviewers             |                                                                              | JSON               |
| status                |                                                                              | TINYINT UNSIGNED   |
| result                |                                                                              | TINYINT UNSIGNED   |
| notes                 |                                                                              | TEXT(65535)        |
| completion_date       |                                                                              | DATETIME           |
| creation_date         |                                                                              | DATETIME           |

#### SQL Creation

```sql
CREATE TABLE `Change` (
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
	recovery_procedure TEXT( 6553),
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
```

### Permission

| Column Name | Description      | Datatype         |
| ----------- | ---------------- | ---------------- |
| id          | Auto-incremented | TINYINT UNSIGNED |
| name        |                  | VARCHAR(64)      |
| description |                  | VARCHAR(256)     |

#### SQL Command

```sql
CREATE TABLE `Permission` (
	id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(64) NOT NULL,
	description VARCHAR(256) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
```

#### Values

| ID  | Name          | Description                 |
| --- | ------------- | --------------------------- |
| 1   | Void          | Catch-all failure.          |
| 2   | Administrator | Full system administration. |
| 3   | Viewer        | View only access.           |
| 4   | Reviewer      | Review changes.             |

##### SQL Insert

```sql
INSERT INTO Permission values
(1, "Void", "Catch-all failure."), 
(2, "Administrator", "Full system administration."), 
(3, "Viewer", "View only access."), 
(4, "Reviewer", "Review changes.");
```

### Priority

| Column Name | Description      | Datatype         |
| ----------- | ---------------- | ---------------- |
| id          | Auto-incremented | TINYINT UNSIGNED |
| name        |                  | VARCHAR          |
| description |                  | VARCHAR          |

#### SQL Creation

```sql
CREATE TABLE `Priority` (
	id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(64) NOT NULL,
	description VARCHAR(256) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
```

#### Values

| ID  | Name      | Description |
| --- | --------- | ----------- |
| 1   | Void      | Catch-all.  |
| 2   | Low       |             |
| 3   | Medium    |             |
| 4   | High      |             |
| 5   | Emergency |             |

##### SQL Insert

```sql
INSERT INTO Priority values
(1, "Void", "Catch-all."),
(2, "Low", ""),
(3, "Medium", ""),
(4, "High", ""),
(5, "Emergency", "");
```

### Result

| Column Name | Description      | Datatype         |
| ----------- | ---------------- | ---------------- |
| id          | Auto-incremented | TINYINT UNSIGNED |
| name        |                  | VARCHAR          |
| description |                  | VARCHAR          |

#### SQL Creation

```sql
CREATE TABLE `Result` (
	id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(64) NOT NULL,
	description VARCHAR(256) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
```

#### Values

| ID  | Name       | Description                            |
| --- | ---------- | -------------------------------------- |
| 1   | Void       | Initial value and catch-all.           |
| 2   | Successful | The change has been done successfully. |
| 3   | Failed     | The change failed to be done.          |
| 4   | Cancelled  | The change was cancelled.              |

##### SQL Insert

```sql
INSERT INTO Result values
(1, "Void", "Initial value and catch-all."),
(2, "Successful", "The change has been done successfully."),
(3, "Failed", "The change failed to be done."),
(4, "Cancelled", "The change was cancelled.");
```

### Status

| Column Name | Description      | Datatype         |
| ----------- | ---------------- | ---------------- |
| id          | Auto-incremented | TINYINT UNSIGNED |
| name        |                  | VARCHAR          |
| description |                  | VARCHAR          |

#### SQL Creation

```sql
CREATE TABLE `Status` (
	id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(64) NOT NULL,
	description VARCHAR(256) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
```

#### Values

| ID  | Name      | Description                                                        |
| --- | --------- | ------------------------------------------------------------------ |
| 1   | Void      | Initial request creation status, also acts as a catch-all failure. |
| 2   | Draft     | A draft of a request.                                              |
| 3   | Requested | The change has been requested and is awaiting approval.            |
| 4   | Approved  | The change has been approved!                                      |
| 5   | Denied    | The change has been denied.                                        |
| 6   | Deleted   | The change has been deleted.                                       |

##### SQL Insert

```sql
INSERT INTO Status values
(1, "Void", "Initial request creation status, also acts as a catch-all failure."),
(2, "Draft", "A draft of a request."),
(3, "Requested", "The change has been requested and is awaiting approval."),
(4, "Approved", "The change has been approved!"),
(5, "Denied", "The change has been denied."),
(6, "Deleted", "The change has been deleted.");
```

### Type

| Column Name | Description      | Datatype         |
| ----------- | ---------------- | ---------------- |
| id          | Auto-incremented | TINYINT UNSIGNED |
| name        |                  | VARCHAR          |
| description |                  | VARCHAR          |

#### SQL Creation

```sql
CREATE TABLE `Type` (
	id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(64) NOT NULL,
	description VARCHAR(256) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
```

#### Values

| ID  | Name      | Description                 |
| --- | --------- | --------------------------- |
| 1   | Void      | Catch-all.                  |
| 2   | Normal    | A planned change.           |
| 3   | Emergency | An urgent unplanned change. |

##### SQL Insert

```sql
INSERT INTO Type values
(1, "Void", "Catch-all."),
(2, "Normal", "A planned change."),
(3, "Emergency", "An urgent unplanned change.");
```

### User

| Column Name   | Description         | Datatype         |
| ------------- | ------------------- | ---------------- |
| id            | Auto-generated      | BINARY(16)       |
| username      |                     | VARCHAR(64)      |
| first_name    |                     | VARCHAR(50)      |
| last_name     |                     | VARCHAR(50)      |
| email         | Email Address       | VARCHAR(254)     |
| permission_id | FK of Permission id | TINYINT UNSIGNED |

#### SQL Creation

```sql
CREATE TABLE `User` (
	id BINARY(16) NOT NULL DEFAULT UUID() PRIMARY KEY,
	username VARCHAR(64) NOT NULL,
	first_name VARCHAR(64) NOT NULL,
	last_name VARCHAR(64) NOT NULL,
	email VARCHAR(254) NOT NULL,
	permission TINYINT UNSIGNED NOT NULL,
	CONSTRAINT `fk_permission` FOREIGN KEY (permission) REFERENCES Permission (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
	INDEX ix_permission (permission)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
```


## Views

### Metric

