<x-admin :menuList="$user->getMenuList()">
  <x-card>
    <form action="/admin/users/{{$user->id}}" method="post" class="mx-auto my-0 px-8 pt-6 pb-8 mb-4">
      @csrf
      @method('patch')
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
          Name
        </label>
        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          id="username" name="name" type="text" placeholder="Name" value="{{ $user->name }}">
        @error('name')
        <div class="text-red-700 text-xs mt-3">{{ $message }}</div>
        @enderror
      </div>

      <div class="flex items-center justify-between">
        <button
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          type="submit">
          Update
        </button>
      </div>
    </form>
  </x-card>
</x-admin>