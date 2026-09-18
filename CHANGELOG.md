# What's New & Updates 🚀

All notable changes and structural updates to the backend are documented here.

## [v1.1.0] - 2026-09-18

### ➕ Added
* **New Database Schema:** Freshly imported the structural database update to support multi-layer modifications.
  
* **New Models:** Introduced 4 foundational Eloquent models mapping directly to custom keys:
  * `ProductSize`
  * `CustomisationGroup`
  * `CustomisationOption`
  * `ProductCustomisation`
    
* **New Controllers:** Added 3 backend logic handlers:
  * `ProductCustomisationController`
  * `CustomisationGroupController`
  * `ProductSizeController`
    
* **API Route Mapping:** Built and exposed core endpoint links within `routes/api.php`.
  
* **Query String Filters:** Implemented dynamic query string filters (`?search=`, `?category_id=`) directly on data collection endpoints.

### 🔄 Changed
* **Route Access Level:** Moved specific read-only lookup endpoints outside of the standard `auth:sanctum` middleware block to allow public menu retrieval.

### 🗑️ Removed
* **Legacy Paths:** Cleaned up and removed unnecessary hash paths and redundant helper functions from active controllers.
