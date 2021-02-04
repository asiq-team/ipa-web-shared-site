<x-app-layout>
    <x-slot name="title">
            {{ __('IPA Overview WO') }}
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
                        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
                            <a href="" class="">Overview</a>
                        </div>
                    </x-slot>
                </x-top-bar>
                <div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">IPA Workorder Overview</h2>
                </div>
                <!-- BEGIN: Pricing Layout -->
                <div class="intro-y box flex flex-col lg:flex-row mt-5">
                    <div class="intro-y flex-1 px-5 py-16">
                        <i data-feather="paperclip" class="w-12 h-12 text-theme-1 dark:text-theme-10 mx-auto"></i>
                        <div class="text-xl font-medium text-center mt-10">Draft</div>
                        <div class="text-gray-700 dark:text-gray-600 text-center mt-5">
                            {{ $draft['active'] }} Draft <span class="mx-1">•</span> {{ $draft['delete'] }} Delete 
                        </div>
                        <div class="text-gray-600 dark:text-gray-400 px-10 text-center mx-auto mt-2">Draft workorder</div>
                        <div class="flex justify-center">
                            <div class="relative text-5xl font-semibold mt-8 mx-auto">
                            {{ $draft['total'] }}
                            </div>
                        </div>
                        <a href="{{ route('tower.wo.draft') }}" class="button button--lg block text-white bg-theme-1 mx-auto mt-8">DETAIL</a>
                    </div>
                    <div class="intro-y border-b border-t lg:border-b-0 lg:border-t-0 flex-1 p-5 lg:border-l lg:border-r border-gray-200 dark:border-dark-5 py-16">
                        <i data-feather="briefcase" class="w-12 h-12 text-theme-1 dark:text-theme-10 mx-auto"></i>
                        <div class="text-xl font-medium text-center mt-10">Draft Plan</div>
                        <div class="text-gray-700 dark:text-gray-600 text-center mt-5">
                            Tersedia setiap tanggal 25
                        </div>
                        <div class="text-gray-600 dark:text-gray-400 px-10 text-center mx-auto mt-2">Periode bulan berikutnya</div>
                        <div class="flex justify-center">
                            <div class="relative text-5xl font-semibold mt-8 mx-auto">
                             {{ $plan }}
                            </div>
                        </div>
                        <a href="{{ route('tower.wo.plan') }}" class="button button--lg block text-white bg-theme-1 mx-auto mt-8">DETAIL</a>
                    </div>
                    <div class="intro-y flex-1 px-5 py-16">
                        <i data-feather="shopping-bag" class="w-12 h-12 text-theme-1 dark:text-theme-10 mx-auto"></i>
                        <div class="text-xl font-medium text-center mt-10">Released Plan</div>
                        <div class="text-gray-700 dark:text-gray-600 text-center mt-5">
                            Workorder periode bulan berjalan
                        </div>
                        <div class="text-gray-600 dark:text-gray-400 px-10 text-center mx-auto mt-2">Released Plan</div>
                        <div class="flex justify-center">
                            <div class="relative text-5xl font-semibold mt-8 mx-auto">
                            {{ $release }}
                            </div>
                        </div>
                        <a href="{{ route('tower.wo.release') }}" class="button button--lg block text-white bg-theme-1 mx-auto mt-8">DETAIL</a>
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
