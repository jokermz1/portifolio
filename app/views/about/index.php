<?php $pageTitle = 'About Me — ' . htmlspecialchars($settings['site_name'] ?? 'Portfolio'); ?>

<style>
/* ── About & Resume Page — Typography ───────────────────────── */

/* Base font override for this page */
.about-page-wrap {
  font-family: 'Poppins', sans-serif;
  font-size: 15px;
  line-height: 1.75;
  color: #b8b8d0;
  -webkit-font-smoothing: antialiased;
}

/* Section title */
.section-title { padding-bottom: 56px; text-align: center; }
.section-title h2 {
  font-family: 'Bebas Neue', serif;
  font-size: clamp(3rem, 7vw, 5rem);
  letter-spacing: .12em;
  color: #fff;
  margin-bottom: 0;
  line-height: 1;
}
.section-title h2::after {
  content: '';
  display: block;
  width: 48px;
  height: 3px;
  background: #B775FF;
  margin: 14px auto 0;
  border-radius: 2px;
}
.section-title p {
  font-size: 14px;
  color: #5a5a78;
  margin-top: 14px;
  margin-bottom: 0;
  letter-spacing: .03em;
}

/* ── About section ───────────────────────────────────────────── */
.about-section {
  padding: 90px 0;
  background: #0F0E10;
}

/* Photo */
.about-img {
  width: 100%;
  border-radius: 12px;
  display: block;
  object-fit: cover;
  aspect-ratio: 3/4;
}
.about-img-placeholder {
  width: 100%;
  aspect-ratio: 3/4;
  border-radius: 12px;
  background: rgba(183,117,255,.06);
  border: 1px solid rgba(183,117,255,.18);
  display: flex;
  align-items: center;
  justify-content: center;
  color: rgba(183,117,255,.3);
  font-size: 64px;
}

/* Info list */
.about-info { margin-top: 4px; }
.about-info p {
  font-size: 14px;
  color: #c0c0dc;
  padding: 9px 0;
  border-bottom: 1px solid rgba(255,255,255,.06);
  margin: 0;
  line-height: 1.55;
  word-spacing: .02em;
}
.about-info p:last-child { border-bottom: none; }
.about-info p strong {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: .08em;
  text-transform: uppercase;
  color: #5a5a78;
  min-width: 76px;
  display: inline-block;
  margin-right: 6px;
}
.about-info a { color: #B775FF; text-decoration: none; }
.about-info a:hover { text-decoration: underline; }

/* Social icons */
.about-socials { display: flex; gap: 8px; margin-top: 18px; flex-wrap: wrap; }
.about-social-link {
  width: 36px; height: 36px;
  border-radius: 50%;
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.1);
  display: flex; align-items: center; justify-content: center;
  color: #6a6a88; font-size: 14px; text-decoration: none;
  transition: all .2s;
}
.about-social-link:hover {
  background: rgba(183,117,255,.14);
  border-color: rgba(183,117,255,.4);
  color: #B775FF;
  transform: translateY(-2px);
}

