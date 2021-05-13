

@extends('layout')

@section('title', "Agendeyson - Home")
    
@section('content')
<div class="row justify-content-center">
    <div class="col col-sm-3">
        <form action="{{route('contact.store')}}" method="post">
            @csrf
            <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('name') }}">
            @if($errors->has('name'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </div>
                @endif
            </div>
            <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Numero de telefone</label>
            <input type="text" name="phone" class="form-control" aria-describedby="emailHelp" value="{{ old('phone') }}" maxlength="15" id="phone_with_ddd">
            @if($errors->has('phone'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Descrição</label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" maxlength="250">{{ old('description') }}</textarea>
              </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            
        </form>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col col-6">
        <table class="table table-striped">
            <div class="row justify-content-center">
            <div class="col col-sm-3">
                <form method="GET" action="{{route('home')}}">
                    <label for="exampleInputEmail1" class="form-label">Pesquisar</label>
                    <input type="text" class="form-control" name="search">
                    <br/>
                    <input type="submit" class="btn btn-primary" value="enviar"> - <a href="{{route('home')}}">Limpar</a>
                </form>
            </div>
            </div>
            @if(count($data) == 0)
            <br/>
            <div class="alert alert-warning" role="alert">
                Nada Encontrado
              </div>
            @endif
            <thead>
                <br/>
                <tr>
                  <th scope="col">
                      @if($order == "asc")
                        <a href="{{url('?order=desc')}}" style="text-decoration: none; color: #212529;">
                            ▼ Nome
                        </a>
                        @else
                        <a href="{{url('?order=asc')}}" style="text-decoration: none; color: #212529;">
                            ▲ Nome
                        </a>
                        @endif
                    </th>
                  <th scope="col">Telefone</th>
                  <th scope="col">Descrição</th>
                  <th scope="col">Ações</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $contact)
                <tr>
                    <td>{{$contact->name}}</td>
                    <td>{{$contact->phone}}</td>
                    <td>{{$contact->description}}</td>       
                    <td>
                        <a href="{{route('contact.edit', ['contact' => $contact->id])}}" class="btn btn-sm btn-primary">✏️</a>
                        <form class="d-inline" action="{{route('contact.destroy', ['contact' => $contact->id])}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button onclick="return confirm('Deseja mesmo excluir?');" class="btn btn-sm btn-danger">🗑️</button>
                        </form>
                        <a href="https://api.whatsapp.com/send?phone=55{{$contact->phone}}" target="_blank"><img class="btn btn-success" width="43" src="https://imagepng.org/wp-content/uploads/2017/08/WhatsApp-icone.png" alt="Whatsapp"></a>
                    </td>   
                </tr>
                @endforeach
              </tbody>
          </table>
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