<?php

namespace App\Actions;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

final class CreateCategory
{
    /**
     * Create a new category.
     */
    public function handle(Request $request): Category
    {
        return DB::transaction(
            fn () => Category::query()->create(
                attributes: [
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                ],
            )
        );
    }
}
