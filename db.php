<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="css/tablecss.css">
	<link rel="javascript" href="js/index.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<section>
<h1 style="color: WHITE;"><center>Your Next Bus<center></h1>
<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password,"project");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$data=$_POST["source"];
$data1=$_POST["des"];
$time1=$_POST["time"];
$time= date("H:i", strtotime("$time1"));
$inter_arr=array();
$inter_timearr=array();
$sql="SELECT * FROM `yournextbus` WHERE `inter_stop` LIKE '%".$data."%".$data1."%'" ;

$result = $conn->query($sql);
while($row = $result->fetch_assoc())
{
	$details[]=$row;
}
echo '<div class="tbl-header">';
echo "<table class='table'>";
echo "<thead>";
echo "<tr>";
echo "<th>STARTING PLACE</th>";
echo "<th>STARTING TIME</th>";
echo"<th>BUS NO</th>";
echo "<th>YOUR PLACE</th>";
echo"<th>REACHING YOU</th>";
echo "</tr>";
echo "</thead>";
echo "</table>";
echo '</div>';
echo '<div class="tbl-content">';
 foreach ($details as $detail)
 {
 	if ($time<$detail['start_time'])         
 	{
 		$inter_arr=explode(" ",$detail['inter_stop']);
 		$inter_timearr=explode(" ",$detail['inter_time']);
 		foreach ($inter_arr as $key => $inter_arrs) 
 		{
 			if($inter_arrs==$data)
 				$sou=$key;
 		}
 		foreach ($inter_arr as $key => $inter_arrs) 
 		{
 			if($inter_arrs==$data1)
 				$dest=$key;
 		}
 		if($sou<$dest)
 		{
 			$time3=$detail['start_time'];
 			$time2=date("g:i a", strtotime("$time3"));
 		  echo "<table class='table'>";
 		  echo "<tr>";
 		  echo "<td>".$detail['source']."</td>";
 		  echo "<td>".$time2."</td>";
 	 	  echo  " <td>".$detail['bus_no']."</td>";
 		  echo "<td>".$data."</td>";
 		  echo " <td>".$inter_timearr[$sou]."</td>";
 		  echo "</tr>";
 		  echo "</table>";
 	    }
 	}
  }
  echo '</div>';
 ?>
 </section>
</body>
</html>