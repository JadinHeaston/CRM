<?php
require_once(__DIR__ . '/../includes/loader.php');

// $priorities = getAllPriority();
// $types = getAllType();
// $statuses = getAllStatus();
// $results = getAllResult();

require_once(__DIR__ . '/../templates/header.php');
?>

<main>
	<h2>New Change</h2>
	<form id="new-change-form" action="change/new.php" method="POST">
		<label for="owner">Owner:</label><input type="text" name="owner" placeholder="Owner">
		<label for="requestor">Requestor:</label><select name="requestor"></select>
		<label for="description">Description:</label><input type="textarea" name="description" placeholder="Description">
		<label for="business_case">Business Case:</label><input type="textarea" name="business_case" placeholder="Business Case">
		<label for="business_impact">Business Impact:</label><input type="textarea" name="business_impact" placeholder="Business Impact">
		<label for="it_impact">IT Impact:</label><input type="textarea" name="it_impact" placeholder="IT Impact">
		<label for="service_impact">Service Impact:</label><input type="textarea" name="service_impact" placeholder="Service Impact">
		<label for="communication_plan">Communication Plan:</label><input type="textarea" name="communication_plan" placeholder="Communication Plan">
		<label for="risk">Risk:</label><input type="textarea" name="risk" placeholder="Risk">
		<label for="regulatory_compliance">Regulatory Compliance:</label><input type="textarea" name="regulatory_compliance" placeholder="Regulatory Compliance">
		<label for="documentation">Documentation:</label><input type="textarea" name="documentation" placeholder="Documentation">
		<label for="recovery_procedure">Recovery Procedure:</label><input type="textarea" name="recovery_procedure" placeholder="Recovery Procedure">
		<label for="test_procedure">Test Procedure:</label><input type="textarea" name="test_procedure" placeholder="Test Procedure">
		<label for="change_date">Change Date:</label><duet-date-picker name="change_date" placeholder="Change Date"></duet-date-picker>
		<label for="expected_time">Expected Time:</label><input type="number" name="expected_time" placeholder="Expected Time">
		<label for="expected_duration">Expected Duration:</label><input type="number" name="expected_duration" placeholder="Expected Duration">
		<label for="priority">Priority:</label><select name="priority"></select>
		<label for="type">Type:</label><select name="type"></select>
		<label for="review_date">Review Date:</label><duet-date-picker name="review_date" placeholder="Review Date"></duet-date-picker>
		<label for="reviewers">Reviewers:</label><select name="reviewers"></select>
		<label for="status">Status:</label><select name="status"></select>
		<label for="result">Result:</label><select name="result"></select>
		<label for="notes">Notes:</label><input type="textarea" name="notes" placeholder="Notes">
		<label for="completion_date">Completion Date:</label><duet-date-picker name="completion_date" placeholder="Completion Date"></duet-date-picker>
	</form>
</main>

<?php require_once(__DIR__ . '/../templates/footer.php'); ?>