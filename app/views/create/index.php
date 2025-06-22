<?php require_once 'app/views/templates/headerPublic.php'; ?>

<main class="d-flex justify-content-center align-items-center min-vh-100">

  <div class="card shadow p-4" style="max-width:420px; width:100%">

    <h3 class="mb-3 text-center">Create account</h3>

    <?php if (!empty($_SESSION['flash'])): ?>
      <div class="alert alert-info small">
        <?= htmlspecialchars($_SESSION['flash']); unset($_SESSION['flash']); ?>
      </div>
    <?php endif; ?>

    <form action="/create/store" method="post" id="regForm" novalidate>
      <!-- Username -->
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input name="username" class="form-control" required autocomplete="username">
      </div>

      <!-- Password -->
      <div class="mb-3 position-relative">
        <label class="form-label">Password</label>
        <input type="password" name="password" id="pwd"
               class="form-control" required autocomplete="new-password">
        <span class="position-absolute top-50 end-0 translate-middle-y me-3"
              id="togglePwd" style="cursor:pointer">
          <i data-feather="eye"></i>
        </span>
      </div>

      <!-- Confirm -->
      <div class="mb-3 position-relative">
        <label class="form-label">Confirm password</label>
        <input type="password" name="confirm" id="pwd2"
               class="form-control" required autocomplete="new-password">
        <span class="position-absolute top-50 end-0 translate-middle-y me-3"
              id="togglePwd2" style="cursor:pointer">
          <i data-feather="eye"></i>
        </span>
        <div class="invalid-feedback">Passwords do not match.</div>
      </div>

      <!-- Live checklist -->
      <ul class="list-unstyled small ps-1 mb-3" id="pwdChecklist">
        <li id="chkLen"> ≥ 8 characters</li>
        <li id="chkUpper">Upper-case letter</li>
        <li id="chkLower">Lower-case letter</li>
        <li id="chkDigit">Number</li>
        <li id="chkSpecial">Special character</li>
      </ul>

      <button class="btn btn-primary w-100" id="submitBtn" disabled>
        Create account
      </button>
    </form>

    <p class="text-center mt-3 mb-0 small">
      Already have an account? <a href="/login">Log in</a>
    </p>
  </div>

</main>

<style>
  /* green tick styling */
  #pwdChecklist li.done { color:#198754; font-weight:600; }
</style>

<script>
/* ---------- live validation ---------- */
const pwd  = document.getElementById('pwd');
const pwd2 = document.getElementById('pwd2');
const btn  = document.getElementById('submitBtn');
const list = {
  len : document.getElementById('chkLen'),
  up  : document.getElementById('chkUpper'),
  lo  : document.getElementById('chkLower'),
  num : document.getElementById('chkDigit'),
  spec: document.getElementById('chkSpecial'),
};

[pwd, pwd2].forEach(i => i.addEventListener('input', validate));

function validate() {
  const v = pwd.value;
  const ok = [
    set(list.len , v.length >= 8),
    set(list.up  , /[A-Z]/.test(v)),
    set(list.lo  , /[a-z]/.test(v)),
    set(list.num , /\d/.test(v)),
    set(list.spec, /[^A-Za-z0-9]/.test(v))
  ].every(Boolean);

  const match = v !== '' && v === pwd2.value;
  pwd2.classList.toggle('is-invalid', !match && pwd2.value !== '');
  btn.disabled = !(ok && match);
}

function set(el, ok) { el.classList.toggle('done', ok); return ok; }

  /* eye toggle */
  document.getElementById('togglePwd').onclick = () => {
    const pw = document.getElementById('pwd');
    pw.type = pw.type === 'password' ? 'text' : 'password';
  };

  /* wait until the page is parsed AND external scripts have run */
  window.addEventListener('DOMContentLoaded', () => {
    if (window.feather) feather.replace();
  });
</script>

<?php require_once 'app/views/templates/footer.php'; ?>
