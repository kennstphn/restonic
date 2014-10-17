<?php
/**
 * This is a sample email template. It will just print out all of the request data:
 *
 * @package     Joomla.Plugin
 * @subpackage  Fabrik.form.email
 * @copyright   Copyright (C) 2005-2013 fabrikar.com - All rights reserved.
 * @license     GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

// Alter these settings to limit what is shown in the email:

// Set this to show the raw element values.
$raw = false;

// Set this to true to show non element field values in the email e.g. "option: com_fabrik"
$info = false;

//require the getLabels function so we don't redeclare it
(include_once(__DIR__ . '/getLabels.php'));

$skip_field = array('id', 'date time')

?>
<table>
<?php
foreach ($this->data as $key => $val)
{
	// Lets see if we can get the element name:
	list($label, $thisRaw, $show) = tryForLabel($formModel, $key, $raw, $info);

	// skip certain labels in array
	if (!in_array($label, $skip_field)) {
		if (!$show)
		{
			continue;
		}
		echo '<tr><td width="40%">' . $label . '</td><td>';
		if (is_array($val)) :
			foreach ($val as $v):
				if (is_array($v)) :
					echo implode("<br>", $v);
				else:
					echo implode("<br>", $val);
				endif;
			endforeach;
		else:
			echo $val;
		endif;
		echo "</td></tr>";

	} // end if skip for certain labels
}
?>
</table>