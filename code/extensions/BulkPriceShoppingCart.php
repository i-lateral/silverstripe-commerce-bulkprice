<?php

/**
 * Extension class responsible for updating the price of items in the
 * shopping cart, based on any bulk discounts set via the admin
 *
 * @author i-lateral (http://www.i-lateral.com)
 * @package commerce-bulkprice
 */
class BulkPriceShoppingCart extends Extension {

    private function calculate_bulk_price(Product $product, $quantity) {
        foreach($product->BulkPrices() as $bulk_price) {
            $range = array();

            // Determine whaty type of price we are dealing with
            if(strpos($bulk_price->Quantity,"-") !== false) { // We are looking for a range
                $range = explode("-", $bulk_price->Quantity);
            } elseif(strpos($bulk_price->Quantity,"+") !== false) { // We are looking this number or greater
                $range[0] = str_replace("+", "", $bulk_price->Quantity);
                $range[1] = -1; // -1 means no upper limit
            } else { // Assume we are dealing with a single price
                $range[0] = $bulk_price->Quantity;
                $range[1] = $bulk_price->Quantity;
            }

            // Now cast quantities correctly
            $range[0] = (int)$range[0];
            $range[1] = (int)$range[1];

            // Finally check if the current quantity sits in the
            // current range and amend price
            if(
                ($range[1] == -1 && $quantity >= $range[0]) ||
                ($quantity >= $range[0] && $quantity <= $range[1])
            )
                return $bulk_price->Price;
        }

        // If nothing has returned, return default price
        return $product->Price;
    }

    /**
     * Calculate the item price, based on any bulk discounts set
     */
    public function onBeforeAdd($item) {
        if($product = Product::get()->byID($item->ProductID))
            $item->Price = $this->calculate_bulk_price($product, $item->Quantity);
    }

    /**
     * Calculate the item price, based on any bulk discounts set
     */
    public function onAfterUpdate($item) {
        if($product = Product::get()->byID($item->ProductID))
            $item->Price = $this->calculate_bulk_price($product, $item->Quantity);
    }

}
