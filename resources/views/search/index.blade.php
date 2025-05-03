<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <main class="container mx-auto px-4 py-8 mb-6 max-w-7xl">
        @livewire('product-search')
    </main>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('filter-form');
            const productsGrid = document.getElementById('filtered-products');
            const resultsTitle = document.getElementById('results-title');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(form);
                const queryString = new URLSearchParams(formData).toString();

                fetch(`${form.action}?${queryString}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        productsGrid.innerHTML = html;
                        const productCount = productsGrid.querySelectorAll('.bg-white').length;
                        resultsTitle.innerHTML = `<h2 class="text-xl font-semibold mb-6">Filtered Items (${productCount})</h2>`;
                    });
            });
        });
    </script>
    @endpush

</x-app-layout>