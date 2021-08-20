<table>
<?php
include('dbcon.php');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo "<form method=post>

<tr><td>	Name:			</td><td>	<input type=text name=name>			</td></tr>
<tr><td>	Salary:			</td><td>	<input type=number name=salary>		</td></tr>
<tr><td>	Birthday:		</td><td>	<input type=date name=bday>			</td></tr>
<tr><td>	Address:		</td><td>	<input type=text name=address>		</td></tr>
<tr><td>	Contact Number:	</td><td>	<input type=number name=contactno>	</td></tr>
<tr><td>	Type:			</td><td>	
<select name=type id=type>			
<option value='Part-time'>Part-Time</option>
<option value='Full-time'>Full-Time</option>
</select>
</td></tr>
<tr><td>	Designation:	</td><td>	<input type=text name=designation>	</td></tr>
<tr><td>	TinID			</td><td>	<input type=number name=tinID>		</td></tr>
<tr><td>	SSSID			</td><td>	<input type=number name=SSSID>		</td></tr>
<tr><td>	Tenure			</td><td>	<input type=number name=tenure>		</td></tr>
<tr><td>	Status			</td><td>	
<select name=status id=status>			
<option value='Retired'>Retired</option>
<option value='Resigned'>Resigned</option>
<option value='Active'>Active</option>
<option value='Inactive'>Inactive</option>
<option value='On leave'>On leave</option>
</select>
</td></tr>

<tr><td><input type=submit name=btnSubmit value=Submit></td><tr> </form>";

if(isset($_POST['btnSubmit'])){
	$name = $_POST['name'];
	$salary = $_POST['salary'];
	$bday = $_POST['bday'];
	$address = $_POST['address'];
	$contactno = $_POST['contactno'];
	$type = $_POST['type'];
	$designation = $_POST['designation'];
	$tinID = $_POST['tinID'];
	$SSSID = $_POST['SSSID'];
	$tenure = $_POST['tenure'];
	$status = $_POST['status'];
	$sql = "INSERT INTO employee (Name, Salary, Bday, Address, ContactNo, Type, Designation, TinID, SSSID, Tenure, Status)
	VALUES ('$name', '$salary', '$bday', '$address', '$contactno', '$type', '$designation', '$tinID', '$SSSID', '$tenure', '$status')";


	if ($conn->query($sql) === TRUE) {
	  echo "New record created successfully";
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
$conn->close();
?>
</table>