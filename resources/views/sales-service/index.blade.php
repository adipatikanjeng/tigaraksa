@extends('sales-service')
@section('content_sales-service')
<div class="breadcrumb breadcrumb_account">
    <a href="{{ url(App::getLocale()) }}">Home</a><span> / </span>
    <a href="{{ url(App::getLocale().'/sales') }}">Sales Service</a><span> / </span>
    <a href="">Kontrak Pembelian</a>
</div>
<h2>
    Kontrak Pembelian
</h2>
@include('partial.alert')
<div class="contact_form form_account after_clear" style="margin:60px 0 0 0">
    <form method="GET" action="">
        <div class="row_account after_clear">
            <div class="col_account">
                <div class="inves">
                    <div><input type="text" class="datepicker" value="{{ Input::get('start_date') }}" placeholder="Start Date" name="start_date" onchange="this.form.submit()"></div>
                </div>
            </div>
            <div class="col_account">
                <div class="inves">
                    <div> <input type="text" class="datepicker" value="{{ Input::get('end_date') }}" name="end_date" placeholder="End Date" onchange="this.form.submit()"></div>
                </div>
            </div>
        </div>
        <div class="row_account after_clear">
            <div class="col_account">
                <div class="inves">
                    <div> {!! Form::select('status', [ '' => 'Select Status', 'Released' => 'Released','Sent to Ho' => 'Sent to Ho'], Input::get('status'), ['onchange' => "this.form.submit()", 'autocomplete' => 'off', 'style' => 'width:258px !important']) !!}</div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="outer">
    <div class="box_tb_kontrak">
        <table class="tb_kontrak">
            <thead>
                <tr>
                    <th width="10%">No</th>
                    <th width="15%">Contract Number</th>
                    <th align="left" width="20%">{{ trans('global.name') }}</th>
                    <th align="left" width="20%">Tanggal</th>
                    <th width="15%">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1?>
                @foreach($rows as $row)
                <tr class="odd">
                    <td align="center">{{ $i }}.</td>
                    <td>{{ $row->contract_number }}{{ $row->branch->name }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ Carbon::parse($row->created_at)->format('d F Y') }}</td>
                    <td align="center">
                        @if($row->status == 'Released')
                        <a title="Send to Ho" href="{{ url(App::getLocale().'/sales/send-to-ho/'.$row->id) }}"><img src="{{ asset('images') }}/material/check.png"/></a>
                        <a title="Reject" href="{{ url(App::getLocale().'/sales/reject/'.$row->id) }}"><img src="{{ asset('images') }}/material/delete.png"/></a>
						<a href="{{ url(App::getLocale().'/sales/invoice/'.$row->id) }}" style="margin-left:40px;" target="_blank"><img src="{{ asset('images') }}/material/ico_pdf.png"/></a>
                         <a title="View" href="{{ url(App::getLocale().'/sales/review/'.$row->id) }}"><img src="{{ asset('images') }}/material/kaca-pembesar.png"/></a>
                        @else
                        {{ $row->status }}
                        @endif
                    </td>
               </tr>
               <?php $i++?>
               @endforeach
           </tbody>
       </table>
   </div>
</div>
@include('pagination.default', ['paginator' => $rows])
@endsection