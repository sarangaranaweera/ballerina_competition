<?php
	include_once('connection.php');
	
	$driverID = $_POST['driverID'];

	$query = "
	SELECT 
	
	garbage_collecting_point_details.garbage_collecting_point_id,
	garbage_collecting_point_details.garbage_collecting_point_name,
	garbage_collecting_point_details.garbage_collecting_point_description,
	garbage_collecting_point_details.garbage_collecting_point_lat,
	garbage_collecting_point_details.garbage_collecting_point_lon,
	garbage_collecting_point_details.garbage_point_driver_tractor_merge_status

	FROM 
	
	garbage_collecting_point_details 
	
	JOIN garbage_point_driver_tractor_merge_details ON (garbage_collecting_point_details.garbage_collecting_point_id = garbage_point_driver_tractor_merge_details.garbage_point_driver_tractor_merge_point_id)
	
	JOIN tractor_driver_merge_details ON (tractor_driver_merge_details.tractor_driver_merge_id = garbage_point_driver_tractor_merge_details.garbage_point_driver_tractor_merge_dtractor_id)
	
	WHERE garbage_collecting_point_details.garbage_collecting_point_active = 1 AND tractor_driver_merge_details.tractor_driver_merge_driver_id = $driverID";

	$result = mysqli_query($connection, $query);

	while($rows = mysqli_fetch_array($result)){
		$ress[] = $rows;
	}
mysqli_close($connection);
print json_encode(utf8ize($ress), JSON_UNESCAPED_SLASHES);

function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}
        
?>