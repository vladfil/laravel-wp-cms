<x-admin :menuList="$user->getMenuList()">
  <h1 class="font-medium leading-tight text-5xl mt-0 mb-2 text-blue-600">{{$user->name}}</h1>
</x-admin>