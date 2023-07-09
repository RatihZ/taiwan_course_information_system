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
								<form name="cityForm" id="cityForm" @if(empty($city['id'])) action="{{ url('admin/add-edit-city') }}" @else action="{{ url('admin/add-edit-city/'.$city['id']) }}" @endif method="post" class="form d-flex flex-column flex-lg-row" enctype="multipart/form-data">@csrf
									<!--begin::Main column-->
									<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
										<!--begin:::Tabs-->
										<ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">
											<!--begin:::Tab item-->
											<li class="nav-item">
												<a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">Add City</a>
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
																<h2>Add City</h2>
															</div>
														</div>
														<!--end::Card header-->
														<!--begin::Card body-->
														<div class="card-body pt-0">
															<div class="mb-10 fv-row">
																<!--begin::Label-->
																<label for="name_en" class="required form-label">Name_en</label>
																<!--end::Label-->
																<!--begin::Input-->
																<input type="text" name="name_en" class="form-control mb-2" placeholder="City Name in English" id="name_en" @if(!empty($city['name_en']) value=" {{$city['name_en']}}" @endif>
																<!--end::Input-->
																<!--begin::Description-->
																<div class="text-muted fs-7">City name is required and recommended to be unique.</div>
																<!--end::Description-->
															</div>
                                                            <div class="mb-10 fv-row">
																<!--begin::Label-->
																<label for="name_zh" class="required form-label">Name_zh</label>
																<!--end::Label-->
																<!--begin::Input-->
																<input type="text" name="name_zh" class="form-control mb-2" placeholder="City Name in Chinese" id="name_zh" @if(!empty($city['name_zh']) value=" {{$city['name_zh']}}" @endif>
																<!--end::Input-->
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
															<!--begin::Tax-->
															<div class="d-flex flex-wrap gap-5">
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
											<a href="{{ url('admin/city') }}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancel</a>
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