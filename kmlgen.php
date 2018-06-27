<?php
//Jeffrey Marron
//for CBHC KML generation

require 'functions.php';

$conn = Connect();

$stmt = $conn->query('SELECT * FROM org_zip_coords WHERE 1');
$stmt->setFetchMode(PDO::FETCH_ASSOC);

$doc = new DOMDocument('1.0', 'UTF-8');

    $folder = $doc->createElement('Folder');

foreach ($stmt as $row) {
    
      // Creates a Placemark and append it to the Document
    
        $placemark = $doc->createElement('Placemark');
        
        $placemark->appendChild($doc->createElement('name', $row['ZipCode']));
        
        $extendedData = $doc->createElement('ExtendedData');

            $data0 = $doc->createElement('Data');               
            $data0->setAttribute("name","city");//This sets the attribute of the extended data tag
            $data0->appendChild($doc->createElement('Value', $row['City']));
            
            $data1 = $doc->createElement('Data');               
            $data1->setAttribute("name","org");//This sets the attribute of the extended data tag
            $data1->appendChild($doc->createElement('Value', $row['org_ID']));

            $data2 = $doc->createElement('Data');               
            $data2->setAttribute("name","count");//This sets the attribute of the extended data tag
                $test = (rand(0,100));
            $data2->appendChild($doc->createElement('Value', $test));
            /*  
        $placemark->appendChild($doc->createElement('Data', $row['City']));
        $placemark->appendChild($doc->createElement('Data', $row['org_ID']));
        $test = (rand(0,100));
        $placemark->appendChild($doc->createElement('Data', $test));
        */
        $placemark->appendChild($doc->createElement('styleUrl', '#msn_ylw-pushpin'));
        
            $linearRing = $doc->createElement('LinearRing');

            $outerBoundaryIs = $doc->createElement('outerBoundaryIs');

            $polygon = $doc->createElement('Polygon');
            $polygon->appendChild($doc->createElement('tesselate', 1));
            $linearRing->appendChild($doc->createElement('Coordinates', $row['Coordinates']));
            
            $outerBoundaryIs->appendChild($linearRing);
            $polygon->appendChild($outerBoundaryIs);
            $extendedData->appendChild($data0);
            $extendedData->appendChild($data1);
            $extendedData->appendChild($data2);
            $placemark->appendChild($extendedData);
            $placemark->appendChild($polygon);

           // $outerBoundaryIs->appendChild($linearRing);

    $folder->appendChild($placemark);//end Placemark
}

$doc->appendChild($folder);//end folder

// Set the appropriate content-type header and output the XML
header('Content-type: application/xml');
echo $doc->saveXML();
$doc->save("tampa_metro_zip.kml");
exit;
