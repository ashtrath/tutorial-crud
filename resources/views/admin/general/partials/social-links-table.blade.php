<header>
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Social Links') }}
        </h2>
        <x-button
            href="{{ route('admin.social_link.create') }}"
            variant="success"
            size="base"
            class="items-center max-w-xs gap-2"
        >
            <x-heroicon-o-plus aria-hidden="true" class="size-6" />
            <span>Create New Social Links</span>
        </x-button>
    </div>
</header>

<table id="socialLinkTable" class="mb-4 p-8 w-full align-middle">
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
                        Link
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                        </svg>
                    </span>
            </th>
            <th scope="col" class="text-start min-w-[75px]">
                    <span class="inline-flex items-center">
                        Icon
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
        @forelse ($social_links as $social_link)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if ($social_link->link)
                        <x-button variant="info" size="sm" pill="true"
                                  href="{{ $social_link->link }}" target="_blank">
                            Open Link
                        </x-button>
                    @else
                        <x-button variant="danger" size="sm" pill="true" disabled>
                            No link available
                        </x-button>
                    @endif
                </td>
                <td>
                    <div class="flex items-center gap-2">
                        <x-dynamic-component :component="$social_link->icon" class="size-6" />
                        ({{ $social_link->icon }})
                    </div>
                </td>
                <td>
                    <div class="inline-flex items-center justify-end w-full gap-2">
                        <x-button variant="info" size="sm"
                                  href="{{ route('admin.social_link.edit', $social_link) }}">Edit
                        </x-button>
                        <x-button-delete action="{{ route('admin.social_link.destroy', $social_link) }}" />
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="py-8 px-6 text-center font-semibold text-lg/normal text-gray-500">
                    There are no data.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<script type="module">
    let table = new DataTable('#socialLinkTable', {
        perPage: 5,
        perPageSelect: [5, 10, 20, 50],
    })
</script>
