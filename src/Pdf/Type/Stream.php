<?php

namespace Pdf\Type;

class Stream extends \Pdf\Type\Object {
  /* Dictionary */
  private $attributes;
  /* string */
  private $contents;

  function __construct($id, $generation) {
    parent::__construct($id, $generation);
    $this->attributes = new Dictionary();
  }

  function toString() {
    return parent::toString(function() {
      $this->attributes->setValue("Length", strlen($this->contents)); 
      $output = $this->attributes->toString();
      $output .= sprintf("stream\n%s\nendstream\n", $this->contents);
      return $output;
    });
  }

  function addToArray(&$pdfArray) {
    $pdfArray[] = $this;
  }

  function setContents($contents) {
    $this->contents = $contents;
  }
}
