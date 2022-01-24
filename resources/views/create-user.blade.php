@extends('layouts.main') 
@section('title', 'Create User')
@section('content')

<style>
	.ignored {
    margin-top: 10px;
    color: red;
}
div#ignoredItems {
    font-size: 13px;
    border: 1px solid;
    padding: 17px;
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
									<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ __('Add User')}}</h1>
									<!--end::Title-->
									<!--begin::Separator-->
									<span class="h-20px border-gray-200 border-start mx-4"></span>
									<!--end::Separator-->
									<!--begin::Breadcrumb-->
									<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
										<!--begin::Item-->
										<li class="breadcrumb-item text-muted">
											<a href="#" class="text-muted text-hover-primary">{{ __('Create new user, assign roles & permissions')}}</a>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="breadcrumb-item">
											<span class="bullet bg-gray-200 w-5px h-2px"></span>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="breadcrumb-item text-muted"></li>
										<!--end::Item-->
									</ul>
									<!--end::Breadcrumb-->
								</div>
								<!--end::Page title-->
								<!--begin::Actions-->
								<div class="d-flex align-items-center py-1">
									<!--begin::Wrapper-->
									<!--end::Wrapper-->
									<!--begin::Button-->
									<a href="{{ url('users') }}" class="btn btn-sm btn-primary">All Users</a>
									<!--end::Button-->
								</div>
								<!--end::Actions-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Toolbar-->
						<!--begin::Post-->
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<!--begin::Container-->
	
                            <div id="kt_content_container" class="container-xxl">
                                <div class="row">
                                    <!-- start message area-->
                                    @include('include.message')
                                    <!-- end message area-->
                                    <div class="col-md-12">
                                        <div class="card ">
                                            <div class="card-body">
                                                <form class="forms-sample" method="POST" action="{{ route('create-user') }}" >
                                                @csrf
                                                    <div class="row">
                                                        <div class="col-sm-6">

                                                            <div class="form-group">
                                                                <label for="name">{{ __('Username')}}<span class="text-red">*</span></label>
                                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" placeholder="Enter user name" required>
                                                                <div class="help-block with-errors"></div>

                                                                @error('name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <label for="email">{{ __('Email')}}<span class="text-red">*</span></label>
                                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter email address" required>
                                                                <div class="help-block with-errors" ></div>

                                                                @error('email')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        
                                                            <div class="form-group mt-3">
                                                                <label for="password">{{ __('Password')}}<span class="text-red">*</span></label>
                                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter password" required>
                                                                <div class="help-block with-errors"></div>

                                                                @error('password')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <label for="password-confirm">{{ __('Confirm Password')}}<span class="text-red">*</span></label>
                                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Retype password" required>
                                                                <div class="help-block with-errors"></div>
                                                            </div>

                                                        
                                                        </div>
                                                        <div class="col-md-6">
                                                            <!-- Assign role & view role permisions -->
                                                            <div class="form-group">
                                                                <label for="site">{{ __('Assign Warehouse')}}<span class="text-red">*</span></label>
                                                                {!! Form::select('site', $sites, null,[ 'class'=>'form-control', 'placeholder' => 'Select Warehouse','id'=> 'site', 'required'=> 'required']) !!}
                                                            </div>
  
                                                            <div class="form-group mt-3">
                                                                <label for="role">{{ __('Assign Role')}}<span class="text-red">*</span></label>
                                                                {!! Form::select('role', $roles, null,[ 'class'=>'form-control', 'placeholder' => 'Select Role','id'=> 'role', 'required'=> 'required']) !!}
                                                            </div>
                                                            <div class="form-group mt-3" >
                                                                <label for="role">{{ __('Permissions')}}</label>
                                                                <div id="permission" class="form-group" style="border-left: 2px solid #d1d1d1;">
                                                                    <span class="text-red pl-3">Select role first</span>
                                                                </div>
                                                                <input type="hidden" id="token" name="token" value="{{ csrf_token() }}">
                                                            </div>

                                                        </div>
                                                        <div class="col-md-12 mt-3">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary">{{ __('Submit')}}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                     </div>                            
			</div>
	   <!--end::Post-->
					</div>

@endsection
