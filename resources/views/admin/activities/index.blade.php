@extends('layouts.admin')
@section('content')
@can('activity_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.activities.create") }}">
                {{ trans('global.add') }} {{ trans('global.activity.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.activity.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.activity.fields.name') }}
                        </th>
                        <th>
                            {{ trans('global.activity.fields.active') }}
                        </th>
                        <th>
                            {{ trans('global.activity.fields.image') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activities as $key => $activity)
                        <tr data-entry-id="{{ $activity->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $activity->title ?? '' }}
                            </td>
                            <td>
                                @if( isset($activity->is_active) && $activity->is_active == 1)
                                    <span class="badge badge-success">Active</span>
                                @else 
                                    <span class="badge badge-danger">In Active</span>
                                @endif    
                            </td>
                            <td>
                                @if( isset($activity->thumbnails) )
                                    <img class="table-thumnbail" src="{{ url('/storage/images/'.$activity->thumbnails) }}">
                                @endif
                            </td>
                            <td>
                                @can('product_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.activities.show', $activity->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('product_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.activities.edit', $activity->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('product_delete')
                                    <form action="{{ route('admin.activities.destroy', $activity->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
$(function () {
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.activities.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });
      if (ids.length === 0) {
        swal("{{ trans('global.datatables.zero_selected') }}", {
            buttons: false,
            timer: 3000,
        });
        return
      }
      swal({
        title: 'Are you sure?',
        text: "It will permanently deleted !",
        icon: 'warning',
        buttons: true,
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    headers: {'x-csrf-token': _token},
                    method: 'POST',
                    url: config.url,
                    data: { ids: ids, _method: 'DELETE' }
                })
                .done(function () { 
                    swal("Activities deleted successfully.", {
                        icon: "success",
                    });
                    location.reload(); 
                });
                
            }
            
        });
    }
  }
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('activity_delete')
  dtButtons.push(deleteButton)
@endcan
  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})
</script>
@endsection
@endsection