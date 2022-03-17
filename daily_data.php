<?php

include('functions.php');

// read the csv file required for Short term prediction.
$pred_df_read = readcsv('files/pred_df.csv');

foreach($pred_df_read as $pred_df_data)
{
    $actual_data[] = [difftimestamp($pred_df_data[2]), check_zero(floatval($pred_df_data[3]))];
    $prediction_data[] = [difftimestamp($pred_df_data[2]), floatval($pred_df_data[4])];
}

$daily_cases = ['true'=> $actual_data, 'prediction' => $prediction_data];

echo json_encode($daily_cases);

?>