@if (session('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 5000)"
        class="mb-4 p-4 bg-green-500 text-white rounded-lg shadow transition-opacity"
    >
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 5000)"
        class="mb-4 p-4 bg-red-500 text-white rounded-lg shadow transition-opacity"
    >
        {{ session('error') }}
    </div>
@endif
