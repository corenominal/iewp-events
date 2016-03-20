<?php
/**
 * Function to return array of structured data
 */
function iewp_lug_meeting_get_structured_data( $id )
{
	$post = get_post( $id );

	$data['event_title'] = $post->post_title;
	$data['event_url'] = get_permalink( $id );

	$data['venue_name'] = get_post_meta( $id, 'iewp_lug_meeting_venue_name', true );
	$data['venue_website'] = get_post_meta( $id, 'iewp_lug_meeting_venue_website', true );
	$data['venue_address_street'] = get_post_meta( $id, 'iewp_lug_meeting_venue_address_street', true );
	$data['venue_address_city'] = get_post_meta( $id, 'iewp_lug_meeting_venue_address_city', true );
	$data['venue_address_county'] = get_post_meta( $id, 'iewp_lug_meeting_venue_address_county', true );
	$data['venue_address_postcode'] = get_post_meta( $id, 'iewp_lug_meeting_venue_address_postcode', true );

	$data['startdate'] = get_post_meta( $id, 'iewp_lug_meeting_startdate', true );
	$data['enddate'] = get_post_meta( $id, 'iewp_lug_meeting_enddate', true );
	$data['startdate_timestamp'] = get_post_meta( $id, 'iewp_lug_meeting_startdate_timestamp', true );
	$data['enddate_timestamp'] = get_post_meta( $id, 'iewp_lug_meeting_enddate_timestamp', true );

	$data['ticket_name'] = get_post_meta( $id, 'iewp_lug_meeting_ticket_name', true );
	$data['ticket_price'] = get_post_meta( $id, 'iewp_lug_meeting_ticket_price', true );
	
	$data['ticket_url'] = $data['event_url'];
	if( get_post_meta( $id, 'iewp_lug_meeting_ticket_url', true ) != '' )
		$data['ticket_url'] = get_post_meta( $id, 'iewp_lug_meeting_ticket_url', true );

	return $data;
}

/**
 * Function to return structured data
 */
function iewp_lug_meeting_structured_data( $id )
{
    //TODO get custom values for post and insert below

    $data = iewp_lug_meeting_get_structured_data( $id );

	$structured_data  = '<script type="application/ld+json">';
	$structured_data .= '{';
	$structured_data .= '  "@context": "http://schema.org",';
	$structured_data .= '  "@type": "Event",';
	$structured_data .= '  "name": "' . $data['event_title'] . '",';
	$structured_data .= '  "startDate" : "' . date( 'c', $data['startdate_timestamp'] ) . '",';
	$structured_data .= '  "endDate" : "' . date( 'c', $data['enddate_timestamp'] ) . '",';
	$structured_data .= '  "url" : "' . $data['event_url'] . '",';
	$structured_data .= '  "location" :';
	$structured_data .= '  {';
	$structured_data .= '    "@type" : "Place",';
	$structured_data .= '    "sameAs" : "' . $data['venue_website'] . '",';
	$structured_data .= '    "name" : "' . $data['venue_name'] . '",';
	$structured_data .= '    "address" :';
	$structured_data .= '    {';
	$structured_data .= '      "@type" : "PostalAddress",';
	$structured_data .= '      "streetAddress" : "' . $data['venue_address_street'] . '",';
	$structured_data .= '      "addressLocality" : "' . $data['venue_address_city'] . '",';
	$structured_data .= '      "addressRegion" : "' . $data['venue_address_county'] . '",';
	$structured_data .= '      "postalCode" : "' . $data['venue_address_postcode'] . '"';
	$structured_data .= '    }';
	$structured_data .= '  },';
	$structured_data .= '  "offers" :';
	$structured_data .= '  {';
	$structured_data .= '    "name" : "' . $data['ticket_name'] . '",';
	$structured_data .= '    "price" : ' . $data['ticket_price'] . ',';
	$structured_data .= '    "url" : "' . $data['ticket_url'] . '"';
	$structured_data .= '  }';
	$structured_data .= '}';
	$structured_data .= '</script>';

	return $structured_data;
}