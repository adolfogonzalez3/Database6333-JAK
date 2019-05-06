<?php
    use PHPUnit\Framework\TestCase;
    require_once(__DIR__.'/../Functions/ConnectionFunctionSet.php');
    require_once(__DIR__.'/../Functions/ValidationFunctionSet.php');
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
            $this->assertTrue(isPerson($this->_conn, $ID));
        }

        public function testCreateStudent()
        {
            $ID = createStudent($this->_conn, "test", "password", "CS", 1);
            $this->assertTrue(isStudent($this->_conn, $ID));
        }

        public function testCreateFaculty()
        {
            $ID = createFaculty($this->_conn, "test", "password", "CS");
            $this->assertTrue(isFaculty($this->_conn, $ID));
        }

        public function testCreateProject()
        {
            $ID = createFaculty($this->_conn, "test", "password", "CS");
            $ID = createProject($this->_conn, "test", $ID);
            $this->assertTrue(projectExists($this->_conn, $ID));
        }

        public function testCreateExperiment()
        {
            $ID = createFaculty($this->_conn, "test", "password", "CS");
            $PID = createProject($this->_conn, "test", $ID);
            $ExperimentNo = CreateExperiment($this->_conn, $PID, 0, 0);
            $this->assertTrue(experimentExists($this->_conn, $PID, $ExperimentNo));
        }

        public function testCreateEnvironment()
        {
            $ID = createEnvironment($this->_conn, "test", 0, 10, "some/path/");
            $this->assertTrue(environmentExists($this->_conn, $ID));
        }

        public function testCreateEquipment()
        {
            $ID = createEquipment($this->_conn, "test", 0, "place");
            $this->assertTrue(equipmentExists($this->_conn, $ID));
        }

        public function testCreateAgent()
        {
            $ID = createAgent($this->_conn, "test", "test", "some/path");
            $this->assertTrue(agentExists($this->_conn, $ID));
        }

        public function testCreateModel()
        {
            $ID = createModel($this->_conn, "test", 0, "some/path");
            $this->assertTrue(modelExists($this->_conn, $ID));
        }
    }
?>