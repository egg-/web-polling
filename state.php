<?php
/**
 * check specific cache files. response when it is updated.
 */

require_once 'lib/func.php';
require_once 'lib/cache.php';

$db_path = dirname($_SERVER['SCRIPT_FILENAME']).'/var/';
$db_filename = 'db.json';

$cache = new Cache($db_path);

// create if not exist file.
$cache->path($db_filename) or $cache->save($db_filename, "{}", false);	// no serialize

// store max life time, request time
$max_waittime = 30;
$request_time = time();

set_time_limit($max_waittime + 5);

// waiting for data file is updated.
while ((time() - $request_time) < $max_waittime) {
	clearstatcache();
	if ($cache->mtime($db_filename) > $request_time) {
		break;
	}

	usleep(500000);	// 0.5 sec
}

hz_out($cache->load($db_filename, 0, false), 'json');