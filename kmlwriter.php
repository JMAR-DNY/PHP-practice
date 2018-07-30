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


$doc->startElement('Folder');

foreach ($stmt as $row) { 
    $doc->startElement('Placemark');

    /*
    $doc->startElement('name');
    //$doc->writeAttribute('name', 'Zip');
    $doc->text($row['ZipCode']);
    $doc->endElement();
*/
    $doc->startElement('ExtendedData');
        $doc->startElement('data');
            $doc->writeAttribute('name', 'Zip');
                $doc->startElement('value');         
                    $doc->text($row['ZipCode']);
                $doc->endElement(); 
        $doc->endElement();
        
        $doc->startElement('data');
        $doc->writeAttribute('name', 'city');
                $doc->startElement('value');         
                    $doc->text($row['City']);
                $doc->endElement(); 
        $doc->endElement();

        $doc->startElement('data');
            $doc->writeAttribute('name', 'ProgramID');
                $doc->startElement('value');         
                    $doc->text($row['ProgramID']);
                $doc->endElement(); 
        $doc->endElement();

        $doc->startElement('data');
            $doc->writeAttribute('name', 'count');
                $doc->startElement('value');         
                    $doc->text($row['data']);
                $doc->endElement(); 
        $doc->endElement();

        $doc->startElement('data');
            $doc->writeAttribute('name', 'gradient');
                $doc->startElement('value');         
                    $doc->text($row['gradient']);
                $doc->endElement(); 
        $doc->endElement();

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
    
    $doc->endElement(); // Folder

$doc->endElement(); // kml
echo $doc->flush();
//$newxml = $doc->outputMemory(true);
