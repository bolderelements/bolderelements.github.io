<?php
$latest_version = "4.1.3";
$last_updated = "2018-04-04";
$description = "<h3>Version Log</h3>" . file_get_contents( 'changelog.txt' );
if( isset( $_POST[ 'action' ] ) ) :
	//Initialize curl 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://marketplace.envato.com/api/edge/item:3796656.json');
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, 'be-table-rate-shipping');
	$ch_data = curl_exec($ch);
	curl_close($ch);
	switch( $_POST[ 'action' ] ) {
		case 'version':
			echo $latest_version;
			break;
	    case 'info':
	    	$obj = new stdClass();
			$obj->slug = 'woocommerce-table-rate-shipping';
			$obj->plugin_name = 'woocommerce-table-rate-shipping.php';
			$obj->new_version = $latest_version;
			$obj->requires = '4.6';
			$obj->tested = '4.9';
			$obj->last_updated = $last_updated;
            $obj->homepage = $obj->url = 'http://bolderelements.net/plugins/table-rate-shipping-woocommerce/';
			$obj->sections = array(
		        'changelog' => file_get_contents( 'changelog.txt' )
	    	);
	    	//$obj->update_message = "<strong>This is a major update</strong> and will require you to run an update patch after upgrading before it can be used again.<br />It is recommended that you make a full backup of the site before upgrading.";
			if( !empty( $ch_data ) ) {
			    $info = json_decode($ch_data, true)[ 'item' ];
	      		$obj->downloaded = $info[ 'sales' ];
	      		$obj->rating = $info[ 'rating_decimal' ] * 20;
	      		$obj->num_ratings = 368;
			}
	      	echo serialize($obj);
	      break;
	    case 'license':
	      echo 'false';
	      break;
	}
endif;
?>
