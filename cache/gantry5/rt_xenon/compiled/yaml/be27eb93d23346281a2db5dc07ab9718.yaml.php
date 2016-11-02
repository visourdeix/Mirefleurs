<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'C:\\wamp\\www\\Mirefleurs/templates/rt_xenon/particles/pricingtable.yaml',
    'modified' => 1477391688,
    'data' => [
        'name' => 'Pricing Table',
        'description' => 'Display Pricing Table items.',
        'type' => 'particle',
        'icon' => 'fa-table',
        'form' => [
            'fields' => [
                'enabled' => [
                    'type' => 'input.checkbox',
                    'label' => 'Enabled',
                    'description' => 'Globally enable icon menu particles.',
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
                'icon' => [
                    'type' => 'input.icon',
                    'label' => 'Icon',
                    'description' => 'Input the icon.'
                ],
                'columntitle' => [
                    'type' => 'input.text',
                    'label' => 'Column Title',
                    'description' => 'Customize the table column title text.',
                    'placeholder' => 'Enter column title'
                ],
                'columnsubtitle' => [
                    'type' => 'input.text',
                    'label' => 'Column Subtitle',
                    'description' => 'Customize the table column subtitle text.',
                    'placeholder' => 'Enter column subtitle'
                ],
                'price' => [
                    'type' => 'input.text',
                    'label' => 'Price',
                    'description' => 'Customize the price.',
                    'placeholder' => '$100'
                ],
                'desc' => [
                    'type' => 'textarea.textarea',
                    'label' => 'Description',
                    'description' => 'Customize the description.',
                    'placeholder' => 'Enter short description'
                ],
                'buttontext' => [
                    'type' => 'input.text',
                    'label' => 'Button Label',
                    'description' => 'Specify the button label.'
                ],
                'buttonlink' => [
                    'type' => 'input.text',
                    'label' => 'Button Link',
                    'description' => 'Specify the button link.'
                ],
                'buttontarget' => [
                    'type' => 'select.selectize',
                    'label' => 'Target',
                    'description' => 'Target browser window when item is clicked.',
                    'placeholder' => 'Select...',
                    'default' => '_self',
                    'options' => [
                        '_self' => 'Self',
                        '_blank' => 'New Window'
                    ]
                ],
                'buttonclass' => [
                    'type' => 'input.selectize',
                    'label' => 'Button Classes',
                    'description' => 'CSS class names for the button.'
                ],
                'items' => [
                    'type' => 'collection.list',
                    'array' => true,
                    'label' => 'Tags',
                    'description' => 'Create the items for your table.',
                    'value' => 'title',
                    'ajax' => true,
                    'fields' => [
                        '.text' => [
                            'type' => 'input.text',
                            'label' => 'Text'
                        ]
                    ]
                ]
            ]
        ]
    ]
];
