<?php

class warrantyLogic
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function isRigidCenter()
    {
        $isRigidCenter = $this->data['tbl_warranty_claim_oct___rigid_center_support_raw'];
        $isRigidCenter = filter_var($isRigidCenter[0], FILTER_VALIDATE_BOOLEAN);

        return $isRigidCenter;
    }

    public function isStainFree()
    {
        $isStainFree = $this->data['tbl_warranty_claim_oct___soils_stains_raw'];
        $isStainFree = filter_var($isStainFree[0], FILTER_VALIDATE_BOOLEAN);

        return $isStainFree;
    }

    public function hasReceipt()
    {
        $hasReceipt = $this->data['tbl_warranty_claim_oct___original_receipt_raw'];
        $hasReceipt = filter_var($hasReceipt[0], FILTER_VALIDATE_BOOLEAN);

        return $hasReceipt;
    }

    public function getMattressSize()
    {
        $mattressSize = $this->data['tbl_warranty_claim_oct___mattress_size_raw'];

        // get mattress size from list array
        $mattressSize = $mattressSize[0];

        return $mattressSize;
    }

    public function needsRigidSupport()
    {
        $needsRigidSupport = false;
        $mattressSize      = $this->getMattressSize();

        // biz rules: for mattress queen and larger must have rigid support
        if ($mattressSize == 'queen' ||
            $mattressSize == 'king' ||
            $mattressSize == 'california_king'
        ) {
            $needsRigidSupport = true;
        }

        return $needsRigidSupport;
    }

    public function isValidClaim()
    {
        // default to false
        $isValidClaim      = false;
        $needsRigidSupport = $this->needsRigidSupport();

        // biz rules: must have rigid center support,
        // must have receipt, must not be soiled.
        if ($this->hasReceipt() && $this->isStainFree()) {
            $isValidClaim = true;
        }

        // if we have the right size mattress we must have a rigid center
        if ($this->isRigidCenter() && $this->needsRigidSupport()) {
            $isValidClaim = true;
        } else {
            $isValidClaim = false;
        }

        return $isValidClaim;
    }
}