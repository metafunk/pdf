<?php

namespace Pdf\Structure;

class Pages extends \Pdf\Type\Object {
  /* Dictionary */
  private $attributes;
  /* IndirectReference */
  private $parent;
  /* array of IndirectReferences */
  private $kids;
  /* integer */
  private $count;

  function __construct($id, $generation) {
    $this->attributes = new \Pdf\Type\Dictionary($id, $generation, array(
      "Type" => "Pages"
    ));
  }

  function toString() {
    $this->attributes->setValue("Parent", $this->parent);
    $this->attributes->setValue("Kids", $this->kids);
    $this->attributes->setValue("Count", count($this->kids));
    return $this->attributes->toString();
  }

  function addToArray(&$pdfArray) {
    $pdfArray[] = $this;

    if($this->kids) {
      foreach($this->kids as $kid) {
        $kid->addToArray($pdfArray);
      }
    }
  }

  function setParent($parent) {
    $this->parent = $parent;
  }

  function setKids($kids) {
    $this->kids = $kids;
  }

  function getIndirectReference() {
    return $this->attributes->getIndirectReference();
  }
}
