<?php
/**
 * WooCommerce General Settings
 *
 * @link [plugin_url]
 * @package [package]
 * @subpackage [package]/Admin/WC_Settings
 * @since [version]
 */
if ( ! defined( 'WPINC' ) ) { die; }

if ( ! class_exists( 'WooCommerce_Advanced_Settings' ) ) :

/**
 * WC_Admin_Settings_General
 */
class WooCommerce_Advanced_Settings extends WC_Settings_Page {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->id    = 'wc_intergation_advanced';
		$this->label = __( 'WC Advanced Intergation', PLUGIN_TXT );

		add_filter( 'woocommerce_settings_tabs_array', array( $this, 'add_settings_page' ), 20 );
        add_filter( 'woocommerce_sections_'.$this->id,      array( $this, 'output_sections' ));
        add_filter( 'woocommerce_settings_'.$this->id,      array( $this, 'output_settings' )); 
		add_action( 'woocommerce_settings_save_' . $this->id, array( $this, 'save' ) );
	}

    /**
     * Get sections
     *
     * @return array
     */
    public function get_sections() {

        $sections = array(
            ''            => __( 'Simple Inputs', PLUGIN_TXT ),
            'advanced_input'     => __( 'Advanced Inputs',PLUGIN_TXT ),
            'predefined_input' => __('Predefined Inputs',PLUGIN_TXT ), 
        );


        return apply_filters( 'woocommerce_get_sections_' . $this->id, $sections );
    }
    
    
    
    
    
    
    public function output_settings(){
        global $current_section;
        $settings = $this->get_settings( $current_section ); 
        WC_Admin_Settings::output_fields( $settings );
    }    
    
    
	/**
	 * Get settings array
	 *
	 * @return array
	 */
	public function get_settings($section = null) { 
		$settings = array(

			array( 
                'title' => __( 'Simple Inputs', PLUGIN_TXT ), 
                'type' => 'title', 
                'desc' => '', 
                'id' => 'wc_advanced_simple_inputs_intergation' 
            ),

			array(
				'title'    => __( 'Text Box', PLUGIN_TXT ),
				'desc'     => __( 'This is a simple textbox', PLUGIN_TXT ),
				'id'       =>'wc_simple_textbox',
				'css'      => 'min-width:350px;',
				'default'  => 'Simple TextBox',
				'type'     => 'text',
				'desc_tip' =>  true,
			),

            array(
				'title'    => __( 'TextArea', PLUGIN_TXT ),
				'id'       => 'wc_simple_textarea',
				'default'  => __( 'Simple TextArea.', PLUGIN_TXT ),
				'type'     => 'textarea',
				'css'     => 'width:350px; height: 65px;',
				'autoload' => false
			),
            
			array(
				'title'    => __( 'Radio Buttons', PLUGIN_TXT ),
				'desc'     => __( 'A Simple Radio Button', PLUGIN_TXT ),
				'id'       => 'wc_simple_radio',
				'default'  => 'all',
				'type'     => 'radio',  
				'desc_tip' =>  true,
				'options'  => array(
					'option1'  => __( 'option 1', PLUGIN_TXT ),
					'option2'  => __( 'option 2', PLUGIN_TXT )
				)
			),

			  

			array(
				'title'   => __( 'Option 1', PLUGIN_TXT ),
				'id'      => 'wc_simple_checkbox_1',
				'default' => 'no',
				'type'    => 'checkbox',
			),
            
            array(
				'title'   => __( 'Option 2', PLUGIN_TXT ),
				'id'      => 'wc_simple_checkbox_2',
				'default' => 'no',
				'type'    => 'checkbox',
			), 



			array( 'type' => 'sectionend', 'id' => 'wc_advanced_simple_inputs_intergation'),

			     

		);

		return $settings;
	}
 

	/**
	 * Save settings
	 */
	public function save() {
		$settings = $this->get_settings();

		WC_Admin_Settings::save_fields( $settings );
	}

}

endif;

return new WooCommerce_Advanced_Settings();