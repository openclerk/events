<?php

namespace Openclerk\Test;

use Openclerk\Events;

class EventTest extends \PHPUnit_Framework_TestCase {

  /**
   * We can trigger an event that has no handlers.
   */
  function testNoEvents() {
    Events::trigger('test_no_events', array());
  }

  var $last_simple_data = array();
  function onTestSimple($data) {
    $this->last_simple_data[] = $data;
  }

  /**
   * We can bind an event.
   */
  function testSimpleEvents() {
    $bind = Events::on('test_simple', array($this, 'onTestSimple'));
    try {
      Events::trigger('test_simple', "hello, world");
      $this->assertEquals(array("hello, world"), $this->last_simple_data);

      Events::trigger('test_simple', "again");
      $this->assertEquals(array("hello, world", "again"), $this->last_simple_data);

    } finally {
      Events::unbind($bind);
    }
  }

  /**
   * We can bind the same event to the same handler multiple times.
   */
  function testMultipleSimpleEvents() {
    $bind = Events::on('test_simple', array($this, 'onTestSimple'));
    $bind2 = Events::on('test_simple', array($this, 'onTestSimple'));
    try {
      Events::trigger('test_simple', "1");
      $this->assertEquals(array(1, 1), $this->last_simple_data);
    } finally {
      Events::unbind($bind);
      Events::unbind($bind2);
    }
  }

  /**
   * We can bind and then unbind.
   */
  function testBindThenUnbind() {
    $bind = Events::on('test_simple', array($this, 'onTestSimple'));
    try {
      Events::trigger('test_simple', "cat");
      $this->assertEquals(array("cat"), $this->last_simple_data);
    } finally {
      Events::unbind($bind);
    }

    Events::trigger('test_simple', "dog");
    $this->assertEquals(array("cat"), $this->last_simple_data);   // hasn't changed
  }

}
