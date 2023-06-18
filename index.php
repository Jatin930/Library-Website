<?php # Script 3.4 - index.php
$page_title = 'Welcome to this Site!';
include ('./includes/header.html');
?>
<h1 id="mainhead">Welcome to the Library!</h1>
<br>
<h2>What can you do?</h2>
<br>
<b>Here at the library you can do many things like... </b>

<ul>
	<br>
<li>Make An Account By Registering</li>
<li>View/Delete Registered Users</li>
<li>Change Password Of User</li>
<li>Add/View/Delete Books</li>
<li>Add/View Book Copies</li>
<li>Add/View Borrower</li>



</ul>
<br><br>
<br>


<?php
echo ' 
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<img src="https://pbs.twimg.com/media/CHuGRaNUAAEL0SY.png" width="700" height="350" style="padding-left:25px" title="LIbrary" alt="Logo of a company" />

</html>
';
?>





<?php
include ('./includes/footer.html');
?>