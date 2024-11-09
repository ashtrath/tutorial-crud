<x-app-layout>
	<x-slot name="header">
		<div class="flex flex-col gap-4 md:flex-row md:items-center">
			<x-button
				iconOnly="true"
				href="{{ route('admin.certificate.index') }}"
				size="sm"
				srText="Back to Index"
			>
				<x-heroicon-o-arrow-left aria-hidden="true" class="size-6" />
			</x-button>
			<h2 class="text-xl font-semibold leading-tight">
				{{ __('Certificates') }}
			</h2>
		</div>
	</x-slot>

	<section class="p-8 w-full shadow-md rounded-xl bg-white dark:bg-dark-eval-1 ">
		<header>
			<h2 class="text-lg font-semibold">Create New Certificate</h2>
		</header>
		<form action="{{ route('admin.certificate.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
			@csrf
            <div class="space-y-2 flex-1">
                <x-form.label
                    for="inputName"
                    :value="__('Name')"
                />
                <x-form.input
                    id="inputName"
                    name="name"
                    type="text"
                    class="block w-full"
                    required
                    autofocus
                    autocomplete="name"
                />
                <x-form.error :messages="$errors->get('name')" />
            </div>
            <div class="flex gap-4">
                <div class="space-y-2 flex-1">
                    <x-form.label
                        for="inputInitiatedBy"
                        :value="__('Initiated By')"
                    />
                    <x-form.input
                        id="inputInitiatedBy"
                        name="initiated_by"
                        type="text"
                        class="block w-full"
                        required
                    />
                    <x-form.error :messages="$errors->get('initiated_by')" />
                </div>
                <div class="space-y-2 flex-1">
                    <x-form.label
                        for="inputInitiatedAt"
                        :value="__('Initiated At')"
                    />
                    <x-form.input
                        id="inputInitiatedAt"
                        name="initiated_at"
                        type="date"
                        class="block w-full"
                        required
                    />
                    <x-form.error :messages="$errors->get('initiated_at')" />
                </div>
            </div>
			<div class="flex gap-4">
                <div class="flex flex-col space-y-2 flex-1">
                    <x-form.label
                        for="inputDescription"
                        :value="__('Description')"
                    />
                    <textarea name="description" id="inputDescription" class="flex-1 py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1"></textarea>
                    <x-form.error :messages="$errors->get('description')" />
                </div>
                <x-form.file-input
                    name="file"
                    label="File"
                    validFileFormats="PDF"
                    maxFileSizeMB="5"
                />
            </div>
			<x-button>
				{{ __('Submit') }}
			</x-button>
		</form>
	</section>
</x-app-layout>
