<?php
    use PHPUnit\Framework\TestCase;
    require_once(__DIR__.'/../Functions/ConnectionFunctionSet.php');
    require_once(__DIR__.'/../Functions/ValidationFunctionSet.php');
    require_once(__DIR__.'/../Functions/UpdateFunctionSet.php');

    class ValidationFunctionSetTest extends PHPUnit_Framework_TestCase
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

        public function testIsStudent_true()
        {
            $ID = createStudent($this->_conn, "test", "password", "CS", 1);
            $this->assertTrue(isStudent($this->_conn, $ID));
        }

        public function testIsStudent_false()
        {
            $ID = createFaculty($this->_conn, "test", "password", "CS");
            $this->assertFalse(isStudent($this->_conn, $ID));
        }
    }
?>