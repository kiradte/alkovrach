'use strict';

const API_ENDPOINT = '/api/lead.php';

function getFocusable(root) {
  const sel = [
    'a[href]',
    'button:not([disabled])',
    'textarea:not([disabled])',
    'input:not([disabled])',
    'select:not([disabled])',
    '[tabindex]:not([tabindex="-1"])'
  ].join(',');
  return Array.from(root.querySelectorAll(sel)).filter(el => {
    return el.offsetParent !== null || el.getAttribute('aria-label') === 'Закрыть';
  });
}

function lockBodyScroll() { document.body.classList.add('is-modal-open'); }
function unlockBodyScroll() { document.body.classList.remove('is-modal-open'); }

function ensureFieldErrorEl(fieldEl) {
  const wrap = fieldEl.closest('.field') || fieldEl.parentElement;
  if (!wrap) return null;
  let errEl = wrap.querySelector('.field__error');
  if (!errEl) {
    errEl = document.createElement('div');
    errEl.className = 'field__error';
    errEl.setAttribute('role', 'alert');
    errEl.style.marginTop = '6px';
    wrap.appendChild(errEl);
  }
  return errEl;
}
function showFieldError(fieldEl, msg) {
  if (!fieldEl) return;
  fieldEl.classList.add('is-invalid');
  fieldEl.setAttribute('aria-invalid', 'true');
  const err = ensureFieldErrorEl(fieldEl);
  if (err) err.textContent = msg || '';
}
function clearFieldErrors(form) {
  form.querySelectorAll('.is-invalid').forEach(i => {
    i.classList.remove('is-invalid');
    i.removeAttribute('aria-invalid');
  });
  form.querySelectorAll('.field__error').forEach(el => (el.textContent = ''));
}
function focusErrorBox(box) {
  if (!box) return;
  box.setAttribute('tabindex', '-1');
  box.focus();
  setTimeout(() => box.removeAttribute('tabindex'), 0);
}

function initReviewsModal() {
  const modal = document.getElementById('review-modal');
  if (!modal) return;

  const dialog   = modal.querySelector('.modal__dialog');
  const closeBtn = modal.querySelector('.modal__close');

  const titleEl = modal.querySelector('#review-modal-title');
  const textEl  = modal.querySelector('#review-modal-text');
  const dateEl  = modal.querySelector('#review-modal-date');

  let lastActiveEl = null;
  let trapHandler  = null;
  let escHandler   = null;

  const trapFocus = (e) => {
    if (e.key !== 'Tab') return;
    const focusable = getFocusable(dialog);
    if (!focusable.length) return;
    const [first] = focusable;
    const last  = focusable[focusable.length - 1];
    if (e.shiftKey && document.activeElement === first) {
      e.preventDefault(); last.focus();
    } else if (!e.shiftKey && document.activeElement === last) {
      e.preventDefault(); first.focus();
    }
  };
  const onEsc = (e) => { if (e.key === 'Escape') closeModal(); };

  function openModal({ title, html, dateText, dateISO, returnFocusTo }) {
    titleEl.textContent = title || '';
    textEl.innerHTML    = html || '';
    if (dateText) dateEl.textContent = dateText;
    if (dateISO)  dateEl.setAttribute('datetime', dateISO);

    lastActiveEl = returnFocusTo || document.activeElement;

    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden', 'false');
    lockBodyScroll();

    trapHandler = trapFocus;
    escHandler  = onEsc;
    dialog.addEventListener('keydown', trapHandler);
    document.addEventListener('keydown', escHandler);

    setTimeout(() => closeBtn.focus(), 0);
  }

  function closeModal() {
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    unlockBodyScroll();

    if (trapHandler) dialog.removeEventListener('keydown', trapHandler);
    if (escHandler)  document.removeEventListener('keydown', escHandler);
    trapHandler = escHandler = null;

    if (lastActiveEl && typeof lastActiveEl.focus === 'function') {
      lastActiveEl.focus();
    }
    lastActiveEl = null;
  }

  document.addEventListener('click', (e) => {
    const link = e.target.closest('.js-review-more');
    if (!link) return;
    e.preventDefault();

    const card = link.closest('.review-card');
    if (!card) return;

    const author  = (card.querySelector('.review-card__author')?.textContent || '').trim();
    const timeEl  = card.querySelector('time');
    const dateTxt = (timeEl?.textContent || '').trim();
    const dateISO = timeEl?.getAttribute('datetime') || '';

    let html = '';
    const tplSel = link.dataset.reviewTpl;
    if (tplSel) {
      const tpl = card.querySelector(tplSel) || document.querySelector(tplSel);
      if (tpl && 'content' in tpl) {
        const frag = tpl.content.cloneNode(true);
        const wrap = document.createElement('div');
        wrap.appendChild(frag);
        html = wrap.innerHTML;
      }
    }
    if (!html) {
      const shortText = card.querySelector('.review-card__text');
      html = shortText ? shortText.innerHTML : '';
    }

    openModal({
      title: author,
      html,
      dateText: dateTxt,
      dateISO,
      returnFocusTo: link
    });
  });

  modal.addEventListener('click', (e) => {
    const isOverlay = e.target.closest('[data-modal-close="overlay"]');
    const isBtn     = e.target.closest('[data-modal-close="button"]');
    if (isOverlay || isBtn) {
      e.preventDefault(); closeModal();
    }
  });

  window.addEventListener('pageshow', () => {
    modal.setAttribute('aria-hidden', modal.classList.contains('is-open') ? 'false' : 'true');
  });
}

