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

        return [
            'work' => 'array|min:1',
            'work.*.position' => 'required|max:255',
            'work.*.employer' => 'required|max:255',
            'work.*.country' => 'nullable|max:255',
            'work.*.city' => 'nullable|max:255',
            'work.*.start_date' => 'nullable|date',
            'work.*.end_date' => 'nullable|date',
            'work.*.description' => 'nullable|max:500',
            'work.*.is_finished' => 'boolean',
            'education' => 'array|min:1',
            'education.*.institution' => 'required|max:255',
            'education.*.faculty' => 'nullable|max:255',
            'education.*.speciality' => 'nullable|max:255',
            'education.*.degree' => 'required|string',
            'education.*.start_date' => 'nullable|date',
            'education.*.end_date' => 'nullable|date',
            'education.*.description' => 'nullable|max:500',
            'education.*.country' => 'max:255',
            'education.*.is_finished' => 'boolean',
            'education.*.is_active' => 'boolean',

        ];
    }

    protected function prepareForValidation()
    {


        // Remove empty arrays from request
        foreach ($this->work as $array) {
            if (is_array($array) && $array['position'] == null) {
                $this->offsetUnset('work');
            }
        }

        foreach ($this->education as $array) {
            if (is_array($array) && $array['institution'] == null) {
                $this->offsetUnset('education');
            }
        }

    }

}
