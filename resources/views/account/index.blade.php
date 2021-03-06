@extends('account')
@section('content_account')

<div class="breadcrumb">
    <a href="{{ url(App::getLocale()) }}">Home</a><span> / </span>
    <a href="{{ url(App::getLocale().'/my-account') }}">My Account</a><span> / </span>
    <a href="">My Info</a>
</div>
@if($row)
<div class="title_log after_clear">
    <h2>
        My Info
    </h2>
    <span>Welcome : {{ ucwords(strtolower(@$row->rm_name)) }} <a href="{{ url('auth/logout') }}" class="readmore type_2">Logout</a></span>
</div>

<div class="title_biodata after_clear">
    <h5>Biodata EPC/ EPD/ GEPD</h5>
    <span class="icon-print">
        <a href="{{ url(App::getLocale().'/my-account/profile-pdf/'.$row->rm_rep_id.'/'.$year) }}"><img src="{{ asset('images') }}/material/ico_pdf.png"/></a>
    </span>
</div>

<table class="tb_biodata">
    <tr>
        <th width="20%">Name</th> <th>:</th> <td> {{ ucwords(strtolower($row->rm_name)) }}</td>
    </tr>
    <tr>
        <th width="20%">ID</th> <th>:</th> <td> {{ $row->rm_rep_id }}</td>
    </tr>
    <tr>
        <th width="20%">Level</th> <th>:</th> <td>{{ ucwords(strtolower($row->rm_status_position)) }}</td>
    </tr>
    <tr>
        <th width="20%">Recruiter</th> <th>:</th> <td>{{ ucwords(strtolower($row->rm_recruiter_name)) }}</td>
    </tr>
    <tr>
        <th width="20%">EPD</th> <th>:</th> <td>{{ ucwords(strtolower($row->rm_epd_name)) }}</td>
    </tr>
    <tr>
        <th width="20%">GEPD</th> <th>:</th> <td>{{ ucwords(strtolower($row->rm_gepd_name)) }}</td>
    </tr>
    <tr>
        <th width="20%">Address</th> <th>:</th> <td> {{ ucwords(strtolower($row->rm_home_address_2)) }}</td>
    </tr>
    <tr>
        <th width="20%">Phone</th> <th>:</th> <td>{{ $row->rm_phone_home }}</td>
    </tr>
    <tr>
        <th width="20%">Cellular</th> <th>:</th> <td>{{ $row->rm_mobile_phone }}</td>
    </tr>
    <tr><td colspan="3"><a class="readmore type_2" id="changePasswordMyAccount">Change Password</a></td></tr>
</table>
<?php $branchId = $row->rm_branch_id ?>
<div class="account_form after_clear" style="margin:20px 0 0 0">
    <div id="divChangePassword" hidden>
        <div class="row_input">
            <div class="col_input">
                <label>Password :</label>
                <input class="" id="userPassword" type="password" name="password">
            </div>
        </div>
        <div class="row_input">
            <div class="col_input">
                <label>Konfirmasi Password :</label>
                <input class="" type="password" id="userPasswordConfirm" name="password_confirmation">
            </div>
        </div>
        <div class="row_input">
            <div class="col_input" style="margin-top:15px;">
                <button data-url="{{ url(App::getLocale().'/my-account/ajax-change-password') }}" class="btn_std change-password" type="submit" style="padding: 0 30px;">Ubah</button>
            </div>
        </div>
    </div>
</div>

