<?php

namespace App\Http\Requests\Admin\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateTask extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.task.edit', $this->task);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'task_name' => ['sometimes', 'string'],
            'task_description' => ['sometimes', 'string'],
            'task_due' => ['sometimes', 'date'],
            'task_completed' => ['sometimes', 'boolean'],
            'completion_date' => ['sometimes', 'date'],
            'task_priority' => ['sometimes', 'integer'],
            'task_progress_weight' => ['sometimes', 'numeric'],
            'section_id' => ['sometimes', 'string'],
            
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
