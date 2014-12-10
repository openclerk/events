<?php

namespace Openclerk;

class Event {
  var $data;

  function __construct($data = array()) {
    $this->data = $data;
  }

  function get($key) {
    return $this->data[$key];
  }

  function has($key) {
    return isset($this->data[$key]);
  }

}
