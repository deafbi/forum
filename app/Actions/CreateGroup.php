<?php

namespace App\Actions;

use App\Models\Group;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreGroupRequest;

final class CreateGroup
{
    /**
     * Create a new category.
     */
    public function handle(StoreGroupRequest $request): Group
    {
        return DB::transaction(
            fn () => Group::query()->create(
                attributes: $request->toArray(),
            )
        );
    }
}
