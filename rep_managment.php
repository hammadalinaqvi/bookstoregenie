<?php
	/*
		This script handles all backend fuction for the buyback control panel
		it is currently deprecated and a newer control panel has been created in cake
		
		@author Jason Teplitz
		
		Changelog: 
			0.0.1     Script created
			0.1.0     handles request for representatives overviews
			0.2.0	  Returns complete data for a single representative
			0.3.0     Now uses ids instead of names
			0.3.1     Rounded decimals to two places for prices
			0.4.0	  Full support for weeks
		@version 0.4.0
	*/
	// Globals / Constants
	$BROWSERNAMES = array(
		'type' 		=> 'type',
		"id" 		=> 'id',
		"weekStart" => "weekStart",
		"weekEnd"   => "weekEnd"
	);
	define("REP_TABLE",  "representatives");
	define("DATA_TABLE", "buybackdata");
	define("DATA_TYPE", "JSON"); // no XML support in script yet, but it could happen
	
	dbConnect();
	handleInput();
	
	function basicRepOverview(){ 				// returns overview of all representatives
		$reps   = array();
		$query  = "SELECT * FROM " . REP_TABLE;
		$result = mysql_query($query);
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$sellTotal = 0;
			$buyTotal  = 0;
			$name      = $row["firstName"];
			$id		   = $row['id'];
			$query = "SELECT * FROM " . DATA_TABLE . " WHERE rep = '{$id}'";
			$dataResult = mysql_query($query);
			echo mysql_error();
			while ($dataRow = mysql_fetch_array($dataResult, MYSQL_ASSOC)){
				$sellTotal += round($dataRow['sellPrice'], 2);
				$buyTotal  += $dataRow['buyPrice'];
			}
			$reps[] = array("firstName" => $name, "lastName" => $row['lastName'],"buy" => $buyTotal, "sell" => $sellTotal, "id" => $id);
		}
		return $reps;
	}
	
	function repWeeks($id){ // calls repWeek with correct end
		global $weekStart, $weekEnd;
		$first = true; $result;
		$return_arr = array();
		
		$money = repWeek(repWeekData(date("Y-m-d H:i:s"), $id), $id);
		$weekString = date("m/d/Y", $weekStart) . " - " . date("m/d/Y", $weekEnd);
		$return_arr[] = array("money" => $money, "info" => array("start" => $weekStart, "end" => $weekEnd, "weekString" => $weekString));
		
		while (true){
			$result = repWeekData(date("Y-m-d H:i:s", $weekStart), $id);
			if (mysql_num_rows($result) > 0){
				$weekString = date("Y-m-d H:i:s", $weekStart) . " - " . date("Y-m-d H:i:s", $weekEnd);
				$return_arr[] = array("money" => repWeek($result, $id), "info" => array("start" => $weekStart, "end" => $weekEnd, "weekString" => $weekString));
			}
			else
				break;
		}
		return $return_arr;
	}
	
	function repWeekData($endTime, $id){
		$query  = "SELECT * FROM " . DATA_TABLE . " WHERE `rep` = '{$id}' AND `time` < '{$endTime}' ORDER BY `time` DESC";
		return mysql_query($query);
	}
	
	function repWeek($result, $id){ //does the actual work of getting a single week
		global $weekStart, $weekEnd;
		$return_arr = array();
		$return_arr["buyTotal"] = 0; $return_arr["sellTotal"] = 0;
		$row    = mysql_fetch_array($result);
		
		$timestamp   = strtotime($row['time']);
		$weekStart   = $timestamp - dayToSeconds(date("w", $timestamp)); // calculates the timestamp of the sunday that started that week
		$weekEnd     = $weekStart + dayToSeconds(6); // calculates the timestamp of the saturday that ends the week
		
		$weekStart_str = date("Y-m-d H:i:s", $weekStart); // converts timestamp to string representation using mysql datetime format
		$weekEnd_str   = date("Y-m-d H:i:s", $weekEnd); // converts timestamp to string representation using mysql datetime format
		
		$query  = "SELECT * FROM " . DATA_TABLE . " WHERE `time` > '{$weekStart_str}' AND `time` < '{$weekEnd_str}' AND `rep` = '{$id}'";
		$result = mysql_query($query);
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$return_arr["buyTotal"]  += $row['buyPrice'];
			$return_arr["sellTotal"] += $row['sellPrice'];
		}
		return $return_arr;
	}
	
	function dayToSeconds($day){
		return ($day * 86400);
	}
	
	function repDays($id, $weekStart, $weekEnd){
		$return_arr = array();
		$weekStart_str = date("Y-m-d H:i:s", $weekStart); // converts timestamp to string representation using mysql datetime format
		$weekEnd_str   = date("Y-m-d H:i:s", $weekEnd); // converts timestamp to string representation using mysql datetime format
		
	}
	
	function basicRepData($id){
		$book_arr = array();
		$query    = "SELECT * FROM " . DATA_TABLE . " WHERE rep = '{$id}'";
		$result   = mysql_query($query);
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$book_arr[] = $row;
		}
		return $book_arr;
	}
	
	function handleInput(){
		global $BROWSERNAMES;
		switch ($_REQUEST[$BROWSERNAMES['type']]){
			case "repOverview":
				display(basicRepOverview());
				break;
			case 'singleRep':
				display(basicRepData($_REQUEST[$BROWSERNAMES['id']]));
				break;
			case 'repWeek':
				display(repWeeks($_REQUEST[$BROWSERNAMES['id']]));
				break;
			case 'repDays':
				display(repDays($_REQUEST[$BROWSERNAMES['id']], $_REQUEST[$BROWSERNAMES['weekStart']], $_REQUEST[$BROWSERNAMES['weekEnd']]));
				break;
		}
	}
	
	function display($data){
		switch(DATA_TYPE){
			case "JSON":
				echo json_encode($data);
				break;
		}
	}
	
	function dbConnect(){
		$host      		 = "localhost";
		$database  		 = "jteplitz_bookstore";
		$user	  		 = "jteplitz";
		$pass	   		 = "jtt0511";
		mysql_connect($host, $user, $pass);
		mysql_select_db($database);
	}
	
?>