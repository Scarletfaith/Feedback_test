<?php

namespace App\Repositories;

use App\Models\Feedback;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class FeedbackRepository
{
    public function getAll():Collection
    {
        return Feedback::query()->get();
    }

    public function lastFeedback()
    {
        $lastFeedback = Feedback::query()->where('user_id', Auth::user()->id)->latest()->firstOrNew();

        return $lastFeedback->created_at;
    }
}
