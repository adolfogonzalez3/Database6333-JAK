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

        public function testIsPerson_true()
        {
            $ID = createStudent($this->_conn, "test", "password", "CS", 1);
            $this->assertTrue(isPerson($this->_conn, $ID));
        }

        public function testIsPerson_false()
        {
            $ID = -1;
            $this->assertFalse(isPerson($this->_conn, $ID));
        }

        public function testIsStudent_true()
        {
            $ID = createStudent($this->_conn, "test", "password", "CS", 1);
            $this->assertTrue(isStudent($this->_conn, $ID));
        }

        public function testIsStudent_false_faculty()
        {
            $ID = createFaculty($this->_conn, "test", "password", "CS");
            $this->assertFalse(isStudent($this->_conn, $ID));
        }

        public function testIsFaculty_true()
        {
            $ID = createFaculty($this->_conn, "test", "password", "CS");
            $this->assertTrue(isFaculty($this->_conn, $ID));
        }

        public function testIsFaculty_false_student()
        {
            $ID = createStudent($this->_conn, "test", "password", "CS", 1);
            $this->assertFalse(isFaculty($this->_conn, $ID));
        }

        public function testIsEquipmentAssignedToUser()
        {
            $FID = createFaculty($this->_conn, "test", "password", "CS");
            $EID = createEquipment($this->_conn, "test", 0, "place");
            assignEquipmentToFaculty($this->_conn, $EID, $FID);
            $this->assertTrue(isEquipmentAssignedToUser($this->_conn, $EID, $FID));
        }
    }
?>