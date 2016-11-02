<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'C:/wamp/www/Mirefleurs/templates/rt_xenon/gantry/theme.yaml',
    'modified' => 1477391676,
    'data' => [
        'details' => [
            'name' => 'Xenon',
            'version' => '1.0.0',
            'icon' => 'paper-plane',
            'date' => 'December  1, 2015',
            'author' => [
                'name' => 'RocketTheme, LLC',
                'email' => 'support@rockettheme.com',
                'link' => 'http://www.rockettheme.com'
            ],
            'documentation' => [
                'link' => 'http://docs.gantry.org/gantry5'
            ],
            'support' => [
                'link' => 'https://gitter.im/gantry/gantry5'
            ],
            'updates' => [
                'link' => 'http://updates.rockettheme.com/themes/xenon.yaml'
            ],
            'news' => [
                'link' => 'http://news.rockettheme.com/prime/themes.yaml'
            ],
            'copyright' => '(C) 2007 - 2015 RocketTheme, LLC. All rights reserved.',
            'license' => 'GPLv2',
            'description' => 'Xenon Theme',
            'images' => [
                'thumbnail' => 'admin/images/preset1.png',
                'preview' => 'admin/images/preset1.png'
            ]
        ],
        'configuration' => [
            'gantry' => [
                'platform' => 'joomla',
                'engine' => 'nucleus'
            ],
            'theme' => [
                'parent' => 'rt_xenon',
                'base' => 'gantry-theme://common',
                'file' => 'gantry-theme://include/theme.php',
                'class' => '\\Gantry\\Framework\\Theme'
            ],
            'fonts' => [
                'roboto' => [
                    700 => 'gantry-theme://fonts/roboto/roboto-bold/roboto-bold-webfont',
                    '700italic' => 'gantry-theme://fonts/roboto/roboto-bolditalic/roboto-bolditalic-webfont',
                    '400italic' => 'gantry-theme://fonts/roboto/roboto-italic/roboto-italic-webfont',
                    400 => 'gantry-theme://fonts/roboto/roboto-regular/roboto-regular-webfont'
                ],
                'montserrat' => [
                    700 => 'gantry-theme://fonts/montserrat/montserrat-regular/montserrat-regular-webfont',
                    400 => 'gantry-theme://fonts/montserrat/montserrat-regular/montserrat-regular-webfont'
                ]
            ],
            'css' => [
                'compiler' => '\\Gantry\\Component\\Stylesheet\\ScssCompiler',
                'target' => 'gantry-theme://css-compiled',
                'paths' => [
                    0 => 'gantry-theme://scss',
                    1 => 'gantry-engine://scss'
                ],
                'files' => [
                    0 => 'xenon',
                    1 => 'xenon-joomla',
                    2 => 'custom'
                ],
                'persistent' => [
                    0 => 'xenon'
                ],
                'overrides' => [
                    0 => 'xenon-joomla',
                    1 => 'custom'
                ]
            ],
            'block-variations' => [
                'Title Variations' => [
                    'title1' => 'Title 1',
                    'title2' => 'Title 2',
                    'title3' => 'Title 3',
                    'title4' => 'Title 4',
                    'title-grey' => 'Title Grey',
                    'title-pink' => 'Title Pink',
                    'title-red' => 'Title Red',
                    'title-purple' => 'Title Purple',
                    'title-orange' => 'Title Orange',
                    'title-blue' => 'Title Blue',
                    'title-underline' => 'Title Underline',
                    'title-inline' => 'Title Inline',
                    'title-rounded' => 'Title Rounded',
                    'g-title-bordered' => 'Title Bordered',
                    'g-title-promo' => 'Title Promo'
                ],
                'Box Variations' => [
                    'box1' => 'Box 1',
                    'box2' => 'Box 2',
                    'box3' => 'Box 3',
                    'box4' => 'Box 4',
                    'box-white' => 'Box White',
                    'box-grey' => 'Box Grey',
                    'box-pink' => 'Box Pink',
                    'box-red' => 'Box Red',
                    'box-purple' => 'Box Purple',
                    'box-orange' => 'Box Orange',
                    'box-blue' => 'Box Blue'
                ],
                'Effects' => [
                    'spaced' => 'Spaced',
                    'bordered' => 'Bordered',
                    'shadow' => 'Shadow 1',
                    'shadow2' => 'Shadow 2',
                    'rounded' => 'Rounded',
                    'square' => 'Square'
                ],
                'Utility' => [
                    'equal-height' => 'Equal Height',
                    'g-outer-box' => 'Outer Box',
                    'disabled' => 'Disabled',
                    'align-right' => 'Align Right',
                    'align-left' => 'Align Left',
                    'title-center' => 'Centered Title',
                    'center' => 'Center',
                    'nomarginall' => 'No Margin',
                    'nopaddingall' => 'No Padding'
                ]
            ]
        ],
        'admin' => [
            'styles' => [
                'core' => [
                    0 => 'base',
                    1 => 'accent',
                    2 => 'font'
                ],
                'section' => [
                    0 => 'top',
                    1 => 'navigation',
                    2 => 'header',
                    3 => 'showcase',
                    4 => 'above',
                    5 => 'utility',
                    6 => 'feature',
                    7 => 'sidebar',
                    8 => 'mainbar',
                    9 => 'aside',
                    10 => 'expanded',
                    11 => 'extension',
                    12 => 'bottom',
                    13 => 'footer',
                    14 => 'copyright',
                    15 => 'offcanvas'
                ],
                'configuration' => [
                    0 => 'breakpoints'
                ]
            ]
        ]
    ]
];
