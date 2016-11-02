<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'C:\\wamp\\www\\Mirefleurs/templates/rt_xenon/custom/config/default/page/head.yaml',
    'modified' => 1477391718,
    'data' => [
        'meta' => [
            
        ],
        'head_bottom' => '',
        'atoms' => [
            0 => [
                'type' => 'assets',
                'title' => 'Custom CSS / JS',
                'attributes' => [
                    'enabled' => '1',
                    'css' => [
                        0 => [
                            'location' => 'gantry-assets://css/demo.css',
                            'inline' => '',
                            'extra' => [
                                
                            ],
                            'name' => 'Demo CSS'
                        ]
                    ],
                    'javascript' => [
                        0 => [
                            'location' => 'gantry-assets://custom/js/Headroom.min.js',
                            'inline' => '// Headroom (on header)
			var myElement = document.querySelector("#g-header");
			var headroom  = new Headroom(myElement, { offset: "182"});
			headroom.init();
			// Headroom (on offcanvas)
			var myElement = document.querySelector(".g-offcanvas-toggle");
			var headroom  = new Headroom(myElement);
			headroom.init();',
                            'in_footer' => '1',
                            'extra' => [
                                
                            ],
                            'name' => 'Headroom'
                        ]
                    ]
                ]
            ]
        ]
    ]
];
