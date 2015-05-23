<?php

namespace Pdf;

class IndirectReference {
  private $id;
  private $generation;

  function __construct($id, $generation) {
    $this->id = $id;
    $this->generation = $generation;
  }

  function toString() {
    return sprintf("%s %s R", $this->id, $this->generation);
  }

  function getId() {
    return $this->id;
  }

  function getGeneration() {
    return $this->generation;
  }
}
