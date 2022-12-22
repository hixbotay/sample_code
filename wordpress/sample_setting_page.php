<?php

/**
 * Register our custom_setting_settings_init to the admin_init action hook.
 */
add_action( 'admin_init', function () {
	// Register a new setting for "custom_setting" page.
	register_setting( 'custom_setting', 'custom_setting_options' );

	// Register a new section in the "custom_setting" page.
	add_settings_section(
		'custom_setting_section_developers',
		__( 'The Matrix has you.', 'custom_setting' ), 'custom_setting_section_developers_callback',
		'custom_setting'
	);

	// Register a new field in the "custom_setting_section_developers" section, inside the "custom_setting" page.
	add_settings_field(
		'custom_setting_field_pill', // As of WP 4.6 this value is used only internally.
		                        // Use $args' label_for to populate the id inside the callback.
			__( 'Pill', 'custom_setting' ),
		'custom_setting_field_pill_cb',
		'custom_setting',
		'custom_setting_section_developers',
		array(
			'label_for'         => 'custom_setting_field_pill',
			'class'             => 'custom_setting_row',
			'custom_setting_custom_data' => 'custom',
		)
	);
} );


/**
 * Custom option and settings:
 *  - callback functions
 */


/**
 * Developers section callback function.
 *
 * @param array $args  The settings array, defining title, id, callback.
 */
function custom_setting_section_developers_callback( $args ) {
	?>
	<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Follow the white rabbit.', 'custom_setting' ); ?></p>
	<?php
}

/**
 * Pill field callbakc function.
 *
 * WordPress has magic interaction with the following keys: label_for, class.
 * - the "label_for" key value is used for the "for" attribute of the <label>.
 * - the "class" key value is used for the "class" attribute of the <tr> containing the field.
 * Note: you can add custom key value pairs to be used inside your callbacks.
 *
 * @param array $args
 */
function custom_setting_field_pill_cb( $args ) {
	// Get the value of the setting we've registered with register_setting()
	$options = get_option( 'custom_setting_options' );
	?>
	<select
			id="<?php echo esc_attr( $args['label_for'] ); ?>"
			data-custom="<?php echo esc_attr( $args['custom_setting_custom_data'] ); ?>"
			name="custom_setting_options[<?php echo esc_attr( $args['label_for'] ); ?>]">
		<option value="red" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'red', false ) ) : ( '' ); ?>>
			<?php esc_html_e( 'red pill', 'custom_setting' ); ?>
		</option>
 		<option value="blue" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'blue', false ) ) : ( '' ); ?>>
			<?php esc_html_e( 'blue pill', 'custom_setting' ); ?>
		</option>
	</select>
	<p class="description">
		<?php esc_html_e( 'You take the blue pill and the story ends. You wake in your bed and you believe whatever you want to believe.', 'custom_setting' ); ?>
	</p>
	<p class="description">
		<?php esc_html_e( 'You take the red pill and you stay in Wonderland and I show you how deep the rabbit-hole goes.', 'custom_setting' ); ?>
	</p>
	<?php
}

/**
 * Register our custom_setting_options_page to the admin_menu action hook.
 */
add_action( 'admin_menu', function() {
	add_menu_page(
		'custom_setting',
		'custom_setting Options',
		'manage_options',
		'custom_setting',
		'custom_setting_options_page_html'
	);
});


/**
 * Top level menu callback function
 */
function custom_setting_options_page_html() {
	// check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	// add error/update messages

	// check if the user have submitted the settings
	// WordPress will add the "settings-updated" $_GET parameter to the url
	if ( isset( $_GET['settings-updated'] ) ) {
		// add settings saved message with the class of "updated"
		add_settings_error( 'custom_setting_messages', 'custom_setting_message', __( 'Settings Saved', 'custom_setting' ), 'updated' );
	}

	// show error/update messages
	settings_errors( 'custom_setting_messages' );
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			<?php
			// output security fields for the registered setting "custom_setting"
			settings_fields( 'custom_setting' );
			// output setting sections and their fields
			// (sections are registered for "custom_setting", each field is registered to a specific section)
			do_settings_sections( 'custom_setting' );
			// output save settings button
			submit_button( 'Save Settings' );
			?>
		</form>
	</div>
	<?php
}
