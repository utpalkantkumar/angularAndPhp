<?php
require_once("config/config.php");

class UserModel
	{
	
		function UserModel()
		{
			$this->obj1 = new dbopenconn();
			$this->con = $this->obj1-> dbconnect();
		}
	function AddInfo($insertData,$tableName)
		{
		if (is_array($insertData)== false)
			{
				return false;
			}
			else
			{
				$fieldnames =  "(";
				$fieldvalues = "(";
				foreach ($insertData as $k => $v) 
				{
					
					$fieldnames .=  ($fieldnames=="(")?"$k":",$k";
					$fieldvalues .= ($fieldvalues=="(")?"'$v'":",'$v'";
				}
				$sqltext = "insert into ".$tableName." ".$fieldnames.") values ".$fieldvalues.")";
				//echo $sqltext;
				$applications = $this->obj1->insert_query($sqltext);
				
				return ($applications == 1)?"true":"false";
			}
		
		}
	function getInfo($KeyID='',$sql='',$debugquery='',$fields='*',$tablename='',$KeyFieldName='')
		{
			$dataStr=array();
			if (($KeyID!="")&&($tablename!=""))
			{
				$sqltext = "Select $fields from $tablename where $KeyFieldName='".$KeyID."'";
				//echo $sqltext;
			}
			else if ($sql!="")
			{
				 $sqltext = $sql;
			}
				
			$datas = $this->obj1->select_query($sqltext);
			//print_r($datas);
			//exit();
			
			if ($datas)
			{
				$numrows = $this->obj1->numRows($datas);
			}
			
			//print_r($numrows);
			//exit();
			if ($numrows ==1)
			{
				while ($dataList = mysqli_fetch_assoc($datas))
				{
					$dataStr[] = $dataList;
				}	
			}
			else if($numrows > 1)
			{
				while ($dataList = mysqli_fetch_assoc($datas))
				{
					$dataStr[] = $dataList;
				}
			}
			return  $dataStr;
		
		}	
		
		
		
		
	}
	?>