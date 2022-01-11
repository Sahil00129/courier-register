@extends('layouts.main')
@section('title', 'Courier List')
@section('content')
<style>
div#itemList_filter {
    width: 70%;
    float: left;
}
 .dt-buttons.btn-group.flex-wrap {
    float: right;
    margin-top: 10px;
}
select.cfilter {
    border: 1px solid #cccccc54;
    width: 100%;
}
th {
    color: #000 !important;
}
.form-inline {  
    flex-direction: column;
    align-items: stretch;
}

.form-inline label {
  margin: 5px 10px 5px 0;
  font-weight: bold;
}

.form-inline input {
  vertical-align: middle;
  margin: 5px 10px 5px 0;
  padding: 6px;
  background-color: #fff;
  border: 1px solid #ddd;
}
.form-inline select {
  vertical-align: middle;
  margin: 5px 10px 5px 0;
  padding: 6px;
  background-color: #fff;
  border: 1px solid #ddd;
}

.form-inline button {
  padding: 10px 20px;
  background-color: dodgerblue;
  border: 1px solid #ddd;
  color: white;
  cursor: pointer;
}

.form-inline button:hover {
  background-color: royalblue;
}
</style>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Toolbar-->
	<div class="toolbar" id="kt_toolbar">
		<!--begin::Container-->
		<div id="kt_toolbar_container" class="container-xxl d-flex flex-stack">
			<!--begin::Page title-->
			<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
				<!--begin::Title-->
				<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Courier List</h1>
				<!--end::Title-->
				<!--begin::Separator-->	<span class="h-20px border-gray-200 border-start mx-4"></span>
				<!--end::Separator-->
				<!--begin::Breadcrumb-->

				<!--end::Breadcrumb-->
			</div>
			<!--end::Page title-->
			<!--begin::Actions-->
			<div class="d-flex align-items-center py-1">
				<!--begin::Wrapper-->
				 

			</div>
			<!--end::Actions-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Toolbar-->
	<!--begin::Post-->
	<div class="post d-flex flex-column-fluid" id="kt_post" >
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<!--begin::Card-->
			<div class="card">
				<!--begin::Card body-->
				<div class="card-body pt-0" style="min-height:500px;">
				<table class="table align-middle table-row-dashed fs-6 gy-5" id="new">
						<!--begin::Table head-->
						<thead>
							<!--begin::Table row-->
							<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">Name</th>
								<th class="min-w-125px">Address</th>
                                <th class="min-w-125px">City</th>
                                <th class="min-w-125px">Distt</th>
                                <th class="min-w-125px">Pin Code</th>
								<th class="min-w-125px">Telephone No</th>
								<th class="min-w-125px">Document Details</th>
								<th class="min-w-125px">Courier Company</th>
							</tr>
							<!--end::Table row-->
						</thead>
						<!--end::Table head-->
						<!--begin::Table body-->
                       
						<tbody class="fw-bold text-gray-600">
						@foreach ($cmpnys as $cmpny)
						<?php 
						        $l = (explode("-",$cmpny['name_company']));
								$n = $l[0];
								$c = $l[1];
							//	echo'<pre>'; print_r($l); die;
						?>
							<tr>
                            <td>{{$n = $l[0]}}</td>
							<td>{{$c = $l[1]}}</td>
							<td>{{$cmpny->address}}</td>
							<td>{{$cmpny->city}}</td>
							<td>{{$cmpny->distt}}</td>
							<td>{{$cmpny->pin_code}}</td>
							<td>{{$cmpny->telephone_no}}</td>
							<td>{{$cmpny->document}}</td>
							<td>{{$cmpny->courier_name}}</td>
                           </tr>
                         @endforeach
						</tbody>
						<!--end::Table body-->
					</table>
					<!--end::Table-->
				</div>
				<!--end::Card body-->
			</div>
			<!--end::Card-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Post-->
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>
<script>
$(document).ready( function() {
    $('#new').DataTable( {
        dom: 'Bfrtip',
        buttons: [ {
            extend: 'excelHtml5',
            autoFilter: true,
            sheetName: 'Exported data'
        } ]
    } );
} );
</script>
@endsection