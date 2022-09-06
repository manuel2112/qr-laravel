<x-app-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ __('Menú') }}</li>
                <li class="breadcrumb-item"><a href="#" class="btn btn-outline-warning" target="_blank" style="font-size: 10px"><i class="fas fa-question"></i></a></li>
            </ol>
        </nav>
    </x-slot>

    <div class="row justify-content-center my-1">
        <div class="col-md-12">
            <div class="card shadow bg-light">
                <div class="card-body bg-white px-5 py-1 border-bottom rounded-top">
                    <div class="mx-3 my-1">

                        <livewire:menu-home />

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>