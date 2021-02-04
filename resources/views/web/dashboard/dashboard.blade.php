<x-app-layout>
    <x-slot name="title">
            {{ __('Dashboard') }}
    </x-slot>
    <x-slot name="style">
            
    </x-slot>
    <x-slot name="body">
        <div class="flex">
            <!-- BEGIN: Side Menu -->
            <x-side-menu />
           
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                <x-top-bar>
                    <x-slot name="breadcrumb">
                        
                    </x-slot>
                </x-top-bar>
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
                        <div class="col-span-12 mt-8">
                            <div class="intro-y flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">IPA TOWER - General Info</h2>
                                <a href="" class="ml-auto flex text-theme-1 dark:text-theme-10">
                                    <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
                                </a>
                            </div>
                            <div class="grid grid-cols-12 gap-6 mt-5">
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <div class="report-box zoom-in">
                                        <div class="box p-5">
                                            <div class="flex">
                                                <i data-feather="shopping-cart" class="report-box__icon text-theme-10"></i>
                                                <div class="ml-auto">
                                                    <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="33% Higher than last month">
                                                        33% <i data-feather="chevron-up" class="w-4 h-4"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-3xl font-bold leading-8 mt-6">4.510</div>
                                            <div class="text-base text-gray-600 mt-1">Release PM</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <div class="report-box zoom-in">
                                        <div class="box p-5">
                                            <div class="flex">
                                                <i data-feather="credit-card" class="report-box__icon text-theme-11"></i>
                                                <div class="ml-auto">
                                                    <div class="report-box__indicator bg-theme-6 tooltip cursor-pointer" title="2% Lower than last month">
                                                        2% <i data-feather="chevron-down" class="w-4 h-4"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-3xl font-bold leading-8 mt-6">3.521</div>
                                            <div class="text-base text-gray-600 mt-1">Progress PM</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <div class="report-box zoom-in">
                                        <div class="box p-5">
                                            <div class="flex">
                                                <i data-feather="monitor" class="report-box__icon text-theme-12"></i>
                                                <div class="ml-auto">
                                                    <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="12% Higher than last month">
                                                        12% <i data-feather="chevron-up" class="w-4 h-4"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-3xl font-bold leading-8 mt-6">2.145</div>
                                            <div class="text-base text-gray-600 mt-1">Submit PM</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <div class="report-box zoom-in">
                                        <div class="box p-5">
                                            <div class="flex">
                                                <i data-feather="user" class="report-box__icon text-theme-9"></i>
                                                <div class="ml-auto">
                                                    <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="22% Higher than last month">
                                                        22% <i data-feather="chevron-up" class="w-4 h-4"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-3xl font-bold leading-8 mt-6">1.000</div>
                                            <div class="text-base text-gray-600 mt-1">Approval PM</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- END: General Report -->
                        <div class="col-span-12 mt-8">
                            <div class="intro-y flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">Punchlist Report</h2>
                                <a href="" class="ml-auto flex text-theme-1 dark:text-theme-10">
                                    <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
                                </a>
                            </div>
                            <div class="grid grid-cols-12 gap-6 mt-5">
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <div class="report-box zoom-in">
                                        <div class="box p-5">
                                            <div class="flex">
                                                <i data-feather="shopping-cart" class="report-box__icon text-theme-10"></i>
                                                <div class="ml-auto">
                                                    <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="33% Higher than last month">
                                                        33% <i data-feather="chevron-up" class="w-4 h-4"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-3xl font-bold leading-8 mt-6">100</div>
                                            <div class="text-base text-gray-600 mt-1">Punchlist Found</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <div class="report-box zoom-in">
                                        <div class="box p-5">
                                            <div class="flex">
                                                <i data-feather="credit-card" class="report-box__icon text-theme-11"></i>
                                                <div class="ml-auto">
                                                    <div class="report-box__indicator bg-theme-6 tooltip cursor-pointer" title="2% Lower than last month">
                                                        2% <i data-feather="chevron-down" class="w-4 h-4"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-3xl font-bold leading-8 mt-6">5</div>
                                            <div class="text-base text-gray-600 mt-1">Punchlist Valid</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <div class="report-box zoom-in">
                                        <div class="box p-5">
                                            <div class="flex">
                                                <i data-feather="monitor" class="report-box__icon text-theme-12"></i>
                                                <div class="ml-auto">
                                                    <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="12% Higher than last month">
                                                        12% <i data-feather="chevron-up" class="w-4 h-4"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-3xl font-bold leading-8 mt-6">2</div>
                                            <div class="text-base text-gray-600 mt-1">Punchlist TT</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <div class="report-box zoom-in">
                                        <div class="box p-5">
                                            <div class="flex">
                                                <i data-feather="user" class="report-box__icon text-theme-9"></i>
                                                <div class="ml-auto">
                                                    <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="22% Higher than last month">
                                                        22% <i data-feather="chevron-up" class="w-4 h-4"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-3xl font-bold leading-8 mt-6">1</div>
                                            <div class="text-base text-gray-600 mt-1">Punchlist TT Done</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <!-- END: Punchlist Report -->
                    </div>
                </div>
            </div>
            <!-- END: Content -->
        </div>
    </x-slot>
    <x-slot name="script">
        <script src="{{ mix('dist/js/app.js') }}"></script>

    </x-slot>
</x-app-layout>
