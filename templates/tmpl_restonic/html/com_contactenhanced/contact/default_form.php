<?php

 /**
 * @version		/** $Id: default_form.php 11845 2009-05-27 23:28:59Z robs
 * @package		com_contactenhanced
 * @copyright	Copyright (C) 2006 - 2013 IdealExtensions.com. All rights reserved.reserved.Development
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die; 
?>
<?php if (isset($this->error)) : ?>
	<div class="contact-error">
		<?php echo $this->error; ?>
	</div>
<?php endif; ?>

<div class="row">
<?php
$formWidth	= 99; 
if($this->params->get('show_sidebar')){
	$formWidth	= $formWidth - 60;
	?>
	<div class="span5 contact-sidebar">
		<?php  echo $this->loadTemplate('sidebar');  ?>
	</div>
	<?php 
}

?>
<div class="span4">
	<div class="contact-form" id="contact-form">
		<?php echo ceHelper::loadForm($this); ?>
	</div>
	<?php
		echo $this->loadTemplate('details');
	?>
</div>
<br style="clear:both" />

<?php // echo $this->loadTemplate('after_form'); ?>
</div>