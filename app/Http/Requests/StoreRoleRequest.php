<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', \App\Models\Role::class);
    }

    public function rules(): array
    {
        $keys = \App\Models\Role::permissionKeys();
        return [
            'name' => 'required|string|max:255|unique:roles,name|regex:/^[a-z0-9_]+$/',
            'label' => 'required|string|max:255',
            'permissions' => 'array',
            'permissions.*' => ['string', Rule::in($keys)],
        ];
    }
}
