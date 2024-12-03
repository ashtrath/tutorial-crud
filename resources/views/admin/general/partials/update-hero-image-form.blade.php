<section>
  <header>
      <h2 class="text-lg font-medium">
          {{ __('Hero Image') }}
      </h2>

      <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
          {{ __('Upload your picture to enhance your portfolio.') }}
      </p>
  </header>

  <form method="post" action="{{ route('admin.general.update-image') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
      @csrf
      @method('PUT')

      <div class="flex flex-col space-y-2 flex-1">
          <x-form.file-input
              name="hero_image"
              label="Upload Your Image"
              validFileFormats="PNG, JPG, JPEG, WEBP"
              maxFileSizeMB="5"
          />
      </div>

      <x-button>
          {{ __('Save') }}
      </x-button>
  </form>
</section>
