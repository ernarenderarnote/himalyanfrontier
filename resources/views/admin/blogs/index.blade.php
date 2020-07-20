@extends('layouts.admin')
@section('content')
@can('blog_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.blogs.create") }}">
                {{ trans('global.add') }} {{ trans('global.blog.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.blog.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable" id="sotable-table">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.blog.fields.name') }}
                        </th>
                        <th>
                            {{ trans('global.blog.fields.active') }}
                        </th>
                        <th>
                            {{ trans('global.blog.fields.image') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $key => $blog)
                        <tr class="sortable_data" data-entry-id="{{ $blog->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $blog->title ?? '' }}
                            </td>
                            <td>
                                @if( isset($blog->is_active) && $blog->is_active == 1)
                                    <span class="badge badge-success">Active</span>
                                @else 
                                    <span class="badge badge-danger">In Active</span>
                                @endif    
                            </td>
                            <td>
                                @if( isset($blog->thumbnails) )
                                    <img class="table-thumnbail" src="{{ url('/storage/images/blogs/featureImages/'.$blog->thumbnails) }}">
                                @endif
                            </td>
                            <td>
                                @can('product_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.blogs.show', $blog->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('product_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.blogs.edit', $blog->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('product_delete')
                                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    url: "{{ route('admin.blogs.massDestroy') }}",
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
                    swal("blogs deleted successfully.", {
                        icon: "success",
                    });
                    location.reload(); 
                });
                
            }
            
        });
    }
  }
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('blog_delete')
  dtButtons.push(deleteButton)
@endcan
  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
});

$( "#sotable-table" ).sortable({
        items: "tr",
        cursor: 'move',
        appendTo: "parent",
        opacity: 1,
        containment: "document",
        helper: "clone",
        placeholder: "ui-state-default",
        tolerance: "pointer",
        update: function() {
            sendOrderToServer();
        } 
}).disableSelection();

var fixHelper = function(e, ui) {  
    return ui;  
};
function sendOrderToServer() {
    var order = [];
    var token = $('meta[name="csrf-token"]').attr('content');
    $('tr.sortable_data').each(function(index,element) {
        order.push({
        id: $(this).attr('data-entry-id'),
        position: index+1
        });
    });
    $('.loader').show();
    $.ajax({
        type: "POST", 
        dataType: "json", 
        url: "{{ route('admin.blog.position') }}",
        data: {
                order: order,
                _token: token,
        },
        success: function(response) {
            if (response.status == "success") {
                $('.loader').hide();
            } else {
                $('.loader').hide();
            }
        }
    }); 
}
</script>
@endsection
@endsection