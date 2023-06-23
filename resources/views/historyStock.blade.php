{{-- PLANTILLA QUE UTILIZA ESTA PÁGINA --}}
@extends('layout', ['routeActive' => 'hstocks'])

{{-- TITULO --}}
@section('title')
    Stock History
@endsection

{{-- ESTILOS EXCLUSIVOS PARA LA PAGINA DEL HISTORIAL DE STOCKS --}}
@section('styles')
    <style>
        body{ padding-top:5rem; }
    </style>
@endsection

{{-- CONTENIDO DE LA PAGINA DEL HISTORIAL DE STOCKS --}}
@section('content')
    {{-- MOSTRAR EN UNA TABLA LAS FACTURAS DE COMPRA DE STOCK --}}
    <section class="container">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Receipt ID</th>
                        <th>Ingredient</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($receipts as $receipt)
                        @foreach($receipt->stockBuyed as $stock)
                        <tr>
                            <td>{{$stock->stock_receipt_id}}</td>
                            <td>{{$stock->ingredient->ingredient_key}}</td>
                            <td>{{$stock->stock_amount}}</td>
                            <td>{{$receipt->created_at}}</td>
                        </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>  
        </div>        
    </section>
@endsection
