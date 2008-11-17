<html>
  <head>
    <title>RPInventory</title>
    <link rel="stylesheet" href="css/styles.css" type="text/css" />
  </head>
  <body>
    <div class="header">
      <h1>RPInventory</h1>
    </div>
    <div class="left_sidebar">
      <a href="main.html">Home</a> <br />
      <a href="viewinventory.php">View Inventory</a> <br />
      <a href="addinventory.html">Add Inventory</a> <br />
      <a href="borrowers.html">View Borrowers</a> <br />
      <a href="loans.html">View Loans</a> <br />
      <a href="repairs.html">View Repairs</a> <br />
      <a href="purchases.html">View Purchases</a> <br />
      <a href="businesses.html">View Businesses</a> <br />
      <a href="login.html">Login</a> <br />
    </div>

    <div class="main_body">
      <?php
	 $db = mysql_connect("localhost", "inventory", "1nvp@ss") or 
	     die("Could not connect: " . mysql_error());
	 mysql_select_db("rpinventory", $db);
	 $query= "SELECT description, location, current_condition 
		  FROM inventory, location 
		  WHERE location.location_id=inventory.location_id";
	 $result = mysql_query($query, $db);
	 $myrow = mysql_fetch_row($result);
	 echo "<table border=1>";
	 echo "<tr><td>Description</td><td>Location</td><td>Condition</td></tr>\n";
	 do{
	 printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>\n", 
	 $myrow[1], $myrow[2], $myrow[3]);
	   } while ($myrow = mysql_fetch_row($result));
	 echo "</table>\n";	 
	 ?>
    </div>

  </body>
</html>
