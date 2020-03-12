<?php

return [
    '__name' => 'admin-stream-audio',
    '__version' => '0.1.0',
    '__git' => 'git@github.com:getmim/admin-stream-audio.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'modules/admin-stream-audio' => ['install','update','remove'],
        'theme/admin/stream/audio' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'admin' => NULL
            ],
            [
                'lib-form' => NULL
            ],
            [
                'lib-formatter' => NULL
            ],
            [
                'stream-audio' => NULL
            ],
            [
                'admin-site-meta' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'AdminStreamAudio\\Controller' => [
                'type' => 'file',
                'base' => 'modules/admin-stream-audio/controller'
            ]
        ],
        'files' => []
    ],
    'routes' => [
        'admin' => [
            'adminStreamAudioEdit' => [
                'path' => [
                    'value' => '/stream/audio'
                ],
                'method' => 'GET|POST',
                'handler' => 'AdminStreamAudio\\Controller\\Audio::edit'
            ]
        ]
    ],
    'adminUi' => [
        'sidebarMenu' => [
            'items' => [
                'stream' => [
                    'label' => 'Stream',
                    'icon' => '<i class="fas fa-calendar-week"></i>',
                    'priority' => 0,
                    'children' => [
                        'audio' => [
                            'label' => 'Audio',
                            'icon' => '<i></i>',
                            'route' => ['adminStreamAudioEdit'],
                            'perms' => 'manage_stream_audio'
                        ]
                    ]
                ]
            ]
        ]
    ],
    'libForm' => [
        'forms' => [
            'admin.stream-audio.edit' => [
                '@extends' => ['std-site-meta'],
                'title' => [
                    'label' => 'Title',
                    'type' => 'text',
                    'rules' => [
                        'required' => TRUE
                    ]
                ],
                'content' => [
                    'label' => 'About',
                    'type' => 'summernote',
                    'rules' => []
                ],
                'url' => [
                    'label' => 'Audio URL',
                    'type' => 'url',
                    'rules' => []
                ],
                'curr_cover' => [
                    'label' => 'Playing Cover',
                    'type' => 'image',
                    'form' => 'std-image',
                    'rules' => [
                        'upload' => TRUE
                    ]
                ],
                'curr_artist' => [
                    'label' => 'Playing Artist',
                    'type' => 'text',
                    'rules' => []
                ],
                'curr_song' => [
                    'label' => 'Playing Song',
                    'type' => 'text',
                    'rules' => []
                ],
                'meta-schema' => [
                    'options' => [
                        'RadioBroadcastService' => 'RadioBroadcastService'
                    ]
                ]
            ]
        ]
    ]
];
