<?PHP
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {

header ("Location: index.php");

}

?>


<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css">
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
 
</head>
<body>

<!-- Patient message summary--> 
<div id="View Message" data-url="View Message" data-role="page">
<div data-role="header" data-theme="b">
<h1> Message Summary</h1>
</div>

<div data-role="content">

<?php
$host = 'studb.cms.gre.ac.uk';
$user = 'na213';
$passwd = 'staruw6J';
$dbname = 'mdb_na213';

$link = mysql_connect($host, $user, $passwd,$dbname);
mysql_select_db($dbname);

$query1=mysql_query("select Mid, Message, MessageDatetime,Message.DoctorId, Message.PatientId, DFname, DLname from Message, 
Doctor, Patient Where Doctor.DoctorId = Message.DoctorId 
and Patient.PatientId = Message.PatientId and Patient.PatientId = '{$_SESSION['PID']}' Order by MessageDatetime Desc;");
echo "<table><tr><td><strong>Message</strong></td><td><strong>Date</strong></td><td><strong>Doctor Name</strong></td><td><strong>Lastname</strong></td>";
while($query2=mysql_fetch_array($query1))
{
echo "<tr><td>".$query2['Message']."</td>";
echo "<td>".$query2['MessageDatetime']."</td>";
echo "<td>".$query2['DFname']."</td>";
echo "<td>".$query2['DLname']."</td>";


echo "<td><a href='DeleteMessagePat.php?id=".$query2['Mid']."'>Delete</a></td><tr>";
}

?>


<a href="PatientMain.php" data-role="button">Back</a>
</div></div>

</body>
</html>