<div style="border-bottom:1px solid #ddd;margin-top:60px;"></div>
<div class="contact_form form_account after_clear" style="margin:30px 0 0 0">
    <form action="{{ url(App::getLocale().'/my-account') }}">
        <div class="row_account">
            <div class="col_account" style="width:auto">
                <label>Periode :</label>
                {!! Form::select('year', $years, Input::get('year')) !!}
                <button type="submit" class="btn_std" style="margin-left:15px;">Submit</button>
            </div>
        </div>

        <div class="after_clear" style="margin-bottom:40px;"></div>

        <!--TAB-->
        <div id="parentHorizontalTab">
            <ul class="resp-tabs-list hor_1">
                <li>Achievement</li>
                <li>Komisi</li>
                <li>Unpaid</li>
                <li>Org Chart</li>
                <li>Org Recruiter</li>
                <li>Oct</li>
            </ul>
            <div class="resp-tabs-container hor_1">
                <div>
                    <div class="boxTableAccount">
                        <table class="tb_kontrak tb_tab">
                            <thead>
                                <tr>
                                    <th width="20%">Periode</th>
                                    <th width="20%">PS</th>
                                    <th width="20%">MS</th>
                                    <th width="35%">Direct Member Sales</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalPs = 0;?>
                                <?php $totalMs = 0;?>
                                <?php $totalDms = 0;?>
                                <?php $quarter1Ps = 0?>
                                <?php $quarter2Ps = 0?>
                                <?php $quarter3Ps = 0?>
                                <?php $quarter4Ps = 0?>
                                <?php $quarter1Ms = 0?>
                                <?php $quarter2Ms = 0?>
                                <?php $quarter3Ms = 0?>
                                <?php $quarter4Ms = 0?>
                                <?php $quarter1Dms = 0?>
                                <?php $quarter2Dms = 0?>
                                <?php $quarter3Dms = 0?>
                                <?php $quarter4Dms = 0?>
                                @for($i = 1; $i <= 12; $i++)
                                @if($data = $achievements->where(\DB::raw('month'), sprintf("%02d", $i))->first())
                                <tr class="<?=($i % 2) ?: 'even'?>">
                                    <td align="center">{{ Carbon::create($data['year'],$data['month'], 1)->format('M, Y') }}</td>
                                    <td align="center">{{ ($data['ac_PSSU']) ?: '-'  }}</td>
                                    <td align="center">{{ ($data['ac_MSSU']) ?: '-'  }}</td>
                                    <td align="center">{{ ($data['ac_RISU']) ?: '-'  }}</td>
                                </tr>
                                <?php $quarter1Ps += (in_array($i, [1, 2, 3])) ? $data['ac_PSSU'] : 0?>
                                <?php $quarter2Ps += (in_array($i, [4, 5, 6])) ? $data['ac_PSSU'] : 0?>
                                <?php $quarter3Ps += (in_array($i, [7, 8, 9])) ? $data['ac_PSSU'] : 0?>
                                <?php $quarter4Ps += (in_array($i, [10, 11, 12])) ? $data['ac_PSSU'] : 0?>
                                <?php $quarter1Ms += (in_array($i, [1, 2, 3])) ? $data['ac_MSSU'] : 0?>
                                <?php $quarter2Ms += (in_array($i, [4, 5, 6])) ? $data['ac_MSSU'] : 0?>
                                <?php $quarter3Ms += (in_array($i, [7, 8, 9])) ? $data['ac_MSSU'] : 0?>
                                <?php $quarter4Ms += (in_array($i, [10, 11, 12])) ? $data['ac_MSSU'] : 0?>
                                <?php $quarter1Dms += (in_array($i, [1, 2, 3])) ? $data['ac_RISU'] : 0?>
                                <?php $quarter2Dms += (in_array($i, [4, 5, 6])) ? $data['ac_RISU'] : 0?>
                                <?php $quarter3Dms += (in_array($i, [7, 8, 9])) ? $data['ac_RISU'] : 0?>
                                <?php $quarter4Dms += (in_array($i, [10, 11, 12])) ? $data['ac_RISU'] : 0?>
                                <?php $totalPs += $data['ac_PSSU']?>
                                <?php $totalMs += $data['ac_MSSU']?>
                                <?php $totalDms += $data['ac_RISU']?>
                                @else
                                <tr class="<?=($i % 2) ?: 'even'?>">
                                    <td align="center">{{ Carbon::create($year, sprintf("%02d", $i), 1)->format('M, Y') }}</td>
                                    <td align="center">-</td>
                                    <td align="center">-</td>
                                    <td align="center">-</td>
                                </tr>
                                @endif
                                @endfor
                                <tr>
                                    <th align="center">Total</th>
                                    <th align="center">{{ $totalPs }}</th>
                                    <th align="center">{{ $totalMs }}</th>
                                    <th align="center">{{ $totalDms }}</th>
                                </tr>
                                <tr>
                                    <th align="center">&nbsp;</th>
                                    <th align="center">&nbsp;</th>
                                    <th align="center">&nbsp;</th>
                                    <th align="center">&nbsp;</th>
                                </tr>
                                <tr>
                                    <th align="center">Quarter 1</th>
                                    <th align="center">{{ $quarter1Ps }}</th>
                                    <th align="center">{{ $quarter1Ms }}</th>
                                    <th align="center">{{ $quarter1Dms }}</th>
                                </tr>
                                <tr>
                                    <th align="center">Quarter 2</th>
                                    <th align="center">{{ $quarter2Ps }}</th>
                                    <th align="center">{{ $quarter2Ms }}</th>
                                    <th align="center">{{ $quarter2Dms }}</th>
                                </tr>
                                <tr>
                                    <th align="center">Quarter 3</th>
                                    <th align="center">{{ $quarter3Ps }}</th>
                                    <th align="center">{{ $quarter3Ms }}</th>
                                    <th align="center">{{ $quarter3Dms }}</th>
                                </tr>
                                <tr>
                                    <th align="center">Quarter 4</th>
                                    <th align="center">{{ $quarter4Ps }}</th>
                                    <th align="center">{{ $quarter4Ms }}</th>
                                    <th align="center">{{ $quarter4Dms }}</th>
                                </tr>
                                <tr>
                                    <th align="center">&nbsp;</th>
                                    <th align="center">&nbsp;</th>
                                    <th align="center">&nbsp;</th>
                                    <th align="center">&nbsp;</th>
                                </tr>
                                <tr>
                                    <th align="center">Semester 1</th>
                                    <th align="center">{{ $quarter1Ps + $quarter2Ps }}</th>
                                    <th align="center">{{ $quarter1Ms + $quarter2Ms }}</th>
                                    <th align="center">{{ $quarter1Dms + $quarter2Dms }}</th>
                                </tr>
                                <tr>
                                    <th align="center">Semester 2</th>
                                    <th align="center">{{ $quarter3Ps + $quarter4Ps }}</th>
                                    <th align="center">{{ $quarter3Ms + $quarter4Ms }}</th>
                                    <th align="center">{{ $quarter3Dms + $quarter4Dms }}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div>
                    <div class="boxTableAccount">
                        <table class="tb_kontrak tb_tab">
                            <thead>
                                <tr>
                                    <th width="14%">Periode</th>
                                    <th width="15%">PS</th>
                                    <th width="15%">SL</th>
                                    <th width="8%">RI</th>
                                    <th width="8%">RA</th>
                                    <th width="8%">MS</th>
                                    <th width="8%">Promo</th>
                                    <th width="10%">Other</th>
                                    <th width="12%">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 1; $i <= 12; $i++)
                                <tr class="{{ ($i % 2) ? 'odd' : 'even' }}">
                                    @if((date('m') == $i || date('m') - 1 == $i))
                                        @if ($commissions[$i]['subTotal'] <> '-')
                                        <td align="center" style="color:#1fb25a;text-decoration:underline">
                                        <a href="{{ url('my-account/download-slip/'.$year.'/'.$i) }}"> {{ Carbon::create($year, $i, 1)->format('M, Y') }}</a>
                                        </td>
                                        @else
                                        <td align="center">
                                        {{ Carbon::create($year, $i, 1)->format('M, Y') }}
                                        </td>
                                        @endif
                                    @elseif($i == 12 && date('m') - 1 == 0)
                                      @if ($commissions[$i]['subTotal'] <> '-')
                                        <td align="center" style="color:#1fb25a;text-decoration:underline">
                                        <a href="{{ url('my-account/download-slip/'.$year.'/'.$i) }}"> {{ Carbon::create($year, $i, 1)->format('M, Y') }}</a>
                                        </td>
                                        @else
                                        <td align="center">
                                        {{ Carbon::create($year, $i, 1)->format('M, Y') }}
                                        </td>
                                        @endif
                                      </td>
                                    @else
                                    <td align="center" style="">
                                        {{ Carbon::create($year, $i, 1)->format('M, Y') }}
                                    </td>
                                    @endif
                                    <td align="center">{{ $commissions[$i]['ps'] }}</td>
                                    <td align="center">{{ $commissions[$i]['sl'] }}</td>
                                    <td align="center">{{ $commissions[$i]['ri'] }}</td>
                                    <td align="center">{{ $commissions[$i]['ra'] }}</td>
                                     <td align="center">{{ $commissions[$i]['ms'] }}</td>
                                    <td align="center">{{ $commissions[$i]['promo'] }}</td>
                                    <td align="center">{{ $commissions[$i]['other'] }}</td>
                                    <td align="center">{{ $commissions[$i]['subTotal'] }}</td>
                                </tr>
                                @endfor
                                <tr>
                                    <th align="center">TOTAL</th>
                                    <th align="center">{{ $commissions['psTotal'] }}</th>
                                    <th align="center">{{ $commissions['msTotal'] }}</th>
                                    <th align="center">{{ $commissions['slTotal'] }}</th>
                                    <th align="center">{{ $commissions['riTotal'] }}</th>
                                    <th align="center">{{ $commissions['raTotal'] }}</th>
                                    <th align="center">{{ $commissions['promoTotal'] }}</th>
                                    <th align="center">{{ $commissions['otherTotal'] }}</th>
                                    <th align="center">{{ $commissions['allTotal'] }}</th>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div>
                    <div class="boxTableAccount">
                        <table class="tb_kontrak tb_tab">
                            <thead>
                                <tr>
                                    <th width="20%">Periode</th>
                                    <th width="20%">KP Number</th>
                                    <th width="20%">Commission Gross</th>
                                    <th width="20%">Tax </th>
                                    <th width="35%">Paid Ammout</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalCga = 0;
                                $totalTa = 0;
                                $totalPa = 0;?>
                                <?php $i = 1 ?>
                                @foreach($unpaid->get() as $data)
                                <tr class="<?=($i % 2) ?: 'even'?>">
                                    <th align="center">{{ Carbon::create($data->rp_period_year,$data->rp_period_month, 1)->format('M, Y') }}</th>
                                    <th align="center">{{ $data->rp_kp_number }}</th>
                                    <th align="center">{{ App\Site::money($data->rp_commission_gross_amount) }}</th>
                                    <th align="center">{{ App\Site::money($data->rp_tax_amount) }}</th>
                                    <th align="center">{{ App\Site::money($data->rp_paid_amount) }}</th>
                                </tr>
                                <?php $totalCga += $data->rp_commission_gross_amount?>
                                <?php $totalTa += $data->rp_tax_amount?>
                                <?php $totalPa += $data->rp_paid_amount?>
                                <?php $i++ ?>
                                @endforeach
                                <tr class="">
                                    <th align="center">TOTAL</th>
                                    <th align="center"> </th>
                                    <th align="center">{{ App\Site::money($totalCga) }}</th>
                                    <th align="center">{{ App\Site::money($totalTa) }}</th>
                                    <th align="center">{{ App\Site::money($totalPa) }}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                    <div class="boxTableAccount">

                        <div class="tree well" style="width:670px !important;">
                            <ul>
                                <li>
                                    <span>
                                        <span class="boxImage"><img src="{{ asset('images') }}/material/org_print.png"/></span>
                                        <a href="{{ url(App::getLocale().'/my-account/download-org-chart') }}" target="_blank"><span class="readmore type_2 text_tree">Print Org Chart</span></a>
                                    </span>
                                </li>
                                <li>
                                    <span>
                                        <span class="boxImage"><img src="{{ asset('images') }}/material/org_maps.png"/></span>
                                        <span class="readmore type_2 text_tree">Branch {{ $branchId }}</span>
                                    </span>
                                    <ul>

                                     @if($profile->rm_current_position == 'GEPD')

                                     <li>
                                        <span>
                                            <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                            <span class="readmore type_2 text_tree">{{ $profile->rm_rep_id }} - {{ $profile->rm_name }} - {{ Carbon::parse($row->rm_join_date)->format('d-M-Y') }} - {{ $profile->rm_current_position }} ({{ $profile->rm_branch_id }})</span>
                                        </span>
                                        @if(count($orgChart))
                                        @foreach($orgChart::orgChart($profile->rm_rep_id)->get() as $row)
                                        @if($row->rm_current_position == 'EPD')
                                        <ul>
                                            <li>
                                                <span>
                                                    <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                                    <span class="readmore type_2 text_tree">{{ $row->rm_rep_id }} - {{ $row->rm_name }} - {{ Carbon::parse($row->rm_join_date)->format('d-M-Y') }} - {{ $row->rm_current_position }} ({{ $row->rm_branch_id }})</span>
                                                </span>
                                                <ul>
                                                    @foreach($orgChart::orgChart($row->rm_rep_id)->get() as $childRow)
                                                    <li>
                                                     <span>
                                                        <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                                        <span class="readmore type_2 text_tree">{{ $childRow->rm_rep_id }} - {{ $childRow->rm_name }} - {{ Carbon::parse($childRow->rm_join_date)->format('d-M-Y') }} - {{ $childRow->rm_current_position }} ({{ $row->rm_branch_id }})</span>
                                                    </span>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                    @elseif($row->rm_current_position == 'EPC')
                                    <ul>
                                        <li>
                                            <span>
                                                <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                                <span class="readmore type_2 text_tree">{{ $row->rm_rep_id }} - {{ $row->rm_name }} - {{ Carbon::parse($row->rm_join_date)->format('d-M-Y') }} - {{ $row->rm_current_position }} ({{ $row->rm_branch_id }})</span>
                                            </span>
                                        </li>
                                    </ul>
                                    @endif
                                    @endforeach
                                    @endif
                                </li>

                                @elseif($profile->rm_current_position == 'EPD')
                                <?php $gepd = $orgChart::where('rm_rep_id', $profile->rm_manager_id)->where('rm_current_position', 'GEPD')->first() ?>
                                @if($gepd)
                                <li>
                                    <span>
                                        <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                        <span class="readmore type_2 text_tree">{{ @$gepd->rm_rep_id }} - {{ @$gepd->rm_name }} - {{ Carbon::parse($profile->rm_join_date)->format('d-M-Y') }} - {{ @$gepd->rm_current_position }} ({{ @$gepd->rm_branch_id }})</span>
                                    </span>
                                    <ul>
                                        <li>
                                            <span>
                                                <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                                <span class="readmore type_2 text_tree">{{ @$profile->rm_rep_id }} - {{ @$profile->rm_name }} - {{ Carbon::parse($profile->rm_join_date)->format('d-M-Y') }} - {{ @$profile->rm_current_position }} ({{ $profile->rm_branch_id }})</span>
                                            </span>
                                            @if(count($orgChart))
                                            @foreach($orgChart::orgChart($profile->rm_rep_id)->get() as $row)
                                            @if($row->rm_current_position == 'EPC')
                                            <ul>
                                                <li>
                                                    <span>
                                                        <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                                        <span class="readmore type_2 text_tree">{{ $row->rm_rep_id }} - {{ $row->rm_name }} - {{ Carbon::parse($row->rm_join_date)->format('d-M-Y') }} - {{ $row->rm_current_position }} ({{ $row->rm_branch_id }})</span>
                                                    </span>
                                                </li>
                                            </ul>
                                            @endif
                                            @endforeach
                                            @endif
                                        </li>
                                    </ul>
                                </li>
                                @else
                                <li>
                                    <span>
                                        <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                        <span class="readmore type_2 text_tree">{{ @$profile->rm_rep_id }} - {{ @$profile->rm_name }} - {{ Carbon::parse($profile->rm_join_date)->format('d-M-Y') }} - {{ @$profile->rm_current_position }} ({{ $profile->rm_branch_id }})</span>
                                    </span>
                                    @if(count($orgChart))
                                    @foreach($orgChart::orgChart($profile->rm_rep_id)->get() as $row)
                                    @if($row->rm_current_position == 'EPC')
                                    <ul>
                                        <li>
                                            <span>
                                                <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                                <span class="readmore type_2 text_tree">{{ $row->rm_rep_id }} - {{ $row->rm_name }} - {{ Carbon::parse($row->rm_join_date)->format('d-M-Y') }} - {{ $row->rm_current_position }} ({{ $row->rm_branch_id }})</span>
                                            </span>
                                        </li>
                                    </ul>
                                    @endif
                                    @endforeach
                                    @endif
                                </li>
                                @endif
                                @elseif($profile->rm_current_position == 'EPC')
                                @if($epd = $orgChart::where('rm_rep_id', $profile->rm_manager_id)->where('rm_current_position', 'EPD')->first())
                                <?php $gepd = ($epd) ? $orgChart::where('rm_rep_id', $epd->rm_manager_id)->where('rm_current_position', 'GEPD')->first() : null; ?>
                                @if($gepd)
                                <li>
                                    <span>
                                        <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                        <span class="readmore type_2 text_tree">{{ $gepd->rm_rep_id }} - {{ $gepd->rm_name }} - {{ Carbon::parse($row->rm_join_date)->format('d-M-Y') }} - {{ $gepd->rm_current_position }} ({{ $gepd->rm_branch_id }})</span>
                                    </span>

                                    <ul>
                                     <li>
                                        <span>
                                            <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                            <span class="readmore type_2 text_tree">{{ $epd->rm_rep_id }} - {{ $epd->rm_name }} - {{ Carbon::parse($epd->rm_join_date)->format('d-M-Y') }} - {{ $epd->rm_current_position }} ({{ $epd->rm_branch_id }})</span>
                                        </span>
                                        <ul>
                                            <li>
                                                <span>
                                                    <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                                    <span class="readmore type_2 text_tree">{{ $profile->rm_rep_id }} - {{ $profile->rm_name }} - {{ Carbon::parse($profile->rm_join_date)->format('d-M-Y') }} - {{ $profile->rm_current_position }} ({{ $profile->rm_branch_id }})</span>
                                                </span>
                                            </li>
                                        </ul>
                                    </li>
                                </li>
                                @else
                                <li>
                                    <span>
                                        <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                        <span class="readmore type_2 text_tree">{{ $epd->rm_rep_id }} - {{ $epd->rm_name }} - {{ Carbon::parse($row->rm_join_date)->format('d-M-Y') }} - {{ $epd->rm_current_position }} ({{ $epd->rm_branch_id }})</span>
                                    </span>
                                    <ul>
                                       <li>
                                         <span>
                                            <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                            <span class="readmore type_2 text_tree">{{ $profile->rm_rep_id }} - {{ $profile->rm_name }} - {{ Carbon::parse($profile->rm_join_date)->format('d-M-Y') }} - {{ $profile->rm_current_position }} ({{ $profile->rm_branch_id }})</span>
                                        </span>
                                    </li>
                                </li>
                                @endif
                                @elseif($gepd = $orgChart::where('rm_rep_id', $profile->rm_manager_id)->where('rm_current_position', 'GEPD')->first())
                                <li>
                                    <span>
                                        <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                        <span class="readmore type_2 text_tree">{{ $gepd->rm_rep_id }} - {{ $gepd->rm_name }} - {{ Carbon::parse($row->rm_join_date)->format('d-M-Y') }} - {{ $gepd->rm_current_position }} ({{ $gepd->rm_branch_id }})</span>
                                    </span>
                                    <ul>
                                       <li>
                                         <span>
                                            <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                            <span class="readmore type_2 text_tree">{{ $profile->rm_rep_id }} - {{ $profile->rm_name }} - {{ Carbon::parse($profile->rm_join_date)->format('d-M-Y') }} - {{ $profile->rm_current_position }} ({{ $profile->rm_branch_id }})</span>
                                        </span>
                                    </li>
                                </li>
                                @else
                                <li>
                                 <span>
                                    <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                    <span class="readmore type_2 text_tree">{{ $profile->rm_rep_id }} - {{ $profile->rm_name }} - {{ Carbon::parse($profile->rm_join_date)->format('d-M-Y') }} - {{ $profile->rm_current_position }} ({{ $profile->rm_branch_id }})</span>
                                </span>
                            </li>
                            @endif

                        </ul>
                    </li>
                    @endif


                </li>

            </ul>
        </div>
    </div>
