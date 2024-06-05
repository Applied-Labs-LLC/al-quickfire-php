# REST API Endpoints

```
GET api/products
```

<details open>
    <summary>Example response</summary>

    {
        "products": [
            {
                "id": 8673483096308,
                "title": "Test Product 2",
                "body_html": "<i>Test html 2</i>",
                "vendor": "Test Vendor 2",
                "product_type": "Test Product Type 2",
                "created_at": "2024-06-05T05:44:06-04:00",
                "handle": "test-product-2",
                "updated_at": "2024-06-05T05:44:06-04:00",
                "published_at": null,
                "template_suffix": null,
                "published_scope": "web",
                "tags": "",
                "status": "draft",
                "admin_graphql_api_id": "gid://shopify/Product/8673483096308",
                "variants": [
                    {
                        "id": 45407142871284,
                        "product_id": 8673483096308,
                        "title": "Default Title",
                        "price": "0.00",
                        "sku": "",
                        "position": 1,
                        "inventory_policy": "deny",
                        "compare_at_price": null,
                        "fulfillment_service": "manual",
                        "inventory_management": null,
                        "option1": "Default Title",
                        "option2": null,
                        "option3": null,
                        "created_at": "2024-06-05T05:44:06-04:00",
                        "updated_at": "2024-06-05T05:44:06-04:00",
                        "taxable": true,
                        "barcode": null,
                        "grams": 0,
                        "weight": 0,
                        "weight_unit": "kg",
                        "inventory_item_id": 47495162036468,
                        "inventory_quantity": 0,
                        "old_inventory_quantity": 0,
                        "requires_shipping": true,
                        "admin_graphql_api_id": "gid://shopify/ProductVariant/45407142871284",
                        "image_id": null
                    }
                ],
                "options": [
                    {
                        "id": 11185660887284,
                        "product_id": 8673483096308,
                        "name": "Title",
                        "position": 1,
                        "values": [
                            "Default Title"
                        ]
                    }
                ],
                "images": [],
                "image": null
            }
        ]
    }
</details>
