<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class HomeVacantes extends Component
{

    public $termino;
    public $categoria;
    public $salario;

    //listener
    protected $listeners=['terminosBusqueda'=>'buscar'];

    public function buscar($termino,$categoria,$salario){

        $this->termino=$termino;
        $this->categoria=$categoria;
        $this->salario=$salario;

    }


    public function render()
    {

        // $vacantes=Vacante::all();

        //el when se ejecuta solamente si las variables tienen algo,si estan vacias no se ejecutan, esto nos sirve porque en el buscador en el primer instante aparece vacio.En el where ponemos lo que va a alamcenar la variable, en este caso la variable $termino va a almacenar el titulo de la vacante.
        $vacantes=Vacante::when($this->termino,function($query){

            $query->where('titulo', 'like', '%' . $this->termino . '%');
        })
        ->when($this->termino,function($query){

            $query->orWhere('empresa', 'like', '%' . $this->termino . '%');
        })
        ->when($this->categoria,function($query){

            $query->where('categoria_id',$this->categoria);
        })
        ->when($this->salario,function($query){

            $query->where('salario_id',$this->salario);
        })
        ->paginate(20);


        return view('livewire.home-vacantes',[

            'vacantes'=>$vacantes
        ]);
    }
}
