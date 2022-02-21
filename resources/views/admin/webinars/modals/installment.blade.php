<!-- Modal -->
<div class="d-none" id="installmentTicketModal">
    <h3 class="section-title after-line font-20 text-dark-blue mb-25">{{ trans('admin/main.installment') }}</h3>
    <form action="/admin/installment-plan/store" method="post">
        <input type="hidden" name="webinar_id" value="{{ !empty($webinar) ? $webinar->id :'' }}">

        <div class="form-group">
            <label class="input-label">{{ trans('public.title') }}</label>
            <input type="text" name="title" class="form-control" placeholder="{{ trans('forms.maximum_64_characters') }}"/>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label class="input-label">{{ trans('public.price') }}</label>
            <input type="number" name="price" class="form-control"/>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group mt-15 ">
            <label class="input-label d-block">{{ trans('admin/main.installment_type') }}</label>

            <select name="installment_type" class="custom-select @error('installment_interval_type')  is-invalid @enderror">
                <option value="day">{{ trans('admin/main.day') }}</option>
                <option value="month" selected>{{ trans('admin/main.month') }}</option>
                <option value="year">{{ trans('admin/main.year') }}</option>
            </select>

            @error('installment_type')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group mt-15">
            <label class="input-label">{{ trans('admin/main.installment_interval_num') }}</label>
            <input type="number" min="1" name="installment_interval_number" value="{{  old('installment_interval_num') }}" class="form-control @error('installment_interval_num')  is-invalid @enderror"/>
            @error('installment_interval_number')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group mt-15">
            <label class="input-label">{{ trans('admin/main.installment_num') }}</label>
            <input type="number" min="1" name="instalment_num" value="{{  old('installment_num') }}" class="form-control @error('installment_num')  is-invalid @enderror"/>
            @error('instalment_num')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group mt-15">
            <label class="input-label">{{ trans('admin/main.installment_default_value') }}</label>
            <input type="number" min="1" name="default_payment" value="{{  old('installment_interval_num') }}" class="form-control @error('default_payment')  is-invalid @enderror"/>
            @error('default_payment')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mt-30 d-flex align-items-center justify-content-end">
            <button type="button" id="saveInstallmentPlan" class="btn btn-primary">{{ trans('public.save') }}</button>
            <button type="button" class="btn btn-danger ml-2 close-swl">{{ trans('public.close') }}</button>
        </div>
    </form>
</div>
