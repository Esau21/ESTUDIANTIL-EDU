@include('commom.modalHead')

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control" wire:model.lazy="nombre" placeholder="Ingresa el nombre">
                @error('nombre')
                    <span class="text-danger">
                        {{$message}}
                    </span>   
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control" wire:model.lazy="apellido" placeholder="Ingresa el apellido">
                @error('apellido')
                    <span class="text-danger">
                        {{$message}}
                    </span>   
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control" wire:model.lazy="carnet" placeholder="Ingresa el carnet">
                @error('carnet')
                    <span class="text-danger">
                        {{$message}}
                    </span>   
                @enderror
            </div>
        </div>
    </div>
</div>


@include('commom.modalFooter')