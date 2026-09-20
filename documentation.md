# Backend API Documentation

## Base URL

```text
http://127.0.0.1:8000/api
```

> Use the IP address and port where your Laravel server is running.

---

# 1. Employee API

The Employee API is used for employee authentication and managing employee login information.

## Employee Information

| Field               | Description                 |
| ------------------- | --------------------------- |
| `employee_id`       | Unique employee identifier  |
| `first_name`        | Employee's first name       |
| `last_name`         | Employee's last name        |
| `position`          | Employee's position         |
| `phone_number`      | Employee's phone number     |
| `hire_date`         | Employee's hire date        |
| `employment_status` | Current employment status   |
| `pin_code`          | Employee authentication PIN |

> The `pin_code` should be stored as a hashed value in the database rather than as plain text.

## Login

**Method:**

```http
POST
```

**Endpoint:**

```text
/api/login
```

**Full URL:**

```text
http://127.0.0.1:8000/api/login
```

### Description

Authenticates an employee using their employee ID and PIN code.

### Example Request

```http
POST /api/login
```

### Example JSON Body

```json
{
    "employee_id": "EMP001",
    "pin_code": "12345"
}
```

### Authentication

No authentication is required to access the login endpoint.

---

# 2. Inventory Item API

The Inventory Item API is used to manage the inventory of products.

## Endpoints

| Method   | Endpoint                | Description              |
| -------- | ----------------------- | ------------------------ |
| `GET`    | `/inventory-items`      | Get all inventory items  |
| `GET`    | `/inventory-items/{id}` | Get one inventory item   |
| `POST`   | `/inventory-items`      | Create an inventory item |
| `PUT`    | `/inventory-items/{id}` | Update an inventory item |
| `DELETE` | `/inventory-items/{id}` | Delete an inventory item |

---

## 2.1 Get All Inventory Items

**Method:**

```http
GET
```

**Endpoint:**

```text
/api/inventory-items
```

**Full URL:**

```text
http://127.0.0.1:8000/api/inventory-items
```

### Description

Retrieves all inventory items from the database.

### Example Request

```http
GET /api/inventory-items
```

---

## 2.2 Get One Inventory Item

**Method:**

```http
GET
```

**Endpoint:**

```text
/api/inventory-items/{id}
```

### Description

Retrieves a specific inventory item using its ID.

### Example Request

```http
GET /api/inventory-items/1
```

In this example, `1` represents the inventory item's ID.

---

## 2.3 Create Inventory Item

**Method:**

```http
POST
```

**Endpoint:**

```text
/api/inventory-items
```

### Description

Creates a new inventory item in the database.

### Example Request

```http
POST /api/inventory-items
```

### Example JSON Body

```json
{
    "branch_id": 1,
    "product_id": 1,
    "quantity_on_hand": 50,
    "last_restocked": "2026-09-19 09:00:00",
    "inventory_status": "Available"
}
```

---

## 2.4 Update Inventory Item

**Method:**

```http
PUT
```

**Endpoint:**

```text
/api/inventory-items/{id}
```

### Description

Updates an existing inventory item using its ID.

### Example Request

```http
PUT /api/inventory-items/1
```

### Example JSON Body

```json
{
    "branch_id": 1,
    "product_id": 1,
    "quantity_on_hand": 75,
    "last_restocked": "2026-09-19 09:00:00",
    "inventory_status": "Available"
}
```

---

## 2.5 Delete Inventory Item

**Method:**

```http
DELETE
```

**Endpoint:**

```text
/api/inventory-items/{id}
```

### Description

Deletes an inventory item using its ID.

### Example Request

```http
DELETE /api/inventory-items/1
```

---

# 3. Endpoint Summary

|  # | Method   | Endpoint                    | Operation               |
| -: | -------- | --------------------------- | ----------------------- |
|  1 | `POST`   | `/api/login`                | Employee login          |
|  2 | `GET`    | `/api/inventory-items`      | Get all inventory items |
|  3 | `GET`    | `/api/inventory-items/{id}` | Get one inventory item  |
|  4 | `POST`   | `/api/inventory-items`      | Create inventory item   |
|  5 | `PUT`    | `/api/inventory-items/{id}` | Update inventory item   |
|  6 | `DELETE` | `/api/inventory-items/{id}` | Delete inventory item   |

---

# 4. HTTP Methods

| Method   | Purpose                                                |
| -------- | ------------------------------------------------------ |
| `GET`    | Retrieve data                                          |
| `POST`   | Create a new record or perform an action such as login |
| `PUT`    | Update an existing record                              |
| `DELETE` | Delete an existing record                              |

---

# 5. URL Structure

For inventory collections:

```text
/api/inventory-items
```

For a specific inventory item:

```text
/api/inventory-items/{id}
```

For employee authentication:

```text
/api/login
```

The `{id}` value is replaced with the ID of the inventory item being accessed.
