<?php

/**
 * Extension class that adds extra "BulkDiscounts" association to an
 * object (by default a Product) and sets up an inline editing instance.
 *
 * @author i-lateral (http://www.i-lateral.com)
 * @package commerce-bulkprice
 */
class BulkPriceProduct extends DataExtension
{

    private static $has_many = array(
        "BulkPrices" => "BulkPrice"
    );

    public function updateCMSFields(FieldList $fields)
    {

        // Deal with product features
        $add_button = new GridFieldAddNewInlineButton('toolbar-header-left');
        $add_button->setTitle(_t("CommerceBulkPrice.AddDiscount", "Add Discount"));

        $bulk_field = new GridField(
            'BulkPrices',
            '',
            $this->owner->BulkPrices(),
            GridFieldConfig::create()
                ->addComponent(new GridFieldButtonRow('before'))
                ->addComponent(new GridFieldToolbarHeader())
                ->addComponent(new GridFieldTitleHeader())
                ->addComponent(new GridFieldEditableColumns())
                ->addComponent(new GridFieldDeleteAction())
                ->addComponent($add_button)
        );

        $fields->addFieldToTab('Root.BulkPrices', $bulk_field);
    }

    public function onBeforeDelete()
    {
        // Clean database before deletion
        foreach ($this->owner->BulkPrices() as $object) {
            $object->delete();
        }
    }
}
