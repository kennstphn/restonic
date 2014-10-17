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

// build mattress statement
$mattress  		 	 = $this->data['tbl_warranty_registration___mattress_size'];
$mattress 			.= " ";
$mattress			.= $this->data['tbl_warranty_registration___model_purchased'];

// concat the purchase date info
$purchase_date		 = $this->data['tbl_warranty_registration___purchase_month'];
$purchase_date		.= " ";
$purchase_date		.= $this->data['tbl_warranty_registration___purchase_year'];

// concat retailer location info
$purchase_location	 = $this->data['tbl_warranty_registration___name_of_retailer'];
$purchase_location	.= " in ";
$purchase_location	.= $this->data['tbl_warranty_registration___retailer_city'] . ", ";
$purchase_location	.= $this->data['tbl_warranty_registration___retailer_state'];

?>

<p>Hi <?php echo $this->data['tbl_warranty_registration___first_name']?>,</p>

<p>Thank you for registering your Restonic purchase with us today.</p>
<!-- smart logic pending on foundation purchase -->
<?php if ($this->data['tbl_warranty_registration___foundation_purchased'] == 'Yes'): ?>
	<p>
		You have registered a <?php echo $mattress; ?> mattress and box spring or foundation,
		purchased in <?php echo $purchase_date; ?> from <?php echo $purchase_location; ?>.
	</p>
<?php else: ?>
	<p>
		You have registered a <?php echo $mattress; ?>,
		purchased in <?php echo $purchase_date; ?> from <?php echo $purchase_location; ?>.
	</p>
<?php endif; ?>

<p>
	If you would like to discuss your purchase with someone from Restonic, please forward 
	this email, with any additional information you'd like to share, to the manufacturer 
	listed on the law label of your mattress. Once you've identified the manufacturer, you 
	can find their contact information on our website at: 
</p>

<p>
	<a href="http://www.restonic.com/find-manufacturer" target="_blank">
		http://www.restonic.com/find-manufacturer
	</a>
</p>

<p>
	Also, please remember to keep your original sales receipt and the law label for the life 
	of your bed. While Restonic maintains the registry, the law label affords you 
	warranty rights and the sales receipt validates you are the original purchaser.
</p>

<p>
	Again, thank you for purchasing Restonic. 
</p>

<p>
	Sweet Dreams,<br />
	Restonic Mattress Company
</p>