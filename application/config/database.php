<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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
$active_group = 'default';
$active_record = TRUE;
//$db['default']['hostname'] = 'pktweet.db.11485861.hostedresource.com';
$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'pktweet';
//$db['default']['username'] = 'lp000260';
//$db['default']['username'] = 'pkaccount';
//$db['default']['password'] = 'mobiba66DO';
//$db['default']['password'] = 'mobiba66DO';
//$db['default']['password'] = 'HkR741593123#';
$db['default']['password'] = 'Pr4y2ct4';
//$db['default']['database'] = 'lp000260_propuestas';
$db['default']['database'] = 'pkmailing_pktweet';
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;


//account
//$db['default']['hostname'] = 'pktweet.db.11485861.hostedresource.com';
$db['account']['hostname'] = '23.229.215.154';
$db['account']['username'] = 'pkaccount';
//$db['default']['username'] = 'lp000260';
//$db['account']['username'] = 'pkaccount';
//$db['account']['username'] = 'root';
//$db['default']['password'] = 'mobiba66DO';
//$db['default']['password'] = 'mobiba66DO';
//$db['default']['password'] = 'HkR741593123#';
$db['account']['password'] = 'Pr4y2ct4';
//$db['account']['password'] = '';
//$db['default']['database'] = 'lp000260_propuestas';
$db['account']['database'] = 'pkaccount';
$db['account']['dbdriver'] = 'mysqli';
$db['account']['dbprefix'] = '';
$db['account']['pconnect'] = TRUE;
$db['account']['db_debug'] = TRUE;
$db['account']['cache_on'] = FALSE;
$db['account']['cachedir'] = '';
$db['account']['char_set'] = 'utf8';
$db['account']['dbcollat'] = 'utf8_general_ci';
$db['account']['swap_pre'] = '';
$db['account']['autoinit'] = TRUE;
$db['account']['stricton'] = FALSE;
//$active_group = 'pkaccount';
//$active_record = TRUE;
//$db['pkaccount']['hostname'] = 'localhost';
////$db['default']['username'] = 'lp000260';
////$db['default']['username'] = 'lp000260';
//$db['pkaccount']['username'] = 'root';
////$db['default']['password'] = 'mobiba66DO';
////$db['default']['password'] = 'mobiba66DO';
//$db['pkaccount']['password'] = '';
////$db['default']['database'] = 'lp000260_propuestas';
//$db['pkaccount']['database'] = 'lp000260_mailing';
//$db['pkaccount']['dbdriver'] = 'mysqli';
//$db['pkaccount']['dbprefix'] = '';
//$db['pkaccount']['pconnect'] = TRUE;
//$db['pkaccount']['db_debug'] = TRUE;
//$db['pkaccount']['cache_on'] = FALSE;
//$db['pkaccount']['cachedir'] = '';
//$db['pkaccount']['char_set'] = 'utf8';
//$db['pkaccount']['dbcollat'] = 'utf8_general_ci';
//$db['pkaccount']['swap_pre'] = '';
//$db['pkaccount']['autoinit'] = TRUE;
//$db['pkaccount']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */