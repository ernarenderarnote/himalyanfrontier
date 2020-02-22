@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Bookings
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">
                            
                        </th>
                        <th>
                            Itinerary Name
                        </th>
                        <th>
                            Booker Name
                        </th>
                        <th>
                            Booking Date
                        </th>
                        <th>
                            Amount Paid
                        </th>
                        <th>
                            Amount Remaining
                        </th>
                        <th>
                            Booking Status
                        </th>
                        <th>
                            Booking ID
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr data-entry-id="{{ $booking->id }}">
                            <td></td>
                            <td>{{$booking->itinerary->title}}</td>
                            <td>{{$booking->user->name}}</td>
                            <td>{{$booking->created_at}}</td>
                            <td>{{$booking->currency->symbol}} {{number_format($booking->payment_paid,2)}}</td>
                            <td>{{$booking->currency->symbol}} {{number_format($booking->remaining_payment,2)}}</td>
                            <td> <span class="badge badge-info">#{{$booking->tracking_booking_id}}</span></td>
                            <td>@if($booking->booking_status == 'completed')
                                    <span class="badge badge-success">{{str_replace('_',' ',$booking->booking_status)}}</span>
                                @elseif($booking->booking_status == 'partial_completed')
                                    <span class="badge badge-warning">{{str_replace('_',' ',$booking->booking_status)}}</span>
                                @elseif($booking->booking_status == 'pending')
                                    <span class="badge badge-info">{{str_replace('_',' ',$booking->booking_status)}}</span>
                                @elseif($booking->booking_status == 'canceled')
                                    <span class="badge badge-danger">{{str_replace('_',' ',$booking->booking_status)}}</span>
                                @else
                                    <span class="badge badge-danger"></span>
                                @endif
                            </td>
                            <td>
                               
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.booking.show', $booking->id) }}">
                                    {{ trans('global.view') }}
                                </a>
                                
                               
                                <form action="{{ route('admin.booking.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                </form>
                               
                            </td>
                        </tr>
                    @empty
                    <tr>No data found</tr>

                    @endforelse

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
    url: "{{ route('admin.booking.massDestroy') }}",
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
                    swal("Booking deleted successfully.", {
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