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
 *  Generated: Wed Mar 02 08:09:30 UTC 2011
 * 
 */

/**
 *  @see FBAInboundServiceMWS_Model
 */
require_once ('FBAInboundServiceMWS/Model.php');  

    

/**
 * FBAInboundServiceMWS_Model_ShipmentIdList
 * 
 * Properties:
 * <ul>
 * 
 * <li>member: string</li>
 *
 * </ul>
 */ 
class FBAInboundServiceMWS_Model_ShipmentIdList extends FBAInboundServiceMWS_Model
{


    /**
     * Construct new FBAInboundServiceMWS_Model_ShipmentIdList
     * 
     * @param mixed $data DOMElement or Associative Array to construct from. 
     * 
     * Valid properties:
     * <ul>
     * 
     * <li>member: string</li>
     *
     * </ul>
     */
    public function __construct($data = null)
    {
        $this->_fields = array (
        'member' => array('FieldValue' => array(), 'FieldType' => array('string')),
        );
        parent::__construct($data);
    }

        /**
     * Gets the value of the member .
     * 
     * @return array of string member
     */
    public function getmember() 
    {
        return $this->_fields['member']['FieldValue'];
    }

    /**
     * Sets the value of the member.
     * 
     * @param string or an array of string member
     * @return this instance
     */
    public function setmember($member) 
    {
        if (!$this->_isNumericArray($member)) {
            $member =  array ($member);    
        }
        $this->_fields['member']['FieldValue'] = $member;
        return $this;
    }
  

    /**
     * Sets single or multiple values of member list via variable number of arguments. 
     * For example, to set the list with two elements, simply pass two values as arguments to this function
     * <code>withmember($member1, $member2)</code>
     * 
     * @param string  $stringArgs one or more member
     * @return FBAInboundServiceMWS_Model_ShipmentIdList  instance
     */
    public function withmember($stringArgs)
    {
        foreach (func_get_args() as $member) {
            $this->_fields['member']['FieldValue'][] = $member;
        }
        return $this;
    }  
      

    /**
     * Checks if member list is non-empty
     * 
     * @return bool true if member list is non-empty
     */
    public function isSetmember()
    {
        return count ($this->_fields['member']['FieldValue']) > 0;
    }




}