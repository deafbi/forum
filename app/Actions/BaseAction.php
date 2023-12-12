<?php

namespace App\Actions;

use Exception;
use Illuminate\Support\Facades\DB;

abstract class BaseAction
{
    abstract protected function transact();

    public function execute()
    {
        DB::beginTransaction();

        try {
            $result = $this->transact();
            DB::commit();

            return $result;
        } catch (Exception $th) {
            DB::rollBack();
            throw new Exception("Error Processing Request", 1, $th);
        }
    }
}

// public function handle(StorePostRequest $request): Post
// {
//     return DB::transaction(
//         fn () => Post::query()->create(
//             attributes: [
//                 // ...$request->validated(),
//                 'content' => strip_tags($request->input('content')),
//                 'user_id' => auth()->id(),
//                 'topic_id' => $request->input('topic_id'),
//                 'slug' => Str::random(10),
//             ],
//         )
//     );
// }
