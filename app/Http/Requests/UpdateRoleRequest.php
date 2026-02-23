<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('role'));
    }

    public function rules(): array
    {
        $role = $this->route('role');
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('roles', 'name')->ignore($role->id), 'regex:/^[a-z0-9_]+$/'],
            'label' => 'required|string|max:255',
            'permissions' => 'array',
            'permissions.*' => ['string', \Illuminate\Validation\Rule::in(\App\Models\Role::permissionKeys())],
        ];
    }
}
