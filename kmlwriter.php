<?php
//Jeffrey Marron
//for CBHC KML generation

require 'functions.php';

$conn = Connect();
$stmt = $conn->query('SELECT * FROM hh_kml_full_test3 WHERE 1');
$stmt->setFetchMode(PDO::FETCH_ASSOC);


$doc=new XMLWriter();

$doc->openURI('writer_test.kml');
$doc->setIndent(true);
$doc->startDocument('1.0','UTF-8');
$doc->startElement('kml');
$doc->writeAttribute('xmlns', "http://www.opengis.net/kml/2.2");

$doc->startElement('Document');

//insert styles here



//Generates each placemark
foreach ($stmt as $row) { 
    $doc->startElement('Placemark');

$doc->startElement('Description');
$doc->writeCData('<center><table><tr bgcolor="#E3E3F3">
<th>Count</th>
<td>'.($row['data']).'</td>
</tr><tr bgcolor="">
<th>Zip</th>
<td>'.($row['ZipCode']).'</td>
</tr><tr bgcolor="#E3E3F3">
<th>City</th>
<td>'.($row['City']).'</td>
</tr></table></center>');
$doc->endElement();

//sets the gradient
$doc->startElement('styleUrl');
$doc->text('#gradient'.$row['gradient']);
$doc->endElement();


    $doc->startElement('Polygon');
        $doc->startElement('tesselate');
        $doc->text(1);
        $doc->endElement();
        $doc->startElement('LinearRing');
            $doc->startElement('outerBoundaryIs');

                    $doc->startElement('coordinates');
                        $doc->text($row['Coordinates']);
                    $doc->endElement(); // coordinates
                $doc->endElement(); // outerBoundaryIs
        $doc->endElement(); // Linear Ring         
        
    $doc->endElement(); // Polygon

    $doc->endElement(); // Placemark
}//END placemark
    
    $doc->endElement(); // End Document

$doc->endElement(); // kml
echo $doc->flush();
//$newxml = $doc->outputMemory(true);
