<?php
$pageTitle = t('My Profile') . ' — ' . APP_NAME;

$statusMap = [
    'pending'  => ['is-pending',  t('Awaiting moderation')],
    'approved' => ['is-approved', t('Published')],
    'rejected' => ['is-rejected', t('Rejected')],
];
$typeIcon = [
    'comment'    => 'bi-chat',
    'suggestion' => 'bi-lightbulb',
    'critique'   => 'bi-pencil-square',
];
?>

<section class="py-5 mt-4">
    <div class="container">
        <?php if ($flash): ?>
            <div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'danger' ?> alert-dismissible">
                <?= htmlspecialchars($flash['message']) ?>
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row g-4">

            <!-- ═══ Cartão de perfil + formulário ═══════════════ -->
            <div class="col-lg-4">
                <div class="profile-card p-4">
                    <div class="text-center mb-4">
                        <?php if ($user['avatar']): ?>
                            <img src="<?= UPLOAD_URL ?>avatars/<?= htmlspecialchars($user['avatar']) ?>"
                                 class="profile-avatar mx-auto mb-3 d-block" alt="">
                        <?php else: ?>
                            <div class="profile-avatar-fallback mx-auto mb-3">
                                <i class="bi bi-person"></i>
                            </div>
                        <?php endif; ?>
                        <h5 class="text-white mb-1"><?= htmlspecialchars($user['name']) ?></h5>
                        <small class="text-muted"><?= htmlspecialchars($user['email']) ?></small>
                        <?php if (!empty($user['bio'])): ?>
                            <p class="text-muted small mt-3 mb-0"><?= nl2br(htmlspecialchars($user['bio'])) ?></p>
                        <?php endif; ?>
                    </div>

                    <form class="profile-form" method="POST" action="<?= BASE_URL ?>/profile" enctype="multipart/form-data">
                        <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                        <div class="mb-3">
                            <label class="form-label"><?= e_t('Name') ?></label>
                            <input type="text" name="name" class="form-control"
                                   value="<?= htmlspecialchars($user['name']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><?= e_t('Bio') ?></label>
                            <textarea name="bio" class="form-control" rows="3"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><?= e_t('Profile Photo') ?></label>
                            <input type="file" name="avatar" class="form-control" accept="image/*">
                        </div>

                        <hr class="profile-divider my-4">
                        <p class="text-muted small mb-3"><?= e_t('Change password (leave blank to keep unchanged)') ?></p>
                        <div class="mb-3">
                            <label class="form-label"><?= e_t('Current Password') ?></label>
                            <input type="password" name="current_password" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label class="form-label"><?= e_t('New Password') ?></label>
                            <input type="password" name="new_password" minlength="8" class="form-control">
                        </div>

                        <button type="submit" class="btn button rounded-pill w-100">
                            <span><i class="bi bi-check2-circle me-1"></i><?= e_t('Save') ?></span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- ═══ Atividade: comentários + depoimentos ════════ -->
            <div class="col-lg-8">

                <ul class="nav profile-tabs mb-4" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-comments-btn" data-bs-toggle="tab"
                                data-bs-target="#tab-comments" type="button" role="tab">
                            <i class="bi bi-chat-square-text me-1"></i><?= e_t('Comments') ?>
                            <span class="badge rounded-pill ms-1"><?= count($comments) ?></span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-testimonials-btn" data-bs-toggle="tab"
                                data-bs-target="#tab-testimonials" type="button" role="tab">
                            <i class="bi bi-star me-1"></i><?= e_t('Testimonials') ?>
                            <span class="badge rounded-pill ms-1"><?= count($testimonials) ?></span>
                        </button>
                    </li>
                </ul>

                <div class="tab-content">

                    <!-- ── Comentários ─────────────────────────── -->
                    <div class="tab-pane fade show active" id="tab-comments" role="tabpanel">
                        <?php if (empty($comments)): ?>
                            <p class="text-muted"><?= e_t("You haven't made any comments yet.") ?></p>
                        <?php else: ?>
                            <?php foreach ($comments as $c):
                                [$sClass, $sLabel] = $statusMap[$c['status']] ?? ['is-pending', $c['status']];
                                $icon        = $typeIcon[$c['type']] ?? 'bi-chat';
                                $sectionName = $c['entity_type'] === 'post' ? e_t('Blog') : e_t('Portfolio');
                                $basePath    = $c['entity_type'] === 'post' ? '/blog/' : '/portfolio/';
                                $slug        = $c['target_slug'] ?? null;
                                $url         = $slug
                                    ? BASE_URL . $basePath . rawurlencode($slug) . '#comment-' . (int) $c['id']
                                    : null;
                                $targetTitle = $c['target_title'] ?? (ucfirst($c['entity_type']) . ' #' . $c['entity_id']);
                                $tag         = $url ? 'a' : 'div';
                            ?>
                            <<?= $tag ?> class="profile-comment mb-3"<?= $url ? ' href="' . $url . '"' : '' ?>>
                                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <i class="bi <?= $icon ?> text-primary"></i>
                                        <span class="pc-meta text-uppercase" style="letter-spacing:1px;"><?= $sectionName ?></span>
                                        <span class="pc-target"><?= htmlspecialchars($targetTitle) ?></span>
                                        <span class="pc-status <?= $sClass ?>"><?= htmlspecialchars($sLabel) ?></span>
                                    </div>
                                    <small class="pc-meta"><?= date('d/m/Y H:i', strtotime($c['created_at'])) ?></small>
                                </div>

                                <p class="pc-body mb-2"
                                   style="display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">
                                    <?= nl2br(htmlspecialchars($c['content'])) ?>
                                </p>

                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                    <?php if ($c['is_edited']): ?>
                                        <small class="pc-meta fst-italic">
                                            <i class="bi bi-pencil me-1"></i><?= e_t('edited on') ?> <?= date('d/m/Y H:i', strtotime($c['edited_at'])) ?>
                                        </small>
                                    <?php else: ?>
                                        <span></span>
                                    <?php endif; ?>

                                    <?php if ($url): ?>
                                        <span class="pc-go d-inline-flex align-items-center gap-1">
                                            <?= e_t('View publication') ?>
                                            <svg width="15" height="15"><use xlink:href="#arrow-right"></use></svg>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </<?= $tag ?>>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- ── Depoimentos ─────────────────────────── -->
                    <div class="tab-pane fade" id="tab-testimonials" role="tabpanel">
                        <?php if (empty($testimonials)): ?>
                            <p class="text-muted"><?= e_t("You haven't left any testimonials yet.") ?></p>
                        <?php else: ?>
                            <?php foreach ($testimonials as $tst):
                                [$sClass, $sLabel] = $statusMap[$tst['status']] ?? ['is-pending', $tst['status']];
                                $rating   = max(0, min(5, (int) $tst['rating']));
                                $tUrl     = $tst['status'] === 'approved' ? BASE_URL . '/#testimonial' : null;
                                $meta     = trim(($tst['role'] ?? '') . (!empty($tst['location']) ? ' · ' . $tst['location'] : ''), ' ·');
                                $tag      = $tUrl ? 'a' : 'div';
                            ?>
                            <<?= $tag ?> class="profile-comment mb-3"<?= $tUrl ? ' href="' . $tUrl . '"' : '' ?>>
                                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <span class="pc-stars">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <i class="bi <?= $i <= $rating ? 'bi-star-fill' : 'bi-star' ?>"></i>
                                            <?php endfor; ?>
                                        </span>
                                        <span class="pc-status <?= $sClass ?>"><?= htmlspecialchars($sLabel) ?></span>
                                        <?php if (!empty($tst['is_featured'])): ?>
                                            <span class="pc-status is-approved"><i class="bi bi-star-fill me-1"></i><?= e_t('Featured') ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <small class="pc-meta"><?= date('d/m/Y H:i', strtotime($tst['created_at'])) ?></small>
                                </div>

                                <p class="pc-body mb-2"
                                   style="display:-webkit-box;-webkit-line-clamp:4;-webkit-box-orient:vertical;overflow:hidden;">
                                    <?= nl2br(htmlspecialchars($tst['content'])) ?>
                                </p>

                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                    <small class="pc-meta"><?= htmlspecialchars($meta) ?></small>
                                    <?php if ($tUrl): ?>
                                        <span class="pc-go d-inline-flex align-items-center gap-1">
                                            <?= e_t('View on homepage') ?>
                                            <svg width="15" height="15"><use xlink:href="#arrow-right"></use></svg>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </<?= $tag ?>>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                </div><!-- /tab-content -->
            </div>

        </div><!-- /row -->
    </div>
</section>
