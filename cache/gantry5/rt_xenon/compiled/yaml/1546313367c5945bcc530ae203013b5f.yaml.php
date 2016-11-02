<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'C:\\wamp\\www\\Mirefleurs/templates/rt_xenon/blueprints/styles/showcase.yaml',
    'modified' => 1477391660,
    'data' => [
        'name' => 'Showcase Styles',
        'description' => 'Showcase styles for the Xenon theme',
        'type' => 'section',
        'form' => [
            'fields' => [
                'background' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Background',
                    'default' => '#f7f7f7'
                ],
                'text-color' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Text',
                    'default' => '#888888'
                ]
            ]
        ]
    ]
];
