<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('General Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Update your portfolio\'s site general information like name, job title, etc.') }}
        </p>
    </header>

    <form method="post" action="{{ route('admin.general.update-information') }}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div class="space-y-2">
            <x-form.label
                for="inputFullName"
                :value="__('Full Name')"
            />
            <x-form.input
                id="inputFullName"
                name="full_name"
                type="text"
                value="{{ $generals->full_name ?? '' }}"
                class="block w-full"
            />
            <x-form.error :messages="$errors->updatePassword->get('full_name')" />
        </div>

        <div class="space-y-2">
            <x-form.label
                for="inputJobTitle"
                :value="__('Job Title')"
            />
            <x-form.input
                id="inputJobTitle"
                name="job_title"
                type="text"
                value="{{ $generals->job_title ?? ''}}"
                class="block w-full"
            />
            <x-form.error :messages="$errors->updatePassword->get('job_title')" />
        </div>

        <div class="space-y-2">
            <x-form.label
                for="inputAbout"
                :value="__('About Description')"
            />
            <textarea name="about" id="inputAbout" rows="7" class="block w-full py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1">{{ $generals->about ?? '' }}</textarea>
            <x-form.error :messages="$errors->get('about')" />
        </div>

        <x-button>
            {{ __('Save') }}
        </x-button>
    </form>
</section>
