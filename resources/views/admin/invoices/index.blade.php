@extends('layouts.admin')
@section('content')
@can('destination_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.invoices.create") }}">
                Create Invoice
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.destination.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Invoice Number
                        </th>
                        <th>
                            Customer Name
                        </th>
                        <th>
                            Customer Email
                        </th>
                        <th>
                            Contact Number
                        </th>
                        <th>
                            Invoice Due Date
                        </th>
                        <th>
                            Created Date
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invoices as $invoice)
                        <tr data-entry-id="{{ $invoice->id }}">
                        <td></td>
                        <td>{{$invoice->invoice_prefix}}{{$invoice->invoice_id}}</td>
                        <td>{{$invoice->customer_name}}</td>
                        <td>{{$invoice->email}}</td>
                        <td>{{$invoice->contact_number}}</td>
                        <td>{{$invoice->invoice_due_date}}</td>
                        <td>{{$invoice->created_at}}</td>
                        <td>
                               
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.invoices.show', $invoice->id) }}">
                                View
                            </a>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.invoices.edit', $invoice->id) }}">
                                Edit
                            </a>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.invoices.downloadPdf', $invoice->id) }}">
                                Download
                            </a>
                            <form action="{{ route('admin.invoices.destroy', $invoice->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    url: "{{ route('admin.invoices.massDestroy') }}",
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
                    swal("Invoices deleted successfully.", {
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