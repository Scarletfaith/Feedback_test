<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Http\UploadedFile;

interface CreateFeedbackModelInterface
{
    public function getTitle(): string;

    public function getDescription(): string;

    public function getFile(): ?UploadedFile;
}
