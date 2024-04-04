@extends('dashboard.layouts.main')
@section('container')
<div class="row justify-content-center">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Jumlah Uang</div>
                                                @php
                                                    $totalPrice = 0;
                                                @endphp
                                            @foreach($transaksis as $transaksi)
                                            @php
                                            $totalPrice += $transaksi->jml_harga; 
                                        @endphp
                                            @endforeach
                                            <p>
                                            Rp.{{ number_format($totalPrice) }}
                                            </p> 
                                        </div>
                                        <div class="col-auto">
                                        <i class="bi bi-cash-coin fa-2x text-gray-300"></i>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                               Jumlah Produk</div>
                                            {{$produks}} Jenis
                                            </div>
                                        <div class="col-auto">
                                           
    
                                            <i class="bi bi-clipboard-data fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Produk Teralaris</div>
                                                @if($produkterlaris!=null)
                                                <strong> {{$produkterlaris->nama_produk}}</strong>  terjual :  {{$produkterlaris->total_beli}} Pc
                                                @else
                                              <p>0</p>

                                          @endif    
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        
                    </div

@endSection