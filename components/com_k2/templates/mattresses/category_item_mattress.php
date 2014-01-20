<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 1/9/14
 * Time: 4:16 PM
 */

$raw_fields = json_decode($this->item->extra_fields);

$extrafields = array();

if (count($raw_fields)) {
	foreach($raw_fields as $item) {
		$extrafields[$item->id] = $item->value;
	}
}
?>


<div class="library-item">
	<div class="library-item-logo">
		<img src="<?php echo $extrafields[93]; ?>" />
	</div>
	<div class="libray-item-image">
		<?php if ($extrafields[95]): ?>
		<a href="<?php echo $extrafields[95]; ?>">
			<img src="<?php echo $extrafields[92]; ?>" />
		</a>
		<?php else: ?>
			<img src="<?php echo $extrafields[92]; ?>" />
		<?php endif; ?>
	</div>
</div>