<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('CV File') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Upload your latest CV to enhance your portfolio and provide potential employers with updated information.') }}
        </p>
    </header>

    <form method="post" action="{{ route('admin.general.update-cv') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div class="flex flex-col space-y-2 flex-1">
            <x-form.file-input
                name="cv_file"
                label="Upload CV"
                validFileFormats="PDF"
                maxFileSizeMB="2"
            />
        </div>

        <x-button>
            {{ __('Save') }}
        </x-button>
    </form>
</section>
