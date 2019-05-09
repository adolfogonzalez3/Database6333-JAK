<?php
    use PHPUnit\Framework\TestCase;
    require_once(__DIR__.'/../Functions/ConnectionFunctionSet.php');
    require_once(__DIR__.'/../Functions/ValidationFunctionSet.php');
    require_once(__DIR__.'/../Functions/UpdateFunctionSet.php');
    require_once(__DIR__.'/../Functions/RetrievalFunctionSet.php');

    class RetrievalFunctionSetTest extends PHPUnit_Framework_TestCase
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
            $result = getUserByName($this->_conn, "test");
            $this->assertTrue(isStudent($this->_conn, $result[0]));
        }

        public function testGetAllEquipmentOwnedByUser()
        {
            $equipment = array();
            for($i = 0; $i < 10; $i++){
                $ID = createEquipment($this->_conn, "test".$i, 0, "place");
                array_push($equipment, $ID);
            }
            $FID = createFaculty($this->_conn, "test", "password", "CS");
            foreach($equipment as $EID) {
                assignEquipmentToFaculty($this->_conn, $EID, $FID);
            }
            $results = getAllEquipmentOwnedByUser($this->_conn, $FID);
            $this->assertTrue($results->num_rows == 10);
        }

        public function testGetAllUsers_atleastGreaterThanOrEqualTo()
        {
            for($i = 0; $i < 10; $i++){
                createStudent($this->_conn, "test".$i, "password", "CS", 1);
            }
            $users = getAllUsers($this->_conn);
            $this->assertTrue(count($users) >= 10);
        }

        public function testGetUserProjects_atleastGreaterThanOrEqualTo()
        {
            $startDate = date("Y-m-d");
            $endDate = date("Y-m-d");
            $ID = createFaculty($this->_conn, "test", "password", "CS");
            for($i = 0; $i < 10; $i++){
                $ID = createProject($this->_conn, "test".$i, $ID, $startDate, $endDate);
            }
            $projects = getAllUsers($this->_conn);
            $this->assertTrue(count($projects) >= 10);
        }
    }
?>