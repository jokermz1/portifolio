<?php $pageTitle = htmlspecialchars($settings['site_name'] ?? APP_NAME); ?>

    <!-- ═══ HERO ═══════════════════════════════════════════════════ -->
    <section id="hero" class="padding-medium">
        <div class="container text-white">
            <div class="row justify-content-center text-center">
                <div class="col-xl-8">
                    <p class="letter-space text-primary fs-4" data-aos="fade-up" data-aos-duration="1000">
                        Hi, I'm <?= htmlspecialchars($settings['owner_name'] ?? 'Kimi Lewis') ?>
                    </p>
                    <h2 class="banner-size display-1" data-aos="fade-up" data-aos-duration="1200">
                        <?= htmlspecialchars($settings['owner_title'] ?? 'Logo & Web Designer') ?>
                    </h2>
                    <p data-aos="fade-up" data-aos-duration="1400">
                        <?= htmlspecialchars($settings['hero_text'] ?? '') ?>
                    </p>
                    <a href="<?= BASE_URL ?>/portfolio"
                       class="btn button rounded-pill mt-4 position-relative pe-5 z-1"
                       data-aos="fade-up" data-aos-duration="1600">
                        <span>view all works</span>
                        <div class="position-absolute top-50 end-0 translate-middle-y me-2">
                            <svg class="arrow-right bg-white text-black rounded-circle p-2" width="35" height="35">
                                <use xlink:href="#arrow-right"></use>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid padding-side position-relative">
        <div class="position-absolute top-0 start-50 translate-middle d-none d-xxl-block">
            <img src="<?= BASE_URL ?>/images/bg-pattern.png" alt="bg-img" class="image-fluid">
        </div>
        <div class="position-absolute top-100 start-50 translate-middle d-none d-xxl-block">
            <img src="<?= BASE_URL ?>/images/bg-pattern.png" alt="bg-img" class="image-fluid">
        </div>

        <div class="border border-light border-opacity-25 rounded-5"
             style="background-color: rgba(255,255,255,0.06); box-shadow: 0px 12px 90px rgba(106,30,188,0.2);">

            <!-- ═══ ACHIEVEMENTS ════════════════════════════════════ -->
            <section id="achievements" class="padding-medium">
                <div class="process-content container" data-aos="fade-up">
                    <div id="counter" class="row justify-content-center text-center">
                        <div class="col-lg-3 col-6 text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <h4 class="counter-value display-1 banner-size"
                                    data-count="<?= htmlspecialchars($settings['years_experience'] ?? '25') ?>">0</h4>
                                <span class="text-primary display-1 fw-lighter">+</span>
                            </div>
                            <p class="text-capitalize mb-0">years experience</p>
                        </div>
                        <div class="col-lg-3 col-6 text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <h4 class="counter-value display-1 banner-size"
                                    data-count="<?= htmlspecialchars($settings['clients'] ?? '390') ?>">0</h4>
                                <span class="text-primary display-1 fw-lighter">+</span>
                            </div>
                            <p class="text-capitalize mb-0">Satisfied clients</p>
                        </div>
                        <div class="col-lg-3 col-6 text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <h4 class="counter-value display-1 banner-size"
                                    data-count="<?= htmlspecialchars($settings['projects_done'] ?? '550') ?>">0</h4>
                                <span class="text-primary display-1 fw-lighter">+</span>
                            </div>
                            <p class="text-capitalize mb-0">Projects done</p>
                        </div>
                        <div class="col-lg-3 col-6 text-center">
                            <h4 class="counter-value display-1 banner-size"
                                data-count="<?= htmlspecialchars($settings['awards'] ?? '15') ?>">0</h4>
                            <p class="text-capitalize mb-0">Winning awards</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ═══ SKILLS ══════════════════════════════════════════ -->
            <section id="experiences">
                <div class="container">
                    <div class="row" data-aos="fade-up" data-aos-duration="1500">
                        <div class="col-lg-6 mb-5 mb-lg-0">
                            <h3 class="display-3 mb-4">Core Skills<span class="text-primary">.</span></h3>
                            <div class="row g-3">
                            <?php if (!empty($skills)): ?>
                                <?php foreach ($skills as $category => $categorySkills): ?>
                                    <?php foreach ($categorySkills as $skill): ?>
                                    <div class="col-6">
                                        <div class="border-start border-primary ps-3 border-opacity-50 h-100 d-flex align-items-center">
                                            <h5 class="fs-4 mb-0"><?= htmlspecialchars($skill['name']) ?></h5>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <?php foreach (['Logo Design','Web Design','Brand Identity','UI/UX Prototyping'] as $sk): ?>
                                    <div class="col-6">
                                        <div class="border-start border-primary ps-3 border-opacity-50 h-100 d-flex align-items-center">
                                            <h5 class="fs-4 mb-0"><?= $sk ?></h5>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <h3 class="display-3 mb-4">Services<span class="text-primary">.</span></h3>
                            <?php if (!empty($services)): ?>
                                <?php foreach ($services as $svc): ?>
                                <div class="border-start border-primary ps-3 border-opacity-50 mb-5">
                                    <h5 class="display-6"><?= htmlspecialchars($svc['title']) ?></h5>
                                    <?php if (!empty($svc['description'])): ?>
                                        <p><?= htmlspecialchars($svc['description']) ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ═══ PORTFOLIO ═══════════════════════════════════════ -->
            <section id="portfolio" class="padding-medium container" data-aos="fade-up">
                <div class="text-center">
                    <h3 class="display-3">Latest projects<span class="text-primary">.</span></h3>
                    <p>Here's a showcase of some of my favorite projects.<br>
                       Each design tells a unique story and reflects the client's brand essence.</p>

                    <?php
                    // Recolhe categorias únicas dos projetos
                    $categories = [];
                    foreach ($projects as $p) {
                        $cat = $p['category'] ?? 'other';
                        if ($cat && !in_array($cat, $categories)) $categories[] = $cat;
                    }
                    ?>
                    <?php if (!empty($categories)): ?>
                    <div class="my-5">
                        <p>
                            <button class="filter-button py-3 px-5 me-2 mb-3 active" data-filter="*">All</button>
                            <?php foreach ($categories as $cat): ?>
                                <button class="filter-button py-3 px-5 me-2 mb-3"
                                        data-filter=".<?= htmlspecialchars(strtolower(preg_replace('/\s+/', '-', $cat))) ?>">
                                    <?= htmlspecialchars($cat) ?>
                                </button>
                            <?php endforeach; ?>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="isotope-container row">
                    <?php if (!empty($projects)): ?>
                        <?php foreach ($projects as $p):
                            $catClass = strtolower(preg_replace('/\s+/', '-', $p['category'] ?? 'other'));
                        ?>
                        <div class="item <?= htmlspecialchars($catClass) ?> col-md-6 p-3">
                            <div class="blog-post">
                                <div class="image-zoom rounded-3">
                                    <a href="<?= BASE_URL ?>/portfolio/<?= htmlspecialchars($p['slug']) ?>" class="blog-img">
                                        <?php if (!empty($p['image'])): ?>
                                            <img src="<?= UPLOAD_URL ?>projects/<?= htmlspecialchars($p['image']) ?>"
                                                 alt="<?= htmlspecialchars($p['title']) ?>" class="img-fluid">
                                        <?php else: ?>
                                            <img src="<?= BASE_URL ?>/images/project1.jpg"
                                                 alt="<?= htmlspecialchars($p['title']) ?>" class="img-fluid">
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <p class="text-uppercase text-primary fw-semibold mt-3">
                                    <?= htmlspecialchars($p['category'] ?? '') ?>
                                </p>
                                <h5 class="display-6">
                                    <a href="<?= BASE_URL ?>/portfolio/<?= htmlspecialchars($p['slug']) ?>">
                                        <?= htmlspecialchars($p['title']) ?>
                                    </a>
                                </h5>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- Placeholder enquanto não há projetos -->
                        <?php
                        $placeholders = [
                            ['project1.jpg','Web design','Ecommerce site Website Template'],
                            ['project2.jpg','Web design','CryptoCode Crypto currency template'],
                            ['project3.jpg','Web design','Modish Fashion Store Website'],
                            ['project4.jpg','Web design','DashLite Admin Dashboard Figma'],
                            ['project5.jpg','Web design','Beanie Coffee Shop Redesign'],
                            ['project6.jpg','Web design','Chris Lee brand designer portfolio'],
                        ];
                        foreach ($placeholders as $ph):
                        ?>
                        <div class="item web col-md-6 p-3">
                            <div class="blog-post">
                                <div class="image-zoom rounded-3">
                                    <a href="<?= BASE_URL ?>/portfolio" class="blog-img">
                                        <img src="<?= BASE_URL ?>/images/<?= $ph[0] ?>" alt="img" class="img-fluid">
                                    </a>
                                </div>
                                <p class="text-uppercase text-primary fw-semibold mt-3"><?= $ph[1] ?></p>
                                <h5 class="display-6"><a href="<?= BASE_URL ?>/portfolio"><?= $ph[2] ?></a></h5>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="text-center">
                    <a href="<?= BASE_URL ?>/portfolio"
                       class="btn button rounded-pill mt-4 position-relative pe-5">
                        <span>view all projects</span>
                        <div class="position-absolute top-50 end-0 translate-middle-y me-2">
                            <svg class="arrow-right bg-white text-black rounded-circle p-2" width="35" height="35">
                                <use xlink:href="#arrow-right"></use>
                            </svg>
                        </div>
                    </a>
                </div>
            </section>

            <!-- ═══ TESTIMONIALS ════════════════════════════════════ -->
            <section id="testimonial" class="padding-medium pt-0">
                <div class="container position-relative" data-aos="fade-up" data-aos-duration="1500">
                    <div class="text-center">
                        <h3 class="display-3">Read our clients reviews<span class="text-primary">.</span></h3>
                    </div>

                    <div class="row justify-content-center mt-4">
                        <div class="col-md-7">
                            <div class="swiper testimonial-swiper">
                                <div class="swiper-wrapper">
                                    <?php if (!empty($testimonials)): ?>
                                        <?php foreach ($testimonials as $t): ?>
                                        <div class="swiper-slide text-center">
                                            <div class="testimonial-details">
                                                <svg class="text-primary" width="80" height="80">
                                                    <use xlink:href="#quote-left"></use>
                                                </svg>
                                                <?php if (!empty($t['rating'])): ?>
                                                <div class="mb-2 fs-5">
                                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                                        <i class="bi bi-star<?= $i <= (int) $t['rating'] ? '-fill' : '' ?> text-primary"></i>
                                                    <?php endfor; ?>
                                                </div>
                                                <?php endif; ?>
                                                <p class="fs-2 lh-base fst-italic fw-light">
                                                    <?= htmlspecialchars($t['content']) ?>
                                                </p>
                                                <div class="text-center mt-4">
                                                    <?php $avatarFile = $t['user_avatar'] ?? ($t['avatar'] ?? ''); ?>
                                                    <?php if (!empty($avatarFile)): ?>
                                                        <img src="<?= UPLOAD_URL ?>avatars/<?= htmlspecialchars($avatarFile) ?>"
                                                             alt="<?= htmlspecialchars($t['name']) ?>" class="img-fluid rounded-circle"
                                                             style="width:70px;height:70px;object-fit:cover;">
                                                    <?php else: ?>
                                                        <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white fw-bold"
                                                              style="width:70px;height:70px;font-size:1.6rem;">
                                                            <?= htmlspecialchars(mb_strtoupper(mb_substr($t['name'], 0, 1))) ?>
                                                        </span>
                                                    <?php endif; ?>
                                                    <div class="mt-2">
                                                        <p class="m-0 fw-bold"><?= htmlspecialchars($t['name']) ?></p>
                                                        <?php $sub = trim(($t['role'] ?? '') . (($t['role'] && $t['location']) ? ' · ' : '') . ($t['location'] ?? '')); ?>
                                                        <?php if ($sub): ?>
                                                            <p class="m-0 fw-light"><?= htmlspecialchars($sub) ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <?php
                                        $defaultReviews = [
                                            ['commentor3.jpg', $settings['testimonial_1'] ?? "Kiwi's designs completely transformed our branding. Her attention to detail and creativity were incredible!", $settings['testimonial_1_name'] ?? 'Emma Brown', $settings['testimonial_1_location'] ?? 'United States'],
                                            ['commentor2.jpg', $settings['testimonial_2'] ?? "Working with this designer was an amazing experience. Delivered beyond expectations!", $settings['testimonial_2_name'] ?? 'John Carter', $settings['testimonial_2_location'] ?? 'United Kingdom'],
                                            ['commentor1.jpg', $settings['testimonial_3'] ?? "Incredibly talented. The final product exceeded all our expectations — highly recommended!", $settings['testimonial_3_name'] ?? 'Sofia Martins', $settings['testimonial_3_location'] ?? 'Portugal'],
                                        ];
                                        foreach ($defaultReviews as $r):
                                        ?>
                                        <div class="swiper-slide text-center">
                                            <div class="testimonial-details">
                                                <svg class="text-primary" width="80" height="80">
                                                    <use xlink:href="#quote-left"></use>
                                                </svg>
                                                <p class="fs-2 lh-base fst-italic fw-light"><?= htmlspecialchars($r[1]) ?></p>
                                                <div class="text-center mt-4">
                                                    <img src="<?= BASE_URL ?>/images/<?= $r[0] ?>" alt="img" class="img-fluid rounded-circle">
                                                    <div class="mt-2">
                                                        <p class="m-0 fw-bold"><?= htmlspecialchars($r[2]) ?></p>
                                                        <p class="m-0 fw-light"><?= htmlspecialchars($r[3]) ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="swiper-pagination position-static mt-4 d-lg-none d-block"></div>
                            </div>
                        </div>
                    </div>

                    <div class="position-absolute top-50 end-0 translate-middle-y me-5 mt-5 pt-5 main-slider-button-next d-lg-block d-none">
                        <svg class="arrow border border-light border-opacity-25 rounded-circle p-3" width="80" height="80">
                            <use xlink:href="#arrow-right"></use>
                        </svg>
                    </div>
                    <div class="position-absolute top-50 start-0 translate-middle-y ms-5 mt-5 pt-5 main-slider-button-prev d-lg-block d-none">
                        <svg class="arrow border border-light border-opacity-25 rounded-circle p-3" width="80" height="80">
                            <use xlink:href="#arrow-left"></use>
                        </svg>
                    </div>

                    <!-- ── Deixar uma avaliação (público) ──────────────── -->
                    <?php if (isset($flash) && $flash): ?>
                        <div class="row justify-content-center mt-5">
                            <div class="col-lg-8">
                                <div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show text-center">
                                    <?= htmlspecialchars($flash['message']) ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            </div>
                        </div>
                        <?php $flash = null; // consumido aqui para não repetir noutra secção ?>
                    <?php endif; ?>

                    <div class="text-center mt-5">
                        <?php if (!empty($user)): ?>
                        <button class="btn button rounded-pill px-5" type="button"
                                data-bs-toggle="collapse" data-bs-target="#reviewForm"
                                aria-expanded="false" aria-controls="reviewForm">
                            <span>Deixar uma avaliação</span>
                        </button>
                        <?php else: ?>
                        <a href="<?= BASE_URL ?>/login" class="btn button rounded-pill px-5">
                            <span>Deixar uma avaliação</span>
                        </a>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($user)): ?>
                    <div class="collapse mt-4" id="reviewForm">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <form action="<?= BASE_URL ?>/reviews" method="POST" class="row g-3">
                                    <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf ?? '') ?>">
                                    <div class="col-md-6">
                                        <input type="text" name="name" placeholder="O seu nome*" required
                                               value="<?= htmlspecialchars($user['name'] ?? '') ?>"
                                               class="form-control shadow-none w-100 ps-3 py-3">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="location" placeholder="Localização (ex.: Maputo)"
                                               class="form-control shadow-none w-100 ps-3 py-3">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="role" placeholder="Cargo / empresa (opcional)"
                                               class="form-control shadow-none w-100 ps-3 py-3">
                                    </div>
                                    <div class="col-md-6">
                                        <select name="rating" class="form-select shadow-none w-100 ps-3 py-3">
                                            <option value="5" selected>★★★★★ — Excelente</option>
                                            <option value="4">★★★★ — Muito bom</option>
                                            <option value="3">★★★ — Bom</option>
                                            <option value="2">★★ — Razoável</option>
                                            <option value="1">★ — Fraco</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <textarea name="content" placeholder="A sua avaliação*" required minlength="5"
                                                  class="form-control shadow-none w-100 ps-3 py-3" style="height:120px;"></textarea>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn button rounded-pill mt-2 px-5">
                                            <span>Enviar avaliação</span>
                                        </button>
                                        <p class="mt-3 fw-light"><small>A sua avaliação será publicada após revisão.</small></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </section>

        </div><!-- /border card -->
    </div><!-- /container-fluid -->

    <!-- ═══ CONTACT ═════════════════════════════════════════════ -->
    <section id="contact" class="padding-medium">
        <div class="container" data-aos="fade-up">
            <div class="text-center">
                <h3 class="display-3">Let's collaborate & design<span class="text-primary">.</span></h3>
            </div>

            <?php if (isset($flash) && $flash): ?>
                <div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'danger' ?> mt-4 alert-dismissible fade show">
                    <?= htmlspecialchars($flash['message']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <form id="contactForm" action="<?= BASE_URL ?>/contact" method="POST"
                  class="form-group contact-form row mt-5">
                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf ?? '') ?>">
                <div class="col-lg-6 mb-3">
                    <input type="text" name="name" placeholder="Full Name*"
                           class="form-control shadow-none w-100 ps-3 py-3" required>
                </div>
                <div class="col-lg-6 mb-3">
                    <input type="email" name="email" placeholder="Email*"
                           class="form-control shadow-none w-100 ps-3 py-3" required>
                </div>
                <div class="col-lg-6 mb-3">
                    <input type="text" name="subject" placeholder="Subject"
                           class="form-control shadow-none w-100 ps-3 py-3">
                </div>
                <div class="col-lg-6 mb-3">
                    <input type="text" name="phone" placeholder="Phone"
                           class="form-control shadow-none w-100 ps-3 py-3">
                </div>
                <div class="col-lg-12 mb-3">
                    <textarea name="content" placeholder="Message"
                              class="form-control shadow-none w-100 ps-3 py-3"
                              style="height:150px;" required></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn button rounded-pill mt-4 position-relative pe-5">
                        <span>Send Message</span>
                        <div class="position-absolute top-50 end-0 translate-middle-y me-2">
                            <svg class="arrow-right bg-white text-black rounded-circle p-2" width="35" height="35">
                                <use xlink:href="#arrow-right"></use>
                            </svg>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </section>
