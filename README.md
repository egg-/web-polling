# web-polling

this is polling test page.

## API

- state.php : response current data.
- update.php : update new data.

## Postman

- http://www.getpostman.com/collections/12eaa00211f271f5fac9

## $polling

```js
// change the default settings.
$polling.setting({
	longpolling: false,
	timeout: 30000,
	interval: 3000
});

// start polling
$polling.start('user defined unique id', {
	url: 'server api url for long polling',
	// ...
});

// stop polling
$polling.stop('user defined unique id');
```