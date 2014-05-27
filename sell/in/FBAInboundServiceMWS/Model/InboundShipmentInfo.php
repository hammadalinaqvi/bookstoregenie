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
 *  @see FBAInboundServiceMWS_Model
 */
require_once ('FBAInboundServiceMWS/Model.php');  

    

/**
 * FBAInboundServiceMWS_Model_InboundShipmentInfo
 * 
 * Properties:
 * <ul>
 * 
 * <li>ShipmentId: string</li>
 * <li>ShipmentName: string</li>
 * <li>ShipFromAddress: FBAInboundServiceMWS_Model_Address</li>
 * <li>DestinationFulfillmentCenterId: string</li>
 * <li>ShipmentStatus: string</li>
 * <li>LabelPrepType: string</li>
 * <li>AreCasesRequired: bool</li>
 *
 * </ul>
 */ 
class FBAInboundServiceMWS_Model_InboundShipmentInfo extends FBAInboundServiceMWS_Model
{

    /**
     * Construct new FBAInboundServiceMWS_Model_InboundShipmentInfo
     * 
     * @param mixed $data DOMElement or Associative Array to construct from. 
     * 
     * Valid properties:
     * <ul>
     * 
     * <li>ShipmentId: string</li>
     * <li>ShipmentName: string</li>
     * <li>ShipFromAddress: FBAInboundServiceMWS_Model_Address</li>
     * <li>DestinationFulfillmentCenterId: string</li>
     * <li>ShipmentStatus: string</li>
     * <li>LabelPrepType: string</li>
     * <li>AreCasesRequired: bool</li>
     *
     * </ul>
     */
    public function __construct($data = null)
    {
        $this->_fields = array (
        'ShipmentId' => array('FieldValue' => null, 'FieldType' => 'string'),
        'ShipmentName' => array('FieldValue' => null, 'FieldType' => 'string'),

        'ShipFromAddress' => array('FieldValue' => null, 'FieldType' => 'FBAInboundServiceMWS_Model_Address'),

        'DestinationFulfillmentCenterId' => array('FieldValue' => null, 'FieldType' => 'string'),
        'ShipmentStatus' => array('FieldValue' => null, 'FieldType' => 'string'),
        'LabelPrepType' => array('FieldValue' => null, 'FieldType' => 'string'),
        'AreCasesRequired' => array('FieldValue' => null, 'FieldType' => 'bool'),
        );
        parent::__construct($data);
    }

        /**
     * Gets the value of the ShipmentId property.
     * 
     * @return string ShipmentId
     */
    public function getShipmentId() 
    {
        return $this->_fields['ShipmentId']['FieldValue'];
    }

