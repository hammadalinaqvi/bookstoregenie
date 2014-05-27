<?php
	class BooksController extends AppController{
		var $helpers = array("Html", "Form");
		var $name = "Books";
		
		function index(){
			$this->set("Books", $this->Book->find("all"));
		}
	}
?>