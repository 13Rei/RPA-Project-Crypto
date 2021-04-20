@extends('layouts.app')

@include('inc.navbar')
<br>
<br>
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit user info') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('user.update')}}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="currencies" class="col-md-4 col-form-label text-md-right">{{ __('Default Currency') }}</label>

                            <div class="col-md-6">
                                <select class="form-control form-select" aria-label="Default select example" name="currency" id="currency">
                                    @foreach ($fiat as $val)
                                        <option value="{{$val['id']}}"
                                        @if ($val['id'] == $user['fiat_id'])
                                            selected
                                        @endif
                                        >{{$val['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="cryptocurrencies" class="col-md-4 col-form-label text-md-right">{{ __('Crypto Currencies') }}</label>
                            <div class="col-md-6">
                                <select class="form-control form-select" multiple size="{{count($selectedCrypto)}}" aria-label="Default select example" name="cryptocurrencies[]" id="cryptocurrencies">
                                    @foreach ($crypto as $val)
                                        @foreach ($selectedCrypto as $item)
                                            @if ($val['id'] == $item['currency_id'])
                                                <option value="{{$val['id']}}"
                                                selected
                                                {{-- @if (in_array($val['name'], $selectedCrypto))
                                                selected
                                                @endif --}}
                                                >{{$val['name']}}</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                                <a href="{{route('user.deletecurrencies')}}" style="margin-top: 18px" class="col-md-4 offset-md-5 btn btn-danger">
                                    {{__('Remove All Currencies')}}
                                </a>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-md-4 offset-md-4">
                                <button class="btn btn-success">
                                    {{__('Change Password')}}
                                </button>
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <div class="col-md-4 offset-md-4">
                                <button class="btn btn-success">
                                    {{__('Change Password')}}
                                </button>
                            </div>
                        </div> --}}

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('select[id^="cryptocurrencies"]').mousedown(function(e){
        e.preventDefault();
        
        var select = this;
        var scroll = select .scrollTop;
    
        e.target.selected = !e.target.selected;
    
        setTimeout(function(){select.scrollTop = scroll;}, 0);
    
        $(select ).focus();

    }).mousemove(function(e){e.preventDefault()});
    </script>
@endsection
