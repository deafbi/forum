<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Topic;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class IncrementTopicViewCount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $topicId;
    protected $userId;

    /**
     * Create a new job instance.
     */
    public function __construct($topicId, $userId = null)
    {
        $this->topicId = $topicId;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $topic = Topic::find($this->topicId);
        $user = User::find($this->userId);

        if ($topic && $user) {
            if (!$user->viewedTopics->contains($topic->id)) {
                $topic->increment('view_count');
                $user->viewedTopics()->attach($topic->id);
            }
        }
    }
}
