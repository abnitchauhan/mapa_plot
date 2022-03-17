<?php 

include('functions.php');
// FILES REQUIRED FOR CUMULATIVE PREDICTION 
$inte_cases_state_read = readcsv('files/inte_cases_state.csv');
$transition_zone_read = readcsv('files/transition_zone.csv');
$intp_cases_state_read = readcsv('files/intp_cases_state.csv');
$combine_cases_state_read = readcsv('files/combine_cases_state.csv');
$df012_read =  readcsv('files/df012.csv');

 
// All other Lines in prediction State
foreach($combine_cases_state_read as $combine_cases_state_data)
    {   
        $ep_line[] = [totimestamp($combine_cases_state_data[2]), floatval($combine_cases_state_data[5])]; // EP LINE
        $mp_line[] = [totimestamp($combine_cases_state_data[2]), floatval($combine_cases_state_data[4])]; // MP Line
        $pp_line[] = [totimestamp($combine_cases_state_data[2]), floatval($combine_cases_state_data[3])]; // PP Line
        $true[] = [totimestamp($combine_cases_state_data[2]), check_zero(floatval($combine_cases_state_data[6]))]; //True Line
    }
 
// For Prediction Line in combined State
foreach($df012_read as $df012_data)
{    
    $pred_line[] = [difftimestamp($df012_data[1]), floatval($df012_data[3])];  
} 
 

// BANDS  
// Exponential Band
foreach($inte_cases_state_read as $inte_cases_state_data)
{ 
  $ep_band[] = [totimestamp($inte_cases_state_data[1]),floatval($inte_cases_state_data[8]), floatval($inte_cases_state_data[3])];
}
  
// Mean Prediction Band
foreach($transition_zone_read as $transition_zone_data)
{
    $mp_band[] = [totimestamp($transition_zone_data[1]),floatval($transition_zone_data[3]),floatval($transition_zone_data[2])];
} 

// Principal Prediction Band
foreach($intp_cases_state_read as $intp_cases_state_data)
{ 
    $pp_band[] = [totimestamp($intp_cases_state_data[1]),floatval($intp_cases_state_data[8]),floatval($intp_cases_state_data[3])];
}
 

// OUTPUT
$cumul_predictions = ['ep'=>$ep_line, 'mp'=>$mp_line, 'pp'=>$pp_line, 'true' => $true, 'pred' => $pred_line, 'ep_band' => $ep_band, 'mp_band' => $mp_band, 'pp_band' => $pp_band];

 echo json_encode($cumul_predictions); 


?>