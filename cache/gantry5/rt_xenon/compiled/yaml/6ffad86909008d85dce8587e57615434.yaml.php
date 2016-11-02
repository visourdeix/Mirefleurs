<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'C:\\wamp\\www\\Mirefleurs/templates/rt_xenon/particles/popupgrid.yaml',
    'modified' => 1477391688,
    'data' => [
        'name' => 'Popup Grid',
        'description' => 'Display Popup Grid content.',
        'type' => 'particle',
        'icon' => 'fa-arrows-alt',
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
                'items' => [
                    'type' => 'collection.list',
                    'array' => true,
                    'label' => 'Blocks',
                    'description' => 'Create each item to appear in the content row.',
                    'value' => 'title',
                    'ajax' => true,
                    'fields' => [
                        '.img' => [
                            'type' => 'input.imagepicker',
                            'label' => 'Image',
                            'description' => 'Select desired image.'
                        ],
                        '.width' => [
                            'type' => 'input.text',
                            'label' => 'Image Width',
                            'description' => 'Input the image width (in pixel).',
                            'placeholder' => '393px'
                        ],
                        '.datasize' => [
                            'type' => 'input.text',
                            'label' => 'Image Size',
                            'description' => 'Input the real image size (in pixel).',
                            'placeholder' => '1280x860'
                        ],
                        '.overlay' => [
                            'type' => 'select.select',
                            'label' => 'Preview Overlay',
                            'description' => 'Enable or disable the Overlay when hovering the item.',
                            'placeholder' => 'Select...',
                            'default' => 'g-overlay-enable',
                            'options' => [
                                'g-overlay-enable' => 'Enabled',
                                'g-overlay-disable' => 'Disabled'
                            ]
                        ],
                        '.previewicon' => [
                            'type' => 'input.icon',
                            'label' => 'Preview Icon',
                            'description' => 'Choose the Preview Icon.'
                        ],
                        '.title' => [
                            'type' => 'input.text',
                            'label' => 'Title',
                            'description' => 'Customize the Title.',
                            'placeholder' => 'Enter Title'
                        ],
                        '.tag' => [
                            'type' => 'input.text',
                            'label' => 'Tag',
                            'description' => 'Customize the Tag.',
                            'placeholder' => 'Enter Tag'
                        ],
                        '.desc' => [
                            'type' => 'textarea.textarea',
                            'label' => 'Description',
                            'description' => 'Customize the description.',
                            'placeholder' => 'Enter short description'
                        ],
                        '.animations' => [
                            'type' => 'input.selectize',
                            'label' => 'Animations',
                            'description' => 'Choose the Animation(s) when hovering the item: g-zoom, g-blur, g-rotate, g-grayscale.',
                            'default' => 'g-zoom',
                            'options' => [
                                'g-zoom' => 'Zoom',
                                'g-blur' => 'Blur',
                                'g-rotate' => 'Rotate',
                                'g-grayscale' => 'Grayscale'
                            ]
                        ],
                        '.buttontext' => [
                            'type' => 'input.text',
                            'label' => 'Button Label',
                            'description' => 'Specify the button label.'
                        ],
                        '.buttonlink' => [
                            'type' => 'input.text',
                            'label' => 'Button Link',
                            'description' => 'Specify the button link.'
                        ],
                        '.buttontarget' => [
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
                        '.buttonclass' => [
                            'type' => 'input.selectize',
                            'label' => 'Button Classes',
                            'description' => 'CSS class names for the button.'
                        ]
                    ]
                ]
            ]
        ]
    ]
];
