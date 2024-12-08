<x-app-layout>
  <x-slot name="header">
      <div class="flex flex-col gap-4 md:flex-row md:items-center">
          <x-button
              iconOnly="true"
              href="{{ route('admin.general.index') }}"
              size="sm"
              srText="Back to Index"
          >
              <x-heroicon-o-arrow-left aria-hidden="true" class="size-6" />
          </x-button>
          <h2 class="text-xl font-semibold leading-tight">
              {{ __('Social Links') }}
          </h2>
      </div>
  </x-slot>

  <section class="p-8 w-full shadow-md rounded-xl bg-white dark:bg-dark-eval-1 ">
      <header>
          <h2 class="text-lg font-semibold">Edit Social Links</h2>
      </header>
      <form action="{{ route('admin.social_link.update', $social_link->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
          @csrf
          <div class="flex gap-4">
              <div class="space-y-2 flex-1">
                  <x-form.label
                      for="inputLink"
                      :value="__('Link')"
                  />
                  <x-form.input
                      id="inputLink"
                      name="link"
                      type="text"
                      value="{{ $social_link->link }}"
                      class="block w-full"
                      required
                      autofocus
                  />
                  <x-form.error :messages="$errors->get('link')" />
              </div>
              <div class="space-y-2 flex-1">
                  <x-form.label
                      for="inputIcon"
                      :value="__('Icon (fab-facebook)')"
                  />
                  <x-form.input
                      id="inputIcon"
                      name="icon"
                      type="text"
                      value="{{ $social_link->icon }}"
                      class="block w-full"
                      required
                  />
                  <x-form.error :messages="$errors->get('icon')" />
                  <small>
                      See: <a href="https://blade-ui-kit.com/blade-icons" target="_blank" class="text-blue-500 underline">https://blade-ui-kit.com/blade-icons</a>
                  </small>
              </div>
          </div>
          <x-button>
              {{ __('Submit') }}
          </x-button>
      </form>
  </section>
</x-app-layout>
