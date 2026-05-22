<?php $pageTitle = htmlspecialchars($service['title']) . ' — Services'; ?>

    <!-- ═══ PAGE TITLE ══════════════════════════════════════════ -->
    <section id="page-title" class="padding-medium pb-0">
        <div class="container text-white">
            <div class="row justify-content-center text-center">
                <div class="col-xl-8">
                    <p class="letter-space text-primary fs-5" data-aos="fade-up" data-aos-duration="1000">
                        <a href="<?= BASE_URL ?>/" class="text-primary text-decoration-none">Home</a>
                        <span class="mx-2 text-muted">›</span>
                        <a href="<?= BASE_URL ?>/services" class="text-primary text-decoration-none">Services</a>
                        <span class="mx-2 text-muted">›</span>
                        <span class="text-white"><?= htmlspecialchars($service['title']) ?></span>
                    </p>
                    <h2 class="banner-size display-1" data-aos="fade-up" data-aos-duration="1200">
                        <?= htmlspecialchars($service['title']) ?><span class="text-primary">.</span>
                    </h2>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid padding-side position-relative mt-5">
        <div class="position-absolute top-0 start-50 translate-middle d-none d-xxl-block">
            <img src="<?= BASE_URL ?>/images/bg-pattern.png" alt="bg-img" class="image-fluid">
        </div>
        <div class="position-absolute top-100 start-50 translate-middle d-none d-xxl-block">
            <img src="<?= BASE_URL ?>/images/bg-pattern.png" alt="bg-img" class="image-fluid">
        </div>

        <div class="border border-light border-opacity-25 rounded-5"
             style="background-color: rgba(255,255,255,0.06); box-shadow: 0px 12px 90px rgba(106,30,188,0.2);">

            <section class="padding-medium">
                <div class="container">
                    <div class="row g-5">

                        <!-- ══ Main Content ══════════════════════ -->
                        <div class="col-lg-8" data-aos="fade-up" data-aos-duration="1000">

                            <!-- Intro text -->
                            <?php if (!empty($service['description'])): ?>
                            <p class="text-muted fs-5 lh-lg mb-5">
                                <?= nl2br(htmlspecialchars($service['description'])) ?>
                            </p>
                            <?php endif; ?>

                            <!-- Featured image -->
                            <?php
                                $hasImage = !empty($service['image'] ?? '');
                                $imageSrc = $hasImage
                                    ? UPLOAD_URL . 'services/' . htmlspecialchars($service['image'])
                                    : BASE_URL . '/images/portfolio-large2.jpg';
                            ?>
                            <div class="image-zoom rounded-3 overflow-hidden mb-5">
                                <img src="<?= $imageSrc ?>"
                                     class="img-fluid w-100"
                                     style="max-height: 420px; object-fit: cover;"
                                     alt="<?= htmlspecialchars($service['title']) ?>">
                            </div>

                            <!-- Blockquote -->
                            <blockquote class="border-start border-primary border-3 ps-4 py-2 mb-5"
                                        style="border-left-width: 4px !important;">
                                <svg class="text-primary mb-3" width="40" height="40">
                                    <use xlink:href="#quote-left"></use>
                                </svg>
                                <p class="fs-4 fst-italic fw-light text-white lh-lg mb-2">
                                    Every great design begins with an even better story. Let's create yours together.
                                </p>
                            </blockquote>

                            <!-- Features checklist -->
                            <h4 class="display-6 mb-4">
                                What's Included<span class="text-primary">.</span>
                            </h4>

                            <ul class="list-unstyled mb-5">
                                <?php
                                    $features = [
                                        'Initial consultation & discovery session',
                                        'Custom concept development tailored to your brand',
                                        'Multiple design revisions until you\'re satisfied',
                                        'Source files delivered in all required formats',
                                        'Post-delivery support and guidance',
                                        'Brand usage guidelines included',
                                    ];
                                ?>
                                <?php foreach ($features as $feature): ?>
                                <li class="d-flex align-items-start gap-3 mb-3">
                                    <div class="flex-shrink-0 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                             fill="currentColor" class="text-primary" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                        </svg>
                                    </div>
                                    <p class="text-muted mb-0"><?= htmlspecialchars($feature) ?></p>
                                </li>
                                <?php endforeach; ?>
                            </ul>

                            <!-- CTA inline -->
                            <div class="border border-light border-opacity-25 rounded-4 p-4 p-lg-5 text-center"
                                 style="background: rgba(119,16,233,0.12);">
                                <h3 class="display-5 mb-4">
                                    Let's collaborate &amp; design<span class="text-primary">.</span>
                                </h3>
                                <a href="<?= BASE_URL ?>/contact"
                                   class="btn button rounded-pill position-relative pe-5">
                                    <span>Send Message</span>
                                    <div class="position-absolute top-50 end-0 translate-middle-y me-2">
                                        <svg class="arrow-right bg-white text-black rounded-circle p-2" width="35" height="35">
                                            <use xlink:href="#arrow-right"></use>
                                        </svg>
                                    </div>
                                </a>
                            </div>

                        </div><!-- /col-lg-8 -->

                        <!-- ══ Sidebar ════════════════════════════ -->
                        <div class="col-lg-4" data-aos="fade-up" data-aos-duration="1200">

                            <!-- All Services list -->
                            <div class="border border-light border-opacity-25 rounded-4 p-4 mb-4"
                                 style="background: rgba(255,255,255,0.04);">
                                <h5 class="letter-space text-primary mb-4" style="font-size: 0.8rem;">All Services</h5>
                                <ul class="list-unstyled mb-0">
                                    <?php foreach ($services as $s): ?>
                                    <li class="mb-2">
                                        <a href="<?= BASE_URL ?>/services/<?= (int) $s['id'] ?>"
                                           class="d-flex align-items-center justify-content-between py-3 px-1
                                                  border-bottom border-light border-opacity-10
                                                  text-decoration-none
                                                  <?= $s['id'] === $service['id'] ? 'text-primary' : 'text-muted' ?>">
                                            <span><?= htmlspecialchars($s['title']) ?></span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor"
                                                 class="<?= $s['id'] === $service['id'] ? 'text-primary' : 'text-muted' ?>"
                                                 viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                      d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <!-- Contact CTA card -->
                            <div class="border border-primary border-opacity-50 rounded-4 p-4 p-lg-5 text-center"
                                 style="background: rgba(119,16,233,0.12);">
                                <p class="letter-space text-primary mb-3" style="font-size: 0.75rem;">Have a project?</p>
                                <h4 class="display-6 mb-4">Let's work together.</h4>
                                <a href="<?= BASE_URL ?>/contact"
                                   class="btn button rounded-pill position-relative pe-5 w-100">
                                    <span>Get in Touch</span>
                                    <div class="position-absolute top-50 end-0 translate-middle-y me-2">
                                        <svg class="arrow-right bg-white text-black rounded-circle p-2" width="35" height="35">
                                            <use xlink:href="#arrow-right"></use>
                                        </svg>
                                    </div>
                                </a>
                            </div>

                            <!-- Icon showcase -->
                            <?php if (!empty($service['icon'])): ?>
                            <div class="border border-light border-opacity-25 rounded-4 p-4 mt-4 text-center"
                                 style="background: rgba(255,255,255,0.04);">
                                <iconify-icon icon="<?= htmlspecialchars($service['icon']) ?>"
                                              class="text-primary" style="font-size: 5rem;"></iconify-icon>
                            </div>
                            <?php endif; ?>

                        </div><!-- /col-lg-4 -->

                    </div><!-- /row -->
                </div>
            </section>

        </div><!-- /border card -->
    </div><!-- /container-fluid -->
