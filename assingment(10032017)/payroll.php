<?php
include('Salary.php');
echo "Enter Name Of Month  or in word   :  ";
$num = trim(fgets(STDIN));
$sal = new Salary();
$sal->salary_cal($num);
?>