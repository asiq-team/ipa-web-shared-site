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
                            <a href="" class="">Plan</a>
                        </div>
                    </x-slot>
                </x-top-bar>
                <div class="col-span-12 mt-6">
                    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                        <h2 class="text-lg font-medium mr-auto">Workorder Draft Plan</h2>
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
                            <div class="dropdown">
                                <button class="dropdown-toggle button px-2 box text-gray-700 dark:text-gray-300">
                                    <span class="w-5 h-5 flex items-center justify-center">
                                        <i class="w-4 h-4" data-feather="plus"></i>
                                    </span>
                                </button>
                                <div class="dropdown-box w-40">
                                    <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                                    <a href="{{ route('tower.wo.draft.import') }}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
                                            <i data-feather="upload" class="w-4 h-4 mr-2"></i> Import Excel
                                        </a>
                                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
                                            <i data-feather="file-plus" class="w-4 h-4 mr-2"></i> Input Manual
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- BEGIN: Datatable -->
                    <div class="intro-y datatable-wrapper box p-5 mt-5">
                        <table id="tableData" class="table table-report table-report--bordered display stripe hover datatable w-full" style="width:100%" >
                            <thead>
                                <tr >
                                    <th class="border-b-2 text-center whitespace-no-wrap">Site Name</th>
                                    <th class="border-b-2 text-center whitespace-no-wrap">Floc Site</th>
                                    <th class="border-b-2 text-center whitespace-no-wrap">Type Plan</th>
                                    <th class="border-b-2 text-center whitespace-no-wrap">Work Date</th>
                                    <th class="border-b-2 text-center whitespace-no-wrap">Area</th>
                                    <th class="border-b-2 text-center whitespace-no-wrap">Engineer</th>
                                    <th class="border-b-2 text-center whitespace-no-wrap">Tenant</th>
                                    <th class="border-b-2 text-center whitespace-no-wrap"></th>
                                    <!-- <th class="border-b-2 text-center whitespace-no-wrap"></th> -->
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div> <!-- END: Content -->
            </div> 
        </div>

         <!-- Modal -->
         
                                    
        <div class="modal" id="AddDataModal">
            <div class="modal__content modal__content--lg p-10 text-center">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">Broadcast Message</h2>
                </div>
                <div class="p-5 grid grid-cols-12 gap-4 gap-y-3">
                    
                                    
                <div class="flex flex-col sm:flex-row items-center">
                                            <label class="w-full sm:w-20 sm:text-right sm:mr-5">Email</label>
                                            <input type="email" class="input w-full border mt-2 flex-1" placeholder="example@gmail.com">
                                        </div>
                                        <div class="flex flex-col sm:flex-row items-center mt-3">
                                            <label class="w-full sm:w-20 sm:text-right sm:mr-5">Password</label>
                                            <input type="password" class="input w-full border mt-2 flex-1" placeholder="secret">
                                        </div>
                                        <div class="flex items-center text-gray-700 dark:text-gray-500 mt-5 sm:ml-20 sm:pl-5">
                                            <input type="checkbox" class="input border mr-2" id="horizontal-remember-me">
                                            <label class="cursor-pointer select-none" for="horizontal-remember-me">Remember me</label>
                                        </div>
                                        <div class="sm:ml-20 sm:pl-5 mt-5">
                                            <button type="button" class="button bg-theme-1 text-white">Login</button>
                                        </div>
                                    
                                
                </div>
                <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                    <button type="button" class="button w-20 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                    <button type="button" class="button w-20 bg-theme-1 text-white">Send</button>
                </div>
            </div>
        </div>
                                    
                                

        <div class="modal fade" id="AddDataModalx" tabindex="-1" role="dialog" aria-labelledby="AddDataModal" aria-hidden="true">
            <div class="modal__content">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addform">
                    @csrf
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">No. Telp.</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="telp" name="telp">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="uname" name="uname">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3" name="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Divisi</label>
                            <div class="col-sm-10">
                            <select class="form-control" placeholder="divisi" name="divisi"> 
                                <option selected>-- pilih --</option>
                                <option value="pln">PLN</option>
                                <option value="fo">FO</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-10">
                            <select class="form-control" placeholder="role" name="role"> 
                                <option>-- pilih --</option>
                                <option value="1">Super Admin</option>
                                <option value="2">Admin</option>
                                <option value="3">Tehnisi</option>
                            </select>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <div class="col-sm-2">Status</div>
                            <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1">
                                <label class="form-check-label" for="gridCheck1">
                                Aktifkan
                                </label>
                            </div>
                            </div>
                        </div> -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btn_tutup" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-info" id="btn_save">Simpan</button>
                    <button type="button" disabled class="btn btn-secondary" id="btn_save_loading" style="display:none"> <i class="fa fa-spinner fa-spin"></i></button>
                </div>
                </div>
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

              
                var table = $('#tableData').DataTable({
                   // responsive: true,
                    //"order": [[ 0, "desc" ]],
                    'info': true,
                    "lengthChange": false,
                    "processing": true,
                    "serverSide": true,
                    "pageLength": 20,
                    "scrollX":true,
                    "ajax": {
                        url: "{{ route('api.wo.plan') }}",
                        "type": "POST",
                       // contentType: false,
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader ("Authorization", "Bearer {{ Session::get('token_key') }}");
                            xhr.setRequestHeader ("X-CSRF-TOKEN", "Bearer {{ csrf_token() }}");
                        },
                        cache:false,
                        processData: true,
                        dataType: "json",
                        timeout:30000,
                        error : function(xhr, textStatus, errorThrown){
                            alert(errorThrown)
                            lh.ajaxUtils.handleAjaxError(xhr, textStatus, errorThrown);
                        }
                    },
                    "createdRow": function( row, data, dataIndex ) {
                        if(data.deleted_at == null || data.deleted_at == "null" || data.deleted_at =="")
                            $(row).addClass( 'intro-x ' );
                        else
                            $(row).addClass( 'intro-x bg-theme-31 text-theme-6' );
                    },
                    "columnDefs": [
                        { "targets": 0, "className": "text-small text-center border-b", "data": "site_name", "render": function ( data, type, row, meta ){
                            return '<div class="font-medium whitespace-no-wrap">'+data+'</div>'
                                    +' <div class="text-gray-600 text-xs whitespace-no-wrap">'+row["site_code"]+'</div>'
                        } },
                        { "targets": 1, "className": "text-small text-center border-b", "data": "floc_site", "visible": true },
                        { "targets": 2, "className": "text-small text-center border-b", "data": "plan", "render": function ( data, type, row, meta ){
                            if(data === "Monthly"){
                                return '<span class="text-xs px-3 py-2 rounded-full border border-theme-1 text-theme-1 dark:text-theme-10 dark:border-theme-10 mr-1">'+data+'</span>'
                            } else if(data === "Bimonthly"){
                                return '<span class="text-xs px-3 py-2 rounded-full border border-theme-9 text-theme-9 dark:border-theme-9 mr-1">'+data+'</span>'
                            } else if(data === "Trimonthly"){
                                return '<span class="text-xs px-3 py-2 rounded-full border border-theme-12 text-theme-12 dark:border-theme-12 mr-1">'+data+'</span>'
                            } else {
                                return data
                            }
                        } },
                        { "targets": 3, "className": "text-small text-center border-b", "data": "work_date", "visible": true },
                        { "targets": 4, "className": "text-xs text-center border-b", "data": "area", "visible": true },
                        { "targets": 5, "className": "text-xs text-center border-b", "data": "engineer", "visible": true },
                        { "targets": 6, "className": "text-center w-40 text-xs", "data": "tenant", "render": function ( data, type, row, meta ){
                            var datajson=JSON.stringify(data);
                            var listenan="";
                            $.each(data, function(k, value) {
                                listenan+='<div class="flex lg:justify-center">'
                                            +' <div class="w-5 h-5 image-fit zoom-in">'
                                                +'<img alt="'+value["name"]+'" class="tooltip rounded-full bg-logo-white" src="'+value["logo"]+'" title="'+value["name"]+'">'
                                            +'</div>'
                            });
                            return listenan;
                        } },
                        { "targets": 7, "className": "text-center border-b w-5", "data": "workorder_id", "render": function ( data, type, row, meta ){
                            return '<div class="flex sm:justify-center items-center">'
                                            +'<a class="tooltip flex items-center mr-3" href="javascript:;" onclick="editRow(\''+data+'\');" title="Edit"> <i class="far fa-edit w-4 h-4 mr-2"></i>  </a>'
                                            +'<a class="tooltip flex items-center text-theme-6" href="javascript:;" onclick="deleteRow(\''+data+'\');" title="Delete"> <i class="far fa-trash-alt w-4 h-4 mr-2"></i>  </a>'
                                        +'</div>'
                        } },
                    ],
                    "searching": false
                })
                // .columns.adjust()
				// .responsive.recalc();
                
            } );

            function editRow(id){
                url_raw = "{{ route('tower.wo.draft.edit',['id'=>':id']) }}";
                url = url_raw.replace(':id',id)
                window.location = url
                //console.log(url)
            }

            function deleteRow(id){
                alert(id)
            }
        </script>
    </x-slot>
</x-app-layout>