@extends('admin.layouts.app')

@push('libraries_top')


@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('admin/main.installment_detail') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">{{ trans('admin/main.dashboard') }}</a>
                </div>
                <div class="breadcrumb-item active"><a href="/admin/installment">{{ trans('admin/main.installment') }}</a>
                </div>
                <div class="breadcrumb-item">{{!empty($role) ?trans('/admin/main.edit'): trans('admin/main.new') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="section-title after-line">{{ trans('admin/main.general_info') }}</h2>
                            <br>

                            <div class="row">
{{--                                course details--}}
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group mt-15">
                                        <h6>{{trans('admin/main.webinar_title')}}</h6>
                                        <label class="input-label"><span class="font-weight-bold font-16 p-1">Course:</span>{{ $installments->installmentInfo->webinarDetail->title ." / ".$installments->installmentInfo->webinarDetail->slug }}</label>
                                        <br>
                                        <label class="input-label"><span class="font-weight-bold font-16 p-1">Start-Date:</span>{{ dateTimeFormat($installments->installmentInfo->webinarDetail->start_date,'Y-m-d') }}</label>
                                        <br>
                                        <label class="input-label"><span class="font-weight-bold font-16 p-1">End-Date:</span>{{ dateTimeFormat($installments->installmentInfo->webinarDetail->end_date,'Y-m-d') }}</label>

                                    </div>
                                </div>
{{--                                student details--}}
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group mt-15">
                                        <h6>{{trans('admin/main.student')}}</h6>
                                        <label class="input-label"><span class="font-weight-bold font-16 p-1">name:</span> {{ $installments->studentInfo->full_name }}</label>
                                        <br>
                                        <label class="input-label"><span class="font-weight-bold font-16 p-1">Mobile:</span> {{ $installments->studentInfo->mobile}}</label>

                                    </div>
                                </div>
{{--                                installment details--}}
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group mt-15">
                                        <h6>{{trans('admin/main.installment')}}</h6>
                                        <label class="input-label"><span class="font-weight-bold font-16 p-1">Title:</span> {{ $installments->installmentInfo->title }}</label>
                                        <br>
                                        <label class="input-label"><span class="font-weight-bold font-16 p-1">Price:</span> {{ $installments->installmentInfo->price  }}</label>
                                        <br>
                                        <label class="input-label"><span class="font-weight-bold font-16 p-1">Duration:</span> {{ $installments->installmentInfo->installment_interval_number."/".  $installments->installmentInfo->installment_type }}</label>
                                        <br>
                                        <label class="input-label"><span class="font-weight-bold font-16 p-1">installment num:</span> {{ $installments->installmentInfo->installment_num}}</label>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h2 class="section-title after-line">{{ trans('admin/main.installment_detail') }}</h2>
                                <br>
                                <table class="table table-striped font-14">
                                    <thead>
                                    <tr>
                                        <th class="text-left">{{ trans('admin/main.date') }}</th>
                                        <th>{{ trans('admin/main.payment_value') }}</th>
                                        <th>{{ trans('admin/main.status') }}</th>
                                        <th width="10%">{{ trans('admin/main.action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($installments->installmentDetails as $detail)
                                        <tr class="{{$detail->status!=0?"bg-success text-white":''}}">
                                            <td class="text-left">{{ dateTimeFormat($detail->date_collection,'Y-m-d') }}</td>
                                            <td>{{ $detail->collection_value }}</td>
                                            <td class="{{ $detail->status==0?'text-danger':'' }}">{{ $detail->status==0?'not paid':'paid' }}</td>
                                            <td width="10%">
                                                @can('admin_categories_edit')
                                                    @if($detail->status==0)
                                                        <a href="/admin/installment/details/{{ $detail->id }}/paid"
                                                           class="btn-transparent btn-lg text-primary">
                                                            <i class="fa fa-handshake"></i>
                                                        </a>
                                                    @endif
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
