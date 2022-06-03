<x-layout>
  <x-card>
    <form action="/reset-password" method="post" class="mx-auto my-0 px-8 pt-6 pb-8 mb-4">
      @csrf

      <input type="hidden" name="token" value="{{$token}}">

      <div class="mb-4">
        @error('token')
        <div class="text-red-700 text-xs mt-3">{{ $message }}</div>
        @enderror
        <label class="block text-gray-700 text-sm font-bold mb-2" for="Email">
          Email
        </label>
        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          id="Email" type="email" name="email" placeholder="Email">
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
          id="password" type="password" name="password" placeholder="Password">
        @error('password')
        <div class="text-red-700 text-xs mt-3">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
          Password
        </label>
        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          id="password_confirmation" type="password" name="password_confirmation" placeholder="Password">
      </div>

      <div class="flex items-center justify-between">
        <button
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          type="submit">
          Change password
        </button>
      </div>
    </form>
  </x-card>
</x-layout>