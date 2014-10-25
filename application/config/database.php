<?php  if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/
if (!defined('PHPUNIT_TEST')) {
    $active_group = 'vps';
    $active_record = true;

    $db['vps']['hostname'] = 'mysql:host=123.30.238.216';
    $db['vps']['username'] = 'irbs';
    $db['vps']['password'] = '123456';
    $db['vps']['database'] = 'irbs';
    $db['vps']['dbdriver'] = 'pdo';
    $db['vps']['dbprefix'] = '';
    $db['vps']['pconnect'] = true;
    $db['vps']['db_debug'] = true;
    $db['vps']['cache_on'] = false;
    $db['vps']['cachedir'] = '';
    $db['vps']['char_set'] = 'utf8';
    $db['vps']['dbcollat'] = 'utf8_general_ci';
    $db['vps']['swap_pre'] = '';
    $db['vps']['autoinit'] = true;
    $db['vps']['stricton'] = false;

    $db['default']['hostname'] = 'mysql:host=localhost';
    $db['default']['username'] = 'irbs';
    $db['default']['password'] = '123456';
    $db['default']['database'] = 'irbs';
    $db['default']['dbdriver'] = 'pdo';
    $db['default']['dbprefix'] = '';
    $db['default']['pconnect'] = true;
    $db['default']['db_debug'] = true;
    $db['default']['cache_on'] = false;
    $db['default']['cachedir'] = '';
    $db['default']['char_set'] = 'utf8';
    $db['default']['dbcollat'] = 'utf8_general_ci';
    $db['default']['swap_pre'] = '';
    $db['default']['autoinit'] = true;
    $db['default']['stricton'] = false;

    $db['vm']['hostname'] = 'mysql:host=192.168.56.101';
    $db['vm']['username'] = 'irbs';
    $db['vm']['password'] = '123456';
    $db['vm']['database'] = 'irbs';
    $db['vm']['dbdriver'] = 'pdo';
    $db['vm']['dbprefix'] = '';
    $db['vm']['pconnect'] = true;
    $db['vm']['db_debug'] = true;
    $db['vm']['cache_on'] = false;
    $db['vm']['cachedir'] = '';
    $db['vm']['char_set'] = 'utf8';
    $db['vm']['dbcollat'] = 'utf8_general_ci';
    $db['vm']['swap_pre'] = '';
    $db['vm']['autoinit'] = true;
    $db['vm']['stricton'] = false;

} else {
    $active_group = 'test';
    $active_record = true;

    $db['test']['hostname'] = '127.0.0.1';
    $db['test']['username'] = 'root';
    $db['test']['password'] = '';
    $db['test']['database'] = 'irbs_testing';
    $db['test']['dbdriver'] = 'mysql';
    $db['test']['dbprefix'] = '';
    $db['test']['pconnect'] = true;
    $db['test']['db_debug'] = true;
    $db['test']['cache_on'] = false;
    $db['test']['cachedir'] = '';
    $db['test']['char_set'] = 'utf8';
    $db['test']['dbcollat'] = 'utf8_general_ci';
    $db['test']['swap_pre'] = '';
    $db['test']['autoinit'] = true;
    $db['test']['stricton'] = false;
}


/* End of file database.php */
/* Location: ./application/config/database.php */
