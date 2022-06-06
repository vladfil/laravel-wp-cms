<x-admin :menuList="$user->getMenuList()">
  <h4 class="font-medium leading-tight text-2xl mt-0 mb-2 text-blue-600">Welcome, {{$user->name}}!</h4>
</x-admin>