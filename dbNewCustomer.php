<table>
<?php
include('dbcon.php');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "<form method=post>
<tr><td>	Customer Name:		</td><td>	<input type=text name=name>			</td></tr>
<tr><td>	Contact Number:		</td><td>	<input type=number name=contactno>	</td></tr>
<tr><td>	Address:			</td><td>	<input type=text name=address>		</td></tr>
<tr><td>	Birthday:			</td><td>	<input type=date name=bday>			</td></tr>
<tr><td>	Anniversary Date:	</td><td>	<input type=date name=aniv>			</td></tr>
<tr><td>	Product:			</td><td>	
<select name=prod id=prod>			
<option value='Slim'>Slim</option>
<option value='Water Bottle'>Water Bottle</option>
</select>
</td></tr>
<tr><td>	Quantity:			</td><td>	<input type=number name=quantity>	</td></tr>
<tr><td>	Paid:				</td><td>	
<input type=hidden name=paid value=0>
<input type=checkbox name=paid value=1>		
</td></tr>

<tr><td><input type=submit name=btnSubmit value='Place to Order'></td><tr> </form>";


	
if(isset($_POST['btnSubmit'])){
	$name = $_POST['name'];
	$contactno = $_POST['contactno'];	
	$address = $_POST['address'];
	$bday = $_POST['bday'];
	$aniv = $_POST['aniv'];
	$prod = $_POST['prod'];
	$quantity = $_POST['quantity'];
	$paid = $_POST['paid'];

	$sql = "INSERT INTO customers (Name, Address, ContactNo, Bday, Anniversary, Paid)
	VALUES ('$name', '$address', '$contactno', '$bday', '$aniv', '$paid')";
	
	if ($conn->query($sql) === TRUE) {
		  echo "New record created successfully";
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
	$date = date("Y.m.d");
		
	$sql = "INSERT INTO transaction (Date, Quantity)
	VALUES ('$date', '$quantity')";	
	
	
		
	if ($conn->query($sql) === TRUE) {
		  echo "New record created successfully";
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}
}
$conn->close();
?>
</table>