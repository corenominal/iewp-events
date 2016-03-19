<?php
/**
 * Function to return array of structured data
 */
function iewp_lug_meeting_get_structured_data( $id )
{
	$data['venue_name'] = get_post_meta( $id, 'iewp_lug_meeting_venue_name', true );
	$data['venue_website'] = get_post_meta( $id, 'iewp_lug_meeting_venue_website', true );
	$data['venue_address_street'] = get_post_meta( $id, 'iewp_lug_meeting_venue_address_street', true );
	$data['venue_address_city'] = get_post_meta( $id, 'iewp_lug_meeting_venue_address_city', true );
	$data['venue_address_county'] = get_post_meta( $id, 'iewp_lug_meeting_venue_address_county', true );
	$data['venue_address_postcode'] = get_post_meta( $id, 'iewp_lug_meeting_venue_address_postcode', true );

	//TODO
	//iewp_lug_meeting_startdate_timestamp
	//iewp_lug_meeting_enddate_timestamp
	//iewp_lug_meeting_ticket_name
	//iewp_lug_meeting_ticket_price
	//iewp_lug_meeting_ticket_url

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
	$structured_data .= '  "name": "NAME OF EVENT",';
	$structured_data .= '  "startDate" : "2016-03-16T19:00",';
	$structured_data .= '  "endDate" : "2016-03-16T22:00",';
	$structured_data .= '  "url" : "http://event.url",';
	$structured_data .= '  "location" :';
	$structured_data .= '  {';
	$structured_data .= '    "@type" : "Place",';
	$structured_data .= '    "sameAs" : "http://venue.url",';
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
	$structured_data .= '    "name" : "TICKET NAME",';
	$structured_data .= '    "price" : 0,';
	$structured_data .= '    "url" : "http://ticket.url"';
	$structured_data .= '  }';
	$structured_data .= '}';
	$structured_data .= '</script>';

	return $structured_data;
}