<?php

namespace App\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;

class FiltrarVacantes extends Component
{
    public $termino;
    public $categoria;
    public $salario;


    //esta funcion lo que hace es comunicarse con el componente padre el cual es HomeVacantes, porque en la vista  del componente home-vacantes se esta llamando al componente filtrar-vacantes,entonces el padre es HomeVacantes.Entonces aqui en filtrar vacantes usamos el metodo dispatch() para poder pasar datos desde el hijo hacia el padre.La funcion a la que se le pasan los datos en el padre se llama buscar, el dispatch() emitira datos hacia esa funcion pero se debe tener un evento listener que este escuchando cuando se pasen esos datos, entonces el dispatch() emitira a un listener que llamaremos terminosBusqueda el cual estara en el padre que es HomeVacantes
    public function leerDatosFormulario(){

        $this->dispatch('terminosBusqueda',$this->termino, $this->categoria, $this->salario);
    }


    public function render()
    {
        $salarios=Salario::all();
        $categorias=Categoria::all();

        
        return view('livewire.filtrar-vacantes',[

            'salarios'=>$salarios,
            'categorias'=>$categorias
        ]);
    }
}
