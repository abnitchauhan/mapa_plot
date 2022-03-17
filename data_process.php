<?php 
// FILES REQUIRED FOR CUMULATIVE PREDICTION
// $e = 'files/e.csv'; //EP Line
// $Predictions1_M = 'files/Predictions1_M.csv'; //MP and PP Line
$inte_cases_state = 'files/inte_cases_state.csv'; // EP Band 0.95
$transition_zone = 'files/transition_zone.csv';  // MP Band
$intp_cases_state = 'files/intp_cases_state.csv'; // PP Band
$prediction_lines = 'files/combine_cases_state.csv'; // EP, PP, MP and TRUE Line 
$df012 = 'files/df012.csv';

// $e_read = readcsv($e);
// $Predictions1_M_read = readcsv($Predictions1_M);
$inte_cases_state_read = readcsv($inte_cases_state);
$transition_zone_read = readcsv($transition_zone);
$intp_cases_state_read = readcsv($intp_cases_state);
$prediction_lines_read = readcsv($prediction_lines);
$df012_read =  readcsv($df012);

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

// echo json_encode($intp_cases_state_read); //Just Checking all the data.
 
foreach($prediction_lines_read as $prediction_lines_data)
    {   
        $all_dates[] = $prediction_lines_data[2]; //Dates
        $ep_line[] = floatval($prediction_lines_data[5]); // EP LINE
        $mp_line[] = floatval($prediction_lines_data[4]); // MP Line
        $pp_line[] = floatval($prediction_lines_data[3]); // PP Line
        $true[] = floatval($prediction_lines_data[6]);
    }

foreach($df012_read as $df012_data)
{
    $pred[] = floatval($df012_data[3]);
}

// // EXPONENTIAL PREDICTION LINE
// foreach($e_read as $e_data)
//     {
//         $ep_line[] = floatval($e_data[6]); //EP LINE
//     }

// // PRINCIPLE PREDICTION LINE
// foreach($Predictions1_M_read as $Predictions1_M_data)
//     {   
//         $all_dates[] = $Predictions1_M_data[1];  
//         $pp_line[] = floatval($Predictions1_M_data[2]); // PP Line
//         $mp_line[] = floatval($Predictions1_M_data[7]); // MP Line
//     }

// Exponential Prediction Band
// foreach($inte_cases_state_read as $inte_cases_state_data)
//     {   
//         $ep_date[] =  $inte_cases_state_data[1];
//         $ep_lower[] = floatval($inte_cases_state_data[8]);
//         $ep_upper[] = floatval($inte_cases_state_data[3]);
//     }

//     $ep_band = bandPlots($ep_date, $ep_lower, $ep_upper, $all_dates); //Principle Prediction Lower and Upper Band.

// // Mean Prediction Band
// foreach($transition_zone_read as $transition_zone_data)
//     {   
//         $mp_date[] =  $transition_zone_data[1];
//         $mp_lower[] = floatval($transition_zone_data[3]);
//         $mp_upper[] = floatval($transition_zone_data[2]);
//     }

//     $mp_band = bandPlots($mp_date, $mp_lower, $mp_upper, $all_dates); //Mean Prediction Lower and Upper Band.

// // Principle Prediction Band
// foreach($intp_cases_state_read as $intp_cases_state_data)
// {   
//     $pp_date[] =  $intp_cases_state_data[1];
//     $pp_lower[] = floatval($intp_cases_state_data[8]);
//     $pp_upper[] = floatval($intp_cases_state_data[3]);
// }

// $pp_band = bandPlots($pp_date, $pp_lower, $pp_upper, $all_dates); //Principle Prediction Lower and Upper Band.

 
    
// bandPlots Function
    // function bandPlots($date, $lower, $upper, $total)
    // {    
    //   $length =  count($total) - count($date);
     
    //     for($i=$length ; $i<count($total);$i++)
    //     { 
    //        $datapoints[] =  $i;
    //     }
        
    //     if(count($datapoints) == count($lower) && count($datapoints) == count($upper))
    //     {
    //       for($i=0;$i<count($datapoints);$i++)
    //         {
    //             $databandsArray[] = [$datapoints[$i], $lower[$i], $upper[$i]]; 
    //         } 
    //     }
    //     return $databandsArray; 
    // }



// OUTPUT
$cumul_predictions = ['dates'=>$all_dates, 'ep'=>$ep_line, 'mp'=>$mp_line, 'pp'=>$pp_line, 'true' => $true, 'pred' => $pred];

 
echo json_encode($cumul_predictions);

?>