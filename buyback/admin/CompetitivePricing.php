<?php include_once('../../../header.php');?>

<?php include_once ('.config.inc.php') ?>



 <div class="container">
      <div class="stepTwo"> 
				<div class="bookResults span9"> 
                    <form class="search_isbn" action="" method="POST"> 
                        <input size="16" type="text" id="isbn" name="isbn" class="span7 text" placeholder="Search by ISBN">
                        <input class="btn btn-success pull-right" type="submit" value="Search" name="submit_isbn" id="submit_isbn">
                    </form>
        </div>
    </div>




<?php if(isset($_POST['submit_isbn'])){
	$ISBN = $_POST['isbn'];
	
	// United States:
	$serviceUrl = "https://mws.amazonservices.com/Products/2011-10-01";
	
	$config = array (
	'ServiceURL' => $serviceUrl,
	'ProxyHost' => null,
	'ProxyPort' => -1,
	'MaxErrorRetry' => 3,
	);
	
	$service = new MarketplaceWebServiceProducts_Client(
		AWS_ACCESS_KEY_ID,
		AWS_SECRET_ACCESS_KEY,
		APPLICATION_NAME,
		APPLICATION_VERSION,
		$config);
	
	$ASINs = new MarketplaceWebServiceProducts_Model_ASINListType();
	
	$ASINs->setASIN(array($ISBN)); // ISBN VALUES FOR TESTING 0205004679, '1439056501', '012092871X', '0439064872'

//echo '<pre>'; print_r($ASINs); echo '</pre>'; 
	
	$request = new MarketplaceWebServiceProducts_Model_GetCompetitivePricingForASINRequest();
	$request->setSellerId(MERCHANT_ID);
	$request->setMarketplaceId(MARKETPLACE_ID);
	$request->setASINList($ASINs);
	
	//echo '<pre>'; print_r($request); exit;

	 echo '<br /><br /><br /><br /><br />';
	//echo '<table border="1" cellpadding="0" cellspacing="0" width="70%" align="center">';
     try {
              $response = $service->getCompetitivePricingForASIN($request);
              
                //echo ("Service Response\n");
                //echo ("=============================================================================<br />");

                //echo("        ****************GetCompetitivePricingForASINResponse*******************<br />");
                $getCompetitivePricingForASINResultList = $response->getGetCompetitivePricingForASINResult();
                foreach ($getCompetitivePricingForASINResultList as $getCompetitivePricingForASINResult) {
                    //echo("            GetCompetitivePricingForASINResult<br /><br />");
                if ($getCompetitivePricingForASINResult->isSetASIN()) {
                    //echo("        ASIN");
                    //echo("\n");
                    $getCompetitivePricingForASINResult->getASIN();
                } 
                if ($getCompetitivePricingForASINResult->isSetStatus()) {
                    //echo("        status");
                    //echo("\n");
                    $getCompetitivePricingForASINResult->getStatus();
                } 
                    if ($getCompetitivePricingForASINResult->isSetProduct()) { 
                        //echo("                Product\n");
                        $product = $getCompetitivePricingForASINResult->getProduct();
                        if ($product->isSetIdentifiers()) { 
                            //echo("                    Identifiers\n");
                            $identifiers = $product->getIdentifiers();
                            if ($identifiers->isSetMarketplaceASIN()) { 
                                //echo("                        MarketplaceASIN\n");
                                $marketplaceASIN = $identifiers->getMarketplaceASIN();
                                if ($marketplaceASIN->isSetMarketplaceId()) 
                                {
                                    //echo("                            MarketplaceId\n");
                                    $marketplaceASIN->getMarketplaceId();
                                }
                                if ($marketplaceASIN->isSetASIN()) 
                                {
                                    //echo("                            ASIN\n");
                                    //echo '<tr><td>ASIN:</td><td>'.$marketplaceASIN->getASIN().'</td></tr></table>';
                                }
                            } 
                            if ($identifiers->isSetSKUIdentifier()) { 
                                //echo("                        SKUIdentifier\n");
                                $SKUIdentifier = $identifiers->getSKUIdentifier();
                                if ($SKUIdentifier->isSetMarketplaceId()) 
                                {
                                    //echo("                            MarketplaceId\n");
                                    $SKUIdentifier->getMarketplaceId();
                                }
                                if ($SKUIdentifier->isSetSellerId()) 

                                {
                                    //echo("                            SellerId\n");
                                    $SKUIdentifier->getSellerId();
                                }
                                if ($SKUIdentifier->isSetSellerSKU()) 
                                {
                                    //echo("                            SellerSKU\n");
                                    $SKUIdentifier->getSellerSKU();
                                }
                            } 
                        } 
                        if ($product->isSetCompetitivePricing()) { 
                            //echo("                    CompetitivePricing\n");
                            $competitivePricing = $product->getCompetitivePricing();
                            if ($competitivePricing->isSetCompetitivePrices()) { 
                                //echo("                        CompetitivePrices\n");
                                
								$competitivePrices = $competitivePricing->getCompetitivePrices();
                                $competitivePriceList = $competitivePrices->getCompetitivePrice();
                                
								$key = 0;
								
								foreach ($competitivePriceList as $key => $competitivePrice) {
                                    //echo("                            CompetitivePrice<br />");
                                if ($competitivePrice->isSetCondition()) {
                                    //echo("                        condition: ");
                                    //echo("\n");
                                    $competitivePrice->getCondition();
                                } 
                                if ($competitivePrice->isSetSubcondition()) {
                                    //echo("                        <br />subcondition");
                                    //echo("\n");
                                    $competitivePrice->getSubcondition();
                                } 
                                if ($competitivePrice->isSetBelongsToRequester()) {
                                    //echo("                       <br />belongsToRequester");
                                    //echo("\n");
                                    $competitivePrice->getBelongsToRequester();
                                } 
                                    if ($competitivePrice->isSetCompetitivePriceId()) 
                                    {
                                        //echo("<br /><br />Item No.");
                                        //echo(": " . $competitivePrice->getCompetitivePriceId() . "<br />");
										$item_id = $competitivePrice->getCompetitivePriceId();
										//$items[$key] = array("id" => $competitivePrice->getCompetitivePriceId());
                                    }
                                    if ($competitivePrice->isSetPrice()) { 
                                        //echo("Landed Price: ");
                                        $price = $competitivePrice->getPrice();
                                        if ($price->isSetLandedPrice()) { 
                                            //echo("            <br />LandedPrice\n");
                                            $landedPrice = $price->getLandedPrice();
                                            if ($landedPrice->isSetCurrencyCode()) 
                                            {
                                                //echo("        <br />CurrencyCode\n");
                                                $landedPrice->getCurrencyCode();
                                            }
                                            if ($landedPrice->isSetAmount()) 
                                            {
                                                //echo("                                        Amount\n");
                                                //echo $landedPrice->getCurrencyCode(). " ". $landedPrice->getAmount() . "<br />";
												$landed_price = $landedPrice->getAmount();
												//$items[$key] = array("landed_price" => $landed_price);
                                            }
                                        } 
                                        if ($price->isSetListingPrice()) { 
                                            //echo("Listing Price: ");
                                            $listingPrice = $price->getListingPrice();
                                            if ($listingPrice->isSetCurrencyCode()) 
                                            {
                                                //echo("                                        CurrencyCode\n");
                                                $listingPrice->getCurrencyCode();
												
                                            }
                                            if ($listingPrice->isSetAmount()) 
                                            {
                                                //echo("                                        Amount\n");
                                                //echo $listingPrice->getCurrencyCode() . " ". $listingPrice->getAmount() . "<br />";
												$listing_price = $listingPrice->getAmount();
												//$items[$key] = array("listing_price" => $listing_price);
                                            }
                                        } 
                                        if ($price->isSetShipping()) { 
                                            //echo("Shipping Price: ");
                                            $shipping = $price->getShipping();
                                            if ($shipping->isSetCurrencyCode()) 
                                            {
                                                //echo("                                        CurrencyCode\n");
                                                //echo("                                            " . $shipping->getCurrencyCode() . "<br />");
                                            }
                                            if ($shipping->isSetAmount()) 
                                            {
                                                //echo("                                        Amount\n");
                                                //echo $shipping->getCurrencyCode() . " ". $shipping->getAmount() . "<br /><br />";
												$shipping_price = $shipping->getAmount();
												
                                            }
                                        } 
                                    } 
                                
$items[$key] = array("id" => "Competitor ".$item_id, "landed_price" => "$ ".$landed_price, "listing_price" => "$ ".$listing_price, "shipping_price" => "$ ".$shipping_price);
//$items[$key] = array('"'.$item_id.'"', '"'.$landed_price.'"', '"'.$listing_price.'"', '"'.$shipping_price.'"');
								}
                            } 
                            
							if ($competitivePricing->isSetNumberOfOfferListings()) { 
                                //echo("Number of Books Available in Listing <br />");
                                $numberOfOfferListings = $competitivePricing->getNumberOfOfferListings();
                                $offerListingCountList = $numberOfOfferListings->getOfferListingCount();
                                
								$key_condition = 0;
								
								foreach ($offerListingCountList as $key_condition => $offerListingCount) {
                                    //echo("                            OfferListingCount\n");
                                if ($offerListingCount->isSetCondition()) {
                                    //echo("Condition of Book; ");
                                    //echo("\n");
                                    $condition = $offerListingCount->getCondition();
									
									
                                	} 
                                if ($offerListingCount->isSetValue()) {
                                    //echo("Books available: ");
                                    //echo("\n");
                                    $offerListingCount->getValue();
                                	}
								 $books[$key_condition]['type'] = $offerListingCount->getCondition();

								 $books[$key_condition]['value'] = $offerListingCount->getValue();
                                }
                            } 
                            if ($competitivePricing->isSetTradeInValue()) { 
                                echo("<strong>TradeInValue:</strong> ");
                                $tradeInValue = $competitivePricing->getTradeInValue();

                                if ($tradeInValue->isSetCurrencyCode()) 
                                {
                                    //echo("                            CurrencyCode\n");
                                    $tradeInValue->getCurrencyCode();
                                }
                                if ($tradeInValue->isSetAmount()) 
                                {
                                    //echo("                            Amount\n");
                                    echo("                                " . $tradeInValue->getAmount() . "<br />");
                                }
								
                            } 
                        } 
                        if ($product->isSetSalesRankings()) { 
                            echo("                    <strong>SALES RANKING</strong>");
                            $salesRankings = $product->getSalesRankings();
                            $salesRankList = $salesRankings->getSalesRank();
                            foreach ($salesRankList as $salesRank) {
                                //echo("                        SalesRank\n");
                                if ($salesRank->isSetProductCategoryId()) 
                                {
                                    echo("                            <strong>ProductCategoryId:</strong> ");
                                    echo("                                " . $salesRank->getProductCategoryId() . "<br />");
									 //echo '<tr><td>ASIN:</td><td>'.$marketplaceASIN->getASIN().'</td></tr>';
                                }
                                if ($salesRank->isSetRank()) 
                                {
                                    echo("                            <strong>Rank:</strong>");
                                    echo("                                ". $salesRank->getRank() . "<br />");
                                }
                            }
                        } 
 
 echo("    ****************************************************************************************************<br /><br />");

                        if ($product->isSetLowestOfferListings()) { 
                            echo("                    LowestOfferListings\n");
                            $lowestOfferListings = $product->getLowestOfferListings();
                            $lowestOfferListingList = $lowestOfferListings->getLowestOfferListing();
                            foreach ($lowestOfferListingList as $lowestOfferListing) {
                                echo("                        LowestOfferListing\n");
                                if ($lowestOfferListing->isSetQualifiers()) { 
                                    echo("                            Qualifiers\n");
                                    $qualifiers = $lowestOfferListing->getQualifiers();
                                    if ($qualifiers->isSetItemCondition()) 
                                    {
                                        echo("                                ItemCondition\n");
                                        echo("                                    " . $qualifiers->getItemCondition() . "<br />");
                                    }
                                    if ($qualifiers->isSetItemSubcondition()) 
                                    {
                                        echo("                                ItemSubcondition\n");
                                        echo("                                    " . $qualifiers->getItemSubcondition() . "<br />");
                                    }
                                    if ($qualifiers->isSetFulfillmentChannel()) 
                                    {
                                        echo("                                FulfillmentChannel\n");
                                        echo("                                    " . $qualifiers->getFulfillmentChannel() . "<br />");
                                    }
                                    if ($qualifiers->isSetShipsDomestically()) 
                                    {
                                        echo("                                ShipsDomestically\n");
                                        echo("                                    " . $qualifiers->getShipsDomestically() . "<br />");
                                    }
                                    if ($qualifiers->isSetShippingTime()) { 
                                        echo("                                ShippingTime\n");
                                        $shippingTime = $qualifiers->getShippingTime();
                                        if ($shippingTime->isSetMax()) 
                                        {
                                            echo("                                    Max\n");
                                            echo("                                        " . $shippingTime->getMax() . "<br />");
                                        }
                                    } 
                                    if ($qualifiers->isSetSellerPositiveFeedbackRating()) 
                                    {
                                        echo("                                SellerPositiveFeedbackRating\n");
                                        echo("                                    " . $qualifiers->getSellerPositiveFeedbackRating() . "<br />");
                                    }
                                } 
                                if ($lowestOfferListing->isSetNumberOfOfferListingsConsidered()) 
                                {
                                    echo("                            NumberOfOfferListingsConsidered\n");
                                    echo("                                " . $lowestOfferListing->getNumberOfOfferListingsConsidered() . "<br />");
                                }
                                if ($lowestOfferListing->isSetSellerFeedbackCount()) 
                                {
                                    echo("                            SellerFeedbackCount\n");
                                    echo("                                " . $lowestOfferListing->getSellerFeedbackCount() . "<br />");
                                }
                                if ($lowestOfferListing->isSetPrice()) { 
                                    echo("                            Price\n");
                                    $price1 = $lowestOfferListing->getPrice();
                                    if ($price1->isSetLandedPrice()) { 
                                        echo("                                LandedPrice\n");
                                        $landedPrice1 = $price1->getLandedPrice();
                                        if ($landedPrice1->isSetCurrencyCode()) 
                                        {
                                            echo("                                    CurrencyCode\n");
                                            echo("                                        " . $landedPrice1->getCurrencyCode() . "<br />");
                                        }
                                        if ($landedPrice1->isSetAmount()) 
                                        {
                                            echo("                                    Amount\n");
                                            echo("                                        " . $landedPrice1->getAmount() . "<br />");
                                        }
                                    } 
                                    if ($price1->isSetListingPrice()) { 
                                        echo("                                ListingPrice\n");
                                        $listingPrice1 = $price1->getListingPrice();
                                        if ($listingPrice1->isSetCurrencyCode()) 
                                        {
                                            echo("                                    CurrencyCode\n");
                                            echo("                                        " . $listingPrice1->getCurrencyCode() . "<br />");
                                        }
                                        if ($listingPrice1->isSetAmount()) 
                                        {
                                            echo("                                    Amount\n");
                                            echo("                                        " . $listingPrice1->getAmount() . "<br />");
                                        }
                                    } 
                                    if ($price1->isSetShipping()) { 
                                        echo("                                Shipping\n");
                                        $shipping1 = $price1->getShipping();
                                        if ($shipping1->isSetCurrencyCode()) 
                                        {
                                            echo("                                    CurrencyCode\n");
                                            echo("                                        " . $shipping1->getCurrencyCode() . "<br />");
                                        }
                                        if ($shipping1->isSetAmount()) 
                                        {
                                            echo("                                    Amount\n");
                                            echo("                                        " . $shipping1->getAmount() . "<br />");
                                        }
                                    } 
                                } 
                                if ($lowestOfferListing->isSetMultipleOffersAtLowestPrice()) 
                                {
                                    echo("                            MultipleOffersAtLowestPrice\n");
                                    echo("                                " . $lowestOfferListing->getMultipleOffersAtLowestPrice() . "<br />");
                                }
                            }
                        } 
                        if ($product->isSetOffers()) { 
                            echo("                    Offers\n");
                            $offers = $product->getOffers();
                            $offerList = $offers->getOffer();
                            foreach ($offerList as $offer) {
                                echo("                        Offer\n");
                                if ($offer->isSetBuyingPrice()) { 
                                    echo("                            BuyingPrice\n");
                                    $buyingPrice = $offer->getBuyingPrice();
                                    if ($buyingPrice->isSetLandedPrice()) { 
                                        echo("                                LandedPrice\n");
                                        $landedPrice2 = $buyingPrice->getLandedPrice();
                                        if ($landedPrice2->isSetCurrencyCode()) 
                                        {
                                            echo("                                    CurrencyCode\n");
                                            echo("                                        " . $landedPrice2->getCurrencyCode() . "<br />");
                                        }
                                        if ($landedPrice2->isSetAmount()) 
                                        {
                                            echo("                                    Amount\n");
                                            echo("                                        " . $landedPrice2->getAmount() . "<br />");
                                        }
                                    } 
                                    if ($buyingPrice->isSetListingPrice()) { 
                                        echo("                                ListingPrice\n");
                                        $listingPrice2 = $buyingPrice->getListingPrice();
                                        if ($listingPrice2->isSetCurrencyCode()) 
                                        {
                                            echo("                                    CurrencyCode\n");
                                            echo("                                        " . $listingPrice2->getCurrencyCode() . "<br />");
                                        }
                                        if ($listingPrice2->isSetAmount()) 
                                        {
                                            echo("                                    Amount\n");
                                            echo("                                        " . $listingPrice2->getAmount() . "<br />");
                                        }
                                    } 
                                    if ($buyingPrice->isSetShipping()) { 
                                        echo("                                Shipping\n");
                                        $shipping2 = $buyingPrice->getShipping();
                                        if ($shipping2->isSetCurrencyCode()) 
                                        {
                                            echo("                                    CurrencyCode\n");
                                            echo("                                        " . $shipping2->getCurrencyCode() . "<br />");
                                        }
                                        if ($shipping2->isSetAmount()) 
                                        {
                                            echo("                                    Amount\n");
                                            echo("                                        " . $shipping2->getAmount() . "<br />");
                                        }
                                    } 
                                } 
                                if ($offer->isSetRegularPrice()) { 
                                    echo("                            RegularPrice\n");
                                    $regularPrice = $offer->getRegularPrice();
                                    if ($regularPrice->isSetCurrencyCode()) 
                                    {
                                        echo("                                CurrencyCode\n");
                                        echo("                                    " . $regularPrice->getCurrencyCode() . "<br />");
                                    }
                                    if ($regularPrice->isSetAmount()) 
                                    {
                                        echo("                                Amount\n");
                                        echo("                                    " . $regularPrice->getAmount() . "<br />");
                                    }
                                } 
                                if ($offer->isSetFulfillmentChannel()) 
                                {
                                    echo("                            FulfillmentChannel\n");
                                    echo("                                " . $offer->getFulfillmentChannel() . "<br />");
                                }
                                if ($offer->isSetItemCondition()) 
                                {
                                    echo("                            ItemCondition\n");
                                    echo("                                " . $offer->getItemCondition() . "<br />");
                                }
                                if ($offer->isSetItemSubCondition()) 
                                {
                                    echo("                            ItemSubCondition\n");
                                    echo("                                " . $offer->getItemSubCondition() . "<br />");
                                }
                                if ($offer->isSetSellerId()) 
                                {
                                    echo("                            SellerId\n");
                                    echo("                                " . $offer->getSellerId() . "<br />");
                                }
                                if ($offer->isSetSellerSKU()) 
                                {
                                    echo("                            SellerSKU\n");
                                    echo("                                " . $offer->getSellerSKU() . "<br />");
                                }
                            }
                        } 
                    } 
                    if ($getCompetitivePricingForASINResult->isSetError()) { 
                        echo("                Error\n");
                        $error = $getCompetitivePricingForASINResult->getError();
                        if ($error->isSetType()) 
                        {
                            echo("                    Type\n");
                            echo("                        " . $error->getType() . "<br />");
                        }
                        if ($error->isSetCode()) 
                        {
                            echo("                    Code\n");
                            echo("                        " . $error->getCode() . "<br />");
                        }
                        if ($error->isSetMessage()) 
                        {
                            echo("                    Message\n");
                            echo("                        " . $error->getMessage() . "<br />");
                        }
                    } 
                }
                if ($response->isSetResponseMetadata()) { 
                   // echo("            ResponseMetadata\n");
                    $responseMetadata = $response->getResponseMetadata();
                    if ($responseMetadata->isSetRequestId()) 
                    {
                        //echo("                RequestId\n");
                        //echo("                    " . $responseMetadata->getRequestId() . "<br />");
						$responseMetadata->getRequestId();
                    }
                } 

              //echo("            ResponseHeaderMetadata: " . $response->getResponseHeaderMetadata() . "<br />");
     }
	 
	  catch (MarketplaceWebServiceProducts_Exception $ex) {
         echo("Caught Exception: " . $ex->getMessage() . "<br />");
         echo("Response Status Code: " . $ex->getStatusCode() . "<br />");
         echo("Error Code: " . $ex->getErrorCode() . "<br />");
         echo("Error Type: " . $ex->getErrorType() . "<br />");
         echo("Request ID: " . $ex->getRequestId() . "<br />");
         echo("XML: " . $ex->getXML() . "<br />");
         echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "<br />");
     }



 /* ************************************ REQUEST FOR GETTING THE LOWEST PRICE FOR ISBN ********************************** */

	$request_lowest_price = new MarketplaceWebServiceProducts_Model_GetLowestOfferListingsForASINRequest();
	$request_lowest_price->setSellerId(MERCHANT_ID);
	$request_lowest_price->setMarketplaceId(MARKETPLACE_ID);
	
	$request_lowest_price->setASINList($ASINs);
	$request_lowest_price->setItemCondition('New');


 

                            
      try {
              $response = $service->getLowestOfferListingsForASIN($request_lowest_price);
              
                //echo ("Service Response\n");
                //echo ("=============================================================================\n");

                //echo("        GetLowestOfferListingsForASINResponse\n");
                $getLowestOfferListingsForASINResultList = $response->getGetLowestOfferListingsForASINResult();
                foreach ($getLowestOfferListingsForASINResultList as $getLowestOfferListingsForASINResult) {
                    //echo("            GetLowestOfferListingsForASINResult\n");
                if ($getLowestOfferListingsForASINResult->isSetASIN()) {
                    //echo("        ASIN");
                    //echo("<br />");
                    echo("                " . $getLowestOfferListingsForASINResult->getASIN() . "<br />");
                } 
                if ($getLowestOfferListingsForASINResult->isSetStatus()) {
                    //echo("        status");
                    //echo("<br />");
                    echo("                " . $getLowestOfferListingsForASINResult->getStatus() . "<br />");
                } 
                    if ($getLowestOfferListingsForASINResult->isSetAllOfferListingsConsidered()) 
                    {
                        //echo("AllOfferListingsConsidered\n");
                        echo("                    " . $getLowestOfferListingsForASINResult->getAllOfferListingsConsidered() . "<br />");
                    }
                    if ($getLowestOfferListingsForASINResult->isSetProduct()) { 
                        //echo("                Product\n");
                        $product = $getLowestOfferListingsForASINResult->getProduct();
                        if ($product->isSetIdentifiers()) { 
                            //echo("                    Identifiers\n");
                            $identifiers = $product->getIdentifiers();
                            if ($identifiers->isSetMarketplaceASIN()) { 
                                //echo("                        MarketplaceASIN\n");
                                $marketplaceASIN = $identifiers->getMarketplaceASIN();
                                if ($marketplaceASIN->isSetMarketplaceId()) 
                                {
                                    //echo("                            MarketplaceId\n");
                                    $marketplaceASIN->getMarketplaceId();
                                }
                                if ($marketplaceASIN->isSetASIN()) 
                                {
                                    //echo("                            ASIN\n");
                                    $marketplaceASIN->getASIN() ;
                                }
                            } 
                            if ($identifiers->isSetSKUIdentifier()) { 
                                echo("                        SKUIdentifier\n");
                                $SKUIdentifier = $identifiers->getSKUIdentifier();
                                if ($SKUIdentifier->isSetMarketplaceId()) 
                                {
                                    echo("                            MarketplaceId\n");
                                    echo("                                " . $SKUIdentifier->getMarketplaceId() . "<br />");
                                }
                                if ($SKUIdentifier->isSetSellerId()) 
                                {
                                    echo("                            SellerId\n");
                                    echo("                                " . $SKUIdentifier->getSellerId() . "<br />");
                                }
                                if ($SKUIdentifier->isSetSellerSKU()) 
                                {
                                    echo("                            SellerSKU\n");
                                    echo("                                " . $SKUIdentifier->getSellerSKU() . "<br />");
                                }
                            } 
                        } 
                        if ($product->isSetCompetitivePricing()) { 
                            echo("                    CompetitivePricing\n");
                            $competitivePricing = $product->getCompetitivePricing();
                            if ($competitivePricing->isSetCompetitivePrices()) { 
                                echo("                        CompetitivePrices\n");
                                $competitivePrices = $competitivePricing->getCompetitivePrices();
                                $competitivePriceList = $competitivePrices->getCompetitivePrice();
                                foreach ($competitivePriceList as $competitivePrice) {
                                    echo("                            CompetitivePrice\n");
                                if ($competitivePrice->isSetCondition()) {
                                    echo("                        condition");
                                    echo("<br />");
                                    echo("                                " . $competitivePrice->getCondition() . "<br />");
                                } 
                                if ($competitivePrice->isSetSubcondition()) {
                                    echo("                        subcondition");
                                    echo("<br />");
                                    echo("                                " . $competitivePrice->getSubcondition() . "<br />");
                                } 
                                if ($competitivePrice->isSetBelongsToRequester()) {
                                    echo("                        belongsToRequester");
                                    echo("<br />");
                                    echo("                                " . $competitivePrice->getBelongsToRequester() . "<br />");
                                } 
                                    if ($competitivePrice->isSetCompetitivePriceId()) 
                                    {
                                        echo("                                CompetitivePriceId\n");
                                        echo("                                    " . $competitivePrice->getCompetitivePriceId() . "<br />");
                                    }
                                    if ($competitivePrice->isSetPrice()) { 
                                        echo("                                Price\n");
                                        $price = $competitivePrice->getPrice();
                                        if ($price->isSetLandedPrice()) { 
                                            echo("                                    LandedPrice\n");
                                            $landedPrice = $price->getLandedPrice();
                                            if ($landedPrice->isSetCurrencyCode()) 
                                            {
                                                //echo("                                        CurrencyCode\n");
                                                $landedPrice->getCurrencyCode();
                                            }
                                            if ($landedPrice->isSetAmount()) 
                                            {
                                                echo("                                        Amount\n");
                                                echo("                                            " . $landedPrice->getAmount() . "<br />");
                                            }
                                        } 
                                        if ($price->isSetListingPrice()) { 
                                            echo("                                    ListingPrice\n");
                                            $listingPrice = $price->getListingPrice();
                                            if ($listingPrice->isSetCurrencyCode()) 
                                            {
                                                //echo("                                        CurrencyCode\n");
                                                $listingPrice->getCurrencyCode();
                                            }
                                            if ($listingPrice->isSetAmount()) 
                                            {
                                                echo("                                        Amount\n");
                                                echo("                                            " . $listingPrice->getAmount() . "<br />");
                                            }
                                        } 
                                        if ($price->isSetShipping()) { 
                                            echo("                                    Shipping\n");
                                            $shipping = $price->getShipping();
                                            if ($shipping->isSetCurrencyCode()) 
                                            {
                                                //echo("                                        CurrencyCode\n");
                                                $shipping->getCurrencyCode();
                                            }
                                            if ($shipping->isSetAmount()) 
                                            {
                                                echo("                                        Amount\n");
                                                echo("                                            " . $shipping->getAmount() . "<br />");
                                            }
                                        } 
                                    } 
                                }
                            } 
                            if ($competitivePricing->isSetNumberOfOfferListings()) { 
                                echo("                        NumberOfOfferListings\n");
                                $numberOfOfferListings = $competitivePricing->getNumberOfOfferListings();
                                $offerListingCountList = $numberOfOfferListings->getOfferListingCount();
                                foreach ($offerListingCountList as $offerListingCount) {
                                    echo("                            OfferListingCount\n");
                                if ($offerListingCount->isSetCondition()) {
                                    echo("                        condition");
                                    echo("<br />");
                                    echo("                                " . $offerListingCount->getCondition() . "<br />");
                                } 
                                if ($offerListingCount->isSetValue()) {
                                    echo("                        Value");
                                    echo("<br />");
                                    echo("                                " . $offerListingCount->getValue() . "<br />");
                                } 
                                }
                            } 
                            if ($competitivePricing->isSetTradeInValue()) { 
                                echo("                        TradeInValue\n");
                                $tradeInValue = $competitivePricing->getTradeInValue();
                                if ($tradeInValue->isSetCurrencyCode()) 
                                {
                                    //echo("                            CurrencyCode\n");
                                    $tradeInValue->getCurrencyCode();
                                }
                                if ($tradeInValue->isSetAmount()) 
                                {
                                    echo("                            Amount\n");
                                    echo("                                " . $tradeInValue->getAmount() . "<br />");
                                }
                            } 
                        } 
                        if ($product->isSetSalesRankings()) { 
                            echo("                    SalesRankings\n");
                            $salesRankings = $product->getSalesRankings();
                            $salesRankList = $salesRankings->getSalesRank();
                            foreach ($salesRankList as $salesRank) {
                                echo("                        SalesRank\n");
                                if ($salesRank->isSetProductCategoryId()) 
                                {
                                    echo("                            ProductCategoryId\n");
                                    echo("                                " . $salesRank->getProductCategoryId() . "<br />");
                                }
                                if ($salesRank->isSetRank()) 
                                {
                                    echo("                            Rank\n");
                                    echo("                                " . $salesRank->getRank() . "<br />");
                                }
                            }
                        } 
                        if ($product->isSetLowestOfferListings()) { 
                            echo("                    LowestOfferListings\n");
                            $lowestOfferListings = $product->getLowestOfferListings();
                            $lowestOfferListingList = $lowestOfferListings->getLowestOfferListing();
                            foreach ($lowestOfferListingList as $lowestOfferListing) {
                                echo("<br />*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*<br /><br />");
                                if ($lowestOfferListing->isSetQualifiers()) { 
                                    //echo("                            Qualifiers\n");
                                    $qualifiers = $lowestOfferListing->getQualifiers();
                                    if ($qualifiers->isSetItemCondition()) 
                                    {
                                        echo("                                <strong>Item Condition:</strong> ");
                                        echo("                                    " . $qualifiers->getItemCondition() . "<br />");
                                    }
                                    if ($qualifiers->isSetItemSubcondition()) 
                                    {
                                        echo("                                <strong>Item Subcondition:</strong> ");
                                        echo("                                    " . $qualifiers->getItemSubcondition() . "<br />");
                                    }
                                    if ($qualifiers->isSetFulfillmentChannel()) 
                                    {
                                        echo("                                <strong>FulfillmentChannel:</strong> ");
                                        echo("                                    " . $qualifiers->getFulfillmentChannel() . "<br />");
                                    }
                                    if ($qualifiers->isSetShipsDomestically()) 
                                    {
                                        echo("                                <strong>ShipsDomestically:</strong> ");
                                        echo("                                    " . $qualifiers->getShipsDomestically() . "<br />");
                                    }
                                    if ($qualifiers->isSetShippingTime()) { 
                                        echo("                                <strong>Shipping Time:</strong> ");
                                        $shippingTime = $qualifiers->getShippingTime();
                                        if ($shippingTime->isSetMax()) 
                                        {
                                            echo("                                    Max\n");
                                            echo("                                        " . $shippingTime->getMax() . "<br />");
                                        }
                                    } 
                                    if ($qualifiers->isSetSellerPositiveFeedbackRating()) 
                                    {
                                        echo("                                <strong>Seller Positive Feedback Rating:</strong> ");
                                        echo("                                    " . $qualifiers->getSellerPositiveFeedbackRating() . "<br />");
                                    }
                                } 
                                if ($lowestOfferListing->isSetNumberOfOfferListingsConsidered()) 
                                {
                                    echo("                            Number Of Offer Listings Considered: ");
                                    echo("                                " . $lowestOfferListing->getNumberOfOfferListingsConsidered() . "<br />");
                                }
                                if ($lowestOfferListing->isSetSellerFeedbackCount()) 
                                {
                                    echo("                            <strong>Seller Feedback Count:</strong> ");
                                    echo("                                " . $lowestOfferListing->getSellerFeedbackCount() . "<br />");
                                }
                                if ($lowestOfferListing->isSetPrice()) { 
                                    //echo("                            Price\n");
                                    $price1 = $lowestOfferListing->getPrice();
                                    if ($price1->isSetLandedPrice()) { 
                                        echo("                                <strong>Landed Price:</strong> ");
                                        $landedPrice1 = $price1->getLandedPrice();
                                        if ($landedPrice1->isSetCurrencyCode()) 
                                        {
                                            //echo("                                    CurrencyCode\n");
                                           $landedPrice1->getCurrencyCode();
                                        }
                                        if ($landedPrice1->isSetAmount()) 
                                        {
                                            //echo("                                    Amount\n");
                                            echo("                                        " . $landedPrice1->getAmount() . "<br />");
                                        }
                                    } 
                                    if ($price1->isSetListingPrice()) { 
                                        echo("                                <strong>Listing Price</strong>: ");
                                        $listingPrice1 = $price1->getListingPrice();
                                        if ($listingPrice1->isSetCurrencyCode()) 
                                        {
                                            //echo("                                    CurrencyCode\n");
                                            $listingPrice1->getCurrencyCode();
                                        }
                                        if ($listingPrice1->isSetAmount()) 
                                        {
                                            //echo("                                    Amount\n");
                                            echo("                                        " . $listingPrice1->getAmount() . "<br />");
                                        }
                                    } 
                                    if ($price1->isSetShipping()) { 
                                        echo("                                <strong>Shipping Price:</strong> ");
                                        $shipping1 = $price1->getShipping();
                                        if ($shipping1->isSetCurrencyCode()) 
                                        {
                                            //echo("                                    CurrencyCode\n");
                                            $shipping1->getCurrencyCode();
                                        }
                                        if ($shipping1->isSetAmount()) 
                                        {
                                            //echo("                                    Amount\n");
                                            echo("                                        " . $shipping1->getAmount() . "<br />");
                                        }
                                    } 
                                } 
                                if ($lowestOfferListing->isSetMultipleOffersAtLowestPrice()) 
                                {
                                    echo("                            <strong>Multiple Offers At Lowest Price:</strong> ");
                                    echo("                                " . $lowestOfferListing->getMultipleOffersAtLowestPrice() . "<br />");
                                }
                            }
						echo("<br />*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*<br />");
                        } 
                        if ($product->isSetOffers()) { 
                            echo("                    Offers\n");
                            $offers = $product->getOffers();
                            $offerList = $offers->getOffer();
                            foreach ($offerList as $offer) {
                                echo("                        Offer\n");
                                if ($offer->isSetBuyingPrice()) { 
                                    echo("                            BuyingPrice\n");
                                    $buyingPrice = $offer->getBuyingPrice();
                                    if ($buyingPrice->isSetLandedPrice()) { 
                                        echo("                                LandedPrice\n");
                                        $landedPrice2 = $buyingPrice->getLandedPrice();
                                        if ($landedPrice2->isSetCurrencyCode()) 
                                        {
                                            //echo("                                    CurrencyCode\n");
                                            $landedPrice2->getCurrencyCode();
                                        }
                                        if ($landedPrice2->isSetAmount()) 
                                        {
                                            echo("                                    Amount\n");
                                            echo("                                        " . $landedPrice2->getAmount() . "<br />");
                                        }
                                    } 
                                    if ($buyingPrice->isSetListingPrice()) { 
                                        echo("                                ListingPrice\n");
                                        $listingPrice2 = $buyingPrice->getListingPrice();
                                        if ($listingPrice2->isSetCurrencyCode()) 
                                        {
                                            //echo("                                    CurrencyCode\n");
                                            $listingPrice2->getCurrencyCode() ;
                                        }
                                        if ($listingPrice2->isSetAmount()) 
                                        {
                                            echo("                                    Amount\n");
                                            echo("                                        " . $listingPrice2->getAmount() . "<br />");
                                        }
                                    } 
                                    if ($buyingPrice->isSetShipping()) { 
                                        echo("                                Shipping\n");
                                        $shipping2 = $buyingPrice->getShipping();
                                        if ($shipping2->isSetCurrencyCode()) 
                                        {
                                            //echo("                                    CurrencyCode\n");
                                            $shipping2->getCurrencyCode();
                                        }
                                        if ($shipping2->isSetAmount()) 
                                        {
                                            echo("                                    Amount\n");
                                            echo("                                        " . $shipping2->getAmount() . "<br />");
                                        }
                                    } 
                                } 
                                if ($offer->isSetRegularPrice()) { 
                                    echo("                            RegularPrice\n");
                                    $regularPrice = $offer->getRegularPrice();
                                    if ($regularPrice->isSetCurrencyCode()) 
                                    {
                                        //echo("                                CurrencyCode\n");
                                        $regularPrice->getCurrencyCode();
                                    }
                                    if ($regularPrice->isSetAmount()) 
                                    {
                                        echo("                                Amount\n");
                                        echo("                                    " . $regularPrice->getAmount() . "<br />");
                                    }
                                } 
                                if ($offer->isSetFulfillmentChannel()) 
                                {
                                    echo("                            FulfillmentChannel\n");
                                    echo("                                " . $offer->getFulfillmentChannel() . "<br />");
                                }
                                if ($offer->isSetItemCondition()) 
                                {
                                    echo("                            ItemCondition\n");
                                    echo("                                " . $offer->getItemCondition() . "<br />");
                                }
                                if ($offer->isSetItemSubCondition()) 
                                {
                                    echo("                            ItemSubCondition\n");
                                    echo("                                " . $offer->getItemSubCondition() . "<br />");
                                }
                                if ($offer->isSetSellerId()) 
                                {
                                    echo("                            SellerId\n");
                                    echo("                                " . $offer->getSellerId() . "<br />");
                                }
                                if ($offer->isSetSellerSKU()) 
                                {
                                    echo("                            SellerSKU\n");
                                    echo("                                " . $offer->getSellerSKU() . "<br />");
                                }
                            }
                        } 
                    } 
                    if ($getLowestOfferListingsForASINResult->isSetError()) { 
                        echo("                Error\n");
                        $error = $getLowestOfferListingsForASINResult->getError();
                        if ($error->isSetType()) 
                        {
                            echo("                    Type\n");
                            echo("                        " . $error->getType() . "<br />");
                        }
                        if ($error->isSetCode()) 
                        {
                            echo("                    Code\n");
                            echo("                        " . $error->getCode() . "<br />");
                        }
                        if ($error->isSetMessage()) 
                        {
                            echo("                    Message\n");
                            echo("                        " . $error->getMessage() . "<br />");
                        }
                    } 
                }
                if ($response->isSetResponseMetadata()) { 
                    //echo("            ResponseMetadata\n");
                    $responseMetadata = $response->getResponseMetadata();
                    if ($responseMetadata->isSetRequestId()) 
                    {
                        echo("                RequestId\n");
                        echo("                    " . $responseMetadata->getRequestId() . "<br />");
                    }
                } 

              //echo("            ResponseHeaderMetadata: " . $response->getResponseHeaderMetadata() . "<br />");
     }
	 
	  catch (MarketplaceWebServiceProducts_Exception $ex) {
         echo("Caught Exception: " . $ex->getMessage() . "<br />");
         echo("Response Status Code: " . $ex->getStatusCode() . "<br />");
         echo("Error Code: " . $ex->getErrorCode() . "<br />");
         echo("Error Type: " . $ex->getErrorType() . "<br />");
         echo("Request ID: " . $ex->getRequestId() . "<br />");
         echo("XML: " . $ex->getXML() . "<br />");
         echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "<br />");
     }