/* Skills */
.skills-content { margin-top: 32px; }
.skills-content h5 {
  font-family: 'Bebas Neue', serif;
  font-size: 1.5rem;
  letter-spacing: .1em;
  color: #fff;
  margin-bottom: 20px;
}
.skill-category-label {
  font-size: 10px;
  font-weight: 700;
  color: #B775FF;
  letter-spacing: .14em;
  text-transform: uppercase;
  margin: 22px 0 12px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.skill-category-label::after {
  content: '';
  flex: 1;
  height: 1px;
  background: rgba(183,117,255,.15);
}
.progress-wrap { margin-bottom: 18px; }
.skill-header {
  display: flex;
  justify-content: space-between;
  align-items: baseline;
  margin-bottom: 7px;
}
.skill-header span {
  font-size: 13px;
  font-weight: 600;
  color: #d0d0e8;
  letter-spacing: .04em;
}
.skill-header i {
  font-size: 13px;
  color: #B775FF;
  font-style: normal;
  font-weight: 700;
}
.progress-bar-wrap {
  height: 5px;
  background: rgba(255,255,255,.07);
  border-radius: 3px;
  overflow: hidden;
}
.progress-bar-fill {
  height: 100%;
  background: linear-gradient(90deg, #B775FF, #d4a6ff);
  border-radius: 3px;
  transition: width 1.4s cubic-bezier(.25,.46,.45,.94);
  width: 0;
}

/* About me text (right col) */
.about-me-section { padding-left: 0; }
.about-me-section h4 {
  font-family: 'Bebas Neue', serif;
  font-size: clamp(1.8rem, 3.5vw, 2.6rem);
  letter-spacing: .08em;
  color: #fff;
  margin-bottom: 20px;
  line-height: 1.1;
}
.about-me-section p {
  font-size: 15px;
  color: #9090b0;
  line-height: 1.95;
  margin-bottom: 18px;
  word-spacing: .03em;
}
.cv-btn {
  display: inline-flex;
  align-items: center;
  gap: 9px;
  margin-top: 10px;
  padding: 12px 28px;
  background: #B775FF;
  color: #fff;
  border-radius: 7px;
  font-size: 14px;
  font-weight: 600;
  letter-spacing: .04em;
  text-decoration: none;
  transition: background .2s, transform .2s, box-shadow .2s;
}
.cv-btn:hover {
  background: #c98aff;
  transform: translateY(-3px);
  box-shadow: 0 8px 24px rgba(183,117,255,.3);
  color: #fff;
}

/* Divider */
.section-divider {
  border: none;
  border-top: 1px solid rgba(255,255,255,.06);
  margin: 0;
}

/* ── Resume section ──────────────────────────────────────────── */
.resume-section {
  padding: 90px 0;
  background: #0d0c0f;
}

/* Column title */
.resume-title {
  font-family: 'Bebas Neue', serif;
  font-size: 2rem;
  letter-spacing: .12em;
  color: #fff;
  padding-bottom: 14px;
  border-bottom: 2px solid rgba(183,117,255,.3);
  margin-bottom: 36px;
  display: flex;
  align-items: center;
  gap: 14px;
}
.resume-title i {
  width: 36px; height: 36px;
  background: rgba(183,117,255,.15);
  border: 1px solid rgba(183,117,255,.35);
  border-radius: 9px;
  display: flex; align-items: center; justify-content: center;
  color: #B775FF; font-size: 16px; flex-shrink: 0;
  box-shadow: 0 0 14px rgba(183,117,255,.18);
}

/* Timeline wrapper */
.resume-timeline {
  border-left: 2px solid rgba(183,117,255,.25);
  padding-left: 0;
  margin-left: 6px;
  display: flex;
  flex-direction: column;
  gap: 0;
}

/* Each card item */
.resume-item {
  position: relative;
  padding: 0 0 28px 32px;
}
.resume-item:last-child { padding-bottom: 0; }

/* Timeline dot */
.resume-item::before {
  content: '';
  position: absolute;
  width: 14px; height: 14px;
  border-radius: 50%;
  left: -8px;
  top: 18px;
  background: #B775FF;
  box-shadow: 0 0 0 4px rgba(183,117,255,.18), 0 0 12px rgba(183,117,255,.4);
  z-index: 1;
}

/* Card container */
.resume-card {
  background: rgba(255,255,255,.035);
  border: 1px solid rgba(183,117,255,.14);
  border-radius: 12px;
  padding: 20px 22px;
  transition: border-color .25s, background .25s;
}
.resume-card:hover {
  background: rgba(183,117,255,.06);
  border-color: rgba(183,117,255,.3);
}

/* Item title */
.resume-card h4 {
  font-size: 19px;
  font-weight: 800;
  color: #ffffff;
  margin: 0 0 12px;
  line-height: 1.35;
  letter-spacing: .06em;
  text-transform: uppercase;
  background: linear-gradient(90deg, #fff 60%, #c99fff 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

/* Period badge */
.resume-card .resume-period {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  font-size: 13px;
  font-weight: 600;
  padding: 5px 14px;
  border-radius: 20px;
  background: rgba(183,117,255,.13);
  border: 1px solid rgba(183,117,255,.28);
  color: #c99fff;
  letter-spacing: .07em;
  margin-bottom: 14px;
}

/* Institution / company */
.resume-card .resume-org {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 15px;
  font-weight: 600;
  color: #c0bdd8;
  margin-bottom: 14px;
  letter-spacing: .01em;
}
.resume-card .resume-org::before {
  content: '';
  width: 4px; height: 4px;
  border-radius: 50%;
  background: #B775FF;
  flex-shrink: 0;
}

/* Description text */
.resume-card p {
  font-size: 15px;
  color: #a8a6c0;
  line-height: 1.95;
  margin: 0;
}

/* Bullet list */
.resume-card ul {
  margin: 6px 0 0;
  padding-left: 20px;
  font-size: 15px;
  color: #a8a6c0;
  line-height: 1.95;
}
.resume-card ul li {
  margin-bottom: 7px;
  padding-left: 4px;
}
.resume-card ul li::marker { color: #B775FF; }

/* Empty state */
.resume-empty {
  font-size: 14px;
  color: #5a5878;
  font-style: italic;
  padding: 12px 0;
}
</style>

<div class="about-page-wrap" style="background:#0F0E10; color:#fff;">

  <!-- ── About Section ─────────────────────────────────────── -->
  <section class="about-section">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>About Me</h2>
        <p>Conheça um pouco mais sobre mim</p>
      </div>

      <div class="row gy-5" data-aos="fade-up" data-aos-delay="100">

        <!-- LEFT: photo + info + skills -->
        <div class="col-lg-5">

          <div class="row gy-4 align-items-start">
            <!-- Photo -->
            <div class="col-sm-5 col-lg-5">
              <?php if (!empty($settings['owner_photo'])): ?>
                <img src="<?= UPLOAD_URL ?>avatars/<?= htmlspecialchars($settings['owner_photo']) ?>"
                     alt="<?= htmlspecialchars($settings['owner_name'] ?? '') ?>"
                     class="about-img">
              <?php else: ?>
                <div class="about-img-placeholder">
                  <i class="bi bi-person-fill"></i>
                </div>
              <?php endif; ?>
            </div>

            <!-- Info -->
            <div class="col-sm-7 col-lg-7 about-info">
              <?php if (!empty($settings['owner_name'])): ?>
              <p><strong>Nome:</strong> <?= htmlspecialchars($settings['owner_name']) ?></p>
              <?php endif; ?>
              <?php if (!empty($settings['owner_title'])): ?>
              <p><strong>Perfil:</strong> <?= htmlspecialchars($settings['owner_title']) ?></p>
              <?php endif; ?>
              <?php if (!empty($settings['owner_email'])): ?>
              <p><strong>Email:</strong> <a href="mailto:<?= htmlspecialchars($settings['owner_email']) ?>"><?= htmlspecialchars($settings['owner_email']) ?></a></p>
              <?php endif; ?>
              <?php if (!empty($settings['owner_phone'])): ?>
              <p><strong>Telefone:</strong> <?= htmlspecialchars($settings['owner_phone']) ?></p>
              <?php endif; ?>
              <?php if (!empty($settings['owner_address'])): ?>
              <p><strong>Local:</strong> <?= htmlspecialchars($settings['owner_address']) ?></p>
              <?php endif; ?>

              <!-- Social links -->
              <?php
              $socials = [
                'social_github'    => ['bi-github',    'GitHub'],
                'social_linkedin'  => ['bi-linkedin',  'LinkedIn'],
                'social_twitter'   => ['bi-twitter-x', 'Twitter'],
                'social_instagram' => ['bi-instagram', 'Instagram'],
              ];
              $hasSocials = false;
              foreach ($socials as $k => $_) { if (!empty($settings[$k])) { $hasSocials = true; break; } }
              if ($hasSocials): ?>
              <div class="about-socials">
                <?php foreach ($socials as $key => [$icon, $label]): ?>
                  <?php if (!empty($settings[$key])): ?>
                  <a href="<?= htmlspecialchars($settings[$key]) ?>" class="about-social-link"
                     target="_blank" rel="noopener" title="<?= $label ?>">
                    <i class="bi <?= $icon ?>"></i>
                  </a>
                  <?php endif; ?>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
            </div>
          </div>

          <!-- Skills -->
          <?php if (!empty($skills)): ?>
          <div class="skills-content">
            <h5>Skills</h5>
            <?php
            // Group by category
            $grouped = [];
            foreach ($skills as $s) {
              $cat = $s['category'] ?? 'Geral';
              $grouped[$cat][] = $s;
            }
            $hasCategories = count($grouped) > 1;
            foreach ($grouped as $cat => $items):
            ?>
            <?php if ($hasCategories): ?>
            <div class="skill-category-label"><?= htmlspecialchars($cat) ?></div>
            <?php endif; ?>
            <?php foreach ($items as $s): ?>
            <div class="progress-wrap">
              <div class="skill-header">
                <span><?= htmlspecialchars($s['name']) ?></span>
                <i><?= (int)$s['level'] ?>%</i>
              </div>
              <div class="progress-bar-wrap">
                <div class="progress-bar-fill" data-width="<?= (int)$s['level'] ?>"></div>
              </div>
            </div>
            <?php endforeach; ?>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>

        </div><!-- /col left -->

        <!-- RIGHT: bio + CV -->
        <div class="col-lg-7 about-me-section ps-lg-5">
          <h4><?= htmlspecialchars($settings['owner_name'] ?? 'Sobre Mim') ?></h4>

          <?php
          $bio = $settings['owner_bio'] ?? '';
          if ($bio):
            foreach (array_filter(array_map('trim', explode("\n", $bio))) as $para): ?>
            <p><?= nl2br(htmlspecialchars($para)) ?></p>
          <?php endforeach;
          else: ?>
            <p style="color:#4a4a6a; font-style:italic;">Nenhuma biografia adicionada ainda. Podes preencher em Admin → Definições.</p>
          <?php endif; ?>

          <?php
          $cvLink = '';
          if (!empty($settings['cv_file'])) {
              $cvLink = UPLOAD_URL . 'cv/' . $settings['cv_file'];
          } elseif (!empty($settings['cv_url'])) {
              $cvLink = $settings['cv_url'];
          }
          ?>
          <?php if ($cvLink): ?>
          <a href="<?= htmlspecialchars($cvLink) ?>" class="cv-btn" target="_blank" rel="noopener">
            <i class="bi bi-download"></i> Download CV
          </a>
          <?php endif; ?>
        </div>

      </div><!-- /row -->
    </div>
  </section>

  <hr class="section-divider">

  <!-- ── Resume Section ────────────────────────────────────── -->
  <section class="resume-section">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>Resume</h2>
        <p>Percurso académico e profissional</p>
      </div>

      <div class="row g-5">

        <!-- LEFT: Summary + Education -->
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">

          <!-- Summary -->
          <?php if (!empty($settings['owner_name'])): ?>
          <h3 class="resume-title">
            <i class="bi bi-person-badge-fill"></i>
            Sumário
          </h3>
          <div class="resume-timeline mb-4">
            <div class="resume-item">
              <div class="resume-card">
                <h4><?= htmlspecialchars($settings['owner_name']) ?></h4>
                <?php if (!empty($settings['resume_summary'])): ?>
                <p><?= nl2br(htmlspecialchars($settings['resume_summary'])) ?></p>
                <?php endif; ?>
                <?php $hasContacts = !empty($settings['owner_address']) || !empty($settings['owner_phone']) || !empty($settings['owner_email']); ?>
                <?php if ($hasContacts): ?>
                <ul style="margin-top:10px;">
                  <?php if (!empty($settings['owner_address'])): ?><li><?= htmlspecialchars($settings['owner_address']) ?></li><?php endif; ?>
                  <?php if (!empty($settings['owner_phone'])): ?><li><?= htmlspecialchars($settings['owner_phone']) ?></li><?php endif; ?>
                  <?php if (!empty($settings['owner_email'])): ?><li><?= htmlspecialchars($settings['owner_email']) ?></li><?php endif; ?>
                </ul>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php endif; ?>

          <!-- Education -->
          <h3 class="resume-title">
            <i class="bi bi-mortarboard-fill"></i>
            Educação
          </h3>
          <?php if (!empty($resume['education'])): ?>
          <div class="resume-timeline">
            <?php foreach ($resume['education'] as $item): ?>
            <div class="resume-item">
              <div class="resume-card">
                <h4><?= htmlspecialchars($item['title']) ?></h4>
                <?php if (!empty($item['period'])): ?>
                <span class="resume-period">
                  <i class="bi bi-calendar3"></i><?= htmlspecialchars($item['period']) ?>
                </span>
                <?php endif; ?>
                <?php if (!empty($item['subtitle'])): ?>
                <div class="resume-org"><?= htmlspecialchars($item['subtitle']) ?></div>
                <?php endif; ?>
                <?php if (!empty($item['description'])): ?>
                <p><?= nl2br(htmlspecialchars($item['description'])) ?></p>
                <?php endif; ?>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <?php else: ?>
            <p class="resume-empty">Nenhuma formação adicionada ainda.</p>
          <?php endif; ?>

        </div>

        <!-- RIGHT: Experience -->
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">

          <h3 class="resume-title">
            <i class="bi bi-briefcase-fill"></i>
            Experiência Profissional
          </h3>
          <?php if (!empty($resume['experience'])): ?>
          <div class="resume-timeline">
            <?php foreach ($resume['experience'] as $item): ?>
            <div class="resume-item">
              <div class="resume-card">
                <h4><?= htmlspecialchars($item['title']) ?></h4>
                <?php if (!empty($item['period'])): ?>
                <span class="resume-period">
                  <i class="bi bi-calendar3"></i><?= htmlspecialchars($item['period']) ?>
                </span>
                <?php endif; ?>
                <?php if (!empty($item['subtitle'])): ?>
                <div class="resume-org"><?= htmlspecialchars($item['subtitle']) ?></div>
                <?php endif; ?>
                <?php if (!empty($item['description'])): ?>
                <?php $lines = array_filter(array_map('trim', explode("\n", $item['description']))); ?>
                <?php if (count($lines) > 1): ?>
                <ul>
                  <?php foreach ($lines as $line): ?>
                  <li><?= htmlspecialchars($line) ?></li>
                  <?php endforeach; ?>
                </ul>
                <?php else: ?>
                <p><?= nl2br(htmlspecialchars($item['description'])) ?></p>
                <?php endif; ?>
                <?php endif; ?>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <?php else: ?>
            <p class="resume-empty">Nenhuma experiência adicionada ainda.</p>
          <?php endif; ?>

        </div>

      </div>
    </div>
  </section>

</div>

<!-- Skill bar animation -->
<script>
(function() {
  function animateBars() {
    document.querySelectorAll('.progress-bar-fill').forEach(function(bar) {
      bar.style.width = bar.dataset.width + '%';
    });
  }
  // Use IntersectionObserver if available, else just animate after load
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(e) {
        if (e.isIntersecting) { animateBars(); observer.disconnect(); }
      });
    }, { threshold: 0.2 });
    var wrap = document.querySelector('.skills-content');
    if (wrap) observer.observe(wrap);
  } else {
    setTimeout(animateBars, 400);
  }
})();
</script>
