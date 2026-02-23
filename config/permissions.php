<?php

return [
    'modules' => [
        'dashboard' => [
            'label' => 'Dashboard',
            'actions' => ['view'],
        ],
        'assets' => [
            'label' => 'Assets',
            'actions' => ['view', 'create', 'update', 'delete', 'assign', 'upload_attachment', 'delete_attachment', 'maintenance', 'bulk', 'export', 'import'],
        ],
        'employees' => [
            'label' => 'Employees',
            'actions' => ['view', 'create', 'update', 'delete'],
        ],
        'departments' => [
            'label' => 'Departments',
            'actions' => ['view', 'create', 'update', 'delete'],
        ],
        'rooms' => [
            'label' => 'Rooms',
            'actions' => ['view', 'create', 'update', 'delete'],
        ],
        'categories' => [
            'label' => 'Categories',
            'actions' => ['view', 'create', 'update', 'delete'],
        ],
        'digital_assets' => [
            'label' => 'Digital assets',
            'actions' => ['view', 'create', 'update', 'delete', 'assign'],
        ],
        'users' => [
            'label' => 'Users',
            'actions' => ['view', 'create', 'update', 'delete'],
        ],
        'roles' => [
            'label' => 'Roles',
            'actions' => ['view', 'create', 'update', 'delete'],
        ],
        'reports' => [
            'label' => 'Reports',
            'actions' => ['view'],
        ],
    ],

    'action_labels' => [
        'view' => 'View',
        'create' => 'Create',
        'update' => 'Update',
        'delete' => 'Delete',
        'assign' => 'Assign (assets: check-out; digital: seats)',
        'upload_attachment' => 'Upload documents',
        'delete_attachment' => 'Delete documents',
        'maintenance' => 'Add maintenance logs',
        'bulk' => 'Bulk actions',
        'export' => 'Export CSV',
        'import' => 'Import CSV',
    ],
];
