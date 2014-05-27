<?php include_once('../../../header.php');?>

<?php include_once ('.config.inc.php') ;
	  require_once ('../../../includes/db.php');

$query = mysql_query("SELECT * FROM book_shipment WHERE amazon_new_low = '0' && amazon_used_low = '0'");
$book_data = mysql_fetch_assoc($query);
$book_count = mysql_num_rows($query);

echo '<br /><br /><br /><br /><br /><br />';

/*echo '<pre>';
	print_r($book_data);
echo '</pre>';*/
	
while($book_count != 0){
	
	$book_shipment_id = $book_data['id'];
	
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
		
		$ASINs->setASIN(array($book_data['ISBN'])); // ISBN VALUES FOR TESTING 0205004679, '1439056501', '012092871X', '0439064872'
		
		$request = new MarketplaceWebServiceProducts_Model_GetCompetitivePricingForASINRequest();
		$request->setSellerId(MERCHANT_ID);
		$request->setMarketplaceId(MARKETPLACE_ID);
		$request->setASINList($ASINs);
		
// ****************************************** CALL FOR AMAZON SALES RANK *************************************
		try {
			  $response = $service->getCompetitivePricingForASIN($request);
			  
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
								//echo("<strong>TradeInValue:</strong> ");
								$tradeInValue = $competitivePricing->getTradeInValue();
		
								if ($tradeInValue->isSetCurrencyCode()) 
								{
									//echo("                            CurrencyCode\n");
									$tradeInValue->getCurrencyCode();
								}
								if ($tradeInValue->isSetAmount()) 
								{
									//echo("                            Amount\n");
									//echo("                                " . $tradeInValue->getAmount() . "<br />");
								}
								
							} 
						} 
						if ($product->isSetSalesRankings()) { 
							//echo("                    <strong>SALES RANKING</strong>");
							$salesRankings = $product->getSalesRankings();
							$salesRankList = $salesRankings->getSalesRank();
							
							$a = 0;
							foreach ($salesRankList as $salesRank) {
								//echo("                        SalesRank\n");
								if ($salesRank->isSetProductCategoryId()) 
								{
									//echo("                            <strong>ProductCategoryId:</strong> ");
								   // echo("                                " . $salesRank->getProductCategoryId() . "<br />");
									 //echo '<tr><td>ASIN:</td><td>'.$marketplaceASIN->getASIN().'</td></tr>';
								}
								if ($salesRank->isSetRank()) 
								{
									//echo("                            <strong>Rank:</strong>");
									//echo("                                ". $salesRank->getRank() . "<br />");
									$sale_rank[$a] = $salesRank->getRank();
									$a++;
								}
							}
						} 
		
		//echo("    ****************************************************************************************************<br /><br />");
		
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
// ****************************************** END OF CALL FOR AMAZON SALES RANK *************************************
		

