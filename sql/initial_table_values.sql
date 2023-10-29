USE crm;

-- Permission
INSERT INTO Permission (id, name, description) values
(1, 'Void', 'Catch-all.'), 
(2, 'Administrator', 'Full system administration.'), 
(3, 'Viewer', 'View only access.'), 
(4, 'Requestor', 'Request changes.');
(5, 'Reviewer', 'Review changes.');

-- Priority
INSERT INTO Priority (id, name, description) values
(1, 'Void', 'Catch-all.'),
(2, 'Low', ''),
(3, 'Medium', ''),
(4, 'High', ''),
(5, 'Emergency', '');

-- Result
INSERT INTO Result (id, name, description) values
(1, 'Void', 'Initial value and catch-all.'),
(2, 'Successful', 'The change has been done successfully.'),
(3, 'Failed', 'The change failed to be done.'),
(4, 'Cancelled', 'The change was cancelled.');

-- Status
INSERT INTO Status (id, name, description) values
(1, 'Void', 'Initial request creation status, also acts as a catch-all failure.'),
(2, 'Draft', 'A draft of a request.'),
(3, 'Requested', 'The change has been requested and is awaiting approval.'),
(4, 'Approved', 'The change has been approved!'),
(5, 'Denied', 'The change has been denied.'),
(6, 'Deleted', 'The change has been deleted.');

-- Type
INSERT INTO Type (id, name, description) values
(1, 'Void', 'Catch-all.'),
(2, 'Normal', 'A planned change.'),
(3, 'Emergency', 'An urgent unplanned change.');
