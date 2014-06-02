<?php

class BulkPriceProductCSV extends Extension {

    public function onAfterProcess($record, $object) {

        // Setup bulk prices for this object
        if(isset($record['BulkPrices']) && $record['BulkPrices']) {
            $prices = explode(";",$record["BulkPrices"]);

            if(count($prices)) {
                foreach($prices as $price) {
                    $price_data = explode("=",$price);

                    // Setup new bulk price object and link
                    $bulk_price = BulkPrice::create();
                    $bulk_price->Quantity = $price_data[0];
                    $bulk_price->Price = $price_data[1];
                    $bulk_price->ParentID = $object->ID;
                    $bulk_price->write();
                }
            }
        }

    }

}
