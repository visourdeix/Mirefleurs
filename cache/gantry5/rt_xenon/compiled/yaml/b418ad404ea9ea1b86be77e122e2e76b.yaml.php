<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'C:\\wamp\\www\\Mirefleurs/templates/rt_xenon/blueprints/styles/font.yaml',
    'modified' => 1477391660,
    'data' => [
        'name' => 'Font Families',
        'description' => 'Font families for the Xenon theme',
        'type' => 'core',
        'form' => [
            'fields' => [
                'family-default' => [
                    'type' => 'input.fonts',
                    'label' => 'Body Font',
                    'default' => 'roboto, Helvetica, Tahoma, Geneva, Arial, sans-serif'
                ],
                'family-title' => [
                    'type' => 'input.fonts',
                    'label' => 'Title Font',
                    'default' => 'montserrat, Helvetica, Tahoma, Geneva, Arial, sans-serif'
                ],
                'family-promo' => [
                    'type' => 'input.fonts',
                    'label' => 'Promo Font',
                    'default' => 'montserrat, Helvetica, Tahoma, Geneva, Arial, sans-serif'
                ]
            ]
        ]
    ]
];
