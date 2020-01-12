@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.activity.title') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('global.activity.fields.title') }}
                    </th>
                    <td>
                        {{ $activity->title }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.activity.fields.description') }}
                    </th>
                    <td>
                        {!! $activity->description !!}
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>
</div>

@endsection