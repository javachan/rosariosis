<?php
/**
 * Buttons functions
 *
 * @package RosarioSIS
 * @subpackage functions
 */

/**
 * Submit & Reset buttons
 *
 * @todo  use Buttons() programwide to homogenize code
 *
 * @since 3.8 Add CSS .button-primary class to submit button.
 *
 * @param  string $submit_value Submit button text.
 * @param  string $reset_value  Reset button text (optional).
 *
 * @return string Buttons HTML
 */
function Buttons( $submit_value, $reset_value = '' )
{
	$buttons = '<input type="submit" value="' . $submit_value . '" class="button-primary" />';

	if ( $reset_value )
	{
		$buttons .= ' <input type="reset" value="' . $reset_value . '" />';
	}

	return $buttons;
}


/**
 * Image button with optional text & link
 *
 * @example echo button( 'x', '', '', 'bigger' );
 *
 * @param  string $type  [type]_button.png; ie. 'remove' will display the assets/themes/[user_theme]/btn/remove_button.png image.
 * @param  string $text  button text (optional).
 * @param  string $link  button link (optional).
 * @param  string $class CSS classes (optional).
 *
 * @return string        button HTML
 */
function button( $type, $text = '', $link = '', $class = '' )
{
	$button = '';

	if ( $link )
	{
		$title = '';

		if ( $type === 'remove'
			&& ! $text )
		{
			$title = ' title="' . _( 'Delete' ) . '"';
		}

		// Dont put "" around the link href to allow Javascript code insert.
		$button .= '<a href=' . $link . $title . '>';
	}

	$button_file = 'assets/themes/' . Preferences( 'THEME' ) . '/btn/' . $type . '_button.png';

	$button .= '<img src="' . $button_file . '" class="button ' . $class . '" alt="' . ucfirst( str_replace( '_', ' ', $type ) ) . '" />';

	if ( $text )
	{
		$button .= '&nbsp;<b>' . $text . '</b>';
	}

	if ( $link )
	{
		$button .= '</a>';
	}

	return $button;
}


/**
 * Submit button if user Can Edit
 *
 * @example echo SubmitButton();
 *
 * @since 3.8 $value parameter is optional
 * @since 3.8 $options parameter defaults to 'class="button-primary"'
 *
 * @param  string $value   Button text. Defaults to _( 'Save' ) (optional).
 * @param  string $name    Button name attribute (optional).
 * @param  string $options Button options. Defaults to 'class="button-primary"' (optional).
 *
 * @return string          Button HTML, empty string if user not allowed to edit
 */
function SubmitButton( $value = '', $name = '', $options = 'class="button-primary"' )
{
	if ( AllowEdit() )
	{
		if ( $value === '' )
		{
			$value = _( 'Save' );
		}

		$name_attr = $name ? ' name="' . $name . '" ' : '';

		return '<input type="submit" value="' . $value . '" ' .
			$name_attr . $options . ' />';
	}

	return '';
}


/**
 * Reset button if user Can Edit
 *
 * @example echo ResetButton( _( 'Cancel' ) );
 *
 * @param  string $value   Button text.
 * @param  string $options Button options (optional).
 *
 * @return string          Button HTML, empty string if user not allowed to edit
 */
function ResetButton( $value, $options = '' )
{
	if ( AllowEdit() )
	{
		return '<input type="reset" value="' . $value . '" ' . $options . ' />';
	}

	return '';
}
