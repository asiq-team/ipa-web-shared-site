<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($layout = 'side-menu', $theme = 'light', $pageName = 'dashboard')
    {
        return view('web.dashboard.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Determine active menu & submenu.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function activeMenu($layout, $pageName)
    {
        $firstPageName = '';
        $secondPageName = '';
        $thirdPageName = '';

        if ($layout == 'top-menu') {
            foreach ($this->topMenu() as $menu) {
                if ($menu['page_name'] == $pageName && empty($firstPageName)) {
                    $firstPageName = $menu['page_name'];
                }

                if (isset($menu['sub_menu'])) {
                    foreach ($menu['sub_menu'] as $subMenu) {
                        if ($subMenu['page_name'] == $pageName && empty($secondPageName) && $subMenu['page_name'] != 'dashboard') {
                            $firstPageName = $menu['page_name'];
                            $secondPageName = $subMenu['page_name'];
                        }

                        if (isset($subMenu['sub_menu'])) {
                            foreach ($subMenu['sub_menu'] as $lastSubmenu) {
                                if ($lastSubmenu['page_name'] == $pageName) {
                                    $firstPageName = $menu['page_name'];
                                    $secondPageName = $subMenu['page_name'];
                                    $thirdPageName = $lastSubmenu['page_name'];
                                }       
                            }
                        }
                    }
                }
            }
        } else if ($layout == 'simple-menu') {
            foreach ($this->simpleMenu() as $menu) {
                if ($menu !== 'devider' && $menu['page_name'] == $pageName && empty($firstPageName)) {
                    $firstPageName = $menu['page_name'];
                }

                if (isset($menu['sub_menu'])) {
                    foreach ($menu['sub_menu'] as $subMenu) {
                        if ($subMenu['page_name'] == $pageName && empty($secondPageName) && $subMenu['page_name'] != 'dashboard') {
                            $firstPageName = $menu['page_name'];
                            $secondPageName = $subMenu['page_name'];
                        }

                        if (isset($subMenu['sub_menu'])) {
                            foreach ($subMenu['sub_menu'] as $lastSubmenu) {
                                if ($lastSubmenu['page_name'] == $pageName) {
                                    $firstPageName = $menu['page_name'];
                                    $secondPageName = $subMenu['page_name'];
                                    $thirdPageName = $lastSubmenu['page_name'];
                                }       
                            }
                        }
                    }
                }
            }
        } else {
            foreach ($this->sideMenu() as $menu) {
                if ($menu !== 'devider' && $menu['page_name'] == $pageName && empty($firstPageName)) {
                    $firstPageName = $menu['page_name'];
                }

                if (isset($menu['sub_menu'])) {
                    foreach ($menu['sub_menu'] as $subMenu) {
                        if ($subMenu['page_name'] == $pageName && empty($secondPageName) && $subMenu['page_name'] != 'dashboard') {
                            $firstPageName = $menu['page_name'];
                            $secondPageName = $subMenu['page_name'];
                        }

                        if (isset($subMenu['sub_menu'])) {
                            foreach ($subMenu['sub_menu'] as $lastSubmenu) {
                                if ($lastSubmenu['page_name'] == $pageName) {
                                    $firstPageName = $menu['page_name'];
                                    $secondPageName = $subMenu['page_name'];
                                    $thirdPageName = $lastSubmenu['page_name'];
                                }       
                            }
                        }
                    }
                }
            }
        }

        return [
            'first_page_name' => $firstPageName,
            'second_page_name' => $secondPageName,
            'third_page_name' => $thirdPageName
        ];
    }

    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sideMenu()
    {
        return [
            'dashboard' => [
                'icon' => 'home',
                'layout' => 'side-menu',
                'page_name' => 'dashboard',
                'title' => 'Dashboard'
            ],
            /*'menu-layout' => [
                'icon' => 'box',
                'page_name' => 'menu-layout',
                'title' => 'Menu Layout',
                'sub_menu' => [
                    'side-menu' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'dashboard',
                        'title' => 'Side Menu'
                    ],
                    'simple-menu' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'dashboard',
                        'title' => 'Simple Menu'
                    ],
                    'top-menu' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'dashboard',
                        'title' => 'Top Menu'
                    ]
                ]
            ],
            'inbox' => [
                'icon' => 'inbox',
                'layout' => 'side-menu',
                'page_name' => 'inbox',
                'title' => 'Inbox'
            ],
            'file-manager' => [
                'icon' => 'hard-drive',
                'layout' => 'side-menu',
                'page_name' => 'file-manager',
                'title' => 'File Manager'
            ],
            'point-of-sale' => [
                'icon' => 'credit-card',
                'layout' => 'side-menu',
                'page_name' => 'point-of-sale',
                'title' => 'Point of Sale'
            ],
            'chat' => [
                'icon' => 'message-square',
                'layout' => 'side-menu',
                'page_name' => 'chat',
                'title' => 'Chat'
            ],
            'post' => [
                'icon' => 'file-text',
                'layout' => 'side-menu',
                'page_name' => 'post',
                'title' => 'Post'
            ], */
            'devider',
            'work-order' => [
                'icon' => 'inbox',
                'page_name' => 'work-order',
                'title' => 'Work Order',
                'sub_menu' => [
                    'pm-wo' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'pm-wo-data-list',
                        'title' => 'PM Work Order',
                    ],
                    'adhoc-wo' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'adhoc-wo-data-list',
                        'title' => 'Adhoc Work Order'
                    ],
                    'imbas-petir-wo' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'imbas-petir-wo-data-list',
                        'title' => 'Imbas Petir WO'
                    ],
                    'assignment-wo' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'assignment-wo-data-list',
                        'title' => 'Assignment Work Order'
                    ]
                ]
            ],
            'devider',
            'Master Data' => [
                'icon' => 'layers',
                'page_name' => 'master-data',
                'title' => 'Master Data',
                'sub_menu' => [
                    'users' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'user-management',
                        'title' => 'User Management'
                    ],
                    'companies' => [
                        'icon' => 'framer',
                        'layout' => 'simple-menu',
                        'page_name' => 'dashboard',
                        'title' => 'Companies Management'
                    ],
                    'partner' => [
                        'icon' => 'target',
                        'layout' => 'simple-menu',
                        'page_name' => 'partner-management',
                        'title' => 'Partner Management'
                    ],
                    'customer' => [
                        'icon' => 'radio',
                        'layout' => 'simple-menu',
                        'page_name' => 'customer-management',
                        'title' => 'Customer Management'
                    ]
                ]
            ],
            'site' => [
                'icon' => 'map',
                'page_name' => 'site',
                'title' => 'Site Management',
                'sub_menu' => [
                    'site-man' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'site-man',
                        'title' => 'Site Data'
                    ],
                    'location' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'Location',
                        'title' => 'Location'
                    ],
                    'area' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'area',
                        'title' => 'Area'
                    ],
                    'municipality' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'municipality',
                        'title' => 'Municipality'
                    ],
                    'Site Support' => [
                        'icon' => '',
                        'page_name' => 'site-support',
                        'title' => 'Site Support',
                        'sub_menu' => [
                            'site-type' => [
                                'icon' => '',
                                'layout' => 'side-menu',
                                'page_name' => 'site-type',
                                'title' => 'Site Type'
                            ],
                            'site-category' => [
                                'icon' => '',
                                'layout' => 'side-menu',
                                'page_name' => 'site-category',
                                'title' => 'Site Category'
                            ],
                            'services-point' => [
                                'icon' => '',
                                'layout' => 'side-menu',
                                'page_name' => 'services-category',
                                'title' => 'Site Category'
                            ],
                            'site-assets' => [
                                'icon' => '',
                                'layout' => 'side-menu',
                                'page_name' => 'site-assets',
                                'title' => 'Site Assets'
                            ]
                        ]
                    ]

                ]
            ],
            'devider',
            'JobPlan' => [
                'icon' => 'layout',
                'page_name' => 'JobPlan',
                'title' => 'Job/Work Plan',
                'sub_menu' => [
                    'WorkGroup' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'work-group',
                        'title' => 'Work Group'
                    ],
                    'worktype' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'work-type',
                        'title' => 'Work Type'
                    ],
                    'workform' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'work-form',
                        'title' => 'Work Form'
                    ],
                    'workformplan' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'work-form-plan',
                        'title' => 'Work Form Plan'
                    ]
                ]
            ],
            'devider',
            'report' => [
                'icon' => 'pie-chart',
                'page_name' => 'report',
                'title' => 'Report',
                'sub_menu' => [
                    'PM Report' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'pm-report',
                        'title' => 'PM Report'
                    ],
                    'adhoc-report' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'adhoc-report',
                        'title' => 'Adhoc Report'
                    ],
                    'punchlist-report' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'punchlist-report',
                        'title' => 'Punchlist Report'
                    ],
                    'punchlist-tt' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'punchlist-tt-report',
                        'title' => 'Punchlist TT Report'
                    ]
                ]
            ],
            'setting' => [
                'icon' => 'settings',
                'page_name' => 'backups',
                'title' => 'Setting',
                'sub_menu' => [
                    'backups' => [
                        'icon' => 'hard-drive',
                        'layout' => 'side-menu',
                        'page_name' => 'backup-restore',
                        'title' => 'Backup/Restore DB'
                    ],
                    'logs' => [
                        'icon' => 'file-text',
                        'layout' => 'side-menu',
                        'page_name' => 'logs',
                        'title' => 'Logs Data'
                    ],
                    'schedule' => [
                        'icon' => 'tag',
                        'layout' => 'side-menu',
                        'page_name' => 'schedules-man',
                        'title' => 'Schedules'
                    ]
                ]
            ]
        ];
    }

    /**
     * List of simple menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function simpleMenu()
    {
        return [
            'dashboard' => [
                'icon' => 'home',
                'layout' => 'simple-menu',
                'page_name' => 'dashboard',
                'title' => 'Dashboard'
            ],
            'menu-layout' => [
                'icon' => 'box',
                'page_name' => 'menu-layout',
                'title' => 'Menu Layout',
                'sub_menu' => [
                    'side-menu' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'dashboard',
                        'title' => 'Side Menu'
                    ],
                    'simple-menu' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'dashboard',
                        'title' => 'Simple Menu'
                    ],
                    'top-menu' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'dashboard',
                        'title' => 'Top Menu'
                    ]
                ]
            ],
            'inbox' => [
                'icon' => 'inbox',
                'layout' => 'simple-menu',
                'page_name' => 'inbox',
                'title' => 'Inbox'
            ],
            'file-manager' => [
                'icon' => 'hard-drive',
                'layout' => 'simple-menu',
                'page_name' => 'file-manager',
                'title' => 'File Manager'
            ],
            'point-of-sale' => [
                'icon' => 'credit-card',
                'layout' => 'simple-menu',
                'page_name' => 'point-of-sale',
                'title' => 'Point of Sale'
            ],
            'chat' => [
                'icon' => 'message-square',
                'layout' => 'simple-menu',
                'page_name' => 'chat',
                'title' => 'Chat'
            ],
            'post' => [
                'icon' => 'file-text',
                'layout' => 'simple-menu',
                'page_name' => 'post',
                'title' => 'Post'
            ],
            'devider',
            'crud' => [
                'icon' => 'edit',
                'page_name' => 'crud',
                'title' => 'Crud',
                'sub_menu' => [
                    'crud-data-list' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'crud-data-list',
                        'title' => 'Data List'
                    ],
                    'crud-form' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'crud-form',
                        'title' => 'Form'
                    ]
                ]
            ],
            'users' => [
                'icon' => 'users',
                'page_name' => 'users',
                'title' => 'Users',
                'sub_menu' => [
                    'users-layout-1' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'users-layout-1',
                        'title' => 'Layout 1'
                    ],
                    'users-layout-2' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'users-layout-2',
                        'title' => 'Layout 2'
                    ],
                    'users-layout-3' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'users-layout-3',
                        'title' => 'Layout 3'
                    ]
                ]
            ],
            'profile' => [
                'icon' => 'trello',
                'page_name' => 'profile',
                'title' => 'Profile',
                'sub_menu' => [
                    'profile-overview-1' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'profile-overview-1',
                        'title' => 'Overview 1'
                    ],
                    'profile-overview-2' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'profile-overview-2',
                        'title' => 'Overview 2'
                    ],
                    'profile-overview-3' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'profile-overview-3',
                        'title' => 'Overview 3'
                    ]
                ]
            ],
            'pages' => [
                'icon' => 'layout',
                'page_name' => 'layout',
                'title' => 'Pages',
                'sub_menu' => [
                    'wizards' => [
                        'icon' => '',
                        'page_name' => 'wizards',
                        'title' => 'Wizards',
                        'sub_menu' => [
                            'wizard-layout-1' => [
                                'icon' => '',
                                'layout' => 'simple-menu',
                                'page_name' => 'wizard-layout-1',
                                'title' => 'Layout 1'
                            ],
                            'wizard-layout-2' => [
                                'icon' => '',
                                'layout' => 'simple-menu',
                                'page_name' => 'wizard-layout-2',
                                'title' => 'Layout 2'
                            ],
                            'wizard-layout-3' => [
                                'icon' => '',
                                'layout' => 'simple-menu',
                                'page_name' => 'wizard-layout-3',
                                'title' => 'Layout 3'
                            ]
                        ]
                    ],
                    'blog' => [
                        'icon' => '',
                        'page_name' => 'blog',
                        'title' => 'Blog',
                        'sub_menu' => [
                            'blog-layout-1' => [
                                'icon' => '',
                                'layout' => 'simple-menu',
                                'page_name' => 'blog-layout-1',
                                'title' => 'Layout 1'
                            ],
                            'blog-layout-2' => [
                                'icon' => '',
                                'layout' => 'simple-menu',
                                'page_name' => 'blog-layout-2',
                                'title' => 'Layout 2'
                            ],
                            'blog-layout-3' => [
                                'icon' => '',
                                'layout' => 'simple-menu',
                                'page_name' => 'blog-layout-3',
                                'title' => 'Layout 3'
                            ]
                        ]
                    ],
                    'pricing' => [
                        'icon' => '',
                        'page_name' => 'pricing',
                        'title' => 'Pricing',
                        'sub_menu' => [
                            'pricing-layout-1' => [
                                'icon' => '',
                                'layout' => 'simple-menu',
                                'page_name' => 'pricing-layout-1',
                                'title' => 'Layout 1'
                            ],
                            'pricing-layout-2' => [
                                'icon' => '',
                                'layout' => 'simple-menu',
                                'page_name' => 'pricing-layout-2',
                                'title' => 'Layout 2'
                            ]
                        ]
                    ],
                    'invoice' => [
                        'icon' => '',
                        'page_name' => 'invoice',
                        'title' => 'Invoice',
                        'sub_menu' => [
                            'invoice-layout-1' => [
                                'icon' => '',
                                'layout' => 'simple-menu',
                                'page_name' => 'invoice-layout-1',
                                'title' => 'Layout 1'
                            ],
                            'invoice-layout-2' => [
                                'icon' => '',
                                'layout' => 'simple-menu',
                                'page_name' => 'invoice-layout-2',
                                'title' => 'Layout 2'
                            ]
                        ]
                    ],
                    'faq' => [
                        'icon' => '',
                        'page_name' => 'faq',
                        'title' => 'FAQ',
                        'sub_menu' => [
                            'faq-layout-1' => [
                                'icon' => '',
                                'layout' => 'simple-menu',
                                'page_name' => 'faq-layout-1',
                                'title' => 'Layout 1'
                            ],
                            'faq-layout-2' => [
                                'icon' => '',
                                'layout' => 'simple-menu',
                                'page_name' => 'faq-layout-2',
                                'title' => 'Layout 2'
                            ],
                            'faq-layout-3' => [
                                'icon' => '',
                                'layout' => 'simple-menu',
                                'page_name' => 'faq-layout-3',
                                'title' => 'Layout 3'
                            ]
                        ]
                    ],
                    'login' => [
                        'icon' => '',
                        'layout' => 'login',
                        'page_name' => 'login',
                        'title' => 'Login'
                    ],
                    'register' => [
                        'icon' => '',
                        'layout' => 'login',
                        'page_name' => 'register',
                        'title' => 'Register'
                    ],
                    'error-page' => [
                        'icon' => '',
                        'layout' => 'main',
                        'page_name' => 'error-page',
                        'title' => 'Error Page'
                    ],
                    'update-profile' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'update-profile',
                        'title' => 'Update profile'
                    ],
                    'change-password' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'change-password',
                        'title' => 'Change Password'
                    ]
                ]
            ],
            'devider',
            'components' => [
                'icon' => 'inbox',
                'page_name' => 'components',
                'title' => 'Components',
                'sub_menu' => [
                    'grid' => [
                        'icon' => '',
                        'page_name' => 'grid',
                        'title' => 'Grid',
                        'sub_menu' => [
                            'regular-table' => [
                                'icon' => '',
                                'layout' => 'simple-menu',
                                'page_name' => 'regular-table',
                                'title' => 'Regular Table'
                            ],
                            'tabulator' => [
                                'icon' => '',
                                'layout' => 'simple-menu',
                                'page_name' => 'tabulator',
                                'title' => 'Tabulator'
                            ]
                        ]
                    ],
                    'accordion' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'accordion',
                        'title' => 'Accordion'
                    ],
                    'button' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'button',
                        'title' => 'Button'
                    ],
                    'modal' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'modal',
                        'title' => 'Modal'
                    ],
                    'alert' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'alert',
                        'title' => 'Alert'
                    ],
                    'progress-bar' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'progress-bar',
                        'title' => 'Progress Bar'
                    ],
                    'tooltip' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'tooltip',
                        'title' => 'Tooltip'
                    ],
                    'dropdown' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'dropdown',
                        'title' => 'Dropdown'
                    ],
                    'toast' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'toast',
                        'title' => 'Toast'
                    ],
                    'typography' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'typography',
                        'title' => 'Typography'
                    ],
                    'icon' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'icon',
                        'title' => 'Icon'
                    ],
                    'loading-icon' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'loading-icon',
                        'title' => 'Loading Icon'
                    ]
                ]
            ],
            'forms' => [
                'icon' => 'sidebar',
                'page_name' => 'forms',
                'title' => 'Forms',
                'sub_menu' => [
                    'regular-form' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'regular-form',
                        'title' => 'Regular Form'
                    ],
                    'datepicker' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'datepicker',
                        'title' => 'Datepicker'
                    ],
                    'tail-select' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'tail-select',
                        'title' => 'Tail Select'
                    ],
                    'file-upload' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'file-upload',
                        'title' => 'File Upload'
                    ],
                    'wysiwyg-editor' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'wysiwyg-editor',
                        'title' => 'Wysiwyg Editor'
                    ],
                    'validation' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'validation',
                        'title' => 'Validation'
                    ]
                ]
            ],
            'widgets' => [
                'icon' => 'hard-drive',
                'page_name' => 'widgets',
                'title' => 'Widgets',
                'sub_menu' => [
                    'chart' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'chart',
                        'title' => 'Chart'
                    ],
                    'slider' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'slider',
                        'title' => 'Slider'
                    ],
                    'image-zoom' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'image-zoom',
                        'title' => 'Image Zoom'
                    ]
                ]
            ]
        ];
    }

    /**
     * List of top menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function topMenu()
    {
        return [
            'dashboard' => [
                'icon' => 'home',
                'layout' => 'top-menu',
                'page_name' => 'dashboard',
                'title' => 'Dashboard'
            ],
            'menu-layout' => [
                'icon' => 'box',
                'page_name' => 'menu-layout',
                'title' => 'Menu Layout',
                'sub_menu' => [
                    'side-menu' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'dashboard',
                        'title' => 'Side Menu'
                    ],
                    'simple-menu' => [
                        'icon' => '',
                        'layout' => 'simple-menu',
                        'page_name' => 'dashboard',
                        'title' => 'Simple Menu'
                    ],
                    'top-menu' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'dashboard',
                        'title' => 'Top Menu'
                    ]
                ]
            ],
            'apps' => [
                'icon' => 'activity',
                'page_name' => 'apps',
                'title' => 'Apps',
                'sub_menu' => [
                    'users' => [
                        'icon' => 'users',
                        'page_name' => 'users',
                        'title' => 'Users',
                        'sub_menu' => [
                            'users-layout-1' => [
                                'icon' => '',
                                'layout' => 'top-menu',
                                'page_name' => 'users-layout-1',
                                'title' => 'Layout 1'
                            ],
                            'users-layout-2' => [
                                'icon' => '',
                                'layout' => 'top-menu',
                                'page_name' => 'users-layout-2',
                                'title' => 'Layout 2'
                            ],
                            'users-layout-3' => [
                                'icon' => '',
                                'layout' => 'top-menu',
                                'page_name' => 'users-layout-3',
                                'title' => 'Layout 3'
                            ]
                        ]
                    ],
                    'profile' => [
                        'icon' => 'trello',
                        'page_name' => 'profile',
                        'title' => 'Profile',
                        'sub_menu' => [
                            'profile-overview-1' => [
                                'icon' => '',
                                'layout' => 'top-menu',
                                'page_name' => 'profile-overview-1',
                                'title' => 'Overview 1'
                            ],
                            'profile-overview-2' => [
                                'icon' => '',
                                'layout' => 'top-menu',
                                'page_name' => 'profile-overview-2',
                                'title' => 'Overview 2'
                            ],
                            'profile-overview-3' => [
                                'icon' => '',
                                'layout' => 'top-menu',
                                'page_name' => 'profile-overview-3',
                                'title' => 'Overview 3'
                            ]
                        ]
                    ],
                    'inbox' => [
                        'icon' => 'inbox',
                        'layout' => 'top-menu',
                        'page_name' => 'inbox',
                        'title' => 'Inbox'
                    ],
                    'file-manager' => [
                        'icon' => 'folder',
                        'layout' => 'top-menu',
                        'page_name' => 'file-manager',
                        'title' => 'File Manager'
                    ],
                    'point-of-sale' => [
                        'icon' => 'credit-card',
                        'layout' => 'top-menu',
                        'page_name' => 'point-of-sale',
                        'title' => 'Point of Sale'
                    ],
                    'chat' => [
                        'icon' => 'message-square',
                        'layout' => 'top-menu',
                        'page_name' => 'chat',
                        'title' => 'Chat'
                    ],
                    'post' => [
                        'icon' => 'file-text',
                        'layout' => 'top-menu',
                        'page_name' => 'post',
                        'title' => 'Post'
                    ],
                    'crud' => [
                        'icon' => 'edit',
                        'page_name' => 'crud',
                        'title' => 'Crud',
                        'sub_menu' => [
                            'crud-data-list' => [
                                'icon' => '',
                                'layout' => 'side-menu',
                                'page_name' => 'crud-data-list',
                                'title' => 'Data List'
                            ],
                            'crud-form' => [
                                'icon' => '',
                                'layout' => 'side-menu',
                                'page_name' => 'crud-form',
                                'title' => 'Form'
                            ]
                        ]
                    ]
                ]
            ],
            'pages' => [
                'icon' => 'layout',
                'page_name' => 'layout',
                'title' => 'Pages',
                'sub_menu' => [
                    'wizards' => [
                        'icon' => '',
                        'page_name' => 'wizards',
                        'title' => 'Wizards',
                        'sub_menu' => [
                            'wizard-layout-1' => [
                                'icon' => '',
                                'layout' => 'top-menu',
                                'page_name' => 'wizard-layout-1',
                                'title' => 'Layout 1'
                            ],
                            'wizard-layout-2' => [
                                'icon' => '',
                                'layout' => 'top-menu',
                                'page_name' => 'wizard-layout-2',
                                'title' => 'Layout 2'
                            ],
                            'wizard-layout-3' => [
                                'icon' => '',
                                'layout' => 'top-menu',
                                'page_name' => 'wizard-layout-3',
                                'title' => 'Layout 3'
                            ]
                        ]
                    ],
                    'blog' => [
                        'icon' => '',
                        'page_name' => 'blog',
                        'title' => 'Blog',
                        'sub_menu' => [
                            'blog-layout-1' => [
                                'icon' => '',
                                'layout' => 'top-menu',
                                'page_name' => 'blog-layout-1',
                                'title' => 'Layout 1'
                            ],
                            'blog-layout-2' => [
                                'icon' => '',
                                'layout' => 'top-menu',
                                'page_name' => 'blog-layout-2',
                                'title' => 'Layout 2'
                            ],
                            'blog-layout-3' => [
                                'icon' => '',
                                'layout' => 'top-menu',
                                'page_name' => 'blog-layout-3',
                                'title' => 'Layout 3'
                            ]
                        ]
                    ],
                    'pricing' => [
                        'icon' => '',
                        'page_name' => 'pricing',
                        'title' => 'Pricing',
                        'sub_menu' => [
                            'pricing-layout-1' => [
                                'icon' => '',
                                'layout' => 'top-menu',
                                'page_name' => 'pricing-layout-1',
                                'title' => 'Layout 1'
                            ],
                            'pricing-layout-2' => [
                                'icon' => '',
                                'layout' => 'top-menu',
                                'page_name' => 'pricing-layout-2',
                                'title' => 'Layout 2'
                            ]
                        ]
                    ],
                    'invoice' => [
                        'icon' => '',
                        'page_name' => 'invoice',
                        'title' => 'Invoice',
                        'sub_menu' => [
                            'invoice-layout-1' => [
                                'icon' => '',
                                'layout' => 'top-menu',
                                'page_name' => 'invoice-layout-1',
                                'title' => 'Layout 1'
                            ],
                            'invoice-layout-2' => [
                                'icon' => '',
                                'layout' => 'top-menu',
                                'page_name' => 'invoice-layout-2',
                                'title' => 'Layout 2'
                            ]
                        ]
                    ],
                    'faq' => [
                        'icon' => '',
                        'page_name' => 'faq',
                        'title' => 'FAQ',
                        'sub_menu' => [
                            'faq-layout-1' => [
                                'icon' => '',
                                'layout' => 'top-menu',
                                'page_name' => 'faq-layout-1',
                                'title' => 'Layout 1'
                            ],
                            'faq-layout-2' => [
                                'icon' => '',
                                'layout' => 'top-menu',
                                'page_name' => 'faq-layout-2',
                                'title' => 'Layout 2'
                            ],
                            'faq-layout-3' => [
                                'icon' => '',
                                'layout' => 'top-menu',
                                'page_name' => 'faq-layout-3',
                                'title' => 'Layout 3'
                            ]
                        ]
                    ],
                    'login' => [
                        'icon' => '',
                        'layout' => 'login',
                        'page_name' => 'login',
                        'title' => 'Login'
                    ],
                    'register' => [
                        'icon' => '',
                        'layout' => 'login',
                        'page_name' => 'register',
                        'title' => 'Register'
                    ],
                    'error-page' => [
                        'icon' => '',
                        'layout' => 'main',
                        'page_name' => 'error-page',
                        'title' => 'Error Page'
                    ],
                    'update-profile' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'update-profile',
                        'title' => 'Update profile'
                    ],
                    'change-password' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'change-password',
                        'title' => 'Change Password'
                    ]
                ]
            ],
            'components' => [
                'icon' => 'inbox',
                'page_name' => 'components',
                'title' => 'Components',
                'sub_menu' => [
                    'grid' => [
                        'icon' => '',
                        'page_name' => 'grid',
                        'title' => 'Grid',
                        'sub_menu' => [
                            'regular-table' => [
                                'icon' => '',
                                'layout' => 'top-menu',
                                'page_name' => 'regular-table',
                                'title' => 'Regular Table'
                            ],
                            'tabulator' => [
                                'icon' => '',
                                'layout' => 'top-menu',
                                'page_name' => 'tabulator',
                                'title' => 'Tabulator'
                            ]
                        ]
                    ],
                    'accordion' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'accordion',
                        'title' => 'Accordion'
                    ],
                    'button' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'button',
                        'title' => 'Button'
                    ],
                    'modal' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'modal',
                        'title' => 'Modal'
                    ],
                    'alert' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'alert',
                        'title' => 'Alert'
                    ],
                    'progress-bar' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'progress-bar',
                        'title' => 'Progress Bar'
                    ],
                    'tooltip' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'tooltip',
                        'title' => 'Tooltip'
                    ],
                    'dropdown' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'dropdown',
                        'title' => 'Dropdown'
                    ],
                    'toast' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'toast',
                        'title' => 'Toast'
                    ],
                    'typography' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'typography',
                        'title' => 'Typography'
                    ],
                    'icon' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'icon',
                        'title' => 'Icon'
                    ],
                    'loading-icon' => [
                        'icon' => '',
                        'layout' => 'side-menu',
                        'page_name' => 'loading-icon',
                        'title' => 'Loading Icon'
                    ]
                ]
            ],
            'forms' => [
                'icon' => 'sidebar',
                'page_name' => 'forms',
                'title' => 'Forms',
                'sub_menu' => [
                    'regular-form' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'regular-form',
                        'title' => 'Regular Form'
                    ],
                    'datepicker' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'datepicker',
                        'title' => 'Datepicker'
                    ],
                    'tail-select' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'tail-select',
                        'title' => 'Tail Select'
                    ],
                    'file-upload' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'file-upload',
                        'title' => 'File Upload'
                    ],
                    'wysiwyg-editor' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'wysiwyg-editor',
                        'title' => 'Wysiwyg Editor'
                    ],
                    'validation' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'validation',
                        'title' => 'Validation'
                    ]
                ]
            ],
            'widgets' => [
                'icon' => 'hard-drive',
                'page_name' => 'widgets',
                'title' => 'Widgets',
                'sub_menu' => [
                    'chart' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'chart',
                        'title' => 'Chart'
                    ],
                    'slider' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'slider',
                        'title' => 'Slider'
                    ],
                    'image-zoom' => [
                        'icon' => '',
                        'layout' => 'top-menu',
                        'page_name' => 'image-zoom',
                        'title' => 'Image Zoom'
                    ]
                ]
            ]
        ];
    }
}
