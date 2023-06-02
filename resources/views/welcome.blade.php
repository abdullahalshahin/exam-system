<x-guest-layout>
    <x-slot name="page_title">{{ $page_title ?? 'Home' }}</x-slot>

    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="mt-md-4">
                        <div>
                            <span class="badge bg-danger rounded-pill">New</span>
                            <span class="text-white-50 ms-1">Welcome to new landing page</span>
                        </div>
                        <h2 class="text-white fw-normal mb-4 mt-3 hero-title">
                            Online Exam System
                        </h2>

                        <p class="mb-4 font-16 text-white-50">Hyper is a fully featured dashboard and admin template
                            comes with tones of well designed UI elements, components, widgets and pages.</p>

                        @if (Route::has('login'))
                            @auth
                                @if(Auth::user()->user_type == "ADMIN")
                                    <a href="{{ url('/admin-panel/dashboard') }}" class="btn btn-success"> Dashboard <i class="mdi mdi-arrow-right ms-1"></i>
                                    </a>
                                @elseif(Auth::user()->user_type == "CLIENT")
                                    <a href="{{ url('/client-panel/dashboard') }}" class="btn btn-success"> Dashboard <i class="mdi mdi-arrow-right ms-1"></i>
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-success"> Log in Or Registration <i class="mdi mdi-arrow-right ms-1"></i>
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="text-md-end mt-3 mt-md-0">
                        <img src="{{ asset('assets/images/startup.svg') }}" alt="" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-3 pb-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1 class="mt-0"><i class="mdi mdi-frequently-asked-questions"></i></h1>
                        <h3>Frequently Asked <span class="text-primary">Questions</span></h3>
                        <p class="text-muted mt-2">Here are some of the basic types of questions for our customers. For more 
                            <br>information please contact us.</p>

                        <button type="button" class="btn btn-success btn-sm mt-2"><i class="mdi mdi-email-outline me-1"></i> Email us your question</button>
                        <button type="button" class="btn btn-info btn-sm mt-2 ms-1"><i class="mdi mdi-twitter me-1"></i> Send us a tweet</button>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-5 offset-lg-1">
                    <div>
                        <div class="faq-question-q-box">Q.</div>
                        <h4 class="faq-question text-body">Can I use this template for my client?</h4>
                        <p class="faq-answer mb-4 pb-1 text-muted">Yup, the marketplace license allows you to use this theme
                            in any end products.
                            For more information on licenses, please refere <a href="https://themes.getbootstrap.com/licenses/" target="_blank">here</a>.</p>
                    </div>

                    <div>
                        <div class="faq-question-q-box">Q.</div>
                        <h4 class="faq-question text-body">How do I get help with the theme?</h4>
                        <p class="faq-answer mb-4 pb-1 text-muted">Use our dedicated support email (support@coderthemes.com) to send your issues or feedback. We are here to help anytime.</p>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div>
                        <div class="faq-question-q-box">Q.</div>
                        <h4 class="faq-question text-body">Can this theme work with Wordpress?</h4>
                        <p class="faq-answer mb-4 pb-1 text-muted">No. This is a HTML template. It won't directly with
                            wordpress, though you can convert this into wordpress compatible theme.</p>
                    </div>

                    <div>
                        <div class="faq-question-q-box">Q.</div>
                        <h4 class="faq-question text-body">Will you regularly give updates of Hyper?</h4>
                        <p class="faq-answer mb-4 pb-1 text-muted">Yes, We will update the Hyper regularly. All the
                            future updates would be available without any cost.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-2 pb-3 bg-light-lighten border-top border-bottom border-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h3>Get In <span class="text-primary">Touch</span></h3>
                        <p class="text-muted mt-2">Please fill out the following form and we will get back to you shortly. For more 
                            <br>information please contact us.</p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mt-3">
                <div class="col-md-4">
                    <p class="text-muted"><span class="fw-bold">Customer Support:</span><br> <span class="d-block mt-1">+1 234 56 7894</span></p>
                    <p class="text-muted mt-4"><span class="fw-bold">Email Address:</span><br> <span class="d-block mt-1">info@gmail.com</span></p>
                    <p class="text-muted mt-4"><span class="fw-bold">Office Address:</span><br> <span class="d-block mt-1">4461 Cedar Street Moro, AR 72368</span></p>
                    <p class="text-muted mt-4"><span class="fw-bold">Office Time:</span><br> <span class="d-block mt-1">9:00AM To 6:00PM</span></p>
                </div>

                <div class="col-md-8">
                    <form>
                        <div class="row mt-4">
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="fullname" class="form-label">Your Name</label>
                                    <input class="form-control form-control-light" type="text" id="fullname" placeholder="Name...">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="emailaddress" class="form-label">Your Email</label>
                                    <input class="form-control form-control-light" type="email" required="" id="emailaddress" placeholder="Enter you email...">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <div class="mb-2">
                                    <label for="subject" class="form-label">Your Subject</label>
                                    <input class="form-control form-control-light" type="text" id="subject" placeholder="Enter subject...">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <div class="mb-2">
                                    <label for="comments" class="form-label">Message</label>
                                    <textarea id="comments" rows="4" class="form-control form-control-light" placeholder="Type your message here..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12 text-end">
                                <button class="btn btn-primary">Send a Message <i
                                    class="mdi mdi-telegram ms-1"></i> </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
