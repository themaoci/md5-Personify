<?php
  // made by TheMaoci
    function strigToBinary($string)
    {
        $characters = str_split($string);
        $binary = [];
        foreach ($characters as $character) {
            $data = unpack('H*', $character);
            $binary[] = str_pad(base_convert($data[1], 16, 2), 7, "0");
        }
        return implode(' ', $binary);    
    }
     
    function binaryToString($binary)
    {
        $binaries = str_split($binary,7);//explode(' ', $binary);
        $string = null;
        foreach ($binaries as $binary) {
            $string .= pack('H*', dechex(bindec($binary)));
        }
     
        return $string;    
    }
	$table_0 = array("0","2","4","6","8","a","c","e");
	$table_1 = array("1","3","5","7","9","b","d","f");

	function binToMFN($string){
		global $table_0;
		global $table_1;
		$string = str_replace(" ", "", $string);
		$string_array = str_split($string);
		$ret_string = "";
		foreach ($string_array as $char) {
			if($char == 1 || $char == "1")
				$ret_string .= $table_1[rand(0,(count($table_1)-1))];
			if($char == 0 || $char == "0")
				$ret_string .= $table_0[rand(0,(count($table_0)-1))];
		}
		return $ret_string;
	}
	function mfnToBin($string){
		global $table_0;
		global $table_1;
		//$string = str_replace(" ", "", $string);
		$string_array = str_split($string);
		$ret_string = "";
		
		foreach ($string_array as $char) {
			if(in_array($char, $table_1))
				$ret_string .= "1";
			if(in_array($char, $table_0))
				$ret_string .= "0";
		}
		return $ret_string;
	}
	function pretend_md5($string){
		$string_array = str_split($string, 4);
		$return_str = "";
		foreach ($string_array as $_4chars) {
			$return_str .= binToMFN(strigToBinary($_4chars)) . "<br>";
		}
		return $return_str;
	}
	function decode_MFN($string){
		$string = str_replace(" ", "", $string);
		//echo $string;
		$test0 = mfnToBin($string);
		//echo "|||".$test0."|||";
		$test1 = binaryToString($test0);
		//echo $test1."|||";
		return $test1;
	}
?>
<html>
<head>
<title>mdFivonify</title>
</head>
<body>
<div style="width:400px;margin:10px auto;">
<h3>personify being md5 hash</h3>
<?php 

	$ss = "we trying to load you data but something goes wrong and we lost them very hardly"; // test string
	echo "1 - ";
	echo $ss."<br><br>"; // display test string
	$s = strigToBinary($ss).PHP_EOL;
	$s1 = binToMFN($s).PHP_EOL;
	$table = str_split($s1, 24);
	echo "2 - ";
	for($tb =0;$tb<count($table);$tb++)
		echo $table[$tb]."<br>"; // display personified code
	echo "<br>3 - ";
	$s2 = mfnToBin($s1).PHP_EOL;
	echo binaryToString($s2).PHP_EOL; // return back to text string
?>
</div>

</body>
</html>
