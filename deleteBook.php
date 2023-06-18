<?php # Script 9.5 - register.php #2
// This script performs an INSERT query to add a record to the users table.

$page_title = 'Delete Book';
include ('includes/header.html');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Check for a first name:
	if (empty($_POST['ISBN'])) {
		$errors[] = 'You forgot to enter the ISBN.';
	} else {
		$isbn = mysqli_real_escape_string($dbc, trim($_POST['ISBN']));
	}
	
	
	
	if (empty($errors)) { // If everything's OK.
	
		// Register the user in the database...
		
		// Make the query:
		$q="CALL delete_book('$isbn')";	
		//$q="CALL register_proc('$fn', '$ln', '$e', '$p')";
                $r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			echo '<h1>Thank you!</h1>
		<p>You have deleted the book!</p><p><br /></p>';	
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not delete the book due to a system error. We apologize for any inconvenience.</p>'; 
			
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
<h1>Delete Book</h1>
<form action="deleteBook.php" method="post">
	<p>ISBN: <input type="text" name="ISBN" size="15" maxlength="20" value="<?php if (isset($_POST['ISBN'])) echo $_POST['ISBN']; ?>" /></p>
	
	<p><input type="submit" name="submit" value="Delete Book" /></p>
</form>
<?php include ('includes/footer.html'); ?>