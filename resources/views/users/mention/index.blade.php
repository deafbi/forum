<x-app-layout>
    <div class="container">
        <h1 class="mb-4">Mentions</h1>

        @forelse ($mentions as $mention)
        <div class="mb-3">
            <p>
                <strong>{{ $mention->user->name }}</strong> mentioned you in a
                <a href="{{ route('posts.show', $mention->post) }}">post</a>:
            </p>
            <blockquote>{{ $mention->post->content }}</blockquote>
        </div>
        @empty
        <p>No mentions yet.</p>
        @endforelse

        {{ $mentions->links() }}
    </div>
</x-app-layout>
