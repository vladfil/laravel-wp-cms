@props(['menuList' => []])

<x-layout>
  <div class="flex">
    <aside class="flex-initial w-64 relative" aria-label="Sidebar">
      <div class="overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-800 sticky top-0">
        <ul class="min-h-screen max-h-full">
          @foreach ($menuList as $menuItem)
          <li>
            <a href="{{$menuItem['uri']}}"
              class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
              <i class="fa-solid {{$menuItem['icon']}}"></i>
              <span class="ml-3">{{$menuItem['label']}}</span>
            </a>
          </li>
          @endforeach
        </ul>
      </div>
    </aside>

    <div class="flex-auto bg-red min-h-screen">
      {{$slot}}
    </div>
  </div>
</x-layout>