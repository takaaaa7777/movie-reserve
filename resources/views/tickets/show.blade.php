@extends('layouts.app')

@section('content')
    
    {{-- ナビゲーションタブ表示 --}}
    @include('commons.nav_tabs')
    
    <table class="table" style="border-bottom:dotted; border-width:1px ;">
        <thead>
            <tr>
                <th style="border:none">通常料金</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <td style="border-top:dotted; border-width:1px ;">{{ $ticket->ticket_name }}</td>
                    <td style="border-top:dotted; border-width:1px ;" align="center">&yen;{{ number_format($ticket->ticket_price) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection