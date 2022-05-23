<x-layout>
  <x-card>
    <form action="/restore-password" method="post" class="mx-auto my-0 px-8 pt-6 pb-8 mb-4">
      @csrf
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="code">
          Code
        </label>
        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          id="code" type="text" placeholder="Code">
      </div>

      <div class="flex items-center justify-between">
        <button
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          type="button">
          Send
        </button>
      </div>
    </form>
  </x-card>
</x-layout>