<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once(__DIR__ . '/../includes/loader.php');
setHTTPCaching(true, false, 9600);

$requestors = getAllRequestors();
$priorities = getAllPriority();
$types = getAllType();
// $reviewers = getAllReviewers();
// $statuses = getAllStatus();
// $results = getAllResult();


require_once(__DIR__ . '/../templates/header.php');
?>

<main>
	<h2>New Change Form</h2>
	<form id="new-change-form" action="change/new.php" method="POST">
		<label for="owner">Owner:</label><input type="text" name="owner" placeholder="Owner">
		<label for="requestor">Requestor:</label><select name="requestor" class="select2">
			<?php
			foreach ($requestors as $requestor)
			{
				echo $requestor->displayOption();
			}
			?>
		</select>
		<label for="description">Description:</label><textarea name="description" placeholder="Description" class="resizable"></textarea>
		<label for="business_case">Business Case:</label><textarea name="business_case" placeholder="Business Case" class="resizable"></textarea>
		<label for="business_impact">Business Impact:</label><textarea name="business_impact" placeholder="Business Impact" class="resizable"></textarea>
		<label for="it_impact">IT Impact:</label><textarea name="it_impact" placeholder="IT Impact" class="resizable"></textarea>
		<label for="service_impact">Service Impact:</label><textarea name="service_impact" placeholder="Service Impact" class="resizable"></textarea>
		<label for="communication_plan">Communication Plan:</label><textarea name="communication_plan" placeholder="Communication Plan" class="resizable"></textarea>
		<label for="risk">Risk:</label><textarea name="risk" placeholder="Risk" class="resizable"></textarea>
		<label for="regulatory_compliance">Regulatory Compliance:</label><textarea name="regulatory_compliance" placeholder="Regulatory Compliance" class="resizable"></textarea>
		<label for="documentation">Documentation:</label><textarea name="documentation" placeholder="Documentation" class="resizable"></textarea>
		<label for="recovery_procedure">Recovery Procedure:</label><textarea name="recovery_procedure" placeholder="Recovery Procedure" class="resizable"></textarea>
		<label for="test_procedure">Test Procedure:</label><textarea name="test_procedure" placeholder="Test Procedure" class="resizable"></textarea>
		<label for="change_date">Change Date:</label><duet-date-picker name="change_date" placeholder="Change Date"></duet-date-picker>
		<label for="expected_time">Expected Time:</label><input type="number" name="expected_time" placeholder="Expected Time">
		<label for="expected_duration">Expected Duration:</label><input type="number" name="expected_duration" placeholder="Expected Duration">
		<label for="priority">Priority:</label><select name="priority" class="select2">
			<?php
			foreach ($priorities as $priority)
			{
				echo $priority->displayOption();
			}
			?>
		</select>
		<label for="type">Type:</label><select name="type" class="select2">
			<?php
			foreach ($types as $type)
			{
				echo $type->displayOption();
			}
			?>
		</select>
		<label for="review_date">Review Date:</label><duet-date-picker name="review_date" placeholder="Review Date"></duet-date-picker>
		<label for="notes">Notes:</label><textarea name="notes" placeholder="Notes" class="resizable"></textarea>
		<label for="completion_date">Completion Date:</label><duet-date-picker name="completion_date" placeholder="Completion Date"></duet-date-picker>

		<input type="submit" value="submit" style="grid-column: span 2;">
	</form>

	<?php echo '<span id="processing-time-full">' . $GLOBALS['timer']['full']->stop() . '</span>'; ?>
</main>

<?php require_once(__DIR__ . '/../templates/footer.php'); ?>