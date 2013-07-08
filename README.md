web-longpolling
================================

this is long polling test page.

##API

- state.php : response current data.
- update.php : update new data.

##Postman

- http://www.getpostman.com/collections/12eaa00211f271f5fac9

##$longpolling

$longpolling.start('user defined unique id', {
	url: 'server api url for long polling',
	// ...
});
$longpolling.stop('user defined unique id');