<?php

namespace Pdf\Type;

class Dictionary extends \Pdf\Type\Object
{
  /* array */
  private $values;

  function __construct($id, $generation, $values) {
    parent::__construct($id, $generation);
    $this->values = array();
    foreach($values as $key => $value) {
      $this->values[$key] = $value;
    }
  }

  function toString() {
    $values = $this->values;
    return parent::toString(function() use ($values) {
      $output = "<<\n";
      foreach($values as $key => $value) {
        if(!$value) {
          continue;
        }
        if(is_a($value, 'Pdf\Type\Object')) {
          $output .= sprintf("/%s %s\n", $key, $value->getIndirectReference()->toString());
        } elseif(is_array($value)) {
          $output .= sprintf("/%s [%s]\n", $key, implode(" ", array_map(function($item) {
            if(is_a($item, 'Pdf\Type\Object')) {
              return $item->getIndirectReference()->toString();
            }
            return $item;
          }, $value)));
        } else {
          $output .= sprintf("/%s /%s\n", $key, $value);
        }
      }
      $output .= ">>\n";
      return $output;
    });
  }

  function setValue($key, $value) {
    $this->values[$key] = $value;
  }
}
