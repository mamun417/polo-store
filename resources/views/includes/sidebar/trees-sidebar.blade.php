@if (count($main_category->children))
    <li class="nav-item ">
        <a class="nav-link collapsed text-truncate p-0 cat_br_hovLink"
           href="#submenu{{ $main_category->id }}" data-toggle="collapse"
           data-target="#submenu{{ $main_category->id }}">
            <span class="cat-items"  data-category-slug="{{ $main_category->slug }}"
                  class="catLink d-block">
                {{ ucwords($main_category->name) }}
            </span>
        </a>

        <div class="collapse " id="submenu{{ $main_category->id }}" aria-expanded="false">
            <ul class="nav cat-dropdown">
                @foreach($main_category->children as $main_category)
                    @include('includes.sidebar.trees-sidebar')
                @endforeach
            </ul>
        </div>
    </li>
@else
    <li class="nav-item">
        <a class="nav-link text-truncate p-0 cat_br_hovLink"
           href="{{ route('categories.products', $main_category->slug) }}">
            <span class="cat-items" >
                 {{ ucwords($main_category->name) }}
            </span>
        </a>
    </li>
@endif
