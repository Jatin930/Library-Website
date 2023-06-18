<?php # Script 9.5 - register.php #2
// This script performs an INSERT query to add a record to the users table.

$page_title = 'Add Borrower';
include ('includes/header.html');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Check for a first name:
	if (empty($_POST['borrowerID'])) {
		$errors[] = 'You forgot to enter the Borrower ID.';
	} else {
		$bid = mysqli_real_escape_string($dbc, trim($_POST['borrowerID']));
	}
	
	// Check for a last name:
	if (empty($_POST['firstName'])) {
		$errors[] = 'You forgot to enter the First Name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['firstName']));
	}
	
	// Check for an email address:
	if (empty($_POST['lastName'])) {
		$errors[] = 'You forgot to enter the Last Name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['lastName']));
	}
	
	
	// Check for an email address:
	if (empty($_POST['address'])) {
		$errors[] = 'You forgot to enter the Address.';
	} else {
		$a = mysqli_real_escape_string($dbc, trim($_POST['address']));
	}

	// Check for an email address:
	if (empty($_POST['city'])) {
		$errors[] = 'You forgot to enter the City.';
	} else {
		$c = mysqli_real_escape_string($dbc, trim($_POST['city']));
	}

	// Check for an email address:
	if (empty($_POST['state'])) {
		$errors[] = 'You forgot to enter the State.';
	} else {
		$s = mysqli_real_escape_string($dbc, trim($_POST['state']));
	}

	// Check for an email address:
	if (empty($_POST['zip'])) {
		$errors[] = 'You forgot to enter the Zip.';
	} else {
		$z = mysqli_real_escape_string($dbc, trim($_POST['zip']));
	}
	

	
	if (empty($errors)) { // If everything's OK.
	
		// Register the user in the database...
		
		// Make the query:
		$q="INSERT INTO Borrower (borrowerID, firstName, lastName, address, city, state, zip) VALUES ('$bid', '$fn', '$ln', '$a' , '$c',  '$s',  '$z' )";	
                $r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			echo '<h1>Thank you!</h1>
		<p>You have now added a borrower! </p><p><br /></p>';	
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not add a borrower due to a system error. We apologize for any inconvenience.</p>'; 
			
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
						
		} // End of if ($r) IF.
		
		mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		include ('includes/footer.html'); 
		exit();
		
	} else { // Report the errors.
	
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	} // End of if (empty($errors)) IF.
	
	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.
?>
<h1>Add Borrower</h1>
<form action="borrower.php" method="post">
	<p>Borrower ID: <input type="text" name="borrowerID" size="20" maxlength="30" value="<?php if (isset($_POST['borrowerID'])) echo $_POST['borrowerID']; ?>" /></p>
	<p>First Name: <input type="text" name="firstName" size="30" maxlength="40" value="<?php if (isset($_POST['firstName'])) echo $_POST['firstName']; ?>" /></p>
	<p>Last Name: <input type="text" name="lastName" size="5" maxlength="10" value="<?php if (isset($_POST['lastName'])) echo $_POST['lastName']; ?>"/> </p>
	<p>Address: <input type="text" name="address" size="10" maxlength="20" value="<?php if (isset($_POST['address'])) echo $_POST['address']; ?>"  /></p>
	<p>City: <input type="text" name="city" size="20" maxlength="30" value="<?php if (isset($_POST['city'])) echo $_POST['city']; ?>" /></p>
	<p>State: <input type="text" name="state" size="20" maxlength="30" value="<?php if (isset($_POST['state'])) echo $_POST['state']; ?>" /></p>
	<p>Zip: <input type="text" name="zip" size="20" maxlength="30" value="<?php if (isset($_POST['zip'])) echo $_POST['zip']; ?>" /></p>
	<p><input type="submit" name="submit" value="Add Borrower" /></p>
</form>
<?php include ('includes/footer.html'); ?>