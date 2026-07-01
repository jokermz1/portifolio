<?php $pageTitle = htmlspecialchars($post['title']) . ' — Blog'; ?>

    <!-- ═══ PAGE TITLE ══════════════════════════════════════════ -->
    <section id="page-title" class="padding-medium pb-0">
        <div class="container text-white">
            <div class="row justify-content-center text-center">
                <div class="col-xl-8">
                    <p class="letter-space text-primary fs-5" data-aos="fade-up" data-aos-duration="1000">
                        <a href="<?= BASE_URL ?>/" class="text-primary text-decoration-none">Home</a>
                        <span class="mx-2 text-muted">›</span>
                        <a href="<?= BASE_URL ?>/blog" class="text-primary text-decoration-none">Blog</a>
                        <span class="mx-2 text-muted">›</span>
                        <span class="text-white"><?= htmlspecialchars($post['title']) ?></span>
                    </p>
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

                        <!-- ══ MAIN CONTENT ═══════════════════════ -->
                        <div class="col-lg-8" data-aos="fade-up" data-aos-duration="1000">

                            <!-- Featured image -->
                            <?php if (!empty($post['image'])): ?>
                            <div class="image-zoom rounded-3 overflow-hidden mb-5">
                                <img src="<?= UPLOAD_URL ?>posts/<?= htmlspecialchars($post['image']) ?>"
                                     class="img-fluid w-100"
                                     style="max-height: 460px; object-fit: cover;"
                                     alt="<?= htmlspecialchars($post['title']) ?>">
                            </div>
                            <?php endif; ?>

                            <!-- Meta -->
                            <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                                <p class="letter-space text-primary mb-0" style="font-size: 0.72rem;">
                                    <?= !empty($post['category']) ? htmlspecialchars($post['category']) : e_t('Blog') ?>
                                </p>
                                <span class="text-muted">·</span>
                                <small class="text-muted">
                                    <?= date('d M Y', strtotime($post['published_at'] ?? $post['created_at'])) ?>
                                </small>
                                <span class="text-muted">·</span>
                                <small class="text-muted"><?= count($comments) ?> <?= e_t('comment(s)') ?></small>
                            </div>

                            <!-- Title -->
                            <h1 class="display-4 text-white mb-4 lh-sm">
                                <?= htmlspecialchars($post['title']) ?>
                            </h1>

                            <!-- Excerpt -->
                            <?php if (!empty($post['excerpt'])): ?>
                            <p class="fs-5 text-muted lh-lg mb-5">
                                <?= htmlspecialchars($post['excerpt']) ?>
                            </p>
                            <?php endif; ?>

                            <!-- Content -->
                            <?php if (!empty($post['content'])): ?>
                            <div class="text-muted lh-lg mb-5 post-content">
                                <?= nl2br(htmlspecialchars($post['content'])) ?>
                            </div>
                            <?php endif; ?>

                            <!-- Blockquote pull -->
                            <blockquote class="border-start border-primary border-3 ps-4 py-2 mb-5">
                                <svg class="text-primary mb-3" width="40" height="40">
                                    <use xlink:href="#quote-left"></use>
                                </svg>
                                <p class="fs-4 fst-italic fw-light text-white lh-lg mb-0">
                                    <?= htmlspecialchars($post['excerpt'] ?? 'Every great design begins with an even better story.') ?>
                                </p>
                            </blockquote>

                            <!-- Share -->
                            <?php
                                $shareUrl   = BASE_URL . '/blog/' . htmlspecialchars($post['slug']);
                                $shareTitle = urlencode($post['title']);
                            ?>
                            <div class="d-flex flex-wrap align-items-center gap-3 mb-5">
                                <span class="letter-space text-primary" style="font-size: 0.72rem;"><?= e_t('Share:') ?></span>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($shareUrl) ?>"
                                   target="_blank" rel="noopener" class="nav-link p-0">
                                    <svg class="accent-color" width="20" height="20"><use xlink:href="#facebook"></use></svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?text=<?= $shareTitle ?>&url=<?= urlencode($shareUrl) ?>"
                                   target="_blank" rel="noopener" class="nav-link p-0">
                                    <svg class="accent-color" width="20" height="20"><use xlink:href="#twitter"></use></svg>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode($shareUrl) ?>"
                                   target="_blank" rel="noopener" class="nav-link p-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="accent-color"
                                         width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>
                            </div>

                            <!-- Prev / Next navigation -->
                            <?php if (!empty($prevNext['prev']) || !empty($prevNext['next'])): ?>
                            <div class="border border-light border-opacity-25 rounded-4 overflow-hidden mb-5"
                                 style="background: rgba(255,255,255,0.04);">
                                <div class="row g-0">
                                    <?php if (!empty($prevNext['prev'])): ?>
                                    <div class="col-6 border-end border-light border-opacity-10 p-4">
                                        <p class="letter-space text-primary mb-2" style="font-size: 0.7rem;">← <?= e_t('Previous') ?></p>
                                        <a href="<?= BASE_URL ?>/blog/<?= htmlspecialchars($prevNext['prev']['slug']) ?>"
                                           class="text-white text-decoration-none small fw-semibold">
                                            <?= htmlspecialchars($prevNext['prev']['title']) ?>
                                        </a>
                                    </div>
                                    <?php else: ?>
                                    <div class="col-6 border-end border-light border-opacity-10 p-4"></div>
                                    <?php endif; ?>

                                    <?php if (!empty($prevNext['next'])): ?>
                                    <div class="col-6 p-4 text-end">
                                        <p class="letter-space text-primary mb-2" style="font-size: 0.7rem;"><?= e_t('Next') ?> →</p>
                                        <a href="<?= BASE_URL ?>/blog/<?= htmlspecialchars($prevNext['next']['slug']) ?>"
                                           class="text-white text-decoration-none small fw-semibold">
                                            <?= htmlspecialchars($prevNext['next']['title']) ?>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>

                            <hr class="border-light border-opacity-25 mb-5">

                            <!-- Flash -->
                            <?php if (!empty($flash)): ?>
                            <div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show mb-4" role="alert">
                                <?= htmlspecialchars($flash['message']) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            <?php endif; ?>

                            <!-- Comments -->
                            <?php View::partial('comment-list', [
                                'comments'   => $comments,
                                'user'       => $user,
                                'csrf'       => $csrf,
                                'entityType' => 'post',
                                'entityId'   => $post['id'],
                            ]); ?>

                            <hr class="border-light border-opacity-25 mt-4 mb-4">

                            <?php View::partial('comment-form', [
                                'entityType' => 'post',
                                'entityId'   => $post['id'],
                                'csrf'       => $csrf,
                                'user'       => $user,
                            ]); ?>

                        </div><!-- /col-lg-8 -->

                        <!-- ══ SIDEBAR ════════════════════════════ -->
                        <div class="col-lg-4" data-aos="fade-up" data-aos-duration="1200">

                            <!-- Recent Posts -->
                            <?php if (!empty($recentPosts)): ?>
                            <div class="border border-light border-opacity-25 rounded-4 p-4 mb-4"
                                 style="background: rgba(255,255,255,0.04);">
                                <h5 class="letter-space text-primary mb-4" style="font-size: 0.8rem;"><?= e_t('Recent Posts') ?></h5>
                                <?php foreach ($recentPosts as $rp): ?>
                                <a href="<?= BASE_URL ?>/blog/<?= htmlspecialchars($rp['slug']) ?>"
                                   class="d-flex align-items-start gap-3 mb-4 text-decoration-none">
                                    <?php if (!empty($rp['image'])): ?>
                                    <img src="<?= UPLOAD_URL ?>posts/<?= htmlspecialchars($rp['image']) ?>"
                                         width="70" height="60"
                                         style="object-fit:cover; border-radius:8px; flex-shrink:0;"
                                         alt="">
                                    <?php else: ?>
                                    <div class="flex-shrink-0 rounded-3"
                                         style="width:70px;height:60px;background:rgba(119,16,233,0.2);"></div>
                                    <?php endif; ?>
                                    <div class="overflow-hidden">
                                        <p class="text-white mb-1 small fw-semibold lh-sm" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                                            <?= htmlspecialchars($rp['title']) ?>
                                        </p>
                                        <small class="text-muted">
                                            <?= date('d M Y', strtotime($rp['published_at'] ?? $rp['created_at'])) ?>
                                        </small>
                                    </div>
                                </a>
                                <?php endforeach; ?>
                                <a href="<?= BASE_URL ?>/blog" class="read-more-link mt-2">
                                    <span><?= e_t('View All Posts') ?></span>
                                    <svg width="18" height="18"><use xlink:href="#arrow-right"></use></svg>
                                </a>
                            </div>
                            <?php endif; ?>

                            <!-- Post Info -->
                            <div class="border border-light border-opacity-25 rounded-4 p-4 mb-4"
                                 style="background: rgba(255,255,255,0.04);">
                                <h5 class="letter-space text-primary mb-4" style="font-size: 0.8rem;"><?= e_t('Post Info') ?></h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="d-flex justify-content-between py-3 border-bottom border-light border-opacity-10">
                                        <span class="text-muted small"><?= e_t('Published') ?></span>
                                        <span class="text-white small fw-semibold">
                                            <?= date('d M Y', strtotime($post['published_at'] ?? $post['created_at'])) ?>
                                        </span>
                                    </li>
                                    <li class="d-flex justify-content-between py-3">
                                        <span class="text-muted small"><?= e_t('Comments') ?></span>
                                        <span class="text-white small fw-semibold"><?= count($comments) ?></span>
                                    </li>
                                </ul>
                            </div>

                            <!-- CTA card -->
                            <div class="border border-primary border-opacity-50 rounded-4 p-4 text-center"
                                 style="background: rgba(119,16,233,0.12);">
                                <p class="letter-space text-primary mb-3" style="font-size: 0.72rem;"><?= e_t('Have a project?') ?></p>
                                <h5 class="display-6 mb-4"><?= e_t("Let's work together.") ?></h5>
                                <a href="<?= BASE_URL ?>/contact"
                                   class="btn button rounded-pill position-relative pe-5 w-100">
                                    <span><?= e_t('Get in Touch') ?></span>
                                    <div class="position-absolute top-50 end-0 translate-middle-y me-2">
                                        <svg class="arrow-right bg-white text-black rounded-circle p-2" width="35" height="35">
                                            <use xlink:href="#arrow-right"></use>
                                        </svg>
                                    </div>
                                </a>
                            </div>

                        </div><!-- /col-lg-4 -->

                    </div><!-- /row -->
                </div>
            </section>

        </div><!-- /border card -->
    </div><!-- /container-fluid -->
