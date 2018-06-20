<?php
//Jeffrey Marron
//for CBHC KML generation

require 'functions.php';

$conn = Connect();

$stmt = $conn->query('SELECT * FROM fl_zip_coords WHERE 1');
$stmt->setFetchMode(PDO::FETCH_ASSOC);

$doc = new DOMDocument('1.0', 'UTF-8');

    $folder = $doc->createElement('Folder');

foreach ($stmt as $row) {
    
      // Creates a Placemark and append it to the Document
    
        $placemark = $doc->createElement('Placemark');
        $placemark->appendChild($doc->createElement('name', $row['ZipCode']));
        $placemark->appendChild($doc->createElement('styleUrl', '#msn_ylw-pushpin'));

        $linearRing = $doc->createElement('LinearRing');

        $outerBoundaryIs = $doc->createElement('outerBoundaryIs');

        $polygon = $doc->createElement('Polygon');
        $polygon->appendChild($doc->createElement('tesselate', 1));
    //$entry->setAttribute('zipcode', $row['ZipCode']);
    //[City]
            

        
    //$test->appendChild($doc->createElement('linear Ring'));
                $linearRing->appendChild($doc->createElement('Coordinates', $row['Coordinates']));
            
            $outerBoundaryIs->appendChild($linearRing);
            $polygon->appendChild($outerBoundaryIs);
            $placemark->appendChild($polygon);

           // $outerBoundaryIs->appendChild($linearRing);

    $folder->appendChild($placemark);//end Placemark
}

$doc->appendChild($folder);//end folder

// Set the appropriate content-type header and output the XML
header('Content-type: application/xml');
echo $doc->saveXML();
$doc->save("test1.kml");
exit;
