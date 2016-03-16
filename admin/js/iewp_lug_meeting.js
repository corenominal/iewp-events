jQuery(document).ready(function($)
{
	$('#iewp_lug_meeting_startdate').combodate({
          value: new Date(),
          minYear: parseInt( moment().format('YYYY') ) - 1,
          maxYear: parseInt( moment().format('YYYY') ) + 1 
    });

    $('#iewp_lug_meeting_enddate').combodate({
          value: new Date(),
          minYear: parseInt( moment().format('YYYY') ) - 1,
          maxYear: parseInt( moment().format('YYYY') ) + 1 
    });
});