<?php

namespace App\Livewire;

use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class EditarVacante extends Component
{

    public $vacante_id;
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimoDia;
    public $descripcion;
    public $imagen;
    public $imagenNueva;

    use WithFileUploads;

    //reglas de validacion con livewire
    protected $rules=[

        'titulo'=>'required|string',
        'salario'=>'required',
        'categoria'=>'required',
        'empresa'=>'required',
        'ultimoDia'=>'required',
        'descripcion'=>'required',
        'imagenNueva'=>'nullable|image',

    ];


    //con este metodo de livewire podemos hacer que el formulario de editar vacante aparezca con la informacion que se va a editar,osea,apenas se le de a una vacante editar este formulario aparece con la informacion llena para despues poder editar, a esta funcion se le pasa la instancia de la vacante que tiene el componente de livewire en la vista de edit.blade.php
    public function mount(Vacante $vacante){

        $this->vacante_id=$vacante->id;
        $this->titulo=$vacante->titulo;
        $this->salario=$vacante->salario_id;#este salario_id es el nombre del campo de la bd,igual el de titulo
        $this->categoria=$vacante->categoria_id;
        $this->empresa=$vacante->empresa;
        #para formatear bien la fecha igual como en la bd usamos la dependecia carbon
        $this->ultimoDia=Carbon::parse($vacante->ultimoDia)->format('Y-m-d');
        $this->descripcion=$vacante->descripcion;
        $this->imagen=$vacante->imagen;

    }


    public function editarVacante(){

        $datos=$this->validate();

        //revisar si hay una nueva imagen
        if($this->imagenNueva){
            $imagen=$this->imagenNueva->store('public/vacantes');

            #aqui el srt_replace() quita el string 'public/vacantes' y lo reemplaza por string vacio "", esto es para que la ruta de la imagen que se va a guardar en la bd solo lleve como tal el nombre de la imagen y no esa parte de la ruta
            $datos['imagen']=str_replace('public/vacantes',"",$imagen);
        }


        //Encontrar la vacante a editar
        $vacante=Vacante::find($this->vacante_id);

        //Asignar valores
        $vacante->titulo=$datos['titulo'];
        $vacante->salario_id=$datos['salario'];
        $vacante->categoria_id=$datos['categoria'];
        $vacante->empresa=$datos['empresa'];
        $vacante->ultimoDia=$datos['ultimoDia'];
        $vacante->descripcion=$datos['descripcion'];
        
        #aqui si hay una imagen nueva se guarda en $vacante->imagen,pero si no hay se deja la que tiene,eso es lo que indica el operador ??, es como el operador terciario o el else if.
        $vacante->imagen=$datos['imagen'] ?? $vacante->imagen;

        //guardar la vacante
        $vacante->save();

        //redireccionar
        session()->flash('mensaje','La vacante se actualizó correctamente');

        return redirect()->route('vacantes.index');
    }

    public function render()
    {

         //consultar BD
         $salarios=Salario::all();
         $categorias=Categoria::all();


        return view('livewire.editar-vacante',[

            'salarios'=>$salarios,
            'categorias'=>$categorias,
        ]);
    }
}
