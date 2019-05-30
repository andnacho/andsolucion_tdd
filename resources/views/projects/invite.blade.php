
<div class="card flex flex-col mt-3">
    <h3 class="font-normal text-xl py-4 -ml-5 border-l-4 border-blue-light pl-4 mb-3">
        <a href="{{ $project->path() }}" class="text-default no-underline">
            Invite a user
        </a>
    </h3>

    <form method="POST" action="{{ $project->path() .'/invitations'}}" class="text-right">
        @csrf
        <div class="mb-3">
            <input type="email" name="email" class="border border-gray rounded w-full" placeholder="Email address">
        </div>

        <button type="submit" class="button float-left">Invite</button>

    </form>
    @include ('errors', ['bag' => 'invitations'])



</div>

