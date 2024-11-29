<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center">
            <x-button
                iconOnly="true"
                href="{{ route('admin.project.index') }}"
                size="sm"
                srText="Back to Index"
            >
                <x-heroicon-o-arrow-left aria-hidden="true" class="size-6" />
            </x-button>
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Projects') }}
            </h2>
        </div>
    </x-slot>

    <section class="p-8 w-full shadow-md rounded-xl bg-white dark:bg-dark-eval-1 ">
        <header>
            <h2 class="text-lg font-semibold">Edit Project</h2>
        </header>
        <form action="{{ route('admin.project.update', $project->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <div class="flex gap-4">
                <div class="space-y-2 flex-1">
                    <x-form.label
                        for="inputName"
                        :value="__('Name')"
                    />
                    <x-form.input
                        id="inputName"
                        name="name"
                        type="text"
                        value="{{ $project->name }}"
                        class="block w-full"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <x-form.error :messages="$errors->get('name')" />
                </div>
                <div class="space-y-2 flex-1">
                    <x-form.label
                        for="inputCategory"
                        :value="__('Category')"
                    />
                    <x-form.input
                        id="inputCategory"
                        name="category"
                        type="text"
                        value="{{ $project->category }}"
                        class="block w-full"
                        required
                    />
                    <x-form.error :messages="$errors->get('category')" />
                </div>
            </div>
            <div class="space-y-2 flex-1">
                <x-form.label
                    for="inputLink"
                    :value="__('Link')"
                />
                <x-form.input
                    id="inputLink"
                    name="link"
                    type="text"
                    value="{{ $project->link }}"
                    class="block w-full"
                    required
                />
                <x-form.error :messages="$errors->get('name')" />
            </div>
            <x-form.file-input
                name="image"
                label="Preview Image"
                validFileFormats="PNG, JPG, JPEG, WEBP"
                maxFileSizeMB="2"
            />
            <x-button>
                {{ __('Submit') }}
            </x-button>
        </form>
    </section>
</x-app-layout>
