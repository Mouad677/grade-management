<?php

return [
    'roles' => [
        'admin' => [
            'dashboard.view',
            'users.manage',
            'grades.upload',
            'logs.view',
            'profile.view',
            'profile.edit',
        ],
        'assistant' => [
            'dashboard.view',
            'grades.upload',
            'profile.view',
            'profile.edit',
        ],
        'student' => [
            'profile.view',
            'profile.edit',
            'grades.view',
        ],
    ],
];
