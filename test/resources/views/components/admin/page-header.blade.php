<div class="flex justify-between items-center mb-8">

    <div>
        <h1>
            {{ $title }}
        </h1>

        <p class="text-gray-500 mt-2">
            {{ $description }}
        </p>
    </div>

    @isset($action)
        <div class="flex gap-2">
            {{ $action }}
        </div>
    @endisset

</div>
