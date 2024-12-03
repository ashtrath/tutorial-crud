<x-public-layout>
    <x-preloader />

    <header 
        id="header" 
        x-data="{ sticky: false }" 
        x-init="
            const hero = document.querySelector('#home'); 
            const triggerHeight = hero.offsetHeight - 170; 
            window.addEventListener('scroll', () => {
                sticky = window.scrollY > triggerHeight;
            });
        "
        :class="sticky && 'header-sticky'" 
        class="header"
    >
        <div class="container container-lg">
            <div class="header-nav">
                <a href="#home" class="logo">Ashtrath<span>.</span></a>
                <nav id="nav" class="nav">
                    <ul class="nav-list">
                        <li class="nav-item">
                            <a href="#home" class="nav-link active">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#about" class="nav-link">About</a>
                        </li>
                        <li class="nav-item">
                            <a href="#projects" class="nav-link">Works</a>
                        </li>
                        <li class="nav-item">
                            <a href="#certificates" class="nav-link">Certificates</a>
                        </li>
                        <li class="nav-item">
                            <a href="#contact" class="nav-link">Contact</a>
                        </li>
                    </ul>
                    <button id="nav-btn" class="nav-btn">
                        <x-css-menu id="nav-btn-img" />
                    </button>
                </nav>
            </div>
        </div>
    </header>

    <section id="home" class="hero">
        <div class="container container-lg">
            <div
                class="hero-row"
                data-aos="fade-zoom-in"
                data-aos-easing="ease-in-out"
                data-aos-delay="1800"
                data-aos-duration="2000"
            >
                <div class="hero-content">
                    <span class="hero-greeting">Hello, I am</span>
                    <h1 class="hero-heading">{{ $generals->full_name }}</h1>
                    <span class="hero-heading-subtitle">{{ $generals->job_title }}</span>
                    <div class="about-social-list">
                        <div class="social-links-row">
                            @foreach ($social_links as $social_link)
                                <a href="{{ $social_link->link ?? '#!' }}">
                                    <x-dynamic-component component="{{ $social_link->icon }}" class="text-black" />
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <a href="#projects" class="btn">My Portfolio</a>
                        <a href="#contact" class="btn btn-white">Contact Me</a>
                    </div>
                </div>
                <div class="hero-img">
                    <img
                        src="/storage/hero_images/{{ $generals->hero_image }}"
                        alt="Hero Section Image"
                    />
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="about">
        <div class="container">
            <div class="about-title">
                <h2 class="title">About Me</h2>
            </div>
            <div class="about-row">
                <div class="about-content">
                    <p class="about-descr whitespace-pre-line text-justify">{{$generals->about}}</p>
                    <div class="about-download-btn">
                        <a href="{{ '/storage/cv/' . $generals->cv_file ?? '#!' }}" target="_blank" class="btn btn-white">Download CV</a>
                    </div>
                </div>
                <div class="about-skills">
                    @foreach ($skills as $skill)
                        <div class="relative block w-full mb-12">
                            <div class="inline-block text-lg font-bold uppercase tracking-widest">{{ $skill->name }}</div>
                            <div class="inline-block text-lg font-bold uppercase tracking-widest float-right">{{ $skill->percent }}%</div>
                            <div class="h-2 bg-[--secondary-accent] before:bg-[--gray-color] before:h-2 before:absolute before:w-full before:z-[-1]" style="width: {{ $skill->percent }}%"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section id="projects" class="projects">
        <div class="container container-lg">
            <div class="projects-title">
                <h2 class="title">Works</h2>
            </div>

            <div class="projects-row">
                @foreach ($projects as $project)
                    <div class="project-box">
                        <a href="{{ $project->link ?? '#!' }}">
                            <img
                                class="project-img"
                                decoding="async"
                                src="{{ '/storage/projects/' . $project->image ?? '#!' }}"
                            />
                            <div class="project-mask">
                                <div class="project-caption">
                                    <h5 class="white">{{ $project->name }}</h5>
                                    <p class="white">{{ $project->category }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="certificates" class="projects">
        <div class="container container-lg">
            <div class="projects-title">
                <h2 class="title">Certificates</h2>
            </div>

            <div class="flex flex-wrap justify-center">
                @foreach ($certificates as $certificate)
                    <a href="{{ '/storage/certificates/' . $certificate->file ?? '#!' }}" target="_blank" class="bg-white shadow-md rounded-md p-8 transition-all duration-300 ease-in-out hover:shadow-sm hover:scale-95">
                        <h5 class="text-[--main-text-color] text-2xl font-bold tracking-wider mb-2">{{ $certificate->name }}</h5>
                        <div class="flex gap-2 items-center">
                            <p class="text-lg">{{ $certificate->initiated_by }}</p>
                            <x-css-shape-circle class="size-4" />
                            <p class="text-lg">{{ $certificate->initiated_at }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section id="contact" class="contact">
        <div class="container">
            <div class="contact-title">
                <h2 class="title">Contact</h2>
            </div>
            <div class="contact-content">
                <p>
                    Tell me about your project.
                    <br />
                    Let's talk and work together!
                </p>
            </div>

            <form data-aos="zoom-in">
                <div class="input-box">
                    <input
                        type="text"
                        name="name"
                        placeholder="Full Name"
                        required
                    />
                    <input
                        type="email"
                        name="email"
                        placeholder="Email Address"
                        required
                    />
                </div>

                <textarea
                    name="message"
                    cols="30"
                    rows="10"
                    placeholder="Your Message"
                    required
                ></textarea>
            </form>

            <div class="contact-button" data-aos="fade-up">
                <a href="#!" class="btn btn-red">Send Message</a>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-row">
                <div class="social-links-row footer-social">
                    @foreach ($social_links as $social_link)
                        <a href="{{ $social_link->link ?? '#!' }}">
                            <x-dynamic-component component="{{ $social_link->icon }}" class="text-black" />
                        </a>
                    @endforeach
                </div>

                <div class="footer-copyright">
                    <p>
                        &copy; 2024 Ashtrath. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <x-go-to-top />
</x-public-layout>
