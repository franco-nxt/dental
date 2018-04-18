<?php

/**
 * mySQL class for handling queries.
 * 
 * @author Juan Marcos [malditared@hotmail.com]
 * @Creation date 2010-05-22
 */
// Local constants

define('ENC_STR', '!enc');

function eval_return($match) {
    $res = eval("return {$match[1]};");
    return $res;
}

class mySQL {

    /**
     * The instance for Singleton
     *
     * @var  object
     */
    private static $instance;

    /**
     * The connection resource id
     *
     * @var  object
     */
    var $connection;

    /**
     * The selected database
     *
     * @var  object
     */
    var $selectedDb;

    /**
     * The result from a select-query
     *
     * @var  object
     */
    var $res;

    /**
     * Flag that tells if you are connected to the database or not
     *
     * @var  boolean
     */
    var $isConnected;

    /**
     * Flag that tells if you the tables are locked or not
     *
     * @var  boolean
     */
    var $isLocked;

    /**
     * Flag that tells if some fields are encrypted
     *
     * @var  boolean
     */
    var $isEncrypted;

    /**
     * This will indicate what querytype the last query was
     *
     * @var	string
     */
    var $queryType;

    /**
     * This will save the last sql query (debug)
     *
     * @var	string
     */
    var $lastQuery = "";

