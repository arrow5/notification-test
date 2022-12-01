<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NotificationRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'inspection_period' => 'required|integer',
            'count_page' => 'required|integer',
            'idealita_active' => 'accepted',
            'idealista_url' => [Rule::requiredIf(function (){return $this->request->get('idealita_active') == true;}),'nullable','string','max:255'],
            'olx_active' => 'accepted',
            'olx_url' => [Rule::requiredIf(function (){return $this->request->get('olx_active') == true;}),'nullable','string','max:255'],
            'fb_active' => 'accepted',
            'fb_url' => [Rule::requiredIf(function (){return $this->request->get('fb_active') == true;}),'nullable','string','max:255'],
            'notification_type_id' => 'required|integer|exists:notification_types,id',
        ];
    }
}
