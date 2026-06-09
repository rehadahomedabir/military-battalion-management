<?php

namespace App\Http\Requests\ParadeSchedule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateParadeScheduleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => ['required', 'exists:companies,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'parade_date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'type' => ['required', 'in:morning,evening,special,drill'],
            'location' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:scheduled,in_progress,completed,cancelled'],
            'remarks' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
