<?php

  /**
   * BaseReminder class
   */
  class BaseReminder extends ApplicationObject {
    
    /**
     * All table fields
     *
     * @var array
     */
    var $fields = array('id', 'user_id', 'object_id', 'comment', 'created_by_id', 'created_by_name', 'created_by_email', 'created_on');
    
    /**
     * Primary key fields
     *
     * @var array
     */
    var $primary_key = array('id');
    
    /**
     * Name of AI field (if any)
     *
     * @var string
     */
    var $auto_increment = 'id'; 
    
    /**
     * Construct the object and if $id is present load record from database
     *
     * @param mixed $id
     * @return Reminder 
     */
    function __construct($id = null) {
      $this->table_name = TABLE_PREFIX . 'reminders';
      parent::__construct($id);
    }

    /**
     * Return value of id field
     *
     * @param void
     * @return integer
     */
    function getId() {
      return $this->getFieldValue('id');
    }
    
    /**
     * Set value of id field
     *
     * @param integer $value
     * @return integer
     */
    function setId($value) {
      return $this->setFieldValue('id', $value);
    }

    /**
     * Return value of user_id field
     *
     * @param void
     * @return integer
     */
    function getUserId() {
      return $this->getFieldValue('user_id');
    }
    
    /**
     * Set value of user_id field
     *
     * @param integer $value
     * @return integer
     */
    function setUserId($value) {
      return $this->setFieldValue('user_id', $value);
    }

    /**
     * Return value of object_id field
     *
     * @param void
     * @return integer
     */
    function getObjectId() {
      return $this->getFieldValue('object_id');
    }
    
    /**
     * Set value of object_id field
     *
     * @param integer $value
     * @return integer
     */
    function setObjectId($value) {
      return $this->setFieldValue('object_id', $value);
    }

    /**
     * Return value of comment field
     *
     * @param void
     * @return string
     */
    function getComment() {
      return $this->getFieldValue('comment');
    }
    
    /**
     * Set value of comment field
     *
     * @param string $value
     * @return string
     */
    function setComment($value) {
      return $this->setFieldValue('comment', $value);
    }

    /**
     * Return value of created_by_id field
     *
     * @param void
     * @return integer
     */
    function getCreatedById() {
      return $this->getFieldValue('created_by_id');
    }
    
    /**
     * Set value of created_by_id field
     *
     * @param integer $value
     * @return integer
     */
    function setCreatedById($value) {
      return $this->setFieldValue('created_by_id', $value);
    }

    /**
     * Return value of created_by_name field
     *
     * @param void
     * @return string
     */
    function getCreatedByName() {
      return $this->getFieldValue('created_by_name');
    }
    
    /**
     * Set value of created_by_name field
     *
     * @param string $value
     * @return string
     */
    function setCreatedByName($value) {
      return $this->setFieldValue('created_by_name', $value);
    }

    /**
     * Return value of created_by_email field
     *
     * @param void
     * @return string
     */
    function getCreatedByEmail() {
      return $this->getFieldValue('created_by_email');
    }
    
    /**
     * Set value of created_by_email field
     *
     * @param string $value
     * @return string
     */
    function setCreatedByEmail($value) {
      return $this->setFieldValue('created_by_email', $value);
    }

    /**
     * Return value of created_on field
     *
     * @param void
     * @return DateTimeValue
     */
    function getCreatedOn() {
      return $this->getFieldValue('created_on');
    }
    
    /**
     * Set value of created_on field
     *
     * @param DateTimeValue $value
     * @return DateTimeValue
     */
    function setCreatedOn($value) {
      return $this->setFieldValue('created_on', $value);
    }

    /**
     * Set value of specific field
     *
     * @param string $name
     * @param mided $value
     * @return mixed
     */
    function setFieldValue($name, $value) {
      $real_name = $this->realFieldName($name);
      
      $set = $value;
      switch($real_name) {
        case 'id':
          $set = intval($value);
          break;
        case 'user_id':
          $set = intval($value);
          break;
        case 'object_id':
          $set = intval($value);
          break;
        case 'comment':
          $set = strval($value);
          break;
        case 'created_by_id':
          $set = intval($value);
          break;
        case 'created_by_name':
          $set = strval($value);
          break;
        case 'created_by_email':
          $set = strval($value);
          break;
        case 'created_on':
          $set = datetimeval($value);
          break;
      } // switch
      return parent::setFieldValue($real_name, $set);
    } // switch
  
  }

?>