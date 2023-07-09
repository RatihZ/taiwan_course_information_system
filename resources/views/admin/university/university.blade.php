@extends('admin.layout.layout')
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Post-->
                        <div class="post d-flex flex-column-fluid" id="kt_post">
							<!--begin::Container-->
							<div id="kt_content_container" class="container-xxl">
								<!--begin::Products-->
								<div class="card card-flush">
									<!--begin::Card header-->
									<div class="card-header align-items-center py-5 gap-2 gap-md-5">
										<!--begin::Card title-->
										<div class="card-title">
											<!--begin::Search-->
											<div class="d-flex align-items-center position-relative my-1">
												<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
												<span class="svg-icon svg-icon-1 position-absolute ms-4">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opauniversity$university="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
														<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
													</svg>
												</span>
												<!--end::Svg Icon-->
												<input type="text" data-kt-ecommerce-product-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search University" />
											</div>
											<!--end::Search-->
										</div>
										<!--end::Card title-->
										@if(Session::has('error_message'))		
										<div class="alert alert-danger" role="alert">
					<strong>Error:</strong> Invalid Email or Password!
				</div>
					@endif
										<!--begin::Card toolbar-->
										<div class="card-toolbar flex-row-fluid justify-content-end gap-5">
											<div class="w-100 mw-150px">
											</div>
											<!--begin::Add product-->
											<a href="{{ url('admin/add-edit-university') }}" class="btn btn-primary">Add University</a>
											<!--end::Add product-->
										</div>
										<!--end::Card toolbar-->
									</div>
									<!--end::Card header-->
									<!--begin::Card body-->
									<div class="card-body pt-0">
										<!--begin::Table-->
										<table id="kt_ecommerce_products_table" class="table align-middle table-row-dashed fs-6 gy-5">
											<!--begin::Table head-->
											<thead>
												<!--begin::Table row-->
												<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
													<th class="w-10px pe-2">ID</th>
													<th class="text-end min-w-70px">Name_en</th>
													<th class="text-end min-w-100px">Name_zh</th>
                                                    <th class="text-end min-w-70px">Phone</th>
                                                    <th class="text-end min-w-70px">Email</th>
													<th class="text-end min-w-100px">Fax</th>
                                                    <th class="text-end min-w-70px">Created On</th>
                                                    <th class="text-end min-w-70px">Actions</th>
												</tr>
												<!--end::Table row-->
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody class="fw-bold text-gray-600">
                                                @foreach($university as $page)
												<!--begin::Table row-->
												<tr>
													<!--begin::Category=-->
													<td>
                                                        {{ $page['id'] }}
													</td>
													<td class="text-end pe-0">
														{{ $page['name_en'] }}
													</td>
													<!--end::SKU=-->
													<!--begin::Qty=-->
													<td class="text-end pe-0" data-order="22">
														{{ $page['name_zh'] }}
													</td>
                                                    <td class="text-end pe-0" data-order="22">
                                                    {{ $page['phone'] }}
													</td>
                                                    <td class="text-end pe-0" data-order="22">
                                                    {{ $page['email'] }}
													</td>
                                                    <td class="text-end pe-0" data-order="22">
                                                    {{ $page['fax'] }}
													</td>
													<td class="text-end pe-0">
														{{ date("F j, Y, g:i a", strtotime($page['created_at'])); }}
													</td>
													<!--begin::Action=-->
													<td class="text-end">
														<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
														<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
														<span class="svg-icon svg-icon-5 m-0">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
															</svg>
														</span>
														<!--end::Svg Icon--></a>
														<!--begin::Menu-->
														<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
															<!--begin::Menu item-->
															<div class="menu-item px-3">
																<a href="{{ url('admin/add-edit-university/'.$page['id']) }}" class="menu-link px-3">Edit</a>
															</div>
															<!--end::Menu item-->
															<!--begin::Menu item-->
															<div class="menu-item px-3">@csrf
															<a href="{{ url('admin/delete-university/'.$page['id']) }}" class="menu-link px-3" onclick="return confirm('Are you sure you want to delete this data?')">Delete</a>
															</div>
															<!--end::Menu item-->
														</div>
														<!--end::Menu-->
													</td>
													<!--end::Action=-->
												</tr>
												<!--end::Table row-->
													</td>
													<!--end::Action=-->
												</tr>
                                                @endforeach
												<!--end::Table row-->
											</tbody>
											<!--end::Table body-->
										</table>
										<!--end::Table-->
									</div>
									<!--end::Card body-->
								</div>
								<!--end::Products-->
							</div>
							<!--end::Container-->
						 </div> 
						<!--end::Post-->
					</div>
					<!--end::Content-->
@endsection