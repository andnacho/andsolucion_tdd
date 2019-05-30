<div class="text-default card flex flex-col" style="height: 200px">
    <h3 class="font-normal py-4 -ml-5 border-l-4 border-blue-light pl-4 mb-3">
        <a href="{{ $project->path() }}" class="text-default no-underline">{{ $project->title }}</a>
    </h3>

    <div class="mb-4 flex-1">{{ Str::limit($project->description, 85) }}</div>

    @can('manage', $project)
        <footer>
            <form method="POST" action="{{ $project->path() }}" class="text-right">
                @method('DELETE')
                @csrf
                <button type="submit" class="text-xs text-default">Delete</button>
            </form>
        </footer>
    @else
        Invited
    @endcan
</div>
