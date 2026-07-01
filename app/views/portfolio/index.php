<?php
$pageTitle = 'Portfolio — ' . APP_NAME;

// Converts category name to safe CSS class: "Web Design" → "web-design"
$catSlug = fn(string $cat): string =>
    trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($cat)), '-');
?>

    <!-- ═══ PAGE TITLE ══════════════════════════════════════════ -->
    <section id="page-title" class="padding-medium pb-0">
        <div class="container text-white">
            <div class="row justify-content-center text-center">
                <div class="col-xl-8">
                    <p class="letter-space text-primary fs-5" data-aos="fade-up" data-aos-duration="1000">
                        <a href="<?= BASE_URL ?>/" class="text-primary text-decoration-none"><?= t('Home') ?></a>
                        <span class="mx-2 text-muted">›</span>
                        <span class="text-white"><?= t('Portfolio') ?></span>
                    </p>
                    <h2 class="banner-size display-1" data-aos="fade-up" data-aos-duration="1200">
                        <?= t('Portfolio') ?><span class="text-primary">.</span>
                    </h2>
                    <p class="text-muted" data-aos="fade-up" data-aos-duration="1400">
                        <?= t('A showcase of my favourite projects — each design tells a unique story.') ?>
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

            <section id="portfolio" class="padding-medium container" data-aos="fade-up">

                <!-- Heading -->
                <div class="text-center mb-5">
                    <h3 class="display-3"><?= t('Latest projects') ?><span class="text-primary">.</span></h3>
                    <p class="text-muted"><?= t("Here's a showcase of some of my favourite projects.") ?><br>
                        <?= t("Each design tells a unique story and reflects the client's brand essence.") ?></p>
                </div>

                <?php if (!empty($projects)): ?>

                <!-- ═══ FILTER BUTTONS ═══════════════════════════ -->
                <div class="text-center my-5">
                    <p>
                        <button class="filter-button py-3 px-5 me-2 mb-3 active" data-filter="*">
                            <?= t('All') ?>
                        </button>
                        <?php foreach ($categories as $cat): ?>
                        <button class="filter-button py-3 px-5 me-2 mb-3"
                                data-filter=".<?= htmlspecialchars($catSlug($cat)) ?>">
                            <?= htmlspecialchars($cat) ?>
                        </button>
                        <?php endforeach; ?>
                    </p>
                </div>

                <!-- ═══ ISOTOPE GRID ════════════════════════════ -->
                <div class="isotope-container row">
                    <?php foreach ($projects as $project): ?>
                    <?php
                        $slug    = htmlspecialchars($project['slug']);
                        $cls     = !empty($project['category']) ? $catSlug($project['category']) : 'general';
                        $imgSrc  = !empty($project['image'])
                            ? UPLOAD_URL . 'projects/' . htmlspecialchars($project['image'])
                            : BASE_URL . '/images/project1.jpg';
                    ?>
                    <div class="item <?= htmlspecialchars($cls) ?> col-md-6 p-3">
                        <div class="blog-post">
                            <div class="image-zoom rounded-3">
                                <a href="<?= BASE_URL ?>/portfolio/<?= $slug ?>" class="blog-img">
                                    <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($project['title']) ?>"
                                         class="img-fluid w-100" style="height: 320px; object-fit: cover;">
                                </a>
                            </div>
                            <?php if (!empty($project['category'])): ?>
                            <p class="text-uppercase text-primary fw-semibold mt-3 mb-1">
                                <?= htmlspecialchars($project['category']) ?>
                            </p>
                            <?php endif; ?>
                            <h5 class="display-6">
                                <a href="<?= BASE_URL ?>/portfolio/<?= $slug ?>">
                                    <?= htmlspecialchars($project['title']) ?>
                                </a>
                            </h5>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div><!-- /isotope-container -->

                <?php else: ?>
                <div class="text-center py-5">
                    <p class="text-muted fs-5"><?= t('No projects published yet. Check back soon!') ?></p>
                </div>
                <?php endif; ?>

            </section>

        </div><!-- /border card -->
    </div><!-- /container-fluid -->
