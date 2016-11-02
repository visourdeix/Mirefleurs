<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'C:\\wamp\\www\\Mirefleurs/templates/rt_xenon/particles/flexslider.yaml',
    'modified' => 1477391690,
    'data' => [
        'name' => 'FlexSlider',
        'description' => 'Display FlexSlider.',
        'type' => 'particle',
        'icon' => 'fa-sliders',
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
                'layout' => [
                    'type' => 'select.select',
                    'label' => 'Layout',
                    'description' => 'Choose the layout.',
                    'default' => 'slideshow',
                    'options' => [
                        'slideshow' => 'Slideshow',
                        'showcase' => 'Showcase',
                        'testimonial' => 'Testimonial'
                    ]
                ],
                'showcaseThumbWidth' => [
                    'type' => 'input.text',
                    'label' => 'Thumbnail Width',
                    'default' => 150,
                    'description' => 'Enter the Showcase Thumbnail Width (in px) for Showcase Layout'
                ],
                'autoplay' => [
                    'type' => 'select.select',
                    'label' => 'Autoplay',
                    'description' => 'Enable or disable the Autoplay.',
                    'default' => true,
                    'options' => [
                        1 => 'Enable',
                        0 => 'Disable'
                    ]
                ],
                'autoplaySpeed' => [
                    'type' => 'input.text',
                    'label' => 'Autoplay Speed',
                    'description' => 'Set the speed of the Autoplay, in milliseconds.',
                    'placeholder' => 5000
                ],
                'pauseOnHover' => [
                    'type' => 'select.select',
                    'label' => 'Pause on Hover',
                    'description' => 'Pause the slideshow when hovering over slider, then resume when no longer hovering.',
                    'default' => true,
                    'options' => [
                        1 => 'Enable',
                        0 => 'Disable'
                    ]
                ],
                'rtl' => [
                    'type' => 'select.select',
                    'label' => 'RTL Mode',
                    'description' => 'Enable or disable the RTL mode.',
                    'default' => false,
                    'options' => [
                        0 => 'Disable',
                        1 => 'Enable'
                    ]
                ],
                'items' => [
                    'type' => 'collection.list',
                    'array' => true,
                    'label' => 'FlexSlider Items',
                    'description' => 'Create each FlexSlider item to display.',
                    'value' => 'name',
                    'ajax' => true,
                    'fields' => [
                        '.image' => [
                            'type' => 'input.imagepicker',
                            'label' => 'Background Image',
                            'description' => 'Select desired image.'
                        ],
                        '.overlayImage' => [
                            'type' => 'input.imagepicker',
                            'label' => 'Overlay Image',
                            'description' => 'Select desired overlay image.'
                        ],
                        '.overlayParallax' => [
                            'type' => 'select.select',
                            'label' => 'Overlay Parallax',
                            'description' => 'Enable or Disable the Overlay Parallax Effect.',
                            'default' => 0,
                            'options' => [
                                1 => 'Enabled',
                                0 => 'Disabled'
                            ]
                        ],
                        '.overlayParallaxRatio' => [
                            'type' => 'input.text',
                            'label' => 'Parallax Ratio',
                            'default' => 0.29999999999999999,
                            'description' => 'Multiplier for scrolling speed to allow the parallax image to move with different speed. Less is slower, and 1 is normal.'
                        ],
                        '.title' => [
                            'type' => 'input.text',
                            'label' => 'Title',
                            'description' => 'Enter the title'
                        ],
                        '.desc' => [
                            'type' => 'textarea.textarea',
                            'label' => 'Description',
                            'description' => 'Customize the description.',
                            'placeholder' => 'Enter short description'
                        ],
                        '.testimonialImage' => [
                            'type' => 'input.imagepicker',
                            'label' => 'Testimonial Image',
                            'description' => 'Select desired Testimonial Image for Testimonial Layout.'
                        ],
                        '.testimonialName' => [
                            'type' => 'input.text',
                            'label' => 'Testimonial Name',
                            'description' => 'Input the Name for Testimonial Layout.'
                        ],
                        '.testimonialPosition' => [
                            'type' => 'input.text',
                            'label' => 'Testimonial Position',
                            'description' => 'Input the Position for Testimonial Layout.'
                        ],
                        '.link' => [
                            'type' => 'input.text',
                            'label' => 'Link',
                            'description' => 'Input the item link.'
                        ],
                        '.linktext' => [
                            'type' => 'input.text',
                            'label' => 'Link Text',
                            'description' => 'Input the text for the item link.'
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
                            'type' => 'input.text',
                            'label' => 'Button Class',
                            'description' => 'Input the button class.'
                        ]
                    ]
                ]
            ]
        ]
    ]
];
