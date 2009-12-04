<?php

require_once('lib/config.class.php');

class Database{
    private $_dbUrl;
    private $_dbName;
    private $_dbUsername;
    private $_dbPassword;

    private $_link;
  
    /* Constructor */
    function __construct()
    {
        $this->_dbUrl = Config::get( 'database_hostname' );
        $this->_dbName = Config::get( 'database_name' );
        $this->_dbUsername = Config::get( 'database_username' );
        $this->_dbPassword = Config::get( 'database_password' ); 
    
        $this->connect();
    }
    
    /* Connect to the database */
    function connect() 
    {
        $this->_link = mysqli_connect( $this->_dbUrl, $this->_dbUsername, $this->_dbPassword);
        
        if ($this->_link)
        {
            if (!mysqli_select_db ( $this->_link, $this->_dbName))
            {
        	    return die('<p>Could not select the database because: <b>' . mysqli_error($this->_link) . '</b></p>');
            }
            else
            {
    	        return;
            }
        }
        else
        {
            return die('<p>Could not connect to the MYSQL because: <b>' . mysqli_error($this->_link) . '</b></p>');
        }
    }

    /* Return the database link */
    function getLink()
    {
        return $this->_link;
    }

    /* Disconnect Function */
    function disconnect()
    {
        mysqli_close( $this->_link );
    }

    /* Takes a variable number of arguments, sanitizes, and queries 
       First argument must be SQL - Variables are denoted by question marks '?'
       Subsequent arguments are variables to be substituted into the query in order
       replacing the question marks as they proceed */
    function query()
    {
        $numArgs = func_num_args();
    
        if ($numArgs < 1)		/* Must have at least one */
        {
            die( 'Must pass at least one argument to query()' );
        }
    
        $sql = func_get_arg(0);	/* Get the sql */
    
        if ($sql[-1] != ' ')	/* Tacks on the necessary trailing whitespace if not present */
        {
            $sql .= ' ';
        }
    
        for( $i = 1; $i < $numArgs; $i++ ) /* Replaces all %x vars with their actual values */
        {
            $arg = func_get_arg($i);
            $arg = mysqli_real_escape_string( $this->_link, $arg);
    
            if (!is_numeric($arg)) /* Add double quotes if necessary for SQL */
            {
        	    $arg = '"'. $arg .'"';
            }
    
            $sql = preg_replace('/\?/', ' '.$arg.' ', $sql, 1); /* Replacement */
        }
    
        $result = mysqli_query( $this->_link, $sql ) or /* Execute the query */
            die( 'Could not execute query: '. mysqli_error($this->_link) .'<br/>'."\nSQL: ".$sql );
    
        return $result;
    }

    // Call stripslashes on all string objects
    function stripSlashObject(&$object)
    {
        foreach ($object as &$val)
        {
            if (is_string($val))
            {
                $val = stripslashes($val);
            }
        }
    }


    /* Returns an array of objects from the mysqli object */
    function getObjectArray($result)
    {
        $objects = array();

        while($object = mysqli_fetch_object($result))
        {
            $objects[] = $object;
        }

        return $objects;
    }

}

?>
