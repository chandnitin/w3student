<?php
class Salary{
	
	public function salary_cal($monthname=''){
		$monthname=trim($monthname);
		$file = fopen("salary_report.csv","w");
		fputcsv($file, array('Payment Date', 'Month Name', 'Salary Payment Date', 'Bonus Date'));
		$list=array();
		
		
		if(is_numeric ($monthname)){
			
				$_month_Number=$monthname;
			
		  	$_month_Name = date("F", mktime(0, 0, 0,$_month_Number, 10));
		
		
		}else{
			$_month_Number = date('m',strtotime($monthname));
			
				$_month_Name= $_month_Number;
		}	
		
		if($_month_Number<=12){
			
			 $_first_Day_Month = date("Y")."-".$_month_Number."-01";
		   	 $_Last_day_Month = date('t',strtotime($_first_Day_Month)); 
			
			 $Pay_Date_Month = date("Y")."-".$_month_Number."-".$_Last_day_Month."";
			 $payment_date=$Pay_Date_Month;
			 $_Date_Month = strtotime($Pay_Date_Month);
			 $_Name_Of_Day = date('l', $_Date_Month);

			
			if($_Name_Of_Day=="Saturday"){ 
				$Pay_Date_Month= date('Y/m/d', strtotime('-1 day', strtotime($Pay_Date_Month)))."\n";
			}

			if($_Name_Of_Day=="Sunday"){  
				$Pay_Date_Month= date('Y/m/d', strtotime('-2 day', strtotime($Pay_Date_Month)))."\n";
			}
			 $Pay_Date_Month."\n";
			
			 $_bonus_Date = date("Y")."-".$_month_Number."-15";
			 $_Date_Month = strtotime($_bonus_Date);
			 $_Name_Of_Day = date('l', $_Date_Month);
			
			if( $_Name_Of_Day=="Sunday"){  
				
				$_bonus_Date= date('Y/m/d', strtotime('+3 day', strtotime($_bonus_Date)))."\n";
			}
			if( $_Name_Of_Day=="Saturday"){
				$_bonus_Date= date('Y/m/d', strtotime('+4 day', strtotime($_bonus_Date)))."\n";
			}
			 		
			array_push($list, array(date("j F Y ,l ",strtotime($payment_date)), $_month_Name, $Pay_Date_Month, $_bonus_Date));
			$data=$list;

			foreach ($data as $line)
			  {
				
				  fputcsv($file, $line);
			 
			  }
			fclose($file);
			
			echo"\nCreate salary_report.cvs file on current  directory\n\n";
			echo"Payment Date : ".date("j F Y ,l ",strtotime($payment_date))." |  Month :  ".$_month_Name." |  Payment Date :  ".$Pay_Date_Month."  |  Bonus Date  :". $_bonus_Date."\n";
			
			
		}else{
			echo "Please enter valid  Month name and month number";
		}
		
	}
}
?>