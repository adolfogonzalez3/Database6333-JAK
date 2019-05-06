<?php
    use PHPUnit\Framework\TestCase;
    require_once(__DIR__.'/../Functions/ConnectionFunctionSet.php');
    require_once(__DIR__.'/../Functions/ValidationFunctionSet.php');
    require_once(__DIR__.'/../Functions/UpdateFunctionSet.php');
    require_once(__DIR__.'/../Functions/RetrievalFunctionSet.php');

    class RetrievalFunctionSet extends PHPUnit_Framework_TestCase
    {
        protected $_conn = null;
     
        public function setUp()
        {
            $this->_conn = DB_CONNECT();
            $this->_conn->autocommit(FALSE);
        }
     
        public function tearDown()
        {
            unset($this->_conn);
        }

        public function testGetUserByName()
        {
            $ID = createStudent($this->_conn, "test", "password", "CS", 1);
            $results = getUserByName($this->_conn, "test");
            var_dump($results);
            //$this->assertTrue(isStudent($this->_conn, $ID));
        }

        public function testGetAllEquipmentOwnedByUser()
        {
            $EID = createEquipment($this->_conn, "test", 0, "place");
            $FID = createFaculty($this->_conn, "test", "password", "CS");
            
        }
    }
?>