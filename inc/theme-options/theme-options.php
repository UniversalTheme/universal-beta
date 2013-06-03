<?php
/**
 * Universal Theme Options
 *
 * @package Universal
 * @since Universal 1.0
 */

/**
 * Register the form setting for our universal_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, universal_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are properly
 * formatted, and safe.
 *
 * @since Universal 1.0
 */
function universal_theme_options_init() {
	register_setting(
		'universal_options', // Options group, see settings_fields() call in universal_theme_options_render_page()
		'universal_theme_options', // Database option, see universal_get_theme_options()
		'universal_theme_options_validate' // The sanitization callback, see universal_theme_options_validate()
	);

	// Register our settings field group
	add_settings_section(
		'general', // Unique identifier for the settings section
		'General', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see universal_theme_options_add_page()
	);

	add_settings_section(
		'sample', // Unique identifier for the settings section
		'Sample', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'sample' // Menu slug, used to uniquely identify the page; see universal_theme_options_add_page()
	);

	// Register our individual settings fields
	add_settings_field(
		'custom_home_page', // Unique identifier for the field for this section
		__( 'Custom Home Page', 'universal' ), // Setting field label
		'universal_settings_field_custom_home_page', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see universal_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);

	add_settings_field( 'sample_text_input', __( 'Sample Text Input', 'universal' ), 'universal_settings_field_sample_text_input', 'sample', 'sample', array( 'tab' => 'sample' ) );
	add_settings_field( 'sample_select_options', __( 'Sample Select Options', 'universal' ), 'universal_settings_field_sample_select_options', 'sample', 'sample', array( 'tab' => 'sample' ) );
	add_settings_field( 'sample_radio_buttons', __( 'Sample Radio Buttons', 'universal' ), 'universal_settings_field_sample_radio_buttons', 'sample', 'sample' );
	add_settings_field( 'sample_textarea', __( 'Sample Textarea', 'universal' ), 'universal_settings_field_sample_textarea', 'sample', 'sample' );
	add_settings_field( 'social-icons', __( 'Social Icons', 'universal' ), 'universal_settings_field_social_icons', 'theme_options', 'general' );
}
add_action( 'admin_init', 'universal_theme_options_init' );

/**
 * Change the capability required to save the 'universal_options' options group.
 *
 * @see universal_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see universal_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function universal_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_universal_options', 'universal_option_page_capability' );

/**
 * Add our theme options page to the admin menu.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since Universal 1.0
 */
function universal_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'universal' ),   // Name of page
		__( 'Theme Options', 'universal' ),   // Label in menu
		'edit_theme_options',          // Capability required
		'theme-options',               // Menu slug, used to uniquely identify the page
		'universal_theme_options_render_page' // Function that renders the options page
	);
}
add_action( 'admin_menu', 'universal_theme_options_add_page' );

function universal_get_theme_options_page_tabs() {
	$tabs = array(
		'general' => 'General',
		'sample' => 'Sample'
	);
	return $tabs;
}

function universal_theme_options_page_tabs( $current = 'general' ) {
	if ( isset ( $_GET['tab'] ) ) :
		$current = $_GET['tab'];
	else:
		$current = 'general';
	endif;
		$tabs = universal_get_theme_options_page_tabs();
		$links = array();
	foreach( $tabs as $tab => $name ) :
		if ( $tab == $current ) :
			$links[] = '<a class="nav-tab nav-tab-active" href="?page=theme-options&tab=' . $tab . '">' . $name . '</a>';
		else :
			$links[] = '<a class="nav-tab" href="?page=theme-options&tab=' . $tab . '">' . $name . '</a>';
		endif;
	endforeach;
		echo '<h2 class="nav-tab-wrapper">';
	foreach ( $links as $link )
		echo $link;
	echo '</h2>';
	}

/**
 * Returns an array of sample select options registered for Universal.
 *
 * @since Universal 1.0
 */
function universal_sample_select_options() {
	$sample_select_options = array(
		'0' => array(
			'value' =>	'0',
			'label' => __( 'Zero', 'universal' )
		),
		'1' => array(
			'value' =>	'1',
			'label' => __( 'One', 'universal' )
		),
		'2' => array(
			'value' => '2',
			'label' => __( 'Two', 'universal' )
		),
		'3' => array(
			'value' => '3',
			'label' => __( 'Three', 'universal' )
		),
		'4' => array(
			'value' => '4',
			'label' => __( 'Four', 'universal' )
		),
		'5' => array(
			'value' => '5',
			'label' => __( 'Five', 'universal' )
		)
	);

	return apply_filters( 'universal_sample_select_options', $sample_select_options );
}