function initCallbackModal() {
  const modal = document.getElementById('callback-modal');
  if (!modal) return;

  const dialog    = modal.querySelector('.modal__dialog');
  const closeBtn  = modal.querySelector('.modal__close');
  const titleEl   = modal.querySelector('#callback-title');

  const form      = modal.querySelector('#callback-form');
  const errorBox  = modal.querySelector('#callback-error');
  const successEl = modal.querySelector('#callback-success');
  const submitBtn = modal.querySelector('#cb-submit');

  const nameInput  = modal.querySelector('#cb-name');
  const emailInput = modal.querySelector('#cb-email');
  const phoneInput = modal.querySelector('#cb-phone');
  const sourceInput= modal.querySelector('input[name="source"]');

  let lastActiveEl = null;
  let trapHandler  = null;
  let escHandler   = null;

  const trapFocus = (e) => {
    if (e.key !== 'Tab') return;
    const focusable = getFocusable(dialog);
    if (!focusable.length) return;
    const [first] = focusable;
    const last  = focusable[focusable.length - 1];
    if (e.shiftKey && document.activeElement === first) {
      e.preventDefault(); last.focus();
    } else if (!e.shiftKey && document.activeElement === last) {
      e.preventDefault(); first.focus();
    }
  };
  const onEsc = (e) => { if (e.key === 'Escape') close(); };

  function open(trigger) {
    lastActiveEl = trigger || document.activeElement;

    const newTitle = trigger?.dataset?.modalTitle;
    if (newTitle) titleEl.textContent = newTitle;
    const src = trigger?.dataset?.source;
    if (src && sourceInput) sourceInput.value = src;

    errorBox.hidden = true;
    errorBox.textContent = '';
    successEl.hidden = true;
    form.hidden = false;
    clearFieldErrors(form);
    form.reset();

    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden', 'false');
    lockBodyScroll();

    trapHandler = trapFocus;
    escHandler  = onEsc;
    dialog.addEventListener('keydown', trapHandler);
    document.addEventListener('keydown', escHandler);

    setTimeout(() => (nameInput?.focus() || closeBtn.focus()), 0);
  }

  function close() {
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    unlockBodyScroll();

    if (trapHandler) dialog.removeEventListener('keydown', trapHandler);
    if (escHandler)  document.removeEventListener('keydown', escHandler);
    trapHandler = escHandler = null;

    if (lastActiveEl && typeof lastActiveEl.focus === 'function') {
      lastActiveEl.focus();
    }
    lastActiveEl = null;
  }

  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.js-open-callback');
    if (!btn) return;
    e.preventDefault();
    open(btn);
  });

  modal.addEventListener('click', (e) => {
    const isOverlay = e.target.closest('[data-modal-close="overlay"]');
    const isBtn     = e.target.closest('[data-modal-close="button"]');
    if (isOverlay || isBtn) {
      e.preventDefault(); close();
    }
  });

  [nameInput, emailInput, phoneInput].forEach(inp => {
    if (!inp) return;
    inp.addEventListener('input', () => {
      inp.classList.remove('is-invalid');
      inp.removeAttribute('aria-invalid');
      const err = (inp.closest('.field') || inp.parentElement)?.querySelector('.field__error');
      if (err) err.textContent = '';
    });
  });

  function validateFront() {
    const name  = (nameInput.value || '').trim();
    const email = (emailInput.value || '').trim();
    const phone = (phoneInput.value || '').trim();

    clearFieldErrors(form);

    let firstErr = '';

    if (name.length < 2) {
      showFieldError(nameInput, 'Укажите корректное имя (не короче 2 символов).');
      firstErr ||= 'Проверьте поля формы';
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      showFieldError(emailInput, 'Укажите корректный email.');
      firstErr ||= 'Проверьте поля формы';
    }
    if (phone.replace(/\D+/g, '').length < 10) {
      showFieldError(phoneInput, 'Укажите корректный телефон.');
      firstErr ||= 'Проверьте поля формы';
    }
    return firstErr;
  }

  async function submitLead(ev) {
    ev.preventDefault();

    errorBox.hidden = true;
    errorBox.textContent = '';

    const frontError = validateFront();
    if (frontError) {
      errorBox.textContent = frontError;
      errorBox.hidden = false;
      focusErrorBox(errorBox);
      return;
    }

    submitBtn.disabled = true;
    const oldText = submitBtn.textContent;
    submitBtn.textContent = 'Отправляем...';

    const fd = new FormData(form);

    try {
      const res = await fetch(API_ENDPOINT, {
        method: 'POST',
        body: fd,
        headers: { 'Accept': 'application/json' }
      });

      let data = null;
      try { data = await res.json(); } catch (_) {
        const txt = await res.text();
        data = { ok: false, message: txt || 'Ошибка ответа сервера' };
      }

      if (res.status === 422 && data && data.errors) {
        clearFieldErrors(form);
        if (data.errors.name)  showFieldError(nameInput,  data.errors.name);
        if (data.errors.email) showFieldError(emailInput, data.errors.email);
        if (data.errors.phone) showFieldError(phoneInput, data.errors.phone);
        errorBox.textContent = data.message || 'Проверьте поля формы';
        errorBox.hidden = false;
        focusErrorBox(errorBox);
        return;
      }

      if (res.status === 409) {
        showFieldError(emailInput, '');
        showFieldError(phoneInput, '');
        errorBox.textContent = (data && data.message) || 'Заявка уже отправлялась недавно.';
        errorBox.hidden = false;
        focusErrorBox(errorBox);
        return;
      }

      if (!res.ok || !data || data.ok !== true) {
        throw new Error((data && data.message) || `Ошибка сервера (${res.status})`);
      }

      form.hidden = true;
      successEl.hidden = false;

    } catch (err) {
      errorBox.textContent = err.message || 'Ошибка соединения';
      errorBox.hidden = false;
      focusErrorBox(errorBox);
    } finally {
      submitBtn.disabled = false;
      submitBtn.textContent = oldText;
    }
  }

  form.addEventListener('submit', submitLead);
}

