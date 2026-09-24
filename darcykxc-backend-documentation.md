# API Documentation ☕

> All endpoints require an Authorization: Bearer <token> header except POST /api/login and all GET endpoints.

Product
* [GET /api/products](#get-apiproducts)
* [GET /api/products/{product}](#get-apiproductsproduct)
* [POST /api/products](#post-apiproducts)
* [PATCH /api/products/{product}](#patch-apiproductsproduct)
* [DELETE /api/products/{product}](#delete-apiproductsproduct)

ProductSize
* [GET /api/products/{product}/sizes](#get-apiproductsproductsizes)
* [POST /api/products/{product}/sizes](#post-apiproductsproductsizes)
* [PATCH /api/product-sizes/{productSize}](#patch-apiproduct-sizesproductsize)
* [DELETE /api/product-sizes/{productSize}](#delete-apiproduct-sizesproductsize)

ProductCustomisation
* [GET /api/products/{product}/customisations](#get-apiproductsproductcustomisations)
* [POST /api/products/{product}/customisations](#post-apiproductsproductcustomisations)
* [DELETE /api/products/{product}/customisations/{groupId}](#delete-apiproductsproductcustomisationsgroupid)

CustomisationGroup
* [GET /api/customisations](#get-apicustomisations)
* [POST /api/customisations](#post-apicustomisations)
* [PATCH /api/customisations/{group:group_id}](#patch-apicustomisationsgroupgroup_id)
* [DELETE /api/customisations/{group:group_id}](#delete-apicustomisationsgroupgroup_id)

Category
* [GET /api/categories](#get-apicategories)
* [GET /api/categories/{category}](#get-apicategoriescategory)
* [POST /api/categories](#post-apicategories)
* [PATCH /api/categories/{category}](#patch-apicategoriescategory)
* [DELETE /api/categories/{category}](#delete-apicategoriescategory)

InventoryItem
* [GET /api/inventory-items](#get-apiinventoryitems)
* [GET /api/inventory-items/{inventory_item}](#get-apiinventoryitemsinventory_item)
* [POST /api/inventory-items](#post-apiinventoryitems)
* [PATCH /api/inventory-items/{inventory_item}](#patch-apiinventoryitemsinventory_item)
* [DELETE /api/inventory-items/{inventory_item}](#delete-apiinventoryitemsinventory_item)

Authentication
* [POST /api/login](#post-apilogin)
* [POST /api/logout](#post-apilogout)

---

## GET /api/products

Returns a list of all products in the database.

Query Parameters:
* **search** (optional): Search term to find products by name.
* **category_id** (optional): Filter products by category ID.
* **product_status** (optional): Filter products by status (e.g. `Available`).

Status Code: `200 OK`

Response:
```json
[
  {
    "product_id": number,
    "category_id": number,
    "product_name": string,
    "description": string,
    "selling_price": string,
    "cost_price": string,
    "reorder_level": number,
    "product_status": enum
  }
]
```

## GET /api/products/{product}

Returns the details of a single product.

URL Parameters:
* **product** (integer, required): ID of the product.

Status Code: `200 OK`

Response:
```json
{
  "product_id": number,
  "category_id": number,
  "product_name": string,
  "description": string,
  "selling_price": string,
  "cost_price": string,
  "reorder_level": number,
  "product_status": enum
}
```

## POST /api/products

Adds a new product item into the database.

Request Body:
```json
{
  "category_id": number,
  "product_name": string,
  "description": string,
  "selling_price": string,
  "cost_price": string,
  "reorder_level": number,
  "product_status": enum
}
```

Status Code: `201 Created`

Response:
```json
{
  "message": "Product created successfully!",
  "data": {
    "product_id": number,
    "category_id": number,
    "product_name": string,
    "description": string,
    "selling_price": string,
    "cost_price": string,
    "reorder_level": number,
    "product_status": enum
  }
}
```

## PATCH /api/products/{product}

Updates an existing product item in the database.

URL Parameters:
* **product** (integer, required): ID of the target product.

Request Body:
```json
{
  "category_id": number,
  "product_name": string,
  "description": string,
  "selling_price": string,
  "cost_price": string,
  "reorder_level": number,
  "product_status": enum
}
```

Status Code: `200 OK`

Response:
```json
{
  "message": "Product updated successfully!",
  "data": {
    "product_id": number,
    "category_id": number,
    "product_name": string,
    "description": string,
    "selling_price": string,
    "cost_price": string,
    "reorder_level": number,
    "product_status": enum
  }
}
```

## DELETE /api/products/{product}

Deletes an existing product item from the database.

URL Parameters:
* **product** (integer, required): ID of the product to delete.

Status Code: `200 OK`

Response:
```json
{
  "message": "Product deleted successfully!"
}
```

---

## GET /api/products/{product}/sizes

Returns all available sizes and pricing configurations for a specific product.

URL Parameters:
* **product** (integer, required): ID of the product.

Status Code: `200 OK`

Response:
```json
[
  {
    "size_id": number,
    "product_id": number,
    "size_label": string,
    "price": string
  }
]
```

## POST /api/products/{product}/sizes

Adds a new size configuration to a specific product.

URL Parameters:
* **product** (integer, required): ID of the product.

Request Body:
```json
{
  "size_label": string,
  "price": string
}
```

Status Code: `201 Created`

Response:
```json
{
  "message": "Size added!",
  "data": {
    "product_id": number,
    "size_id": number,
    "size_label": string,
    "price": string
  }
}
```

## PATCH /api/product-sizes/{productSize}

Updates an existing size configuration.

URL Parameters:
* **productSize** (integer, required): ID of the product size entry (`size_id`).

Request Body:
```json
{
  "size_label": string,
  "price": string
}
```

Status Code: `200 OK`

Response:
```json
{
  "message": "Size updated!",
  "data": {
    "product_id": number,
    "size_id": number,
    "size_label": string,
    "price": string
  }
}
```

## DELETE /api/product-sizes/{productSize}

Deletes an existing size configuration.

URL Parameters:
* **productSize** (integer, required): ID of the product size entry (`size_id`).

Status Code: `200 OK`

Response:
```json
{
  "message": "Size deleted!"
}
```

---

## GET /api/products/{product}/customisations

Returns the customization groups and selectable options linked to a product.

URL Parameters:
* **product** (integer, required): ID of the product.

Status Code: `200 OK`

Response:
```json
[
  {
    "group_id": number,
    "group_name": string,
    "selection_type": enum,
    "is_required": boolean,
    "options": [
      {
        "option_id": number,
        "option_name": string
      }
    ]
  }
]
```

## POST /api/products/{product}/customisations

Links a product to a customization group.

URL Parameters:
* **product** (integer, required): ID of the product.

Request Body:
```json
{
  "group_id": number
}
```

Status Code: `201 Created` (or `200 OK` if already linked)

Response:
```json
{
  "message": "Group linked to product!"
}
```

## DELETE /api/products/{product}/customisations/{groupId}

Unlinks a customization group from a product.

URL Parameters:
* **product** (integer, required): ID of the product.
* **groupId** (integer, required): ID of the customization group.

Status Code: `200 OK`

Response:
```json
{
  "message": "Group unlinked from product!"
}
```

---

## GET /api/customisations

Returns all customisation groups and each of their options.

Status Code: `200 OK`

Response:

```json
[
   {
        "group_id": number,
        "group_name": string,
        "selection_type": enum,
        "is_required": boolean,
        "options": [
            {
                "option_id": number,
                "group_id": number,
                "option_name": string,
                "additional_cost": string
            }
        ]
    }
]
```

## POST /api/customisations

Creates a new customisation group.

Request Body:

```json
{
  "group_name": string,
  "selection_type": enum,
  "is_required": boolean
}
```

Status Code: `201 Created`

Response:

```json
{
    "message": "Group created!",
    "data": {
        "group_name": string,
        "selection_type": enum,
        "is_required": boolean,
        "group_id": number
    }
}
```

## PATCH /api/customisations/{group:group_id}

Updates an existing customisation group.

URL Parameters:
* **group:group_id** (integer, required): ID of the group.

Request Body:
```json
{
    "group_name": string,
    "selection_type": enum,
    "is_required": boolean
}
```

Status Code: `200 OK`

Response:
```json
{
    "message": "Group updated!",
    "data": {
        "group_id": number,
        "group_name": string,
        "selection_type": enum,
        "is_required": boolean
    }
}
```

## DELETE /api/customisations/{group:group_id}

Deletes a customisation group.

URL Parameters:
* **group:group_id** (integer, required): ID of the group.

Status Code: `200 OK`

Response:
```json
{
    "message": "Group deleted!"
}
```

---

## GET /api/categories

Returns a list of all operational menu categories.

Query Parameters:
* **search** (optional): Search term to filter categories by name.

Status Code: `200 OK`

Response:
```json
[
  {
    "category_id": number,
    "category_name": string,
    "description": string
  }
]
```

## GET /api/categories/{category}

Returns details of a single category.

URL Parameters:
* **category** (integer, required): ID of the category.

Status Code: `200 OK`

Response:
```json
{
  "category_id": number,
  "category_name": string,
  "description": string
}
```

## POST /api/categories

Creates a new category.

Request Body:
```json
{
  "category_name": string,
  "description": string
}
```

Status Code: `201 Created`

Response:
```json
{
  "message": "Category created successfully!",
  "data": {
    "category_id": number,
    "category_name": string,
    "description": string
  }
}
```

## PATCH /api/categories/{category}

Updates an existing category.

URL Parameters:
* **category** (integer, required): ID of the category.

Request Body:
```json
{
  "category_name": string,
  "description": string
}
```

Status Code: `200 OK`

Response:
```json
{
  "message": "Category updated successfully!",
  "data": {
    "category_id": number,
    "category_name": string,
    "description": string
  }
}
```

## DELETE /api/categories/{category}

Deletes an existing category.

URL Parameters:
* **category** (integer, required): ID of the category to delete.

Status Code: `200 OK`

Response:
```json
{
  "message": "Category deleted successfully!"
}
```

---

## GET /api/inventory-items

Returns all inventory stock records across branches.

Query Parameters:

* **product_id** (optional): Filter inventory items by product ID.
* **branch_id** (optional): Filter inventory items by branch ID.
* **inventory_status** (optional): Filter inventory items by status (e.g. `Available`, `Low Stock`, `Out of Stock`).

Status Code: `200 OK`

Response:
```json
[
  {
    "inventory_item_id": number,
    "branch_id": number,
    "product_id": number,
    "quantity_on_hand": number,
    "last_restocked": string,
    "inventory_status": enum
  }
]
```

## GET /api/inventory-items/{inventory_item}

Returns details for a single inventory record.

URL Parameters:
* **inventory_item** (integer, required): ID of the inventory item.

Status Code: `200 OK`

Response:
```json
{
  "inventory_item_id": number,
  "branch_id": number,
  "product_id": number,
  "quantity_on_hand": number,
  "last_restocked": string,
  "inventory_status": enum
}
```

## POST /api/inventory-items

Creates a new inventory record for a branch.

Request Body:
```json
{
  "branch_id": number,
  "product_id": number,
  "quantity_on_hand": number,
  "last_restocked": string,
  "inventory_status": enum
}
```

Status Code: `201 Created`

Response:
```json
{
  "message": "Inventory item created successfully.",
  "data": {
    "inventory_item_id": number,
    "branch_id": number,
    "product_id": number,
    "quantity_on_hand": number,
    "last_restocked": string,
    "inventory_status": enum
  }
}
```

## PATCH /api/inventory-items/{inventory_item}

Updates an existing inventory record.

URL Parameters:
* **inventory_item** (integer, required): ID of the inventory item.

Request Body:
```json
{
  "branch_id": number,
  "product_id": number,
  "quantity_on_hand": number,
  "last_restocked": string,
  "inventory_status": enum
}
```

Status Code: `200 OK`

Response:
```json
{
  "message": "Inventory item updated successfully.",
  "data": {
    "inventory_item_id": number,
    "branch_id": number,
    "product_id": number,
    "quantity_on_hand": number,
    "last_restocked": string,
    "inventory_status": enum
  }
}
```

## DELETE /api/inventory-items/{inventory_item}

Deletes an inventory record.

URL Parameters:
* **inventory_item** (integer, required): ID of the inventory item to delete.

Status Code: `200 OK`

Response:
```json
{
  "message": "Inventory deleted!"
}
```

---

## POST /api/login

Authenticates an employee and issues an API Sanctum plain-text token.

Request Body:
```json
{
  "employee_id": string,
  "pin_code": string
}
```

Status Code: `200 OK`

Response:
```json
{
  "token": string
}
```

## POST /api/logout

Revokes the authenticated token and logs the user out.

Status Code: `200 OK`

Response:
```json
{
  "message": "Logged out successfully"
}
```