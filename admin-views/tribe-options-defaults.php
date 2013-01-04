<?php

$organizers = TribeEvents::instance()->get_organizer_info();
$organizer_options = array();
if ( is_array($organizers) && !empty($organizers) ) {
	$organizer_options[0] = __('No Default', 'tribe-events-calendar-pro');
	foreach ($organizers as $organizer) {
		$organizer_options[$organizer->ID] = $organizer->post_title;
	}
}

$venues = TribeEvents::instance()->get_venue_info();
$venue_options = array();
if ( is_array($venues) && !empty($venues) ) {
	$venue_options[0] = __('No Default', 'tribe-events-calendar-pro');
	foreach ($venues as $venue) {
		$venue_options[$venue->ID] = $venue->post_title;
	}
}

$state_options = TribeEventsViewHelpers::loadStates();
$state_options = array_merge( array( '' => __('Select a State','tribe-events-calendar-pro') ), $state_options );

$country_options = TribeEventsViewHelpers::constructCountries();

$defaultsTab = array(
	'priority' => 30,
	'fields' => array(
		'info-start' => array(
			'type' => 'html',
			'html' => '<div id="modern-tribe-info">'
		),
		'info-box-title' => array(
			'type' => 'html',
			'html' => '<h2>' . __('Default Content', 'tribe-events-calendar-pro') . '</h2>',
		),
		'info-box-description' => array(
			'type' => 'html',
			'html' => '<p>' . __('Set values for event organizers & venues that appear pre-populated in the event editor whenever you create a new event. This helps save time in situations where the venue or organizer rarely changes, saving you from having to manually re-enter the data each time you create an event.</p><p>It\'s worth noting that these can be overridden on the event creation screen; if a venue and organizer are pre-populated but you wants to change to something else, use the dropdown to either select another existing venue/organizer, or manually enter the details of a new one.', 'tribe-events-calendar-pro') . '</p>',
		),
		'info-end' => array(
			'type' => 'html',
			'html' => '</div>',
		),
		'tribe-form-content-start' => array(
			'type' => 'html',
			'html' => '<div class="tribe-settings-form-wrap">',
		),
		'defaultValueReplace' => array(
			'type' => 'checkbox_bool',
			'label' => __('Automatically replace empty fields with default values','tribe-events-calendar-pro'),
			'default' => false,
			'validation_type' => 'boolean',
		),
		'eventsDefaultOrganizerHelperTitle' => array(
			'type' => 'html',
			'html' => '<h3>' . __('Organizer', 'tribe-events-calendar-pro') . '</h3>',
		),
		'eventsDefaultOrganizerHelperText' => array(
			'type' => 'html',
			'html' => '<p class="description">' . __('You can use this setting to set a default organizer to use with your events.', 'tribe-events-calendar-pro') . '</p>',
		),
		'eventsDefaultOrganizerID' => array(
			'type' => 'dropdown_chosen',
			'label' => __('Default Organizer','tribe-events-calendar-pro'),
			'default' => false,
			'validation_type' => 'options',
			'options' => $organizer_options,
			'if_empty' => __('No saved organizers yet.','tribe-events-calendar-pro'),
			'can_be_empty' => true,
		),
		'current-default-organizer' => array(
			'type' => 'html',
			'display_callback' => 'tribe_display_saved_organizer',
		),
		'eventsDefaultVenueHelperTitle' => array(
			'type' => 'html',
			'html' => '<h3>' . __('Venue', 'tribe-events-calendar-pro') . '</h3>',
		),
		'eventsDefaultVenueHelperText' => array(
			'type' => 'html',
			'html' => '<p class="description">' . __('You can use this setting to set a default venue to use with your events.', 'tribe-events-calendar-pro') . '</p>',
		),
		'eventsDefaultVenueID' => array(
			'type' => 'dropdown_chosen',
			'label' => __('Default Venue','tribe-events-calendar-pro'),
			'default' => false,
			'validation_type' => 'options',
			'options' => $venue_options,
			'if_empty' => __('No saved venues yet.','tribe-events-calendar-pro'),
			'can_be_empty' => true,
		),
		'current-default-venue' => array(
			'type' => 'html',
			'display_callback' => 'tribe_display_saved_venue',
		),
		'eventsDefaultAddressHelperTitle' => array(
			'type' => 'html',
			'html' => '<h3>' . __('Address', 'tribe-events-calendar-pro') . '</h3>',
		),
		'eventsDefaultAddressHelperText' => array(
			'type' => 'html',
			'html' => '<p class="description">' . __('You can use this setting to set specific, individual defaults for any new Venue you create (these will not be used for your default venue).', 'tribe-events-calendar-pro') . '</p>',
		),
		'eventsDefaultAddress' => array(
			'type' => 'text',
			'label' => __('Default Address','tribe-events-calendar-pro'),
			'default' => false,
			'class' => 'venue-default-info',
			'validation_type' => 'address',
			'can_be_empty' => true,
		),
		'current-default-address' => array(
			'type' => 'html',
			'class' => 'venue-default-info',
			'display_callback' => 'tribe_display_saved_address',
		),
		'eventsDefaultCity' => array(
			'type' => 'text',
			'label' => __('Default City','tribe-events-calendar-pro'),
			'default' => false,
			'class' => 'venue-default-info',
			'validation_type' => 'city_or_province',
			'can_be_empty' => true,
		),
		'current-default-city' => array(
			'type' => 'html',
			'class' => 'venue-default-info',
			'display_callback' => 'tribe_display_saved_city',
		),
		'eventsDefaultState' => array(
			'type' => 'dropdown_chosen',
			'label' => __('Default State','tribe-events-calendar-pro'),
			'default' => false,
			'class' => 'venue-default-info',
			'validation_type' => 'options',
			'options' => $state_options,
			'can_be_empty' => true,
		),
		'current-default-state' => array(
			'type' => 'html',
			'display_callback' => 'tribe_display_saved_state',
		),
		'eventsDefaultProvince' => array(
			'type' => 'text',
			'label' => __('Default Province','tribe-events-calendar-pro'),
			'default' => false,
			'class' => 'venue-default-info',
			'validation_type' => 'city_or_province',
			'can_be_empty' => true,
		),
		'current-default-province' => array(
			'type' => 'html',
			'class' => 'venue-default-info',
			'display_callback' => 'tribe_display_saved_province',
		),
		'eventsDefaultZip' => array(
			'type' => 'text',
			'label' => __('Default Postal Code/Zip Code','tribe-events-calendar-pro'),
			'default' => false,
			'class' => 'venue-default-info',
			'validation_type' => 'address', // allows for letters, numbers, dashses and spaces only
			'can_be_empty' => true,
		),
		'current-default-zip' => array(
			'type' => 'html',
			'class' => 'venue-default-info',
			'display_callback' => 'tribe_display_saved_zip',
		),
		'defaultCountry' => array(
			'type' => 'dropdown_chosen',
			'label' => __('Default Country','tribe-events-calendar-pro'),
			'default' => false,
			'class' => 'venue-default-info',
			'validation_type' => 'options_with_label',
			'options' => $country_options,
			'can_be_empty' => true,
		),
		'current-default-country' => array(
			'type' => 'html',
			'display_callback' => 'tribe_display_saved_country',
		),
		'eventsDefaultPhone' => array(
			'type' => 'text',
			'label' => __('Default Phone','tribe-events-calendar-pro'),
			'default' => false,
			'class' => 'venue-default-info',
			'validation_type' => 'phone',
			'can_be_empty' => true,
		),
		'current-default-phone' => array(
			'type' => 'html',
			'class' => 'venue-default-info',
			'display_callback' => 'tribe_display_saved_phone',
		),
		'tribeEventsCountries' => array(
			'type' => 'textarea',
			'label' => __('Use a custom list of countries','tribe-events-calendar-pro'),
			'default' => false,
			'validation_type' => 'country_list',
			'tooltip' => __('One country per line in the following format: <br>US, United States <br> UK, United Kingdom. <br> (Replaces the default list.)', 'tribe-events-calendar-pro'),
			'can_be_empty' => true,
		),
		'tribe-form-content-end' => array(
			'type' => 'html',
			'html' => '</div>',
		),
	)
);