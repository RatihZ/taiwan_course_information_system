@extends('admin.layout.layout')
@section('content')
<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(Session::has('error_message'))
        <div class="alert alert-danger" role="alert">
            <strong>Error:</strong> {{ Session::get('error_message') }}
        </div>
        @endif
        <!--begin::Form-->
        <form name="departmentdetailForm" id="departmentdetailForm"
            @if(empty($departmentdetail['id']))
            action="{{ url('admin/add-edit-departmentdetail') }}"
            @else
            action="{{ url('admin/add-edit-departmentdetail/'.$departmentdetail['id']) }}"
            @endif method="post" class="form d-flex flex-column flex-lg-row" enctype="multipart/form-data">
            @csrf
            <!--begin::Main column-->
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <!--begin:::Tabs-->
                <ul
                    class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                            href="#kt_ecommerce_add_product_general">Add Department Detail</a>
                    </li>
                    <!--end:::Tab item-->
                </ul>
                <!--end:::Tabs-->
                <!--begin::Tab content-->
                <div class="tab-content">
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general"
                        role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <!--begin::General options-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Add Department Detail</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <!--begin::Label-->
                                        <label for="university" class="required form-label">University</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select class="form-select mb-2" name="university" id="university"
                                            data-control="select2" data-hide-search="true"
                                            data-placeholder="Select an option">
                                            <option></option>
                                            @foreach($getuniversities as $uni)
                                            <option value="{{ $uni->uuid }}"
                                                {{ isset($university) && $university->uuid == $uni->uuid ? 'selected' : '' }}>
                                                {{ $uni->name_en }}
                                            </option>
                                            @endforeach
                                        </select>

                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label for="faculty" class="required form-label">Faculty</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select class="form-select mb-2" name="faculty" id="faculty"
                                                data-control="select2" data-hide-search="true"
                                                data-placeholder="Select an option">
                                                <option></option>
                                                @foreach($getfaculties as $fac)
                                                <option value="{{ $fac->uuid }}"
                                                    {{ isset($faculty) && $faculty->uuid == $fac->uuid ? 'selected' : '' }}>
                                                    {{ $fac->name_en }}
                                                </option>
                                                @endforeach
                                            </select>

                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label for="department" class="required form-label">Department</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select class="form-select mb-2" name="department" id="department"
                                                    data-control="select2" data-hide-search="true"
                                                    data-placeholder="Select an option">
                                                    <option></option>
                                                    @foreach($getdepartments as $dep)
                                                    <option value="{{ $dep->uuid }}"
                                                        {{ isset($department) && $department->uuid == $dep->uuid ? 'selected' : '' }}>
                                                        {{ $dep->name_en }}
                                                    </option>
                                                    @endforeach
                                                </select>

                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label for="language" class="required form-label">Language</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select class="form-select mb-2" name="language" id="language"
                                                    data-control="select2" data-hide-search="true"
                                                    data-placeholder="Select an option">
                                                    <option></option>
                                                    @foreach($getlanguages as $lang)
                                                    <option value="{{ $lang->uuid }}"
                                                        {{ isset($language) && $language->uuid == $lang->uuid ? 'selected' : '' }}>
                                                        {{ $lang->name_en }}
                                                    </option>
                                                    @endforeach
                                                </select>

                                            </div>

                                        </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::General options-->
                        </div>
                        <!--end::Tab pane-->
                    </div>
                    <!--end::Tab content-->
                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="{{ url('admin/departmentdetail') }}" id="kt_ecommerce_add_product_cancel"
                            class="btn btn-light me-5">Cancel</a>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                            <span class="indicator-label">Save Changes</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                        <!--end::Button-->
                    </div>
                </div>
                <!--end::Main column-->
            </div>
        </form>
        <!--end::Form-->
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->
@endsection
