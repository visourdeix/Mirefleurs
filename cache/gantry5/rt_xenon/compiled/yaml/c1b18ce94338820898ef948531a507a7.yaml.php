<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'C:\\wamp\\www\\Mirefleurs/templates/rt_xenon/blueprints/styles/overlay.yaml',
    'modified' => 1477391660,
    'data' => [
        'name' => 'Overlay Styles',
        'description' => 'Overlay styles for the Xenon theme',
        'type' => 'section',
        'form' => [
            'fields' => [
                'background' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Background',
                    'default' => '#01a3d1'
                ],
                'background-image' => [
                    'type' => 'input.imagepicker',
                    'label' => 'Background Image'
                ],
                'text-color' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Text',
                    'default' => '#ffffff'
                ]
            ]
        ]
    ]
];
