<?php

namespace App\Http\Controllers;
use App\Cartorios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CartoriosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartorio= Cartorios::orderBy('nome','ASC')->get();

         return view('cartorios/index',compact('cartorio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cartorios/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cartorio = new Cartorios([
            'nome' => $request->get('nome'),
            'razao' => $request->get('razao'),
            'documento' => $request->get('documento'),
            'cep' => $request->get('cep'),
            'endereco' => $request->get('endereco'),
            'bairro' => $request->get('bairro'),
            'cidade' => $request->get('cidade'),
            'uf' => $request->get('uf'),
            'telefone' => $request->get('telefone'),
            'email' => $request->get('email'),
            'tabeliao' => $request->get('tabeliao'),
            'ativo' => $request->get('ativo'),
        ]);
        $cartorio->save();
        return redirect('/cartorios')->with('success', 'cartorio savo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cartorios  $cartorios
     * @return \Illuminate\Http\Response
     */
    public function show(Cartorios $cartorios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cartorios  $cartorios
     * @return \Illuminate\Http\Response
     */
    public function edit(Cartorios $cartorios,$id)
    {
        $cartorio = Cartorios::find($id);
        return view('cartorios/edit',compact('cartorio'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cartorios  $cartorios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cartorios $cartorios,$id)
    {
        $cartorio = Cartorios::find($id);
        $cartorio->nome  =  $request->get('nome');
        $cartorio->razao  =  $request->get('razao');
        $cartorio->documento  =  $request->get('documento');
        $cartorio->cep =  $request->get('cep');
        $cartorio->endereco  =  $request->get('endereco');
        $cartorio->bairro  =  $request->get('bairro');
        $cartorio->cidade  =  $request->get('cidade');
        $cartorio->uf  =  $request->get('uf');
        $cartorio->telefone  =  $request->get('telefone');
        $cartorio->email  =  $request->get('email');
        $cartorio->tabeliao  =  $request->get('tabeliao');
        $cartorio->ativo  =  $request->get('ativo');
        $cartorio->save();
        return redirect('/cartorios')->with('success', 'cartorio atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cartorios  $cartorios
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Cartorios $cartorios)
    {
        $cartorio = Cartorios::find($id);
        $cartorio->delete();
        return redirect('/cartorios')->with('success', 'cartorio atualizado!');
    }


    public function xml(Request $request){
        $name = uniqid(date('HisYmd'));
        $name = $name.'.xml';
        $file = $request->xml->storeAs('xmls',$name);

        $xml = simplexml_load_file('storage/'.$file);
         
         foreach($xml as $cartorio){
       
            $verifica = Cartorios::where('documento',$cartorio->documento)->first();

            if(is_array($verifica)){
         $cartorio = Cartorios::find($verifica->id);
        $cartorio = $cartorio->nome;
        $cartorio->razao  =  $cartorio->razao;
        $cartorio->documento  = $cartorio->documento;
        $cartorio->cep =  $cartorio->cep;
        $cartorio->endereco  =  $cartorio->endereco;
        $cartorio->bairro  =  $cartorio->bairro;
        $cartorio->cidade  =  $cartorio->cidade;
        $cartorio->uf  =  $cartorio->uf;
        $cartorio->telefone  =  $cartorio->telefone;
        $cartorio->email  =  $cartorio->email;
        $cartorio->tabeliao  =  $cartorio->tabeliao;
        $cartorio->ativo  =  $cartorio->ativo;
        $cartorio->save();

            }else{


            $cartorio = new Cartorios([
                'nome' => $cartorio->nome,
                'razao' => $cartorio->razao,
                'documento' => $cartorio->documento,
                'cep' => $cartorio->cep,
                'endereco' => $cartorio->endereco,
                'bairro' => $cartorio->bairro,
                'cidade' => $cartorio->cidade,
                'uf' => $cartorio->uf,
                'telefone' => $cartorio->telefone,
                'email' =>$cartorio->email,
                'tabeliao' => $cartorio->tabeliao,
                'ativo' => $cartorio->ativo,
            ]);
            $cartorio->save();
            }
         }   

   return redirect('/cartorios')->with('success', 'cartorio atualizado!');
       
    }


    public function email(Request $request,$id)
    {
        $cartorio = Cartorios::find($request->id);
     
   
        $cartorio->telefone  =  $request->get('telefone');
        $cartorio->email  =  $request->get('email');
        $cartorio->save();
        return redirect('/cartorios')->with('success', 'cartorio atualizado!');
    }
}
