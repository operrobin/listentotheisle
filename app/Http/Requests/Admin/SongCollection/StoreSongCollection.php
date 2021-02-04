<?php

namespace App\Http\Requests\Admin\SongCollection;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreSongCollection extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.song-collection.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'song_name' => ['required', 'string'],
            'song_description' => ['required', 'string'],
            'artist_id' => ['required', 'string'],
            'soundcloud_url' => ['nullable', 'string'],
            'mixcloud_url' => ['nullable', 'string'],
            'website_url' => ['nullable', 'string'],
            'published_at' => ['required', 'date'],
            
        ];
    }

    /**
    * Modify input data
    *
    * @return array
    */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();

        //Add your code for manipulation with request data here

        return $sanitized;
    }
}
