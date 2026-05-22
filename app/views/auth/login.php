<?php $pageTitle = 'Sign In — ' . APP_NAME; ?>

<style>
.auth-wrap {
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 100px 16px 60px;
}
.auth-card {
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 20px;
    box-shadow: 0 24px 80px rgba(106,30,188,0.22);
    overflow: hidden;
    background: rgba(255,255,255,0.03);
}
.auth-brand {
    background: linear-gradient(150deg, rgba(106,30,188,0.55) 0%, rgba(12,12,28,0.98) 100%);
    padding: 52px 44px;
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 420px;
}
.auth-brand::before {
    content: '';
    position: absolute;
    width: 260px; height: 260px;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
    top: -70px; right: -70px;
    pointer-events: none;
}
.auth-brand::after {
    content: '';
    position: absolute;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: rgba(106,30,188,0.28);
    bottom: -50px; left: -40px;
    pointer-events: none;
}
.auth-brand-inner { position: relative; z-index: 1; }
.auth-form-panel { padding: 52px 44px; }
.auth-divider {
    height: 1px;
    background: rgba(255,255,255,0.1);
    margin: 28px 0;
}
@media (max-width: 767px) {
    .auth-brand { min-height: auto; padding: 36px 28px; }
    .auth-brand::before, .auth-brand::after { display: none; }
    .auth-form-panel { padding: 36px 28px; }
}
</style>

<section class="auth-wrap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10 col-12">
                <div class="auth-card">
                    <div class="row g-0">

                        <!-- ── Brand panel ───────────────────── -->
                        <div class="col-md-5 auth-brand">
                            <div class="auth-brand-inner">
                                <a href="<?= BASE_URL ?>/" class="text-decoration-none d-block mb-4">
                                    <span class="letter-space text-primary" style="font-size:.7rem;">PORTFOLIO</span>
                                    <h2 class="text-white mb-0 mt-1"
                                        style="font-family:'Bebas Neue',sans-serif; font-size:2.2rem; letter-spacing:.03em; line-height:1;">
                                        <?= htmlspecialchars($settings['site_name'] ?? APP_NAME) ?>
                                    </h2>
                                </a>
                                <div class="auth-divider"></div>
                                <h3 class="text-white mb-3" style="font-size:1.6rem; line-height:1.25; font-weight:700;">
                                    Welcome<br>back<span class="text-primary">.</span>
                                </h3>
                                <p class="text-muted mb-0" style="font-size:.875rem; line-height:1.7;">
                                    Sign in to manage your portfolio and keep everything up to date.
                                </p>
                            </div>
                            <div class="auth-brand-inner mt-4">
                                <p class="mb-0" style="font-size:.82rem; color: rgba(255,255,255,0.4);">
                                    No account yet?
                                </p>
                                <a href="<?= BASE_URL ?>/register"
                                   class="text-primary text-decoration-none fw-medium"
                                   style="font-size:.85rem;">
                                    Create one now →
                                </a>
                            </div>
                        </div>

                        <!-- ── Form panel ────────────────────── -->
                        <div class="col-md-7 auth-form-panel">
                            <p class="letter-space text-muted mb-4" style="font-size:.68rem;">SIGN IN TO YOUR ACCOUNT</p>

                            <?php if ($flash): ?>
                                <div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show mb-4" role="alert">
                                    <?= htmlspecialchars($flash['message']) ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>

                            <form method="POST" action="<?= BASE_URL ?>/login">
                                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

                                <div class="mb-3">
                                    <input type="email" name="email"
                                           placeholder="Your E-mail *"
                                           class="form-control shadow-none ps-3 py-3"
                                           required autofocus autocomplete="email">
                                </div>
                                <div class="mb-4">
                                    <input type="password" name="password"
                                           placeholder="Your Password *"
                                           class="form-control shadow-none ps-3 py-3"
                                           required autocomplete="current-password">
                                </div>

                                <button type="submit"
                                        class="btn button rounded-pill position-relative pe-5 w-100">
                                    <span>Sign In</span>
                                    <div class="position-absolute top-50 end-0 translate-middle-y me-2">
                                        <svg class="arrow-right bg-white text-black rounded-circle p-2" width="35" height="35">
                                            <use xlink:href="#arrow-right"></use>
                                        </svg>
                                    </div>
                                </button>
                            </form>
                        </div>

                    </div><!-- /row g-0 -->
                </div><!-- /auth-card -->
            </div>
        </div>
    </div>
</section>
