<?php
	include_once('connection.php');

	$query = "
	SELECT 
	
	garbage_post_id,
	user_email,
	user_name,
	user_account_type,
	user_image,
	garbage_post_title,
	garbage_post_description,
	garbage_post_image,
	garbage_post_lat,
	garbage_post_lon,
	garbage_post_status,
	garbage_post_status_note

	FROM 
	
	garbage_post_details JOIN user_details ON (garbage_post_details.garbage_post_user_id = user_details.user_id)
	
	WHERE garbage_post_active = 1";

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