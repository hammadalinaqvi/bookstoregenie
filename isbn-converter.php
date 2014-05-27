<?php
	$isbn = (string) $_REQUEST['isbn'];
	if (substr($isbn, 0, 3) == 290 || substr($isbn, 0, 3) == 280){
		$isbn	  = substr("978" . substr($isbn, 3), 0, -1);
		$isbn_arr = str_split($isbn);
		$sum      = 0;
		for ($j = 0; $j < count($isbn_arr); $j++){
			if ($j % 2 == 0)
				$sum += $isbn_arr[$j];
			else
				$sum += $isbn_arr[$j] * 3;
		}
		$isbn .= (string) (10 - (($sum % 10) == 0 ? 10 : ($sum % 10)));
	}
	echo "{$_REQUEST['isbn']} is {$isbn}";
?>