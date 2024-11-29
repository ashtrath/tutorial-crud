<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Projects') }}
            </h2>
            <x-button
                href="{{ route('admin.project.create') }}"
                variant="success"
                size="base"
                class="items-center max-w-xs gap-2"
            >
                <x-heroicon-o-plus aria-hidden="true" class="size-6" />
                <span>Create New Project</span>
            </x-button>
        </div>
    </x-slot>

    <table id="projectTable" class="mb-4 p-8 w-full align-middle">
        <thead class="align-bottom">
            <tr>
                <th scope="col" class="text-start max-w-[10px]">
                    <span class="inline-flex items-center">
                        No
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                        </svg>
                    </span>
                </th>
                <th scope="col" class="text-start min-w-[100px]">
                    <span class="inline-flex items-center">
                        Name
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                        </svg>
                    </span>
                </th>
                <th scope="col" class="text-start min-w-[75px]">
                    <span class="inline-flex items-center">
                        Category
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                        </svg>
                    </span>
                </th>
                <th scope="col" class="text-end min-w-[50px]">
                    <span class="inline-flex items-center">
                        Link
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                        </svg>
                    </span>
                </th>
                <th scope="col" class="text-end min-w-[100px]">
                    <span class="inline-flex items-center">
                        Image
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                        </svg>
                    </span>
                </th>
                <th scope="col" class="text-end min-w-[50px]">
                    <span class="inline-flex items-center">
                        Action
                    </span>
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <span class="font-semibold text-gray-900 whitespace-nowrap dark:text-white">{{ $project->name }}</span>
                    </td>
                    <td>{{ $project->category }}</td>
                    <td class="text-end">
                        @if ($project->link)
                            <x-button variant="info" size="sm" pill="true"
                                      href="{{ $project->link }}" target="_blank">
                                View Project
                            </x-button>
                        @else
                            <x-button variant="danger" size="sm" pill="true" disabled>
                                No link available
                            </x-button>
                        @endif
                    </td>
                    <td class="text-end">
                        @if ($project->image)
                            <x-button variant="info" size="sm" pill="true"
                                      href="{{ asset('storage/projects/' . $project->image) }}" target="_blank">
                                View Image
                            </x-button>
                        @else
                            <x-button variant="danger" size="sm" pill="true" disabled>
                                No image uploaded
                            </x-button>
                        @endif
                    </td>
                    <td>
                        <div class="inline-flex items-center justify-end w-full gap-2">
                            <x-button variant="info" size="sm"
                                      href="{{ route('admin.project.edit', $project) }}">Edit
                            </x-button>
                            <x-button-delete action="{{ route('admin.project.destroy', $project) }}" />
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-8 px-6 text-center font-semibold text-lg/normal text-gray-500">
                        There are no data.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <script type="module">
        let table = new DataTable('#projectTable', {
            perPage: 5,
            perPageSelect: [5, 10, 20, 50],
        })
    </script>
</x-app-layout>
