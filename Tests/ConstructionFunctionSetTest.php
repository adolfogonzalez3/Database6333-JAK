<?php
    use PHPUnit\Framework\TestCase;
    require_once(__DIR__.'/../Functions/ConnectionFunctionSet.php');
    require_once(__DIR__.'/../Functions/ValidationFunctionSet.php');
    require_once(__DIR__.'/../Functions/UpdateFunctionSet.php');
    require_once(__DIR__.'/../Functions/RetrievalFunctionSet.php');
    require_once(__DIR__.'/../Functions/ConstructionFunctionSet.php');

    class ConstructionFunctionSetTest extends PHPUnit_Framework_TestCase
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

        public function testBuildTableFromSet()
        {
            $rows = getUserProjects($this->_conn, 0);
            $html = buildTableFromSet($rows);
            $tidy = tidy_parse_string($html);
            $this->assertTrue(tidy_error_count($tidy) == 0);
        }
    }
?>