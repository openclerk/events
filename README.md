openclerk/events [![Build Status](https://travis-ci.org/openclerk/events.svg?branch=master)](https://travis-ci.org/openclerk/events)
================

A library for registering event handlers and triggering events, live on [CryptFolio](https://cryptfolio.com/api).

## Installing

Include `openclerk/events` as a requirement in your project `composer.json`,
and run `composer update` to install it into your project:

```json
{
  "require": {
    "openclerk/events": "dev-master"
  }
}
```

## Using

Add a handler for an event type:

```php
Events::on('my_event', function($data) {
  echo "one = " . $data['one'];
});
```

Trigger an event with custom event data:

```php
Events::trigger('my_event', array('one' => 'two'));
```

Unbind handlers as necessary:

```php
$handle = Events::on('my_event', array($object, 'callback'));
// ...
Events::unbind($handle);
```
