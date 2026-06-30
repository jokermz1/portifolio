<?php
$pageTitle = htmlspecialchars($project['title']) . ' — Portfolio';
$links     = json_decode($project['links'] ?? '[]', true) ?: [];
$gallery   = Project::galleryItems($project['images'] ?? '[]');
$projectUrl = $project['project_url'] ?: ($links[0]['url'] ?? '');
?>

    <!-- ═══ PAGE TITLE ══════════════════════════════════════════ -->
    <section id="page-title" class="padding-medium pb-0">
        <div class="container text-white">
            <div class="row justify-content-center text-center">
                <div class="col-xl-9">
                    <p class="letter-space fs-5 mb-3" data-aos="fade-up" data-aos-duration="1000">
                        <a href="<?= BASE_URL ?>/" class="text-primary text-decoration-none">Home</a>
                        <span class="mx-2 text-muted">/</span>
                        <a href="<?= BASE_URL ?>/portfolio" class="text-primary text-decoration-none">Portfolio</a>
                        <span class="mx-2 text-muted">/</span>
                        <span class="text-muted"><?= htmlspecialchars($project['title']) ?></span>
                    </p>
                    <h1 class="banner-size display-1" data-aos="fade-up" data-aos-duration="1200">
                        <?= htmlspecialchars($project['title']) ?>
                    </h1>
                    <?php if (!empty($project['description'])): ?>
                    <p class="fs-5 mt-3" data-aos="fade-up" data-aos-duration="1400">
                        <?= htmlspecialchars($project['description']) ?>
                    </p>
                    <?php endif; ?>
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

                    <!-- ══ Categoria + Título ══════════════════ -->
                    <?php if (!empty($project['category'])): ?>
                    <p class="letter-space text-primary mb-2" style="font-size:0.85rem;" data-aos="fade-up">
                        <?= htmlspecialchars(strtoupper($project['category'])) ?>
                    </p>
                    <?php endif; ?>
                    <h2 class="display-3 mb-5" data-aos="fade-up"><?= htmlspecialchars($project['title']) ?></h2>

                    <!-- ══ Info (esquerda) + Descrição (direita) ══ -->
                    <div class="row g-5 mb-5" data-aos="fade-up" data-aos-duration="1000">

                        <div class="col-lg-4">
                            <?php if (!empty($project['client'])): ?>
                            <div class="mb-4">
                                <p class="letter-space text-primary mb-1" style="font-size:0.75rem;">CLIENT</p>
                                <p class="fs-5 text-white mb-0"><?= htmlspecialchars($project['client']) ?></p>
                            </div>
                            <?php endif; ?>

                            <div class="mb-4">
                                <p class="letter-space text-primary mb-1" style="font-size:0.75rem;">DATE</p>
                                <p class="fs-5 text-white mb-0"><?= date('d-m-Y', strtotime($project['created_at'])) ?></p>
                            </div>

                            <?php if (!empty($project['category'])): ?>
                            <div class="mb-4">
                                <p class="letter-space text-primary mb-1" style="font-size:0.75rem;">CATEGORY</p>
                                <p class="fs-5 text-white mb-0"><?= htmlspecialchars($project['category']) ?></p>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($projectUrl)): ?>
                            <div class="mb-4">
                                <p class="letter-space text-primary mb-1" style="font-size:0.75rem;">PROJECT LINK</p>
                                <a href="<?= htmlspecialchars($projectUrl) ?>" target="_blank" rel="noopener noreferrer"
                                   class="fs-5 text-white text-decoration-none text-break border-bottom border-primary">
                                    <?= htmlspecialchars($projectUrl) ?>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-8">
                            <?php if (!empty($project['content'])): ?>
                            <div class="fs-5 lh-lg post-content">
                                <?= nl2br(htmlspecialchars($project['content'])) ?>
                            </div>
                            <?php elseif (!empty($project['description'])): ?>
                            <p class="fs-4 lh-base fw-light"><?= htmlspecialchars($project['description']) ?></p>
                            <?php endif; ?>

                            <?php if (!empty($links)): ?>
                            <div class="d-flex flex-wrap gap-2 mt-4">
                                <?php foreach ($links as $lnk): if (empty($lnk['url'])) continue; ?>
                                <a href="<?= htmlspecialchars($lnk['url']) ?>" target="_blank" rel="noopener noreferrer"
                                   class="btn button rounded-pill position-relative pe-5">
                                    <span><?= htmlspecialchars($lnk['label'] ?: 'Visitar') ?></span>
                                    <div class="position-absolute top-50 end-0 translate-middle-y me-2">
                                        <svg class="arrow-right bg-white text-black rounded-circle p-2" width="35" height="35">
                                            <use xlink:href="#arrow-right"></use>
                                        </svg>
                                    </div>
                                </a>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- ══ Imagem de capa ══════════════════════ -->
                    <?php if (!empty($project['image'])): ?>
                    <div class="image-zoom rounded-4 overflow-hidden mb-4" data-aos="fade-up">
                        <img src="<?= UPLOAD_URL ?>projects/<?= htmlspecialchars($project['image']) ?>"
                             class="img-fluid w-100" style="max-height:620px; object-fit:cover;"
                             alt="<?= htmlspecialchars($project['title']) ?>">
                    </div>
                    <?php endif; ?>

                    <!-- ══ Galeria de imagens (com títulos) ════ -->
                    <?php if (!empty($gallery)): ?>
                    <div class="row g-4 mt-2" data-aos="fade-up">
                        <?php foreach ($gallery as $g): ?>
                        <div class="col-md-6">
                            <figure class="mb-0">
                                <div class="image-zoom rounded-4 overflow-hidden">
                                    <img src="<?= UPLOAD_URL ?>projects/<?= htmlspecialchars($g['file']) ?>"
                                         class="w-100" style="aspect-ratio:4/3; object-fit:cover; display:block;"
                                         alt="<?= htmlspecialchars($g['caption'] ?: $project['title']) ?>">
                                </div>
                                <?php if (!empty($g['caption'])): ?>
                                <figcaption class="fs-5 text-white mt-3 mb-0"><?= htmlspecialchars($g['caption']) ?></figcaption>
                                <?php endif; ?>
                            </figure>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <!-- ══ Voltar / Ver projeto ════════════════ -->
                    <div class="d-flex flex-wrap gap-3 mt-5 pt-3">
                        <a href="<?= BASE_URL ?>/portfolio" class="btn btn-outline-light rounded-pill px-4 py-3">
                            ← All Projects
                        </a>
                        <?php if (!empty($projectUrl)): ?>
                        <a href="<?= htmlspecialchars($projectUrl) ?>" target="_blank" rel="noopener noreferrer"
                           class="btn button rounded-pill position-relative pe-5">
                            <span>View Live Project</span>
                            <div class="position-absolute top-50 end-0 translate-middle-y me-2">
                                <svg class="arrow-right bg-white text-black rounded-circle p-2" width="35" height="35">
                                    <use xlink:href="#arrow-right"></use>
                                </svg>
                            </div>
                        </a>
                        <?php endif; ?>
                    </div>

                    <!-- ══ Projetos relacionados ═══════════════ -->
                    <?php if (!empty($related)): ?>
                    <hr class="border-light border-opacity-25 my-5">
                    <h3 class="display-5 mb-4">Related projects<span class="text-primary">.</span></h3>
                    <div class="row g-4">
                        <?php foreach ($related as $r): ?>
                        <div class="col-md-4">
                            <div class="blog-post">
                                <div class="image-zoom rounded-3 overflow-hidden">
                                    <a href="<?= BASE_URL ?>/portfolio/<?= htmlspecialchars($r['slug']) ?>" class="blog-img">
                                        <?php if (!empty($r['image'])): ?>
                                            <img src="<?= UPLOAD_URL ?>projects/<?= htmlspecialchars($r['image']) ?>"
                                                 class="img-fluid w-100" style="height:220px; object-fit:cover;" alt="">
                                        <?php else: ?>
                                            <div style="height:220px; background:rgba(119,16,233,0.25);"></div>
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <p class="text-uppercase text-primary fw-semibold mt-3 mb-1" style="font-size:0.8rem;">
                                    <?= htmlspecialchars($r['category'] ?? '') ?>
                                </p>
                                <h5 class="fs-4">
                                    <a href="<?= BASE_URL ?>/portfolio/<?= htmlspecialchars($r['slug']) ?>"
                                       class="text-white text-decoration-none"><?= htmlspecialchars($r['title']) ?></a>
                                </h5>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <!-- ══ Comentários ═════════════════════════ -->
                    <hr class="border-light border-opacity-25 my-5">

                    <?php if (!empty($flash)): ?>
                    <div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show mb-4" role="alert">
                        <?= htmlspecialchars($flash['message']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php endif; ?>

                    <?php View::partial('comment-list', [
                        'comments'   => $comments,
                        'user'       => $user,
                        'csrf'       => $csrf,
                        'entityType' => 'project',
                        'entityId'   => $project['id'],
                    ]); ?>

                    <?php View::partial('comment-form', [
                        'entityType' => 'project',
                        'entityId'   => $project['id'],
                        'csrf'       => $csrf,
                        'user'       => $user,
                    ]); ?>

                </div>
            </section>

        </div><!-- /border card -->
    </div><!-- /container-fluid -->
