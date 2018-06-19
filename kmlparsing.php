<?php
//Jeffrey Marron
//for CBHC KML Parsing


//HELPER FUNCTIONS/////////////////////////////////////
function Connect(){

    $db = parse_db_ini();
    
        try {
        $handler = new PDO('mysql:host='.$db['host'].'; dbname='.$db['database'], $db['user'], $dbPassword = $db['password']);
        $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
        echo $e->getMessage().'<br>';
        die ('Database Error');
        $handler = NULL;
        }
        return $handler;
    }
    
    /*This function is to allow access to connection info for other  database functions
    so that only dbinfo.ini needs to be changed when managing connections*/
    function parse_db_ini(){
        $db = parse_ini_file("dbInfo.ini");
      
        $database = $db['database'];
        $dbHost = $db['dbHost'];
        $dbUser = $db['dbUser'];
        $dbPassword = $db['dbPassword'];
      
        return array('database' => $database, 'host'=> $dbHost,
         'user'=> $dbUser, 'password' => $dbPassword);
      }

      function create_table($sql, $connection){
        $query = $connection->prepare($sql);
        if ($query->execute() === TRUE) {
          echo "table created successfully<br>";
        } else {
          echo "\n error Info: \n";
          print_r($connection->errorInfo());//outputs error code
        }
      }


      function create_mysql_table_USZipCodeData(){
        $conn = Connect();
    
        $conn->exec("DROP TABLE IF EXISTS USZipCodeData");//deletes table if it already exists

        //sql to create table
            $sql = "CREATE TABLE USZipCodeData (
            USzipCodeID INT NOT NULL AUTO_INCREMENT,
            USzipCode TEXT,
            USzipCoords LONGTEXT,
            USzipHasMulti bit,
            PRIMARY KEY (USzipCodeID)
            )";

        create_table($sql, $conn);    
               
        $connection = NULL;//close connection
    
    }

        function insert_into_USZipCodeData($conn,$zip,$coords){
            $sql =$conn->prepare("INSERT INTO USZipCodeData (USzipCode, USzipCoords) 
            VALUES (:USzipCode,:USzipCoords)");
            $sql->bindParam(':USzipCode', $zip);
            $sql->bindParam(':USzipCoords', $coords);
            $sql->execute();
        }



//create the Zip Code data table
create_mysql_table_USZipCodeData();

//no time limit for long script
set_time_limit(0);

//creates connection to database
$conn = Connect();

//XML STUFF//////////////////////////////////////////
$xml = simplexml_load_file('cb_2017_us_zcta510_500k.kml') or die("Error: Cannot create object");
//$xml = simplexml_load_file('test.kml') or die("Error: Cannot create object");

$childs = $xml->Document->Folder->children();
foreach ($childs as $child)
{

    //sets the zip code
    $tempZip = $child->ExtendedData->SchemaData->SimpleData[0];

    //tests for multi-spacial-geometry
    if ($child->MultiGeometry){
        $i = 0;//iterative looping foreach polygon, reset to 0 for each zip
        foreach($child->MultiGeometry->Polygon as $multi){
            $tempCoords = $child->MultiGeometry->Polygon[$i]->outerBoundaryIs->LinearRing->coordinates;
            insert_into_USZipCodeData($conn, $tempZip, $tempCoords);
            $i++;
        } 
    }
    else{//sets coordinates if theres only one set 
        $tempCoords =  $child->Polygon->outerBoundaryIs->LinearRing->coordinates;
        insert_into_USZipCodeData($conn, $tempZip, $tempCoords);
    }

}

//END XML STUFF///////////////////////////////////
$conn = NULL;
