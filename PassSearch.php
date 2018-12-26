<?php

$search = $_POST['PassSearch'];
$db = mysqli_connect('localhost', 'root', '', 'safylite');
$sql = "select teacher.firstname,teacher.lastname,subject.name from subject  LEFT JOIN  teacher on teacher.teacher_id=subject.teacher_ID where subject.name LIKE '" . $search . "%' or teacher.firstname LIKE '" . $search . "%' or teacher.lastname LIKE '" . $search . "%'";
$result = mysqli_query($db, $sql);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//if ($name=$row['customer_name']){
if(!empty($search)){
    if(!empty($result)){
echo "<div align='center' style='color: aliceblue;'><h3 style='color: aliceblue;'>Customer Details Viewer</h3>";
echo "<table border='1'  class='table'>
        <tr>
                <th class='w3-orange'>Reference No</th>
                <th class='w3-orange'>Customer name</th>
		<th class='w3-orange'>Telephone Number</th>

        </tr>";


while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['firstname'] . "</td>";
    echo "<td>" . $row['lastname'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "</tr>";
}
echo "</table>";
    }else{
 echo '     <div class="container-fluid text-center">    
        <div class="row content">
            <div class="col-sm-2 sidenav">

            </div>
            
					<h3>Error !</h3>
					<p>can not find same similer word!
					</p>
					<br>
					</div>
				</div>
			</div>
';       
        
        
        
    }
} else {
echo '     <div class="container-fluid text-center">    
        <div class="row content">
            <div class="col-sm-2 sidenav">

            </div>
            
					<h3>Error !</h3>
					<p>Please Enter the Word!
					</p>
					<br>
					</div>
				</div>
			</div>
';
}
?>
