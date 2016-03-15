jQuery(document).ready(function($)
{
	$('#iewp_events_startdate').combodate({
          value: new Date(),
          minYear: parseInt( moment().format('YYYY') ) - 1,
          maxYear: parseInt( moment().format('YYYY') ) + 1 
    });

    $('#iewp_events_enddate').combodate({
          value: new Date(),
          minYear: parseInt( moment().format('YYYY') ) - 1,
          maxYear: parseInt( moment().format('YYYY') ) + 1 
    });
});