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
            <form name="professorForm" id="professorForm" @if(empty($professor['id'])) action="{{ url('admin/add-edit-professor') }}" @else action="{{ url('admin/add-edit-professor/'.$professor['id']) }}" @endif method="post" class="form d-flex flex-column flex-lg-row" enctype="multipart/form-data">
                @csrf
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin::Tabs-->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">
                        <!--begin::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">Add Professor</a>
                        </li>
                        <!--end::Tab item-->
                    </ul>
                    <!--end::Tabs-->
                    <!--begin::Tab content-->
                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <!--begin::General options-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Add Professor</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label for="name_en" class="required form-label">Name (English)</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="name_en" class="form-control mb-2" placeholder="Professor Name in English" id="name_en" @if(!empty($professor['name_en'])) value="{{$professor['name_en']}}" @endif>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">Professor name in English.</div>
                                            <!--end::Description-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label for="name_zh" class="required form-label">Name (Chinese)</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="name_zh" class="form-control mb-2" placeholder="Professor Name in Chinese" id="name_zh" @if(!empty($professor['name_zh'])) value="{{$professor['name_zh']}}" @endif>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">Professor name in Chinese.</div>
                                            <!--end::Description-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label for="email" class="required form-label">Email</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="email" name="email" class="form-control mb-2" placeholder="Professor Email" id="email" @if(!empty($professor['email'])) value="{{$professor['email']}}" @endif>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">Professor email address.</div>
                                            <!--end::Description-->
                                        </div>
                                                <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label for="photo" class="form-label">Photo</label>
                                                <input type="file" name="photo_path" class="form-control mb-2" id="photo_path">
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">Upload a new photo of the professor.</div>
                                            <!--end::Description-->
                                        </div>
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::General options-->
                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <!--begin::Button-->
                                    <a href="{{ url('admin/professor') }}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancel</a>
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
                                <!--end::Actions-->
                            </div>
                        </div>
                        <!--end::Tab pane-->
                    </div>
                    <!--end::Tab content-->
                </div>
                <!--end::Main column-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
