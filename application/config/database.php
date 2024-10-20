<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the "Database Connection"
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
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the "default" group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

// The following values will probably need to be changed.
//$db['gestcobra']['username'] = "gestconec";
//$db['gestcobra']['password'] = "853/h/CnV4";

$active_group = "gestcobra";
$active_record = TRUE;


$db['gestcobra']['username'] = "root";
$db['gestcobra']['password'] = "";
$db['gestcobra']['database'] = "mupi01";
// The following values can probably stay the same.
$db['gestcobra']['hostname'] = "localhost";
$db['gestcobra']['dbdriver'] = "mysql";
$db['gestcobra']['dbprefix'] = "";
$db['gestcobra']['pconnect'] = TRUE;
$db['gestcobra']['db_debug'] = TRUE;
$db['gestcobra']['cache_on'] = FALSE;
$db['gestcobra']['cachedir'] = "";
$db['gestcobra']['char_set'] = "utf8";
$db['gestcobra']['dbcollat'] = "utf8_general_ci";

//LEGAL
//$db['gestcobral']['username'] = "coacmagi_legal";
$db['gestcobral']['username'] = "root";
$db['gestcobral']['password'] = "";
$db['gestcobral']['database'] = "demolega_base";
//$db['gestcobral']['database'] = "coacmagi_usuario";

// The following values can probably stay the same.
$db['gestcobral']['hostname'] = "localhost";
$db['gestcobral']['dbdriver'] = "mysql";
$db['gestcobral']['dbprefix'] = "";
$db['gestcobral']['pconnect'] = FALSE;
$db['gestcobral']['db_debug'] = TRUE;
$db['gestcobral']['cache_on'] = FALSE;
$db['gestcobral']['cachedir'] = "";
$db['gestcobral']['char_set'] = "utf8";
$db['gestcobral']['dbcollat'] = "utf8_general_ci";



/* End of file database.php */
/* Location: ./application/config/database.php */
