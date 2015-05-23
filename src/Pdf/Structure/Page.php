<?php

namespace Pdf\Structure;

class Page extends \Pdf\Type\Object {
  /* Dictionary */
  private $attributes;
  /* IndirectReference */
  private $parent;
  /* _Array of Integer */
  private $mediabox;
  /* IndirectReference */
  private $contents;

  function __construct($id, $generation) {
    $this->attributes = new \Pdf\Type\Dictionary($id, $generation, array(
      "Type" => "Page"
    ));
  }

  function toString() {
    $this->attributes->setValue("Parent", $this->parent);
    $this->attributes->setValue("MediaBox", $this->mediabox);
    $this->attributes->setValue("Contents", $this->contents);
    return $this->attributes->toString();
  }

  function addToArray(&$pdfArray) {
    $pdfArray[] = $this;

    if($this->contents) {
      $this->contents->addToArray($pdfArray);
    }
  }

  function setParent($parent) {
    $this->parent = $parent;
  }

  function setMediabox($mediabox) {
    $this->mediabox = $mediabox;
  }

  function setContents($contents) {
    $this->contents = $contents;
  }

  function getIndirectReference() {
    return $this->attributes->getIndirectReference();
  }
}
