<?php
/**
 * Function to return structured data
 */
function iewp_lug_meetings_get_structured_data( $id )
{
    //TODO get custom values for post and insert below

	$data  = '<script type="application/ld+json">';
	$data .= '{';
	$data .= '  "@context": "http://schema.org",';
	$data .= '  "@type": "Event",';
	$data .= '  "name": "NAME OF EVENT",';
	$data .= '  "startDate" : "2016-03-16T19:00",';
	$data .= '  "endDate" : "2016-03-16T22:00",';
	$data .= '  "url" : "http://event.url",';
	$data .= '  "location" :';
	$data .= '  {';
	$data .= '    "@type" : "Place",';
	$data .= '    "sameAs" : "http://venue.url",';
	$data .= '    "name" : "VENUE NAME",';
	$data .= '    "address" :';
	$data .= '    {';
	$data .= '      "@type" : "PostalAddress",';
	$data .= '      "streetAddress" : "STREET ADDRESS",';
	$data .= '      "addressLocality" : "CITY",';
	$data .= '      "addressRegion" : "COUNTY",';
	$data .= '      "postalCode" : "POSTCODE"';
	$data .= '    }';
	$data .= '  },';
	$data .= '  "offers" :';
	$data .= '  {';
	$data .= '    "name" : "TICKET NAME",';
	$data .= '    "price" : 0,';
	$data .= '    "url" : "http://ticket.url"';
	$data .= '  }';
	$data .= '}';
	$data .= '</script>';

	return $data;
}