         <div class="swiper-slide">
                <section class="cssgrid">
                <!--<section class="cssgrid"-->
                <!--  data-infinite-scroll='{-->
                <!--    "path": ".pagination a[rel=next]",-->
                <!--    "append": ".{{ $append }}"cd -->
                <!--  }'>-->
                    @foreach($items as $item)
                        <div class="item {{ $append }}">
                            <img src="{{ $item->img}}" class="img">
                            <a href="{{ $item->url}}" class="url" target="_blank">
                                <span class="detail">商品詳細</span>
                                <span class="price" data-id="{{ $item->price}}"></span>
                                <span class="cateEn" data-id="{{ $class }}"></span>
                            </a>
                        </div>
                    @endforeach
                </section>
                {{ $items->fragment('tab-head')->links() }}
            </div>
            
