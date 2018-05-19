<?php

return [
    'fields' => [
        'name'    => 'Name',
        'file'    => 'File',
        'content' => 'Content',
    ],
    'pages'  => [
        'create' => [
            'title'   => 'Create Page',
            'buttons' => [
                'create' => 'Create',
            ],
        ],
        'edit'   => [
            'title'   => 'Edit Post',
            'buttons' => [
                'update' => 'Update',
            ],
        ],
        'show'   => [
            'buttons' => [
                'edit'    => 'Edit',
                'destroy' => 'Delete',
            ],
        ],
        'index' => [
            'buttons' => [
                'read_more'    => 'Read more ...',
            ],
        ],
    ]
];