function bootstrap() {
  initReviewsModal();
  initCallbackModal();
}
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', bootstrap);
} else {
  bootstrap();
}

(function () {
  'use strict';
  var $  = function (sel, root) { return (root || document).querySelector(sel); };
  var $$ = function (sel, root) { return [].slice.call((root || document).querySelectorAll(sel)); };

  var gallery = $('.staff__gallery');
  if (!gallery) return;

  var cards = $$('.staff-card', gallery);
  var track = document.createElement('div');
  track.className = 'staff__track';
  cards.forEach(function (c) { track.appendChild(c); });
  gallery.appendChild(track);

  var prevBtn = $('.staff__nav-btn--prev');
  var nextBtn = $('.staff__nav-btn--next');
  var nameEl  = $('.staff__name');
  var specEl  = $('.staff__link');
  var expEl   = $('.staff__exp');

  var index = Math.max(0, cards.findIndex(function (c){ return c.classList.contains('is-active'); }));
  if (index === -1) index = 0;

  function stepWidth() {
    var first = cards[0];
    if (!first) return 0;
    var cardW = first.getBoundingClientRect().width;
    var gap = parseFloat(getComputedStyle(track).gap || '28');
    return cardW + gap;
  }

  function updateInfo(card) {
    if (!card) return;
    if (nameEl && card.dataset.name) nameEl.textContent = card.dataset.name;
    if (specEl) {
      if (card.dataset.spec) specEl.textContent = card.dataset.spec;
      if (card.dataset.link) specEl.setAttribute('href', card.dataset.link);
    }
    if (expEl && card.dataset.exp) expEl.textContent = card.dataset.exp;
  }

  function render() {
    var offset = -index * stepWidth();
    track.style.transform = 'translate3d(' + offset + 'px,0,0)';

    cards.forEach(function (c, i) {
      c.classList.toggle('is-active', i === index);
      c.setAttribute('aria-selected', i === index ? 'true' : 'false');
      if (i === index) c.setAttribute('tabindex', '0'); else c.removeAttribute('tabindex');
    });

    prevBtn && (prevBtn.disabled = (index === 0));
    nextBtn && (nextBtn.disabled = (index === cards.length - 1));

    updateInfo(cards[index]);
  }

  function go(delta) {
    var next = Math.min(Math.max(index + delta, 0), cards.length - 1);
    if (next === index) return;
    index = next;
    render();
  }

  prevBtn && prevBtn.addEventListener('click', function(){ go(-1); });
  nextBtn && nextBtn.addEventListener('click', function(){ go(+1); });

  cards.forEach(function (c, i) {
    c.addEventListener('click', function(){ index = i; render(); });
  });

  gallery.setAttribute('tabindex', '0');
  gallery.addEventListener('keydown', function(e){
    if (e.key === 'ArrowRight') { e.preventDefault(); go(+1); }
    if (e.key === 'ArrowLeft')  { e.preventDefault(); go(-1); }
  });

  window.addEventListener('resize', function(){ render(); });

  render();
})();

