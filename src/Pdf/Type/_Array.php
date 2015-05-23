<?php

namespace Pdf\Type;

class _Array extends \Pdf\Type\Object {
  /* array */
  private $values;

  function toString() {
    $values = $this->values;
    return parent::toString(function() use($values) {
      return sprintf("[%s]\n", implode(" ", $values));
    });
  }

  function setValues($values) {
    $this->values = $values;
  }
}
