<?php
//Jeffrey Marron
//for CBHC KML generation

require 'functions.php';

$conn = Connect();
$stmt = $conn->query('SELECT * FROM kml_all_participant_count_2017 WHERE 1');
$stmt->setFetchMode(PDO::FETCH_ASSOC);


$doc=new XMLWriter();

$doc->openURI('writer_test.kml');
$doc->setIndent(true);
$doc->startDocument('1.0','UTF-8');
$doc->startElement('kml');
$doc->writeAttribute('xmlns', "http://www.opengis.net/kml/2.2");

$doc->startElement('Document');

//insert styles here

//gradient 1
$doc->startElement('Style');
$doc->writeAttribute('id', 'gradient1');
        $doc->startElement('LineStyle');//LineStyle
            $doc->startElement('color');
                $doc->text("ff666666");
            $doc->endElement();//end color
            $doc->startElement('width');
                $doc->text(1);
            $doc->endElement();//end width
            $doc->startElement('gx:labelVisibility');
                $doc->text(0);
            $doc->endElement();//end labelVisibility
        $doc->endElement();//end LineStyle

        $doc->startElement('PolyStyle');//PolyStyle
            $doc->startElement('color');
                $doc->text("75bcd4c6");//gradient 1 poly color
            $doc->endElement();//end color
            $doc->startElement('fill');
                $doc->text(1);
            $doc->endElement();//end fill
            $doc->startElement('outline');
                $doc->text(1);
            $doc->endElement();//end outline
        $doc->endElement();//end PolyStyle
$doc->endElement();//ends gradient1

//gradient 2
$doc->startElement('Style');
$doc->writeAttribute('id', 'gradient2');
        $doc->startElement('LineStyle');//LineStyle
            $doc->startElement('color');
                $doc->text("ff666666");
            $doc->endElement();//end color
            $doc->startElement('width');
                $doc->text(1);
            $doc->endElement();//end width
            $doc->startElement('gx:labelVisibility');
                $doc->text(0);
            $doc->endElement();//end labelVisibility
        $doc->endElement();//end LineStyle

        $doc->startElement('PolyStyle');//PolyStyle
            $doc->startElement('color');
                $doc->text("7590b29b");//gradient 2 poly color
            $doc->endElement();//end color
            $doc->startElement('fill');
                $doc->text(1);
            $doc->endElement();//end fill
            $doc->startElement('outline');
                $doc->text(1);
            $doc->endElement();//end outline
        $doc->endElement();//end PolyStyle
$doc->endElement();//ends gradient2

//gradient 3
$doc->startElement('Style');
$doc->writeAttribute('id', 'gradient3');
        $doc->startElement('LineStyle');//LineStyle
            $doc->startElement('color');
                $doc->text("ff666666");
            $doc->endElement();//end color
            $doc->startElement('width');
                $doc->text(1);
            $doc->endElement();//end width
            $doc->startElement('gx:labelVisibility');
                $doc->text(0);
            $doc->endElement();//end labelVisibility
        $doc->endElement();//end LineStyle

        $doc->startElement('PolyStyle');//PolyStyle
            $doc->startElement('color');
                $doc->text("75618d6e");//gradient 3 poly color
            $doc->endElement();//end color
            $doc->startElement('fill');
                $doc->text(1);
            $doc->endElement();//end fill
            $doc->startElement('outline');
                $doc->text(1);
            $doc->endElement();//end outline
        $doc->endElement();//end PolyStyle
$doc->endElement();//ends gradient3

//gradient 4
$doc->startElement('Style');
$doc->writeAttribute('id', 'gradient4');
        $doc->startElement('LineStyle');//LineStyle
            $doc->startElement('color');
                $doc->text("ff666666");
            $doc->endElement();//end color
            $doc->startElement('width');
                $doc->text(1);
            $doc->endElement();//end width
            $doc->startElement('gx:labelVisibility');
                $doc->text(0);
            $doc->endElement();//end labelVisibility
        $doc->endElement();//end LineStyle

        $doc->startElement('PolyStyle');//PolyStyle
            $doc->startElement('color');
                $doc->text("75394d3e");//gradient 4 poly color
            $doc->endElement();//end color
            $doc->startElement('fill');
                $doc->text(1);
            $doc->endElement();//end fill
            $doc->startElement('outline');
                $doc->text(1);
            $doc->endElement();//end outline
        $doc->endElement();//end PolyStyle
$doc->endElement();//ends gradient4

//Generates each placemark
foreach ($stmt as $row) { 
    $doc->startElement('Placemark');

//description with cdata
$doc->startElement('description');
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
$doc->endElement();//description with cdata

//sets the gradient
$doc->startElement('styleUrl');
$doc->text('#gradient'.$row['gradient']);
$doc->endElement();


    $doc->startElement('Polygon');
        $doc->startElement('tesselate');
        $doc->text(1);
        $doc->endElement();
        $doc->startElement('outerBoundaryIs');
            $doc->startElement('LinearRing');
            
                    $doc->startElement('coordinates');
                        $doc->text($row['Coordinates']);
                    $doc->endElement(); // coordinates
                $doc->endElement(); //Linear Ring
        $doc->endElement(); // outerBoundaryIs        
        
    $doc->endElement(); // Polygon

    $doc->endElement(); // Placemark
}//END placemark
    
    $doc->endElement(); // End Document

$doc->endElement(); // kml
echo $doc->flush();
//$newxml = $doc->outputMemory(true);
