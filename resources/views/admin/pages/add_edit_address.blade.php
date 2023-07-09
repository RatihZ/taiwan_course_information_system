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
								<form name="addressForm" id="addressForm" @if(empty($address['id'])) action="{{ url('admin/add-edit-address') }}" @else action="{{ url('admin/add-edit-address/'.$address['id']) }}" @endif method="post" class="form d-flex flex-column flex-lg-row" enctype="multipart/form-data">@csrf
									<!--begin::Main column-->
									<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
										<!--begin:::Tabs-->
										<ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">
											<!--begin:::Tab item-->
											<li class="nav-item">
												<a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">Add Address</a>
											</li>
											<!--end:::Tab item-->
										</ul>
										<!--end:::Tabs-->
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
																<h2>Add Address</h2>
															</div>
														</div>
														<!--end::Card header-->
														<!--begin::Card body-->
														<div class="card-body pt-0">
															<div class="mb-10 fv-row">
																<!--begin::Label-->
																<label for="address_en" class="required form-label">Address_en</label>
																<!--end::Label-->
																<!--begin::Input-->
																<input type="text" name="address_en" class="form-control mb-2" placeholder="Address Name in English" id="address_en" @if(!empty($address['address_en']) value=" {{$address['address_en']}}" @endif>
																<!--end::Input-->
																<!--begin::Description-->
																<div class="text-muted fs-7">Address name is required and recommended to be unique.</div>
																<!--end::Description-->
															</div>
                                                            <div class="mb-10 fv-row">
																<!--begin::Label-->
																<label for="address_zh" class="required form-label">Address_zh</label>
																<!--end::Label-->
																<!--begin::Input-->
																<input type="text" name="address_zh" class="form-control mb-2" placeholder="Address Name in Chinese" id="address_zh" @if(!empty($address['address_zh']) value=" {{$address['address_zh']}}" @endif>
																<!--end::Input-->
																<!--begin::Description-->
																<div class="text-muted fs-7">地址名称为必填项，建议唯一.</div>
																<!--end::Description-->
															</div>
															<!--end::Input group-->
														</div>
														<!--end::Card header-->
													</div>
													<!--end::General options-->
													<!--begin::Pricing-->
													<div class="card card-flush py-4">
														&nbsp
														<!--begin::Card body-->
														<div class="card-body pt-0">
															<!--begin::Input group-->
															<div class="mb-10 fv-row">
																<!--begin::Label-->
																<label for="university" class="required form-label">University</label>
																<!--end::Label-->
																<!--begin::Input-->
																<select class="form-select mb-2" name="university" id="university" data-control="select2" data-hide-search="true" data-placeholder="Select an option">
    <option></option>
    @foreach($getuniversities as $uni)
    <option value="{{ $uni->uuid }}" {{ isset($university) && $university->uuid == $uni->uuid ? 'selected' : '' }}>
        {{ $uni->name_en }}
    </option>
    @endforeach
</select>
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
                                            <strong>Error:</strong> Can't Add Existing University!
                                        </div>
                                        @endif
																<!--end::Input-->
															</div>
															<!--end::Input group-->
															<!--begin::Tax-->
															<div class="d-flex flex-wrap gap-5">
																<!--begin::Input group-->
																<div class="fv-row w-100 flex-md-root">
																	<!--begin::Label-->
																	<label for="city" class="required form-label">City</label>
																	<!--end::Label-->
																	<!--begin::Select2-->
																	<select class="form-select mb-2" id="city" name="city" data-control="select2" data-hide-search="true" data-placeholder="Select an option">
    <option></option>
    @foreach($getcities as $cit)
    <option value="{{ $cit->uuid }}" {{ isset($city) && $city->uuid == $cit->uuid ? 'selected' : '' }}>
        {{ $cit['name_en']}}
    </option>
    @endforeach
</select>
																	<!--end::Select2-->
																</div>
																<!--end::Input group-->
																<!--begin::Input group-->
																<div class="fv-row w-100 flex-md-root">
																	<!--begin::Label-->
																	<label for="country" class="form-label">Country</label>
																	<!--end::Label-->
																	<select class="form-select mb-2" name="country" id="country" data-control="select2" data-hide-search="true" data-placeholder="Select an option">
    <option></option>
    @foreach($getcountries as $cotr)
    <option value="{{ $cotr->uuid }}" {{ isset($country) && $country->uuid == $cotr->uuid ? 'selected' : '' }}>
        {{ $cotr['name_en'] }}
    </option>
    @endforeach
</select>
																</div>
																<!--end::Input group-->
															</div>
															<!--end:Tax-->
														</div>
														<!--end::Card header-->
													</div>
													<!--end::Pricing-->
												</div>
											</div>
											<!--end::Tab pane-->
											<!--begin::Tab pane-->
											<div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
												<div class="d-flex flex-column gap-7 gap-lg-10">
														</div>
														<!--end::Card header-->
												</div>
											<!--end::Tab pane-->
										</div>
										<!--end::Tab content-->
										<div class="d-flex justify-content-end">
											<!--begin::Button-->
											<a href="{{ url('admin/address') }}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancel</a>
											<!--end::Button-->
											<!--begin::Button-->
											<button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
												<span class="indicator-label">Save Changes</span>
												<span class="indicator-progress">Please wait...
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
											</button>
											<!--end::Button-->
										</div>
									</div>
									<!--end::Main column-->
								</form>
								<!--end::Form-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Post-->

@endsection