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

    <table class="mb-4 p-8 w-full align-middle text-gray-300 bg-white shadow-md rounded-xl dark:bg-dark-eval-1">
        <thead class="align-bottom">
            <tr class="font-semibold text-[0.95rem] text-gray-500 uppercase">
                <th class="py-3 px-6 text-start w-[10px]">No</th>
                <th class="py-3 px-6 text-start min-w-[100px]">Name</th>
                <th class="py-3 px-6 text-start min-w-[75px]">Initiated By</th>
                <th class="py-3 px-6 text-end min-w-[50px]">Initiated At</th>
                <th class="py-3 px-6 text-end min-w-[100px]">File</th>
                <th class="py-3 px-6 text-end min-w-[50px]">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y-2 divide-dark-eval-3 divide-dashed">
            @forelse ($certificates as $certificate)
                <tr>
                    <td class="py-4 px-6">
                        <span class="font-semibold text-md/normal">{{ $loop->iteration }}</span>
                    </td>
                    <td class="py-4 px-6">
                        <a class="font-semibold text-lg/normal" href="{{ route("admin.certificate.show", $certificates) }}">
                            {{ $certificate->name }}
                        </a>
                    </td>
                    <td class="py-4 px-6">
                        <span class="font-semibold text-md/normal">{{ $certificate->initiated_by }}</span>
                    </td>
                    <td class="py-4 px-6 text-end">
                        <span class="font-semibold text-md/normal">{{ $certificate->initiated_at }}</span>
                    </td>
                    <td class="py-4 px-6 text-end">
                        @if ($certificate->file)
                            <x-button variant="info" size="sm" pill="true" href="{{ asset('storage/certificates/' . $certificate->file) }}" target="_blank">
                                View Certificate
                            </x-button>
                        @else
                            <span class="font-semibold text-md/normal">No file uploaded</span>
                        @endif
                    </td>
                    <td class="py-4 px-6">
                        <div class="inline-flex items-center justify-end w-full gap-2">
                            <x-button variant="info" size="sm" href="{{ route('admin.certificate.edit', $certificate) }}">Edit</x-button>
                            <x-button-delete action="{{ route('admin.certificate.destroy', $certificate) }}" />
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-8 px-6 text-center font-semibold text-lg/normal text-gray-500">There are no data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {!! $certificates->withQueryString()->links('pagination::tailwind') !!}
</x-app-layout>