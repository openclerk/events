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
   */
  static function on($event_name, $callback) {
    if (!isset(static::$listeners[$event_name])) {
      static::$listeners[$event_name] = array();
    }
    static::$listeners[$event_name][] = $callback;
  }

}