/**
 * Returns an array of sample radio options registered for Universal.
 *
 * @since Universal 1.0
 */
function universal_sample_radio_buttons() {
	$sample_radio_buttons = array(
		'yes' => array(
			'value' => 'yes',
			'label' => __( 'Yes', 'universal' )
		),
		'no' => array(
			'value' => 'no',
			'label' => __( 'No', 'universal' )
		),
		'maybe' => array(
			'value' => 'maybe',
			'label' => __( 'Maybe', 'universal' )
		)
	);

	return apply_filters( 'universal_sample_radio_buttons', $sample_radio_buttons );
}

/**
 * Returns the options array for Universal.
 *
 * @since Universal 1.0
 */
function universal_get_theme_options() {
	$saved = (array) get_option( 'universal_theme_options' );
	$defaults = array(
		'custom_home_page'      => 'on',
		'sample_text_input'     => '',
		'sample_select_options' => '',
		'sample_radio_buttons'  => '',
		'sample_textarea'       => '',
		'twitter_uid'           => '',
		'facebook_uid'          => '',
		'linkedin_uid'          => '',
		'youtube_uid'           => '',
		'rss_uid'               => '',
		'google_plus_uid'       => '',
		'instagram_uid'         => '',
		'pinterest_uid'         => '',
		'yelp_uid'              => '',
		'vimeo_uid'             => '',
		'foursquare_uid'        => '',
	);

	$defaults = apply_filters( 'universal_default_theme_options', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}

/**
 * Renders the custom home page setting field.
 */
function universal_settings_field_custom_home_page() {
	$options = universal_get_theme_options();
	?>
	<label for="custom-home-page">
		<input type="checkbox" name="universal_theme_options[custom_home_page]" id="custom-home-page" <?php checked( 'on', $options['custom_home_page'] ); ?> />
		<?php _e( 'Disabling this will convert your home page into a blog.', 'universal' ); ?>
	</label>
	<?php
}

/**
 * Renders the sample text input setting field.
 */
function universal_settings_field_sample_text_input() {
	$options = universal_get_theme_options();
	?>
	<input type="text" name="universal_theme_options[sample_text_input]" id="sample-text-input" value="<?php echo esc_attr( $options['sample_text_input'] ); ?>" />
	<label class="description" for="sample-text-input"><?php _e( 'Sample text input', 'universal' ); ?></label>
	<?php
}

/**
 * Renders the sample select options setting field.
 */
function universal_settings_field_sample_select_options() {
	$options = universal_get_theme_options();
	?>
	<select name="universal_theme_options[sample_select_options]" id="sample-select-options">
		<?php
			$selected = $options['sample_select_options'];
			$p = '';
			$r = '';

			foreach ( universal_sample_select_options() as $option ) {
				$label = $option['label'];
				if ( $selected == $option['value'] ) // Make default first in list
					$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
				else
					$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
			}
			echo $p . $r;
		?>
	</select>
	<label class="description" for="sample_theme_options[selectinput]"><?php _e( 'Sample select input', 'universal' ); ?></label>
	<?php
}

/**
 * Renders the radio options setting field.
 *
 * @since Universal 1.0
 */
function universal_settings_field_sample_radio_buttons() {
	$options = universal_get_theme_options();

	foreach ( universal_sample_radio_buttons() as $button ) {
	?>
	<div class="layout">
		<label class="description">
			<input type="radio" name="universal_theme_options[sample_radio_buttons]" value="<?php echo esc_attr( $button['value'] ); ?>" <?php checked( $options['sample_radio_buttons'], $button['value'] ); ?> />
			<?php echo $button['label']; ?>
		</label>
	</div>
	<?php
	}
}

/**
 * Renders the sample textarea setting field.
 */
function universal_settings_field_sample_textarea() {
	$options = universal_get_theme_options();
	?>
	<textarea class="large-text" type="text" name="universal_theme_options[sample_textarea]" id="sample-textarea" cols="50" rows="10" /><?php echo esc_textarea( $options['sample_textarea'] ); ?></textarea>
	<label class="description" for="sample-textarea"><?php _e( 'Sample textarea', 'universal' ); ?></label>
	<?php
}

/**
 * Renders the social icons setting field.
 */
function universal_settings_field_social_icons() {
	$options = universal_get_theme_options();
	?>
	<input id="universal_theme_options[twitter_uid]" class="regular-text" type="text" name="universal_theme_options[twitter_uid]" value="<?php echo esc_url( $options['twitter_uid'] ); ?>" />
	<label class="description" for="universal_theme_options[twitter_uid]"><?php _e('Enter your Twitter URL', 'universal'); ?></label>

	<input id="universal_theme_options[facebook_uid]" class="regular-text" type="text" name="universal_theme_options[facebook_uid]" value="<?php if (!empty($options['facebook_uid'])) echo esc_url($options['facebook_uid']); ?>" />
	<label class="description" for="universal_theme_options[facebook_uid]"><?php _e('Enter your Facebook URL', 'universal'); ?></label>

	<input id="universal_theme_options[linkedin_uid]" class="regular-text" type="text" name="universal_theme_options[linkedin_uid]" value="<?php if (!empty($options['linkedin_uid'])) echo esc_url($options['linkedin_uid']); ?>" /> 
	<label class="description" for="universal_theme_options[linkedin_uid]"><?php _e('Enter your LinkedIn URL', 'universal'); ?></label>

	<input id="universal_theme_options[youtube_uid]" class="regular-text" type="text" name="universal_theme_options[youtube_uid]" value="<?php if (!empty($options['youtube_uid'])) echo esc_url($options['youtube_uid']); ?>" /> 
	<label class="description" for="universal_theme_options[youtube_uid]"><?php _e('Enter your YouTube URL', 'universal'); ?></label>

	<input id="universal_theme_options[rss_uid]" class="regular-text" type="text" name="universal_theme_options[rss_uid]" value="<?php if (!empty($options['rss_uid'])) echo esc_url($options['rss_uid']); ?>" /> 
	<label class="description" for="universal_theme_options[rss_uid]"><?php _e('Enter your RSS Feed URL', 'universal'); ?></label>

	<input id="universal_theme_options[google_plus_uid]" class="regular-text" type="text" name="universal_theme_options[google_plus_uid]" value="<?php if (!empty($options['google_plus_uid'])) echo esc_url($options['google_plus_uid']); ?>" />  
	<label class="description" for="universal_theme_options[google_plus_uid]"><?php _e('Enter your Google+ URL', 'universal'); ?></label>

	<input id="universal_theme_options[instagram_uid]" class="regular-text" type="text" name="universal_theme_options[instagram_uid]" value="<?php if (!empty($options['instagram_uid'])) echo esc_url($options['instagram_uid']); ?>" />  
	<label class="description" for="universal_theme_options[instagram_uid]"><?php _e('Enter your Instagram URL', 'universal'); ?></label>

	<input id="universal_theme_options[pinterest_uid]" class="regular-text" type="text" name="universal_theme_options[pinterest_uid]" value="<?php if (!empty($options['pinterest_uid'])) echo esc_url($options['pinterest_uid']); ?>" />  
	<label class="description" for="universal_theme_options[pinterest_uid]"><?php _e('Enter your Pinterest URL', 'universal'); ?></label>

	<input id="universal_theme_options[yelp_uid]" class="regular-text" type="text" name="universal_theme_options[yelp_uid]" value="<?php if (!empty($options['yelp_uid'])) echo esc_url($options['yelp_uid']); ?>" />  
	<label class="description" for="universal_theme_options[yelp_uid]"><?php _e('Enter your Yelp! URL', 'universal'); ?></label>

	<input id="universal_theme_options[vimeo_uid]" class="regular-text" type="text" name="universal_theme_options[vimeo_uid]" value="<?php if (!empty($options['vimeo_uid'])) echo esc_url($options['vimeo_uid']); ?>" />  
	<label class="description" for="universal_theme_options[vimeo_uid]"><?php _e('Enter your Vimeo URL', 'universal'); ?></label>

	<input id="universal_theme_options[foursquare_uid]" class="regular-text" type="text" name="universal_theme_options[foursquare_uid]" value="<?php if (!empty($options['foursquare_uid'])) echo esc_url($options['foursquare_uid']); ?>" />  
	<label class="description" for="universal_theme_options[foursquare_uid]"><?php _e('Enter your foursquare URL', 'universal'); ?></label>
	<?php
}

/**
 * Renders the Theme Options administration screen.
 *
 */
function universal_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php printf( __( '%s Theme Options', 'universal' ), $theme_name ); ?></h2>
		<?php settings_errors(); ?>
 
		<form method="post" action="options.php">
			<?php
				settings_fields( 'universal_options' );
				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @see universal_theme_options_init()
 * @todo set up Reset Options action
 *
 * @param array $input Unknown values.
 * @return array Sanitized theme options ready to be stored in the database.
 *
 * @since Universal 1.0
 */
function universal_theme_options_validate( $input ) {
	$output = array();

	// The sample checkbox should either be on or off
	if ( ! isset( $input['custom_home_page'] ) )
		$input['custom_home_page'] = 'off';
	$output['custom_home_page'] = ( $input['custom_home_page'] == 'on' ? 'on' : 'off' );

	// The sample text input must be safe text with no HTML tags
	if ( isset( $input['sample_text_input'] ) && ! empty( $input['sample_text_input'] ) )
		$output['sample_text_input'] = wp_filter_nohtml_kses( $input['sample_text_input'] );

	// The sample select option must actually be in the array of select options
	if ( isset( $input['sample_select_options'] ) && array_key_exists( $input['sample_select_options'], universal_sample_select_options() ) )
		$output['sample_select_options'] = $input['sample_select_options'];

	// The sample radio button value must be in our array of radio button values
	if ( isset( $input['sample_radio_buttons'] ) && array_key_exists( $input['sample_radio_buttons'], universal_sample_radio_buttons() ) )
		$output['sample_radio_buttons'] = $input['sample_radio_buttons'];

	// The sample textarea must be safe text with the allowed tags for posts
	if ( isset( $input['sample_textarea'] ) && ! empty( $input['sample_textarea'] ) )
		$output['sample_textarea'] = wp_filter_post_kses( $input['sample_textarea'] );

	// The sample textarea must be safe text with the allowed tags for posts
	if ( isset( $input['twitter_uid'] ) && ! empty( $input['twitter_uid'] ) )
		$output['twitter_uid'] = esc_url_raw( $input['twitter_uid'] );
	if ( isset( $input['facebook_uid'] ) && ! empty( $input['facebook_uid'] ) )
		$output['facebook_uid'] = esc_url_raw( $input['facebook_uid'] );
	if ( isset( $input['linkedin_uid'] ) && ! empty( $input['linkedin_uid'] ) )
		$output['linkedin_uid'] = esc_url_raw( $input['linkedin_uid'] );
	if ( isset( $input['youtube_uid'] ) && ! empty( $input['youtube_uid'] ) )
		$output['youtube_uid'] = esc_url_raw( $input['youtube_uid'] );
	if ( isset( $input['rss_uid'] ) && ! empty( $input['rss_uid'] ) )
		$output['rss_uid'] = esc_url_raw( $input['rss_uid'] );
	if ( isset( $input['google_plus_uid'] ) && ! empty( $input['google_plus_uid'] ) )
		$output['google_plus_uid'] = esc_url_raw( $input['google_plus_uid'] );
	if ( isset( $input['instagram_uid'] ) && ! empty( $input['instagram_uid'] ) )
		$output['instagram_uid'] = esc_url_raw( $input['instagram_uid'] );
	if ( isset( $input['pinterest_uid'] ) && ! empty( $input['pinterest_uid'] ) )
		$output['pinterest_uid'] = esc_url_raw( $input['pinterest_uid'] );
	if ( isset( $input['yelp_uid'] ) && ! empty( $input['yelp_uid'] ) )
		$output['yelp_uid'] = esc_url_raw( $input['yelp_uid'] );
	if ( isset( $input['vimeo_uid'] ) && ! empty( $input['vimeo_uid'] ) )
		$output['vimeo_uid'] = esc_url_raw( $input['vimeo_uid'] );
	if ( isset( $input['foursquare_uid'] ) && ! empty( $input['foursquare_uid'] ) )
		$output['foursquare_uid'] = esc_url_raw( $input['foursquare_uid'] );

	return apply_filters( 'universal_theme_options_validate', $output, $input );
}
