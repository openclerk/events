<?php

namespace Openclerk;

/**
 * JQuery-like event passing for PHP.
 *
 * Events::on('reload', function($event) { print_r($event); });
 * Events::trigger('reload', array('args'));
 */
class Events {
  static $listeners = array();

  /**
   * Trigger an event.
   */
  static function trigger($event_name, $event = null) {
    if (isset(static::$listeners[$event_name])) {
      foreach (static::$listeners[$event_name] as $listener) {
        $return = call_user_func($listener, $event);
        if ($return === false) {
          return false;
        }
      }
    }
    return true;
  }

  /**
   * Register an event handler.
   * @return data that can be used to unbind the event handler in {@link #unbind()}.
   */
  static function on($event_name, $callback) {
    if (!isset(static::$listeners[$event_name])) {
      static::$listeners[$event_name] = array();
    }
    static::$listeners[$event_name][] = $callback;

    return array('event_name' => $event_name, 'index' => count(static::$listeners[$event_name]));
  }

  /**
   * Removes an event handler.
   * @param $handler event handler information returned in {@link #on()}.
   */
  static function unbind($handler) {
    unset(static::$listeners[$handler['event_name']][$handler['index']]);
  }

}
