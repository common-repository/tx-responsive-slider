<?php 

namespace themexpo\rkslide;

if ( ! defined('ABSPATH')) exit; // if direct access 

/**
 *  Menu Handle class
 **/
class txmainMenu 
{
	
	function __construct(){

	 /*setting api hook*/

	 add_action( 'admin_init', array( $this , 'tx_setting_page_init' ) );
   }

/**
*  submenu
**/

 public function tx_responsive_slider_setting_menu() {

  add_submenu_page( 'edit.php?post_type=txresponsiveslider', __( 'Settings', 'responsive-slider' ), __( 'Settings', 'responsive-slider' ), 'manage_options', 
  	'slider_setting', [ $this, 'tx_setting_create_admin_page'] );   
 }


/**
*  setting page
**/
	public function tx_setting_create_admin_page() {

	$this->rk_setting_options = get_option( 'tx_setting_option_name' ); ?>

		<div class="wrap">
			<h2>TX Responsive Slider :</h2>
			<p></p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'rk_setting_option_group' );
					do_settings_sections( 'rk-setting-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }
	

	public function tx_setting_page_init() {
		register_setting(
			'rk_setting_option_group', // option_group
			'tx_setting_option_name', // option_name
			array( $this, 'rk_setting_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'rk_setting_setting_section', // id
			'Settings', // title
			array( $this, 'rk_setting_section_info' ), // callback
			'rk-setting-admin' // page
		);

		add_settings_field(
			'width', // id
			'Width', // title
			array( $this, 'width_0_callback' ), // callback
			'rk-setting-admin', // page
			'rk_setting_setting_section' // section
		);

		add_settings_field(
			'height', // id
			'Height', // title
			array( $this, 'height_1_callback' ), // callback
			'rk-setting-admin', // page
			'rk_setting_setting_section' // section
		);

		add_settings_field(
			'slider_arrow_active', // id
			'Slider Arrow Active', // title
			array( $this, 'slider_arrow_active_2_callback' ), // callback
			'rk-setting-admin', // page
			'rk_setting_setting_section' // section
		);

		add_settings_field(
			'slider_dot', // id
			'Slider Dot Active', // title
			array( $this, 'slider_dot_3_callback' ), // callback
			'rk-setting-admin', // page
			'rk_setting_setting_section' // section
		);

		add_settings_field(
			'animation_duration', // id
			'Animation Duration', // title
			array( $this, 'animation_duration_callback' ), // callback
			'rk-setting-admin', // page
			'rk_setting_setting_section' // section
		);
	}

	/*input field sanitizaion*/

	public function rk_setting_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['width'] ) ) {
			$sanitary_values['width'] = sanitize_text_field( $input['width'] );
		}

		if ( isset( $input['height'] ) ) {
			$sanitary_values['height'] = sanitize_text_field( $input['height'] );
		}

		if ( isset( $input['slider_arrow_active'] ) ) {
			$sanitary_values['slider_arrow_active'] = $input['slider_arrow_active'];
		}

		if ( isset( $input['slider_dot'] ) ) {
			$sanitary_values['slider_dot'] = $input['slider_dot'];
		}

		if ( isset( $input['animation_duration'] ) ) {
			$sanitary_values['animation_duration'] = $input['animation_duration'];
		}

		return $sanitary_values;
	}

	public function rk_setting_section_info() {
		
	}

    /* callback function */ 

	public function width_0_callback() {
		printf(
			'<input class="regular-text" type="text" name="tx_setting_option_name[width]" id="width" value="%s"> Px',
			isset( $this->rk_setting_options['width'] ) ? esc_attr( $this->rk_setting_options['width']) : ''
		);
	}

	public function height_1_callback() {
		printf(
			'<input class="regular-text" type="text" name="tx_setting_option_name[height]" id="height" value="%s"> Px',
			isset( $this->rk_setting_options['height'] ) ? esc_attr( $this->rk_setting_options['height']) : ''
		);
	}

	public function slider_arrow_active_2_callback() {
		?> <fieldset><?php $checked = ( isset( $this->rk_setting_options['slider_arrow_active'] ) && $this->rk_setting_options['slider_arrow_active'] === 'Yes' ) ? 'checked' : '' ; ?>
		<label for="slider_arrow_active-0"><input type="radio" name="tx_setting_option_name[slider_arrow_active]" id="slider_arrow_active-0" value="Yes" <?php echo $checked; ?>> Yes</label>
		<?php $checked = ( isset( $this->rk_setting_options['slider_arrow_active'] ) && $this->rk_setting_options['slider_arrow_active'] === 'none' ) ? 'checked' : '' ; ?>
		<label for="slider_arrow_active-1"><input type="radio" name="tx_setting_option_name[slider_arrow_active]" id="slider_arrow_active-1" value="none" <?php echo $checked; ?>> No</label></fieldset> <?php
	}

	public function slider_dot_3_callback() {
		?> 
	<fieldset><?php $checked = ( isset( $this->rk_setting_options['slider_dot'] ) && $this->rk_setting_options['slider_dot'] === 'Yes' ) ? 'checked' : '' ; ?>
	<label for="slider_dot-0"><input type="radio" name="tx_setting_option_name[slider_dot]" id="slider_dot-0" value="Yes" <?php echo $checked; ?>> Yes</label>

	<?php $checked = ( isset( $this->rk_setting_options['slider_dot'] ) && $this->rk_setting_options['slider_dot'] === 'none' ) ? 'checked' : '' ; ?>
	<label for="slider_dot-1"><input type="radio" name="tx_setting_option_name[slider_dot]" id="slider_dot-1" value="none" <?php echo $checked; ?>> No</label></fieldset> 
	
		<?php
	}

	public function animation_duration_callback() {
		?> <select name="tx_setting_option_name[animation_duration]" id="animation_duration">
			
			<?php $selected = (isset( $this->rk_setting_options['animation_duration'] ) && $this->rk_setting_options['animation_duration'] === '500') ? 'selected' : '' ; ?>
			<option <?php echo $selected; ?>>500</option>

			<?php $selected = (isset( $this->rk_setting_options['animation_duration'] ) && $this->rk_setting_options['animation_duration'] === '1000') ? 'selected' : '' ; ?>
			<option <?php echo $selected; ?>>1000</option>
			<?php $selected = (isset( $this->rk_setting_options['animation_duration'] ) && $this->rk_setting_options['animation_duration'] === '1500') ? 'selected' : '' ; ?>
			<option <?php echo $selected; ?>>1500</option>
			<?php $selected = (isset( $this->rk_setting_options['animation_duration'] ) && $this->rk_setting_options['animation_duration'] === '2000') ? 'selected' : '' ; ?>
			<option <?php echo $selected; ?>>2000</option>
			<?php $selected = (isset( $this->rk_setting_options['animation_duration'] ) && $this->rk_setting_options['animation_duration'] === '2500') ? 'selected' : '' ; ?>
			<option <?php echo $selected; ?>>2500</option>
			<?php $selected = (isset( $this->rk_setting_options['animation_duration'] ) && $this->rk_setting_options['animation_duration'] === '3000') ? 'selected' : '' ; ?>
			<option <?php echo $selected; ?>>3000</option>
		</select>milliseconds <?php
	}

} /*End of the Class*/

?>