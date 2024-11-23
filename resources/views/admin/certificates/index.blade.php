<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Certificates') }}
            </h2>
            <x-button
                href="{{ route('admin.certificate.create') }}"
                variant="success"
                size="base"
                class="items-center max-w-xs gap-2"
            >
                <x-heroicon-o-plus aria-hidden="true" class="size-6" />
                <span>Create New Certificate</span>
            </x-button>
        </div>
    </x-slot>

    <table id="certificateTable" class="mb-4 p-8 w-full align-middle">
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
                        Initiated By
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                        </svg>
                    </span>
                </th>
                <th scope="col" data-type="date" class="text-end min-w-[50px]">
                    <span class="inline-flex items-center">
                        Initiated At
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                        </svg>
                    </span>
                </th>
                <th scope="col" class="text-end min-w-[100px]">
                    <span class="inline-flex items-center">
                        File
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
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                        </svg>
                    </span>
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($certificates as $certificate)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <span
                            class="font-semibold text-gray-900 whitespace-nowrap dark:text-white">{{ $certificate->name }}</span>
                    </td>
                    <td>{{ $certificate->initiated_by }}</td>
                    <td class="text-end">{{ $certificate->initiated_at }}</td>
                    <td class="text-end">
                        @if ($certificate->file)
                            <x-button variant="info" size="sm" pill="true"
                                      href="{{ asset('storage/certificates/' . $certificate->file) }}" target="_blank">
                                View Certificate
                            </x-button>
                        @else
                            <x-button variant="danger" size="sm" pill="true" disabled>
                                No file uploaded
                            </x-button>
                        @endif
                    </td>
                    <td>
                        <div class="inline-flex items-center justify-end w-full gap-2">
                            <x-button variant="info" size="sm"
                                      href="{{ route('admin.certificate.edit', $certificate) }}">Edit
                            </x-button>
                            <x-button-delete action="{{ route('admin.certificate.destroy', $certificate) }}" />
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-8 px-6 text-center font-semibold text-lg/normal text-gray-500">There are
                        no data.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <script type="module">
        let table = new DataTable('#certificateTable', {
            perPage: 5,
            perPageSelect: [5, 10, 20, 50],
        })
    </script>
</x-app-layout>
