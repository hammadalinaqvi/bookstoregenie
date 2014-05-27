<?php
/** 
 *  PHP Version 5
 *
 *  @category    Amazon
 *  @package     FBAInboundServiceMWS
 *  @copyright   Copyright 2009 Amazon.com, Inc. All Rights Reserved.
 *  @link        http://mws.amazon.com
 *  @license     http://aws.amazon.com/apache2.0  Apache License, Version 2.0
 *  @version     2010-10-01
 */
/******************************************************************************* 
 * 
 *  FBA Inbound Service MWS PHP5 Library
 *  Generated: Fri Oct 22 09:52:55 UTC 2010
 * 
 */

/**
 * Create Inbound Shipment Plan  Sample
 */

include_once ('.config.inc.php'); 

/************************************************************************
* Configuration settings are:
*
* - MWS endpoint URL: it defined in the .config.inc.php located in the 
*                     same directory as this sample.
* - Proxy host and port.
* - MaxErrorRetry.
***********************************************************************/
$config = array (
  'ServiceURL' => MWS_ENDPOINT_URL,
  'ProxyHost' => null,
  'ProxyPort' => -1,
  'MaxErrorRetry' => 3
);

/************************************************************************
 * Instantiate Implementation of FBAInboundServiceMWS
 * 
 * ACCESS_KEY_ID and SECRET_ACCESS_KEY constants 
 * are defined in the .config.inc.php located in the same 
 * directory as this sample
 ***********************************************************************/
 $service = new FBAInboundServiceMWS_Client(
     ACCESS_KEY_ID, 
     SECRET_ACCESS_KEY, 
     $config,
     APPLICATION_NAME,
     APPLICATION_VERSION);

echo '<pre>'; print_r($service); echo '</pre>';

/************************************************************************
 * Uncomment to try out Mock Service that simulates FBAInboundServiceMWS
 * responses without calling FBAInboundServiceMWS service.
 *
 * Responses are loaded from local XML files. You can tweak XML files to
 * experiment with various outputs during development
 *
 * XML files available under FBAInboundServiceMWS/Mock tree
 *
 ***********************************************************************/
 // $service = new FBAInboundServiceMWS_Mock();

/************************************************************************
 * Setup request parameters and uncomment invoke to try out 
 * sample for Create Inbound Shipment Plan Action
 ***********************************************************************/
 // @TODO: set request. Action can be passed as FBAInboundServiceMWS_Model_CreateInboundShipmentPlanRequest
	$address = new FBAInboundServiceMWS_Model_Address();
	
	//Set Address Parameters
	$address-> setName('John Richards');
	$address-> setAddressLine1('15 Thomas Rd.');
	$address-> setAddressLine2('Unit 321');
	$address-> setCity('Seattle');
	$address-> setStateOrProvinceCode('WA');
	$address-> setCountryCode('US');
	$address-> setPostalCode('98101');

//echo '<pre>'; print_r($address);  echo '</pre>';

	$item = new FBAInboundServiceMWS_Model_InboundShipmentPlanRequestItem();
	
	//Set item parameters
	$item-> setSellerSKU('7W-PWZP-1WIR');
	//$item-> setASIN('7W-PWZP-1WWW');
	$item-> setQuantity('1');
	//$item-> setCondition('New');
	//echo '<pre>'; print_r($item);  echo '</pre>'; 
	
	$item_list = new FBAInboundServiceMWS_Model_InboundShipmentPlanRequestItemList();
	$item_list->setmember($item);

//echo '<pre>'; print_r($item_list);  echo '</pre>'; 
 
	$request = new FBAInboundServiceMWS_Model_CreateInboundShipmentPlanRequest();
	$request->setSellerId(SELLER_ID);
	$request->setMarketplace('ATVPDKIKX0DER');
	$request->setLabelPrepPreference('AMAZON_LABEL_PREFERRED');
	$request->setShipFromAddress($address);
	$request->setInboundShipmentPlanRequestItems($item_list);
	//$request->setShipToCountryCode('US');
	
	echo '<pre>'; print_r($request); echo '</pre>';

  invokeCreateInboundShipmentPlan($service, $request);

                        