</div>
<div>
    <div class="boxTableAccount">

      <div class="tree well" style="width:670px !important;">
        <ul>
            <li>
                <span>
                    <span class="boxImage"><img src="{{ asset('images') }}/material/org_maps.png"/></span>
                    <span class="readmore type_2 text_tree">Branch {{ $branchId }}</span>
                </span>

                <ul>
                    <li>

                      <span>
                        <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                        <span class="readmore type_2 text_tree">{{ @$recruiter->rm_rep_id }} - {{ @$recruiter->rm_name }} - {{ @Carbon::parse($recruiter->rm_join_date)->format('d-M-Y') }} - {{ @$recruiter->rm_current_position }} ({{ @$recruiter->rm_branch_id }})</span>
                    </span>
                    <ul>
                        <li>
                            @if($recruits)
                            <span>
                                <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                <span class="readmore type_2 text_tree">{{ @$profile->rm_rep_id }} - {{ @$profile->rm_name }} - {{ @Carbon::parse($row->rm_join_date)->format('d-M-Y') }} - {{ @$profile->rm_current_position }} ({{ @$profile->rm_branch_id }})</span>
                            </span>
                            <ul>
                             @foreach($recruits as $row)
                             <li>
                                <span>
                                    <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                    <span class="readmore type_2 text_tree">{{ $row->rm_rep_id }} - {{ $row->rm_name }} - {{ Carbon::parse($row->rm_join_date)->format('d-M-Y') }} - {{ $row->rm_current_position }} ({{ $row->rm_branch_id }})</span>
                                </span>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                @else
                <span>
                    <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                    <span class="readmore type_2 text_tree">{{ $recruiter->rm_rep_id }} - {{ $recruiter->rm_name }} - {{ Carbon::parse($recruiter->rm_join_date)->format('d-M-Y') }} - {{ $recruiter->rm_current_position }} ({{ $recruiter->rm_branch_id }})</span>
                </span>
                <ul>

                    <li>
                        <span>
                            <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                            <span class="readmore type_2 text_tree">{{ $profile->rm_rep_id }} - {{ $profile->rm_name }} - {{ Carbon::parse($profile->rm_join_date)->format('d-M-Y') }} - {{ $profile->rm_current_position }} ({{ $profile->rm_branch_id }})</span>
                        </span>
                    </li>
                </ul>
                @endif
            </li>
        </ul>
    </div>
