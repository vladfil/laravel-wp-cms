@php
$url = url()->current();
@endphp

<x-admin :menuList="$menuList">


  <div class="flex">
    <form action="" method="GET" class="w-full max-w-xs">
      <div class="flex items-center border-b border-teal-500 py-2">
        <input
          class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
          type="text" placeholder="Search" name="s" aria-label="Search" value="{{$search}}">
        <button
          class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
          type="submit">
          Search
        </button>
      </div>
    </form>
  </div>

  <form action="/admin/users" method="POST">
    @csrf
    @method('delete')

    <div class="flex flex-col">
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
          <div class="overflow-hidden">
            <table class="min-w-full">
              <thead class="bg-gray-100 border-b">
                <tr>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    <input
                      class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                      type="checkbox" value="" id="flexCheckChecked">
                  </th>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Name
                  </th>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Email
                  </th>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Role
                  </th>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)

                <tr class="bg-white border-b">
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    <input
                      class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                      type="checkbox" name="users[]" value="{{$user->id}}">
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{$user->name}}
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{$user->email}}
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    editor
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    <div class="flex">
                      <a href="{{$url . '/' . $user->id .'/edit'}}"><i
                          class="fa-solid fa-user-pen mr-2 text-green-700 text-lg"></i></a>
                      <form action="{{$url . '/' . $user->id}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit"><i class="fa-solid fa-trash-can text-red-700 text-lg"></i></button>
                      </form>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="flex mb-10">
      <div class="w-full max-w-xs mr-10">
        <div class="flex items-center border-b border-teal-500 py-2">
          <div class="inline-block relative w-64">
            <select name="action"
              class="block appearance-none w-full bg-white hover:border-gray-500 px-4 py-2 pr-8 leading-tight focus:outline-none focus:shadow-outline">
              <option>Actions</option>
              <option value="deleteSelected">Delete Selected</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
              </svg>
            </div>
          </div>
          <button
            class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
            type="submit">
            Apply
          </button>
        </div>
      </div>
    </div>
  </form>

  {{ $users->withQueryString()->links() }}
</x-admin>