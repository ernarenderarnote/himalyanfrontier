@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.currency.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.currencies.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('global.currency.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($currency) ? $currency->name : '') }}">
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.currency.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
                <label for="currency_code">{{ trans('global.currency.fields.currency_code') }}</label>
                <input type="text" id="name" name="code" class="form-control" value="{{ old('code', isset($currency) ? $currency->code : '') }}">
                @if($errors->has('code'))
                    <em class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.currency.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('symbol') ? 'has-error' : '' }}">
                <label for="currency_symbol">{{ trans('global.currency.fields.currency_symbol') }}</label>
                <input type="text" id="name" name="symbol" class="form-control" value="{{ old('symbol', isset($currency) ? $currency->symbol : '') }}">
                @if($errors->has('symbol'))
                    <em class="invalid-feedback">
                        {{ $errors->first('symbol') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.currency.fields.currency_symbol_helper') }}
                </p>
            </div>   
            <div class="form-group {{ $errors->has('exchange_rate') ? 'has-error' : '' }}">
                <label for="exchange_rate">{{ trans('global.currency.fields.exchange_rate') }}</label>
                <input type="text" id="exchange_rate" name="exchange_rate" class="form-control" value="{{ old('exchange_rate', isset($currency) ? $currency->exchange_rate : '') }}">
                @if($errors->has('exchange_rate'))
                    <em class="invalid-feedback">
                        {{ $errors->first('exchange_rate') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.currency.fields.currency_exchange_rate_helper') }}
                </p>
            </div> 
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection