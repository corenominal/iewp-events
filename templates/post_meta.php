<?php
/**
 * Get post meta for given lug meeting
 */
function iewp_lug_meeting_get_post_meta( $id )
{
	$data = iewp_lug_meeting_get_structured_data( $id );

	return $data;
}