// ****************************************** CALL FOR Lowest Offer Listings FOR "USED BOOKS" *************************************
		$ASINs = new MarketplaceWebServiceProducts_Model_ASINListType();
		
		$ASINs->setASIN(array($book_data['ISBN'])); // ISBN VALUES FOR TESTING 0205004679, '1439056501', '012092871X', '0439064872'
		
		$request_lowest_price_used = new MarketplaceWebServiceProducts_Model_GetLowestOfferListingsForASINRequest();
		$request_lowest_price_used->setSellerId(MERCHANT_ID);
		$request_lowest_price_used->setMarketplaceId(MARKETPLACE_ID);
		
		$request_lowest_price_used->setASINList($ASINs);
		$request_lowest_price_used->setItemCondition('Used');
							
		try {
			  $response = $service->getLowestOfferListingsForASIN($request_lowest_price_used);
			  
				$getLowestOfferListingsForASINResultList = $response->getGetLowestOfferListingsForASINResult();
				foreach ($getLowestOfferListingsForASINResultList as $getLowestOfferListingsForASINResult) {
					//echo("            GetLowestOfferListingsForASINResult\n");
				if ($getLowestOfferListingsForASINResult->isSetASIN()) {
					//echo("        ASIN");
					//echo("<br />");
					$getLowestOfferListingsForASINResult->getASIN();
				} 
				if ($getLowestOfferListingsForASINResult->isSetStatus()) {
					//echo("        status");
					//echo("<br />");
				   $getLowestOfferListingsForASINResult->getStatus();
				} 
					if ($getLowestOfferListingsForASINResult->isSetAllOfferListingsConsidered()) 
					{
						//echo("AllOfferListingsConsidered\n");
						$getLowestOfferListingsForASINResult->getAllOfferListingsConsidered();
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
								
								foreach ($competitivePriceList as $competitivePrice) {
									//echo("                            CompetitivePrice\n");
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
									//echo("                            Rank\n");
								   $salesRank->getRank();
								}
							}
						} 
						if ($product->isSetLowestOfferListings()) { 
							//echo("                    LowestOfferListings\n");
							$lowestOfferListings = $product->getLowestOfferListings();
							$lowestOfferListingList = $lowestOfferListings->getLowestOfferListing();
							
							$j = 0;
							$low_price_used = array();
							foreach ($lowestOfferListingList as $lowestOfferListing) {
								//echo("<br />*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*<br /><br />");
							 
								
								if ($lowestOfferListing->isSetPrice()) { 
									//echo("                            Price\n");
									$price1 = $lowestOfferListing->getPrice();
									if ($price1->isSetLandedPrice()) { 
										//echo("                                <strong>Landed Price:</strong> ");
										$landedPrice1 = $price1->getLandedPrice();
										if ($landedPrice1->isSetCurrencyCode()) 
										{
											//echo("                                    CurrencyCode\n");
										   $landedPrice1->getCurrencyCode();
										}
										if ($landedPrice1->isSetAmount()) 
										{
											//echo("                                    Amount\n");
											//echo("                                        " . $landedPrice1->getAmount() . "<br />");
		// Getting the landed price											
											$low_price_used[$j] = $landedPrice1->getAmount();
											//echo 'Landed Price'.$price[$j];
											$j++;
										}
									} 
									if ($price1->isSetListingPrice()) { 
										//echo("                                <strong>Listing Price</strong>: ");
										$listingPrice1 = $price1->getListingPrice();
										if ($listingPrice1->isSetCurrencyCode()) 
										{
											//echo("                                    CurrencyCode\n");
											$listingPrice1->getCurrencyCode();
										}
										if ($listingPrice1->isSetAmount()) 
										{
											//echo("                                    Amount\n");
											//echo("                                        " . $listingPrice1->getAmount() . "<br />");
										}
									} 
									if ($price1->isSetShipping()) { 
										//echo("                                <strong>Shipping Price:</strong> ");
										$shipping1 = $price1->getShipping();
										if ($shipping1->isSetCurrencyCode()) 
										{
											//echo("                                    CurrencyCode\n");
											$shipping1->getCurrencyCode();
										}
										if ($shipping1->isSetAmount()) 
										{
											//echo("                                    Amount\n");
											//echo("                                        " . $shipping1->getAmount() . "<br />");
										}
									} 
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
						//echo("                RequestId\n");
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
// ****************************************** END OF CALL FOR Lowest Offer Listings FOR "USED BOOKS" *************************************

		
		
// ****************************************** CALL FOR Lowest Offer Listings FOR "NEW BOOKS" *************************************

		$ASINs = new MarketplaceWebServiceProducts_Model_ASINListType();
		
		$ASINs->setASIN(array($book_data['ISBN'])); // ISBN VALUES FOR TESTING 0205004679, '1439056501', '012092871X', '0439064872'
		
		$request_lowest_price_new = new MarketplaceWebServiceProducts_Model_GetLowestOfferListingsForASINRequest();
		$request_lowest_price_new->setSellerId(MERCHANT_ID);
		$request_lowest_price_new->setMarketplaceId(MARKETPLACE_ID);
		
		$request_lowest_price_new->setASINList($ASINs);
		$request_lowest_price_new->setItemCondition('New');
		
							
		try {
			  $response = $service->getLowestOfferListingsForASIN($request_lowest_price_new);
			  
				$getLowestOfferListingsForASINResultList = $response->getGetLowestOfferListingsForASINResult();
				foreach ($getLowestOfferListingsForASINResultList as $getLowestOfferListingsForASINResult) {
					//echo("            GetLowestOfferListingsForASINResult\n");
				if ($getLowestOfferListingsForASINResult->isSetASIN()) {
					//echo("        ASIN");
					//echo("<br />");
					$getLowestOfferListingsForASINResult->getASIN();
				} 
				if ($getLowestOfferListingsForASINResult->isSetStatus()) {
					//echo("        status");
					//echo("<br />");
				   $getLowestOfferListingsForASINResult->getStatus();
				} 
					if ($getLowestOfferListingsForASINResult->isSetAllOfferListingsConsidered()) 
					{
						//echo("AllOfferListingsConsidered\n");
						$getLowestOfferListingsForASINResult->getAllOfferListingsConsidered();
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
								
								foreach ($competitivePriceList as $competitivePrice) {
									//echo("                            CompetitivePrice\n");
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
									//echo("                            Rank\n");
								}
							}
						} 
						if ($product->isSetLowestOfferListings()) { 
							//echo("                    LowestOfferListings\n");
							$lowestOfferListings = $product->getLowestOfferListings();
							$lowestOfferListingList = $lowestOfferListings->getLowestOfferListing();

							$k = 0;
							$low_price_new = array();
							foreach ($lowestOfferListingList as $lowestOfferListing) {
								//echo("<br />*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*<br /><br />");
							 
								
								if ($lowestOfferListing->isSetPrice()) { 
									//echo("                            Price\n");
									$price1 = $lowestOfferListing->getPrice();
									if ($price1->isSetLandedPrice()) { 
										//echo("                                <strong>Landed Price:</strong> ");
										$landedPrice1 = $price1->getLandedPrice();
										if ($landedPrice1->isSetCurrencyCode()) 
										{
											//echo("                                    CurrencyCode\n");
										   $landedPrice1->getCurrencyCode();
										}
										if ($landedPrice1->isSetAmount()) 
										{
											//echo("                                    Amount\n");
											//echo("                                        " . $landedPrice1->getAmount() . "<br />");
		// Getting the landed price											
											$low_price_new[$k] = $landedPrice1->getAmount();
											//echo 'Landed Price'.$price[$j];
											$k++;
										}
									} 
									if ($price1->isSetListingPrice()) { 
										//echo("                                <strong>Listing Price</strong>: ");
										$listingPrice1 = $price1->getListingPrice();
										if ($listingPrice1->isSetCurrencyCode()) 
										{
											//echo("                                    CurrencyCode\n");
											$listingPrice1->getCurrencyCode();
										}
										if ($listingPrice1->isSetAmount()) 
										{
											//echo("                                    Amount\n");
											//echo("                                        " . $listingPrice1->getAmount() . "<br />");
										}
									} 
									if ($price1->isSetShipping()) { 
										//echo("                                <strong>Shipping Price:</strong> ");
										$shipping1 = $price1->getShipping();
										if ($shipping1->isSetCurrencyCode()) 
										{
											//echo("                                    CurrencyCode\n");
											$shipping1->getCurrencyCode();
										}
										if ($shipping1->isSetAmount()) 
										{
											//echo("                                    Amount\n");
											//echo("                                        " . $shipping1->getAmount() . "<br />");
										}
									} 
								}
								 
							   
							}
						//echo("<br />*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*<br />");
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
						//echo("                RequestId\n");
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
// ****************************************** END OF CALL FOR Lowest Offer Listings FOR "NEW BOOKS" *************************************

            
// ************************ SETTING THE VALUES OF AMAZON LOW NEW PRICE, AMAZON LOW USED PRICE & SALES RANK ************************

echo 'Low New: '.$low_price_new[0].' Low Used: '.$low_price_used[0].' Sales Rank: '.$sale_rank[0].'<br />';

if( mysql_query("UPDATE book_shipment SET amazon_new_low = $low_price_new[0] ,amazon_used_low = $low_price_used[0] , amazon_sales_rank = $sale_rank[0] WHERE id = $book_shipment_id"));
echo "DB Updated<br /><br />";

} // END - WHILE LOOP

?>