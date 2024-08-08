<?php

namespace App\Observers;

use App\Helpers\Diff;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Arr;
use App\Models\Product;
use App\Models\ProductHistory;
use Jfcherng\Diff\DiffHelper;
use Jfcherng\Diff\Renderer\RendererConstant;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        $changes = $product->getChanges();

        $original = [];

        foreach ($changes as $key => $value) {
            if ($key === 'description') {
                continue;
            }

            $original[$key] = $product->getOriginal($key);
        }

        $changedDescription = Arr::get($changes, 'description');
        $diffDescription = null;

        if ($changedDescription) {
            $oldDescription = $product->getOriginal('description');

            $diffDescription = Diff::getDiffToJson(
                old: $oldDescription,
                new: $changedDescription,
            );
        }

        Arr::forget($changes, 'description');

        ProductHistory::create([
            'product_id' => $product->id,
            'original' => JSON::encode($original),
            'changes' => JSON::encode($changes),
            'description_changes' => $diffDescription
        ]);
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
