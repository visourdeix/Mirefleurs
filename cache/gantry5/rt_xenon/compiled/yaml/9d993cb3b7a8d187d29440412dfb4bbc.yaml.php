<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'C:\\wamp\\www\\Mirefleurs/templates/rt_xenon/blueprints/styles/accent.yaml',
    'modified' => 1477391660,
    'data' => [
        'name' => 'Accent Colors',
        'description' => 'Accent colors for the Xenon theme',
        'type' => 'core',
        'form' => [
            'fields' => [
                'color-1' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Accent Color 1',
                    'default' => '#01a3d1'
                ],
                'color-2' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Accent Color 2',
                    'default' => '#ff2300'
                ],
                'color-3' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Accent Color 3',
                    'default' => '#ffb300'
                ]
            ]
        ]
    ]
];
