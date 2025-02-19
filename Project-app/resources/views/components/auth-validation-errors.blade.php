@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'alert alert-error shadow-lg rounded-lg mb-4 p-4']) }}>
        <div class="flex items-center">
            <i class="fas fa-exclamation-triangle text-2xl text-red-700 mr-3"></i>
            <div>
                <ul class="list-disc list-inside text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
