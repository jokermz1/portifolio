<?php $pageTitle = 'Definições — Admin'; ?>

<div class="page-header">
    <div>
        <h1 class="page-title">Definições Gerais</h1>
        <span style="font-size:12px; color:var(--text-faint);">Configurações do site e perfil</span>
    </div>
    <a href="<?= BASE_URL ?>/" target="_blank" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-eye me-1"></i>Ver Site
    </a>
</div>

<form method="POST" action="<?= BASE_URL ?>/admin/settings" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

    <div class="row g-4">

        <!-- ══ IDENTIDADE ═══════════════════════════════════════ -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-person-badge me-2" style="color:var(--accent);"></i>Identidade
                </div>
                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Logo do Site</label>
                            <input type="file" name="site_logo" accept="image/*" class="form-control">
                            <div class="mt-2 d-flex align-items-center gap-3">
                                <?php if (!empty($settings['site_logo'])): ?>
                                    <img src="<?= UPLOAD_URL ?>logos/<?= htmlspecialchars($settings['site_logo']) ?>"
                                         height="36" alt="Logo atual" style="border-radius:6px;">
                                    <small style="color:var(--text-faint);">Logo atual — faça upload para substituir</small>
                                <?php else: ?>
                                    <img src="<?= BASE_URL ?>/images/logo.png"
                                         height="36" alt="Logo padrão" style="border-radius:6px; opacity:.5;">
                                    <small style="color:var(--text-faint);">A usar logo padrão</small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Foto do Dono</label>
                            <input type="file" name="owner_photo" accept="image/*" class="form-control">
                            <?php if (!empty($settings['owner_photo'])): ?>
                            <div class="mt-2 d-flex align-items-center gap-3">
                                <img src="<?= UPLOAD_URL ?>avatars/<?= htmlspecialchars($settings['owner_photo']) ?>"
                                     height="36" class="rounded-circle" alt="">
                                <small style="color:var(--text-faint);">Foto atual — faça upload para substituir</small>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nome do Site</label>
                            <input type="text" name="site_name"
                                   value="<?= htmlspecialchars($settings['site_name'] ?? '') ?>"
                                   class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nome do Dono</label>
                            <input type="text" name="owner_name"
                                   value="<?= htmlspecialchars($settings['owner_name'] ?? '') ?>"
                                   class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Título / Profissão</label>
                            <input type="text" name="owner_title"
                                   value="<?= htmlspecialchars($settings['owner_title'] ?? '') ?>"
                                   class="form-control"
                                   placeholder="ex: Designer & Developer">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Texto Hero</label>
                            <input type="text" name="hero_text"
                                   value="<?= htmlspecialchars($settings['hero_text'] ?? '') ?>"
                                   class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Bio</label>
                            <textarea name="owner_bio" rows="3"
                                      class="form-control"><?= htmlspecialchars($settings['owner_bio'] ?? '') ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ══ CONTACTO ═════════════════════════════════════════ -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-envelope me-2" style="color:var(--accent);"></i>Contacto
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="owner_email"
                                   value="<?= htmlspecialchars($settings['owner_email'] ?? '') ?>"
                                   class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Telefone</label>
                            <input type="text" name="owner_phone"
                                   value="<?= htmlspecialchars($settings['owner_phone'] ?? '') ?>"
                                   class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="bi bi-whatsapp me-1" style="color:#25D366;"></i>WhatsApp
                            </label>
                            <input type="text" name="owner_whatsapp"
                                   value="<?= htmlspecialchars($settings['owner_whatsapp'] ?? '') ?>"
                                   class="form-control"
                                   placeholder="ex: +244 923 000 000">
                            <div class="form-text">Com indicativo do país. Gera automaticamente um link wa.me.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Endereço</label>
                            <input type="text" name="owner_address"
                                   value="<?= htmlspecialchars($settings['owner_address'] ?? '') ?>"
                                   class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">URL do CV</label>
                            <input type="url" name="cv_url"
                                   value="<?= htmlspecialchars($settings['cv_url'] ?? '') ?>"
                                   class="form-control"
                                   placeholder="https://...">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ══ ESTATÍSTICAS ══════════════════════════════════════ -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-bar-chart me-2" style="color:var(--accent);"></i>Estatísticas (Contador da Homepage)
                </div>
                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-md-3">
                            <label class="form-label">Anos de Experiência</label>
                            <input type="number" name="years_experience" min="0"
                                   value="<?= htmlspecialchars($settings['years_experience'] ?? '0') ?>"
                                   class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Projetos Concluídos</label>
                            <input type="number" name="projects_done" id="input_projects_done" min="0"
                                   value="<?= htmlspecialchars($settings['projects_done'] ?? '0') ?>"
                                   class="form-control">
                            <div class="form-text d-flex align-items-center gap-1">
                                <i class="bi bi-database" style="color:var(--accent);"></i>
                                Na DB: <strong><?= (int)($stats['projects_done'] ?? 0) ?></strong> publicados
                                <button type="button"
                                        onclick="document.getElementById('input_projects_done').value = <?= (int)($stats['projects_done'] ?? 0) ?>"
                                        class="btn btn-link p-0 ms-1" style="font-size:11px; color:var(--accent);">
                                    Usar este valor
                                </button>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Clientes</label>
                            <input type="number" name="clients" id="input_clients" min="0"
                                   value="<?= htmlspecialchars($settings['clients'] ?? '0') ?>"
                                   class="form-control">
                            <div class="form-text d-flex align-items-center gap-1">
                                <i class="bi bi-database" style="color:var(--accent);"></i>
                                Na DB: <strong><?= (int)($stats['clients'] ?? 0) ?></strong> utilizadores activos
                                <button type="button"
                                        onclick="document.getElementById('input_clients').value = <?= (int)($stats['clients'] ?? 0) ?>"
                                        class="btn btn-link p-0 ms-1" style="font-size:11px; color:var(--accent);">
                                    Usar este valor
                                </button>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Prémios</label>
                            <input type="number" name="awards" min="0"
                                   value="<?= htmlspecialchars($settings['awards'] ?? '0') ?>"
                                   class="form-control">
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- ══ REDES SOCIAIS ═════════════════════════════════════ -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-share me-2" style="color:var(--accent);"></i>Redes Sociais
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <?php
                        $socials = [
                            'social_facebook'  => ['Facebook',   'bi-facebook'],
                            'social_instagram' => ['Instagram',  'bi-instagram'],
                            'social_twitter'   => ['Twitter / X','bi-twitter-x'],
                            'social_linkedin'  => ['LinkedIn',   'bi-linkedin'],
                            'social_github'    => ['GitHub',     'bi-github'],
                            'social_youtube'   => ['YouTube',    'bi-youtube'],
                        ];
                        ?>
                        <?php foreach ($socials as $key => [$label, $icon]): ?>
                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="bi <?= $icon ?> me-1"></i><?= $label ?>
                            </label>
                            <input type="url" name="<?= $key ?>"
                                   value="<?= htmlspecialchars($settings[$key] ?? '') ?>"
                                   class="form-control"
                                   placeholder="https://...">
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- ══ APARÊNCIA / TEMA ══════════════════════════════════ -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-palette me-2" style="color:var(--accent);"></i>Aparência — Cores do Tema
                </div>
                <div class="card-body">
                    <?php
                    $themeColors = [
                        'theme_primary'   => ['Cor principal',   '#7710E9', 'Cor base da marca (início do gradiente, botões).'],
                        'theme_primary_2' => ['Cor do gradiente','#8F3AEC', 'Fim do gradiente dos botões e destaques.'],
                        'theme_accent'    => ['Cor de destaque', '#B775FF', 'Tom claro usado em links e ícones (text-primary).'],
                    ];
                    ?>
                    <div class="row g-3">
                        <?php foreach ($themeColors as $key => [$label, $default, $hint]):
                            $val = $settings[$key] ?? $default; ?>
                        <div class="col-md-4">
                            <label class="form-label"><?= $label ?></label>
                            <div class="d-flex align-items-center gap-2">
                                <input type="color" name="<?= $key ?>" id="<?= $key ?>_picker"
                                       value="<?= htmlspecialchars($val) ?>"
                                       class="form-control form-control-color"
                                       style="width:48px; height:40px; padding:4px;"
                                       oninput="document.getElementById('<?= $key ?>_text').value = this.value;">
                                <input type="text" id="<?= $key ?>_text"
                                       value="<?= htmlspecialchars($val) ?>"
                                       class="form-control" style="max-width:120px;"
                                       oninput="document.getElementById('<?= $key ?>_picker').value = this.value;">
                            </div>
                            <div class="form-text"><?= $hint ?></div>
                        </div>
                        <?php endforeach; ?>

                        <div class="col-12">
                            <button type="button" class="btn btn-outline-secondary btn-sm"
                                    onclick="['theme_primary','#7710E9','theme_primary_2','#8F3AEC','theme_accent','#B775FF'].forEach((v,i,a)=>{if(i%2===0){document.getElementById(v+'_picker').value=a[i+1];document.getElementById(v+'_text').value=a[i+1];}});">
                                <i class="bi bi-arrow-counterclockwise me-1"></i>Repor cores padrão
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ══ SKILLS (HOMEPAGE) ═════════════════════════════════ -->
        <?php if (!empty($skills)): ?>
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-lightning me-2" style="color:var(--accent);"></i>Skills</span>
                    <span style="font-size:11px; color:var(--text-faint);">Só leitura — geridas em separado</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Nível (%)</th>
                                    <th>Categoria</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($skills as $s): ?>
                                <tr>
                                    <td><?= htmlspecialchars($s['name']) ?></td>
                                    <td>
                                        <div class="progress" style="height:6px; width:120px;">
                                            <div class="progress-bar" style="width:<?= (int)$s['level'] ?>%; background:var(--accent);"></div>
                                        </div>
                                    </td>
                                    <td><small style="color:var(--text-muted);"><?= htmlspecialchars($s['category'] ?? '') ?></small></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Submit -->
        <div class="col-12 pb-3">
            <button type="submit" class="btn btn-primary px-5">
                <i class="bi bi-save me-2"></i>Guardar Todas as Definições
            </button>
        </div>

    </div>
</form>
