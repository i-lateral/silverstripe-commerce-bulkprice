Silverstripe Commerce Bulk Price
================================

Extension to silverstripe commerce module that allows you to alter a
product's price when added to the cart, if a certain number of that
product are added.

## Author

This module is created and maintained by
[ilateral](http://www.i-lateral.com)

Contact: morven@i-lateral.com

## Dependancies

* SilverStripe Framework 3.1.x
* Silverstripe Commerce

## Installation

Install this module either by downloading and adding to:

[silverstripe-root]/commerce-bulkdiscounts

Then run: dev/build/?flush=all

Or alternativly add to your project's composer.json

## Usage

Once installed, you can navigate to a product in the admin and add bulk
pricing under the "Bulk Prices" tab.

Each bulk price has 2 fields:

* Quantity: The quantitiy of items needing to be purchased to qualify
for the new price. This can be either a range (eg: 10-19), a fixed
number (eg: 10) or an amount over a certain number (eg: 30+).
* Price: The price that this bulk item will be charged at.

Once you have added this information and saved, it will be automatically
used by the shopping cart when the relevent item is added with the
specified quantity.

### Adding a bulk price table to your product template

This module adds a variable to your catalogue controller that generates
a table of bulk prices. This variable is:

    $BulkPriceTable

Adding this variable to your product template will generate a table of
pricing options.

**Note** If you want to customise this table, you can overwrite the
*BulkPriceTable.ss* template file.
