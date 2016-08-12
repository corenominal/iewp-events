<?php
if ( ! defined( 'WPINC' ) ) { die('Direct access prohibited!'); }
/**
 * Set defaults for tickets and venue
 */
function iewp_lug_meetings_defaults()
{
    update_option( 'iewp_lug_meetings_default_venue_name', '' );
    update_option( 'iewp_lug_meetings_default_venue_website', '' );
    update_option( 'iewp_lug_meetings_default_venue_address_street', '' );
    update_option( 'iewp_lug_meetings_default_venue_address_city', '' );
    update_option( 'iewp_lug_meetings_default_venue_address_county', '' );
    update_option( 'iewp_lug_meetings_default_venue_address_postcode', '' );

    update_option( 'iewp_lug_meetings_default_ticket_name', 'Free - Ticket Not Required' );
    update_option( 'iewp_lug_meetings_default_ticket_price', '0.00' );
    update_option( 'iewp_lug_meetings_default_ticket_url', '' );
}
iewp_lug_meetings_defaults();
