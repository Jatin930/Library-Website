<?php # Script 9.6 - view_users.php #2
// This script retrieves all the records from the users table.

$page_title = 'View the Current Users';
include ('includes/header.html');

// Page header:
echo '<h1>Book Information</h1>';

require ('mysqli_connect.php'); // Connect to the db.
		
// Make the query:
$q="SELECT ISBN AS num, title AS booktitle, edition AS ednum, DATE_FORMAT(yearPublished, '%M %d, %Y') AS yp FROM Book ORDER BY title ASC;";
//$q = "call get_users();";
//$q1 = "call Get_Users_dropdown();";
$r = @mysqli_query($dbc, $q); // Run the query.		

$num = mysqli_num_rows($r);
//echo "<select name='book'>"; 
//echo "<option size =30 ></option>";
//while($row1 = mysqli_fetch_array($r1, MYSQLI_ASSOC))
//{        
//echo "<option value='".$row1['dr']."'>".$row1['name']."</option>"; 
//}
//echo "</select>";
//mysqli_free_result ($r1);
// Count the number of returned rows:
//$r = $dbc-> query ($q); // Run the query.
//$num = mysqli_num_rows($r);

if ($num > 0) { // If it ran OK, display the records.

	// Print how many users there are:
	echo "<p>There are currently $num books in the library.</p>\n";

	// Table header.
	echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
	<tr><td align="left"><b>ISBN</b></td><td align="left"><b>Book Title</b></td><td align="left"><b>Edition</b></td><td align="left"><b>Date Published</b></td></tr>
';
	
	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '<tr><td align="left">' . $row['num'] . '</td><td align="left">' . $row['booktitle'] . '<td align="left">' . $row['ednum'] . '<td align="left">' . $row['yp'] .'</td> </tr>
		';
	}

	echo '</table>'; // Close the table.
	
	//mysqli_free_result ($r); // Free up the resources.	

} else { // If no records were returned.

	echo '<p class="error">There are currently no registered users.</p>';

}



mysqli_close($dbc); // Close the database connection.

include ('includes/footer.html');
?>