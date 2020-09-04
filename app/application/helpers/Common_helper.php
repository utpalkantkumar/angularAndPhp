<?php

function Sanitize_input($input = '', $escape = '')
{
    $ci =& get_instance();
    $ci->load->database();
    $output = "";
    if(!empty($input) && $input != "")
    {
        $input = $ci->security->xss_clean($input);
        //$output_html_escape = html_escape($output_clean);
        //$output =  $ci->db->escape($output_html_escape);
        //$output =  $output_html_escape;

        $output1 = trim($input);
        if (get_magic_quotes_gpc())
        {
            $output1 = stripslashes($output1);
        }
        //$output2 = strtr($output1,array_flip(get_html_translation_table(HTML_ENTITIES)));
        //$output3 = strip_tags($output2);
        //$output = mysqli_real_escape_string(get_mysqli(), $output);
        //$output = $this->db->escape($output3);
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

function angPostedData() {
		return json_decode(file_get_contents('php://input'), true);
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