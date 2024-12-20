<?php
session_start();
echo "<h1>Your Profile</h1>";
echo "First Name: " .   $_SESSION["FName"]."<br>";
echo "Last Name: "  .	$_SESSION["LName"]."<br>";
echo "Email :"      .	$_SESSION["Email"]."<br>";
echo "Faculty: "    .	$_SESSION["Major"]."<br>";
echo "Minor: "      .   $_SESSION["Minor"]."<br>";
echo "Status:"      .   $_SESSION["Status"]."<br>";
echo "Semester GPA:".   $_SESSION["Sem gpa"]."<br>";
echo "CUM GPA:"     .   $_SESSION["Cum gpa"]."<br>";
echo "Semester CRDH:".   $_SESSION["Sem crdh"]."<br>";
echo "Total CRDH:"   .   $_SESSION["Total crdh"]."<br>";

echo"<a href='Home.php'>Back</a>";

?>