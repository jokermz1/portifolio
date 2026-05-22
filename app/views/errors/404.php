<?php $pageTitle = '404 — Page Not Found'; ?>

<section id="error-404" class="padding-medium" style="min-height: 80vh; display: flex; align-items: center;">
    <div class="container-fluid padding-side position-relative w-100">

        <!-- Background pattern decorations -->
        <div class="position-absolute top-50 start-50 translate-middle d-none d-xxl-block" style="pointer-events:none; z-index:0;">
            <img src="<?= BASE_URL ?>/images/bg-pattern.png" alt="" class="image-fluid opacity-50">
        </div>

        <div class="border border-light border-opacity-25 rounded-5 position-relative overflow-hidden"
             style="background-color: rgba(255,255,255,0.06); box-shadow: 0px 12px 90px rgba(106,30,188,0.2);">

            <!-- Giant blurred 404 watermark -->
            <div class="position-absolute top-50 start-50 translate-middle text-center w-100"
                 style="pointer-events:none; z-index:0; user-select:none;">
                <span class="fw-bold text-white"
                      style="font-size: clamp(12rem, 30vw, 24rem); opacity: 0.03; line-height: 1; letter-spacing: -0.05em; font-family: 'Bebas Neue', sans-serif;">
                    404
                </span>
            </div>

            <div class="padding-medium text-center position-relative" style="z-index:1;">

                <!-- Breadcrumb -->
                <p class="letter-space text-primary fs-5 mb-4" data-aos="fade-up" data-aos-duration="800">
                    <a href="<?= BASE_URL ?>/" class="text-primary text-decoration-none">Home</a>
                    <span class="mx-2 text-muted">›</span>
                    <span class="text-white">404</span>
                </p>

                <!-- The big 404 -->
                <h1 class="fw-bold text-primary lh-1 mb-0"
                    style="font-size: clamp(6rem, 18vw, 14rem); font-family: 'Bebas Neue', sans-serif; letter-spacing: -0.02em;"
                    data-aos="fade-up" data-aos-duration="1000">
                    404
                </h1>

                <!-- Divider line -->
                <div class="d-flex align-items-center justify-content-center gap-3 my-4"
                     data-aos="fade-up" data-aos-duration="1100">
                    <div style="height:1px; width:60px; background: rgba(255,255,255,0.2);"></div>
                    <svg class="text-primary" width="20" height="20">
                        <use xlink:href="#arrow-right"></use>
                    </svg>
                    <div style="height:1px; width:60px; background: rgba(255,255,255,0.2);"></div>
                </div>

                <!-- Heading -->
                <h2 class="display-3 text-white mb-3" data-aos="fade-up" data-aos-duration="1200">
                    Page Not Found<span class="text-primary">.</span>
                </h2>

                <!-- Subtitle -->
                <p class="text-muted fs-5 mb-5 mx-auto" style="max-width: 520px;"
                   data-aos="fade-up" data-aos-duration="1300">
                    Oops — the page you're looking for doesn't exist,
                    was moved, or has been removed.
                </p>

                <!-- CTA buttons -->
                <div class="d-flex flex-wrap gap-3 justify-content-center"
                     data-aos="fade-up" data-aos-duration="1400">

                    <a href="<?= BASE_URL ?>/"
                       class="btn button rounded-pill position-relative pe-5">
                        <span>Go to Homepage</span>
                        <div class="position-absolute top-50 end-0 translate-middle-y me-2">
                            <svg class="arrow-right bg-white text-black rounded-circle p-2" width="35" height="35">
                                <use xlink:href="#arrow-right"></use>
                            </svg>
                        </div>
                    </a>

                    <a href="javascript:history.back()"
                       class="btn btn-outline-light rounded-pill py-3 px-5">
                        ← Go Back
                    </a>

                </div>

                <!-- Quick links -->
                <div class="mt-5 pt-3" data-aos="fade-up" data-aos-duration="1500">
                    <p class="letter-space text-muted mb-3" style="font-size: 0.7rem;">Or explore</p>
                    <div class="d-flex flex-wrap gap-3 justify-content-center">
                        <?php
                        $links = [
                            'Portfolio' => '/portfolio',
                            'Blog'      => '/blog',
                            'Services'  => '/services',
                            'Contact'   => '/contact',
                        ];
                        ?>
                        <?php foreach ($links as $label => $href): ?>
                        <a href="<?= BASE_URL . $href ?>"
                           class="border border-light border-opacity-25 rounded-pill px-4 py-2 text-white text-decoration-none"
                           style="font-size:0.9rem; transition: all 0.3s ease; background: rgba(255,255,255,0.04);"
                           onmouseover="this.style.borderColor='rgba(119,16,233,0.7)'; this.style.color='#B775FF';"
                           onmouseout="this.style.borderColor=''; this.style.color='#fff';">
                            <?= $label ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
