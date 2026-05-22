<?php $pageTitle = htmlspecialchars($project['title']) . ' — Portfolio'; ?>

    <!-- ═══ PAGE TITLE ══════════════════════════════════════════ -->
    <section id="page-title" class="padding-medium pb-0">
        <div class="container text-white">
            <div class="row justify-content-center text-center">
                <div class="col-xl-8">
                    <p class="letter-space text-primary fs-5" data-aos="fade-up" data-aos-duration="1000">
                        <a href="<?= BASE_URL ?>/" class="text-primary text-decoration-none">Home</a>
                        <span class="mx-2 text-muted">›</span>
                        <a href="<?= BASE_URL ?>/portfolio" class="text-primary text-decoration-none">Portfolio</a>
                        <span class="mx-2 text-muted">›</span>
                        <span class="text-white"><?= htmlspecialchars($project['title']) ?></span>
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

                        <!-- ══ Main Content ══════════════════════ -->
                        <div class="col-lg-8" data-aos="fade-up" data-aos-duration="1000">

                            <!-- Featured image -->
                            <?php if (!empty($project['image'])): ?>
                            <div class="image-zoom rounded-3 overflow-hidden mb-5">
                                <img src="<?= UPLOAD_URL ?>projects/<?= htmlspecialchars($project['image']) ?>"
                                     class="img-fluid w-100"
                                     style="max-height: 500px; object-fit: cover;"
                                     alt="<?= htmlspecialchars($project['title']) ?>">
                            </div>
                            <?php endif; ?>

                            <!-- Title + meta row -->
                            <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                                <?php if (!empty($project['category'])): ?>
                                <span class="letter-space text-primary" style="font-size:0.75rem;">
                                    <?= htmlspecialchars($project['category']) ?>
                                </span>
                                <span class="text-muted">·</span>
                                <?php endif; ?>
                                <small class="text-muted">
                                    <?= date('d M Y', strtotime($project['created_at'])) ?>
                                </small>
                            </div>

                            <h1 class="display-4 text-white mb-4"><?= htmlspecialchars($project['title']) ?></h1>

                            <!-- Short description -->
                            <?php if (!empty($project['description'])): ?>
                            <p class="fs-5 text-muted lh-lg mb-5">
                                <?= htmlspecialchars($project['description']) ?>
                            </p>
                            <?php endif; ?>

                            <!-- Full content -->
                            <?php if (!empty($project['content'])): ?>
                            <div class="text-muted lh-lg mb-5 post-content">
                                <?= nl2br(htmlspecialchars($project['content'])) ?>
                            </div>
                            <?php endif; ?>

                            <!-- Visit project button -->
                            <?php if (!empty($project['project_url'])): ?>
                            <div class="mb-5">
                                <a href="<?= htmlspecialchars($project['project_url']) ?>"
                                   target="_blank" rel="noopener noreferrer"
                                   class="btn button rounded-pill position-relative pe-5">
                                    <span>View Live Project</span>
                                    <div class="position-absolute top-50 end-0 translate-middle-y me-2">
                                        <svg class="arrow-right bg-white text-black rounded-circle p-2" width="35" height="35">
                                            <use xlink:href="#arrow-right"></use>
                                        </svg>
                                    </div>
                                </a>
                            </div>
                            <?php endif; ?>

                            <hr class="border-light border-opacity-25 my-5">

                            <!-- Flash message -->
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
                                'entityType' => 'project',
                                'entityId'   => $project['id'],
                            ]); ?>

                            <hr class="border-light border-opacity-25 my-4">

                            <?php View::partial('comment-form', [
                                'entityType' => 'project',
                                'entityId'   => $project['id'],
                                'csrf'       => $csrf,
                                'user'       => $user,
                            ]); ?>

                        </div><!-- /col-lg-8 -->

                        <!-- ══ Sidebar ════════════════════════════ -->
                        <div class="col-lg-4" data-aos="fade-up" data-aos-duration="1200">

                            <!-- Project info card -->
                            <div class="border border-light border-opacity-25 rounded-4 p-4 mb-4"
                                 style="background: rgba(255,255,255,0.04);">
                                <h5 class="letter-space text-primary mb-4" style="font-size:0.8rem;">Project Info</h5>
                                <ul class="list-unstyled mb-0">
                                    <?php if (!empty($project['category'])): ?>
                                    <li class="d-flex justify-content-between py-3 border-bottom border-light border-opacity-10">
                                        <span class="text-muted small">Category</span>
                                        <span class="text-white small fw-semibold"><?= htmlspecialchars($project['category']) ?></span>
                                    </li>
                                    <?php endif; ?>
                                    <li class="d-flex justify-content-between py-3 border-bottom border-light border-opacity-10">
                                        <span class="text-muted small">Date</span>
                                        <span class="text-white small fw-semibold">
                                            <?= date('d M Y', strtotime($project['created_at'])) ?>
                                        </span>
                                    </li>
                                    <li class="d-flex justify-content-between py-3 border-bottom border-light border-opacity-10">
                                        <span class="text-muted small">Comments</span>
                                        <span class="text-white small fw-semibold"><?= count($comments) ?></span>
                                    </li>
                                    <?php if ($project['is_featured']): ?>
                                    <li class="d-flex justify-content-between py-3">
                                        <span class="text-muted small">Featured</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="text-primary" viewBox="0 0 16 16">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                        </svg>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>

                            <!-- Buttons -->
                            <?php if (!empty($project['project_url'])): ?>
                            <a href="<?= htmlspecialchars($project['project_url']) ?>"
                               target="_blank" rel="noopener noreferrer"
                               class="btn button rounded-pill position-relative pe-5 w-100 mb-3">
                                <span>View Project</span>
                                <div class="position-absolute top-50 end-0 translate-middle-y me-2">
                                    <svg class="arrow-right bg-white text-black rounded-circle p-2" width="35" height="35">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg>
                                </div>
                            </a>
                            <?php endif; ?>

                            <a href="<?= BASE_URL ?>/portfolio"
                               class="btn btn-outline-light rounded-pill py-3 w-100 mb-4">
                                ← All Projects
                            </a>

                            <!-- Related projects -->
                            <?php if (!empty($related)): ?>
                            <div class="border border-light border-opacity-25 rounded-4 p-4"
                                 style="background: rgba(255,255,255,0.04);">
                                <h5 class="letter-space text-primary mb-4" style="font-size:0.8rem;">Related Projects</h5>
                                <?php foreach ($related as $r): ?>
                                <a href="<?= BASE_URL ?>/portfolio/<?= htmlspecialchars($r['slug']) ?>"
                                   class="d-flex align-items-center gap-3 mb-3 text-decoration-none">
                                    <?php if (!empty($r['image'])): ?>
                                    <img src="<?= UPLOAD_URL ?>projects/<?= htmlspecialchars($r['image']) ?>"
                                         width="60" height="50"
                                         style="object-fit:cover; border-radius:8px; flex-shrink:0;"
                                         alt="">
                                    <?php else: ?>
                                    <div class="flex-shrink-0 rounded-3"
                                         style="width:60px;height:50px;background:rgba(119,16,233,0.3);"></div>
                                    <?php endif; ?>
                                    <div>
                                        <p class="text-white mb-0 small fw-semibold"><?= htmlspecialchars($r['title']) ?></p>
                                        <p class="text-muted mb-0" style="font-size:0.75rem;"><?= htmlspecialchars($r['category'] ?? '') ?></p>
                                    </div>
                                </a>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>

                        </div><!-- /col-lg-4 -->

                    </div><!-- /row -->
                </div>
            </section>

        </div><!-- /border card -->
    </div><!-- /container-fluid -->
