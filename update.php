<?php
/**
 * update db file.
 */

require_once 'lib/func.php';
require_once 'lib/cache.php';

$db_path = dirname($_SERVER['SCRIPT_FILENAME']).'/var/';
$db_filename = 'db.json';

$cache = new Cache($db_path);

$rawdata = file_get_contents("php://input");

// update db file
$rawdata and $cache->save($db_filename, $rawdata, false);

hz_out(json_encode(array(
	'mtime'=>$cache->mtime($db_filename),
	'data'=>$cache->load($db_filename, 0, false),
)), 'json');