<x-app-layout>
    <x-slot name="title">
            {{ __('IPA Work Order') }}
    </x-slot>
    <x-slot name="style">
        <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"  rel="stylesheet">
        <!-- <link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css" rel="stylesheet"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />        
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
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
        
        .loaded{
            display: none;
        }

        #loader{
            position: absolute;
            width: 70%;
            height: 100vh;
            margin: auto;
            background: url('/dist/images/loader.gif') no-repeat center;
            z-index: 999;
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
                            <a href="" class="">Edit</a>
                        </div>
                    </x-slot>
                </x-top-bar>
                <div class="intro-y flex items-center mt-8 loaded">
                    <h2 class="text-lg font-medium mr-auto">Edit Draft WO</h2>
                </div>
               
                <div id="loader"></div>
                <div class="grid grid-cols-12 gap-6 mt-5 loaded">
                    <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse ">
                        
                        <div class="intro-y box mt-1">
                            <div class="relative flex items-center p-3">
                                <div class="ml-3 mr-auto">
                                    <div class="font-medium text-base" id="sitename_header"><< Sitename >></div>
                                    <div class="text-gray-600" id="sitecode_header"><< Sitecode >></div>
                                </div>
                            </div>
                            <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                                <a class="flex items-center text-theme-1 dark:text-theme-10 font-medium" href="javascript:;" id="general_menu">
                                    <i data-feather="activity" class="w-4 h-4 mr-2"></i> General Information
                                </a>
                                <a class="flex items-center mt-5 " href="javascript:;" id="engineer_menu">
                                    <i data-feather="box" class="w-4 h-4 mr-2"></i> Engineer Assignment
                                </a>
                                <a class="flex items-center mt-5" href="javascript:;" id="tenant_menu">
                                    <i data-feather="lock" class="w-4 h-4 mr-2"></i> Tenant Workorder
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
                        <!-- BEGIN: Form Validation -->
                        <div class="intro-y box lg:mt-1" id="general-info">
                            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">General Information</h2>
                            </div>
                            <div class="p-5" >
                                <form id="form-general">
                                    @csrf
                                    <div class="flex flex-col sm:flex-row items-center"> 
                                        <label class="w-full sm:w-24 sm:text-right sm:mr-5">Site name</label> 
                                        <input type="text" class="input w-full border mt-1 flex-1 cursor-not-allowed" id="sitename" name="sitename" value="" disabled> 
                                    </div> 
                                    <div class="flex flex-col sm:flex-row items-center mt-1"> 
                                        <label class="w-full sm:w-24 sm:text-right sm:mr-5">Site code</label> 
                                        <input type="text" class="input w-full border mt-2 flex-1 cursor-not-allowed" id="sitecode" name="sitecode" value="" disabled> 
                                    </div> 
                                    <div class="flex flex-col sm:flex-row items-center mt-1"> 
                                        <label class="w-full sm:w-24 sm:text-right sm:mr-5">Site code S.A.P</label> 
                                        <input type="text" class="input w-full border mt-2 flex-1 cursor-not-allowed" id="sitecodesap" name="sitecodesap" value="" disabled> 
                                    </div> 
                                    <div class="flex flex-col sm:flex-row items-center mt-1">
                                        <label class="w-full sm:w-24 sm:text-right sm:mr-5">Floc Site</label> 
                                        <input type="text" class="input w-full border mt-2 flex-1 cursor-not-allowed" id="flocsite" name="flocsite" value="" disabled> 
                                    </div> 
                                    <div class="flex flex-col sm:flex-row items-center mt-3">
                                        <label class="w-full sm:w-24 sm:text-right sm:mr-5">Plan Type</label> 
                                        <select id="plantype" name="plantype" class="flex-1" disabled>
                                        </select>
                                         <a href="javascript:;" class="text-theme-1 block font-normal ml-2" id="btn_change_plan">Change </a>
                                        <div  id="loader_change_plan" class="hidden"><i data-loading-icon="oval" data-color="black" class="w-4 h-4 ml-2"></i></div>
                                    </div> 
                                    <div class="flex flex-col sm:flex-row items-center mt-3">
                                        <label class="w-full sm:w-24 sm:text-right sm:mr-5">Product</label> 
                                        <select id="product" name="product" class="flex-1" disabled>
                                        </select>
                                         <a href="javascript:;" class="text-theme-1 block font-normal ml-2" id="btn_change_product">Change </a>
                                        <div  id="loader_change_product" class="hidden"><i data-loading-icon="oval" data-color="black" class="w-4 h-4 ml-2"></i></div>
                                    </div> 
                                    <div class="flex flex-col sm:flex-row items-center mt-3">
                                        <label class="w-full sm:w-24 sm:text-right sm:mr-5">Form</label> 
                                        <select id="formtype" name="formtype" class="flex-1" disabled>
                                        </select>
                                         <a href="javascript:;" class="text-theme-1 block font-normal ml-2" id="btn_change_form">Change </a>
                                        <div  id="loader_change_form" class="hidden"><i data-loading-icon="oval" data-color="black" class="w-4 h-4 ml-2"></i></div>
                                    </div>  
                                </form>
                                <div class="sm:ml-24 sm:pl-5 mt-5"> 
                                    <button id="btn_update_general" type="button" class="button bg-theme-1 text-white">Update</button> 
                                </div> 
                            </div>
                        </div>
                        <div class="intro-y box lg:mt-1 hidden" id="engineer-assign">
                            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">Engineer assignment</h2>
                            </div>
                            <div class="p-5" >
                                <form>
                                    <div class="flex flex-col sm:flex-row items-center mt-3">
                                        <label class="w-full sm:w-24 sm:text-right sm:mr-5">Engineer</label> 
                                        <select id="engineer" name="engineer" class="flex-1" >
                                        </select> 
                                    </div> 
                                    <div class="sm:ml-24 sm:pl-5 mt-5"> 
                                        <button type="button" class="button bg-theme-1 text-white">Update</button> 
                                    </div> 
                                </form>
                            </div>
                        </div>
                        <div class="intro-y box lg:mt-1 hidden" id="tenant-assign">
                            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">Tenant workorder</h2>
                            </div>
                            <div class="p-5" >
                                <form>
                                    <div class="flex flex-col sm:flex-row items-center mt-3">
                                        <label class="w-full sm:w-24 sm:text-right sm:mr-5">Tenant Workorder</label> 
                                        <select class="js-example-basic-multiple" name="tenant[]" multiple="multiple">
                                            <option value="AL">Alabama</option>
                                            <option value="WY">Wyoming</option>
                                        </select>
                                    </div> 
                                    <div class="sm:ml-24 sm:pl-5 mt-5"> 
                                        <button type="button" class="button bg-theme-1 text-white">Update</button> 
                                    </div> 
                                </form>
                            </div>
                        </div>
                        <!-- END: Form Validation -->
                    </div>
                </div>
            </div> <!-- END: Content -->
        </div>

         <!-- Modal -->
         
    </x-slot>
    <x-slot name="script">
        <script src="{{ mix('dist/js/app.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
        <!-- <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" integrity="sha512-F5QTlBqZlvuBEs9LQPqc1iZv2UMxcVXezbHzomzS6Df4MZMClge/8+gXrKw2fl5ysdk4rWjR0vKS7NNkfymaBQ==" crossorigin="anonymous"></script>      
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script>
            $(document).ready( function () {
                plantype =  $('#plantype')
                plantype.select2({
                    dropdownAutoWidth : true,
                });

                product =  $('#product')
                product.select2({
                    dropdownAutoWidth : true,
                });

                formtype =  $('#formtype')
                formtype.select2({
                    dropdownAutoWidth : true,
                });

                $('#engineer').select2({
                    dropdownAutoWidth : true,
                    width: "100%",
                    ajax: {
                        url: "{{ route('api.data.find.engineer') }}?api_token={{ $token }}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results:  $.map(data, function (item) {
                                    return {
                                    text: item.username,
                                    id: item.user_key
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
            } );

            cash(function () {
                plantype_id=null;
                product_code=null;
                formtype_id=null;

                axios.get('{{ route("api.draft.edit",["id"=>$id]) }}?api_token={{ $token }}').then(res => {
                    console.log(res)
                    
                    for (const [key, val] of Object.entries(res.data)) {
                        cash("#sitename_header").text(val.site_name);
                        cash("#sitecode_header").text(val.site_code);
                        cash("#sitename").val(val.site_name);
                        cash("#sitecode").val(val.site_code);
                        cash("#sitecodesap").val(val.site_code_sap);
                        cash("#flocsite").val(val.floc_site);

                        plantype_id=val.plan
                        var newOption = new Option(val.plan_label, val.plan, false, false);
                        plantype.append(newOption).trigger('change');

                        product_code=val.product_code
                        newOption = new Option(val.product, val.product_code, false, false);
                        product.append(newOption).trigger('change');

                        formtype_id=val.form_id
                        newOption = new Option(val.form, val.form_id, false, false);
                        formtype.append(newOption).trigger('change');

                    }

                    cash(".loaded").removeClass("loaded");
                    cash("#loader").addClass("invisible");

                }).catch(err => {
                    console.log("error "+err)
                })


                cash("#btn_change_plan").on('click', function(){
                    cash(this).addClass("hidden");
                    cash("#loader_change_plan").removeClass("hidden")

                    axios.get('{{ route("api.data.plantype") }}?api_token={{ $token }}').then(res => {
                        plantype.empty();
                        for (const [key, val] of Object.entries(res.data)) {
                            var newOption = new Option(val.name, val.id, false, false);
                            plantype.append(newOption).trigger('change');
                        }
                        
                        plantype.val(plantype_id); // Select the option with a value of '1'
                        plantype.trigger('change'); // Notify any JS components that the value changed
                        cash("#loader_change_plan").addClass("hidden");
                        plantype.removeAttr("disabled")
                    }).catch(err => {
                        console.log("error get plan type"+err)
                        cash(this).removeClass("hidden");
                        cash("#loader_change_plan").addClass("hidden");
                        plantype.attr("disabled")
                    })
                })

                cash("#btn_change_product").on('click', function(){
                    cash(this).addClass("hidden");
                    cash("#loader_change_product").removeClass("hidden")

                    axios.get('{{ route("api.data.product") }}?api_token={{ $token }}').then(res => {
                        product.empty();
                        for (const [key, val] of Object.entries(res.data)) {
                            var newOption = new Option(val.name, val.code, false, false);
                            product.append(newOption).trigger('change');
                        }
                        
                        product.val(product_code); 
                        product.trigger('change'); 
                        cash("#loader_change_product").addClass("hidden");
                        product.removeAttr("disabled")
                    }).catch(err => {
                        console.log("error get plan type"+err)
                        cash(this).removeClass("hidden");
                        cash("#loader_change_product").addClass("hidden");
                        product.attr("disabled")
                    })
                })

                cash("#btn_change_form").on('click', function(){
                    cash(this).addClass("hidden");
                    cash("#loader_change_form").removeClass("hidden")

                    axios.get('{{ route("api.data.form") }}?api_token={{ $token }}').then(res => {
                        formtype.empty();
                        for (const [key, val] of Object.entries(res.data)) {
                            var newOption = new Option(val.name, val.id, false, false);
                            formtype.append(newOption).trigger('change');
                        }
                        
                        formtype.val(formtype_id); 
                        formtype.trigger('change'); 
                        cash("#loader_change_form").addClass("hidden");
                        formtype.removeAttr("disabled")
                    }).catch(err => {
                        console.log("error get form type"+err)
                        cash(this).removeClass("hidden");
                        cash("#loader_change_form").addClass("hidden");
                        formtype.attr("disabled")
                    })
                })

                cash("#btn_update_general").on('click', function(){
                    Swal.fire({
                        title: 'Update data?',
                        text: "Data akan diupdate!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Update',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#btn_update_general").prop("disabled", true);
                            cash(this).addClass("cursor-not-allowed")
                            cash(this).html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
                            
                            let plantype = cash('#plantype').val()
                            let product = cash('#product').val()
                            let formtype = cash('#formtype').val()

                            //var form = $('#form-general')[0];
                            var bodyFormData = new FormData();
                            bodyFormData.append('plantype', plantype); 
                            bodyFormData.append('product', product); 
                            bodyFormData.append('formtype', formtype); 
                            bodyFormData.append('case', "general"); 
                            axios({ 
                                method  : 'post', 
                                url : "{{ route('api.tower.wo.draft.edit',['id'=>$id]) }}?api_token={{ $token }}", 
                                data : bodyFormData, 
                                headers: {'Content-Type': 'multipart/form-data' }
                            }) 
                            .then((res)=>{ 
                               // console.log(res); 
                               cash(this).html('Update');
                               cash(this).removeClass("cursor-not-allowed")
                               $("#btn_update_general").prop("disabled", false);

                                Swal.fire(
                                    'Updated!',
                                    'Data telah terupdate.',
                                    'success'
                                )
                            }) 
                            .catch((err) => {
                                Swal.fire(
                                    'Error!',
                                    'Terjadi kesalahan ('+err+')',
                                    'error'
                                )
                            }); 
                            
                        }
                    })
                })


                cash('#general_menu').on('click', function() {
                    cash(this).addClass("text-theme-1 dark:text-theme-10 font-medium")
                    cash("#engineer_menu").removeClass("text-theme-1 dark:text-theme-10 font-medium")
                    cash("#tenant_menu").removeClass("text-theme-1 dark:text-theme-10 font-medium")

                    cash("#general-info").removeClass("hidden")
                    cash("#engineer-assign").addClass("hidden")
                    cash("#tenant-assign").addClass("hidden")
                })
                cash('#engineer_menu').on('click', function() {
                    cash(this).addClass("text-theme-1 dark:text-theme-10 font-medium")
                    cash("#general_menu").removeClass("text-theme-1 dark:text-theme-10 font-medium")
                    cash("#tenant_menu").removeClass("text-theme-1 dark:text-theme-10 font-medium")

                    cash("#engineer-assign").removeClass("hidden")
                    cash("#general-info").addClass("hidden")
                    cash("#tenant-assign").addClass("hidden")
                })
                cash('#tenant_menu').on('click', function() {
                    cash(this).addClass("text-theme-1 dark:text-theme-10 font-medium")
                    cash("#engineer_menu").removeClass("text-theme-1 dark:text-theme-10 font-medium")
                    cash("#general_menu").removeClass("text-theme-1 dark:text-theme-10 font-medium")

                    cash("#tenant-assign").removeClass("hidden")
                    cash("#general-info").addClass("hidden")
                    cash("#engineer-assign").addClass("hidden")
                    
                })
            });


        </script>
    </x-slot>
</x-app-layout>