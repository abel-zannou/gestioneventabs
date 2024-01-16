<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvenementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'event_name' => 'required|string',
            'event_description' => 'required',
            'event_lieu' => 'required',
            'event_datedebut' => 'required',
            'event_datefin' => 'required',
            'event_prixvote' => 'required',
            'email_organisateur' => 'required|email',
            'event_image' => 'required',
            'event_status' => 'required',
        ];
    }
}
