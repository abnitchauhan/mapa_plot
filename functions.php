<?php

function readcsv($file)
    { 
        $data = fopen($file, 'r'); 
        while (($allData = fgetcsv($data)) !== FALSE)
        {
            $finalData[] = $allData;
        }
        $dataHead = $finalData[0]; 
        array_shift($finalData); 
        return $finalData;	    
    } 

// Convert Date to Timestamp 

    //(dd/mm/yy) Format
function totimestamp($time)
    {
        list($day, $month, $year) = explode('/', $time);
        $timestamp =  mktime(0, 0, 0, $month, $day, $year)*1000; 
        return $timestamp; 
    }
    
  //(yyyy-mm-dd) Format
function difftimestamp($time2)
    {
        list($year, $month, $day) = explode('-', $time2);
        $timestamp2 =  mktime(0, 0, 0, $month, $day, $year)*1000; 
        return $timestamp2; 
    }

// Replace Zero with NULL
function check_zero($zero)
    {
        if($zero == 0)
            {
            return null;
            }
            return $zero;
    }
