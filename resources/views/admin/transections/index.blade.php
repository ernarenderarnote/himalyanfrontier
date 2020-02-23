@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Transections
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">
                            
                        </th>
                        <th>
                            Booking ID
                        </th>
                        <th>
                            Order Trcaking ID
                        </th>
                        <th>
                            Tracking ID
                        </th>
                        <th>
                            Bank Ref No.
                        </th>
                        <th>
                            Payment Status
                        </th>
                        <th>
                            Amount
                        </th>
                        <th>
                            Transection Date
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transections as $transection)
                        <tr data-entry-id="{{ $transection->id }}">
                        <td></td>
                        <td><span class="badge badge-success">{{isset($transection->booking->tracking_booking_id) ? '#'.$transection->booking->tracking_booking_id : '' }}</span></td>
                        <td>{{$transection->order_id}}</td>
                        <td>{{$transection->tracking_id}}</td>
                        <td>{{$transection->bank_ref_no}}</td>
                        <td>{{$transection->order_status}}</td>
                        <td>{{$transection->currency_data->symbol.' '.$transection->mer_amount}}</td>
                        <td>{{$transection->trans_date}}</td>
                        
                        <td>
                               
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.transections.show', $transection->id) }}">
                                View Details
                            </a>
                            
                            <form action="{{ route('admin.transections.destroy', $transection->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                            </form>
                        
                        </td>
                    @empty

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
    url: "{{ route('admin.transections.massDestroy') }}",
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
                    swal("Transections deleted successfully.", {
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