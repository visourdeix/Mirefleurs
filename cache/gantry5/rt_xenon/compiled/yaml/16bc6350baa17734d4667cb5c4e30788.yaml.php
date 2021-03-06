<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'C:\\wamp\\www\\Mirefleurs/templates/rt_xenon/particles/chartist.yaml',
    'modified' => 1477391690,
    'data' => [
        'name' => 'Chartist',
        'description' => 'Display Chartist items.',
        'type' => 'particle',
        'icon' => 'fa-line-chart',
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
                'type' => [
                    'type' => 'select.select',
                    'label' => 'Chart Type',
                    'description' => 'Choose the Chart Type.',
                    'default' => 'line',
                    'options' => [
                        'line' => 'Line',
                        'bar' => 'Bar',
                        'pie' => 'Pie'
                    ]
                ],
                '_info' => [
                    'type' => 'separator.note',
                    'class' => 'alert alert-info',
                    'content' => 'Separate each item with comma. For Labels Data, each item should be wrapped with single quote. For example: \'Mon\', \'Tue\', \'Wed\'. For Series Data, all each item should be wrapped with square brackets. For example: [100, 150, 250]. For multiple series, separate each data series with comma. For example: [100, 150, 250], [250, 180, 590], [50, 350, 50]'
                ],
                'labelsData' => [
                    'type' => 'textarea.textarea',
                    'label' => 'Labels Data',
                    'description' => 'Customize the Chart Labels Data.',
                    'placeholder' => 'Enter short Chart Labels Data'
                ],
                'seriesData' => [
                    'type' => 'textarea.textarea',
                    'label' => 'Series Data',
                    'description' => 'Customize the Chart Series Data.',
                    'placeholder' => 'Enter short Chart Series Data'
                ]
            ]
        ]
    ]
];
