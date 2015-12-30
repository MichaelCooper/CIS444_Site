<!DOCTYPE html>
<!--get_info_from_server.php-->

	<?php
		$host = "localhost";
		$username = "groupb";
		$password = "d67G8PKE";
		$database = "groupb";
			
		$DBConnect = @mysqli_connect($host, $username, $password, $database)
			Or die("<p>The Database server was not availble.</p>"
				 . "<p>Error code " .mysqli_connect_errno()
				 . ": " . mysqli_connect_error() . "</p>");
		
		$query = "SELECT * FROM Games";

		// Perform Query
		$result = mysqli_query($DBConnect, $query)
			Or die("<p>Unable to execute query.</p>"
				 . "<p>Error code " .mysqli_connect_errno()
				 . ": " . mysqli_connect_error() . "</p>");
	
		
		$result_row = mysqli_fetch_assoc($result);	
		$keys = array_keys($result_row);
		
		
		echo "<table width='100%' border='1'>";
		echo "<tr>";
		foreach($keys as $k){
			echo "<th>$k</th>";
		}
		
		do{
			echo "<tr>";
			foreach($result_row as $r){
				echo "<td>$r</td>";
			}
			$result_row = mysqli_fetch_assoc($result);
		}
		while(($result_row));
		echo "</table>"; 
		mysqli_close($DBConnect);			
	?>
