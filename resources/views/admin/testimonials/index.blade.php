@extends('layouts.admin')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.testimonials.create") }}">
                Add Testimonial
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        Testimonials
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Active
                        </th>
                        <th>
                            Feature Image
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testimonials as $key => $testimonial)
                        <tr data-entry-id="{{ $testimonial->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $testimonial->title ?? '' }}
                            </td>
                            <td>
                                @if( isset($testimonial->is_active) && $testimonial->is_active == 1)
                                    <span class="badge badge-success">Active</span>
                                @else 
                                    <span class="badge badge-danger">In Active</span>
                                @endif    
                            </td>
                            <td>
                                @if( isset($testimonial->photo) )
                                    <img class="table-thumnbail" src="{{ url('/storage/images/testimonials/'.$testimonial->photo) }}">
                                @endif
                            </td>
                            <td>
                                    
                                
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.testimonials.edit', $testimonial->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                
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
    url: "{{ route('admin.testimonials.massDestroy') }}",
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
                    swal("testimonials deleted successfully.", {
                        icon: "success",
                    });
                    location.reload(); 
                });
                
            }
            
        });

    }
  }
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('destination_delete')
  dtButtons.push(deleteButton)
@endcan
  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})
</script>
@endsection
@endsection