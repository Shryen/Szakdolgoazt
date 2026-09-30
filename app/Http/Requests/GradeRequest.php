<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class GradeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // megnézzük, hogy admin vagy teacher-e
        /* 
        $roles = ['admin', 'teacher'];
        $user = auth()->user();

        foreach ($roles as $role) {
            if ($user->role == $role) {
                return true;
            }
        }

            return false;
        */

        // az in_array nem teljesen ugyanazt csinálja, mint a fenti kód, de valami hasonló a lényeg. Ha az illető diák nem engedjük tovább.
        return in_array(auth()->user()->role->value, ['admin', 'teacher']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'student_id' => 'required|integer|exists:users,id',
            'subject_id' => 'required|integer|exists:subjects,id',
            'month' => 'required',
            'grade_value' => 'required|integer|between:1,5',
            'description' => 'required'
        ];
    }
}
