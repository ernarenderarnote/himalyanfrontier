@extends('layouts.admin')
@section('content')
@can('itinerary_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.itineraries.create") }}">
                {{ trans('global.add') }} {{ trans('global.itinerary.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.itinerary.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.itinerary.fields.name') }}
                        </th>
                        <th>
                            Avtive
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            Destinations
                        </th>
                        <th>
                            Activities
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($itineraries as $key => $itinerary)
                        <tr data-entry-id="{{ $itinerary->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $itinerary->title ?? '' }}
                            </td>
                            <td>
                            <span class="badge badge-success">{{ $itinerary->status ?? '' }}</span>
                            </td>
                            <td>
                                {{ $itinerary->price ? $itinerary->currency->symbol.' '.$itinerary->price : ' '  }}
                            </td>
                            <td>
                                @if(isset($itinerary->destinations))
                                    @foreach($itinerary->destinations as $destination)
                                        <span class="badge badge-success">{{$destination->title}}</span>
                                    @endforeach
                                
                                @endif
                            </td>
                            <td>
                                @if(isset($itinerary->activities))
                                    @foreach($itinerary->activities as $activity)
                                        <span class="badge badge-info">{{$activity->title}}</span>
                                    @endforeach
                                
                                @endif
                            </td>
                            <td>
                                @can('itinerary_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.itineraries.show', $itinerary->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('itinerary_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.itineraries.edit', $itinerary->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('itinerary_delete')
                                    <form action="{{ route('admin.itineraries.destroy', $itinerary->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    url: "{{ route('admin.itineraries.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        swal({ text: "{{ trans('global.datatables.zero_selected') }}" });
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
                    swal("Itinerary deleted successfully.", {
                        icon: "success",
                    });
                    location.reload(); 
                });
                
            }
            
        });
    }
  }
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  
@can('itinerary_delete')
  dtButtons.push(deleteButton)
@endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons });
  $('body .dataTables_filter').append('helo');
})

</script>
@endsection
@endsection