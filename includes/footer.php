<section id="footer">
    <div class="container padding-medium pt-0" data-aos="fade-up">
        <div class="text-center">
            <?php
                $logoSrc = !empty($settings['site_logo'])
                    ? UPLOAD_URL . 'logos/' . htmlspecialchars($settings['site_logo'])
                    : BASE_URL . '/images/logo.png';
            ?>
            <img src="<?= $logoSrc ?>" alt="<?= htmlspecialchars($settings['site_name'] ?? 'Logo') ?>">
        </div>

        <ul class="d-flex gap-5 list-unstyled justify-content-center my-3 mt-5">
            <?php if (!empty($settings['social_facebook'])): ?>
            <li>
                <a class="nav-link p-0" href="<?= htmlspecialchars($settings['social_facebook']) ?>" target="_blank">
                    <svg class="accent-color" width="24" height="24"><use xlink:href="#facebook"></use></svg>
                </a>
            </li>
            <?php else: ?>
            <li>
                <a class="nav-link p-0" href="#">
                    <svg class="accent-color" width="24" height="24"><use xlink:href="#facebook"></use></svg>
                </a>
            </li>
            <?php endif; ?>
            <li>
                <a class="nav-link p-0" href="<?= htmlspecialchars($settings['social_instagram'] ?? '#') ?>" target="_blank">
                    <svg class="accent-color" width="24" height="24"><use xlink:href="#instagram"></use></svg>
                </a>
            </li>
            <li>
                <a class="nav-link p-0" href="<?= htmlspecialchars($settings['social_twitter'] ?? '#') ?>" target="_blank">
                    <svg class="accent-color" width="24" height="24"><use xlink:href="#twitter"></use></svg>
                </a>
            </li>
            <li>
                <a class="nav-link p-0" href="#">
                    <svg class="accent-color" width="24" height="24"><use xlink:href="#pinterest"></use></svg>
                </a>
            </li>
            <li>
                <a class="nav-link p-0" href="<?= htmlspecialchars($settings['social_youtube'] ?? '#') ?>" target="_blank">
                    <svg class="accent-color" width="24" height="24"><use xlink:href="#youtube"></use></svg>
                </a>
            </li>
        </ul>

        <div class="text-center mt-5">
            <p class="mb-0">&copy; <?= date('Y') ?> <?= htmlspecialchars($settings['owner_name'] ?? APP_NAME) ?>.</p>
        </div>
    </div>
</section>
