# Database Schema <!-- omit in toc -->

## ToC <!-- omit in toc -->

1. [Tables](#tables)
	1. [Change](#change)
		1. [SQL Creation](#sql-creation)
	2. [User](#user)
		1. [SQL Creation](#sql-creation-1)
	3. [Permission](#permission)
		1. [SQL Command](#sql-command)
		2. [Values](#values)
			1. [SQL Insert](#sql-insert)
	4. [Priority](#priority)
		1. [SQL Creation](#sql-creation-2)
		2. [Values](#values-1)
			1. [SQL Insert](#sql-insert-1)
	5. [Status](#status)
		1. [SQL Creation](#sql-creation-3)
		2. [Values](#values-2)
			1. [SQL Insert](#sql-insert-2)
	6. [Type](#type)
		1. [SQL Creation](#sql-creation-4)
		2. [Values](#values-3)
			1. [SQL Insert](#sql-insert-3)
2. [Views](#views)
	1. [Metric](#metric)

## Tables

### Change

| Column Name           | Description                                                                  | Datatype           |
| --------------------- | ---------------------------------------------------------------------------- | ------------------ |
| id                    |                                                                              | UUID               |
| owner                 | Change Owner (`ID`)                                                          | UUID               |
| requestor             | Change Requestor (`ID`)                                                      | UUID               |
| description           | Description of change being requested.                                       | VARCHAR            |
| business_case         | Business case for the change.                                                | VARCHAR            |
| business_impact       | Business units impacted by the change?                                       | VARCHAR            |
| it_impact             | IT Infrastructure Systems Impacted by the Change.                            | VARCHAR            |
| service_impact        | Services impacted by the change?                                             | VARCHAR            |
| communication_plan    | What is the communication plan for the change?                               | VARCHAR            |
| risk                  | What are the risks to business operations?                                   | VARCHAR            |
| regulatory_compliance | Select any regulatory compliance items that may be impacted.                 | VARCHAR            |
| documentation         | Describe the implementation plan or list SOP for the process.                | VARCHAR            |
| recovery_procedure    | Describe the back out procedure in case of failure.                          | VARCHAR            |
| test_procudure        | Describe the test procedure to be used prior to implementation in production | VARCHAR            |
| change_date           | Proposed Implementation Date                                                 | DATETIME           |
| changers              | Who are the required personnel to complete the change?                       | JSON               |
| expected_time         | What is the estimated hours to complete the change?                          | mediumint unsigned |
| expected_duration     | If a system outage is expected, what is the duration?                        | mediumint unsigned |
| priority              | Normal or Emergency                                                          | TINYINT UNSIGNED   |
| type                  | Low, Medium, High, Emergency                                                 | TINYINT UNSIGNED   |
| review_date           |                                                                              | DATETIME           |
| reviewers             |                                                                              | JSON               |
| status                |                                                                              | TINYINT UNSIGNED   |
| result                |                                                                              |                    |
| notes                 |                                                                              | VARCHAR            |
| completion_date       |                                                                              | DATETIME           |
| creation_date         |                                                                              | DATETIME           |

#### SQL Creation

```sql
CREATE TABLE `Change` (
	id UUID NOT NULL DEFAULT UUID() PRIMARY KEY,
	owner UUID NOT NULL,
	requestor UUID NOT NULL,
	description VARCHAR NOT NULL,
	business_case VARCHAR NOT NULL,
	business_impact VARCHAR NOT NULL,
	it_impact VARCHAR NULL,
	service_impact VARCHAR NULL,
	communication_plan VARCHAR NULL,
	risk VARCHAR NULL,
	regulatory_compliance VARCHAR NULL,
	documentation VARCHAR NOT NULL,
	recovery_procedure VARCHAR,
	test_procudure VARCHAR NULL,
	change_date DATETIME NOT NULL,
	changers json NOT NULL,
	expected_time NOT NULL MEDIUMINT UNSIGNED,
	expected_duration NOT NULL MEDIUMINT UNSIGNED,
	priority TINYINT UNSIGNED NOT NULL,
	type NOT NULL REFERENCES Type,
	review_date DATETIME NULL,
	reviewers json NULL,
	status TINYINT UNSIGNED NOT NULL REFERENCES Status,
	result __WIP__ NULL,
	notes VARCHAR NULL,
	creation_date DATETIME NOT NULL,
	completion_date DATETIME NULL,
	CONSTRAINT CHECK (JSON_VALID(changers)),
	CONSTRAINT CHECK (JSON_VALID(reviewers)),
	CONSTRAINT `fk_priority` FOREIGN KEY (priority) REFERENCES Priority (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT `fk_type` FOREIGN KEY (type) REFERENCES Type (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
	CONSTRAINT `fk_status` FOREIGN KEY (status) REFERENCES Status (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
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

### User

| Column Name   | Description         | Datatype         |
| ------------- | ------------------- | ---------------- |
| id            | Auto-generated      | UUID             |
| first_name    |                     | VARCHAR(50)      |
| last_name     |                     | VARCHAR(50)      |
| email         | Email Address       | VARCHAR(254)     |
| permission_id | FK of Permission id | TINYINT UNSIGNED |

#### SQL Creation

```sql
CREATE TABLE `User` (
	id UUID NOT NULL DEFAULT UUID() PRIMARY KEY,
	first_name VARCHAR(64) NOT NULL,
	last_name VARCHAR(64) NOT NULL,
	email VARCHAR(254) NOT NULL,
	permission TINYINT UNSIGNED NOT NULL,
	CONSTRAINT `fk_permission` FOREIGN KEY (permission) REFERENCES Permission (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
	INDEX ix_permission (permission)
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
	description VARCHAR(256) NOT NULL,
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
```

#### Values

| ID  | Name          | Description                 |
| --- | ------------- | --------------------------- |
| 0   | Void          | Catch-all failure.          |
| 1   | Administrator | Full system administration. |
| 2   | Viewer        | View only access.           |
| 3   | Reviewer      | Review changes.             |

##### SQL Insert

```sql
INSERT INTO Status values(0, "Void", "Catch-all failure."),
INSERT INTO Status values(1, "Administrator", "Full system administration."),
INSERT INTO Status values(2, "Viewer", "View only access."),
INSERT INTO Status values(3, "Reviewer", "Review changes.");
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
	description VARCHAR(256) NOT NULL,
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
```

#### Values

| ID  | Name       | Description                            |
| --- | ---------- | -------------------------------------- |
| 0   | Void       | Initial value and catch-all.           |
| 1   | Successful | The change has been done successfully. |
| 2   | Failed     | The change failed to be done.          |
| 3   | Cancelled  | The change was cancelled.              |

##### SQL Insert

```sql
INSERT INTO Status values(0, "Void", "Initial value and catch-all."),
INSERT INTO Status values(1, "Successful", "The change has been done successfully."),
INSERT INTO Status values(2, "Failed", "The change failed to be done."),
INSERT INTO Status values(3, "Cancelled", "The change was cancelled.");
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
	description VARCHAR(256) NOT NULL,
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
```

#### Values

| ID  | Name            | Description                                                        |
| --- | --------------- | ------------------------------------------------------------------ |
| 0   | Void            | Initial request creation status, also acts as a catch-all failure. |
| 1   | Draft           | A draft of a request.                                              |
| 2   | Requested       | The change has been requested and is awaiting approval.            |
| 3   | Awaiting Review | The change is awaiting review by an approver.                      |
| 4   | Approved        | The change has been approved!                                      |
| 5   | Denied          | The change has been denied.                                        |
| 6   | Deleted         | The change has been deleted.                                       |

##### SQL Insert

```sql
INSERT INTO Status values(0, "Void", "Initial request creation status, also acts as a catch-all failure."),
INSERT INTO Status values(1, "Draft", "A draft of a request."),
INSERT INTO Status values(2, "Requested", "The change has been requested and is awaiting approval."),
INSERT INTO Status values(3, "Awaiting Review", "The change is awaiting review by an approver."),
INSERT INTO Status values(4, "Approved", "The change has been approved!"),
INSERT INTO Status values(5, "Denied", "The change has been denied."),
INSERT INTO Status values(6, "Deleted", "The change has been deleted.");
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
	description VARCHAR(256) NOT NULL,
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
```

#### Values

| ID  | Name      | Description                 |
| --- | --------- | --------------------------- |
| 0   | Void      | Catch-all.                  |
| 1   | Normal    | A planned change.           |
| 2   | Emergency | An urgent unplanned change. |

##### SQL Insert

```sql
INSERT INTO Status values(0, "Void", "Catch-all."),
INSERT INTO Status values(1, "Normal", "A planned change."),
INSERT INTO Status values(2, "Emergency", "An urgent unplanned change.");
```

## Views

### Metric

