<% if $BulkPrices.exists %>
    <h2><% _t("CommerceBulkPrice.BulkPricing", "Bulk Pricing") %></h2>
    <table class="width-50">
        <tbody>
            <% loop $BulkPrices %>
                <tr>
                    <td>$Quantity</td>
                    <td>
                        {$Price.nice}
                    </td>
                </tr>
            <% end_loop %>
        </tbody>
    </table>
<% end_if %>
