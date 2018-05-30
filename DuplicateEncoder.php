<?php

/*
The goal of this exercise is to convert a string to a new string where each character in the new string is '(' if that character appears only once in the original string, or ')' if that character appears more than once in the original string. Ignore capitalization when determining if a character is a duplicate.

Examples:

"din" => "((("

"recede" => "()()()"

"Success" => ")())())"

"(( @" => "))((" 
*/


function duplicate_encode($word){

$test = strtolower($word);
$test2 = str_split($test);
$temp = 0;
$test4 = "";

for($i=0;$i<count($test2); $i++){
    $dupeCount =0;
    for($j=0;$j<count($test2); $j++){
        
        if($test2[$j] == $test2[$i]){
            $dupeCount +=1;
        }
        if($dupeCount == 1){
            $temp = '(';
        }
        if($dupeCount >1){
            $temp =')';
        }
    }

$test4 .= $temp;
}
return $test4;
  
}

function duplicate_encode1($word){
  $word = str_split(strtolower($word));
  $str = "";
  foreach($word as $key){
    (count(array_keys($word,$key))>1) ? $str .= ")" : $str .= "(";
  }  
  return $str;      
}
