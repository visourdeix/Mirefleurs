<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'C:\\wamp\\www\\Mirefleurs/templates/rt_xenon/particles/overlaytoggle.yaml',
    'modified' => 1477391688,
    'data' => [
        'name' => 'Overlay Toggle',
        'description' => 'Displays Overlay Toggle',
        'type' => 'particle',
        'icon' => 'fa-clone',
        'form' => [
            'fields' => [
                'enabled' => [
                    'type' => 'input.checkbox',
                    'label' => 'Enabled',
                    'description' => 'Globally enable the particle.',
                    'default' => true
                ],
                'class' => [
                    'type' => 'input.selectize',
                    'label' => 'CSS Classes',
                    'description' => 'CSS class name for the particle.'
                ],
                'title' => [
                    'type' => 'input.text',
                    'label' => 'Title',
                    'description' => 'Customize the title text.',
                    'placeholder' => 'Enter title'
                ],
                'menutext' => [
                    'type' => 'input.text',
                    'label' => 'Menu Text',
                    'description' => 'Customize the Menu Text.',
                    'placeholder' => 'Menu'
                ]
            ]
        ]
    ]
];
