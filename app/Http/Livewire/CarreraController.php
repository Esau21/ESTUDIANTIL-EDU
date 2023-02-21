<?php

namespace App\Http\Livewire;

use App\Models\Carrera;
use Livewire\Component;
use Livewire\WithPagination;

class CarreraController extends Component
{
    public $name, $descripcion, $selected_id, $search, $pageTitle, $componentName;
    private $pagination = 5;
    protected $paginationTheme = 'bootstrap';

    use WithPagination;

    public function mount()
    {
        $this->pageTitle = 'Carreras';
        $this->componentName = 'Listado';
    }

    public function render()
    {
        if (strlen($this->search) > 0)
            $carreras = Carrera::where('name', 'LIKE', '%' . $this->search . '%')
                ->select('carreras.*')
                ->orWhere('descripcion', 'LIKE', '%' . $this->search . '%')
                ->orderBy('name', 'DESC')
                ->paginate($this->pagination);
        else
            $carreras = Carrera::where('name', 'LIKE', '%' . $this->search . '%')
                ->select('carreras.*')
                ->orWhere('descripcion', 'LIKE', '%' . $this->search . '%')
                ->orderBy('name', 'DESC')
                ->paginate($this->pagination);
        return view('livewire.carreras.carrera', ['carreras' => $carreras])
            ->extends('layouts.theme.plantilla')
            ->section('content');
    }


    public function resetUI()
    {
        $this->name = '';
        $this->descripcion = '';
        $this->selected_id = 0;
    }

    public function Store()
    {
        $rules = [
            'name' => 'required',
            'descripcion' => 'required',
        ];

        $messages = [
            'name.required' => 'El nombre es requerido',
            'descripcion.required' => 'La descripcion es requerida'
        ];

        $this->validate($rules, $messages);

        $carreras = Carrera::create([
            'name' => $this->name,
            'descripcion' => $this->descripcion,
        ]);

        $carreras->save();

        $this->resetUI();
        $this->emit('msgok', 'Agregado');
    }

    public function Edit($id) 
    {
        $carreras = Carrera::find($id, ['id','name','descripcion']);
        $this->selected_id = $carreras->id;
        $this->name = $carreras->name;
        $this->descripcion = $carreras->descripcion;


        $this->emit('show-modal');
    }

    public function Update()
    {
        $rules = [
            'name' => 'required',
            'descripcion' => 'required',
        ];

        $messages = [
            'name.required' => 'El nombre es requerido',
            'descripcion.required' => 'La descripcion es requerida'
        ];

        $this->validate($rules, $messages);

        $carreras = Carrera::find($this->selected_id);

        $carreras->update([
            'name' => $this->name,
            'descripcion' => $this->descripcion,
        ]);

        $this->resetUI();
        $this->emit('msg-update', 'Actualizado');
    }

    public function Destroy($id)
    {
        Carrera::destroy($id);

        return redirect()->route('carrera.index');
    }
}
