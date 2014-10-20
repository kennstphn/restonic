<?php
/**
 * @Author  Chad Windnagle
 * @Project restonic
 * Date: 10/17/14
 */

require_once(__DIR__ . '/claim-logic.php');


$warrantyLogic = new warrantyLogic($this->data);

// call to helper function file method
$isValidClaim = $warrantyLogic->isValidClaim();

if ($isValidClaim): ?>
    <p>Valid Claim</p>
<?php else: ?>
    <p>Invalid Claim</p>
<?php endif; ?>