<?php

namespace App\Livewire;

use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use Livewire\WithFileUploads;

class CrearVacante extends Component
{

    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimoDia;
    public $descripcion;
    public $imagen;

    //se importa esta clase para habilitar la carga de archivos con livewire
    use WithFileUploads;

    //reglas de validacion con livewire
    protected $rules=[

        'titulo'=>'required|string',
        'salario'=>'required',
        'categoria'=>'required',
        'empresa'=>'required',
        'ultimoDia'=>'required',
        'descripcion'=>'required',
        'imagen'=>'required|image',

    ];



    //funcion que valida las reglas del formulario para poder enviar informacion
    public function crearVacante(){

        $datos=$this->validate();

        //Almacenar la imagen
        $imagen=$this->imagen->store('public/vacantes');
        $datos['imagen']=str_replace('public/vacantes/',"",$imagen);
        // dd($nombreImagen);

        //Crear la vacante, aqui ponemos los nombres que viene del crear-vacante.blade en su wire:model="salario", en vez de salario_id.
        Vacante::create([

            'titulo'=>$datos['titulo'],
            'salario_id'=>$datos['salario'],
            'categoria_id'=>$datos['categoria'],
            'empresa'=>$datos['empresa'],
            'ultimoDia'=>$datos['ultimoDia'],
            'descripcion'=>$datos['descripcion'],
            'imagen'=>$datos['imagen'],
            'user_id'=>auth()->user()->id,
        ]);


        //Crear un mensaje

        session()->flash('mensaje','La vacante se publicó correctamente');

        //Redireccionar al usuario al dashboard
        return redirect()->route('vacantes.index');
    }


    public function render()
    {

        //consultar BD
        $salarios=Salario::all();
        $categorias=Categoria::all();



        return view('livewire.crear-vacante',[

            'salarios'=>$salarios,
            'categorias'=>$categorias,
        ]);
    }
}
