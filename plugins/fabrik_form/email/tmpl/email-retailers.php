<?php

/*
** functions
*/

/*
** Connects to the database and gets the extra fields and decodes json
** @content_id is the id of the content id we pull
*/
function getExtraFields($content_id)
{
  // dbo object from factory
	$db = JFactory::getDbo();

	// build the query out
	$query = $db->getQuery(true);
	$query->select('title, id, alias, extra_fields');
	$query->from('#__k2_items');
	$query->where('id='.$content_id);
	$db->setQuery($query);

	// execute and get object
	$locationRecord = $db->loadObject();

	$extraFields = json_decode($locationRecord->extra_fields);

	return $extraFields;
}

/*
** get the field label from the extra field database table
** @group_id is the id of the extra fields
*/

function getExtraFieldLabels($group_id, $usedFields) 
{
	$db = JFactory::getDbo();

  	$fieldIds = implode(',',$usedFields);

	// build the query out
	$query = $db->getQuery(true);
	$query->select('name, id');
	$query->from('#__k2_extra_fields as a');
	$query->where('a.group='.$group_id);
	$query->where('id IN (' . $fieldIds . ')');
	$query->order('ordering ASC');

	$db->setQuery($query);

	// load the name column from the query
	$extraFieldGroup = $db->loadColumn(0);

	return $extraFieldGroup;
}

/*
** take the constructed array and build an address block string
*/

function buildAddressRecord($constructedArray) // expects an array['0']->value object
{	
	$addressMarkup  = $constructedArray['Factory Location Name']->value . "<br />";
	$addressMarkup .= $constructedArray['Address']->value . "<br />";
	$addressMarkup .= $constructedArray['City']->value . " ";
	$addressMarkup .= $constructedArray['State']->value . " ";
	$addressMarkup .= $constructedArray['Zip']->value . "<br />";

	$addressMarkup .= "Phone: "   . $constructedArray['Phone']->value . "<br />";
	$addressMarkup .= "Fax:   "   . $constructedArray['Fax']->value . "<br />";

	$addressMarkup .= "Email: "   . $constructedArray['Customer Care Email']->value . "<br />";



	return $addressMarkup;
}

/*
** get the email address from the constructed array
*/

function getEmailAddress($constructedArray)
{
	return $constructedArray['Customer Care Email']->value;
}



/*
** end functions
*/

// get location id from input
$locationId   	= $this->data['tbl_warranty_claim___factory_locations_db_raw'];
$locationName 	=  $this->data['tbl_warranty_claim___factory_locations_db'];

$locationId 	= $locationId[0];
$locationName 	= $locationName[0];

$group_id = 18;

// get extra fields
$extraFields = getExtraFields($locationId);

// add all the IDs to an array so we know what labels to get
$usedFields = array();

foreach ($extraFields as $field)
{
	$usedFields[] = $field->id;
}

// get the labels
$fieldLabels = getExtraFieldLabels($group_id, $usedFields);

// array combine sets fieldLabels as array key for extraFields
$constructedArray = array_combine($fieldLabels, $extraFields);

// completed addressBlock
$addressBlock = buildAddressRecord($constructedArray);

?>

<p>
Hi <?php echo $this->data['tbl_warranty_claim___first_name']; ?>,
</p>

<p>
Thank you for submitting a warranty claim with Restonic Mattress Company.
Your claim has been submitted to <?php echo $locationName; ?> and someone will be in touch soon.
</p>

<p>
Please remember that you’ll need your original sales receipt and the law label for your warranty claim. While Restonic maintains the registry, the law label affords you warranty rights and the sales receipt validates you are the original purchaser.
If you’d like to follow up with <?php echo $locationName; ?>, please see their contact info below.
</p>

<p>
Again, thank you for contacting Restonic and allowing us to continue to service you.
</p>

<p>Sweet Dreams,
<br />
Restonic Mattress Company
</p>

<p>
<?php echo $locationName; ?>
<br />
<?php echo $addressBlock; ?>
</p>