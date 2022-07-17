<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CVStoreRequest extends FormRequest
{
//    protected $redirect = '/cv/edit';
//
//    protected function getRedirectUrl()
//    {
//
//        return parent::getRedirectUrl() . '/' . 1;
//    }
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
//dd($this->all());
        return [
            'work' => 'array|min:1',
            'work.*.position' => 'required|max:255',
            'work.*.employer' => 'required|max:255',
            'work.*.country' => 'max:255',
            'work.*.city' => 'max:255',
            'work.*.start_date' => 'date',
            'work.*.end_date' => 'date',
            'work.*.description' => 'nullable|max:500',
            'work.*.is_finished' => 'boolean',
            'education' => 'array|min:1',
            'education.*.institution' => 'max:255',
            'education.*.faculty' => 'max:255',
            'education.*.speciality' => 'max:255',
            'education.*.degree' => 'required|string',
            'education.*.start_date' => 'date',
            'education.*.end_date' => 'date',
            'education.*.description' => 'nullable|max:500',
            'education.*.country' => 'max:255',
            'education.*.is_finished' => 'boolean',
            'education.*.is_active' => 'boolean',

        ];
    }

//    protected function prepareForValidation()
//    {
//        $this->merge([
//            'is_finished' => $this->boolean('is_finished'),
//            'is_active' => $this->boolean('is_active'),
//        ]);
//    }


}
