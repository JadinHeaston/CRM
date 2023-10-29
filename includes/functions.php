<?PHP

/**
 * Converts a number of seconds into a human readable format.
 *
 * @param integer $seconds
 * @return string
 */
function secondsToHumanTime(int $seconds)
{
	if ($seconds >= 86400)
		$format[] = '%a day' . ($seconds > 86400 * 2 ? 's' : '');
	if ($seconds >= 3600)
		$format[] = '%h hour' . ($seconds > 3600 * 2 ? 's' : '');
	if ($seconds >= 60)
		$format[] = '%i minute' . ($seconds > 60 * 2 ? 's' : '');
	$format[] = '%s ' . ($seconds !== 1 ? 'seconds' : 'second');

	$dateHandle = new DateTime('@0');
	return str_replace(' 1 seconds', ' 1 second', $dateHandle->diff(new DateTime("@$seconds"))->format(implode(', ', $format)));
}

function rotate(array $array)
{
	array_unshift($array, null);
	$array = call_user_func_array('array_map', $array);
	$array = array_map('array_reverse', $array);
	return $array;
}

function getAllPermission()
{
	global $connection;
	$output = array();

	$results = $connection->select('SELECT * FROM Permission');
	if ($results === false)
		throw new Exception('Query failed. Contact adminstrator.');
	foreach ($results as $row)
	{
		$output[] = Permission::from($row['id']);
	}
	return $output;
}

function getAllPriority()
{
	global $connection;
	$output = array();

	$results = $connection->select('SELECT * FROM Priority');
	if ($results === false)
		throw new Exception('Query failed (Priority). Contact adminstrator.');
	foreach ($results as $row)
	{
		$output[] = Priority::from($row['id']);
	}
	return $output;
}

function getAllType()
{
	global $connection;
	$output = array();

	$results = $connection->select('SELECT * FROM Type');
	if ($results === false)
		throw new Exception('Query failed (Type). Contact adminstrator.');
	foreach ($results as $row)
	{
		$output[] = Type::from($row['id']);
	}
	return $output;
}

function getAllStatus()
{
	global $connection;
	$output = array();

	$results = $connection->select('SELECT * FROM Status');
	if ($results === false)
		throw new Exception('Query failed (Status). Contact adminstrator.');
	foreach ($results as $row)
	{
		$output[] = Status::from($row['id']);
	}
	return $output;
}

function getAllResult()
{
	global $connection;
	$output = array();

	$results = $connection->select('SELECT * FROM Result');
	if ($results === false)
		throw new Exception('Query failed (Result). Contact adminstrator.');
	foreach ($results as $row)
	{
		$output[] = Result::from($row['id']);
	}
	return $output;
}

function getAllUser()
{
	global $connection;
	$output = array();

	$results = $connection->select('SELECT * FROM User');
	if ($results === false)
		throw new Exception('Query failed (User). Contact adminstrator.');
	foreach ($results as $row)
	{
		$user = new User;
		$user->id = $row['id'];
		$user->username = $row['username'];
		$user->firstName = $row['first_name'];
		$user->lastName = $row['last_name'];
		$user->email = $row['email'];
		$user->permission = $row['permission'];
		$output[] = $user;
	}
	return $output;
}