/**
  * Create Inbound Shipment Plan Action Sample
  * Plans inbound shipments for a set of items.  Registers identifiers if needed,
  * and assigns ShipmentIds for planned shipments.
  * When all the items are not all in the same category (e.g. some sortable, some
  * non-sortable) it may be necessary to create multiple shipments (one for each
  * of the shipment groups returned).  
  * @param FBAInboundServiceMWS_Interface $service instance of FBAInboundServiceMWS_Interface
  * @param mixed $request FBAInboundServiceMWS_Model_CreateInboundShipmentPlan or array of parameters
  */
  function invokeCreateInboundShipmentPlan(FBAInboundServiceMWS_Interface $service, $request) 
  {
      try {
              $response = $service->createInboundShipmentPlan($request);
              echo '<pre>'; print_r($response); echo '</pre>';

                echo ("Service Response\n");
                echo ("=============================================================================\n");

                echo("        CreateInboundShipmentPlanResponse\n");
                if ($response->isSetCreateInboundShipmentPlanResult()) { 
                    echo("            CreateInboundShipmentPlanResult\n");
                    $createInboundShipmentPlanResult = $response->getCreateInboundShipmentPlanResult();
                    if ($createInboundShipmentPlanResult->isSetInboundShipmentPlans()) { 
                        echo("                InboundShipmentPlans\n");
                        $inboundShipmentPlans = $createInboundShipmentPlanResult->getInboundShipmentPlans();
                        $memberList = $inboundShipmentPlans->getmember();
                        foreach ($memberList as $member) {
                            echo("                    member\n");
                            if ($member->isSetShipmentId()) 
                            {
                                echo("                        ShipmentId\n");
                                echo("                            " . $member->getShipmentId() . "\n");
                            }
                            if ($member->isSetDestinationFulfillmentCenterId()) 
                            {
                                echo("                        DestinationFulfillmentCenterId\n");
                                echo("                            " . $member->getDestinationFulfillmentCenterId() . "\n");
                            }
                            if ($member->isSetShipToAddress()) { 
                                echo("                        ShipToAddress\n");
                                $shipToAddress = $member->getShipToAddress();
                                if ($shipToAddress->isSetName()) 
                                {
                                    echo("                            Name\n");
                                    echo("                                " . $shipToAddress->getName() . "\n");
                                }
                                if ($shipToAddress->isSetAddressLine1()) 
                                {
                                    echo("                            AddressLine1\n");
                                    echo("                                " . $shipToAddress->getAddressLine1() . "\n");
                                }
                                if ($shipToAddress->isSetAddressLine2()) 
                                {
                                    echo("                            AddressLine2\n");
                                    echo("                                " . $shipToAddress->getAddressLine2() . "\n");
                                }
                                if ($shipToAddress->isSetDistrictOrCounty()) 
                                {
                                    echo("                            DistrictOrCounty\n");
                                    echo("                                " . $shipToAddress->getDistrictOrCounty() . "\n");
                                }
                                if ($shipToAddress->isSetCity()) 
                                {
                                    echo("                            City\n");
                                    echo("                                " . $shipToAddress->getCity() . "\n");
                                }
                                if ($shipToAddress->isSetStateOrProvinceCode()) 
                                {
                                    echo("                            StateOrProvinceCode\n");
                                    echo("                                " . $shipToAddress->getStateOrProvinceCode() . "\n");
                                }
                                if ($shipToAddress->isSetCountryCode()) 
                                {
                                    echo("                            CountryCode\n");
                                    echo("                                " . $shipToAddress->getCountryCode() . "\n");
                                }
                                if ($shipToAddress->isSetPostalCode()) 
                                {
                                    echo("                            PostalCode\n");
                                    echo("                                " . $shipToAddress->getPostalCode() . "\n");
                                }
                            } 
                            if ($member->isSetLabelPrepType()) 
                            {
                                echo("                        LabelPrepType\n");
                                echo("                            " . $member->getLabelPrepType() . "\n");
                            }
                            if ($member->isSetItems()) { 
                                echo("                        Items\n");
                                $items = $member->getItems();
                                $member1List = $items->getmember();
                                foreach ($member1List as $member1) {
                                    echo("                            member\n");
                                    if ($member1->isSetSellerSKU()) 
                                    {
                                        echo("                                SellerSKU\n");
                                        echo("                                    " . $member1->getSellerSKU() . "\n");
                                    }
                                    if ($member1->isSetFulfillmentNetworkSKU()) 
                                    {
                                        echo("                                FulfillmentNetworkSKU\n");
                                        echo("                                    " . $member1->getFulfillmentNetworkSKU() . "\n");
                                    }
                                    if ($member1->isSetQuantity()) 
                                    {
                                        echo("                                Quantity\n");
                                        echo("                                    " . $member1->getQuantity() . "\n");
                                    }
                                }
                            } 
                        }
                    } 
                } 
                if ($response->isSetResponseMetadata()) { 
                    echo("            ResponseMetadata\n");
                    $responseMetadata = $response->getResponseMetadata();
                    if ($responseMetadata->isSetRequestId()) 
                    {
                        echo("                RequestId\n");
                        echo("                    " . $responseMetadata->getRequestId() . "\n");
                    }
                } 

     } catch (FBAInboundServiceMWS_Exception $ex) {
         echo("Caught Exception: " . $ex->getMessage() . "\n");
         echo("Response Status Code: " . $ex->getStatusCode() . "\n");
         echo("Error Code: " . $ex->getErrorCode() . "\n");
         echo("Error Type: " . $ex->getErrorType() . "\n");
         echo("Request ID: " . $ex->getRequestId() . "\n");
         echo("XML: " . $ex->getXML() . "\n");
     }
 }
                                