<?php $pageTitle = 'Meu Perfil — ' . APP_NAME; ?>

<section class="py-5 mt-4">
    <div class="container">
        <?php if ($flash): ?>
            <div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'danger' ?> alert-dismissible">
                <?= htmlspecialchars($flash['message']) ?>
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row g-4">
            <!-- Formulário de perfil -->
            <div class="col-lg-4">
                <div class="card bg-dark border-secondary">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <?php if ($user['avatar']): ?>
                                <img src="<?= UPLOAD_URL ?>avatars/<?= htmlspecialchars($user['avatar']) ?>"
                                     class="rounded-circle mb-3" width="80" height="80"
                                     style="object-fit:cover;" alt="">
                            <?php else: ?>
                                <div class="bg-secondary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                                     style="width:80px;height:80px;">
                                    <i class="bi bi-person fs-2 text-white"></i>
                                </div>
                            <?php endif; ?>
                            <h5 class="text-white"><?= htmlspecialchars($user['name']) ?></h5>
                            <small class="text-muted"><?= htmlspecialchars($user['email']) ?></small>
                        </div>

                        <form method="POST" action="<?= BASE_URL ?>/profile" enctype="multipart/form-data">
                            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
                            <div class="mb-3">
                                <label class="form-label text-white">Nome</label>
                                <input type="text" name="name" class="form-control bg-dark text-white border-secondary"
                                       value="<?= htmlspecialchars($user['name']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-white">Bio</label>
                                <textarea name="bio" class="form-control bg-dark text-white border-secondary"
                                          rows="3"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-white">Foto de Perfil</label>
                                <input type="file" name="avatar" class="form-control bg-dark text-white border-secondary"
                                       accept="image/*">
                            </div>
                            <hr class="border-secondary">
                            <p class="text-muted small">Alterar senha (deixe vazio para não alterar)</p>
                            <div class="mb-3">
                                <label class="form-label text-white">Senha Atual</label>
                                <input type="password" name="current_password"
                                       class="form-control bg-dark text-white border-secondary">
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-white">Nova Senha</label>
                                <input type="password" name="new_password" minlength="8"
                                       class="form-control bg-dark text-white border-secondary">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-save me-1"></i>Guardar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Histórico de comentários -->
            <div class="col-lg-8">
                <h4 class="text-white mb-4">
                    <i class="bi bi-chat-square-text me-2"></i>Meus Comentários (<?= count($comments) ?>)
                </h4>
                <?php if (empty($comments)): ?>
                    <p class="text-muted">Ainda não fez nenhum comentário.</p>
                <?php else: ?>
                    <?php
                    $statusColor = ['pending'=>['warning','Aguarda moderação'],'approved'=>['success','Publicado'],'rejected'=>['danger','Rejeitado']];
                    $typeIcon    = ['comment'=>'bi-chat','suggestion'=>'bi-lightbulb','critique'=>'bi-pencil-square'];
                    foreach ($comments as $c):
                        [$sColor, $sLabel] = $statusColor[$c['status']] ?? ['secondary','Desconhecido'];
                    ?>
                    <div class="card bg-dark border-secondary mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi <?= $typeIcon[$c['type']] ?? 'bi-chat' ?> text-primary"></i>
                                    <span class="text-muted small">
                                        <?= ucfirst($c['entity_type']) ?> #<?= $c['entity_id'] ?>
                                    </span>
                                    <span class="badge bg-<?= $sColor ?>"><?= $sLabel ?></span>
                                    <?php if ($c['is_edited']): ?>
                                        <small class="text-muted fst-italic">
                                            <i class="bi bi-pencil me-1"></i>editado em <?= date('d/m/Y H:i', strtotime($c['edited_at'])) ?>
                                        </small>
                                    <?php endif; ?>
                                </div>
                                <small class="text-muted">
                                    <?= date('d/m/Y H:i', strtotime($c['created_at'])) ?>
                                </small>
                            </div>
                            <p class="text-light mb-0"><?= nl2br(htmlspecialchars($c['content'])) ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
