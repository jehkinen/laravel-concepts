### Transparent Cache Concept

### ✨ Why Use It?
In large applications, caching is essential for improving performance.
However, managing cache keys manually can be messy and lead to inconsistencies.
This concept ensures that:
- **You can quickly find where cache is set and invalidated**
- **Cache keys are predictable and structured**
- **Clearing cache is straightforward**

####
Instead of hardcoding cache keys everywhere, we define **getter methods** for cache keys and **clear methods** to remove outdated data.

###  Key Naming Convention
Each cached entity has structured key methods to ensure consistency:
```php
public static function getSomeDataKey(int $id): string
```
This makes it easy to locate where a cache is being read.

###  Cache Invalidation
Clearing cache is just as important as setting it. Each key has a corresponding **clear method**:
```php
public static function clearSomeDataCache(int $id): void
```
This ensures that cache is removed in all necessary places when data updates.


### Example

```php
// For example, we have a product service where we calculate the average review rating for a product.
class ProductService
{
    public function getReviewsAvg(Product $product)
    {
        return Cache::remember(ProductCache::getAvgReviewsKey($product->id), 60, function () {
            // Logic to calculate the average rating for product reviews.
        });
    }
}

// Another module where a customer adds a review.
class CustomerReviewService
{
    // For example, when a customer adds a new review, we reset the cached average rating.
    public function addReview(Product $product, float $rating)
    {
        $product->customerReviews()->create(['rating' => $rating]);
        ProductCache::clearAvgReviews($product->id);
    }
}
```
### 🐸 **Benefits**
- **Easier Debugging** – Need to find where a cache is stored, so you can trigger find `Find Usages`
- **Cleaner Code** – No magic strings for cache keys, making refactoring safer.
- **Automatic Cache Control** – Standardized key structure ensures no stale data lingers.

