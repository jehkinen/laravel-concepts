<?php

namespace Concepts\TransparentCache;

use Illuminate\Support\Facades\Cache;

// 👉 “For each model, you may have a separate class to keep it to SOLID principles.”
class ProductCache
{
    public static function clearAvgReviews(int $id): void
    {
        Cache::delete("product_reviews_avg_{$id}");
    }

    public static function getAvgReviewsKey(int $id): string
    {
        return "product_reviews_avg_{$id}";
    }

    // other methods for this model for get/set cache
}
