<?php $pageTitle = 'Team — ' . APP_NAME; ?>

    <!-- ═══ PAGE TITLE ══════════════════════════════════════════ -->
    <section id="page-title" class="padding-medium pb-0">
        <div class="container text-white">
            <div class="row justify-content-center text-center">
                <div class="col-xl-8">
                    <p class="letter-space text-primary fs-5" data-aos="fade-up" data-aos-duration="1000">
                        <a href="<?= BASE_URL ?>/" class="text-primary text-decoration-none">Home</a>
                        <span class="mx-2 text-muted">›</span>
                        <span class="text-white">Team</span>
                    </p>
                    <h2 class="banner-size display-1" data-aos="fade-up" data-aos-duration="1200">
                        My Team<span class="text-primary">.</span>
                    </h2>
                    <p class="text-muted" data-aos="fade-up" data-aos-duration="1400">
                        The talented people behind the work — designers, strategists, and creative thinkers.
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

            <!-- ═══ TEAM GRID ═════════════════════════════════════ -->
            <section id="team-section" class="padding-medium">
                <div class="container">

                    <?php if (!empty($members)): ?>
                    <div class="row g-4">
                        <?php foreach ($members as $i => $m): ?>
                        <div class="col-lg-3 col-md-6"
                             data-aos="fade-up" data-aos-duration="<?= 800 + $i * 200 ?>">
                            <div class="text-center">

                                <!-- Photo -->
                                <div class="image-zoom rounded-4 overflow-hidden mb-4"
                                     style="aspect-ratio: 3/4;">
                                    <?php if (!empty($m['photo'])): ?>
                                    <img src="<?= UPLOAD_URL ?>team/<?= htmlspecialchars($m['photo']) ?>"
                                         class="img-fluid w-100 h-100"
                                         style="object-fit: cover;"
                                         alt="<?= htmlspecialchars($m['name']) ?>">
                                    <?php else: ?>
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center"
                                         style="background: rgba(119,16,233,0.15); min-height: 300px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64"
                                             fill="currentColor" class="text-primary opacity-50" viewBox="0 0 16 16">
                                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.029 10 8 10c-2.029 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                        </svg>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Name -->
                                <h5 class="display-6 mb-1"><?= htmlspecialchars($m['name']) ?></h5>

                                <!-- Role -->
                                <?php if (!empty($m['role'])): ?>
                                <p class="letter-space text-primary mb-3" style="font-size: 0.72rem;">
                                    <?= htmlspecialchars($m['role']) ?>
                                </p>
                                <?php endif; ?>

                                <!-- Bio -->
                                <?php if (!empty($m['bio'])): ?>
                                <p class="text-muted small mb-4 px-2">
                                    <?= htmlspecialchars($m['bio']) ?>
                                </p>
                                <?php endif; ?>

                                <!-- Social icons -->
                                <?php
                                $socials = [
                                    'social_facebook'  => 'facebook',
                                    'social_twitter'   => 'twitter',
                                    'social_instagram' => 'instagram',
                                    'social_youtube'   => 'youtube',
                                ];
                                $hasSocial = array_filter($socials, fn($k) => !empty($m[$k]), ARRAY_FILTER_USE_KEY);
                                ?>
                                <?php if (!empty($hasSocial) || !empty($m['social_linkedin'])): ?>
                                <ul class="d-flex gap-3 list-unstyled justify-content-center mb-0">
                                    <?php foreach ($socials as $field => $icon): ?>
                                        <?php if (!empty($m[$field])): ?>
                                        <li>
                                            <a href="<?= htmlspecialchars($m[$field]) ?>"
                                               target="_blank" rel="noopener" class="nav-link p-0">
                                                <svg class="accent-color" width="20" height="20">
                                                    <use xlink:href="#<?= $icon ?>"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php if (!empty($m['social_linkedin'])): ?>
                                    <li>
                                        <a href="<?= htmlspecialchars($m['social_linkedin']) ?>"
                                           target="_blank" rel="noopener" class="nav-link p-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="accent-color"
                                                 width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                            </svg>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                                <?php endif; ?>

                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <?php else: ?>
                    <div class="text-center py-5" data-aos="fade-up">
                        <p class="text-muted fs-5">No team members added yet.</p>
                    </div>
                    <?php endif; ?>

                </div>
            </section>

            <!-- ═══ CTA ══════════════════════════════════════════ -->
            <section class="padding-medium pt-0">
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
