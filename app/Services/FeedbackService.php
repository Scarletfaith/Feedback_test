<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\CreateFeedbackModelInterface;
use App\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class FeedbackService
{
    private $factory;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function create(CreateFeedbackModelInterface $model)
    {
        $feedback = new Feedback();
        $feedback->title = $model->getTitle();
        $feedback->description = $model->getDescription();

        if ($model->getFile()) {
            $feedback->file = $this->saveFile($model->getFile());
        }

        $feedback->user()->associate($model->user());
        $feedback->save();

        return $feedback;
    }

    public function update($id)
    {
        $feedback = Feedback::find($id);
        $feedback->reply_at = Carbon::now();
        $feedback->save();

        return $feedback;
    }

    private function saveFile(UploadedFile $file)
    {
        $disk = $this->factory->disk('public');

        return $disk->put('/files', $file);
    }
}
