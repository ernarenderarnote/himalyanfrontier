@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{route('admin.slides.create')}}">
                Add New Slider
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        All Sliders
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Slider Name
                        </th>
                        <th>
                            Slider Images
                        </th>
                        <th>
                            Active
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sliders as $key => $slider)
                        <tr data-entry-id="{{ $slider->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $slider->title ?? '' }}
                            </td>
                            <td>
                                @if(isset($slider->photo) && !empty($slider->photo))
                                    @forelse( json_decode($slider->photo) as $slides)
                                        <img src="{{ url('/storage/images/sliders/'.$slides) }}" style="height:100px;width:100px;">
                                    @empty
                                    @endforelse
                                @endif
                            </td>
                            <td>
                                <div class="custom-control custom-radio">
                                    <form action="{{ route('admin.slides.default', $slider->id) }}" method="POST" style="display: inline-block;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="radio" slider-name="{{$slider->title}}" value="{{$slider->title}}" class="custom-control-input" id="customRadio{{$slider->id}}" name="default_slider" {{$slider->is_default == '1'  ? 'checked' : ''}}>
                                        <label class="custom-control-label" for="customRadio{{$slider->id}}"></label>
                                    </form>
                                </div>
                            </td>
                            
                            <td>
                               
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.slides.show', $slider->id) }}">
                                    {{ trans('global.view') }}
                                </a>
                            
                                <a class="btn btn-xs btn-info" href="{{ route('admin.slides.edit', $slider->id) }}">
                                    {{ trans('global.edit') }}
                                </a>
                            
                                <form action="{{ route('admin.slides.destroy', $slider->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    url: "{{ route('admin.slides.massDestroy') }}",
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
                    swal("Slider deleted successfully.", {
                        icon: "success",
                    });
                    location.reload(); 
                });
                
            }
            
        });
    }
  }
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  dtButtons.push(deleteButton)

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})
</script>
@endsection
@endsection