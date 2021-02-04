<x-app-layout>
    <x-slot name="title">
            {{ __('IPA Work Order') }}
    </x-slot>
    <x-slot name="style">
        <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"  rel="stylesheet">
        <!-- <link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css" rel="stylesheet"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />        
        <style>
		
		/*Overrides for Tailwind CSS */
		
		/*Form fields*/
		.dataTables_wrapper select,
		.dataTables_wrapper .dataTables_filter input {
			color: #4a5568; 			/*text-gray-700*/
			padding-left: 1rem; 		/*pl-4*/
			padding-right: 1rem; 		/*pl-4*/
			padding-top: .5rem; 		/*pl-2*/
			padding-bottom: .5rem; 		/*pl-2*/
			line-height: 1.25; 			/*leading-tight*/
			border-width: 2px; 			/*border-2*/
			border-radius: .25rem; 		
			border-color: #edf2f7; 		/*border-gray-200*/
			background-color: #edf2f7; 	/*bg-gray-200*/
		}

		/*Row Hover*/
		table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
			background-color: #ebf4ff;	/*bg-indigo-100*/
		}
		
		/*Pagination Buttons*/
		.dataTables_wrapper .dataTables_paginate .paginate_button		{
			font-weight: 700;				/*font-bold*/
			border-radius: .25rem;			/*rounded*/
			border: 1px solid transparent;	/*border border-transparent*/
		}
		
		/*Pagination Buttons - Current selected */
		.dataTables_wrapper .dataTables_paginate .paginate_button.current	{
			color: #fff !important;				/*text-white*/
			box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06); 	/*shadow*/
			font-weight: 700;					/*font-bold*/
			border-radius: .25rem;				/*rounded*/
			background: #667eea !important;		/*bg-indigo-500*/
			border: 1px solid transparent;		/*border border-transparent*/
		}

		/*Pagination Buttons - Hover */
		.dataTables_wrapper .dataTables_paginate .paginate_button:hover		{
			color: #fff !important;				/*text-white*/
			box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);	 /*shadow*/
			font-weight: 700;					/*font-bold*/
			border-radius: .25rem;				/*rounded*/
			background: #667eea !important;		/*bg-indigo-500*/
			border: 1px solid transparent;		/*border border-transparent*/
		}
		
		/*Add padding to bottom border */
		table.dataTable.no-footer {
			border-bottom: 1px solid #e2e8f0;	/*border-b-1 border-gray-300*/
			margin-top: 0.75em;
			margin-bottom: 0.75em;
		}
		
		/*Change colour of responsive icon*/
		table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before, table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
			background-color: #667eea !important; /*bg-indigo-500*/
		}
		
      </style>
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
                            <a href="{{ route('tower.wo.overview') }}" class="breadcrumb--active">Overview</a>
                            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
                            <a href="" class="">Workorder</a>
                        </div>
                    </x-slot>
                </x-top-bar>
                <div class="col-span-12 mt-6">
                    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                        <h2 class="text-lg font-medium mr-auto">Workorder</h2>
                        <div class="w-full sm:w-auto flex">
                            <div class="dropdown mr-2">
                                <button class="dropdown-toggle button px-2 box text-gray-700 dark:text-gray-300">
                                    <span class="w-5 h-5 flex items-center justify-center">
                                        <i class="w-4 h-4" data-feather="search"></i>
                                    </span>
                                </button>
                                <div class="inbox-filter__dropdown-box dropdown-box pt-2">
                                    <div class="dropdown-box__content box p-5">
                                        <div class="grid grid-cols-12 gap-4 row-gap-3">
                                            <div class="col-span-6">
                                                <div class="text-xs">File Name</div>
                                                <input type="text" class="input w-full border mt-2 flex-1" placeholder="Type the file name">
                                            </div>
                                            <div class="col-span-6">
                                                <div class="text-xs">Shared With</div>
                                                <input type="text" class="input w-full border mt-2 flex-1" placeholder="example@gmail.com">
                                            </div>
                                            <div class="col-span-6">
                                                <div class="text-xs">Created At</div>
                                                <input type="text" class="input w-full border mt-2 flex-1" placeholder="Important Meeting">
                                            </div>
                                            <div class="col-span-6">
                                                <div class="text-xs">Size</div>
                                                <select class="input w-full border mt-2 flex-1">
                                                    <option>10</option>
                                                    <option>25</option>
                                                    <option>35</option>
                                                    <option>50</option>
                                                </select>
                                            </div>
                                            <div class="col-span-12 flex items-center mt-3">
                                                <button class="button w-32 justify-center block bg-gray-200 dark:bg-dark-1 text-gray-600 dark:text-gray-300 ml-auto">Create Filter</button>
                                                <button class="button w-32 justify-center block bg-theme-1 text-white ml-2">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- BEGIN: Datatable -->
                    <div class="intro-y datatable-wrapper box p-5 mt-5">
                        <table class="table">
                            <tbody>
                                @forelse($workorders as $workorder)
                                <tr>
                                    <td class="border border-b dark:border-dark-5" style="width:30%">
                                        <div class="whitespace-no-wrap">Site Name</div>
                                    </td>
                                    <td class="border text-left border-b dark:border-dark-5 w-32">{{ $workorder->site->name }}</td>
                                </tr>
                                <tr>
                                    <td class="border border-b dark:border-dark-5" style="width:30%">
                                        <div class="whitespace-no-wrap">Site Id</div>
                                    </td>
                                    <td class="border text-left border-b dark:border-dark-5 w-32">{{ $workorder->site->code }}</td>
                                </tr>
                                <tr>
                                    <td class="border border-b dark:border-dark-5" style="width:30%">
                                        <div class="whitespace-no-wrap">Periode</div>
                                    </td>
                                    <td class="border text-left border-b dark:border-dark-5 w-32">{{ $workorder->periode->label }}</td>
                                </tr>
                                <tr>
                                    <td class="border border-b dark:border-dark-5" style="width:30%">
                                        <div class="whitespace-no-wrap">Milestone</div>
                                    </td>
                                    <td class="border text-left border-b dark:border-dark-5 w-32">{{ $workorder->milestone->label }}</td>
                                </tr>
                                <tr>
                                    <td class="border border-b dark:border-dark-5" style="width:30%">
                                        <div class="whitespace-no-wrap">Form Template</div>
                                    </td>
                                    <td class="border text-left border-b dark:border-dark-5 w-32">{{ $workorder->form->name }}</td>
                                </tr>
                                <tr>
                                    <td class="border border-b dark:border-dark-5" style="width:30%">
                                        <div class="whitespace-no-wrap">Tenant</div>
                                    </td>
                                    <td class="border text-left border-b dark:border-dark-5 w-32">
                                        @php
                                            $tenants=$workorder->tenant;
                                        @endphp
                                        <div class="flex lg:justify-left">
                                            @forelse($tenants as $tenant)
                                                <div class="w-6 h-6 image-fit zoom-in">
                                                    <img alt="{{ $tenant->name }}" class="tooltip rounded-full bg-logo-white" src="{{ $tenant->logo }}" title="{{ $tenant->name }}">
                                                </div>
                                                &nbsp;&nbsp;&nbsp;
                                            @empty
                                                No Data
                                            @endforelse
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-b dark:border-dark-5" style="width:30%">
                                        <div class="whitespace-no-wrap">Progress</div>
                                    </td>
                                    <td class="border text-left border-b dark:border-dark-5 w-32">
                                        <div class="w-full h-4 bg-gray-400 dark:bg-dark-1 rounded">
                                            <div class="w-0 h-full bg-theme-1 rounded text-center text-xs text-white">0%</div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="border border-b dark:border-dark-5" style="width:30%">
                                        <div class="whitespace-no-wrap">No data</div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div> <!-- END: Content -->
            </div> 
        </div>
    </x-slot>
    <x-slot name="script">
        <script src="{{ mix('dist/js/app.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
        <!-- <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" integrity="sha512-F5QTlBqZlvuBEs9LQPqc1iZv2UMxcVXezbHzomzS6Df4MZMClge/8+gXrKw2fl5ysdk4rWjR0vKS7NNkfymaBQ==" crossorigin="anonymous"></script>      
        <script>
            $(document).ready( function () {

            } );

            function editRow(id){
                url_raw = "{{ route('tower.wo.draft.edit',['id'=>':id']) }}";
                url = url_raw.replace(':id',id)
                window.location = url
                //console.log(url)
            }

            function show(id){
                alert(id)
                // url_raw = "{{ route('tower.wo.draft.edit',['id'=>':id']) }}";
                // url = url_raw.replace(':id',id)
                // window.location = url
                //console.log(url)
            }

            function deleteRow(id){
                alert(id)
            }
        </script>
    </x-slot>
</x-app-layout>