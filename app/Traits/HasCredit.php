<?php

namespace App\Traits;

trait HasCredit
{
    /**
     * Gain credit for an action.
     */
    public function gainCredit($action)
    {
        $this->increment('credit', config("forum.credit.{$action}"));
    }

    /**
     * Lose credit for an action.
     */
    public function loseCredit($action)
    {
        $this->decrement('credit', config("forum.credit.{$action}"));
    }
}
