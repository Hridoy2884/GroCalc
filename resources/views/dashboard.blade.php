<x-app-layout>
    @include('profile.partials.dark-light')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <h1 class="text-2xl mb-4">Welcome, {{ Auth::user()->name }}!</h1>
                    <a href="{{ route('viewdata') }}" class="text-blue-500 underline block mb-4">View All Calculations</a>

                    {{-- App Name --}}
                    <div class="text-center mb-6">
                        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-gray-200 animate-fade-in-scale">GroCalc</h2>
                    </div>

                    {{-- Grand Total + Clear --}}
                    @php
                        $grandTotal = \App\Models\Calculate::where('user_id', Auth::id())->sum('total');
                    @endphp
                    <div class="flex flex-col sm:flex-row justify-between items-center mt-6 mb-4 bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-sm transition-all duration-300 space-y-4 sm:space-y-0">
                        <p class="font-semibold text-gray-800 dark:text-gray-200">
                            Grand Total: {{ number_format($grandTotal, 2) }}
                        </p>
                        <form action="{{ route('clearAll') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-opacity-50 transition duration-300 w-full sm:w-auto">
                                Clear Previous Records
                            </button>
                        </form>
                    </div>

                
                    {{-- Calculator Form --}}
                    <form id="calculator-form" action="{{ route('calculate') }}" method="POST" class="space-y-4 w-full sm:w-2/3 lg:w-1/2 mx-auto">
                        @csrf

                        {{-- Item --}}
                        <input 
                            type="text" 
                            name="item" 
                            placeholder="Item Name" 
                            class="border px-3 py-2 block w-full text-gray-900 dark:text-white bg-white dark:bg-gray-800 rounded"
                            value="{{ old('item') }}"
                        >
                        @error('item')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror

                        {{-- Unit Price --}}
                        <input 
                            type="number" 
                            name="unitprice" 
                            step="any" 
                            placeholder="Unit Price" 
                            class="border px-3 py-2 block w-full text-gray-900 dark:text-white bg-white dark:bg-gray-800 rounded"
                            value="{{ old('unitprice') }}"
                        >
                        @error('unitprice')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror

                        {{-- Quantity --}}
                        <input 
                            type="number" 
                            name="quantity" 
                            step="any" 
                            placeholder="Quantity" 
                            class="border px-3 py-2 block w-full text-gray-900 dark:text-white bg-white dark:bg-gray-800 rounded"
                            value="{{ old('quantity') }}"
                        >
                        @error('quantity')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror

                        {{-- Submit --}}
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
                            Calculate
                        </button>
                    </form>
                </div>
            </div>

            {{-- Last Calculation --}}
            @if (session('total'))
                <div class="mt-4 p-4 bg-green-100 text-green-800 rounded">
                    <h2 class="text-lg font-bold">Calculation Result</h2>
                    <p><strong>Item:</strong> {{ session('item') }}</p>
                    <p><strong>Unit Price:</strong> {{ number_format(session('unitprice'), 2) }}</p>
                    <p><strong>Quantity:</strong> {{ session('quantity') }}</p>
                    <p><strong>Total:</strong> {{ number_format(session('total'), 2) }}</p>
                </div>
            @endif

            {{-- Developer Info --}}
            <div class="mt-8 p-6 rounded-lg shadow-lg bg-gradient-to-br from-gray-100 to-white dark:from-gray-900 dark:to-gray-800 transition-colors duration-500">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-2">
                    Contact the Developer
                </h2>
                <p class="text-gray-700 dark:text-gray-300">
                    Have questions or need support? Feel free to reach out to me!
                </p>
            
                <div class="mt-6 space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-100 dark:bg-blue-600/20 p-2 rounded-full">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m0 0l4-4m-4 4l4 4" />
                            </svg>
                        </div>
                        <span class="text-lg text-gray-800 dark:text-gray-200">
                            Email: <a href="mailto:rihridoy226@gmail.com" class="text-blue-500 hover:underline">rihridoy226@gmail.com</a>
                        </span>
                    </div>
            
                    <div class="flex items-center space-x-3">
                        <div class="bg-green-100 dark:bg-green-600/20 p-2 rounded-full">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10l1.5 1.5M21 10l-1.5 1.5M12 22V12M12 2v4m0 16c-4 0-8-4-8-8s4-8 8-8 8 4 8 8-4 8-8 8z" />
                            </svg>
                        </div>
                        <span class="text-lg text-gray-800 dark:text-gray-200">
                            Phone: <a href="tel:+8801754661596" class="text-blue-500 hover:underline">01754-661596</a>
                        </span>
                    </div>
                </div>
            
                <!-- Footer -->
                <div class="mt-8 border-t border-gray-300 dark:border-gray-700 pt-4 text-center">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        &copy; 2025 <span class="font-semibold text-gray-800 dark:text-gray-200">GroCalc</span>. All rights reserved.
                    </p>
                </div>
            </div>
            
            
        </div>
    </div>

    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        } else if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.remove('dark');
        }

        document.getElementById('theme-toggle')?.addEventListener('click', function () {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });
    </script>
</x-app-layout>
