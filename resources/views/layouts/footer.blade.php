<footer class="bg-green-500 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-3 gap-8">
            <div>
                <p class="text-4xl mb-4">Petsmart</p>
                <p class="text-sm">Caring for Pets, Simplifying Your Life!</p>
            </div>

            <div>
                <h3 class="font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('dashboard') }}" class="hover:underline">Home</a></li>
                    <li><a href="{{ route('search') }}" class="hover:underline">Search</a></li>
                    <li><a href="{{ route('subscription') }}" class="hover:underline">Subscription Plans</a></li>
                    <li><a href="{{ route('about-us') }}" class="hover:underline">About us / Blogs</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-semibold mb-4">Contact Information</h3>
                <ul class="space-y-2">
                    <li>support@petsmart.com</li>
                    <li>+94 77 071 4178</li>
                    <li>134/89, Kindamith Str. Ppers Rd.</li>
                </ul>
            </div>
        </div>
        <div class="text-center mt-8 pt-4 border-t border-green-400">
            © 2025 PetSmart. All rights reserved.
        </div>
    </div>
</footer>