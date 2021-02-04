<x-app-layout>
    <x-slot name="title">
            {{ __('Work Order') }}
    </x-slot>
    <x-slot name="style">
        <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"  rel="stylesheet">
        <link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css" rel="stylesheet">
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
                            <a href="{{ route('tower.wo.draft') }}" class="breadcrumb--active">Draft</a>
                            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
                            <a href="" class="">Import</a>
                        </div>
                    </x-slot>
                </x-top-bar>
                <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">Import Workorder Draft Plan</h2>
                </div>
                
                <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
                    <div class="intro-y datatable-wrapper box col-span-12 lg:col-span-8">
                        <div class="flex flex-col  p-5 sm:flex-row items-center p-2 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">Log Import</h2>
                        </div>
                        <div class="intro-y datatable-wrapper box p-5 mt-5">
                            <table id="tableData" class="table table-report table-report--bordered display stripe hover datatable w-full" style="width:100%" >
                                <thead>
                                    <tr >
                                        <th class="border-b-2 text-center whitespace-no-wrap">Date</th>
                                        <th class="border-b-2 text-center whitespace-no-wrap">Batch Number</th>
                                        <th class="border-b-2 text-center whitespace-no-wrap">Filename</th>
                                        <th class="border-b-2 text-center whitespace-no-wrap">Status</th>
                                        <th class="border-b-2 text-center whitespace-no-wrap">result</th>
                                    </tr>
                                </thead>
                                <!-- <tbody>
                                    <tr class="intro-x">
                                        <td class="text-center border-b text-xs">2020-01-10 00:00:00</td>
                                        <td class="text-center border-b text-xs">141323</td>
                                        <td class="border-b">
                                            <div class="font-medium whitespace-no-wrap "><a href="javascript:;">import.xlsx</a></div>
                                            <div class="text-gray-600 text-xs whitespace-no-wrap">30 Record(s)</div>
                                        </td>
                                    
                                        <td class="text-center border-b text-xs text-theme-9">Done</td>
                                        
                                    </tr>
                                </tbody> -->
                            </table>
                        </div>
                    </div>
                    
                    <div class="col-span-12 lg:col-span-4">
                        <div class="intro-y pr-1">
                            <div class="box p-2">
                                <div class="flex flex-col sm:flex-row items-center p-2 border-b border-gray-200 dark:border-dark-5">
                                    <h2 class="font-medium text-base mr-auto">Upload File</h2>
                                </div>
                            
                                <div class="p-2" id="single-file-upload">
                                    <div class="preview">
                                        <form id="dzFile" data-single="true" class="dropzone border-gray-200 border-dashed">
                                        {{ csrf_field() }}
                                            <div class="fallback">
                                                <input name="file" type="file" />
                                            </div>
                                            <div class="dz-message" data-dz-message>
                                                <div class="text-lg font-medium">Drop file di sini atau klik untuk upload.</div>
                                            </div>
                                        </form>
                                        <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                            <button disabled id="proses" class="cursor-not-allowed button w-24 justify-center block bg-theme-1 text-white ml-2">Proses</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="intro-y pr-1">
                            <div class="tab-content__pane active" id="">
                                
                            </div>
                            <div class="tab-content__pane active" id="ticket">
                                <div class="box p-5 mt-5">
                                    <div class="flex flex-col sm:flex-row items-center p-2 border-b border-gray-200 dark:border-dark-5">
                                            <h2 class="font-medium text-base mr-auto">Detail Import Log</h2>
                                        </div>
                                   
                                    <div class="p-2">
                                        <div class="flex">
                                            <div class="mr-auto">Batch Number</div>
                                            <div id="last_log_batch">0</div>
                                        </div>
                                        <div class="flex mt-4">
                                            <div class="mr-auto">Status</div>
                                            <div class="" id="last_log_status">---</div>
                                        </div>
                                        <div class="flex mt-4">
                                            <div class="mr-auto">Records</div>
                                            <div id="last_log_record">0</div>
                                        </div>
                                        <div class="" id="last_log_result" style="display:none"></div>
                                        <div class="flex mt-4  ">
                                            <div class="mr-auto">Success</div>
                                            <div  id="last_log_success">0</div>
                                        </div>
                                        <div class="flex mt-4">
                                            <div class="mr-auto">Fail</div>
                                            <div id="last_log_fail">0</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Ticket -->
                </div>
            </div> <!-- END: Content -->
        </div>

         <!-- Modal -->
         

    </x-slot>
    <x-slot name="script">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" integrity="sha512-F5QTlBqZlvuBEs9LQPqc1iZv2UMxcVXezbHzomzS6Df4MZMClge/8+gXrKw2fl5ysdk4rWjR0vKS7NNkfymaBQ==" crossorigin="anonymous"></script>        
        <script src="{{ asset('dist/js/dropzone.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script>
            var myDropzone = new Dropzone("#dzFile",{url:"{{ route('tower.wo.draft.import.file') }}"});
            $(document).ready( function () {
                var import_filename="";
                myDropzone.on("success", function(file, responseText) {
                    console.log(responseText)
                    $("#proses").prop("disabled", false);
                    $("#proses").removeClass("cursor-not-allowed")
                    import_filename=responseText
                });

                $("#proses").on("click", function(){
                    Swal.fire({
                        title: 'Proses data?',
                        text: "Data akan diproses!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#proses").prop("disabled", true);
                            $(this).addClass("cursor-not-allowed")
                            //$(this).html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>')
                            
                            let plantype = $('#plantype').val()
                            let product = $('#product').val()
                            let formtype = $('#formtype').val()

                            axios({
                                method: 'post',
                                url: "{{ route('tower.wo.draft.import.file.process') }}",
                                data: {
                                    file: import_filename
                                }
                            })
                            .then(function (response) {
                                //console.log(response.data);
                                if(response.data === "ok"){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'File sedang di proses, Anda bisa meninggalkan halaman ini',
                                    })
                                    
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: response.data,
                                    })
                                }
                                $("#proses").prop("disabled", false);
                                $("#proses").removeClass("cursor-not-allowed")
                            })
                            .catch(function (error) {
                                console.log(error);
                                $("#proses").removeClass("cursor-not-allowed")
                            });
                            
                        }
                    })
                })

                var table = $('#tableData').DataTable({
                   // responsive: true,
                   "order": [[ 0, "desc" ]],
                    'info': true,
                    "processing": true,
                    "lengthChange": false,
                    "processing": true,
                    "serverSide": true,
                    "pageLength": 50,
                    "ajax": {
                        url: "{{ route('api.history.import') }}",
                        type: "get",
                        contentType: false,
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader ("Authorization", "Bearer {{ Session::get('token_key') }}");
                        },
                        cache:false,
                        processData: true,
                        dataType: "json",
                        timeout:30000,
                        error : function(xhr, textStatus, errorThrown){
                            lh.ajaxUtils.handleAjaxError(xhr, textStatus, errorThrown);
                        }
                    },
                    "createdRow": function( row, data, dataIndex ) {
                        $(row).addClass( 'intro-x' );
                    },
                    "columnDefs": [
                        { "targets": 0, "className": "text-center border-b", "data": "created_at", "render": function ( data, type, row, meta ){
                            return formatDate(data)
                        } },
                        { "targets": 1, "className": "text-center border-b", "data": "batch_id", "render": function ( data, type, row, meta ){
                            return '<div class="font-medium whitespace-no-wrap"><a href="javascript:;">'+data+'</a></div>'
                        } },
                        { "targets": 2, "className": "text-center border-b", "data": "filename", "render": function ( data, type, row, meta ){
                            return '<div class="font-medium whitespace-no-wrap">'+data+'</div>'
                                    +' <div class="text-gray-600 text-xs whitespace-no-wrap">'+row["record"]+'</div>'
                        } },
                        { "targets": 3, "className": "text-center border-b", "data": "status" ,"render": function(data, type, row, meta){
                            if(data === "done"){
                                return '<span class="px-2 py-1 rounded-full bg-theme-9 text-white mr-1">Done</span>'
                            } else {
                                return '<span class="px-2 py-1 rounded-full bg-theme-12 text-white mr-1">Start</span>'
                            }
                        }},
                        { "targets": 4, "className": "text-center border-b", "data": "result", "visible": false }
                    ],
                    "searching": false
                })
                // .columns.adjust()
                // .responsive.recalc();
                

                $('#tableData tbody').on( 'click', 'tr', function () {
                    var cell = table.row( this ).data()
                    var status = cell['status'] === "done"?'<span class="px-2 py-1 rounded-full bg-theme-9 text-white mr-1">Done</span>':'<span class="px-2 py-1 rounded-full bg-theme-12 text-white mr-1">Start</span>'
                    var resultdiv    = decodeURIComponent(cell['result']);
                    $("#last_log_batch").text(0)
                    $("#last_log_status").html(0)
                    $("#last_log_record").text(0)

                    $("#last_log_batch").text(cell["batch_id"])
                    $("#last_log_status").html(status)
                    $("#last_log_record").text(cell["record"])

                    document.getElementById("last_log_result").innerHTML = resultdiv

                    var result = $("#last_log_result").text()
                    var obj = JSON.parse(result);

                    //console.log( obj );

                    $("#last_log_success").text(0);
                    $("#last_log_fail").text(0);

                    $("#last_log_success").text(obj.total.total_row_success);
                    $("#last_log_fail").text(obj.total.total_row_fail);
                    // $.each(obj.error, function(k, v) {
                    //     //console.log( k + "=" +v );
                    //     total_row_success;
                    // });
                    
                } );
                
            } );

            

            function formatDate(date) {
                    var d = new Date(date),
                        month = '' + (d.getMonth() + 1),
                        day = '' + d.getDate(),
                        year = d.getFullYear();
                        hour = d.getHours();
                        minute = d.getMinutes();
                        second = d.getSeconds();

                    if (month.length < 2) 
                        month = '0' + month;
                    if (day.length < 2) 
                        day = '0' + day;

                    return [year, month, day].join('-')+" "+[hour, minute, second].join(':');
                }
        </script>
    </x-slot>
</x-app-layout>
