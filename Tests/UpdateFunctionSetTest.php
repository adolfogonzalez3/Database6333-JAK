<?php
    use PHPUnit\Framework\TestCase;
    require_once(__DIR__.'/../Functions/ConnectionFunctionSet.php');
    require_once(__DIR__.'/../Functions/UpdateFunctionSet.php');

    class UpdateFunctionSetTest extends PHPUnit_Framework_TestCase
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
     
        public function testCreatePerson()
        {
            $ID = createPerson($this->_conn, "test", "password");
            $Q = $this->_conn->query("select * from Person where ID = ".$ID);
            $this->assertNotEmpty($Q);
        }

        public function testCreateStudent()
        {
            $ID = createStudent($this->_conn, "test", "password", "CS", 1);
            $Q = $this->_conn->query("select * from Person where ID = ".$ID);
            $this->assertNotEmpty($Q);
        }

        public function testCreateFaculty()
        {
            $ID = createFaculty($this->_conn, "test", "password", "CS");
            $Q = $this->_conn->query("select * from Person where ID = ".$ID);
            $this->assertNotEmpty($Q);
        }

        public function testCreateProject()
        {
            $ID = createFaculty($this->_conn, "test", "password", "CS");
            $Q = $this->_conn->query("select * from Person where ID = ".$ID);
            $this->assertNotEmpty($Q);
        }
    }
?>