<?php # Script 9.5 - register.php #2
// This script performs an INSERT query to add a record to the users table.

$page_title = 'Add Book Copy';
include ('includes/header.html');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Check for a first name:
	if (empty($_POST['copyNo'])) {
		$errors[] = 'You forgot to enter the Copy Number.';
	} else {
		$c = mysqli_real_escape_string($dbc, trim($_POST['copyNo']));
	}
	
	// Check for a last name:
	if (empty($_POST['status'])) {
		$errors[] = 'You forgot to enter the status of the book.';
	} else {
		$s = mysqli_real_escape_string($dbc, trim($_POST['status']));
	}
	
	// Check for an email address:
	if (empty($_POST['loanPeriod'])) {
		$errors[] = 'You forgot to enter the Loan Period.';
	} else {
		$lp = mysqli_real_escape_string($dbc, trim($_POST['loanPeriod']));
	}
	
	// Check for an email address:
	if (empty($_POST['Book_ISBN'])) {
		$errors[] = 'You forgot to enter the ISBN of the book.';
	} else {
		$bisbn = mysqli_real_escape_string($dbc, trim($_POST['Book_ISBN']));
	}
	

	
	if (empty($errors)) { // If everything's OK.
	
		// Register the user in the database...
		
		// Make the query:
		$q="INSERT INTO `Book Copy` (copyNo, status, loanPeriod, Book_ISBN) VALUES ('$c', '$s', '$lp', '$bisbn' )";	
		
                $r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			echo '<h1>Thank you!</h1>
		<p>You have now added a book copy! </p><p><br /></p>';	
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not add a book copy due to a system error. We apologize for any inconvenience.</p>'; 
			
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
<h1>Add Book Copy</h1>
<form action="copy.php" method="post">
	<p>Copy Number: <input type="text" name="copyNo" size="20" maxlength="30" value="<?php if (isset($_POST['copyNo'])) echo $_POST['copyNo']; ?>" /></p>
	<p>Status: <input type="text" name="status" size="30" maxlength="40" value="<?php if (isset($_POST['status'])) echo $_POST['status']; ?>" /></p>
	<p>Loan Period: <input type="text" name="loanPeriod" size="5" maxlength="10" value="<?php if (isset($_POST['loanPeriod'])) echo $_POST['loanPeriod']; ?>"/></p>
	<p>Book ISBN: <input type="text" name="Book_ISBN" size="10" maxlength="20" value="<?php if (isset($_POST['Book_ISBN'])) echo $_POST['Book_ISBN']; ?>"  /></p>
	<p><input type="submit" name="submit" value="Add Book Copy" /></p>
</form>
<?php include ('includes/footer.html'); ?>