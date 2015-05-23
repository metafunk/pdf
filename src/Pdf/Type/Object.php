<?php

namespace Pdf\Type;

class Object {
  /* IndirectReference */
  protected $indirectReference;

  function __construct($id, $generation) {
    $this->indirectReference = new \Pdf\IndirectReference($id, $generation);
  }

  function toString($callback = null) {
    $output = sprintf("%d %d obj\n", $this->indirectReference->getId(), $this->indirectReference->getGeneration());
    if($callback) {
      $output .= $callback();
    }
    $output .= "endobj\n";
    return $output;
  }

  function getIndirectReference() {
    return $this->indirectReference;
  }
}
