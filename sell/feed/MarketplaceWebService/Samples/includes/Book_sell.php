<?php
	class Book {
 		var $newPrice, $newMerchant, $usedPrice, $usedMerchant, $newLink, $usedLink, $title, $author, $isbn, $image;
		var $newQuantity, $usedQuantity, $subTotal;
		var $rentPrice, $rentMerchant, $rentLink,$rentQuantity;
		var $chegg, $cbr, $br;
		var $cheggLink, $cbrLink, $brLink;

  		public function __construct($rentPrice, $rentMerchant, $rentLink, $newPrice, $newMerchant, $usedPrice, $usedMerchant, $newLink, $usedLink, $title, $author, $isbn, $image, $rentQuantity, $newQuantity, $usedQuantity, $subTotal,$chegg,$cbr,$br,$cheggLink,$cbrLink,$brLink) {
    			
    			if(($image == null) ||($image == ""))
    			{
    				$image = "http://www.futurefiction.com/images/book_stack.gif";
    			}
    			
    			$newPrice = number_format($newPrice, 2);
    			$this->newPrice = $newPrice;
    			
    			$this->newMerchant = $newMerchant;
    			
    			//**************Adding 10% mark up to the used Price
    			$usedPrice = $usedPrice * 1.33;
    			$usedPrice = number_format($usedPrice, 2);
    			$this->usedPrice = $usedPrice;
    			
    			$this->usedMerchant = $usedMerchant;
    			$this->newLink = $newLink;
    			$this->usedLink = $usedLink;
    			$this->title = $title;
    			$this->author = $author;
    			$this->isbn = $isbn;
    			$this->image = $image;
    			$this->newQuantity = $newQuantity;
    			$this->usedQuantity = $usedQuantity;
    			$this->subTotal = $subTotal;
    			
    			if((($rentPrice == null) || ($rentPrice == ""))  &&  (($usedPrice == null) || ($usedPrice == "")))
    			{
    				$this->newPrice = 0;
    			}
    			
    			/*if(($rentPrice == null) || ($rentPrice == ""))
    			{
    				$rentPrice = 0.67 * $usedPrice;
    				$rentMerchant = $usedMerchant;
    				$rentLink = $usedLink;
    				$rentPrice = number_format($rentPrice, 2);
    			}
    			
    			$rentPrice = number_format($rentPrice, 2);
    			$this->rentPrice = $rentPrice;
    			$this->rentMerchant = $rentMerchant;
    			$this->rentLink = $rentLink;*/
    			
    			
    			if($this->usedPrice < 20.00)
    			{
    				$this->usedPrice = $this->usedPrice * 1.25;
    				$this->usedPrice = number_format($this->usedPrice,2);
    			}
    			/*if($this->rentPrice > $this->usedPrice)
    			{
    				$this->rentPrice = $this->usedPrice;
    				$this->rentMerchant = $this->usedMerchant;
    				$this->rentLink = $this->usedLink;
    				
    				$this->usedPrice = $this->usedPrice * 1.50;
    				$this->usedPrice = number_format($this->usedPrice,2);
    			}
    			*/
    			
    			/*$tempPrice = $this->rentPrice * 1.50;
    			
    			if($this->usedPrice < $tempPrice)
    			{
    				$this->usedPrice = $tempPrice;
    				$this->usedPrice = number_format($this->usedPrice,2);
    			}*/
    			
    			$this->chegg = number_format($chegg,2);
    			$this->cbr = number_format($cbr,2);
    			$this->br = number_format($br,2);
    			
    			$this->cheggLink = $cheggLink;
    			$this->cbrLink = $cbrLink;
    			$this->brLink = $brLink;
    			
  		}

		public function addUsedQuantity()
		{
			$this->usedQuantity++;
		}
		
		public function decreaseUsedQuantity()
		{
			if($this->usedQuantity > 0)
			{
				$this->usedQuantity--;
			}
		}
		
		public function addRentQuantity()
		{
			$this->rentQuantity++;
		}
		
		public function decreaseRentQuantity()
		{
			if($this->rentQuantity > 0)
			{
				$this->rentQuantity--;
			}
		}
		public function addNewQuantity()
		{
			$this->newQuantity++;
		}
		
		public function decreaseNewQuantity()
		{
			if($this->newQuantity > 0)
			{
				$this->newQuantity--;
			}
		}
		
		public function updateTotal()
		{
			$price = ($this->newPrice * $this->newQuantity) + ($this->usedPrice * $this->usedQuantity) ;
			$this->subTotal = $price;
		}
		
		public function getChegg()
		{
			return $this->chegg;
		}
		
		public function getCbr()
		{
			return $this->cbr;
		}
		
		public function getBr()
		{
			return $this->br;
		}
		
		public function getCheggLink()
		{
			return $this->cheggLink;
		}
		
		public function getCbrLink()
		{
			return $this->cbrLink;
		}
		
		public function getBrLink()
		{
			return $this->brLink;
		}
		
		public function getRentPrice()
		{
			return $this->rentPrice;
		}
		
		public function getRentMerchant()
		{
			return $this->rentMerchant;
		}
		
		public function getRentLink()
		{
			return $this->rentLink;
		}
		

		public function getNewPrice()
		{
			return $this->newPrice;
		}
		
		public function getNewMerchant()
		{
			return $this->newMerchant;
		}
		
		public function getUsedPrice()
		{
			return $this->usedPrice;
		}
		
		public function getUsedMerchant()
		{
			return $this->usedMerchant;
		}
		
		public function getNewLink()
		{
			return $this->newLink;
		}
		
		public function getUsedLink()
		{
			return $this->usedLink;
		}
		
		public function getTitle()
		{
			return $this->title;
		}
		
		public function getAuthor()
		{
			return $this->author;
		}
		
		public function getISBN()
		{
			return $this->isbn;
		}
		
		public function getImage()
		{
			return $this->image;
		}
		
		public function getNewQuantity()
		{
			return $this->newQuantity;
    		}	

		public function getUsedQuantity()
		{
			return $this->usedQuantity;
		}
		
		public function getRentQuantity()
		{
			return $this->rentQuantity;
		}
		
		public function getSubTotal()
		{
			return $this->subTotal;
		}
				
  		public function __toString() {
    
  		}
	}

?>