?>

<table border="0" cellpadding="0" cellspacing="0" width="70%" align="center">
	
    <tr height="50px">
        <td colspan="4"> <h2>Book Information </h2></td>
    </tr>
	
    <tr height="50px">
        <th><strong>Book ISBN: </strong></td>
        <td colspan="3"><?php echo $ISBN;?></td>
    </tr>
    
    <tr>
        <td><strong>&nbsp;</strong></td>
        <td><strong>Landed Price</strong></td>
        <td><strong>Listing Price</strong></td>
        <td><strong>Shipping Price</strong></td>
    </tr>
    
    
	<?php 
    foreach ($items as $item ) {
	echo "<tr>";
		foreach ($item as $itm)
		{
			echo "<td>".$itm."</td>";
		}
	echo "</tr>";

    } // end foreach
    
    ?>
    
    
    <tr height="60px">
    	<td colspan="4">&nbsp;</td>
    </tr>

    <tr>
    	<td><strong>Book Condition</strong></td>
        <td><strong>Quantity Available</strong></td>
    </tr>
    
    <?php 
    foreach ($books as $book) {
	echo "<tr>";
		foreach ($book as $bk)
		{
			echo "<td>".$bk."</td>";
		}
	echo "</tr>";

    } // end foreach
    
    ?>
    
 
  </table>


<?php }// END - IF ?>

<?php //include_once('../../../footer.php');?>        