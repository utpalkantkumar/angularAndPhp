<?php


//from url get parameter
function getUrlPqrqmeter(){
	 return basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
}
//all posted json data in asso array
function angPostedData() {
		return json_decode(file_get_contents('php://input'), true);
	}	
	//input need to sanitize
function Sanitize_input($input = '', $escape = '')
{
    $output = "";
    if(!empty($input) && $input != "")
    { $output1 = trim($input);
        if (get_magic_quotes_gpc())
        {
            $output1 = stripslashes($output1);
        }
        if(isset($escape) && !empty($escape) && $escape != "" && $escape == ":")
        {
            $output1 = str_replace( array( '\'', '"', ';', '/', '?', '|', '`', '~', '<', '>', '--', '!', '#', '$', '%', '^', '&' , '*' , '(' , ')', '+' ), '', $output1);
        }
        elseif(isset($escape) && !empty($escape) && $escape != "" && $escape == "'")
        {
            $output1 = str_replace( array( '"', ';', '/', '?', '|', ':', '`', '~', '<', '>', '--', '!', '#', '$', '%', '^', '&' , '*' , '(' , ')', '+' ), '', $output1);
        }
        elseif(isset($escape) && !empty($escape) && $escape != "" && $escape == "/")
        {
            $output1 = str_replace( array( '\'', '"', ';', '?', '|', ':', '`', '~', '<', '>', '--', '!', '#', '$', '%', '^', '&' , '*' , '(' , ')', '+' ), '', $output1);
        }
        elseif(isset($escape) && !empty($escape) && $escape != "" && $escape == "?'")
        {
            $output1 = str_replace( array( '"', ';', '/', '|', ':', '`', '~', '<', '>', '--', '!', '#', '$', '%', '^', '&' , '*' , '(' , ')', '+' ), '', $output1);
        }
        else
        {
            $output1 = str_replace( array( '\'', '"', ';', '/', '?', '|', ':', '`', '~', '<', '>', '--', '!', '#', '$', '%', '^', '&' , '*' , '(' , ')', '+' ), '', $output1);
        }

        $output1 = htmlspecialchars($output1);
        $output1 = htmlentities($output1);

        return trim($output1);
    }
    return $input;
}
function changeOrder($s, $k) 
{ 
  
    // new string 
    $newS = ""; 
  // loop for every characters 
    for($i = 0; $i < strlen($s); ++$i){ 
        // ascii value 
         $val = ord($s[$i]); 
		//echo $s[$i].'<br>';
  
        // store the number of incremnet 
        $incNumber = $k; 
  
        // if k-th ahead character exceed last 'z'  
        if($val + $k > 122){ 
             $k -= (122 - $val); 
           //$k = $k % 26; 
            $newS = $newS.chr(96 + $k); 
        } 
        else{
            $newS = $newS.chr($val + $k); 
		}
        $k = $incNumber; 
    } 
  
    // print the new string 
    return $newS; 
} 
?>