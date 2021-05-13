

@extends('layout')

@section('title', "Agendeyson - Edição")
    
@section('content')
<div class="row justify-content-center">
    <div class="col col-sm-3">
        <form action="{{route('contact.update', ['contact'=>$contact->id])}}" method="POST">
            @method('PUT')
            @csrf
            <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nome</label>
            <input type="text" name="name" value="{{$contact->name}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
            @if($errors->has('name'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </div>
                @endif
            </div>
            <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Numero de telefone</label>
            <input type="text" name="phone" class="form-control" aria-describedby="emailHelp" value="{{$contact->phone}}" maxlength="15" id="phone_with_ddd">
            @if($errors->has('phone'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Descrição</label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" maxlength="250">{{$contact->description}}</textarea>
                @if($errors->has('description'))
                <div class="alert alert-danger" role="alert">
                    <strong>{{ $errors->first('description') }}</strong>
                </div>
            @endif
              </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            
        </form>
    </div>
</div>
    
<script src="{{asset('/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('/js/jquery.mask.js')}}"></script>
<script>
    $(document).ready(function(){
            $('#date').mask('11/11/1111');
            $('time').mask('00:00:00');
            $('date_time').mask('99/99/9999 00:00:00');
            $('#cep').mask('99999-999');
            $('#phone').mask('9999-9999');
            $('#phone_with_ddd').mask('(99) 99999-9999');
            $('#phone_us').mask('(999) 999-9999');
            $('mixed').mask('AAA 000-S0S');
            $('#money').mask('000.000.000.000.000,00', {reverse: true});
});
</script>

@endsection