<x-layout>
  <x-card>
    <form action="/users" method="post" class="mx-auto my-0 px-8 pt-6 pb-8 mb-4">
      @csrf
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
          Name
        </label>
        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          id="username" name="name" type="text" placeholder="Name" value="{{ old('name') }}">
        @error('name')
        <div class="text-red-700 text-xs mt-3">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
          Email
        </label>
        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          id="email" name="email" type="email" placeholder="Email" value="{{ old('email') }}">
        @error('email')
        <div class="text-red-700 text-xs mt-3">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
          Password
        </label>
        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          id="password" name="password" type="password" placeholder="Password">
        @error('password')
        <div class="text-red-700 text-xs mt-3">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
          Password Confirm
        </label>
        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          id="password_confirmation" name="password_confirmation" type="password" placeholder="Password">
        @error('password_confirmation')
        <div class="text-red-700 text-xs mt-3">{{ $message }}</div>
        @enderror
      </div>
      <div class="flex items-center justify-between">
        <button
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          type="submit">
          Register
        </button>
        <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="/login">
          Have account?
        </a>
      </div>
    </form>
  </x-card>
</x-layout>