<div class="bg-gray-100 p-5 mt-10 flex flex-col justify-center items-center">
    <h3 class="text-center text-2xl font-bold my-4">Postularme a esta vacante</h3>

    <form wire:submit.prevent='postularme' action="" class="w-96 mt-5">
        <div class="mb-4">
            <x-label for="cv" :value="__('Curriculum u hoja de vida(PDF)')" />
            <x-input id="cv" type="file" :wire:model="cv" accept=".pdf" class="block mt-1 w-full" />
        </div>

        @error('cv')
        <livewire:mostrar-alerta :message="$message">
            @enderror

            <x-button class="my-5">
                {{__('Postularme')}}
            </x-button>
    </form>
</div>