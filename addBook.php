<?php # Script 9.5 - register.php #2
// This script performs an INSERT query to add a record to the users table.

$page_title = 'Add Book';
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
	
	// Check for a last name:
	if (empty($_POST['title'])) {
		$errors[] = 'You forgot to enter the title of the book.';
	} else {
		$tl = mysqli_real_escape_string($dbc, trim($_POST['title']));
	}
	
	// Check for an email address:
	if (empty($_POST['edition'])) {
		$errors[] = 'You forgot to enter the edition of the book.';
	} else {
		$ed = mysqli_real_escape_string($dbc, trim($_POST['edition']));
	}
	
	// Check for an email address:
	if (empty($_POST['yearPublished'])) {
		$errors[] = 'You forgot to enter the year the book was published.';
	} else {
		$yp = mysqli_real_escape_string($dbc, trim($_POST['yearPublished']));
	}
	

	
	if (empty($errors)) { // If everything's OK.
	
		// Register the user in the database...
		
		// Make the query:
		$q="INSERT INTO Book (ISBN, title, edition, yearPublished) VALUES ('$isbn', '$tl', '$ed', '$yp' )";	
		//$q="CALL register_proc('$fn', '$ln', '$e', '$p')";
                $r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			echo '<h1>Thank you!</h1>
		<p>You have now added a book! </p><p><br /></p>';	
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not add a book due to a system error. We apologize for any inconvenience.</p>'; 
			
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
<h1>Add Book</h1>
<form action="addBook.php" method="post">
	<p>ISBN: <input type="text" name="ISBN" size="20" maxlength="30" value="<?php if (isset($_POST['ISBN'])) echo $_POST['ISBN']; ?>" /></p>
	<p>Title: <input type="text" name="title" size="30" maxlength="40" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>" /></p>
	<p>Edition: <input type="text" name="edition" size="5" maxlength="10" value="<?php if (isset($_POST['edition'])) echo $_POST['edition']; ?>"  /> </p>
	<p>Date Published: <input type="text" name="yearPublished" size="10" maxlength="20" value="<?php if (isset($_POST['yearPublished'])) echo $_POST['yearPublished']; ?>"  /></p>
	<p><input type="submit" name="submit" value="Add Book" /></p>
</form>
<?php include ('includes/footer.html'); ?>