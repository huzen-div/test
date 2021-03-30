<?php namespace Config;

/**
 * Database Configuration
 *
 * @package Config
 */

class Database extends \CodeIgniter\Database\Config
{
	/**
	 * The directory that holds the Migrations
	 * and Seeds directories.
	 *
	 * @var string
	 */
	public $filesPath = APPPATH . 'Database/';

	/**
	 * Lets you choose which connection group to
	 * use if no other is specified.
	 *
	 * @var string
	 */
	public $defaultGroup = 'default';

	/**
	 * The default database connection.
	 *
	 * @var array
	 */


	public $default = [
		'DSN'      => '',
		'hostname' => 'dev.karpools.co',
		'username' => 'postgres',
		'password' => '6BZFfY*hnoefhqU2',
		'database' => 'master_test',
		'DBDriver' => 'Postgre',
		'DBPrefix' => '',
		'pConnect' => FALSE,
		'DBDebug'  => (ENVIRONMENT !== 'production'),
		'cacheOn'  => false,
		'cacheDir' => '',
		'charset'  => 'utf8',
		'DBCollat' => 'utf8_general_ci',
		'swapPre'  => '',
		'encrypt'  => FALSE,
		'compress' => FALSE,
		'strictOn' => FALSE,
		'failover' => [],
		'save_queries' => TRUE, 
		'port'     => 9999,
	];




	/**
	 * This database connection is used when
	 * running PHPUnit database tests.
	 *
	 * @var array
	 */



//$default['DSN'] = 'pgsql:host=128.199.214.47;port=9998;dbname=master_test;user=postgres;password=6BZFfY*hnoefhqU2';




public $tests = [
		'DSN'      => '128.199.214.47',
		'hostname' => '128.199.214.47',
		'username' => 'postgres',
		'password' => '6BZFfY*hnoefhqU2',
		'database' => 'master_test',
		'DBDriver' => 'Postgre',
		'DBPrefix' => '',
		'pConnect' => FALSE,
		'DBDebug'  => (ENVIRONMENT !== 'production'),
		'cacheOn'  => false,
		'cacheDir' => '',
		'charset'  => 'utf8',
		'DBCollat' => 'utf8_general_ci',
		'swapPre'  => '',
		'encrypt'  => FALSE,
		'compress' => FALSE,
		'strictOn' => FALSE,
		'failover' => [],
		'save_queries' => TRUE, 
		'port'     => 9998,
	];




/*
	public $tests = [
		'DSN'      => '',
		'hostname' => '127.0.0.1',
		'username' => '',
		'password' => '',
		'database' => ':memory:',
		'DBDriver' => 'SQLite3',
		'DBPrefix' => 'db_',
		'pConnect' => false,
		'DBDebug'  => (ENVIRONMENT !== 'production'),
		'cacheOn'  => false,
		'cacheDir' => '',
		'charset'  => 'utf8',
		'DBCollat' => 'utf8_general_ci',
		'swapPre'  => '',
		'encrypt'  => FALSE,
		'compress' => FALSE,
		'strictOn' => FALSE,
		'failover' => [],
		'save_queries' => TRUE, 
		'port'     => 3306,
	];

*/



	//--------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();

		// Ensure that we always set the database group to 'tests' if
		// we are currently running an automated test suite, so that
		// we don't overwrite live data on accident.
		if (ENVIRONMENT === 'testing')
		{
			$this->defaultGroup = 'tests';

			// Under Travis-CI, we can set an ENV var named 'DB_GROUP'
			// so that we can test against multiple databases.
			if ($group = getenv('DB'))
			{
				if (is_file(TESTPATH . 'travis/Database.php'))
				{
					require TESTPATH . 'travis/Database.php';

					if (! empty($dbconfig) && array_key_exists($group, $dbconfig))
					{
						$this->tests = $dbconfig[$group];
					}
				}
			}
		}
	}

	//--------------------------------------------------------------------

}
