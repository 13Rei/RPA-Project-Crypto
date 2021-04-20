@extends('layouts.app')

@include('inc.navbar')
<br>
<br>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$currency['name']}}
                    @if ($selected->isEmpty())
                        <a href="/currency/{{$currency['id']}}/follow" style="border: 2px solid #FF7F00; color: #444444" class="btn btn-warning float-right">Follow</a>
                    @else
                        @foreach ($selected as $item)
                            @if ($currency['id'] != $item['currency_id'])
                                <a href="/currency/{{$currency['id']}}/follow" style="border: 2px solid #FF7F00; color: #444444" class="btn btn-warning float-right">Follow</a>
                                @break
                            @else
                                <a href="/currency/{{$currency['id']}}/unfollow" style="border: 2px solid #FF7F00; color: #444444" class="btn btn-warning float-right">Unfollow</a>
                                @break
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection