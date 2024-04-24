@extends('layouts.index')

@section('content')

    <section class="blog spad">
        <div class="container">
            <div class="row">
                <h3 class="text-black mb-4 ml-4">{{$title}}</h3>
            </div>

            <div class="product__details__tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab" aria-selected="true">Tin tức thể thao</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab" aria-selected="false">BXH Premier League </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tabs-5" role="tabpanel">
                        <div class="row mt-4">
                            @foreach ($items as $item)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="blog__item">
                                        @php
                                            $attachments = $item->get_enclosures();
                                            $image_url = '';
                                            if (!empty($attachments) && isset($attachments[0])) {
                                                $image_url = $attachments[0]->get_link();
                                            }
                                            $new_url = str_replace('&amp;', '&', $image_url);
                                        @endphp
                                        <div class="blog__item__pic set-bg" data-setbg="{{$new_url}}" style="background-image: url(&quot;img/blog/blog-1.jpg&quot;);"></div>
                                        <div class="blog__item__text">
                                            <span><img src="" alt="">{{ $item->get_date('j F Y | g:i a') }}</span>
                                            <h5>{{ $item->get_title() }}</h5>
                                            <a style="text-transform: initial; letter-spacing: 0px ; font-family: 'Nunito Sans', sans-serif !important; " href="{{ $item->get_permalink() }}">Đọc chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane" id="tabs-6" role="tabpanel">
                        <div class="product__details__tab__content">
                            <div class="row mt-4 justify-content-center">
                                <iframe id="sofa-standings-embed-1-52186" src="https://widgets.sofascore.com/embed/tournament/1/season/52186/standings/Premier%20League?widgetTitle=Premier%20League&showCompetitionLogo=true&v=2" style=height:1031px!important;max-width:768px!important;width:100%!important; frameborder="0" scrolling="no"></iframe>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabs-7" role="tabpanel">
                        <div class="product__details__tab__content">
                            <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                pharetras loremos.</p>
                            <div class="product__details__tab__content__item">
                                <h5>Products Infomation</h5>
                                <p>A Pocket PC is a handheld computer, which features many of the same
                                    capabilities as a modern PC. These handy little devices allow
                                    individuals to retrieve and store e-mail messages, create a contact
                                    file, coordinate appointments, surf the internet, exchange text messages
                                    and more. Every product that is labeled as a Pocket PC must be
                                    accompanied with specific software to operate the unit and must feature
                                    a touchscreen and touchpad.</p>
                                <p>As is the case with any new technology product, the cost of a Pocket PC
                                    was substantial during it’s early release. For approximately $700.00,
                                    consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                    These days, customers are finding that prices have become much more
                                    reasonable now that the newness is wearing off. For approximately
                                    $350.00, a new Pocket PC can now be purchased.</p>
                            </div>
                            <div class="product__details__tab__content__item">
                                <h5>Material used</h5>
                                <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                    from synthetic materials, not natural like wool. Polyester suits become
                                    creased easily and are known for not being breathable. Polyester suits
                                    tend to have a shine to them compared to wool and cotton suits, this can
                                    make the suit look cheap. The texture of velvet is luxurious and
                                    breathable. Velvet is a great choice for dinner party jacket and can be
                                    worn all year round.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
