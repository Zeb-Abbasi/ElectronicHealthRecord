
    <section id="panel" class="homepage-porfolio">
        <div class="container" id="gallery">
            <h1 class="fw-bold text-secondary text-center">Our Gallery</h1>
            <div class="works section-padding bg-gray" data-scroll-index="3">
                <div class="container-fluid">
                    <br><br>
                    <div class="row">
                        <!-- filter links -->
                        <div class="filtering text-center mb-30 col-sm-12">
                            <div class="filter d-flex flex-wrap justify-content-center">
                                <span data-filter='*' class="active m-1">All</span>
                                <span data-filter='.dental ' class="active m-1">Dental</span>
                                <span data-filter='.cardiology' class="active m-1">Cardiology</span>
                                <span data-filter='.neurology' class="active m-1">Neurology</span>
                                <span data-filter='.laboratry' class="active m-1">Laboratry</span>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <br><br><br>
                        <!-- gallery -->
                        <div class="gallery full-width">
                            <!-- gallery item -->
                            <div class="col-md-4 col-sm-6 items no-padding dental">
                                <div class="item-img">
                                    <img src="{{ asset('assets/images/gallery/gallery_01.jpg') }}" alt="image" class="lazy img-responsive">
                                    <div class="item-img-overlay">
                                        <div class="overlay-info full-width">
                                            {{-- <p>Dental | labortary</p> --}}
                                            <h3>Dental</h3>
                                            <a href="p1.jpg" class="popimg">
                                                <span class="icon"><i class="fa fa-search-plus"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- gallery item -->
                            <div class="col-md-4 col-sm-6 items no-padding cardiology">
                                <div class="item-img">
                                    <img src="{{ asset('assets/images/gallery/gallery_02.jpg') }}" alt="image" class="lazy img-responsive">
                                    <div class="item-img-overlay">
                                        <div class="overlay-info full-width">
                                            <h3>Cardiology</h3>
                                            <a href="p4.jpg" class="popimg">
                                                <span class="icon"><i class="fa fa-search-plus"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- gallery item -->
                            <div class="col-md-4 col-sm-6 items no-padding laboratry">
                                <div class="item-img">
                                    <img src="{{ asset('assets/images/gallery/gallery_03.jpg') }}" alt="image" class="lazy img-responsive">
                                    <div class="item-img-overlay">
                                        <div class="overlay-info full-width">
                                            <h3>Laboratry</h3>
                                            <a href="p2.jpg" class="popimg">
                                                <span class="icon"><i class="fa fa-search-plus"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- gallery item -->
                            <div class="col-md-4 col-sm-6 items no-padding laboratry">
                                <div class="item-img">
                                    <img src="{{ asset('assets/images/gallery/gallery_04.jpg') }}" alt="image" class="lazy img-responsive">
                                    <div class="item-img-overlay">
                                        <div class="overlay-info full-width">
                                            <h3>Laboratry</h3>
                                            <a href="p3.jpg" class="popimg">
                                                <span class="icon"><i class="fa fa-search-plus"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- gallery item -->
                            <div class="col-md-4 col-sm-6 items no-padding neurology">
                                <div class="item-img">
                                    <img src="{{ asset('assets/images/gallery/gallery_05.jpg') }}" alt="image" class="lazy img-responsive">
                                    <div class="item-img-overlay">
                                        <div class="overlay-info full-width">
                                            <h3>Neurology</h3>
                                            <a href="p3.jpg" class="popimg">
                                                <span class="icon"><i class="fa fa-search-plus"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- gallery item -->
                            <div class="col-lg- col-md-4 col-sm-6 items no-padding neurology">
                                <div class="item-img">
                                    <img src="{{ asset('assets/images/gallery/gallery_06.jpg') }}" alt="image" class="lazy img-responsive">
                                    <div class="item-img-overlay">
                                        <div class="overlay-info full-width">
                                            <h3>Neurology</h3>
                                            <a href="p3.jpg" class="popimg">
                                                <span class="icon"><i class="fa fa-search-plus"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>