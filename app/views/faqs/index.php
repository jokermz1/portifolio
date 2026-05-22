<?php $pageTitle = 'FAQs — ' . APP_NAME; ?>

    <!-- ═══ PAGE TITLE ══════════════════════════════════════════ -->
    <section id="page-title" class="padding-medium pb-0">
        <div class="container text-white">
            <div class="row justify-content-center text-center">
                <div class="col-xl-8">
                    <p class="letter-space text-primary fs-5" data-aos="fade-up" data-aos-duration="1000">
                        <a href="<?= BASE_URL ?>/" class="text-primary text-decoration-none">Home</a>
                        <span class="mx-2 text-muted">›</span>
                        <span class="text-white">FAQs</span>
                    </p>
                    <h2 class="banner-size display-1" data-aos="fade-up" data-aos-duration="1200">
                        FAQs<span class="text-primary">.</span>
                    </h2>
                    <p class="text-muted" data-aos="fade-up" data-aos-duration="1400">
                        Find answers to the most common questions about working with me.
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

            <section id="faqs-section" class="padding-medium">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9">

                            <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
                                <h3 class="display-3 mb-3">Frequently Asked Questions<span class="text-primary">.</span></h3>
                                <p class="text-muted">Can't find what you're looking for?
                                    <a href="<?= BASE_URL ?>/contact" class="text-primary text-decoration-none">Send us a message</a>.
                                </p>
                            </div>

                            <?php if (!empty($faqs)): ?>
                            <div class="accordion" id="faqAccordion" data-aos="fade-up" data-aos-duration="1000">
                                <?php foreach ($faqs as $i => $faq): ?>
                                <div class="accordion-item border border-light border-opacity-25 mb-3 rounded-4 overflow-hidden"
                                     style="background: rgba(255,255,255,0.04);">
                                    <h2 class="accordion-header" id="heading<?= $faq['id'] ?>">
                                        <button class="accordion-button <?= $i > 0 ? 'collapsed' : '' ?>"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapse<?= $faq['id'] ?>"
                                                aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>"
                                                aria-controls="collapse<?= $faq['id'] ?>"
                                                style="background: transparent; color: #fff; box-shadow: none; font-size: 1.15rem; font-weight: 400; padding: 1.4rem 1.5rem; letter-spacing: 0.01em;">
                                            <span class="text-primary me-4 fw-lighter" style="font-size: 1.6rem; line-height: 1; min-width: 2.5rem;">
                                                <?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?>
                                            </span>
                                            <?= htmlspecialchars($faq['question']) ?>
                                        </button>
                                    </h2>
                                    <div id="collapse<?= $faq['id'] ?>"
                                         class="accordion-collapse collapse <?= $i === 0 ? 'show' : '' ?>"
                                         aria-labelledby="heading<?= $faq['id'] ?>"
                                         data-bs-parent="#faqAccordion">
                                        <div class="accordion-body pb-4" style="border-top: 1px solid rgba(255,255,255,0.08); padding-left: 5.5rem; font-size: 1rem; line-height: 1.85; opacity: 0.8;">
                                            <?= nl2br(htmlspecialchars($faq['answer'])) ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php else: ?>
                            <div class="text-center py-5">
                                <p class="text-muted fs-5">No FAQs available yet.</p>
                            </div>
                            <?php endif; ?>

                        </div>
                    </div>

                    <!-- CTA -->
                    <div class="text-center mt-5 pt-3" data-aos="fade-up" data-aos-duration="1200">
                        <h3 class="display-5 mb-4">Still have questions?<span class="text-primary">.</span></h3>
                        <a href="<?= BASE_URL ?>/contact"
                           class="btn button rounded-pill position-relative pe-5">
                            <span>Get in Touch</span>
                            <div class="position-absolute top-50 end-0 translate-middle-y me-2">
                                <svg class="arrow-right bg-white text-black rounded-circle p-2" width="35" height="35">
                                    <use xlink:href="#arrow-right"></use>
                                </svg>
                            </div>
                        </a>
                    </div>

                </div>
            </section>

        </div><!-- /border card -->
    </div><!-- /container-fluid -->
