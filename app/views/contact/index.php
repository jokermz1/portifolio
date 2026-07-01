<?php $pageTitle = 'Contact — ' . APP_NAME; ?>

    <!-- ═══ PAGE TITLE ══════════════════════════════════════════ -->
    <section id="page-title" class="padding-medium pb-0">
        <div class="container text-white">
            <div class="row justify-content-center text-center">
                <div class="col-xl-8">
                    <p class="letter-space text-primary fs-5" data-aos="fade-up" data-aos-duration="1000">
                        <a href="<?= BASE_URL ?>/" class="text-primary text-decoration-none"><?= t('Home') ?></a>
                        <span class="mx-2 text-muted">›</span>
                        <span class="text-white"><?= t('Contact') ?></span>
                    </p>
                    <h2 class="banner-size display-1" data-aos="fade-up" data-aos-duration="1200">
                        <?= t('Contact Us') ?><span class="text-primary">.</span>
                    </h2>
                    <p class="text-muted" data-aos="fade-up" data-aos-duration="1400">
                        <?= t("Have a project in mind? Let's talk and bring your vision to life.") ?>
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

            <!-- ═══ CONTACT FORM ════════════════════════════════ -->
            <section id="contact-form" class="padding-medium">
                <div class="container" data-aos="fade-up" data-aos-duration="1500">

                    <?php if ($flash): ?>
                        <div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show mb-5" role="alert">
                            <?= htmlspecialchars($flash['message']) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <div class="row g-5">

                        <!-- Form -->
                        <div class="col-lg-7">
                            <h3 class="display-3 mb-2"><?= t('Got any questions?') ?><span class="text-primary">.</span></h3>
                            <p class="text-muted mb-5"><?= t('Use the form below to get in touch with us.') ?></p>

                            <form id="contactForm" action="<?= BASE_URL ?>/contact" method="POST"
                                  class="form-group contact-form row">
                                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

                                <div class="col-lg-6 mb-3">
                                    <input type="text" name="name" placeholder="<?= e_t('Your Name *') ?>"
                                           class="form-control shadow-none w-100 ps-3 py-3" required>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <input type="email" name="email" placeholder="<?= e_t('Your E-mail *') ?>"
                                           class="form-control shadow-none w-100 ps-3 py-3" required>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <input type="text" name="phone" placeholder="<?= e_t('Phone Number') ?>"
                                           class="form-control shadow-none w-100 ps-3 py-3">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <input type="text" name="subject" placeholder="<?= e_t('Subject') ?>"
                                           class="form-control shadow-none w-100 ps-3 py-3">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <textarea name="content" placeholder="<?= e_t('Your Message *') ?>"
                                              class="form-control shadow-none w-100 ps-3 py-3"
                                              style="height:160px;" required></textarea>
                                </div>
                                <div class="col-12 mt-2">
                                    <button type="submit"
                                            class="btn button rounded-pill position-relative pe-5">
                                        <span><?= t('Send Message') ?></span>
                                        <div class="position-absolute top-50 end-0 translate-middle-y me-2">
                                            <svg class="arrow-right bg-white text-black rounded-circle p-2" width="35" height="35">
                                                <use xlink:href="#arrow-right"></use>
                                            </svg>
                                        </div>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Contact Info -->
                        <div class="col-lg-5" data-aos="fade-up" data-aos-duration="1800">
                            <h3 class="display-3 mb-2"><?= t('Contact information') ?><span class="text-primary">.</span></h3>
                            <p class="text-muted mb-5"><?= t('Feel free to reach out through any of the channels below.') ?></p>

                            <!-- Head Office -->
                            <div class="mb-5">
                                <h5 class="text-primary fw-semibold mb-3 letter-space"><?= t('Head Office') ?></h5>

                                <?php if (!empty($settings['owner_address'])): ?>
                                <div class="d-flex align-items-start gap-3 mb-3">
                                    <div class="mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                             class="text-primary" viewBox="0 0 16 16">
                                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                                        </svg>
                                    </div>
                                    <p class="text-muted mb-0"><?= htmlspecialchars($settings['owner_address']) ?></p>
                                </div>
                                <?php endif; ?>

                                <?php if (!empty($settings['owner_phone'])): ?>
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                         class="text-primary flex-shrink-0" viewBox="0 0 16 16">
                                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58z"/>
                                    </svg>
                                    <a href="tel:<?= htmlspecialchars($settings['owner_phone']) ?>"
                                       class="text-muted text-decoration-none">
                                        <?= htmlspecialchars($settings['owner_phone']) ?>
                                    </a>
                                </div>
                                <?php endif; ?>

                                <?php if (!empty($settings['owner_email'])): ?>
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                         class="text-primary flex-shrink-0" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.708 2.825L15 11.105V5.383zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741zM1 11.105l4.708-2.897L1 5.383v5.722z"/>
                                    </svg>
                                    <a href="mailto:<?= htmlspecialchars($settings['owner_email']) ?>"
                                       class="text-muted text-decoration-none">
                                        <?= htmlspecialchars($settings['owner_email']) ?>
                                    </a>
                                </div>
                                <?php endif; ?>

                                <?php if (!empty($settings['owner_whatsapp'])):
                                    $waNumber = preg_replace('/\D+/', '', $settings['owner_whatsapp']); ?>
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                         class="text-primary flex-shrink-0" viewBox="0 0 16 16">
                                        <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                                    </svg>
                                    <a href="https://wa.me/<?= htmlspecialchars($waNumber) ?>" target="_blank" rel="noopener noreferrer"
                                       class="text-muted text-decoration-none">
                                        <?= htmlspecialchars($settings['owner_whatsapp']) ?>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>

                            <!-- Social -->
                            <div>
                                <h5 class="text-primary fw-semibold mb-3 letter-space"><?= t('Social info') ?></h5>
                                <ul class="d-flex gap-4 list-unstyled mb-0">
                                    <?php if (!empty($settings['social_facebook'])): ?>
                                    <li>
                                        <a href="<?= htmlspecialchars($settings['social_facebook']) ?>" target="_blank" class="nav-link p-0">
                                            <svg class="accent-color" width="22" height="22"><use xlink:href="#facebook"></use></svg>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['social_instagram'])): ?>
                                    <li>
                                        <a href="<?= htmlspecialchars($settings['social_instagram']) ?>" target="_blank" class="nav-link p-0">
                                            <svg class="accent-color" width="22" height="22"><use xlink:href="#instagram"></use></svg>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['social_twitter'])): ?>
                                    <li>
                                        <a href="<?= htmlspecialchars($settings['social_twitter']) ?>" target="_blank" class="nav-link p-0">
                                            <svg class="accent-color" width="22" height="22"><use xlink:href="#twitter"></use></svg>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['social_linkedin'])): ?>
                                    <li>
                                        <a href="<?= htmlspecialchars($settings['social_linkedin']) ?>" target="_blank" class="nav-link p-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="accent-color" width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                            </svg>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <!-- Default icons se não houver redes configuradas -->
                                    <?php if (empty($settings['social_facebook']) && empty($settings['social_instagram']) && empty($settings['social_twitter'])): ?>
                                    <li><a href="#" class="nav-link p-0"><svg class="accent-color" width="22" height="22"><use xlink:href="#facebook"></use></svg></a></li>
                                    <li><a href="#" class="nav-link p-0"><svg class="accent-color" width="22" height="22"><use xlink:href="#instagram"></use></svg></a></li>
                                    <li><a href="#" class="nav-link p-0"><svg class="accent-color" width="22" height="22"><use xlink:href="#twitter"></use></svg></a></li>
                                    <li><a href="#" class="nav-link p-0"><svg class="accent-color" width="22" height="22"><use xlink:href="#pinterest"></use></svg></a></li>
                                    <li><a href="#" class="nav-link p-0"><svg class="accent-color" width="22" height="22"><use xlink:href="#youtube"></use></svg></a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>

                    </div><!-- /row -->
                </div>
            </section>

        </div><!-- /border card -->
    </div><!-- /container-fluid -->
