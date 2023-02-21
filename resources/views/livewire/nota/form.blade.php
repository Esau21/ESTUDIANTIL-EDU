@include('commom.modalHead')
<div class="container">
    <div class="card">
        <div class="card-header bg-dark">
            <h6 class="text-white text-uppercase text-center">Crear nota de alumno</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <input type="number" wire:model.lazy="nota1" wire:change="calculateAverage" class="form-control">
                        @error('nota1')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <input type="number" wire:model.lazy="nota2" wire:change="calculateAverage" class="form-control">
                        @error('nota2')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <input type="number" wire:model.lazy="nota3" wire:change="calculateAverage"  class="form-control">
                        @error('nota3')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <input type="number" wire:model.lazy="nota4" wire:change="calculateAverage"  class="form-control">
                        @error('nota4')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <input type="number" wire:model.lazy="promedio" disabled class="form-control" >
                        @error('promedio')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <select class="form-control" wire:model.lazy="estudiante_id">
                            <option selected>Selecciona al estudiante</option>
                            @foreach ($estu as $e)
                                <option value="{{ $e['id'] }}">{{ $e->nombre }}</option>
                            @endforeach
                        </select>
                        @error('estudiante_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <select class="form-control" wire:model.lazy="profesor_id">
                            <option selected>Selecciona al profesor</option>
                            @foreach ($profe as $e)
                                <option value="{{ $e['id'] }}">{{ $e->nombre }}</option>
                            @endforeach
                        </select>
                        @error('profesor_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <select class="form-control" wire:model.lazy="materia_id">
                            <option selected>Selecciona la materia</option>
                            @foreach ($mate as $e)
                                <option value="{{ $e['id'] }}">{{ $e->nombre }}</option>
                            @endforeach
                        </select>
                        @error('materia_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <select class="form-control" wire:model.lazy="carrera_id">
                            <option selected>Selecciona la carrera</option>
                            @foreach ($carre as $e)
                                <option value="{{ $e['id'] }}">{{ $e->name }}</option>
                            @endforeach
                        </select>
                        @error('carrera_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('commom.modalFooter')
