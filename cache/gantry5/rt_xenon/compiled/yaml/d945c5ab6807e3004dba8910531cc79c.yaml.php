<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'C:\\wamp\\www\\Mirefleurs/templates/rt_xenon/particles/newsticker.yaml',
    'modified' => 1477391688,
    'data' => [
        'name' => 'News Ticker',
        'description' => 'Display News Ticker items.',
        'type' => 'particle',
        'icon' => 'fa-elipsis-h',
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
                'label' => [
                    'type' => 'input.text',
                    'label' => 'Label',
                    'description' => 'Customize the label text.',
                    'placeholder' => 'Newsflash'
                ],
                'items' => [
                    'type' => 'collection.list',
                    'array' => true,
                    'label' => 'Blocks',
                    'description' => 'Create each item to appear in the content row.',
                    'value' => 'title',
                    'ajax' => true,
                    'fields' => [
                        '.content' => [
                            'type' => 'textarea.textarea',
                            'label' => 'Content',
                            'description' => 'Customize the content.',
                            'placeholder' => 'Enter the news content'
                        ],
                        '.readmoretext' => [
                            'type' => 'input.text',
                            'label' => 'Read More Label',
                            'description' => 'Specify the readmore label.'
                        ],
                        '.readmorelink' => [
                            'type' => 'input.text',
                            'label' => 'Read More Link',
                            'description' => 'Specify the readmore link.'
                        ],
                        '.readmoretarget' => [
                            'type' => 'select.selectize',
                            'label' => 'Target',
                            'description' => 'Target browser window when item is clicked.',
                            'placeholder' => 'Select...',
                            'default' => '_self',
                            'options' => [
                                '_self' => 'Self',
                                '_blank' => 'New Window'
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];
