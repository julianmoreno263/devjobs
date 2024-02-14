<?php

namespace App\Livewire;

use Livewire\Component;

class PostularVacante extends Component
{

    public $cv;

    protected $rules=[

        'cv'=>'required|mimes:pdf'
    ];

    public function postularme(){

        $this->validate();

        //almacenar cv en el disco duro


        //crear la vacante


        //crear notificacion y enviar email


        //mostrar al usuario un mensaje de que se envio correctamente
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
