<?php $pageTitle = 'Blog — ' . APP_NAME; ?>

    <!-- ═══ PAGE TITLE ══════════════════════════════════════════ -->
    <section id="page-title" class="padding-medium pb-0">
        <div class="container text-white">
            <div class="row justify-content-center text-center">
                <div class="col-xl-8">
                    <p class="letter-space text-primary fs-5" data-aos="fade-up" data-aos-duration="1000">
                        <a href="<?= BASE_URL ?>/" class="text-primary text-decoration-none">Home</a>
                        <span class="mx-2 text-muted">›</span>
                        <span class="text-white">Blog</span>
                    </p>
                    <h2 class="banner-size display-1" data-aos="fade-up" data-aos-duration="1200">
                        Our Blog<span class="text-primary">.</span>
                    </h2>
                    <p class="text-muted" data-aos="fade-up" data-aos-duration="1400">
                        Insights, updates and stories from our creative journey.
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

            <!-- ═══ BLOG POSTS ═══════════════════════════════════ -->
            <section id="blog-posts" class="padding-medium">
                <div class="container">

                    <?php if (!empty($posts)): ?>
                    <div class="row g-4" data-aos="fade-up" data-aos-duration="1000">

                        <?php foreach ($posts as $post): ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="blog-post">

                                <!-- Image -->
                                <div class="image-zoom rounded-3 overflow-hidden mb-4">
                                    <?php if (!empty($post['image'])): ?>
                                        <img src="<?= UPLOAD_URL ?>posts/<?= htmlspecialchars($post['image']) ?>"
                                             class="img-fluid w-100"
                                             style="height: 260px; object-fit: cover;"
                                             alt="<?= htmlspecialchars($post['title']) ?>">
                                    <?php else: ?>
                                        <img src="<?= BASE_URL ?>/images/blog/blog-placeholder.jpg"
                                             class="img-fluid w-100"
                                             style="height: 260px; object-fit: cover;"
                                             alt="<?= htmlspecialchars($post['title']) ?>">
                                    <?php endif; ?>
                                </div>

                                <!-- Meta -->
                                <p class="letter-space text-primary mb-2" style="font-size: 0.75rem;">
                                    <?= htmlspecialchars(date('d M Y', strtotime($post['published_at'] ?? $post['created_at']))) ?>
                                </p>

                                <!-- Title -->
                                <h3 class="display-6 mb-3">
                                    <a href="<?= BASE_URL ?>/blog/<?= htmlspecialchars($post['slug']) ?>"
                                       class="text-white text-decoration-none">
                                        <?= htmlspecialchars($post['title']) ?>
                                    </a>
                                </h3>

                                <!-- Excerpt -->
                                <?php if (!empty($post['excerpt'])): ?>
                                <p class="text-muted mb-4">
                                    <?= htmlspecialchars($post['excerpt']) ?>
                                </p>
                                <?php endif; ?>

                                <!-- Read More -->
                                <a href="<?= BASE_URL ?>/blog/<?= htmlspecialchars($post['slug']) ?>"
                                   class="btn button rounded-pill position-relative pe-5">
                                    <span>Read more</span>
                                    <div class="position-absolute top-50 end-0 translate-middle-y me-2">
                                        <svg class="arrow-right bg-white text-black rounded-circle p-2" width="35" height="35">
                                            <use xlink:href="#arrow-right"></use>
                                        </svg>
                                    </div>
                                </a>

                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div><!-- /row -->

                    <?php else: ?>
                    <div class="text-center py-5" data-aos="fade-up">
                        <p class="text-muted fs-5">No posts published yet. Check back soon!</p>
                    </div>
                    <?php endif; ?>

                    <!-- ═══ PAGINATION ══════════════════════════════ -->
                    <?php if ($totalPages > 1): ?>
                    <div class="d-flex justify-content-center mt-5 pt-3" data-aos="fade-up" data-aos-duration="1200">
                        <nav aria-label="Blog pagination">
                            <ul class="pagination pagination-dark gap-2 mb-0">

                                <!-- Previous -->
                                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                    <a class="page-link rounded-pill px-4 py-2 border border-light border-opacity-25"
                                       href="<?= BASE_URL ?>/blog?page=<?= $page - 1 ?>"
                                       style="background: rgba(255,255,255,0.06); color: #fff;">
                                        Previous
                                    </a>
                                </li>

                                <!-- Page numbers -->
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                                    <a class="page-link rounded-pill px-3 py-2 border border-light border-opacity-25"
                                       href="<?= BASE_URL ?>/blog?page=<?= $i ?>"
                                       style="<?= $i === $page
                                           ? 'background: var(--bs-primary); border-color: var(--bs-primary); color: #fff;'
                                           : 'background: rgba(255,255,255,0.06); color: #fff;' ?>">
                                        <?= $i ?>
                                    </a>
                                </li>
                                <?php endfor; ?>

                                <!-- Next -->
                                <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                                    <a class="page-link rounded-pill px-4 py-2 border border-light border-opacity-25"
                                       href="<?= BASE_URL ?>/blog?page=<?= $page + 1 ?>"
                                       style="background: rgba(255,255,255,0.06); color: #fff;">
                                        Next
                                    </a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                    <?php endif; ?>

                </div>
            </section>

        </div><!-- /border card -->
    </div><!-- /container-fluid -->