(function () {
  var input = document.getElementById('ctaMotivationPhone');
  if (!input) return;

  input.setAttribute('maxlength', '18');
  input.setAttribute('placeholder', '+7 (912) 345-67-89');

  function formatPhone(v) {
    var digits = (v + '').replace(/\D/g, '');
    if (digits[0] === '8') digits = '7' + digits.slice(1);
    if (digits[0] !== '7') digits = '7' + digits;
    digits = digits.slice(0, 11);

    var code   = digits.slice(1, 4);
    var part1  = digits.slice(4, 7);
    var part2  = digits.slice(7, 9);
    var part3  = digits.slice(9, 11);

    var out = '+7';
    if (code)  out += ' (' + code + (code.length === 3 ? ')' : '');
    if (part1) out += (code.length === 3 ? ' ' : '') + part1;
    if (part2) out += '-' + part2;
    if (part3) out += '-' + part3;

    return out;
  }

  function onFocus() {
    if (!input.value.trim()) input.value = '+7 ';
  }

  function onInput() {
    var valBefore = input.value;
    input.value = formatPhone(valBefore);
    var end = input.value.length;
    input.setSelectionRange(end, end);
  }

  function onKeyDown(e) {
    if ((e.key === 'Backspace' || e.key === 'Delete') && input.selectionStart <= 3) {
      e.preventDefault();
    }
  }

  function onPaste(e) {
    e.preventDefault();
    var text = (e.clipboardData || window.clipboardData).getData('text') || '';
    input.value = formatPhone(text);
    var end = input.value.length;
    input.setSelectionRange(end, end);
  }

  input.addEventListener('focus', onFocus);
  input.addEventListener('input', onInput);
  input.addEventListener('keydown', onKeyDown);
  input.addEventListener('paste', onPaste);

  var form = document.getElementById('cta-motivation-form');
  if (form) {
    form.addEventListener('submit', function () {
      input.value = formatPhone(input.value);
      var raw = input.value.replace(/[^\d]/g, '');
      if (raw[0] === '8') raw = '7' + raw.slice(1);
      if (raw[0] !== '7') raw = '7' + raw.slice(0, 10);
      var hidden = form.querySelector('input[name="phone_raw"]');
      if (!hidden) {
        hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'phone_raw';
        form.appendChild(hidden);
      }
      hidden.value = '+' + raw.slice(0, 11);
    });
  }
})();

