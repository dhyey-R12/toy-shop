<?php
/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */

class VW_Landing_Page_Control_Typography extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'typography';

	/**
	 * Array 
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

	/**
	 * Set up our control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $id
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = array() ) {

		// Let the parent class do its thing.
		parent::__construct( $manager, $id, $args );

		// Make sure we have labels.
		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'color'       => esc_html__( 'Font Color', 'vw-landing-page' ),
				'family'      => esc_html__( 'Font Family', 'vw-landing-page' ),
				'size'        => esc_html__( 'Font Size',   'vw-landing-page' ),
				'weight'      => esc_html__( 'Font Weight', 'vw-landing-page' ),
				'style'       => esc_html__( 'Font Style',  'vw-landing-page' ),
				'line_height' => esc_html__( 'Line Height', 'vw-landing-page' ),
				'letter_spacing' => esc_html__( 'Letter Spacing', 'vw-landing-page' ),
			)
		);
	}

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'vw-landing-page-ctypo-customize-controls' );
		wp_enqueue_style(  'vw-landing-page-ctypo-customize-controls' );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {

			$this->json[ $setting_key ] = array(
				'link'  => $this->get_link( $setting_key ),
				'value' => $this->value( $setting_key ),
				'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
			);

			if ( 'family' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_families();

			elseif ( 'weight' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

			elseif ( 'style' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_style_choices();
		}
	}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function content_template() { ?>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<ul>

		<# if ( data.family && data.family.choices ) { #>

			<li class="typography-font-family">

				<# if ( data.family.label ) { #>
					<span class="customize-control-title">{{ data.family.label }}</span>
				<# } #>

				<select {{{ data.family.link }}}>

					<# _.each( data.family.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.weight && data.weight.choices ) { #>

			<li class="typography-font-weight">

				<# if ( data.weight.label ) { #>
					<span class="customize-control-title">{{ data.weight.label }}</span>
				<# } #>

				<select {{{ data.weight.link }}}>

					<# _.each( data.weight.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.weight.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.style && data.style.choices ) { #>

			<li class="typography-font-style">

				<# if ( data.style.label ) { #>
					<span class="customize-control-title">{{ data.style.label }}</span>
				<# } #>

				<select {{{ data.style.link }}}>

					<# _.each( data.style.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.size ) { #>

			<li class="typography-font-size">

				<# if ( data.size.label ) { #>
					<span class="customize-control-title">{{ data.size.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.size.link }}} value="{{ data.size.value }}" />

			</li>
		<# } #>

		<# if ( data.line_height ) { #>

			<li class="typography-line-height">

				<# if ( data.line_height.label ) { #>
					<span class="customize-control-title">{{ data.line_height.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.line_height.link }}} value="{{ data.line_height.value }}" />

			</li>
		<# } #>

		<# if ( data.letter_spacing ) { #>

			<li class="typography-letter-spacing">

				<# if ( data.letter_spacing.label ) { #>
					<span class="customize-control-title">{{ data.letter_spacing.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.letter_spacing.link }}} value="{{ data.letter_spacing.value }}" />

			</li>
		<# } #>

		</ul>
	<?php }

	/**
	 * Returns the available fonts.  Fonts should have available weights, styles, and subsets.
	 *
	 * @todo Integrate with Google fonts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_fonts() { return array(); }

	/**
	 * Returns the available font families.
	 *
	 * @todo Pull families from `get_fonts()`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_font_families() {

		return array(
			'' => __( 'No Fonts', 'vw-landing-page' ),
        'Abril Fatface' => __( 'Abril Fatface', 'vw-landing-page' ),
        'Acme' => __( 'Acme', 'vw-landing-page' ),
        'Anton' => __( 'Anton', 'vw-landing-page' ),
        'Architects Daughter' => __( 'Architects Daughter', 'vw-landing-page' ),
        'Arimo' => __( 'Arimo', 'vw-landing-page' ),
        'Arsenal' => __( 'Arsenal', 'vw-landing-page' ),
        'Arvo' => __( 'Arvo', 'vw-landing-page' ),
        'Alegreya' => __( 'Alegreya', 'vw-landing-page' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'vw-landing-page' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'vw-landing-page' ),
        'Bangers' => __( 'Bangers', 'vw-landing-page' ),
        'Boogaloo' => __( 'Boogaloo', 'vw-landing-page' ),
        'Bad Script' => __( 'Bad Script', 'vw-landing-page' ),
        'Bitter' => __( 'Bitter', 'vw-landing-page' ),
        'Bree Serif' => __( 'Bree Serif', 'vw-landing-page' ),
        'BenchNine' => __( 'BenchNine', 'vw-landing-page' ),
        'Cabin' => __( 'Cabin', 'vw-landing-page' ),
        'Cardo' => __( 'Cardo', 'vw-landing-page' ),
        'Courgette' => __( 'Courgette', 'vw-landing-page' ),
        'Cherry Swash' => __( 'Cherry Swash', 'vw-landing-page' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'vw-landing-page' ),
        'Crimson Text' => __( 'Crimson Text', 'vw-landing-page' ),
        'Cuprum' => __( 'Cuprum', 'vw-landing-page' ),
        'Cookie' => __( 'Cookie', 'vw-landing-page' ),
        'Chewy' => __( 'Chewy', 'vw-landing-page' ),
        'Days One' => __( 'Days One', 'vw-landing-page' ),
        'Dosis' => __( 'Dosis', 'vw-landing-page' ),
        'Droid Sans' => __( 'Droid Sans', 'vw-landing-page' ),
        'Economica' => __( 'Economica', 'vw-landing-page' ),
        'Fredoka One' => __( 'Fredoka One', 'vw-landing-page' ),
        'Fjalla One' => __( 'Fjalla One', 'vw-landing-page' ),
        'Francois One' => __( 'Francois One', 'vw-landing-page' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'vw-landing-page' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'vw-landing-page' ),
        'Great Vibes' => __( 'Great Vibes', 'vw-landing-page' ),
        'Handlee' => __( 'Handlee', 'vw-landing-page' ),
        'Hammersmith One' => __( 'Hammersmith One', 'vw-landing-page' ),
        'Inconsolata' => __( 'Inconsolata', 'vw-landing-page' ),
        'Indie Flower' => __( 'Indie Flower', 'vw-landing-page' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'vw-landing-page' ),
        'Julius Sans One' => __( 'Julius Sans One', 'vw-landing-page' ),
        'Josefin Slab' => __( 'Josefin Slab', 'vw-landing-page' ),
        'Josefin Sans' => __( 'Josefin Sans', 'vw-landing-page' ),
        'Kanit' => __( 'Kanit', 'vw-landing-page' ),
        'Lobster' => __( 'Lobster', 'vw-landing-page' ),
        'Lato' => __( 'Lato', 'vw-landing-page' ),
        'Lora' => __( 'Lora', 'vw-landing-page' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'vw-landing-page' ),
        'Lobster Two' => __( 'Lobster Two', 'vw-landing-page' ),
        'Merriweather' => __( 'Merriweather', 'vw-landing-page' ),
        'Monda' => __( 'Monda', 'vw-landing-page' ),
        'Montserrat' => __( 'Montserrat', 'vw-landing-page' ),
        'Muli' => __( 'Muli', 'vw-landing-page' ),
        'Marck Script' => __( 'Marck Script', 'vw-landing-page' ),
        'Noto Serif' => __( 'Noto Serif', 'vw-landing-page' ),
        'Open Sans' => __( 'Open Sans', 'vw-landing-page' ),
        'Overpass' => __( 'Overpass', 'vw-landing-page' ),
        'Overpass Mono' => __( 'Overpass Mono', 'vw-landing-page' ),
        'Oxygen' => __( 'Oxygen', 'vw-landing-page' ),
        'Orbitron' => __( 'Orbitron', 'vw-landing-page' ),
        'Patua One' => __( 'Patua One', 'vw-landing-page' ),
        'Pacifico' => __( 'Pacifico', 'vw-landing-page' ),
        'Padauk' => __( 'Padauk', 'vw-landing-page' ),
        'Playball' => __( 'Playball', 'vw-landing-page' ),
        'Playfair Display' => __( 'Playfair Display', 'vw-landing-page' ),
        'PT Sans' => __( 'PT Sans', 'vw-landing-page' ),
        'Philosopher' => __( 'Philosopher', 'vw-landing-page' ),
        'Permanent Marker' => __( 'Permanent Marker', 'vw-landing-page' ),
        'Poiret One' => __( 'Poiret One', 'vw-landing-page' ),
        'Quicksand' => __( 'Quicksand', 'vw-landing-page' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'vw-landing-page' ),
        'Raleway' => __( 'Raleway', 'vw-landing-page' ),
        'Rubik' => __( 'Rubik', 'vw-landing-page' ),
        'Rokkitt' => __( 'Rokkitt', 'vw-landing-page' ),
        'Russo One' => __( 'Russo One', 'vw-landing-page' ),
        'Righteous' => __( 'Righteous', 'vw-landing-page' ),
        'Slabo' => __( 'Slabo', 'vw-landing-page' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'vw-landing-page' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'vw-landing-page'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'vw-landing-page' ),
        'Sacramento' => __( 'Sacramento', 'vw-landing-page' ),
        'Shrikhand' => __( 'Shrikhand', 'vw-landing-page' ),
        'Tangerine' => __( 'Tangerine', 'vw-landing-page' ),
        'Ubuntu' => __( 'Ubuntu', 'vw-landing-page' ),
        'VT323' => __( 'VT323', 'vw-landing-page' ),
        'Varela Round' => __( 'Varela Round', 'vw-landing-page' ),
        'Vampiro One' => __( 'Vampiro One', 'vw-landing-page' ),
        'Vollkorn' => __( 'Vollkorn', 'vw-landing-page' ),
        'Volkhov' => __( 'Volkhov', 'vw-landing-page' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'vw-landing-page' )
		);
	}

	/**
	 * Returns the available font weights.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_weight_choices() {

		return array(
			'' => esc_html__( 'No Fonts weight', 'vw-landing-page' ),
			'100' => esc_html__( 'Thin',       'vw-landing-page' ),
			'300' => esc_html__( 'Light',      'vw-landing-page' ),
			'400' => esc_html__( 'Normal',     'vw-landing-page' ),
			'500' => esc_html__( 'Medium',     'vw-landing-page' ),
			'700' => esc_html__( 'Bold',       'vw-landing-page' ),
			'900' => esc_html__( 'Ultra Bold', 'vw-landing-page' ),
		);
	}

	/**
	 * Returns the available font styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_style_choices() {

		return array(
			'' => esc_html__( 'No Fonts Style', 'vw-landing-page' ),
			'normal'  => esc_html__( 'Normal', 'vw-landing-page' ),
			'italic'  => esc_html__( 'Italic', 'vw-landing-page' ),
			'oblique' => esc_html__( 'Oblique', 'vw-landing-page' )
		);
	}
}
