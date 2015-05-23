<?php

require("Type/Object.php");

require("Type/_Array.php");
require("Type/Boolean.php");
require("Type/Dictionary.php");
require("Type/Integer.php");
require("Type/Name.php");
require("Type/Null.php");
require("Type/Real.php");
require("Type/Stream.php");
require("Type/String.php");
require("IndirectReference.php");
require("Structure/Catalog.php");
require("Structure/Page.php");
require("Structure/Pages.php");

$catalog = new Pdf\Structure\Catalog(1, 0);

$pages = new Pdf\Structure\Pages(2, 0);
$pages->setParent($catalog);

$page = new Pdf\Structure\Page(3, 0);
$page->setParent($pages);
$page->setMediabox(array(0, 0, 612, 792));

$stream = new Pdf\Type\Stream(4, 0);
$stream->setContents('TEXT');

$page->setContents($stream);

$pages->setKids(array($page));

$catalog->setPages($pages);

$pdfArray = array();

$catalog->addToArray($pdfArray);

$output = "%PDF-1.5\n";
foreach($pdfArray as $pdfElement) {
  $output .= $pdfElement->toString();
}
print($output);
