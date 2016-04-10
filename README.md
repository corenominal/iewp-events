# LUG Meetings - WordPress Plugin

![Screenshot of plugin.](https://corenominal.org/wp-content/uploads/2016/04/edit_lug_meeting_wordpress_plugin.png)

This WordPress plugin provides a custom post type for creating LUG meeting/events. The plugin provides custom metaboxes for detailing:

 * Meeting dates & times
 * Venue details
 * Ticket details

All additional details are stored as post meta and can be retrieved via the provided template function:

    $meta = iewp_lug_meeting_get_post_meta( $post->ID );

The above function will return and array, which can be used within a template to display details of the LUG meeting.

	Array
	(
	    [event_title] => Lug Meeting - 20th April
	    [event_url] => https://lincolnlug.org.uk/lug_meeting/lug-meeting-20th-april/
	    [venue_name] => Lincoln Bowl
	    [venue_website] => http://www.lincolnbowl.co.uk/
	    [venue_address_street] => Washingborough Road
	    [venue_address_city] => Lincoln
	    [venue_address_county] => Lincolnshire
	    [venue_address_postcode] => LN4 1EF
	    [startdate] => 2016-04-20 19:00
	    [enddate] => 2016-04-20 22:00
	    [startdate_timestamp] => 1461178800
	    [enddate_timestamp] => 1461189600
	    [ticket_name] => Free - Ticket Not Required
	    [ticket_price] => 0.00
	    [ticket_url] => https://lincolnlug.org.uk/lug_meeting/lug-meeting-20th-april/
	)

An additional function is available for providing structured data of the meeting.

    <?php echo iewp_lug_meeting_structured_data( $post->ID ) ?>

Example output:

	<script type="application/ld+json">
	{
		"@context": "http://schema.org",
		"@type": "Event",  
		"name": "Lug Meeting - 20th April",
	    "startDate" : "2016-04-20T19:00:00+00:00",
	    "endDate" : "2016-04-20T22:00:00+00:00",
	    "url" : "https://lincolnlug.org.uk/lug_meeting/lug-meeting-20th-april/",
	    "location" :
	    {    
	    	"@type" : "Place",
	    	"sameAs" : "http://www.lincolnbowl.co.uk/",
	    	"name" : "Lincoln Bowl",
	    	"address" :
	        {
	    		"@type" : "PostalAddress",
	    		"streetAddress" : "Washingborough Road",
	    		"addressLocality" : "Lincoln",
	    		"addressRegion" : "Lincolnshire",
	    		"postalCode" : "LN4 1EF"
	    	}
	    },
	    "offers" :  
	    {
	    	"name" : "Free - Ticket Not Required",
	    	"price" : 0.00,
	    	"url" : "https://lincolnlug.org.uk/lug_meeting/lug-meeting-20th-april/"
	    }
	}
	</script>

