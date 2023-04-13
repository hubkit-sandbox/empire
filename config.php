<?php

// See https://www.park-manager.com/hubkit/config.html

return [
    'branches' => [
        '1.0' => [
            'sync-tags' => true,
            'split' => [
                'src/Module/CoreModule' => [
                    'url' => 'git@github.com:hubkit-sandbox/core-module.git',
                    'sync-tags' => null,
                ],
                'src/Module/WebhostingModule' => [
                    'url' => 'git@github.com:hubkit-sandbox/webhosting-module.git',
                    'sync-tags' => null,
                ],
                'docs' => [
                    'url' => 'git@github.com:hubkit-sandbox/docs.git',
                    'sync-tags' => null,
                ],
                'noop' => [
                    'url' => 'git@github.com:hubkit-sandbox/noop.git',
                    'sync-tags' => null,
                ],
            ],
            'upmerge' => true,
            'ignore-default' => false,
        ],
        '2.x' => [
            'sync-tags' => false,
            'split' => [
                'src/Module/CoreModule' => [
                    'url' => 'git@github.com:hubkit-sandbox/core-module.git',
                    'sync-tags' => null,
                ],
                'src/Module/WebhostingModule' => [
                    'url' => 'git@github.com:hubkit-sandbox/webhosting-module.git',
                    'sync-tags' => null,
                ],
                'docs' => [
                    'url' => 'git@github.com:hubkit-sandbox/docs.git',
                    'sync-tags' => null,
                ],
                'bloop' => [
                    'url' => false,
                    'sync-tags' => null,
                ],
            ],
            'upmerge' => true,
            'ignore-default' => false,
        ],
    ],
];
