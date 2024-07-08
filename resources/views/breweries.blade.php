<!DOCTYPE html>
<html>

<head>
    <title>Laravel OpenBreweryDB</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-amber-50 p-6">
    <div class="container mx-auto">
        <div class="mt-4 flex justify-between">
            <h1 class="text-3xl font-bold mb-4">You can find 'em here!</h1>
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="inline-flex items-center mb-4 px-4 py-2 border text-base font-medium rounded-md text-yellow-600 bg-white hover:bg-gray-50">Logout</button>
            </form>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border shadow-sm p-6">
                <thead>
                    <tr class="bg-gray-100 text-gray-900">
                        <x-table-header-cell>Name</x-table-header-cell>
                        <x-table-header-cell>Street</x-table-header-cell>
                        <x-table-header-cell>City</x-table-header-cell>
                        <x-table-header-cell>State/Province</x-table-header-cell>
                        <x-table-header-cell>Postal Code</x-table-header-cell>
                        <x-table-header-cell>Country</x-table-header-cell>
                        <x-table-header-cell>Type</x-table-header-cell>
                    </tr>
                </thead>
                <tbody>
                    @foreach($breweries as $brewery)
                    <tr class="border-b">
                        <x-table-cell class="!text-amber-600">{{ $brewery['name'] }}</x-table-cell>
                        <x-table-cell>{{ $brewery['address_1'] }}</x-table-cell>
                        <x-table-cell class="!text-amber-600">{{ $brewery['city'] }}</x-table-cell>
                        <x-table-cell class="!text-amber-600">{{ $brewery['state_province'] }}</x-table-cell>
                        <x-table-cell>{{ $brewery['postal_code'] }}</x-table-cell>
                        <x-table-cell class="!text-amber-600">{{ $brewery['country'] }}</x-table-cell>
                        <x-table-cell>{{ $brewery['brewery_type'] }}</x-table-cell>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4 flex justify-between">
            @if($page > 1)
            <x-pagination-button href="{{ route('breweries', ['page' => $page - 1]) }}">Previous</x-pagination-button>
            @endif
            <x-pagination-button href="{{ route('breweries', ['page' => $page + 1]) }}">Next</x-pagination-button>
        </div>
    </div>
</body>

</html>