@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
       
            <div class="card">
                <div class="card-header">{{ __('Cartorios') }}</div>
                <div class="card-body">


<a href="{{route('cartorios.create')}}"><button class="btn btn-info">Adicionar Cartorio</button></a>
<button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Importar XML</button>
<br><br>


    <table class="table table-striped table-sm">
        <thead class="thead">
            <tr>
            <th scope="col">Nome</th>
            <th scope="col">{{utf8_encode('Razão')}}</th>
            <th scope="col">Documento</th>
            <th scope="col">CEP</th>
            <th scope="col">Endereco</th>
            <th scope="col">Bairro</th>
            <th scope="col">Cidade</th>
            <th scope="col">UF</th>
            <th scope="col">Telefone</th>
            <th scope="col">Email</th>
            <th scope="col">{{utf8_encode('Tabelião')}}</th>
            <th scope="col">Ativo</th>
            <th scope="col"></th>
            <th scope="col"></th>
          
            </tr>
        </thead>
        <tbody>
       
@foreach($cartorio as $cartorio1) 
            <tr style="font-size: 0.6rem;">
            <td>{{$cartorio1->nome}}</td>
            <td>{{$cartorio1->razao}}</td>
            <td>{{$cartorio1->documento}}</td>
            <td>{{$cartorio1->cep}}</td>
            <td>{{$cartorio1->endereco}}</td>
            <td>{{$cartorio1->bairro}}</td>
            <td>{{$cartorio1->cidade}}</td>
            <td>{{$cartorio1->uf}}</td>
            <td>{{$cartorio1->telefone}}</td>
            <td>{{$cartorio1->email}}</td>
            <td>{{$cartorio1->tabeliao}}</td>
            <td>
            @if($cartorio1->ativo=='0')
            Nao
            @elseif($cartorio1->ativo=='1')
            Sim
            @endif      
             </td>
            <td>
            <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{utf8_encode('Ações')}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('cartorios.edit', $cartorio1->id)}}">Editar</a>
                        <a class="dropdown-item"data-toggle="modal" data-target="#modalemail{{$cartorio1->id}}" href="#">Adicionar Email <br>e Telefone</a>
                    </div>
                    </div>
           </td> <td>
            <form action="{{ route('cartorios.destroy', $cartorio1->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esse cartorio?')" type="submit"><i class="fa fa-trash" ></i></button>
                </form>
              
            
            
            </td>
            </tr>
            @endforeach

        </tbody>
    </table>

 

                </div>
          </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Importar XML</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 
      <form action="{{ route('cartorios_xml')}}" enctype="multipart/form-data" method="post">
                  @csrf
                  <div class="form-group">
                      <input type="file" name="xml" accept=".xml" required >   </div>
                
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                  <button type="submit" class="btn btn-primary">Importar</button>
                </form>
                </div>     
    </div>
  </div>
</div>




@foreach($cartorio as $cartori)

<div class="modal fade" id="modalemail{{$cartori->id}}" tabindex="-1" role="dialog" aria-labelledby="modalemail{{$cartori->id}}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar Telefone e Email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 
      <form action="{{ route('cartorios_email',$cartori->id)}}" enctype="multipart/form-data" method="post">
                  @csrf
                  <input type="hidden" value="{{$cartori->id}}">
                  <div class="form-group">
                        <label for="inputAddress">Email</label>
                        <input type="email" name="email" class="form-control" id="inputAddress" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Telefone</label>
                        <input type="text" name="telefone" class="form-control" id="inputAddress" placeholder="Telefone">
                    </div>
                
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                  <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
                </div>     
    </div>
  </div>
</div>
@endforeach







@endsection
