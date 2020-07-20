@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="row">
        <div class="col-md-2">
            @can('itinerary_create')
                <div style="margin-bottom: 10px;">
                    <div class="col-md-2">
                        <a class="btn btn-success" href="{{ route("admin.itineraries.create") }}">
                            {{ trans('global.add') }} {{ trans('global.itinerary.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
        </div>  
        <div class="col-md-3">
            <form class="horizontal-form" method="post" action="{{ route('admin.itineraries.activity',['all']) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="filter_type" value="homepage">
                <select name="itinerary" class="form-control itinerary-filters">
                    <option value="">--Select Itinerary--</option>
                    <option value="introduction" {{ $itinerary_type == "introduction" ? "selected" : "" }}>Introduction Itinerary</option>
                    <option value="fixed-departure" {{ $itinerary_type == "fixed-departure" ? "selected" : "" }} >Fixed Departure</option>
                    <option value="upcoming-programs" {{ $itinerary_type == "upcoming-programs" ? "selected" : "" }} >Upcoming Programs</option>
                    <option value="hot-deal" {{ $itinerary_type == "hot-deal" ? "selected" : "" }} >Hot Deal</option>
                </select>
            </form>    
        </div>
        <div class="col-md-3">     
            <form class="activity-filter-form" method="post" action="{{ route('admin.itineraries.activity',['all']) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="filter_type" value="country">
         
                    <select name="country" class="form-control destination-filter">
                        <option value="">--Select Country--</option>
                        @if(isset($countries))
                            @foreach($countries as $country)
                                <option value="{{$country->slug}}" {{ $selected_destination == $country->slug ? "selected" : "" }} >{{$country->title}}</option>
                            @endforeach
                        @endif
                    </select>
            </form>  
        </div>   
        <div class="col-md-3">     
            <form class="activity-filter-form" method="post" action="{{ route('admin.itineraries.activity',['all']) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="filter_type" value="activity">
                      
                        <select name="itinerary_activity_type" class="form-control activity-filters">
                            <option value="">--Select Activity--</option>
                            @if($activity_lists && $activity_lists != '')
                                @foreach($activity_lists as $activity_list)
                                    <option value="{{$activity_list->slug}}" {{ $itinerary_type == $activity_list->slug ? "selected" : "" }}>{{$activity_list->title}}</option>
                                @endforeach
                            @endif
                        </select>
                    <input type="hidden" name="country" id="destination_filter_selected">    
                   
                    <!--<div class="col-md-2">
                        <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                    </div> -->
                </form>        
        </div>           
    </div> 

</div>
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
    /* $('.destination-filter').on('change', function(){
        alert('hello');
        $('.loader').show();
        var token   = $('meta[name="csrf-token"]').attr('content');
        var country = $(this).val();
        $.ajax({
            type: "POST", 
            url: "{{ route('admin.itineraries.countries') }}",
            data: {
                    country:country,
                    _token: token,
                    
            },
            success: function(response) {
                $('.activity-filters').html('');
                if (response) {
                    $('.activity-filters').append(response);
                    $('.loader').hide();
                } else {
                    $('.loader').hide();
                }
            }
        });
    }); */
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
  $('.datatable:not(.ajaxTable)').DataTable({
    buttons: dtButtons, 
        "lengthMenu": lengthMenu,
	} );
});
$('.app-body').on('change','.itinerary-filters', function(){
    var filter_type = $(this).val();
    var url = '{{ route("admin.itineraries.type", ":id") }}';
    url = url.replace(':id', filter_type);
    $(this).closest('form').attr('action',url);
    $(this).closest('form').submit();  
   
});
$('.app-body').on('change','.activity-filters', function(){
    var filter_type = $(this).val(); 
    var destination_value = $('.destination-filter option:selected').val();
    $('#destination_filter_selected').val(destination_value);
    if(filter_type !='' ){
        var url = '{{ route("admin.itineraries.activity", ":id") }}';
        url = url.replace(':id', filter_type);
        $('.activity-filter-form').attr('action',url);
        $('.activity-filter-form').submit();  
    }
});
$('.app-body').on('change','.destination-filter', function(){
    var filter_type = $(this).val(); 
    if(filter_type !='' ){
        var url = '{{ route("admin.itineraries.activity", ":id") }}';
        url = url.replace(':id', filter_type);
        $(this).closest('form').attr('action',url);
        $(this).closest('form').submit();  
    }
});
var filter_var = "{{ $filter_type }}";
if( filter_var == "homepage" || filter_var == 'activity' || filter_var == 'country'){
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