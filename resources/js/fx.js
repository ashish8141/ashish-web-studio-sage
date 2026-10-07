/**
 * Ashish Web Studio v2: scroll effects (GSAP + ScrollTrigger).
 * Word-by-word headline reveals, section reveals, infographic triggers,
 * scrubbed process rail, work parallax, card spotlight, magnetic CTA.
 * Everything degrades to fully visible when JS or motion is off.
 */
(function () {
  'use strict';
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var hasGsap = !!(window.gsap && window.ScrollTrigger);
  if (hasGsap && !reduce) { window.AWS_FX = true; document.documentElement.classList.add('fx-on'); }

  function ready(fn) { if (document.readyState !== 'loading') fn(); else document.addEventListener('DOMContentLoaded', fn); }

  // Wrap each word of an element (keeping inline children like .hl) in masks.
  function splitWords(el) {
    if (el.dataset.split) return;
    el.dataset.split = '1';
    var walk = function (node) {
      Array.prototype.slice.call(node.childNodes).forEach(function (child) {
        if (child.nodeType === 3) {
          var parts = child.textContent.split(/(\s+)/);
          var frag = document.createDocumentFragment();
          parts.forEach(function (p) {
            if (!p) return;
            if (/^\s+$/.test(p)) { frag.appendChild(document.createTextNode(p)); return; }
            var w = document.createElement('span'); w.className = 'fx-w';
            var i = document.createElement('span'); i.className = 'fx-wi'; i.textContent = p;
            w.appendChild(i); frag.appendChild(w);
          });
          child.parentNode.replaceChild(frag, child);
        } else if (child.nodeType === 1 && child.tagName !== 'BR') {
          walk(child);
        }
      });
    };
    walk(el);
  }

  // Infographics: add .is-in when visible (CSS drives the animation). Works without GSAP.
  function watchInfographics() {
    var els = document.querySelectorAll('.fx-viz');
    if (!els.length) return;
    if (reduce || !('IntersectionObserver' in window)) { els.forEach(function (e) { e.classList.add('is-in'); }); return; }
    var io = new IntersectionObserver(function (ents) {
      ents.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); } });
    }, { threshold: 0.35 });
    els.forEach(function (e) { io.observe(e); });
  }

  // Cursor spotlight on cards (pure pointer, no GSAP needed).
  function spotlight() {
    if (window.matchMedia('(hover: none)').matches) return;
    document.querySelectorAll('.fx-spot').forEach(function (card) {
      card.addEventListener('pointermove', function (ev) {
        var r = card.getBoundingClientRect();
        card.style.setProperty('--mx', (ev.clientX - r.left) + 'px');
        card.style.setProperty('--my', (ev.clientY - r.top) + 'px');
      });
    });
    var hero = document.querySelector('.h-hero');
    if (hero) hero.addEventListener('pointermove', function (ev) {
      var r = hero.getBoundingClientRect();
      hero.style.setProperty('--hx', (ev.clientX - r.left) + 'px');
      hero.style.setProperty('--hy', (ev.clientY - r.top) + 'px');
    });
  }


  // Footer wordmark: the dot appears, then the name types itself in behind it.
  function footerType() {
    var box = document.querySelector('.aws-foot-big');
    if (!box) return;
    var line = box.querySelector('.fb-line');
    var text = box.querySelector('.fb-text');
    var full = box.getAttribute('data-type') || text.textContent;

    function fit() {
      var prev = text.textContent;
      text.textContent = full;
      line.style.fontSize = '100px';
      var w = line.getBoundingClientRect().width;
      var avail = box.clientWidth;
      if (w > 0) line.style.fontSize = Math.min(170, (avail / w) * 100 * 0.98) + 'px';
      text.textContent = prev;
    }
    fit();
    window.addEventListener('resize', function () { var t = text.textContent; text.textContent = full; fit(); text.textContent = t; });

    if (reduce || !('IntersectionObserver' in window)) { box.classList.add('is-done'); return; }

    text.textContent = '';
    var timer = null;
    function play() {
      clearTimeout(timer);
      text.textContent = '';
      box.classList.remove('is-done', 'is-typing');
      box.classList.add('is-dot');
      var i = 0;
      timer = setTimeout(function step() {
        box.classList.add('is-typing');
        i++;
        text.textContent = full.slice(0, i);
        if (i < full.length) {
          var ch = full.charAt(i - 1);
          timer = setTimeout(step, ch === ' ' ? 170 : 55 + Math.random() * 70);
        } else {
          box.classList.remove('is-typing');
          box.classList.add('is-done');
        }
      }, 900);
    }
    var played = false;
    var io = new IntersectionObserver(function (ents) {
      ents.forEach(function (e) {
        if (e.isIntersecting && !played) { played = true; play(); }
        if (!e.isIntersecting && e.boundingClientRect.top > 0) { played = false; clearTimeout(timer); text.textContent = ''; box.classList.remove('is-dot', 'is-typing', 'is-done'); }
      });
    }, { threshold: 0.5 });
    io.observe(box);
    box.addEventListener('mouseenter', function () { if (box.classList.contains('is-done')) play(); });
  }

  // Work: show the first four, reveal the rest on demand.
  function workToggle() {
    var btn = document.querySelector('.h-work-toggle');
    if (!btn) return;
    var grid = document.querySelector('.h-work-grid');
    var lbl = btn.querySelector('.h-wt-lbl');
    btn.addEventListener('click', function () {
      var open = !grid.classList.contains('is-all');
      grid.classList.toggle('is-all', open);
      btn.setAttribute('aria-expanded', open ? 'true' : 'false');
      if (lbl) lbl.textContent = open ? 'Show fewer projects' : 'View more projects';
      if (open) { grid.querySelectorAll('.h-work--more').forEach(function (c, k) { c.style.animation = 'none'; void c.offsetWidth; c.style.animation = 'workIn .7s cubic-bezier(.16,1,.3,1) ' + (k * 80) + 'ms both'; }); }
      else { var top = grid.getBoundingClientRect().top + window.scrollY - 120; if (window.scrollY > top + grid.offsetHeight * .5) window.scrollTo({ top: top, behavior: 'smooth' }); }
      if (window.ScrollTrigger) window.ScrollTrigger.refresh();
    });
  }

  // Hero showreel: cycles through live projects, each screen scrolls like a video.
  function reel() {
    var root = document.querySelector('[data-reel]');
    if (!root) return;
    var shots = root.querySelectorAll('.h-reel-shot');
    var tabs = root.querySelectorAll('.h-reel-tab');
    var url = root.querySelector('.h-reel-url');
    var i = 0, timer = null, DUR = 6000;
    function show(n) {
      i = (n + shots.length) % shots.length;
      shots.forEach(function (s, k) { s.classList.toggle('is-on', k === i); });
      tabs.forEach(function (t, k) { t.classList.toggle('is-on', k === i); t.setAttribute('aria-selected', k === i ? 'true' : 'false'); });
      if (url) url.textContent = shots[i].getAttribute('data-url');
      var img = shots[i].querySelector('img');
      if (img && img.loading === 'lazy') img.loading = 'eager';
      var nxt = shots[(i + 1) % shots.length].querySelector('img');
      if (nxt) nxt.loading = 'eager';
      var frame = shots[i].parentNode;
      if (img) { var dist = Math.max(0, img.getBoundingClientRect().height - frame.getBoundingClientRect().height); shots[i].style.setProperty('--sy', (-dist) + 'px'); }
      root.classList.remove('is-run'); void root.offsetWidth; root.classList.add('is-run');
      clearTimeout(timer);
      if (!reduce) timer = setTimeout(function () { show(i + 1); }, DUR);
    }
    tabs.forEach(function (t, k) { t.addEventListener('click', function () { show(k); }); });
    if ('IntersectionObserver' in window) {
      new IntersectionObserver(function (e) {
        if (e[0].isIntersecting) { if (!root.classList.contains('is-run')) show(i); }
        else { clearTimeout(timer); root.classList.remove('is-run'); }
      }, { threshold: .25 }).observe(root);
    } else show(0);
  }

  // Solutions tabs with sliding underline.
  function solTabs() {
    var wrap = document.querySelector('.h-sol-tabs');
    if (!wrap) return;
    var tabs = wrap.querySelectorAll('.h-sol-tab');
    var ink = wrap.querySelector('.h-sol-ink');
    function place(t) { if (!ink) return; ink.style.width = t.offsetWidth + 'px'; ink.style.transform = 'translateX(' + t.offsetLeft + 'px)'; }
    tabs.forEach(function (t) {
      t.addEventListener('click', function () {
        tabs.forEach(function (o) {
          var on = o === t;
          o.classList.toggle('is-on', on); o.setAttribute('aria-selected', on ? 'true' : 'false');
          var p = document.getElementById(o.getAttribute('aria-controls'));
          if (p) { p.hidden = !on; p.classList.toggle('is-on', on); if (on) p.querySelectorAll('.fx-viz').forEach(function (v) { v.classList.remove('is-in'); void v.offsetWidth; v.classList.add('is-in'); }); }
        });
        place(t);
        if (window.ScrollTrigger) window.ScrollTrigger.refresh();
      });
    });
    place(wrap.querySelector('.h-sol-tab.is-on') || tabs[0]);
    window.addEventListener('resize', function () { place(wrap.querySelector('.h-sol-tab.is-on')); });
  }

  // Challenge cards: hover (desktop), tap or keyboard to see the fix; switch flips all.
  function challenge() {
    var cards = document.querySelectorAll('.h-ch');
    if (!cards.length) return;
    var sw = document.querySelector('.h-ch-switch');
    function set(card, on) { card.classList.toggle('is-fixed', on); card.setAttribute('aria-pressed', on ? 'true' : 'false'); }
    cards.forEach(function (c) {
      c.addEventListener('click', function () { set(c, !c.classList.contains('is-fixed')); });
      c.addEventListener('keydown', function (e) { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); set(c, !c.classList.contains('is-fixed')); } });
    });
    if (sw) sw.addEventListener('click', function () {
      var on = sw.getAttribute('aria-pressed') !== 'true';
      sw.setAttribute('aria-pressed', on ? 'true' : 'false');
      cards.forEach(function (c, k) { setTimeout(function () { set(c, on); }, k * 120); });
    });
  }
  ready(function () {
    challenge();
    reel();
    solTabs();
    workToggle();
    watchInfographics();
    spotlight();
    footerType();
    if (!hasGsap || reduce) return;

    var gsap = window.gsap, ST = window.ScrollTrigger;
    gsap.registerPlugin(ST);
    var ease = 'expo.out';

    // Hero intro.
    var h1 = document.querySelector('.h-hero h1');
    if (h1) {
      splitWords(h1);
      var tl = gsap.timeline({ defaults: { ease: ease } });
      tl.from('.h-hero .aws-tag', { y: 16, opacity: 0, duration: .8 })
        .from(h1.querySelectorAll('.fx-wi'), { yPercent: 110, duration: 1.1, stagger: .06 }, '-=.5')
        .from('.h-hero-sub', { y: 20, opacity: 0, duration: .9 }, '-=.8')
        .from('.h-hero-actions > *', { y: 16, opacity: 0, duration: .8, stagger: .08 }, '-=.7')
        .from('.h-reel, .h-duo, .rm-health', { y: 80, opacity: 0, scale: .96, duration: 1.4 }, '-=.9');
      var port = document.querySelector('.h-portrait img');
      if (port) gsap.to(port, { yPercent: 8, ease: 'none', scrollTrigger: { trigger: '.h-hero', start: 'top top', end: 'bottom top', scrub: true } });
    }

    // Section headline word reveals.
    document.querySelectorAll('.aws-sec-head h2, .h-band-card h2, .h-cta h2, .h-bridge, .aws-index-head h1').forEach(function (h) {
      splitWords(h);
      gsap.from(h.querySelectorAll('.fx-wi'), {
        yPercent: 110, duration: 1, ease: ease, stagger: .045,
        scrollTrigger: { trigger: h, start: 'top 85%', once: true }
      });
    });

    // Generic staggered reveals for grid children.
    var groups = ['.h-ch-grid', '.h-sol-panel.is-on', '.h-work-grid', '.h-plans', '.h-quotes', '.aws-blog-grid', '.h-faq', '.h-stats', '.h-about', '.h-cta-grid', '.r-split', '.rm-grid'];
    groups.forEach(function (sel) {
      document.querySelectorAll(sel).forEach(function (g) {
        if (sel === '.aws-blog-grid' && window.matchMedia('(max-width: 760px)').matches) return;
        gsap.from(g.children, {
          y: 40, opacity: 0, duration: 1, ease: ease, stagger: .09, clearProps: 'transform,opacity',
          scrollTrigger: { trigger: g, start: 'top 82%', once: true }
        });
      });
    });
    document.querySelectorAll('.aws-sec-head p, .aws-sec-head .aws-tag, .aws-sec-head .aws-link, .aws-sec-head--row .aws-link').forEach(function (el) {
      gsap.from(el, { y: 18, opacity: 0, duration: .9, ease: ease, clearProps: 'transform,opacity', scrollTrigger: { trigger: el, start: 'top 88%', once: true } });
    });

    // Work screenshots: gentle parallax inside the frame.
    document.querySelectorAll('.h-work-shot img').forEach(function (img) {
      gsap.fromTo(img, { yPercent: -6 }, { yPercent: 6, ease: 'none', scrollTrigger: { trigger: img.parentNode, start: 'top bottom', end: 'bottom top', scrub: true } });
    });

    // Process: 14-day calendar. A "today" line sweeps across the days with scroll;
    // bars light up while the line is inside their day range. Mobile uses a floating day pill.
    var cal = document.querySelector('.h-cal');
    if (cal) {
      var body = cal.querySelector('.h-cal-body');
      var now = cal.querySelector('.h-cal-now');
      var nowTxt = now ? now.querySelector('b') : null;
      var rows = [].slice.call(cal.querySelectorAll('.h-cal-row'));
      var dayCells = [].slice.call(cal.querySelectorAll('.h-cal-days span'));
      var mq = window.matchMedia('(max-width: 900px)');
      var brd = cal.querySelector('.h-cal-board'); var N = +((brd && brd.getAttribute('data-days')) || 14); var U = (brd && brd.getAttribute('data-unit')) || 'Day';
      var flt = document.createElement('div');
      flt.className = 'h-proc-float'; flt.setAttribute('aria-hidden', 'true');
      flt.innerHTML = '<b>' + U + ' 1</b><span>of ' + N + '</span><i><em></em></i>';
      document.body.appendChild(flt);
      var fltDay = flt.querySelector('b'), fltBar = flt.querySelector('em');
      if ('IntersectionObserver' in window) {
        new IntersectionObserver(function (e) { flt.classList.toggle('is-on', e[0].isIntersecting); }, { rootMargin: '-30% 0px -40% 0px' }).observe(body);
      }
      var lastDay = 0;
      function setDay(day) {
        if (day === lastDay) return; lastDay = day;
        if (nowTxt) nowTxt.textContent = U + ' ' + day;
        dayCells.forEach(function (c, k) { c.classList.toggle('is-now', k + 1 === day); c.classList.toggle('is-past', k + 1 < day); });
        if (!mq.matches) rows.forEach(function (r) { r.classList.toggle('is-active', day >= +r.dataset.from && day <= +r.dataset.to); });
      }
      ST.create({
        trigger: body, start: 'top 70%', end: 'bottom 55%', scrub: true,
        onToggle: function (self) { cal.classList.toggle('is-live', self.isActive || self.progress >= 1); },
        onUpdate: function (self) {
          var p = self.progress;
          fltBar.style.transform = 'scaleX(' + p + ')';
          if (now) { var w = now.parentNode.offsetWidth - now.offsetLeft; now.style.transform = 'translateX(' + (p * w) + 'px)'; }
          setDay(Math.min(N, Math.max(1, Math.ceil(p * N))));
        }
      });
      rows.forEach(function (r) {
        var dayTxt = U + ' ' + r.dataset.from + (r.dataset.from === r.dataset.to ? '' : '\u2013' + r.dataset.to);
        ST.create({ trigger: r, start: 'top 62%', end: 'bottom 38%', onToggle: function (self) { if (!mq.matches) return; r.classList.toggle('is-active', self.isActive); if (self.isActive) fltDay.textContent = dayTxt; } });
      });
      // Bars draw in from their start day, like events dropped on a calendar.
      gsap.from(cal.querySelectorAll('.h-cal-bar'), { clipPath: 'inset(0 100% 0 0)', duration: 1, ease: 'power3.out', stagger: .12, clearProps: 'clipPath', scrollTrigger: { trigger: body, start: 'top 80%', once: true } });
      gsap.from(cal.querySelectorAll('.h-cal-lab'), { scaleY: 0, transformOrigin: 'top', duration: .7, ease: 'power3.out', stagger: .12, clearProps: 'transform', scrollTrigger: { trigger: body, start: 'top 80%', once: true } });
    }

    // Magnetic primary buttons.
    if (!window.matchMedia('(hover: none)').matches) {
      document.querySelectorAll('.aws-btn--accent').forEach(function (el) {
        var xTo = gsap.quickTo(el, 'x', { duration: .5, ease: 'power3' });
        var yTo = gsap.quickTo(el, 'y', { duration: .5, ease: 'power3' });
        el.addEventListener('pointermove', function (ev) {
          var r = el.getBoundingClientRect();
          xTo((ev.clientX - r.left - r.width / 2) * .25); yTo((ev.clientY - r.top - r.height / 2) * .35);
        });
        el.addEventListener('pointerleave', function () { xTo(0); yTo(0); });
      });
    }

    window.addEventListener('load', function () { ST.refresh(); });
  });
})();