    /**
     * Gets or creates the Instance for the Singleton.
     */
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB);
        }

        return self::$instance;
    }

    /**
     * This is the constructor of this mysql class.
     * It creates a connection to the database, and if possible it sets the database to
     * You can specify if you want to use persistant connections or not.
     *
     * @param 	string	The host to the mySQL server
     * @param	string	The username you use to log on to the mySQL server
     * @param	string	The password you use to log on to the mySQL server
     * @param	string	The name of the database you wish to use
     * @param	boolean	true if you want to use persistant connections. Default is true
     * @return	boolean	true when connection was successfull
     * @access	public
     */
    function mySQL($sHost, $sUser, $sPassword, $sDatabase = null, $encPass = null, $bPersistant = false) {

        !defined("DEBUG") && define("DEBUG", false);

        $this->res = array();

        $this->getConnected() && $this->closeConnection();

        $this->connection = new mysqli(($bPersistant ? 'p:' : '') . $sHost, $sUser, $sPassword, null);

        if ($this->connection) {
            $this->setConnected(true);

            $sDatabase && $this->setDb($sDatabase);

            if ($encPass) {
                $this->setEncrypted(true);
                $this->setEncPass($encPass);
            }
            else{
                $this->setEncrypted(false);
            }
            
            return true;
        }
        else {
            $this->setConnected(false);
        
            return false;
        }
    }

    /**
     * This is the destructor of this class. It frees the result of all queries,
     * unlocks all locked tables and close the connection.
     *
     * @access	public
     */
    function _mySQL() {
        while ($this->lastQ()) {
            $this->free();
        }
        if ($this->getLocked()) {
            $this->unlock();
        }
        if ($this->getConnected()) {
            $this->closeConnection();
        }
    }

    /**
     * This function frees the result from a query if there is any result.
     *
     * @access	public
     */
    function free() {
        $this->freeQ();
    }

    /**
     * Frees last query resource
     *
     * @access	private
     */
    function freeQ() {
        if (!$this->res){
            return false;
        }

        $res = array_pop($this->res);
        get_class($res) == 'mysqli_result' && $res->free();
    }

    /**
     * Gets last query resource
     *
     * @access	private
     */
    function addQ($res) {
        $this->res[] = $res;
    }

    /**
     * Gets last query resource
     *
     * @access	private
     */
    function lastQ() {
        if (!$this->res){
            return false;
        }
        
        return end($this->res);
    }

    /* Returns the auto_increment of the last INSERT query */

    function lastID() {
        return $this->connection->insert_id;
    }

    function escape($val) {
        if (is_string($val)){
            return $this->connection->real_escape_string($val);
        }
        elseif (is_array($val)) {
            foreach ($val as &$v){
                $v = $this->connection->real_escape_string($v);
            }
        }

        return $val;
    }

    /**
     * This function executes a query to the database.
     * The function does not return the result of the query, you must call the
     * function getQueryResult() to fetch the result
     *
     * @param 	string	The query-string to execute
     * @return	boolean	true if the query was successfull
     * @access	public
     */
    function query($query) {
        $query = trim($query);

        if (strlen($query) == 0) {
            $this->printError("No query got in function query().");
            return false;
        }

        if (!$this->getConnected()) {
            $this->printError("Not connected in function query().");
            return false;
        }

        $queryType = substr(trim($query), 0, strpos($query, " "));
        $queryType = strtoupper($queryType);
        
        $this->setQueryType($queryType);
        $this->setLastQuery($query);

        $this->getEncrypted() && ($query = $this->procesarEnc($query));

        $res = $this->connection->query($query);

        $this->log('query() -> ' . $query);

        if ($this->connection->error && DEBUG) {
            echo "mySQL Error en consulta:<br />{$query}<br /><br />Error {$this->connection->errno}: {$this->connection->error}.";
            $this->log('#Error# -> ' . $this->connection->error);
            exit;
        }
        
        if ($res) {
            is_object($res) && get_class($res) == 'mysqli_result' && $this->addQ($res);

            return true;
        }
        
        return false;
    }

    /**
     * Query that is expected to return a single value
     *
     * @access	public
     */
    function oneFieldQuery($sql) {
        if (!$sql){
            return false;
        }
        
        $this->query($sql);
        
        $res = $this->fetchArray();
        
        $this->free();

        if (!$res){
            return false;
        }
        
        return $res[0];
    }

    function oneRowQuery($sql) {
        $this->query($sql);
        $res = $this->fetchAssoc();
        $this->free();

        if (!$res)
            return false;

        return $res;
    }

    function oneArrayQuery($sql) {
        $this->query($sql);
        $res = $this->fetchArray();
        $this->free();

        if (!$res)
            return false;

        return $res;
    }

    /**
     * It saves the password for encrypted fields, so is not passed in each query
     *
     * @access	public
     */
    function setEncPass($pass) {
        if (!$pass){
            return false;
        }
        
        $sql = "SELECT @encPass:='$pass'";
        $this->query($sql);
        $this->free();
        return true;
    }

    function getEncPass() {
        $sql = "SELECT @encPass";
        $pass = $this->oneFieldQuery($sql);
        return $pass;
    }

    function isEncryptedField($table, $field) {
        if (!$table || !$field)
            return false;

        $sql = "SHOW FULL COLUMNS FROM $table WHERE FIELD = '$field'";

        $res = $this->oneRowQuery($sql);

        return (strpos($res['Comment'], ENC_STR) === 0);
    }

    /**
     * Searchs for encripted fields {field} and replaces them for the corresponding string
     * Is called before $this->query()
     *
     * @access	private
     */
    private function procesarEnc($sql) {
        /** Esta es la expresi�n regular que convierte a formato encriptador/desencriptador
         * La conversi�n es sencilla
         * {{X}} -> AES_ENCRYPT(X, @encPass) AS X
         * {{Y.X}} -> AES_ENCRYPT(Y.X, @encPass) AS X
         * {{X}}! -> AES_ENCRYPT(X, @encPass)
         * {{Y.X}}! -> AES_ENCRYPT(Y.X, @encPass)
         * {{~X}} -> AES_DECRYPT(X, @encPass) AS X
         * {{~Y.X}} -> AES_DECRYPT(Y.X, @encPass) AS X
         * {{~X}}! -> AES_DECRYPT(X, @encPass)
         * {{~Y.X}}! -> AES_DECRYPT(Y.X, @encPass)
         * */
        $query = preg_replace("/\{\{(\~){0,1}([^\{\}]*\.){0,1}([^\.\{\}]+)\}\}(\!){0,1}/ise", "(\"\\1\" == \"~\"? \"AES_DECRYPT\":\"AES_ENCRYPT\" ).\"(\\2\\3, @encPass) \".(\"\\4\"!=\"\" || \"\\1\"==\"\" ? \"\" : \"AS \\3 \")", $sql);
        return $query;
    }

    /**
     * Sets the querytype of the last query executed
     * For example it can be SELECT, UPDATE, DELETE etc.
     *
     * @access	private
     */
    function setQueryType($type) {
        $this->queryType = strtoupper($type);
    }

    /**
     * Returns the querytype
     *
     * @return	string
     * @access	private
     */
    function getType() {
        return $this->queryType;
    }

    /**
     * This function returns number of rows got when executing a query
     *
     * @return	mixed	false if there is no query-result.
     * 					If the queryType is SELECT then it will use the function MYSQL_NUM_ROWS
     * 					Otherwise it uses the MYSQL_AFFECTED_ROWS
     * @access	public
     */
    function numRows() {
        if ($this->lastQ()) {
            if ($this->getType() == "SELECT")
                return mysqli_num_rows($this->lastQ());
            else
                return mysqli_affected_rows($this->lastQ());
        }
        return false;
    }

    /**
     * The function returns the result from a call to the query() function
     *
     * @return	object
     * @access	public
     */
    function getQueryResult() {
        return $this->lastQ();
    }

    /**
     * This function returns the query result as an array for each row in the query result
     *
     * @return	array
     * @access	public
     */
    function fetchArray() {
        if ($this->lastQ()) {
            return $this->lastQ()->fetch_array(MYSQLI_BOTH);
        }
        
        return false;
    }

    /**
     * This function returns the query result as an associated array for each row in the query result
     *
     * @return	array
     * @access	public
     */
    function fetchAssoc() {
        if ($this->lastQ()) {
            return $this->lastQ()->fetch_array(MYSQLI_ASSOC);
        }
        
        return false;
    }

    /**
     * This function returns the query result as an object for each row in the query result
     *
     * @return	object
     * @access	public
     */
    function fetchObject() {
        if ($this->lastQ()) {
            return $this->lastQ()->fetch_object();
        }
        
        return false;
    }

    /**
     * This function returns the query result as an array for each row in the query result
     *
     * @return	array
     * @access	public
     */
    function fetchRow() {
        if ($this->lastQ()) {
            return $this->lastQ()->fetch_row();
        }
        
        return false;
    }

    // Returns an associative aray list.
    function getAssocList($query) {
        $res = array();

        $this->query($query);
        
        while ($row = $this->fetchAssoc()){
            $res[] = $row;
        }
        
        $this->free();

        return $res;
    }

    /**
     * This function sets the database
     *
     * @return	boolean	true if the database was set
     * @access	public
     */
    function setDb($sDatabase) {
        if (!$this->getConnected()) {
            $this->printError("Not connected in function setDb()");
            return false;
        }
        
        $this->selectedDb = $this->connection->select_db($sDatabase);
        
        return $this->selectedDb ? true : false;
    }

    /**
     * This function returns a flag so you can see if you are connected to the database
     * or not
     *
     * @return	boolean	true when connected to the database
     * @access	public
     */
    function getConnected() {
        return $this->isConnected;
    }

    /**
     * This function sets the flag so you can see if you are connected to the database
     *
     * @param	$bStatus	The status of the connection. true if you are connected,
     * 						false if you are not
     * @access	public
     */
    function setConnected($bStatus) {
        $this->isConnected = $bStatus;
    }

    function log($msg) {
        if (!defined('MYSQL_LOG') || !MYSQL_LOG){
            return false;
        }
        
        $date = date("d/m/Y H:i:s");
        $logfile = defined('LOG_DIR') ? LOG_DIR . '/mysql.log' : 'mysql.log';
        $file = fopen($logfile, 'a');
        
        fwrite($file, "$date: $msg\r\n");
        fclose($file);
    }

    /**
     * The function unlocks tables if there are locked tables and the closes the
     * connection to the database.
     *
     * @access	public
     */
    function closeConnection() {
        if ($this->getLocked()) {
            $this->unlock();
        }

        if ($this->getConnected()) {
            mysql_close($this->connection);
            $this->setConnected(false);
        }
    }

    /**
     * Unlocks all tables that are locked
     *
     * @access	public
     */
    function unlock() {
        if (!$this->getConnected()) {
            $this->setLocked(false);
        }
        if ($this->getLocked()) {
            $this->query("UNLOCK TABLES");
            $this->setLocked(false);
        }
    }

    /**
     * This function locks the table(s) that you specify
     * The type of lock must be specified at the end of the string.
     *
     * @param	string	a string containing the table(s) to lock, 
     * 					as well as the type of lock to use (READ or WRITE) 
     * 					at the end of the string
     * @return	boolean	true if the tables was successfully locked
     * @access	private
     */
    function lock($sCommand) {
        if ($this->query("LOCK TABLE " . $sCommand)) {
            $this->setLocked(true);
            return true;
        }

        $this->setLocked(false);
        return false;
    }

    /**
     * This functions sets read lock to specified table(s)
     *
     * @param	string	a string containing the table(s) to read-lock
     * @return	boolean	true on success
     */
    function setReadLock($sTable) {
        return $this->lock($sTable . " " . LOCKED_FOR_READ);
    }

    /**
     * This functions sets write lock to specified table(s)
     *
     * @param	string	a string containing the table(s) to read-lock
     * @return	boolean true on success
     */
    function setWriteLock($sTable) {
        return $this->lock($sTable . " " . LOCKED_FOR_WRITE);
    }

    /**
     * Sets the flag that indicates if there is any tables locked
     *
     * @param	boolean	The flag that will indicate the lock. true if locked
     */
    function setLocked($bStatus) {
        $this->isLocked = $bStatus;
    }

    /**
     * Sets the flag that indicates if has encrypted fields
     *
     * @param	boolean
     */
    function setEncrypted($bStatus) {
        $this->isEncrypted = $bStatus;
    }

    /**
     * Sets the flag that indicates if has encrypted fields
     *
     * @param	boolean
     */
    function getEncrypted() {
        return $this->isEncrypted;
    }

    /**
     * Returns true if there is any locked tables
     *
     * @return	boolean true if there are locked tables
     */
    function getLocked() {
        return $this->isLocked;
    }

    /**
     * Returns true if there is any locked tables
     *
     * @return	boolean true if there are locked tables
     */
    function setLastQuery($query) {
        $this->lastQuery = $query;
    }

    /**
     * Returns true if there is any locked tables
     *
     * @return	boolean true if there are locked tables
     */
    function getLastQuery() {
        return $this->lastQuery;
    }

    /**
     * Prints an error to the screen. Can be used to kill the application
     *
     * @param	string	The text to display
     * @param	boolean	true if you want to kill the application. Default is false
     */
    function printError($text, $killApp = false) {
        if ($text) {
            print("<b>Error</b><br />" . $text);
        }
        
        if ($killApp) {
            exit();
        }
    }

    /**
     * Display any mysql-error
     *
     * @return	mixed	String with the error if there is any error.
     * 					Otherwise it returns false
     */
    function getMysqlError() {
        if (mysqli_error($this->connection)) {
            return "<br /><b>Mysql Error Number " . mysql_errno() . "</b><br />" . mysqli_error($this->connection);
        }
        return false;
    }

    function toArray($sql) {
        $out = array();

        $this->query($sql);

        while ($row = $this->fetchAssoc()){
            $out[] = $row;
        }

        $this->free();
        return $out;
    }

// toArray()

    /**
     * undocumented function
     *
     * @return void
     * @author 
     * */
    function callProcedure() {
        $arg_list = func_get_args();
        $proc = array_shift($arg_list);

        $arg_list = implode("','", $arg_list);

        $q = "CALL " . $proc . "('" . $arg_list . "');";

        $this->query($q);

        $result = array();
        while ($row = mysql_fetch_assoc($this->lastQ())) {
            $result[] = $row;
        }

        mysql_free_result($this->lastQ());
        mysql_next_result($this->connection);

        return $result;
    }
}