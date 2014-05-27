<?php
	class Rep extends AppModel{
		var $name  = "Rep";
		var $spent = 0;
		var $hasMany = array(
			"Book" => array(
				"className" => "Book",
				"order" => "Book.time DESC"
			)
		);
		function setSpent($spent){
			$this->spent = $spent;
		}
	}
?>