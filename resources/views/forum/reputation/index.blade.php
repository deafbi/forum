<x-app-layout>
    <div class="bg-[#242424] py-2 px-4 rounded-md mt-4 text-gray-400 uppercase font-bold">
        <div class="flex space-x-2 items-center">
            <a href="{{ route('home') }}">Home</a>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                class="w-4 h-4 text-neutral-500">
                <path fill-rule="evenodd"
                    d="M4.72 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 010-1.06zm6 0a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 010-1.06z"
                    clip-rule="evenodd" />
            </svg>
            <span>Reputation log</span>

        </div>
    </div>
    <div class="py-4">
        <table class="w-full bg-[#222222] text-neutral-300 rounded-md shadow-md ">
            <thead>
                <tr>
                    <th class="border-b border-neutral-800 px-4 py-2 text-left">Date</th>
                    <th class="border-b border-neutral-800 px-4 py-2 text-left">From</th>
                    <th class="border-b border-neutral-800 px-4 py-2 text-left">To</th>
                    <th class="border-b border-neutral-800 px-4 py-2 text-left">Amount</th>
                    <th class="border-b border-neutral-800 px-4 py-2 text-left">Reason</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reputationLogs as $log)
                    <tr class="hover:bg-neutral-800">
                        <td class="border-b border-neutral-800 px-4 py-2">{{ $log->created_at->format('d-m-Y H:i') }}
                        </td>
                        <td class="border-b border-neutral-800 px-4 py-2 font-bold" style="color: {{ $log->giver->getUsernameColor() }};">
                            <a href="{{ route('profile.show', $log->giver) }}">
                                {{ $log->giver->username }}
                            </a>
                        </td>
                        <td class="border-b border-neutral-800 px-4 py-2 font-bold" style="color: {{ $log->user->getUsernameColor() }};">
                            <a href="{{ route('profile.show', $log->user) }}">
                                {{ $log->user->username }}
                            </a>
                        </td>
                        <td class="border-b border-neutral-800 px-4 py-2">{{ $log->points }}</td>
                        <td class="border-b border-neutral-800 px-4 py-2">{{ $log->reason }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
