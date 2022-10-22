<div>
    <div class="main-banner" id="top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content">
                        <div class="thumb">
                            <div class="inner-content">
                                <h4>Welcome to the best bookshop online!</h4>
                                <span>¡Over 10 million books available!</span>
                                <div class="main-border-button  ">
                                    <a href="{{ route('products.products-all') }}">See All Products</a>
                                </div>
                            </div>

                            <img src="http://www.imprimirmilibro.es/blog/wp-content/uploads/2014/08/portade-de-libros.jpg"
                                alt="">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4 class="text-secondary">Fantasy</h4>
                                            <span class="text-dark badge">Where everything's possible</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Fantasy</h4>
                                                <p>Here You'll find all that you dreamed
                                                </p>
                                                <div class="main-border-button">

                                                    <a href="
                                                        {{ route('products.product-category', ['category' => 1]) }}">Discover
                                                        More</a>

                                                </div>
                                            </div>
                                        </div>
                                        <img height="265px" src="{{ asset('assets/img/portada1.jpg') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4 class="text-dark">History</h4>
                                            <span class="text-dark badge ">Travel in time</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>History</h4>
                                                <p>History is always interesant
                                                </p>
                                                <div class="main-border-button">
                                                    <a href="
                                                        {{ route('products.product-category', ['category' => 8]) }}">Discover
                                                        More</a>

                                                </div>
                                            </div>
                                        </div>
                                        <img height="265px" src="{{ asset('assets/img/portada4.jpg') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4 class="text-dark">Adventure</h4>
                                            <span class="badge">Open your mind and dream big</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Adventure</h4>
                                                <p>If youre an adventurer, this category will like to you
                                                </p>
                                                <div class="main-border-button">
                                                    <a href="
                                                        {{ route('products.product-category', ['category' => 4]) }}">Discover
                                                        More</a>

                                                </div>
                                            </div>
                                        </div>
                                        <img height="265px" src="{{ asset('assets/img/portada2.jpg') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4 class="text-dark">Romance</h4>
                                            <span class="text-dark badge">Fall in love</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Romance</h4>
                                                <p>Love is everywhere, and of course, here to ♡
                                                </p>
                                                <div class="main-border-button">
                                                    <a href="
                                                        {{ route('products.product-category', ['category' => 3]) }}">Discover
                                                        More</a>

                                                </div>
                                            </div>
                                        </div>
                                        <img height="265px" src="{{ asset('assets/img/portada3.jpg') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->



    <!-- ***** Cateegory Fantasy Starts ***** -->

    {{-- @include('livewire.index.section1') --}}
    <livewire:index.section1 />

    <!-- ***** Cateegory Fantasy Area Ends ***** -->


    <!-- ***** Category Adventure  Area Starts ***** -->
    <livewire:index.section2 />
    <!-- ***** Cateegory Adventure Area Ends ***** -->

    <!-- ***** Cateegory Romance Area Starts ***** -->
    <livewire:index.section3 />
    <!-- ***** Cateegory Romance Area Ends ***** -->


    <!-- ***** Explore Area Starts ***** -->
    <section class="section" id="explore">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content">
                        <h2>Reasons to Read</h2>
                        <span>Using MRI scans, researchers have confirmedTrusted Source that reading involves a complex
                            network of circuits and signals in the brain. As your reading ability matures, those
                            networks also get stronger and more sophisticated.

                        </span>
                        <div class="quote">
                            <i class="fa fa-quote-left"></i>
                            <p>"Reading books benefits both your physical and mental health, and those benefits can last
                                a lifetime. They begin in early childhood and continue through the senior years. Here’s
                                a brief explanation of how reading books can change your brain — and your body — for the
                                better." -James Robertson</p>
                        </div>
                        <p>In one studyTrusted Source conducted in 2013, researchers used functional MRI scans to
                            measure the effect of reading a novel on the brain. Study participants read the novel
                            “Pompeii” over a period of 9 days. As tension built in the story, more and more areas of the
                            brain lit up with activity.
                        </p>
                        <p>Brain scans showed that throughout the reading period and for days afterward, brain
                            connectivity increased, especially in the somatosensory cortex, the part of the brain that
                            responds to physical sensations like movement and pain</p>
                        <div class="main-border-button">
                            <a href="https://www.healthline.com/health/benefits-of-reading-books#strengthens-the-brain">Know
                                More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="leather">
                                    <h4>Doesn' matter quantity</h4>
                                    <span>Does matter to read!</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="first-image">
                                    <img height="245px" src="{{ asset('assets/img/leyendo1.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="second-image">
                                    <img height="245px" src="{{ asset('assets/img/leyendo2.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="types">
                                    <h4>Open your mind</h4>
                                    <span>Imagine and learn </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
