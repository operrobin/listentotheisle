<?php

namespace App\Http\Requests\Admin\StreamerCommunity;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreStreamerCommunity extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.streamer-community.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'streamer_name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'twitch_url' => ['required', 'string'],
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