    /**
     * Sets the value of the ShipmentId property.
     * 
     * @param string ShipmentId
     * @return this instance
     */
    public function setShipmentId($value) 
    {
        $this->_fields['ShipmentId']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Sets the value of the ShipmentId and returns this instance
     * 
     * @param string $value ShipmentId
     * @return FBAInboundServiceMWS_Model_InboundShipmentInfo instance
     */
    public function withShipmentId($value)
    {
        $this->setShipmentId($value);
        return $this;
    }


    /**
     * Checks if ShipmentId is set
     * 
     * @return bool true if ShipmentId  is set
     */
    public function isSetShipmentId()
    {
        return !is_null($this->_fields['ShipmentId']['FieldValue']);
    }

    /**
     * Gets the value of the ShipmentName property.
     * 
     * @return string ShipmentName
     */
    public function getShipmentName() 
    {
        return $this->_fields['ShipmentName']['FieldValue'];
    }

    /**
     * Sets the value of the ShipmentName property.
     * 
     * @param string ShipmentName
     * @return this instance
     */
    public function setShipmentName($value) 
    {
        $this->_fields['ShipmentName']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Sets the value of the ShipmentName and returns this instance
     * 
     * @param string $value ShipmentName
     * @return FBAInboundServiceMWS_Model_InboundShipmentInfo instance
     */
    public function withShipmentName($value)
    {
        $this->setShipmentName($value);
        return $this;
    }


    /**
     * Checks if ShipmentName is set
     * 
     * @return bool true if ShipmentName  is set
     */
    public function isSetShipmentName()
    {
        return !is_null($this->_fields['ShipmentName']['FieldValue']);
    }

    /**
     * Gets the value of the ShipFromAddress.
     * 
     * @return Address ShipFromAddress
     */
    public function getShipFromAddress() 
    {
        return $this->_fields['ShipFromAddress']['FieldValue'];
    }

    /**
     * Sets the value of the ShipFromAddress.
     * 
     * @param Address ShipFromAddress
     * @return void
     */
    public function setShipFromAddress($value) 
    {
        $this->_fields['ShipFromAddress']['FieldValue'] = $value;
        return;
    }

    /**
     * Sets the value of the ShipFromAddress  and returns this instance
     * 
     * @param Address $value ShipFromAddress
     * @return FBAInboundServiceMWS_Model_InboundShipmentInfo instance
     */
    public function withShipFromAddress($value)
    {
        $this->setShipFromAddress($value);
        return $this;
    }


    /**
     * Checks if ShipFromAddress  is set
     * 
     * @return bool true if ShipFromAddress property is set
     */
    public function isSetShipFromAddress()
    {
        return !is_null($this->_fields['ShipFromAddress']['FieldValue']);

    }

    /**
     * Gets the value of the DestinationFulfillmentCenterId property.
     * 
     * @return string DestinationFulfillmentCenterId
     */
    public function getDestinationFulfillmentCenterId() 
    {
        return $this->_fields['DestinationFulfillmentCenterId']['FieldValue'];
    }

    /**
     * Sets the value of the DestinationFulfillmentCenterId property.
     * 
     * @param string DestinationFulfillmentCenterId
     * @return this instance
     */
    public function setDestinationFulfillmentCenterId($value) 
    {
        $this->_fields['DestinationFulfillmentCenterId']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Sets the value of the DestinationFulfillmentCenterId and returns this instance
     * 
     * @param string $value DestinationFulfillmentCenterId
     * @return FBAInboundServiceMWS_Model_InboundShipmentInfo instance
     */
    public function withDestinationFulfillmentCenterId($value)
    {
        $this->setDestinationFulfillmentCenterId($value);
        return $this;
    }


    /**
     * Checks if DestinationFulfillmentCenterId is set
     * 
     * @return bool true if DestinationFulfillmentCenterId  is set
     */
    public function isSetDestinationFulfillmentCenterId()
    {
        return !is_null($this->_fields['DestinationFulfillmentCenterId']['FieldValue']);
    }

    /**
     * Gets the value of the ShipmentStatus property.
     * 
     * @return string ShipmentStatus
     */
    public function getShipmentStatus() 
    {
        return $this->_fields['ShipmentStatus']['FieldValue'];
    }

    /**
     * Sets the value of the ShipmentStatus property.
     * 
     * @param string ShipmentStatus
     * @return this instance
     */
    public function setShipmentStatus($value) 
    {
        $this->_fields['ShipmentStatus']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Sets the value of the ShipmentStatus and returns this instance
     * 
     * @param string $value ShipmentStatus
     * @return FBAInboundServiceMWS_Model_InboundShipmentInfo instance
     */
    public function withShipmentStatus($value)
    {
        $this->setShipmentStatus($value);
        return $this;
    }


    /**
     * Checks if ShipmentStatus is set
     * 
     * @return bool true if ShipmentStatus  is set
     */
    public function isSetShipmentStatus()
    {
        return !is_null($this->_fields['ShipmentStatus']['FieldValue']);
    }

    /**
     * Gets the value of the LabelPrepType property.
     * 
     * @return string LabelPrepType
     */
    public function getLabelPrepType() 
    {
        return $this->_fields['LabelPrepType']['FieldValue'];
    }

    /**
     * Sets the value of the LabelPrepType property.
     * 
     * @param string LabelPrepType
     * @return this instance
     */
    public function setLabelPrepType($value) 
    {
        $this->_fields['LabelPrepType']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Sets the value of the LabelPrepType and returns this instance
     * 
     * @param string $value LabelPrepType
     * @return FBAInboundServiceMWS_Model_InboundShipmentInfo instance
     */
    public function withLabelPrepType($value)
    {
        $this->setLabelPrepType($value);
        return $this;
    }


    /**
     * Checks if LabelPrepType is set
     * 
     * @return bool true if LabelPrepType  is set
     */
    public function isSetLabelPrepType()
    {
        return !is_null($this->_fields['LabelPrepType']['FieldValue']);
    }

    /**
     * Gets the value of the AreCasesRequired property.
     * 
     * @return bool AreCasesRequired
     */
    public function getAreCasesRequired() 
    {
        return $this->_fields['AreCasesRequired']['FieldValue'];
    }

    /**
     * Sets the value of the AreCasesRequired property.
     * 
     * @param bool AreCasesRequired
     * @return this instance
     */
    public function setAreCasesRequired($value) 
    {
        $this->_fields['AreCasesRequired']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Sets the value of the AreCasesRequired and returns this instance
     * 
     * @param bool $value AreCasesRequired
     * @return FBAInboundServiceMWS_Model_InboundShipmentInfo instance
     */
    public function withAreCasesRequired($value)
    {
        $this->setAreCasesRequired($value);
        return $this;
    }


    /**
     * Checks if AreCasesRequired is set
     * 
     * @return bool true if AreCasesRequired  is set
     */
    public function isSetAreCasesRequired()
    {
        return !is_null($this->_fields['AreCasesRequired']['FieldValue']);
    }




}
