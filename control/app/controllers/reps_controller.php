<?php
	class RepsController extends AppController{
		var $name = "Reps";
		
		function index(){
			$reps = $this->Rep->find("all");
			$finalTotal = 0;
			foreach ($reps as &$rep){
				$total = 0;
				$books = $this->Rep->Book->find("all", array("conditions" => array("rep_id" => $rep["Rep"]["id"])));
				foreach ($books as $book){
					$total += $book["Book"]["buyPrice"];
				}
				$rep["spent"] = $total;
				$finalTotal  += $total;
			}
			$this->set("reps", $reps);
			$this->set("total", $finalTotal);
			$this->Session->write("total", $finalTotal);
			$this->Session->write("currentSort", 0);
			$this->Session->write("reps", $reps);
		}
		function setTime(){
			$finalTotal = 0;
			$reps = $this->Rep->find("all");
			$date = date("Y-m-d", mktime(0, 0, 0, $this->data["Rep"]["month"], $this->data["Rep"]["day"], $this->data["Rep"]["year"]));
			foreach ($reps as &$rep)	{
				$total = 0;
				$books = $this->Rep->Book->find("all", array("conditions" => array("rep_id" => $rep["Rep"]["id"], "time >" => $date)));
				foreach ($books as $book){
					$total += $book["Book"]["buyPrice"];
				}
				$rep["spent"] = $total;
				$finalTotal  += $total;
			}
			$this->set("reps", $reps);
			$this->set("total", $finalTotal);
			$this->Session->write("total", $finalTotal);
			$this->Session->write("reps", $reps);
			$this->render('/reps/index');
		}
		
		function spentSort($type){
			$currentSort = $this->Session->read("currentSort");
			$reps = $this->Session->read("reps");
			if ($currentSort % 2 == 0){
				$reps = Set::sort($reps, "{n}.{$type}", 'asc');
			}else{
				$reps = Set::sort($reps, "{n}.{$type}", 'desc');
			}
			$currentSort++;
			$this->set("reps", $reps);
			$this->set("total", $this->Session->read("total"));
			$this->Session->write("currentSort", $currentSort);
			$this->Session->write("reps", $reps);
			$this->render("/reps/index");
		}
		

		
		function view($id){
			
		}
	}
?>