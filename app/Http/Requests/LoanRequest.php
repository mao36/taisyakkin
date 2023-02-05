<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
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
            'lending_id' => 'required|integer',
            'borrowed_id' => 'required|integer',
            'title' => 'required|max:20',
            'money' => 'required|integer',
            'lending_on' => 'required|date|before:tomorrow',
            'due_on' => 'required|max:20|after:lending_on'
        ];
    }

    /**
     * 項目名
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'lending_id' => '借りたユーザー',
            'borrowed_id' => '貸したユーザー',
            'title' => '内容',
            'money' => '金額',
            'lending_on' => '貸出日',
            'due_on' => '期限日'
        ];
    }
}
