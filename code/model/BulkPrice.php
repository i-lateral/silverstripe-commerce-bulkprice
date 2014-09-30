<?php

/**
 * Object that represents a bulk price in the database. By default
 * this object has 2 fields:
 *
 * Quantity: the number of items needed to be purchased to qualify for
 * the new price. This can either be an Int (EG 10), a range (EG 10-19),
 * or a number or above (EG: 50+)
 *
 * Price: The number that will replace the price of the product
 * associated with this discount.
 *
 * @author i-lateral (http://www.i-lateral.com)
 * @package commerce-bulkprice
 */
class BulkPrice extends DataObject {

    private static $db = array(
        "Quantity"  => "Varchar",
        "Price"     => "Decimal"
    );

    private static $has_one = array(
        "Parent"    => "CatalogueProduct"
    );

    private static $summary_fields = array(
        "Quantity",
        "Price"
    );

    public function onBeforeWrite() {
        parent::onBeforeWrite();

        // Ensure we strip any white space from the quantity field
        $this->Quantity = str_replace(" ", "", $this->Quantity);
    }

    public function canView($member = false) {
        return $this->Parent()->canView($member);
    }

    public function canCreate($member = null) {
        return $this->Parent()->canCreate($member);
    }

    public function canEdit($member = null) {
        return $this->Parent()->canEdit($member);
    }

    public function canDelete($member = null) {
        return $this->Parent()->canDelete($member);
    }

}
