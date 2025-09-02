<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="font-joan text-3xl font-semibold mb-2" style="color: #006B83;">Create Account</h2>
        <p class="text-gray-600">Join RETELL today</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                autocomplete="name" placeholder="Enter your full name"
                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200 bg-white text-gray-900 placeholder-gray-500" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                autocomplete="username" placeholder="Enter your email address"
                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200 bg-white text-gray-900 placeholder-gray-500" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                placeholder="Create a password"
                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200 bg-white text-gray-900 placeholder-gray-500" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                autocomplete="new-password" placeholder="Confirm your password"
                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200 bg-white text-gray-900 placeholder-gray-500" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Register Button -->
        <button type="submit"
            class="w-full bg-gradient-to-r from-teal-500 to-teal-600 text-white font-medium py-3 px-4 rounded-lg hover:from-teal-600 hover:to-teal-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105">
            REGISTER
        </button>
    </form>

    <div class="text-center mt-6">
        <p class="text-gray-600">
            Already have an account?
            <a href="{{ route('login') }}" class="text-teal-600 hover:text-teal-800 font-medium">
                Sign in here
            </a>
        </p>
    </div>
</x-guest-layout>