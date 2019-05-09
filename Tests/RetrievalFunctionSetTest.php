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
            $FID = createFaculty($this->_conn, "test", "password", "CS");
            for($i = 0; $i < 10; $i++){
                $PID = createProject($this->_conn, "test".$i, $FID, $startDate, $endDate);
                assignUserToProject($this->_conn, $FID, $PID);
            }
            $projects = getUserProjects($this->_conn, $FID)->fetch_all();
            $this->assertTrue(count($projects) >= 10);
        }

        public function testGetUserExperiments_atleastGreaterThanOrEqualTo()
        {
            $startDate = date("Y-m-d");
            $endDate = date("Y-m-d");
            $FID = createFaculty($this->_conn, "test", "password", "CS");
            for($i = 0; $i < 10; $i++){
                $PID = createProject($this->_conn, "test".$i, $FID, $startDate, $endDate);
                assignUserToProject($this->_conn, $FID, $PID);
                for($j = 0; $j < 10; $j++){
                    CreateExperiment($this->_conn, $PID, 0, 0);
                }
            }
            $experiments = getUserExperiments($this->_conn, $FID)->fetch_all();
            $this->assertTrue(count($experiments) >= 10);
        }
    }
?>