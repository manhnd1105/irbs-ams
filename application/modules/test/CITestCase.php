<?php
////require_once __DIR__ . 'MyDbTestCase.php';
//abstract class MyDbTestCase extends PHPUnit_Framework_TestCase
//{
//    /**
//     * @var PHPUnit_Extensions_Database_ITester
//     */
//    protected $databaseTester;
//
//    /**
//     * Closes the specified connection.
//     *
//     * @param PHPUnit_Extensions_Database_DB_IDatabaseConnection $connection
//     */
//    protected function closeConnection(PHPUnit_Extensions_Database_DB_IDatabaseConnection $connection)
//    {
//        $this->getDatabaseTester()->closeConnection($connection);
//    }
//
//    /**
//     * Returns the test database connection.
//     *
//     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
//     */
//    protected abstract function getConnection();
//
//    /**
//     * Gets the IDatabaseTester for this testCase. If the IDatabaseTester is
//     * not set yet, this method calls newDatabaseTester() to obtain a new
//     * instance.
//     *
//     * @return PHPUnit_Extensions_Database_ITester
//     */
//    protected function getDatabaseTester()
//    {
//        if (empty($this->databaseTester)) {
//            $this->databaseTester = $this->newDatabaseTester();
//        }
//
//        return $this->databaseTester;
//    }
//
//    /**
//     * Returns the test dataset.
//     *
//     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
//     */
//    protected abstract function getDataSet();
//
//    /**
//     * Returns the database operation executed in test setup.
//     *
//     * @return PHPUnit_Extensions_Database_Operation_DatabaseOperation
//     */
//    protected function getSetUpOperation()
//    {
//        return PHPUnit_Extensions_Database_Operation_Factory::CLEAN_INSERT();
//    }
//
//    /**
//     * Returns the database operation executed in test cleanup.
//     *
//     * @return PHPUnit_Extensions_Database_Operation_DatabaseOperation
//     */
//    protected function getTearDownOperation()
//    {
//        return PHPUnit_Extensions_Database_Operation_Factory::NONE();
//    }
//
//    /**
//     * Creates a IDatabaseTester for this testCase.
//     *
//     * @return PHPUnit_Extensions_Database_ITester
//     */
//    protected function newDatabaseTester()
//    {
//        return new PHPUnit_Extensions_Database_DefaultTester($this->getConnection());
//    }
//
//    /**
//     * Creates a new DefaultDatabaseConnection using the given PDO connection
//     * and database schema name.
//     *
//     * @param PDO $connection
//     * @param string $schema
//     * @return PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection
//     */
//    protected function createDefaultDBConnection(PDO $connection, $schema = '')
//    {
//        return new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection($connection, $schema);
//    }
//
//    /**
//     * Creates a new FlatXmlDataSet with the given $xmlFile. (absolute path.)
//     *
//     * @param string $xmlFile
//     * @return PHPUnit_Extensions_Database_DataSet_FlatXmlDataSet
//     */
//    protected function createFlatXMLDataSet($xmlFile)
//    {
//        return new PHPUnit_Extensions_Database_DataSet_FlatXmlDataSet($xmlFile);
//    }
//
//    /**
//     * Creates a new XMLDataSet with the given $xmlFile. (absolute path.)
//     *
//     * @param string $xmlFile
//     * @return PHPUnit_Extensions_Database_DataSet_XmlDataSet
//     */
//    protected function createXMLDataSet($xmlFile)
//    {
//        return new PHPUnit_Extensions_Database_DataSet_XmlDataSet($xmlFile);
//    }
//
//    /**
//     * Create a a new MysqlXmlDataSet with the given $xmlFile. (absolute path.)
//     *
//     * @param string $xmlFile
//     * @return PHPUnit_Extensions_Database_DataSet_MysqlXmlDataSet
//     * @since  Method available since Release 1.0.0
//     */
//    protected function createMySQLXMLDataSet($xmlFile)
//    {
//        return new PHPUnit_Extensions_Database_DataSet_MysqlXmlDataSet($xmlFile);
//    }
//
//    /**
//     * Returns an operation factory instance that can be used to instantiate
//     * new operations.
//     *
//     * @return PHPUnit_Extensions_Database_Operation_Factory
//     */
//    protected function getOperations()
//    {
//        return new PHPUnit_Extensions_Database_Operation_Factory();
//    }
//
//    /**
//     * Performs operation returned by getSetUpOperation().
//     */
//    protected function setUp()
//    {
//        parent::setUp();
//
//        $this->databaseTester = NULL;
//
//        $this->getDatabaseTester()->setSetUpOperation($this->getSetUpOperation());
//        $this->getDatabaseTester()->setDataSet($this->getDataSet());
//        $this->getDatabaseTester()->onSetUp();
//    }
//
//    /**
//     * Performs operation returned by getSetUpOperation().
//     */
//    protected function tearDown()
//    {
//        $this->getDatabaseTester()->setTearDownOperation($this->getTearDownOperation());
//        $this->getDatabaseTester()->setDataSet($this->getDataSet());
//        $this->getDatabaseTester()->onTearDown();
//
//        /**
//         * Destroy the tester after the test is run to keep DB connections
//         * from piling up.
//         */
//        $this->databaseTester = NULL;
//    }
//
//    /**
//     * Asserts that two given tables are equal.
//     *
//     * @param PHPUnit_Extensions_Database_DataSet_ITable $expected
//     * @param PHPUnit_Extensions_Database_DataSet_ITable $actual
//     * @param string $message
//     */
//    public static function assertTablesEqual(PHPUnit_Extensions_Database_DataSet_ITable $expected, PHPUnit_Extensions_Database_DataSet_ITable $actual, $message = '')
//    {
//        $constraint = new PHPUnit_Extensions_Database_Constraint_TableIsEqual($expected);
//
//        self::assertThat($actual, $constraint, $message);
//    }
//
//    /**
//     * Asserts that two given datasets are equal.
//     *
//     * @param PHPUnit_Extensions_Database_DataSet_ITable $expected
//     * @param PHPUnit_Extensions_Database_DataSet_ITable $actual
//     * @param string $message
//     */
//    public static function assertDataSetsEqual(PHPUnit_Extensions_Database_DataSet_IDataSet $expected, PHPUnit_Extensions_Database_DataSet_IDataSet $actual, $message = '')
//    {
//        $constraint = new PHPUnit_Extensions_Database_Constraint_DataSetIsEqual($expected);
//
//        self::assertThat($actual, $constraint, $message);
//    }
//
//    /**
//     * Assert that a given table has a given amount of rows
//     *
//     * @param string $tableName Name of the table
//     * @param int $expected Expected amount of rows in the table
//     * @param string $message Optional message
//     */
//    public function assertTableRowCount($tableName, $expected, $message = '')
//    {
//        $constraint = new PHPUnit_Extensions_Database_Constraint_TableRowCount($tableName, $expected);
//        $actual = $this->getConnection()->getRowCount($tableName);
//
//        self::assertThat($actual, $constraint, $message);
//    }
//
//    /**
//     * Asserts that a given table contains a given row
//     *
//     * @param array $expectedRow Row expected to find
//     * @param PHPUnit_Extensions_Database_DataSet_ITable $table Table to look into
//     * @param string $message Optional message
//     */
//    public function assertTableContains(array $expectedRow, PHPUnit_Extensions_Database_DataSet_ITable $table, $message = '')
//    {
//        self::assertThat($table->assertContainsRow($expectedRow), self::isTrue(), $message);
//    }
//}
//
//
//
//
///**
// * Base class for unit and integration tests for CodeIgniter
// *
// * This class wraps $CI reference for communicating with CodeIgniter,
// * as well as initializing database connection for assertions
// *
// * @author		Fernando Piancastelli
// * @link		https://github.com/fmalk/codeigniter-phpunit
// * @link		http://www.phpunit.de/manual/3.7/en/database.html
// *
// * @property-read resource	$db		Reference to database
// */
////abstract class CITestCase extends MyDbTestCase
////{
////	/**
////	 * Reference to CodeIgniter
////	 *
////	 * @var resource
////	 */
////	protected $CI;
////
////	/**
////	 * Only instantiate pdo once for test clean-up/fixture load
////	 *
////	 * @internal
////	 * @var resource
////	 */
////    static private $pdo = null;
////
////	/**
////	 * Only instantiate PHPUnit_Extensions_Database_DB_IDatabaseConnection once per test
////	 *
////	 * @internal
////	 * @var resource
////	 */
////    private $conn = null;
////
////	/**
////	 * Call parent constructor and initialize reference to CodeIgniter
////	 *
////	 * @internal
////	 */
////	public function __construct($name = NULL, array $data = array(), $dataName = '')
////    {
////        parent::__construct($name, $data, $dataName);
////		$this-> CI =& get_instance();
////    }
////
////    /**
////	 * Initialize database connection (same one used by CodeIgniter)
////	 *
////     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
////     */
////    final public function getConnection()
////    {
////        if ($this->conn === null) {
////            if (self::$pdo == null) {
////            	$dsn = $this->CI->db->dbdriver.':dbname='.$this->CI->db->database.';host='.$this->CI->db->hostname;
////                self::$pdo = new PDO($dsn,$this->CI->db->username, $this->CI->db->password);
////            }
////            $this->conn = $this->createDefaultDBConnection(self::$pdo, $this->CI->db->database);
////        }
////
////        return $this->conn;
////    }
////
////	/**
////	 * @internal
////	 */
////	public function __get($name)
////	{
////		if ($name == 'db')
////		{
////			return $this->getConnection();
////		}
////	}
////
////    /**
////	 * Returns the DataSet
////	 *
////	 * Important: the returned DataSet is the current database state, meaning
////	 * this function does NOT behave as a fixture: the intended usage of this
////	 * current state connection is to do integration testing.
////	 * If you want to use fixtures, check PHPUnit's database manual.
////	 *
////	 * @link		https://github.com/fmalk/codeigniter-phpunit	 *
////     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
////     */
////    public function getDataSet()
////    {
////         return $this->getConnection()->createDataSet();
////    }
////}