@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.destination.title') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('global.destination.fields.title') }}
                    </th>
                    <td>
                        {{ $destination->title }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.destination.fields.description') }}
                    </th>
                    <td>
                        {!! $destination->description !!}
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>
</div>

@endsection