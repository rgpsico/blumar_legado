<?php 
class base { 

    /** 
    * This class variable is set by SetupDB 
    */ 
    var $DBConnection = null; 

    /** 
    * In the base class, the constructor doesn't do anything. 
    */ 
    function __construct() { 
    } 

    /** 
    * In the base class, the constructor doesn't do anything. 
    * This is called by PHP4. 
    */ 
    function API() { 
        $this->__construct(); 
    } 

    /** 
    * This will set up DBConnection ready for use. 
    */ 
    function SetupDB() { 
        if (is_null($this->DBConnection)) { 
            $connection_string = 'host=srvrbd01 port=5432 dbname=blumar user=appweb password=P0l1t1c@'; 
            $connection = pg_connect($connection_string); 
            $this->DBConnection = $connection; 
        } 
    } 

    /** 
    * This is overridden by the child class(es). 
    */ 
    function Create() { 
        echo "Can't call 'create' on the base API class<br/>"; 
        return false; 
    } 

    /** 
    * This is overridden by the child class(es). 
    */ 
    function Load() { 
        echo "Can't call 'load' on the base API class<br/>"; 
        return false; 
    } 

    /** 
    * This is overridden by the child class(es). 
    */ 
    function Update() { 
        echo "Can't call 'update' on the base API class<br/>"; 
        return false; 
    } 

    /** 
    * This is overridden by the child class(es). 
    */ 
    function Delete() { 
        echo "Can't call 'delete' on the base API class<br/>"; 
        return false; 
    } 

    /** 
    * This gets a class variable after making sure it is available. 
    * If it's not a set class variable (ie it doesn't exist), then this will return false. 
    */ 
    function Get($getname='') { 
        if (!isset($this->$getname)) { 
            return false; 
        } 
        return $this->$getname; 
    } 

    /** 
    * This sets a class variable after making sure it is available. 
    * If it's not a set class variable (ie it doesn't exist), then this will return false. 
    * Otherwise the variable is set and this will return true. 
    */ 
    function Set($setname='', $value='') { 
        if (!isset($this->$setname)) { 
            return false; 
        } 
        $this->$setname = $value; 
        return true; 
    } 
} 

?> 