(function () {
  var input = document.getElementById('faqPhone');
  if (!input) return;

  input.setAttribute('maxlength', '18');
  input.setAttribute('placeholder', '+7 (912) 345-67-89');

  function formatPhone(v) {
    var digits = (v + '').replace(/\D/g, '');
    if (digits[0] === '8') digits = '7' + digits.slice(1);
    if (digits[0] !== '7') digits = '7' + digits;
    digits = digits.slice(0, 11);

    var code  = digits.slice(1, 4);
    var part1 = digits.slice(4, 7);
    var part2 = digits.slice(7, 9);
    var part3 = digits.slice(9, 11);

    var out = '+7';
    if (code)  out += ' (' + code + (code.length === 3 ? ')' : '');
    if (part1) out += (code.length === 3 ? ' ' : '') + part1;
    if (part2) out += '-' + part2;
    if (part3) out += '-' + part3;

    return out;
  }

  function onFocus() {
    if (!input.value.trim()) input.value = '+7 ';
  }

  function onInput() {
    var valBefore = input.value;
    input.value = formatPhone(valBefore);
    var end = input.value.length;
    input.setSelectionRange(end, end);
  }

  function onKeyDown(e) {
    if ((e.key === 'Backspace' || e.key === 'Delete') && input.selectionStart <= 3) {
      e.preventDefault();
    }
  }

  function onPaste(e) {
    e.preventDefault();
    var text = (e.clipboardData || window.clipboardData).getData('text') || '';
    input.value = formatPhone(text);
    var end = input.value.length;
    input.setSelectionRange(end, end);
  }

  input.addEventListener('focus', onFocus);
  input.addEventListener('input', onInput);
  input.addEventListener('keydown', onKeyDown);
  input.addEventListener('paste', onPaste);

  var form = document.getElementById('faq-form');
  if (form) {
    form.addEventListener('submit', function () {
      input.value = formatPhone(input.value);
      var raw = input.value.replace(/[^\d]/g, '');
      if (raw[0] === '8') raw = '7' + raw.slice(1);
      if (raw[0] !== '7') raw = '7' + raw.slice(0, 10);
      var hidden = form.querySelector('input[name="phone_raw"]');
      if (!hidden) {
        hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'phone_raw';
        form.appendChild(hidden);
      }
      hidden.value = '+' + raw.slice(0, 11);
    });
  }
})();

