<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public $validator = null;
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $this->validator = $validator;
    }
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
            //
            'name' => 'required|string|max:18|min:1',
            'surname' => 'required|string|max:50|min:1',
            'email' => 'required|email|max:100|min:5',
            'start_date' => 'required|after:now',
            'time' => 'required|min:0|max:4',
            'place_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'place_id.required' => 'Field cant be empty',
            'name.required' => 'Field cant be empty',
            'name.string' => 'Field must be valid word',
            'name.max' => 'Length is out of limit',
            'name.min' => 'Length is too short',
            'surname.required' => 'Field cant be empty',
            'surname.string' => 'Field must be valid word',
            'surname.max' => 'Lenght is out of limit',
            'surname.min' => 'Length is too short',
            'email.required' => 'Field cant be empty',
            'email.email' => 'Field must be email',
            'start_date.required' => 'Field cant be empty',
            'start_date.after' => 'Date cant be past',
            'time.required'=>   'Field cant be empty',
            'time.min' => 'Field cant be 0',
            'time.max' => 'Field value is out of limit'
        ];
    }
}
