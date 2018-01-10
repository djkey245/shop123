@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 panel-bg">
            <div class="panel panel-default">
                <div class="panel-heading">Сбросить пароль</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="text-email">E-Mail</label>

                            <div class="input-email">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="input-email">
                                <button type="submit" class="btn btn-primary">
                                    Сбросить
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
