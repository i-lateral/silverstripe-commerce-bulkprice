<?php

/**
 * Extension for controllers that injects bulk pricing info based on the
 * current product.
 *
 * @author i-lateral (http://www.i-lateral.com)
 * @package commerce-bulkprice
 */
class BulkPriceCatalogueController extends Extension {

    public function BulkPriceTable() {
        if($this->owner->dataRecord instanceOf Product)
            $prices = $this->owner->dataRecord->BulkPrices();
        else
            $prices = ArrayList::create();

        $vars = array(
            "BulkPrices"    => $prices,
            "SiteConfig"    => Siteconfig::current_site_config()
        );

        return $this
            ->owner
            ->renderWith("BulkPriceTable", $vars);
    }

}
