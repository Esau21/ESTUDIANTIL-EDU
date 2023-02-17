@include('commom.modalHead')
<div class="container">
    <div class="card">
        <div class="card-header bg-dark">
            <h6 class="text-uppercase text-white text-center">crear materias</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" wire:model.lazy="nombre" class="form-control"
                            placeholder="Ingresa el nombre de la materia">
                        @error('nombre')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" wire:model.lazy="codigo" class="form-control"
                            placeholder="Ingresa el codigo de la materia">
                        @error('codigo')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('commom.modalFooter')
