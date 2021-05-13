@extends('layout')

@section('title', "Agendeyson - Registro")
    
@section('content')
    <div class="row justify-content-center">
        <div class="col col-sm-3">
            <form action="{{route('register.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="name" name="name" class="form-control" aria-describedby="emailHelp" value="{{ old('name') }}">
                    @if($errors->has('name'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('email') }}">
                    @if($errors->has('email'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </div>
                @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Senha</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirmar Senha</label>
                    <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1">
                    @if($errors->has('password'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </div>
                @endif
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                
            </form>
        </div>
    <div>
    

@endsection