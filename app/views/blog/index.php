<?php $pageTitle = 'Blog — ' . APP_NAME; ?>

    <!-- ═══ PAGE TITLE ══════════════════════════════════════════ -->
    <section id="page-title" class="padding-medium pb-0">
        <div class="container text-white">
            <div class="row justify-content-center text-center">
                <div class="col-xl-8">
                    <p class="letter-space text-primary fs-5" data-aos="fade-up" data-aos-duration="1000">
                        <a href="<?= BASE_URL ?>/" class="text-primary text-decoration-none"><?= e_t('Home') ?></a>
                        <span class="mx-2 text-muted">›</span>
                        <span class="text-white"><?= e_t('Blog') ?></span>
                    </p>
                    <h2 class="banner-size display-1" data-aos="fade-up" data-aos-duration="1200">
                        <?= e_t('Our Blog') ?><span class="text-primary">.</span>
                    </h2>
                    <p class="text-muted" data-aos="fade-up" data-aos-duration="1400">
                        <?= e_t('Insights, updates and stories from our creative journey.') ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ BLOG POSTS ═══════════════════════════════════════════ -->
    <section id="blog-posts" class="padding-medium position-relative">

        <!-- Padrão decorativo subtil (só em ecrãs grandes) -->
        <div class="position-absolute top-0 start-50 translate-middle-x d-none d-xxl-block"
             style="pointer-events:none; opacity:.45;">
            <img src="<?= BASE_URL ?>/images/bg-pattern.png" alt="" class="image-fluid">
        </div>

        <div class="container position-relative">

            <?php if (!empty($posts)): ?>
            <div class="row g-5 gy-lg-5" data-aos="fade-up" data-aos-duration="1000">

                <?php foreach ($posts as $post):
                    $postUrl  = BASE_URL . '/blog/' . htmlspecialchars($post['slug']);
                    $postDate = date('d M Y', strtotime($post['published_at'] ?? $post['created_at']));
                ?>
                <div class="col-lg-4 col-md-6">
                    <article class="post-card">

                        <!-- Image -->
                        <a href="<?= $postUrl ?>" class="post-card__media">
                            <?php if (!empty($post['category'])): ?>
                                <span class="post-card__tag"><?= htmlspecialchars($post['category']) ?></span>
                            <?php endif; ?>
                            <?php if (!empty($post['image'])): ?>
                                <img src="<?= UPLOAD_URL ?>posts/<?= htmlspecialchars($post['image']) ?>"
                                     alt="<?= htmlspecialchars($post['title']) ?>" loading="lazy">
                            <?php else: ?>
                                <img src="<?= BASE_URL ?>/images/blog/blog-placeholder.jpg"
                                     alt="<?= htmlspecialchars($post['title']) ?>" loading="lazy">
                            <?php endif; ?>
                        </a>

                        <!-- Date -->
                        <p class="post-card__date"><?= htmlspecialchars($postDate) ?></p>

                        <!-- Title -->
                        <h3 class="post-card__title">
                            <a href="<?= $postUrl ?>"><?= htmlspecialchars($post['title']) ?></a>
                        </h3>

                        <!-- Excerpt -->
                        <?php if (!empty($post['excerpt'])): ?>
                        <p class="post-card__excerpt"><?= htmlspecialchars($post['excerpt']) ?></p>
                        <?php endif; ?>

                        <!-- Read More -->
                        <a href="<?= $postUrl ?>" class="read-more-link">
                            <span><?= e_t('Read more') ?></span>
                            <svg width="18" height="18"><use xlink:href="#arrow-right"></use></svg>
                        </a>

                    </article>
                </div>
                <?php endforeach; ?>

            </div><!-- /row -->

            <?php else: ?>
            <div class="text-center py-5" data-aos="fade-up">
                <p class="text-muted fs-5"><?= e_t('No posts published yet. Check back soon!') ?></p>
            </div>
            <?php endif; ?>

            <!-- ═══ PAGINATION ══════════════════════════════════════ -->
            <?php if ($totalPages > 1): ?>
            <div class="d-flex justify-content-center mt-5 pt-4" data-aos="fade-up" data-aos-duration="1200">
                <nav aria-label="Blog pagination">
                    <ul class="pagination blog-pagination gap-2 mb-0">

                        <!-- Previous -->
                        <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link rounded-pill px-4 py-2"
                               href="<?= BASE_URL ?>/blog?page=<?= $page - 1 ?>">
                                <?= e_t('Previous') ?>
                            </a>
                        </li>

                        <!-- Page numbers -->
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                            <a class="page-link rounded-pill px-3 py-2"
                               href="<?= BASE_URL ?>/blog?page=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                        <?php endfor; ?>

                        <!-- Next -->
                        <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link rounded-pill px-4 py-2"
                               href="<?= BASE_URL ?>/blog?page=<?= $page + 1 ?>">
                                <?= e_t('Next') ?>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
            <?php endif; ?>

        </div><!-- /container -->
    </section>
