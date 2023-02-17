<?php

namespace App\Http\Livewire;

use App\Models\Materia;
use Livewire\Component;
use Livewire\WithPagination;

class MateriaController extends Component
{

    use WithPagination;

    public $nombre, $codigo, $pageTitle, $componentName, $selected_id, $search;
    private $pagination = 3;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->pageTitle = 'Materias';
        $this->componentName = 'listado';
    }


    public function render()
    {
        if (strlen($this->search) > 0)
            $materias = Materia::where('nombre', 'LIKE', '%' . $this->search . '%')
                ->select('materias.*')
                ->orWhere('codigo', 'LIKE', '%' . $this->search . '%')
                ->orderBy('nombre', 'DESC')
                ->paginate($this->pagination);
        else
            $materias = Materia::where('nombre', 'LIKE', '%' . $this->search . '%')
                ->select('materias.*')
                ->orWhere('codigo', 'LIKE', '%' . $this->search . '%')
                ->orderBy('nombre', 'DESC')
                ->paginate($this->pagination);
        return view('livewire.materia.mate', ['materias' => $materias])
            ->extends('layouts.theme.plantilla')
            ->section('content');
    }

    public function resetUI()
    {
        $this->nombre = '';
        $this->codigo = '';
        $this->selected_id = 0;
    }

    public function Store()
    {
        $rules = [
            'nombre' => 'required',
            'codigo' => 'required',
        ];
        $messages = [
            'nombre.required' => 'El nombre de la materia es requerida',
            'codigo.required' => 'El codigo de la materia es requerido'
        ];
        $this->validate($rules, $messages);

        $materias = Materia::create([
            'nombre' => $this->nombre,
            'codigo' => $this->codigo,
        ]);

        $materias->save();

        $this->resetUI();
        $this->emit('msgok', 'Agregado');
    }


    public function Edit($id)
    {
        $materias = Materia::find($id, ['id', 'nombre', 'codigo']);
        $this->selected_id = $materias->id;
        $this->nombre = $materias->nombre;
        $this->codigo = $materias->codigo;


        $this->emit('show-modal');
    }


    public function Update()
    {
        $rules = [
            'nombre' => 'required',
            'codigo' => 'required',
        ];
        $messages = [
            'nombre.required' => 'El nombre de la materia es requerida',
            'codigo.required' => 'El codigo de la materia es requerido'
        ];
        $this->validate($rules, $messages);


        $materias = Materia::find($this->selected_id);

        $materias->update([
            'nombre' => $this->nombre,
            'codigo' => $this->codigo,
        ]);

        $this->resetUI();
        $this->emit('msg-update');
    }

    public function Destroy($id)
    {
        Materia::destroy($id);

        return redirect()->route('materia.index');
    }
}
