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
            <table class=" table table-bordered table-striped table-hover datatable" id="sotable-table">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.itinerary.fields.name') }}
                        </th>
                        <th>
                            Type
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
                            Status
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody id="tablecontents">
                    @foreach($itineraries as $key => $itinerary)
                        <tr class="sortable_data" data-entry-id="{{ $itinerary->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $itinerary->title ?? '' }}
                            </td>
                            <td>
                                @if($itinerary->fixed_diparture == '1')
                                    <span class="badge badge-info">Fixed Departure</span>
                                    @elseif($itinerary->hot_deal == '1')
                                        <span class="badge badge-info">Hot Deal</span>
                                    @else

                                @endif
                            </td>
                            <td>
                                {{ $itinerary->price ? $itinerary->currency->symbol.' '.$itinerary->price : ' '  }}
                            </td>
                            <td>
                                @if(isset($itinerary->destinations))
                                    @foreach($itinerary->destinations as $destination)
                                        <span class="badge badge-danger">{{$destination->title}}</span>
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
                                <span class="badge badge-success">{{ $itinerary->status ?? '' }}</span>
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
<div class="loader" style="display:none;"><img src="/images/demo_wait.gif"></div>
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
    var fiter_var = "{{ $itinerary_type }}";
    if( fiter_var == "homepage_itinerary" ){
        var lengthMenu = [[-1], ['All']];
    }else{
        var lengthMenu =  [[10, 25, 50, -1], [10, 25, 50, 'All']];
    }
    var itineraryFilter = '';
        itineraryFilter += '<form method="post" action="{{ route('admin.itineraries.type',['all']) }}">';
        itineraryFilter += '<input type="hidden" name="_token" value="{{ csrf_token() }}">';
        itineraryFilter += '<input type="hidden" name="filter_type" value="homepage">';
        itineraryFilter += '<select name="itinerary_type" class="itinerary-filter form-control">';
        itineraryFilter += '<option value="">Itinerary</option>';
        itineraryFilter += '<option value="introduction" {{ $itinerary_type == "introduction" ? "selected" : "" }}>Introduction Itinerary</option>';
        itineraryFilter += '<option value="fixed-departure" {{ $itinerary_type == "fixed-departure" ? "selected" : "" }} >Fixed Departure</option>';
        itineraryFilter += '<option value="upcoming-programs" {{ $itinerary_type == "upcoming-programs" ? "selected" : "" }} >Upcoming Programs</option>';
        itineraryFilter += '<option value="hot-deal" {{ $itinerary_type == "hot-deal" ? "selected" : "" }} >Hot Deal</option>';
        itineraryFilter += '</select>';
        itineraryFilter += '</form>';

    var activityFilter = '';
        activityFilter += '<form method="post" action="{{ route('admin.itineraries.activity',['all']) }}">';
        activityFilter += '<input type="hidden" name="_token" value="{{ csrf_token() }}">';
        activityFilter += '<input type="hidden" name="filter_type" value="activity">';
        activityFilter += '<select name="itinerary_activity_type" class="itinerary-activity-filter form-control">';
        activityFilter += '<option value="">Activity</option>';
        @php if(isset($activities)){
                foreach($activities as $activity){ @endphp
                    activityFilter += '<option value="{{$activity->slug}}" {{ $itinerary_type == $activity->slug ? "selected" : "" }} >{{$activity->title}}</option>';
                @php }
            }
        @endphp
        activityFilter += '</select>';
        activityFilter += '</form>';    
  $('.datatable:not(.ajaxTable)').DataTable({
    buttons: dtButtons, 
        "lengthMenu": lengthMenu,
	'fnDrawCallback': function (oSettings) {
		$('.dt-buttons').each(function () {
            $('.buttons-colvis').css('display','none');
            $('.buttons-excel').css('display','none');
            $('.buttons-print').css('display','none');
			$(this).append(itineraryFilter +' '+activityFilter);
		}); 
	} } );
})
$('.app-body').on('change','.itinerary-filter', function(){
    var filter_type = $(this).val();
    var url = '{{ route("admin.itineraries.type", ":id") }}';
    url = url.replace(':id', filter_type);
    $(this).closest('form').attr('action',url);
    $(this).closest('form').submit();  
   
});
$('.app-body').on('change','.itinerary-activity-filter', function(){
    var filter_type = $(this).val(); 
    var url = '{{ route("admin.itineraries.activity", ":id") }}';
    url = url.replace(':id', filter_type);
    $(this).closest('form').attr('action',url);
    $(this).closest('form').submit();  
   
});
var filter_var = "{{ $filter_type }}";
if( filter_var == "homepage" || filter_var == 'activity'){
    $( "#tablecontents" ).sortable({
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
        console.log('here');
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
            url: "{{ route('admin.itineraries.hompage') }}",
            data: {
                    order: order,
                    _token: token,
                    filter_type:filter_var
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
}

</script>
@endsection
@endsection