<div x-data>
    <div class="">
        <table class="w-full bg-[#222222] text-neutral-300 shadow-md ">
            <thead class="bg-[#151515]">
                <tr>
                    <th class="border-b border-neutral-800 px-4 py-2 text-left">Name</th>
                    <th class="border-b border-neutral-800 px-4 py-2 text-left">Description</th>
                    <th class="border-b border-neutral-800 px-4 py-2 text-left">Icon</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($awards as $item)
                    <tr class="hover:bg-neutral-800">
                        <td class="border-b border-neutral-800 px-4 py-2">{{ $item->name }}</td>
                        <td class="border-b border-neutral-800 px-4 py-2">{{ $item->description }}</td>
                        <td class="border-b border-neutral-800 px-4 py-2">
                            <img class="object-cover w-8 h-8 rounded-md"
                                src="{{ asset('storage/' . Str::after($item->icon, 'public/')) }}" alt="" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $awards->links() }}
    </div>
</div>
