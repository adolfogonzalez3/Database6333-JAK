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
            $this->assertTrue(checkExist($this->_conn, "Person", $ID));
        }

        public function testCreateStudent()
        {
            $ID = createStudent($this->_conn, "test", "password", "CS", 1);
            $this->assertTrue(checkExist($this->_conn, "Student", $ID));
        }

        public function testCreateFaculty()
        {
            $ID = createFaculty($this->_conn, "test", "password", "CS");
            $this->assertTrue(checkExist($this->_conn, "Faculty", $ID));
        }

        public function testCreateProject()
        {
            $ID = createFaculty($this->_conn, "test", "password", "CS");
            $ID = createProject($this->_conn, "test", $ID);
            $$this->assertTrue(checkExist($this->_conn, "Project", $ID));
        }

        public function testCreateExperiment()
        {
            $ID = createFaculty($this->_conn, "test", "password", "CS");
            $ID = createProject($this->_conn, "test", $ID);
            $ID = CreateExperiment($this->_conn, $ID, 0, 0);
            $this->assertTrue(checkExist($this->_conn, "Experiment", $ID));
        }

        public function testCreateEnvironment()
        {
            $ID = createEnvironment($this->_conn, "test", 0, 10, "some/path/");
            $this->assertTrue(checkExist($this->_conn, "Environment", $ID));
        }

        public function testCreateEquipment()
        {
            $ID = createEquipment($this->_conn, "test", 0, "place");
            $this->assertTrue(checkExist($this->_conn, "Equipment", $ID));
        }

        public function testCreateAgent()
        {
            $ID = createAgent($this->_conn, "test", "test", "some/path");
            $this->assertTrue(checkExist($this->_conn, "Agent", $ID));
        }

        public function testCreateModel()
        {
            $ID = createModel($this->_conn, "test", 0, "some/path");
            $this->assertTrue(checkExist($this->_conn, "Model", $ID));
        }
    }
?>