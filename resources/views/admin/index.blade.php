<x-layout>
  <div class="flex">
    @include('admin.sidebar', ['menuList' => $menuList])
    @include('admin.content')
  </div>
</x-layout>