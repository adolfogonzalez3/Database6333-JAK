<?php
    use PHPUnit\Framework\TestCase;
    require_once(__DIR__.'/../Functions/ConnectionFunctionSet.php');
    require_once(__DIR__.'/../Functions/ValidationFunctionSet.php');
    require_once(__DIR__.'/../Functions/UpdateFunctionSet.php');
    require_once(__DIR__.'/../Functions/RetrievalFunctionSet.php');

    class ConnectionFunctionSetTest extends PHPUnit_Framework_TestCase
    {
     
        public function setUp()
        {
        }
     
        public function tearDown()
        {
        }

        public function testCreateMysqliConnectionNoConnection()
        {
            $host = "localhost";
            $user = "a";
            $password = "a";
            $database = "a";
            $conn = createMysqliConnection($host, $user, $password, $database);
            $this->assertFalse($conn);
        }
    }
?>