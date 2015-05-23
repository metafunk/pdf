<?php

namespace Pdf\Structure;

class Catalog extends \Pdf\Type\Object {
  /* Dictionary */
  private $attributes;
  /* IndirectReference */
  private $pages;
  /* IndirectReference */
  private $metadata;

  function __construct($id, $generation) {
    $this->attributes = new \Pdf\Type\Dictionary($id, $generation, array(
      "Type" => "Catalog"
    ));
  }

  function toString() {
    $this->attributes->setValue("Pages", $this->pages);
    $this->attributes->setValue("Metadata", $this->metadata);
    return $this->attributes->toString();
  }

  function addToArray(&$pdfArray) {
    $pdfArray[] = $this;

    if($this->pages) {
      $this->pages->addToArray($pdfArray);
    }
    if($this->metadata) {
      $this->metadata->addToArray($pdfArray);
    }
  }

  function setPages($pages) {
    $this->pages = $pages;
  }

  function setMetadata($metadata) {
    $this->metadata = $metadata;
  }

  function getIndirectReference() {
    return $this->attributes->getIndirectReference();
  }
}