</div>
</div>
<div>
    <div class="boxTableAccount">

        <div class="tree well" style="width:670px !important;">
            <ul>
                <li>
                    <span>
                        <span class="boxImage"><img src="{{ asset('images') }}/material/org_maps.png"/></span>
                        <span class="readmore type_2 text_tree">Branch {{ $branchId }}</span>
                    </span>

                    <ul>
                        <li>

                          <span>
                            <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                            <span class="readmore type_2 text_tree">{{ @$octr->rm_rep_id }} - {{ @$octr->rm_name }} - {{ @Carbon::parse($octr->rm_join_date)->format('d-M-Y') }} - {{ @$octr->rm_current_position }} ({{ @$octr->rm_branch_id }})</span>
                        </span>
                        @if(count($octs))
                        <ul>
                            <li>
                                <span>
                                    <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                    <span class="readmore type_2 text_tree">{{ $profile->rm_rep_id }} - {{ @$profile->rm_name }} - {{ @Carbon::parse($row->rm_join_date)->format('d-M-Y') }} - {{ @$profile->rm_current_position }} ({{ @$profile->rm_branch_id }})</span>
                                </span>
                                <ul>
                                 @foreach($octs as $row)
                                 <li>
                                    <span>
                                        <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                        <span class="readmore type_2 text_tree">{{ $row->ro_id }} - {{ $row->ro_nama_peserta }} - ({{ $row->ro_branch_id }})</span>
                                    </span>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                    @else
                    <ul>

                        <li>
                            <span>
                                <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                <span class="readmore type_2 text_tree">{{ $profile->rm_rep_id }} - {{ $profile->rm_name }} - {{ Carbon::parse($profile->rm_join_date)->format('d-M-Y') }} - {{ $profile->rm_current_position }} ({{ $profile->rm_branch_id }})</span>
                            </span>
                            <ul>
                                <li>
                                   <span class="boxImage"><img src="{{ asset('images') }}/material/org_user.png"/></span>
                                   <span class="readmore type_2 text_tree">No Data OCT</span>
                               </li>
                           </ul>
                       </li>
                   </ul>
                   @endif
               </li>
           </ul>

       </li>
   </ul>
</div>
</div>
</div>
</div>
</div>
<!--TAB-->

</form>

</div>
@endif
<div style="border-bottom:1px solid #ddd;margin-top:60px;"></div>
@include('partial.footer-account')
@endsection