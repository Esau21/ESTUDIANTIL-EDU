@include('commom.modalHead')

<div class="container">
    <div class="card">
        <div class="card-header bg-dark">
            <h6 class="text-uppercase text-white text-center">Crear Profesor</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" wire:model.lazy="nombre" class="form-control" placeholder="Ingresa el nombre">
                        @error('nombre')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" wire:model.lazy="apellidos" class="form-control" placeholder="Ingresa el apellido">
                        @error('apellidos')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <select class="form-control" wire:model.lazy="estudiante_id">
                            <option selected>Selecciona al estudiante</option>
                            @foreach($estu as $e)
                                <option value="{{$e['id']}}">{{$e->nombre}}</option>
                            @endforeach
                        </select>
                        @error('estudiante_id')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('commom.modalFooter')