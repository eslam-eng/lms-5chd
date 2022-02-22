@extends('admin.layouts.app')

@push('libraries_top')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('admin/main.installment') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">{{trans('admin/main.dashboard')}}</a>
                </div>
                <div class="breadcrumb-item">{{ trans('admin/main.installment') }}</div>
            </div>
        </div>

        <section class="card">
            <div class="card-body">
                <form method="get" class="mb-0">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">{{trans('admin/main.search_student')}}</label>
                                <input name="student" type="text" class="form-control" value="{{ request()->get('student') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">{{trans('admin/main.search_webinar')}}</label>
                                <input name="course" type="text" class="form-control" value="{{ request()->get('course') }}">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group mt-1">
                                <label class="input-label mb-4"> </label>
                                <input type="submit" class="text-center btn btn-primary w-100" value="{{trans('admin/main.show_results')}}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th class="text-left">{{ trans('admin/main.student_name') }}</th>
                                        <th class="text-left">{{ trans('admin/main.course_title') }}</th>
                                        <th width="2%">{{ trans('admin/main.webinar_price') }}</th>
                                        <th width="2%">{{ trans('admin/main.payment_value') }}</th>
                                        <th>{{ trans('public.duration') }}</th>
                                        <th width="2%">{{ trans('admin/main.installment_number') }}</th>
                                        <th width="2%">{{ trans('admin/main.installment_paid') }}</th>
                                        <th width="2%">{{ trans('admin/main.installment_not_paid') }}</th>
{{--                                        <th>{{ trans('admin/main.notes') }}</th>--}}
                                        <th width="12%">{{ trans('admin/main.created_at') }}</th>
                                        <th width="10%">{{ trans('admin/main.action') }}</th>
                                    </tr>
                                    @foreach($installments as $installment)

                                        <tr>
                                            <td>
                                                {{$installment->studentInfo->full_name}}
                                            </td>
                                            <td>
                                                {{$installment->installmentInfo->webinarDetail->title}}/ {{$installment->installmentInfo->webinarDetail->slug}}
                                            </td>
                                            <td class="text-left">{{ $installment->installmentInfo->price }}</td>
                                            <td>{{ $installment->payment_value }}</td>
                                            <td style="font-size: 11px">{{ $installment->installmentInfo->installment_interval_number}} / {{ $installment->installmentInfo->installment_type}}</td>
                                            <td>{{ $installment->installmentInfo->installment_num }}</td>
                                            <td>{{ $installment->paid }}</td>
                                            <td >{{ $installment->notPaid }}</td>
{{--                                            <td>{{ $installment->note }}</td>--}}
                                            <td >{{ $installment->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                @can('admin_categories_edit')
                                                    <a role="button" href="/admin/installment/{{ $installment->id }}/details"
                                                       class="btn-transparent btn-sm text-primary">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan
{{--                                                    @can('admin_categories_edit')--}}
{{--                                                        <a href="/admin/categories/{{ $installment->id }}/edit"--}}
{{--                                                           class="btn-transparent btn-sm text-primary">--}}
{{--                                                            <i class="fa fa-edit"></i>--}}
{{--                                                        </a>--}}
{{--                                                    @endcan--}}
                                                @can('admin_categories_delete')
                                                    @include('admin.includes.delete_button',['url' => '/admin/installment/'.$installment->id.'/delete'])
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')

@endpush
