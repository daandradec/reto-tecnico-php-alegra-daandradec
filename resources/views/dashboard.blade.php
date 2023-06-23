{{-- PLANTILLA QUE UTILIZA ESTA PÁGINA --}}
@extends('layout', ['routeActive' => 'dashboard', 'react' => true])

{{-- TITULO --}}
@section('title')
    Dashboard
@endsection

{{-- ESTILOS EXCLUSIVOS PARA LA PAGINA DEL DASHBOARD --}}
@section('styles')
    <style>
        body{ padding-top:5rem; }

        #toast-container > .toast { width: 100%; }

        .orders{max-height:800px; width:70%;margin:0 auto;display: flex;flex-direction: column;gap:12px;overflow-y: auto;}
        .order-card{border-radius: 6px;width:100%;border:1px solid rgb(223, 223, 223);display:flex;padding:6px;}
        .order-text{padding: 0 30px;min-width: 201px;}
        .order-button{flex-grow: 1;background:#02cd11;color:white;}

        .mini-table{width:80%;margin:0 auto;font-size:16px;text-align: center;}
        .mini-cell{display:flex;justify-content: center;margin:16px 0;vertical-align: middle;align-items: center;}
        .mini-cell div:first-child{width: 40%;}
        .mini-cell div:nth-child(2){width: 60%;}
        .ingredient-active{color: #02cd11;}
        .ingredient-unactive{color: #cd0202;}

        .hud-wrapper{min-height:400px;}
        .hud-zone{width:85%;margin: 0 auto;}
        .hud-waiting{background:rgb(238, 237, 237);}
        .hud-start{background:#02cd11;color:white;}   
        .hud-buying{background:rgb(215, 215, 1);color:white;}
        .hud-cooking{background:rgb(120, 87, 17);color:white;}
        .hud-start-btn-start{display:block; background:#198754;color: white;border:none;padding:6px 20px;font-size:21px;}     
        .hud-start-btn-cancel{display:block; background:#cd0202;color:white;border:none;padding:2px 6px;font-size:13px;font-weight: 500;}
        .hud-zone > *{height:100%;display: flex;justify-content: center;align-items: center;}
        .loading-circles{display: flex;justify-content: center;align-items: center;}
        .loading-circles > span{width:80px;}
        .circle{display: inline-block;;width:14px;height:14px;background:gray;border-radius: 50%;margin:0 5px;}
        .circle-anim{visibility: hidden;animation:circle-load-1 linear 3s infinite;animation-fill-mode: none;}
        .circle-anim-2{visibility: hidden;animation:circle-load-2 linear 3s infinite;animation-fill-mode: none;}
        .bg-green-soft{background:rgb(223, 249, 223);}
        @keyframes circle-load-1{
            from {visibility:hidden;}
            33% {visibility:hidden;}
            to {visibility:visible;}
        }
        @keyframes circle-load-2{
            from {visibility:hidden;}
            66% {visibility:hidden;}
            to {visibility:visible;}
        }        

        @media(max-width:1280px){.orders{width:90%;}}
        @media(max-width:991px){.hud-zone{width:100%;}}
        @media(max-width:720px){.mini-table{width: 90%;}.orders{width:100%;}}
    </style>
@endsection

{{-- CONTENIDO DE LA PAGINA DEL DASHBOARD --}}
@section('content')
    <div id="toast-container" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11;">
    </div>
@endsection