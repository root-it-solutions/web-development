<?php

	class setting {
		var $mysql;
		var $table;
		
		function setting($mysql, $table) {
			$this->mysql = $mysql;
			$this->table = $table;
		}
		
		function get_settings($list_all = 0) {
			$sql = "SELECT
						`setting_id`,
						`setting_name`,
						`setting_value`,
						`setting_description`,
						`setting_type`
					FROM
						`" . $this->table . "`;";
			$query = $this->mysql->query($sql);
			while( $result = $query->fetch() ) {
				if( $result['setting_type'] == 'select' AND $list_all == 0 ) {
					$select_explode = explode('‡', $result['setting_value']);
					foreach( $select_explode as $select_value ) {
						if( substr_count($select_value, '†') > 0 ) {
							$settings[$result['setting_name']]['value'] = str_replace('†', '', $select_value);
							
						}
					}
					$settings[$result['setting_name']]['id'] = $result['setting_id'];
					$settings[$result['setting_name']]['type'] = $result['setting_type'];
					$settings[$result['setting_name']]['description'] = $result['setting_description'];
				} else {
					$settings[$result['setting_name']]['id'] = $result['setting_id'];
					$settings[$result['setting_name']]['value'] = $result['setting_value'];
					$settings[$result['setting_name']]['type'] = $result['setting_type'];
					$settings[$result['setting_name']]['description'] = $result['setting_description'];
				}
			}
			return $settings;
		}
		
		function save_settings($settings) {
			foreach( $settings as $array) {
				$sql = "UPDATE 
							`" . $this->table . "`
						SET
							`setting_value` = '" . mysql_escape_string($array['value']) . "'
						WHERE
							`setting_id` = '" . mysql_escape_string($array['id']) . "';";
				$query = $this->mysql->query($sql);
			}
			return;
		}
		
		function create_edit_setting() {
			$settings = $this->get_settings(1);
			if( $settings != NULL ) {
				foreach( $settings as $array) {
					switch( $array['type'] ) {
						case 'text':
							$form_field['description'][] = $array['description'];
							$form_field['format'][] = '<input type="text" name="' . $array['id'] . '" value="' . $array['value'] . '" />';
							break;
						case 'password':
							$form_field['description'][] = $array['description'];
							$form_field['format'][] = '<input type="password" name="' . $array['id'] . '" />';
							break;
						case 'radio':
							$form_field['description'][] = $array['description'];
							if( $array['value'] == 1 ) {
								$form_field['format'][] = '<input type="radio" name="' . $array['id'] . '" value="1" checked="checked" />Ja&nbsp;<input type="radio" name="' . $array['id'] . '" value="0" />Nein';
							} else {
								$form_field['format'][] = '<input type="radio" name="' . $array['id'] . '" value="1" />Ja&nbsp;<input type="radio" name="' . $array['id'] . '" value="0" checked="checked" />Nein';
							}
							break;
						case 'checkbox':
							$form_field['description'][] = $array['description'];
							if( $array['value'] == 1 ) {
								$form_field['format'][] = '<input type="checkbox" name="' . $array['id'] . '" value="1" checked="checked" />';
							} else {
								$form_field['format'][] = '<input type="radio" name="' . $array['id'] . '" value="1" />';
							}
							break;
						case 'select':
							$form_field['description'][] = $array['description'];
							$select_explode = explode('‡', $array['value']);
							$temp_select = '<select name="' . $array['id'] . '">';
							foreach( $select_explode as $select_value ) {
								if( substr_count($select_value, '†') > 0 ) {
									$temp_select .= '<option selected="selected">' . str_replace('†', '', $select_value) . '</option>';
								} else {
									$temp_select .= '<option>' . $select_value . '</option>';
								}
							}
							$temp_select .= '</select>';
							$form_field['format'][] = $temp_select;
							break;
						case 'textarea':
							$form_field['description'][] = $array['description'];
							$form_field['format'][] = '<textarea name="' . $array['id'] . '" cols="5" rows="5">' . $array['value'] . '</textarea>';
							break;
					}
				}
			}
			return $form_field;
		}
	}

?>