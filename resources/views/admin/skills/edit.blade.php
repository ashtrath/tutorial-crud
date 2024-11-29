<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center">
            <x-button
                iconOnly="true"
                href="{{ route('admin.skill.index') }}"
                size="sm"
                srText="Back to Index"
            >
                <x-heroicon-o-arrow-left aria-hidden="true" class="size-6" />
            </x-button>
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Skills') }}
            </h2>
        </div>
    </x-slot>

    <section class="p-8 w-full shadow-md rounded-xl bg-white dark:bg-dark-eval-1 ">
        <header>
            <h2 class="text-lg font-semibold">Edit Skills</h2>
        </header>
        <form action="{{ route('admin.skill.update', $skill->id) }}" method="POST" enctype="multipart/form-data"
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
                        value="{{ $skill->name }}"
                        class="block w-full"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <x-form.error :messages="$errors->get('name')" />
                </div>
                <div class="space-y-2 flex-1">
                    <x-form.label
                        for="inputPercentage"
                        :value="__('Percentage (0 - 100)')"
                    />
                    <x-form.input
                        id="inputPercentage"
                        name="percent"
                        type="number"
                        value="{{ $skill->percent }}"
                        class="block w-full"
                        min="0"
                        max="100"
                        required
                    />
                    <x-form.error :messages="$errors->get('name')" />
                </div>
            </div>
            <x-button>
                {{ __('Submit') }}
            </x-button>
        </form>
    </section>
</x-app-layout>
