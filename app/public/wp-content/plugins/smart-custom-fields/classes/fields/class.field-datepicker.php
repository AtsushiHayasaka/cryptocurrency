<?php
/**
 * Smart_Custom_Fields_Field_Datepicker
 * Version    : 1.2.0
 * Author     : inc2734
 * Created    : January 17, 2015
 * Modified   : June 04, 2018
 * License    : GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
class Smart_Custom_Fields_Field_Datepicker extends Smart_Custom_Fields_Field_Base {

	/**
	 * Set the required items
	 *
	 * @return array
	 */
	protected function init() {
		add_action(
			SCF_Config::PREFIX . 'before-editor-enqueue-scripts',
			array( $this, 'editor_enqueue_scripts' )
		);
		add_action(
			SCF_Config::PREFIX . 'before-settings-enqueue-scripts',
			array( $this, 'settings_enqueue_scripts' )
		);
		return array(
			'type'         => 'datepicker',
			'display-name' => __( 'Date picker', 'smart-custom-fields' ),
			'optgroup'     => 'other-fields',
		);
	}

	/**
	 * Set the non required items
	 *
	 * @return array
	 */
	protected function options() {
		return array(
			'date_format' => '',
			'max_date'    => '',
			'min_date'    => '',
			'default'     => '',
			'instruction' => '',
			'notes'       => '',
		);
	}

	/**
	 * Loading resources for editor
	 */
	public function editor_enqueue_scripts() {
		global $wp_scripts;
		$ui = $wp_scripts->query( 'jquery-ui-core' );
		wp_enqueue_style(
			'jquery.ui',
			'//ajax.googleapis.com/ajax/libs/jqueryui/' . $ui->ver . '/themes/smoothness/jquery-ui.min.css',
			array(),
			$ui->ver
		);
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script(
			SCF_Config::PREFIX . 'editor-datepicker',
			plugins_url( '../../js/editor-datepicker.js', __FILE__ ),
			array( 'jquery', 'jquery-ui-datepicker' ),
			false,
			true
		);
	}

	/**
	 * Loading resources for editor for custom field settings page
	 */
	public function settings_enqueue_scripts() {
		global $wp_scripts;
		$ui = $wp_scripts->query( 'jquery-ui-core' );

		wp_enqueue_style(
			'jquery.ui',
			'//ajax.googleapis.com/ajax/libs/jqueryui/' . $ui->ver . '/themes/smoothness/jquery-ui.min.css',
			array(),
			$ui->ver
		);

		wp_enqueue_script( 'jquery-ui-datepicker' );

		wp_enqueue_script(
			SCF_Config::PREFIX . 'settings-datepicker',
			plugins_url( SCF_Config::NAME ) . '/js/settings-datepicker.js',
			array( 'jquery', 'jquery-ui-datepicker' ),
			filemtime( plugin_dir_path( dirname( __FILE__ ) . '/../../js/settings-datepicker.js' ) ),
			true
		);
	}

	/**
	 * Getting the field
	 *
	 * @param int    $index
	 * @param string $value
	 * @return string html
	 */
	public function get_field( $index, $value ) {
		$name     = $this->get_field_name_in_editor( $index );
		$disabled = $this->get_disable_attribute( $index );
		$data_js  = $this->get_data_js();

		return sprintf(
			'<input type="text" name="%s" value="%s" class="%s" %s data-js=\'%s\' />',
			esc_attr( $name ),
			esc_attr( $value ),
			esc_attr( SCF_Config::PREFIX . 'datepicker' ),
			disabled( true, $disabled, false ),
			$data_js
		);
	}

	/**
	 * Displaying the option fields in custom field settings page
	 *
	 * @param int $group_key
	 * @param int $field_key
	 */
	public function display_field_options( $group_key, $field_key ) {
		$this->display_label_option( $group_key, $field_key );
		$this->display_name_option( $group_key, $field_key );
		?>
		<tr>
			<th><?php esc_html_e( 'Default', 'smart-custom-fields' ); ?></th>
			<td>
				<input type="text"
					name="<?php echo esc_attr( $this->get_field_name_in_setting( $group_key, $field_key, 'default' ) ); ?>"
					class="widefat default-option"
					value="<?php echo esc_attr( $this->get( 'default' ) ); ?>"
					data-js='<?php echo $this->get_data_js(); ?>' />
			</td>
		</tr>
		<tr>
			<th><?php esc_html_e( 'Date Format', 'smart-custom-fields' ); ?></th>
			<td>
				<input type="text"
					name="<?php echo esc_attr( $this->get_field_name_in_setting( $group_key, $field_key, 'date_format' ) ); ?>"
					class="widefat"
					value="<?php echo esc_attr( $this->get( 'date_format' ) ); ?>"
				/><br />
				<span class="<?php echo esc_attr( SCF_Config::PREFIX ); ?>notes">
					<?php esc_html_e( 'e.g dd/mm/yy', 'smart-custom-fields' ); ?>
					<?php
					printf(
						esc_html( 'Prease see %sdateFormat%s', 'smart-custom-fields' ),
						'<a href="http://api.jqueryui.com/datepicker/#option-dateFormat" target="_blank">',
						'</a>'
					);
					?>
				</span>
			</td>
		</tr>
		<tr>
			<th><?php esc_html_e( 'Max Date', 'smart-custom-fields' ); ?></th>
			<td>
				<input type="text"
					name="<?php echo esc_attr( $this->get_field_name_in_setting( $group_key, $field_key, 'max_date' ) ); ?>"
					class="widefat"
					value="<?php echo esc_attr( $this->get( 'max_date' ) ); ?>"
				/><br />
				<span class="<?php echo esc_attr( SCF_Config::PREFIX ); ?>notes">
					<?php esc_html_e( 'e.g +1m +1w', 'smart-custom-fields' ); ?>
					<?php
					printf(
						esc_html( 'Prease see %smaxData%s', 'smart-custom-fields' ),
						'<a href="http://api.jqueryui.com/datepicker/#option-maxDate" target="_blank">',
						'</a>'
					);
					?>
				</span>
			</td>
		</tr>
		<tr>
			<th><?php esc_html_e( 'Min Date', 'smart-custom-fields' ); ?></th>
			<td>
				<input type="text"
					name="<?php echo esc_attr( $this->get_field_name_in_setting( $group_key, $field_key, 'min_date' ) ); ?>"
					class="widefat"
					value="<?php echo esc_attr( $this->get( 'min_date' ) ); ?>"
				/><br />
				<span class="<?php echo esc_attr( SCF_Config::PREFIX ); ?>notes">
					<?php esc_html_e( 'e.g +1m +1w', 'smart-custom-fields' ); ?>
					<?php
					printf(
						esc_html( 'Prease see %sminData%s', 'smart-custom-fields' ),
						'<a href="http://api.jqueryui.com/datepicker/#option-minDate" target="_blank">',
						'</a>'
					);
					?>
				</span>
			</td>
		</tr>
		<tr>
			<th><?php esc_html_e( 'Instruction', 'smart-custom-fields' ); ?></th>
			<td>
				<textarea name="<?php echo esc_attr( $this->get_field_name_in_setting( $group_key, $field_key, 'instruction' ) ); ?>"
					class="widefat" rows="5"><?php echo esc_attr( $this->get( 'instruction' ) ); ?></textarea>
			</td>
		</tr>
		<tr>
			<th><?php esc_html_e( 'Notes', 'smart-custom-fields' ); ?></th>
			<td>
				<input type="text"
					name="<?php echo esc_attr( $this->get_field_name_in_setting( $group_key, $field_key, 'notes' ) ); ?>"
					class="widefat"
					value="<?php echo esc_attr( $this->get( 'notes' ) ); ?>"
				/>
			</td>
		</tr>
		<?php
	}

	/**
	 * Return datepicker option with json_encode
	 *
	 * @return string option with json_encode
	 */
	protected function get_data_js() {
		$js = array(
			'showMonthAfterYear' => true,
			'changeYear'         => true,
			'changeMonth'        => true,
		);

		// If locale is Japanese, change in Japanese notation
		if ( get_locale() === 'ja' ) {
			$js = array_merge(
				$js,
				array(
					'yearSuffix'      => '???',
					'dateFormat'      => 'yy-mm-dd',
					'dayNames'        => array(
						'?????????',
						'?????????',
						'?????????',
						'?????????',
						'?????????',
						'?????????',
						'?????????',
					),
					'dayNamesMin'     => array(
						'???',
						'???',
						'???',
						'???',
						'???',
						'???',
						'???',
					),
					'dayNamesShort'   => array(
						'??????',
						'??????',
						'??????',
						'??????',
						'??????',
						'??????',
						'??????',
					),
					'monthNames'      => array(
						'1???',
						'2???',
						'3???',
						'4???',
						'5???',
						'6???',
						'7???',
						'8???',
						'9???',
						'10???',
						'11???',
						'12???',
					),
					'monthNamesShort' => array(
						'1???',
						'2???',
						'3???',
						'4???',
						'5???',
						'6???',
						'7???',
						'8???',
						'9???',
						'10???',
						'11???',
						'12???',
					),
				)
			);
		}

		if ( $this->get( 'date_format' ) ) {
			$js['dateFormat'] = $this->get( 'date_format' );
		}

		if ( $this->get( 'max_date' ) ) {
			$js['maxDate'] = $this->get( 'max_date' );
		}

		if ( $this->get( 'min_date' ) ) {
			$js['minDate'] = $this->get( 'min_date' );
		}

		return json_encode( $js );
	}
}
