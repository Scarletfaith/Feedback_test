<?php

namespace App\Http\Requests;

use App\Contracts\CreateFeedbackModelInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class StoreRequest extends FormRequest implements CreateFeedbackModelInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'file' => ['nullable', 'file']
        ];
    }

    public function getTitle(): string
    {
        return $this->input('title');
    }

    public function getDescription(): string
    {
        return $this->input('description');
    }

    public function getFile(): ?UploadedFile
    {
        return $this->file('file');
    }
}
