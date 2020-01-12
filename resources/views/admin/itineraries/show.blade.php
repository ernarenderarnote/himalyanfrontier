@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.itinerary.title') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('global.itinerary.fields.title') }}
                    </th>
                    <td>
                        {{ $itinerary->title }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.itinerary.fields.description') }}
                    </th>
                    <td>
                        {!! $itinerary->description !!}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.itinerary.fields.price') }}
                    </th>
                    <td>
                        ${{ $itinerary->price }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection