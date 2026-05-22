<?php $pageTitle = 'Services — ' . APP_NAME; ?>

    <!-- ═══ PAGE TITLE ══════════════════════════════════════════ -->
    <section id="page-title" class="padding-medium pb-0">
        <div class="container text-white">
            <div class="row justify-content-center text-center">
                <div class="col-xl-8">
                    <p class="letter-space text-primary fs-5" data-aos="fade-up" data-aos-duration="1000">
                        <a href="<?= BASE_URL ?>/" class="text-primary text-decoration-none">Home</a>
                        <span class="mx-2 text-muted">›</span>
                        <span class="text-white">Services</span>
                    </p>
                    <h2 class="banner-size display-1" data-aos="fade-up" data-aos-duration="1200">
                        Services<span class="text-primary">.</span>
                    </h2>
                    <p class="text-muted" data-aos="fade-up" data-aos-duration="1400">
                        From concept to creation — I deliver end-to-end design solutions tailored to your brand.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid padding-side position-relative mt-5">
        <div class="position-absolute top-0 start-50 translate-middle d-none d-xxl-block">
            <img src="<?= BASE_URL ?>/images/bg-pattern.png" alt="bg-img" class="image-fluid">
        </div>

        <div class="border border-light border-opacity-25 rounded-5"
             style="background-color: rgba(255,255,255,0.06); box-shadow: 0px 12px 90px rgba(106,30,188,0.2);">

            <!-- ═══ SERVICES GRID ════════════════════════════════ -->
            <section id="services-list" class="padding-medium">
                <div class="container">

                    <?php if (!empty($services)): ?>
                    <div class="row g-4">
                        <?php foreach ($services as $i => $service): ?>
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="<?= 800 + $i * 200 ?>">
                            <div class="border border-light border-opacity-25 rounded-4 p-4 p-lg-5 h-100 d-flex flex-column"
                                 style="background: rgba(255,255,255,0.04); transition: all 0.3s ease;">

                                <!-- Number -->
                                <p class="display-1 fw-lighter text-primary mb-0 lh-1"
                                   style="font-size: 5rem; opacity: 0.35;">
                                    <?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?>
                                </p>

                                <hr class="border-light border-opacity-25 my-4">

                                <!-- Icon -->
                                <?php if (!empty($service['icon'])): ?>
                                <div class="mb-3">
                                    <iconify-icon icon="<?= htmlspecialchars($service['icon']) ?>"
                                                  class="text-primary" style="font-size: 2.5rem;"></iconify-icon>
                                </div>
                                <?php endif; ?>

                                <!-- Title -->
                                <h3 class="display-6 mb-3">
                                    <?= htmlspecialchars($service['title']) ?>
                                </h3>

                                <!-- Description -->
                                <?php if (!empty($service['description'])): ?>
                                <p class="text-muted flex-grow-1">
                                    <?= htmlspecialchars($service['description']) ?>
                                </p>
                                <?php endif; ?>

                                <!-- Learn More -->
                                <div class="mt-4">
                                    <a href="<?= BASE_URL ?>/services/<?= (int) $service['id'] ?>"
                                       class="btn button rounded-pill position-relative pe-5">
                                        <span>Learn More</span>
                                        <div class="position-absolute top-50 end-0 translate-middle-y me-2">
                                            <svg class="arrow-right bg-white text-black rounded-circle p-2" width="35" height="35">
                                                <use xlink:href="#arrow-right"></use>
                                            </svg>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div><!-- /row -->

                    <?php else: ?>
                    <div class="text-center py-5" data-aos="fade-up">
                        <p class="text-muted fs-5">No services available yet. Check back soon!</p>
                    </div>
                    <?php endif; ?>

                </div>
            </section>

            <!-- ═══ CTA ══════════════════════════════════════════ -->
            <section id="cta" class="padding-medium pt-0">
                <div class="container text-center" data-aos="fade-up" data-aos-duration="1000">
                    <h3 class="display-3 mb-4">
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
            </section>

        </div><!-- /border card -->
    </div><!-- /container-fluid -->
