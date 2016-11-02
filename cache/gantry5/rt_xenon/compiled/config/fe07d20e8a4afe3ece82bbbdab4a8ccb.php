<?php
return [
    '@class' => 'Gantry\\Component\\Config\\CompiledConfig',
    'timestamp' => 1477646228,
    'checksum' => '15300bbeff86bfc29509d2cf3467ed38',
    'files' => [
        'templates/rt_xenon/custom/config/default' => [
            'index' => [
                'file' => 'templates/rt_xenon/custom/config/default/index.yaml',
                'modified' => 1477391718
            ],
            'layout' => [
                'file' => 'templates/rt_xenon/custom/config/default/layout.yaml',
                'modified' => 1477391718
            ],
            'page/assets' => [
                'file' => 'templates/rt_xenon/custom/config/default/page/assets.yaml',
                'modified' => 1477391718
            ],
            'page/body' => [
                'file' => 'templates/rt_xenon/custom/config/default/page/body.yaml',
                'modified' => 1477391718
            ],
            'page/head' => [
                'file' => 'templates/rt_xenon/custom/config/default/page/head.yaml',
                'modified' => 1477391718
            ]
        ],
        'templates/rt_xenon/config/default' => [
            'page/assets' => [
                'file' => 'templates/rt_xenon/config/default/page/assets.yaml',
                'modified' => 1477391662
            ],
            'page/body' => [
                'file' => 'templates/rt_xenon/config/default/page/body.yaml',
                'modified' => 1477391662
            ],
            'page/head' => [
                'file' => 'templates/rt_xenon/config/default/page/head.yaml',
                'modified' => 1477391662
            ],
            'particles/branding' => [
                'file' => 'templates/rt_xenon/config/default/particles/branding.yaml',
                'modified' => 1477391662
            ],
            'particles/copyright' => [
                'file' => 'templates/rt_xenon/config/default/particles/copyright.yaml',
                'modified' => 1477391662
            ],
            'particles/logo' => [
                'file' => 'templates/rt_xenon/config/default/particles/logo.yaml',
                'modified' => 1477391662
            ],
            'particles/social' => [
                'file' => 'templates/rt_xenon/config/default/particles/social.yaml',
                'modified' => 1477391662
            ],
            'particles/totop' => [
                'file' => 'templates/rt_xenon/config/default/particles/totop.yaml',
                'modified' => 1477391662
            ],
            'styles' => [
                'file' => 'templates/rt_xenon/config/default/styles.yaml',
                'modified' => 1477391662
            ]
        ]
    ],
    'data' => [
        'page' => [
            'assets' => [
                'priority' => 0,
                'favicon' => '',
                'touchicon' => '',
                'css' => [
                    
                ],
                'javascript' => [
                    
                ]
            ],
            'body' => [
                'attribs' => [
                    'class' => 'gantry',
                    'id' => '',
                    'extra' => [
                        
                    ]
                ],
                'layout' => [
                    'sections' => '0'
                ],
                'doctype' => 'html',
                'body_top' => '',
                'body_bottom' => ''
            ],
            'head' => [
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
        ],
        'styles' => [
            'above' => [
                'background' => '#ffffff',
                'text-color' => '#888888'
            ],
            'accent' => [
                'color-1' => '#01a3d1',
                'color-2' => '#ff2300',
                'color-3' => '#ffb300'
            ],
            'base' => [
                'background' => '#ffffff',
                'text-color' => '#686868',
                'background-image' => 'gantry-media://backgrounds/base/bg-01.jpg',
                'favicon' => ''
            ],
            'bottom' => [
                'background' => '#121212',
                'text-color' => '#ffffff'
            ],
            'breakpoints' => [
                'large-desktop-container' => '75rem',
                'desktop-container' => '60rem',
                'tablet-container' => '48rem',
                'large-mobile-container' => '30rem',
                'mobile-menu-breakpoint' => '48rem'
            ],
            'copyright' => [
                'background' => 'rgba(0, 0, 0, 0)',
                'text-color' => '#686868'
            ],
            'expanded' => [
                'background' => '#ffffff',
                'text-color' => '#121212'
            ],
            'extension' => [
                'background' => '#01a3d1',
                'text-color' => '#ffffff'
            ],
            'feature' => [
                'background' => '#01a3d1',
                'text-color' => '#ffffff'
            ],
            'font' => [
                'family-default' => 'roboto, Helvetica, Tahoma, Geneva, Arial, sans-serif',
                'family-title' => 'montserrat, Helvetica, Tahoma, Geneva, Arial, sans-serif',
                'family-promo' => 'montserrat, Helvetica, Tahoma, Geneva, Arial, sans-serif'
            ],
            'footer' => [
                'background' => 'rgba(0, 0, 0, 0)',
                'text-color' => '#686868'
            ],
            'header' => [
                'background' => '#017494',
                'text-color' => '#ffffff'
            ],
            'main' => [
                'background' => '#ffffff',
                'text-color' => '#686868'
            ],
            'menu' => [
                'col-width' => '180px',
                'animation' => 'g-fade-in-up'
            ],
            'navigation' => [
                'background' => 'rgba(0, 0, 0, 0)',
                'text-color' => '#ffffff'
            ],
            'offcanvas' => [
                'background' => '#017494',
                'text-color' => '#ffffff',
                'toggle-color' => '#01a3d1',
                'width' => '12rem'
            ],
            'overlay' => [
                'background' => '#01a3d1',
                'text-color' => '#ffffff',
                'background-image' => '',
                'opacity' => '0.9'
            ],
            'showcase' => [
                'background' => '#f7f7f7',
                'text-color' => '#888888'
            ],
            'top' => [
                'background' => 'rgba(0, 0, 0, 0)',
                'text-color' => '#888888'
            ],
            'utility' => [
                'background' => '#010101',
                'text-color' => '#ffffff'
            ],
            'preset' => 'preset1'
        ],
        'particles' => [
            'analytics' => [
                'enabled' => true,
                'ua' => [
                    'anonym' => false,
                    'ssl' => false,
                    'debug' => false
                ]
            ],
            'assets' => [
                'enabled' => true,
                'priority' => 0
            ],
            'branding' => [
                'enabled' => '1',
                'content' => 'Powered by <a href="http://www.gantry.org/" title="Gantry Framework" class="g-powered-by">Gantry<span class="hidden-tablet"> Framework</span></a>',
                'css' => [
                    'class' => 'g-branding'
                ]
            ],
            'content' => [
                'enabled' => true
            ],
            'contentarray' => [
                'enabled' => true,
                'article' => [
                    'filter' => [
                        'featured' => ''
                    ],
                    'limit' => [
                        'total' => 2,
                        'columns' => 2,
                        'start' => 0
                    ],
                    'sort' => [
                        'orderby' => 'publish_up',
                        'ordering' => 'ASC'
                    ],
                    'display' => [
                        'image' => [
                            'enabled' => 'intro'
                        ],
                        'text' => [
                            'type' => 'intro',
                            'limit' => '',
                            'formatting' => 'text'
                        ],
                        'title' => [
                            'enabled' => 'show'
                        ],
                        'date' => [
                            'enabled' => 'published',
                            'format' => 'l, F d, Y'
                        ],
                        'read_more' => [
                            'enabled' => 'show'
                        ],
                        'author' => [
                            'enabled' => 'show'
                        ],
                        'category' => [
                            'enabled' => 'link'
                        ],
                        'hits' => [
                            'enabled' => 'show'
                        ]
                    ]
                ]
            ],
            'copyright' => [
                'enabled' => '1',
                'date' => [
                    'start' => '2007',
                    'end' => 'now'
                ],
                'target' => '_blank',
                'owner' => 'RocketTheme LLC',
                'link' => '',
                'css' => [
                    'class' => ''
                ]
            ],
            'custom' => [
                'enabled' => true
            ],
            'date' => [
                'enabled' => true,
                'css' => [
                    'class' => 'date'
                ],
                'date' => [
                    'formats' => 'l, F d, Y'
                ]
            ],
            'frameworks' => [
                'enabled' => true,
                'jquery' => [
                    'enabled' => 0,
                    'ui_core' => 0,
                    'ui_sortable' => 0
                ],
                'bootstrap' => [
                    'enabled' => 0
                ],
                'mootools' => [
                    'enabled' => 0,
                    'more' => 0
                ]
            ],
            'logo' => [
                'enabled' => '1',
                'url' => '',
                'image' => '',
                'text' => 'Xenon',
                'tagline' => 'Vibrant and Elegant.',
                'class' => 'g-logo'
            ],
            'menu' => [
                'enabled' => true,
                'menu' => '',
                'base' => '/',
                'startLevel' => 1,
                'maxLevels' => 0,
                'renderTitles' => 0,
                'hoverExpand' => 1,
                'mobileTarget' => 0
            ],
            'messages' => [
                'enabled' => true
            ],
            'mobile-menu' => [
                'enabled' => true
            ],
            'module' => [
                'enabled' => true
            ],
            'position' => [
                'enabled' => true
            ],
            'social' => [
                'enabled' => '1',
                'css' => [
                    'class' => 'g-social'
                ],
                'target' => '_blank',
                'display' => 'both',
                'title' => '',
                'items' => [
                    0 => [
                        'icon' => 'fa fa-facebook fa-fw',
                        'text' => '',
                        'link' => 'http://www.facebook.com/RocketTheme',
                        'name' => 'Facebook'
                    ],
                    1 => [
                        'icon' => 'fa fa-twitter fa-fw',
                        'text' => '',
                        'link' => 'http://www.twitter.com/rockettheme',
                        'name' => 'Twitter'
                    ],
                    2 => [
                        'icon' => 'fa fa-google-plus fa-fw',
                        'text' => '',
                        'link' => 'https://plus.google.com/+rockettheme',
                        'name' => 'Google+'
                    ]
                ]
            ],
            'spacer' => [
                'enabled' => true
            ],
            'totop' => [
                'enabled' => '1',
                'css' => NULL,
                'class' => 'g-totop',
                'icon' => '',
                'content' => 'To Top'
            ],
            'blockcontent' => [
                'enabled' => true
            ],
            'chartist' => [
                'enabled' => true,
                'type' => 'line'
            ],
            'contact' => [
                'enabled' => true,
                'mapposition' => 'top'
            ],
            'contentlist' => [
                'enabled' => true,
                'cols' => 'g-listgrid-4cols'
            ],
            'flexslider' => [
                'enabled' => true,
                'layout' => 'slideshow',
                'showcaseThumbWidth' => 150,
                'autoplay' => true,
                'pauseOnHover' => true,
                'rtl' => false
            ],
            'gridcontent' => [
                'enabled' => true,
                'readmoreclass' => 'button-3',
                'cols' => 'g-gridcontent-2cols'
            ],
            'horizontalmenu' => [
                'enabled' => true,
                'target' => '_blank'
            ],
            'imagegrid' => [
                'enabled' => true,
                'cols' => 'g-imagegrid-2cols'
            ],
            'infolist' => [
                'enabled' => true,
                'cols' => 'g-1cols'
            ],
            'newsletter' => [
                'enabled' => true
            ],
            'newsslider' => [
                'enabled' => true
            ],
            'newsticker' => [
                'enabled' => true
            ],
            'overlaytoggle' => [
                'enabled' => true
            ],
            'popupgrid' => [
                'enabled' => true
            ],
            'popupmodule' => [
                'enabled' => true
            ],
            'pricingtable' => [
                'enabled' => true,
                'buttontarget' => '_self'
            ],
            'promocontent' => [
                'enabled' => true,
                'promostyle' => 'standard',
                'linkstyle' => 'block'
            ],
            'promoimage' => [
                'enabled' => true
            ],
            'simplecounter' => [
                'enabled' => true,
                'month' => 0
            ],
            'testimonial' => [
                'enabled' => true,
                'cols' => 'g-1cols'
            ]
        ],
        'index' => [
            'name' => 'default',
            'timestamp' => 1476985484,
            'version' => 7,
            'preset' => [
                'image' => 'gantry-admin://images/layouts/default.png',
                'name' => 'default',
                'timestamp' => 1476728668
            ],
            'positions' => [
                'overlay-top' => 'Overlay Top',
                'overlay-a' => 'Overlay A',
                'overlay-b' => 'Overlay B',
                'overlay-c' => 'Overlay C',
                'top-a' => 'Top A',
                'top-b' => 'Top B',
                'navigation-a' => 'Navigation A',
                'header-a' => 'Header A',
                'header-b' => 'Header B',
                'header-c' => 'Header C',
                'above-a' => 'Above A',
                'above-b' => 'Above B',
                'above-c' => 'Above C',
                'showcase-a' => 'Showcase A',
                'showcase-b' => 'Showcase B',
                'showcase-c' => 'Showcase C',
                'utility-a' => 'Utility A',
                'utility-b' => 'Utility B',
                'utility-c' => 'Utility C',
                'feature-a' => 'Feature A',
                'feature-b' => 'Feature B',
                'feature-c' => 'Feature C',
                'sidebar' => 'Sidebar',
                'mainbar-a' => 'Mainbar A',
                'mainbar-b' => 'Mainbar B',
                'mainbar-c' => 'Mainbar C',
                'aside' => 'Aside',
                'expanded-a' => 'Expanded A',
                'expanded-b' => 'Expanded B',
                'expanded-c' => 'Expanded C',
                'extension-a' => 'Extension A',
                'extension-b' => 'Extension B',
                'extension-c' => 'Extension C',
                'bottom-a' => 'Bottom A',
                'bottom-b' => 'Bottom B',
                'bottom-c' => 'Bottom C',
                'footer-a' => 'Footer A',
                'footer-b' => 'Footer B',
                'footer-c' => 'Footer C',
                'footer-d' => 'Footer D'
            ],
            'sections' => [
                'overlay' => 'Overlay',
                'top' => 'Top',
                'navigation' => 'Navigation',
                'above' => 'Above',
                'showcase' => 'Showcase',
                'utility' => 'Utility',
                'feature' => 'Feature',
                'sidebar' => 'Sidebar',
                'mainbar' => 'Mainbar',
                'expanded' => 'Expanded',
                'extension' => 'Extension',
                'bottom' => 'Bottom',
                'copyright' => 'Copyright',
                'header' => 'Header',
                'aside' => 'Aside',
                'footer' => 'Footer',
                'offcanvas' => 'Offcanvas'
            ],
            'particles' => [
                'position' => [
                    'position-position-1846' => 'Overlay Top',
                    'position-position-5278' => 'Overlay A',
                    'position-position-8786' => 'Overlay B',
                    'position-position-9848' => 'Overlay C',
                    'position-top-a' => 'Top A',
                    'position-top-b' => 'Top B',
                    'position-navigation-a' => 'Navigation A',
                    'position-header-a' => 'Header A',
                    'position-header-b' => 'Header B',
                    'position-header-c' => 'Header C',
                    'position-above-a' => 'Above A',
                    'position-above-b' => 'Above B',
                    'position-above-c' => 'Above C',
                    'position-showcase-a' => 'Showcase A',
                    'position-showcase-b' => 'Showcase B',
                    'position-showcase-c' => 'Showcase C',
                    'position-utility-a' => 'Utility A',
                    'position-utility-b' => 'Utility B',
                    'position-utility-c' => 'Utility C',
                    'position-feature-a' => 'Feature A',
                    'position-feature-b' => 'Feature B',
                    'position-feature-c' => 'Feature C',
                    'position-sidebar' => 'Sidebar',
                    'position-mainbar-a' => 'Mainbar A',
                    'position-mainbar-b' => 'Mainbar B',
                    'position-mainbar-c' => 'Mainbar C',
                    'position-aside' => 'Aside',
                    'position-expanded-a' => 'Expanded A',
                    'position-expanded-b' => 'Expanded B',
                    'position-expanded-c' => 'Expanded C',
                    'position-extension-a' => 'Extension A',
                    'position-extension-b' => 'Extension B',
                    'position-extension-c' => 'Extension C',
                    'position-bottom-a' => 'Bottom A',
                    'position-bottom-b' => 'Bottom B',
                    'position-bottom-c' => 'Bottom C',
                    'position-footer-a' => 'Footer A',
                    'position-footer-b' => 'Footer B',
                    'position-footer-c' => 'Footer C',
                    'position-footer-d' => 'Footer D'
                ],
                'messages' => [
                    'system-messages-8159' => 'System Messages'
                ],
                'logo' => [
                    'logo-4057' => 'Logo'
                ],
                'menu' => [
                    'menu-3995' => 'Menu'
                ],
                'content' => [
                    'system-content-5020' => 'Page Content'
                ],
                'branding' => [
                    'branding-3018' => 'Branding'
                ],
                'copyright' => [
                    'copyright-5323' => 'Copyright'
                ],
                'totop' => [
                    'totop-8334' => 'To Top'
                ],
                'mobile-menu' => [
                    'mobile-menu-8402' => 'Mobile Menu'
                ]
            ],
            'inherit' => [
                
            ]
        ],
        'layout' => [
            'version' => 2,
            'preset' => [
                'image' => 'gantry-admin://images/layouts/default.png',
                'name' => 'default',
                'timestamp' => 1476728668
            ],
            'layout' => [
                '/overlay/' => [
                    0 => [
                        0 => 'position-position-1846'
                    ],
                    1 => [
                        0 => 'position-position-5278 33.3',
                        1 => 'position-position-8786 33.3',
                        2 => 'position-position-9848 33.3'
                    ]
                ],
                '/top/' => [
                    0 => [
                        0 => 'system-messages-8159'
                    ],
                    1 => [
                        0 => 'logo-4057 50',
                        1 => 'position-top-a 30',
                        2 => 'position-top-b 20'
                    ]
                ],
                '/navigation/' => [
                    0 => [
                        0 => 'menu-3995 80',
                        1 => 'position-navigation-a 20'
                    ]
                ],
                '/header/' => [
                    0 => [
                        0 => 'position-header-a 33.3',
                        1 => 'position-header-b 33.3',
                        2 => 'position-header-c 33.3'
                    ]
                ],
                '/above/' => [
                    0 => [
                        0 => 'position-above-a 33.3',
                        1 => 'position-above-b 33.3',
                        2 => 'position-above-c 33.3'
                    ]
                ],
                '/showcase/' => [
                    0 => [
                        0 => 'position-showcase-a 33.3',
                        1 => 'position-showcase-b 33.3',
                        2 => 'position-showcase-c 33.3'
                    ]
                ],
                '/utility/' => [
                    0 => [
                        0 => 'position-utility-a 33.3',
                        1 => 'position-utility-b 33.3',
                        2 => 'position-utility-c 33.3'
                    ]
                ],
                '/feature/' => [
                    0 => [
                        0 => 'position-feature-a 33.3',
                        1 => 'position-feature-b 33.3',
                        2 => 'position-feature-c 33.3'
                    ]
                ],
                '/container-main/' => [
                    0 => [
                        0 => [
                            'sidebar 20' => [
                                0 => [
                                    0 => 'position-sidebar'
                                ]
                            ]
                        ],
                        1 => [
                            'mainbar 60' => [
                                0 => [
                                    0 => 'position-mainbar-a 33.3',
                                    1 => 'position-mainbar-b 33.3',
                                    2 => 'position-mainbar-c 33.3'
                                ],
                                1 => [
                                    0 => 'system-content-5020'
                                ]
                            ]
                        ],
                        2 => [
                            'aside 20' => [
                                0 => [
                                    0 => 'position-aside'
                                ]
                            ]
                        ]
                    ]
                ],
                '/expanded/' => [
                    0 => [
                        0 => 'position-expanded-a 33.3',
                        1 => 'position-expanded-b 33.3',
                        2 => 'position-expanded-c 33.3'
                    ]
                ],
                '/extension/' => [
                    0 => [
                        0 => 'position-extension-a 33.3',
                        1 => 'position-extension-b 33.3',
                        2 => 'position-extension-c 33.3'
                    ]
                ],
                '/bottom/' => [
                    0 => [
                        0 => 'position-bottom-a 33.3',
                        1 => 'position-bottom-b 33.3',
                        2 => 'position-bottom-c 33.3'
                    ]
                ],
                '/footer/' => [
                    0 => [
                        0 => 'position-footer-a 25',
                        1 => 'position-footer-b 25',
                        2 => 'position-footer-c 25',
                        3 => 'position-footer-d 25'
                    ]
                ],
                '/copyright/' => [
                    0 => [
                        0 => 'branding-3018 33.3',
                        1 => 'copyright-5323 33.3',
                        2 => 'totop-8334 33.3'
                    ]
                ],
                '/offcanvas/' => [
                    0 => [
                        0 => 'mobile-menu-8402'
                    ]
                ]
            ],
            'structure' => [
                'overlay' => [
                    'type' => 'section',
                    'attributes' => [
                        'boxed' => ''
                    ]
                ],
                'top' => [
                    'type' => 'section',
                    'attributes' => [
                        'boxed' => '1',
                        'class' => ''
                    ]
                ],
                'navigation' => [
                    'type' => 'section',
                    'attributes' => [
                        'boxed' => '1',
                        'class' => ''
                    ]
                ],
                'header' => [
                    'attributes' => [
                        'boxed' => '1',
                        'class' => ''
                    ]
                ],
                'above' => [
                    'type' => 'section',
                    'attributes' => [
                        'boxed' => '1',
                        'class' => ''
                    ]
                ],
                'showcase' => [
                    'type' => 'section',
                    'attributes' => [
                        'boxed' => '1',
                        'class' => ''
                    ]
                ],
                'utility' => [
                    'type' => 'section',
                    'attributes' => [
                        'boxed' => '1',
                        'class' => ''
                    ]
                ],
                'feature' => [
                    'type' => 'section',
                    'attributes' => [
                        'boxed' => '1',
                        'class' => ''
                    ]
                ],
                'sidebar' => [
                    'type' => 'section',
                    'attributes' => [
                        'class' => ''
                    ],
                    'block' => [
                        'class' => 'equal-height'
                    ]
                ],
                'mainbar' => [
                    'type' => 'section',
                    'attributes' => [
                        'class' => ''
                    ],
                    'block' => [
                        'class' => 'equal-height'
                    ]
                ],
                'aside' => [
                    'attributes' => [
                        'class' => ''
                    ],
                    'block' => [
                        'class' => 'equal-height'
                    ]
                ],
                'container-main' => [
                    'attributes' => [
                        'boxed' => '1',
                        'class' => '',
                        'extra' => [
                            
                        ]
                    ]
                ],
                'expanded' => [
                    'type' => 'section',
                    'attributes' => [
                        'boxed' => '1',
                        'class' => ''
                    ]
                ],
                'extension' => [
                    'type' => 'section',
                    'attributes' => [
                        'boxed' => '1',
                        'class' => ''
                    ]
                ],
                'bottom' => [
                    'type' => 'section',
                    'attributes' => [
                        'boxed' => '1',
                        'class' => ''
                    ]
                ],
                'footer' => [
                    'attributes' => [
                        'boxed' => '1',
                        'class' => ''
                    ]
                ],
                'copyright' => [
                    'type' => 'section',
                    'attributes' => [
                        'boxed' => '1',
                        'class' => ''
                    ]
                ],
                'offcanvas' => [
                    'attributes' => [
                        'boxed' => ''
                    ]
                ]
            ],
            'content' => [
                'position-position-1846' => [
                    'title' => 'Overlay Top',
                    'attributes' => [
                        'key' => 'overlay-top'
                    ],
                    'block' => [
                        'class' => 'fp-overlay-top'
                    ]
                ],
                'position-position-5278' => [
                    'title' => 'Overlay A',
                    'attributes' => [
                        'key' => 'overlay-a'
                    ]
                ],
                'position-position-8786' => [
                    'title' => 'Overlay B',
                    'attributes' => [
                        'key' => 'overlay-b'
                    ]
                ],
                'position-position-9848' => [
                    'title' => 'Overlay C',
                    'attributes' => [
                        'key' => 'overlay-c'
                    ]
                ],
                'system-messages-8159' => [
                    'block' => [
                        'variations' => 'nomarginall nopaddingall'
                    ]
                ],
                'position-top-a' => [
                    'title' => 'Top A',
                    'attributes' => [
                        'key' => 'top-a'
                    ],
                    'block' => [
                        'class' => 'fp-top-a'
                    ]
                ],
                'position-top-b' => [
                    'title' => 'Top B',
                    'attributes' => [
                        'key' => 'top-b'
                    ],
                    'block' => [
                        'class' => 'fp-top-b'
                    ]
                ],
                'position-navigation-a' => [
                    'title' => 'Navigation A',
                    'attributes' => [
                        'key' => 'navigation-a'
                    ]
                ],
                'position-header-a' => [
                    'title' => 'Header A',
                    'attributes' => [
                        'key' => 'header-a'
                    ]
                ],
                'position-header-b' => [
                    'title' => 'Header B',
                    'attributes' => [
                        'key' => 'header-b'
                    ]
                ],
                'position-header-c' => [
                    'title' => 'Header C',
                    'attributes' => [
                        'key' => 'header-c'
                    ]
                ],
                'position-above-a' => [
                    'title' => 'Above A',
                    'attributes' => [
                        'key' => 'above-a'
                    ]
                ],
                'position-above-b' => [
                    'title' => 'Above B',
                    'attributes' => [
                        'key' => 'above-b'
                    ]
                ],
                'position-above-c' => [
                    'title' => 'Above C',
                    'attributes' => [
                        'key' => 'above-c'
                    ]
                ],
                'position-showcase-a' => [
                    'title' => 'Showcase A',
                    'attributes' => [
                        'key' => 'showcase-a'
                    ]
                ],
                'position-showcase-b' => [
                    'title' => 'Showcase B',
                    'attributes' => [
                        'key' => 'showcase-b'
                    ]
                ],
                'position-showcase-c' => [
                    'title' => 'Showcase C',
                    'attributes' => [
                        'key' => 'showcase-c'
                    ]
                ],
                'position-utility-a' => [
                    'title' => 'Utility A',
                    'attributes' => [
                        'key' => 'utility-a'
                    ]
                ],
                'position-utility-b' => [
                    'title' => 'Utility B',
                    'attributes' => [
                        'key' => 'utility-b'
                    ]
                ],
                'position-utility-c' => [
                    'title' => 'Utility C',
                    'attributes' => [
                        'key' => 'utility-c'
                    ]
                ],
                'position-feature-a' => [
                    'title' => 'Feature A',
                    'attributes' => [
                        'key' => 'feature-a'
                    ]
                ],
                'position-feature-b' => [
                    'title' => 'Feature B',
                    'attributes' => [
                        'key' => 'feature-b'
                    ]
                ],
                'position-feature-c' => [
                    'title' => 'Feature C',
                    'attributes' => [
                        'key' => 'feature-c'
                    ]
                ],
                'position-sidebar' => [
                    'attributes' => [
                        'key' => 'sidebar'
                    ]
                ],
                'position-mainbar-a' => [
                    'title' => 'Mainbar A',
                    'attributes' => [
                        'key' => 'mainbar-a'
                    ]
                ],
                'position-mainbar-b' => [
                    'title' => 'Mainbar B',
                    'attributes' => [
                        'key' => 'mainbar-b'
                    ]
                ],
                'position-mainbar-c' => [
                    'title' => 'Mainbar C',
                    'attributes' => [
                        'key' => 'mainbar-c'
                    ]
                ],
                'position-aside' => [
                    'attributes' => [
                        'key' => 'aside'
                    ]
                ],
                'position-expanded-a' => [
                    'title' => 'Expanded A',
                    'attributes' => [
                        'key' => 'expanded-a'
                    ]
                ],
                'position-expanded-b' => [
                    'title' => 'Expanded B',
                    'attributes' => [
                        'key' => 'expanded-b'
                    ]
                ],
                'position-expanded-c' => [
                    'title' => 'Expanded C',
                    'attributes' => [
                        'key' => 'expanded-c'
                    ]
                ],
                'position-extension-a' => [
                    'title' => 'Extension A',
                    'attributes' => [
                        'key' => 'extension-a'
                    ]
                ],
                'position-extension-b' => [
                    'title' => 'Extension B',
                    'attributes' => [
                        'key' => 'extension-b'
                    ]
                ],
                'position-extension-c' => [
                    'title' => 'Extension C',
                    'attributes' => [
                        'key' => 'extension-c'
                    ]
                ],
                'position-bottom-a' => [
                    'title' => 'Bottom A',
                    'attributes' => [
                        'key' => 'bottom-a'
                    ]
                ],
                'position-bottom-b' => [
                    'title' => 'Bottom B',
                    'attributes' => [
                        'key' => 'bottom-b'
                    ]
                ],
                'position-bottom-c' => [
                    'title' => 'Bottom C',
                    'attributes' => [
                        'key' => 'bottom-c'
                    ]
                ],
                'position-footer-a' => [
                    'title' => 'Footer A',
                    'attributes' => [
                        'key' => 'footer-a'
                    ],
                    'block' => [
                        'class' => 'g-title-bordered'
                    ]
                ],
                'position-footer-b' => [
                    'title' => 'Footer B',
                    'attributes' => [
                        'key' => 'footer-b'
                    ],
                    'block' => [
                        'class' => 'g-title-bordered'
                    ]
                ],
                'position-footer-c' => [
                    'title' => 'Footer C',
                    'attributes' => [
                        'key' => 'footer-c'
                    ],
                    'block' => [
                        'class' => 'g-title-bordered'
                    ]
                ],
                'position-footer-d' => [
                    'title' => 'Footer D',
                    'attributes' => [
                        'key' => 'footer-d'
                    ]
                ],
                'branding-3018' => [
                    'attributes' => [
                        'content' => 'Powered by <a href="http://www.gantry.org/" title="Gantry Framework" class="g-powered-by">Gantry<span class="hidden-tablet"> Framework</span></a>'
                    ]
                ],
                'totop-8334' => [
                    'title' => 'To Top',
                    'attributes' => [
                        'icon' => '',
                        'content' => 'To Top'
                    ]
                ],
                'mobile-menu-8402' => [
                    'title' => 'Mobile Menu'
                ]
            ]
        ]
    ]
];
