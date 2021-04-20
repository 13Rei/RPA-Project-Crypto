@extends('layouts.app')

@include('inc.navbar')
<br>
<br>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Currencies</div>
                <div class="card-body">
                    <ul class="list-group">   
                        @if ($selected)    
                            @foreach ($data as $val)
                                <li
                                    @foreach ($selected as $item)
                                        @if ($val['id'] == $item['currency_id'])
                                            class="list-group-item d-flex justify-content-between align-items-center active"
                                        @endif
                                    @endforeach
                                class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="/currency/{{$val['id']}}">
                                    {{$val['name']}}
                                </a>
                                </li>
                            @endforeach
                        @else
                            @foreach ($data as $val)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="/currency/{{$val['id']}}">
                                        {{$val['name']}}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection