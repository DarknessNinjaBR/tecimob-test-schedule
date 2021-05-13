@extends('layout')

@section('title', "Agendeyson - Login")
    
@section('content')
    <div class="row justify-content-center">
        <div class="col col-sm-3">
            <form action="{{route('login.auth')}}" method="post">
                @csrf
                <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </div>
                @endif
                </div>
                <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                @if($errors->has('password'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </div>
                @endif
                </div>
                <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Lembrar senha</label>
                </div>
                <div class="mb-3">
                <p class="my-0">
                    <a href="{{route('register')}}">
                        Não tem conta?<br/> Registre aqui!
                    </a>
                </p>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                
            </form>
        </div>
    <div>
    

@endsection