(function(){
  document.documentElement.classList.add('js');

  function lineHeightPx(el){
    const cs = getComputedStyle(el);
    const lh = cs.lineHeight;
    if (lh === 'normal') return 1.2 * parseFloat(cs.fontSize);
    if (/\d+$/.test(lh)) return parseFloat(lh) * parseFloat(cs.fontSize);
    return parseFloat(lh);
  }

  function isOverflowing(textEl){
    const cs = getComputedStyle(textEl);
    const lines = parseInt((cs.getPropertyValue('--lines') || '6').trim(), 10) || 6;
    const lh = lineHeightPx(textEl);
    const visibleH = Math.ceil(lh * lines);

    const prev = {
      display: textEl.style.display,
      webkitLineClamp: textEl.style.webkitLineClamp,
      webkitBoxOrient: textEl.style.webkitBoxOrient,
      overflow: textEl.style.overflow,
      maxHeight: textEl.style.maxHeight
    };
    textEl.style.display = 'block';
    textEl.style.webkitLineClamp = 'unset';
    textEl.style.webkitBoxOrient = 'unset';
    textEl.style.overflow = 'visible';
    textEl.style.maxHeight = 'none';

    const fullH = textEl.scrollHeight;

    textEl.style.display = prev.display;
    textEl.style.webkitLineClamp = prev.webkitLineClamp;
    textEl.style.webkitBoxOrient = prev.webkitBoxOrient;
    textEl.style.overflow = prev.overflow;
    textEl.style.maxHeight = prev.maxHeight;

    return fullH > (visibleH + 2);
  }

  function update(){
    document.querySelectorAll('.reviews .review-card').forEach(function(card){
      const text = card.querySelector('.review-card__text');
      if (!text) return;
      card.classList.toggle('has-more', isOverflowing(text));
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', update);
  } else {
    update();
  }

  let t; 
  window.addEventListener('resize', function(){
    clearTimeout(t);
    t = setTimeout(update, 150);
  });
})();

(function () {
  var input = document.getElementById('cb-phone');
  if (!input) return;

  input.setAttribute('maxlength', '18');
  input.setAttribute('placeholder', '+7 (912) 345-67-89');

  function formatPhone(v) {
    var digits = (v + '').replace(/\D/g, '');
    if (digits[0] === '8') digits = '7' + digits.slice(1);
    if (digits[0] !== '7') digits = '7' + digits;
    digits = digits.slice(0, 11);

    var code  = digits.slice(1, 4);
    var part1 = digits.slice(4, 7);
    var part2 = digits.slice(7, 9);
    var part3 = digits.slice(9, 11);

    var out = '+7';
    if (code)  out += ' (' + code + (code.length === 3 ? ')' : '');
    if (part1) out += (code.length === 3 ? ' ' : '') + part1;
    if (part2) out += '-' + part2;
    if (part3) out += '-' + part3;

    return out;
  }

  function onFocus() {
    if (!input.value.trim()) input.value = '+7 ';
  }

  function onInput() {
    input.value = formatPhone(input.value);
    var end = input.value.length;
    input.setSelectionRange(end, end);
  }

  function onKeyDown(e) {
    if ((e.key === 'Backspace' || e.key === 'Delete') && input.selectionStart <= 3) {
      e.preventDefault();
    }
  }

  function onPaste(e) {
    e.preventDefault();
    var text = (e.clipboardData || window.clipboardData).getData('text') || '';
    input.value = formatPhone(text);
    var end = input.value.length;
    input.setSelectionRange(end, end);
  }

  input.addEventListener('focus', onFocus);
  input.addEventListener('input', onInput);
  input.addEventListener('keydown', onKeyDown);
  input.addEventListener('paste', onPaste);

  var form = document.getElementById('callback-form');
  if (form) {
    form.addEventListener('submit', function () {
      input.value = formatPhone(input.value);
      var raw = input.value.replace(/[^\d]/g, '');
      if (raw[0] === '8') raw = '7' + raw.slice(1);
      if (raw[0] !== '7') raw = '7' + raw.slice(0, 10);
      var hidden = form.querySelector('input[name="phone_raw"]');
      if (!hidden) {
        hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'phone_raw';
        form.appendChild(hidden);
      }
      hidden.value = '+' + raw.slice(0, 11);
    });
  }
})();

(function () {
  'use strict';

  var burger = document.querySelector('.js-burger');
  var menu   = document.getElementById('mobile-menu');
  if (!burger || !menu) return;

  var panel  = menu.querySelector('.mobile-menu__panel');
  var closeNodes = menu.querySelectorAll('.js-burger-close');
  var linkNodes  = menu.querySelectorAll('.mobile-nav__list a');
  var previouslyFocused = null;
  var BREAKPOINT = 920;

  if (panel && !panel.hasAttribute('tabindex')) {
    panel.setAttribute('tabindex', '-1');
  }

  var focusSelectors = [
    'a[href]',
    'button:not([disabled])',
    'input:not([disabled])',
    'select:not([disabled])',
    'textarea:not([disabled])',
    '[tabindex]:not([tabindex="-1"])'
  ].join(',');

  function getFocusable() {
    return Array.prototype.slice.call(panel.querySelectorAll(focusSelectors))
      .filter(function (el) {
        return !!(el.offsetWidth || el.offsetHeight || el.getClientRects().length);
      });
  }

  function openMenu() {
    if (!menu.hasAttribute('hidden')) return;
    previouslyFocused = document.activeElement;

    menu.removeAttribute('hidden');
    document.body.classList.add('is-menu-open');
    burger.setAttribute('aria-expanded', 'true');

    var focusables = getFocusable();
    (focusables[0] || panel).focus();

    document.addEventListener('keydown', onKeyDown, true);
  }

  function closeMenu() {
    if (menu.hasAttribute('hidden')) return;

    document.body.classList.remove('is-menu-open');
    menu.setAttribute('hidden', '');
    burger.setAttribute('aria-expanded', 'false');

    document.removeEventListener('keydown', onKeyDown, true);

    if (previouslyFocused && previouslyFocused.focus) {
      previouslyFocused.focus();
    } else {
      burger.focus();
    }
    previouslyFocused = null;
  }

  function toggleMenu() {
    if (menu.hasAttribute('hidden')) openMenu();
    else closeMenu();
  }

  function onKeyDown(e) {
    var key = e.key || e.keyCode;

    if (key === 'Escape' || key === 'Esc' || key === 27) {
      e.preventDefault();
      closeMenu();
      return;
    }

    if (key === 'Tab' || key === 9) {
      var focusables = getFocusable();
      if (!focusables.length) {
        e.preventDefault();
        return;
      }
      var first = focusables[0];
      var last  = focusables[focusables.length - 1];

      if (e.shiftKey && document.activeElement === first) {
        e.preventDefault();
        last.focus();
      } else if (!e.shiftKey && document.activeElement === last) {
        e.preventDefault();
        first.focus();
      }
    }
  }

  burger.addEventListener('click', toggleMenu);

  Array.prototype.forEach.call(closeNodes, function (el) {
    el.addEventListener('click', closeMenu);
  });

  Array.prototype.forEach.call(linkNodes, function (a) {
    a.addEventListener('click', closeMenu);
  });

  window.addEventListener('resize', function () {
    if (window.innerWidth > BREAKPOINT && !menu.hasAttribute('hidden')) {
      closeMenu();
    }
  });

  document.addEventListener('visibilitychange', function () {
    if (document.visibilityState === 'visible') {
      burger.setAttribute('aria-expanded', menu.hasAttribute('hidden') ? 'false' : 'true');
    }
  });
})();

(function () {
  var input = document.getElementById('qPhone');
  if (!input) return;

  input.setAttribute('maxlength', '18');
  input.setAttribute('placeholder', '+7 (912) 345-67-89');

  function formatPhone(v) {
    var digits = (v + '').replace(/\D/g, '');
    if (digits[0] === '8') digits = '7' + digits.slice(1);
    if (digits[0] !== '7') digits = '7' + digits;
    digits = digits.slice(0, 11);

    var code  = digits.slice(1, 4);
    var part1 = digits.slice(4, 7);
    var part2 = digits.slice(7, 9);
    var part3 = digits.slice(9, 11);

    var out = '+7';
    if (code)  out += ' (' + code + (code.length === 3 ? ')' : '');
    if (part1) out += (code.length === 3 ? ' ' : '') + part1;
    if (part2) out += '-' + part2;
    if (part3) out += '-' + part3;

    return out;
  }

  function onFocus() {
    if (!input.value.trim()) input.value = '+7 ';
  }

  function onInput() {
    var valBefore = input.value;
    input.value = formatPhone(valBefore);
    var end = input.value.length;
    input.setSelectionRange(end, end);
  }

  function onKeyDown(e) {
    if ((e.key === 'Backspace' || e.key === 'Delete') && input.selectionStart <= 3) {
      e.preventDefault();
    }
  }

  function onPaste(e) {
    e.preventDefault();
    var text = (e.clipboardData || window.clipboardData).getData('text') || '';
    input.value = formatPhone(text);
    var end = input.value.length;
    input.setSelectionRange(end, end);
  }

  input.addEventListener('focus', onFocus);
  input.addEventListener('input', onInput);
  input.addEventListener('keydown', onKeyDown);
  input.addEventListener('paste', onPaste);

  var form = document.getElementById('questions-form');
  if (form) {
    form.addEventListener('submit', function () {
      input.value = formatPhone(input.value);
      var raw = input.value.replace(/[^\d]/g, '');
      if (raw[0] === '8') raw = '7' + raw.slice(1);
      if (raw[0] !== '7') raw = '7' + raw.slice(0, 10);

      var hidden = form.querySelector('input[name="phone_raw"]');
      if (!hidden) {
        hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'phone_raw';
        form.appendChild(hidden);
      }
      hidden.value = '+' + raw.slice(0, 11);
    });
  }
})();

(function () {
  'use strict';

  function initAboutSlider(root) {
    var track = root.querySelector('.about__track');
    if (!track) return;

    var slides = [].slice.call(root.querySelectorAll('.about__slide'));
    if (slides.length <= 1) return;

    var prev = root.querySelector('.about__nav-btn--prev');
    var next = root.querySelector('.about__nav-btn--next');
    var index = 0;

    function go(n) {
      index = (n + slides.length) % slides.length;
      track.style.transform = 'translate3d(-' + (index * 100) + '%,0,0)';
    }

    prev && prev.addEventListener('click', function () { go(index - 1); });
    next && next.addEventListener('click', function () { go(index + 1); });

    var startX = 0, down = false, pid = null;
    track.addEventListener('pointerdown', function (e) {
      down = true; startX = e.clientX; pid = e.pointerId;
      track.setPointerCapture(pid);
    });
    track.addEventListener('pointerup', function (e) {
      if (!down) return;
      var dx = e.clientX - startX;
      down = false;
      if (Math.abs(dx) > 40) (dx < 0 ? go(index + 1) : go(index - 1));
    });
    track.addEventListener('pointercancel', function () { down = false; });
    track.addEventListener('dragstart', function (e) { e.preventDefault(); });

    go(0);
  }

  document.addEventListener('DOMContentLoaded', function () {
    var media = document.querySelectorAll('.about__media');
    [].forEach.call(media, initAboutSlider);
  });
})();

(function () {
  if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  var acc = document.querySelector('.faq__accordion');
  if (!acc) return;

  acc.addEventListener('click', function (e) {
    var summary = e.target.closest('.faq-item__summary');
    if (!summary) return;

    var details = summary.parentNode;
    var content = summary.nextElementSibling;
    if (!content) return;

    e.preventDefault();

    if (details.dataset.animating === '1') return;
    details.dataset.animating = '1';

    var opening = !details.open;

    content.style.overflow = 'hidden';
    content.style.transition = 'height 220ms ease';

    if (opening) {
      details.open = true;
      content.style.height = '0px';
      content.offsetHeight;
      content.style.height = content.scrollHeight + 'px';
    } else {
      content.style.height = content.scrollHeight + 'px';
      content.offsetHeight;
      content.style.height = '0px';
    }

    content.addEventListener('transitionend', function onEnd(ev) {
      if (ev.propertyName !== 'height') return;
      content.removeEventListener('transitionend', onEnd);

      if (!opening) details.open = false;

      content.style.transition = '';
      content.style.height = '';
      content.style.overflow = '';

      details.dataset.animating = '0';
    }, { once: true });
  });
})();

(function () {
  var mq = window.matchMedia('(max-width: 560px)');
  var grid = document.querySelector('.reviews__grid');
  if (!grid) return;

  function initMobileSlider() {
    if (grid.classList.contains('is-slider')) return;
    var cards = Array.prototype.slice.call(grid.querySelectorAll('.review-card'));
    if (cards.length < 2 || !mq.matches) return;

    grid.classList.add('is-slider');

    var track = document.createElement('div');
    track.className = 'reviews__track';
    cards.forEach(function (card) { track.appendChild(card); });
    grid.appendChild(track);

    var index = 0;
    var prevBtn = document.querySelector('.reviews__nav-btn--prev');
    var nextBtn = document.querySelector('.reviews__nav-btn--next');

    function clamp(n, min, max) { return Math.max(min, Math.min(max, n)); }
    function update() { track.style.transform = 'translateX(' + (-index * 100) + '%)'; }
    function setDisabled() {
      if (prevBtn) prevBtn.disabled = (index === 0);
      if (nextBtn) nextBtn.disabled = (index === cards.length - 1);
    }
    function go(to) { index = clamp(to, 0, cards.length - 1); update(); setDisabled(); }

    if (prevBtn) prevBtn.addEventListener('click', function () { go(index - 1); });
    if (nextBtn) nextBtn.addEventListener('click', function () { go(index + 1); });

    var startX = 0, curX = 0, active = false, t0 = 0;
    var threshold = 40;
    var timeLimit = 500;

    function start(e) {
      active = true;
      t0 = Date.now();
      startX = (e.touches ? e.touches[0].clientX : e.clientX);
      curX = startX;
      track.style.transition = 'none';
    }
    function move(e) {
      if (!active) return;
      curX = (e.touches ? e.touches[0].clientX : e.clientX);
      var dx = curX - startX;
      var percent = dx / grid.clientWidth * 100;
      track.style.transform = 'translateX(' + (-(index * 100) + percent) + '%)';
    }
    function end() {
      if (!active) return;
      var dx = curX - startX;
      var dt = Date.now() - t0;
      track.style.transition = '';
      if (Math.abs(dx) > threshold && dt < timeLimit) {
        if (dx < 0) go(index + 1); else go(index - 1);
      } else {
        update();
        setDisabled();
      }
      active = false;
    }

    track.addEventListener('touchstart', start, { passive: true });
    track.addEventListener('touchmove',  move,  { passive: true });
    track.addEventListener('touchend',   end);

    track.addEventListener('mousedown',  function(e){ start(e); e.preventDefault(); });
    track.addEventListener('mousemove',  move);
    track.addEventListener('mouseup',    end);
    track.addEventListener('mouseleave', end);

    grid.setAttribute('tabindex', '0');
    grid.addEventListener('keydown', function (e) {
      if (e.key === 'ArrowRight') go(index + 1);
      if (e.key === 'ArrowLeft')  go(index - 1);
    });

    update();
    setDisabled();
  }

  initMobileSlider();
  mq.addEventListener ? mq.addEventListener('change', function(e){
    if (e.matches) initMobileSlider();
  }) : window.addEventListener('resize', initMobileSlider);
})();