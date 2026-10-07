@verbatim
<script>
(function () {
	var root = document.querySelector('[data-rm-checklist]'); if (!root) return;
	var items = [].slice.call(root.querySelectorAll('.rm-cl-it')), groups = [].slice.call(root.querySelectorAll('.rm-cl-group'));
	var n = root.querySelector('.rm-cl-n'), bar = root.querySelector('.rm-cl-prog em'), total = items.length;
	function sync() { var d = root.querySelectorAll('.rm-cl-it.is-done').length; n.textContent = d; bar.style.transform = 'scaleX(' + (d / total) + ')'; }
	function set(b, on) { b.classList.toggle('is-done', on); b.setAttribute('aria-pressed', on ? 'true' : 'false'); var s = b.parentNode.querySelector('.rm-cl-sub'); if (s) s.classList.toggle('is-done', on); }
	items.forEach(function (b) { b.addEventListener('click', function () { set(b, !b.classList.contains('is-done')); sync(); }); });
	root.querySelectorAll('.rm-cl-tabs button').forEach(function (t) {
		t.addEventListener('click', function () {
			root.querySelectorAll('.rm-cl-tabs button').forEach(function (x) { x.classList.toggle('is-on', x === t); });
			var f = t.getAttribute('data-f'); groups.forEach(function (g) { g.hidden = !(f === 'all' || g.getAttribute('data-g') === f); });
		});
	});
	var ran = false;
	function run() { if (ran) return; ran = true; items.forEach(function (b, i) { setTimeout(function () { set(b, true); sync(); }, 120 + i * 90); }); }
	if (window.matchMedia('(prefers-reduced-motion: reduce)').matches || !('IntersectionObserver' in window)) { items.forEach(function (b) { set(b, true); }); sync(); return; }
	var io = new IntersectionObserver(function (e) { if (e[0].isIntersecting) { run(); io.disconnect(); } }, { threshold: 0.25 });
	io.observe(root);
})();
</script>

<script>
(function () {
	var cal = document.querySelector('.rm-cal'); if (!cal) return;
	var last = -1;
	function tick() {
		var r = cal.getBoundingClientRect(), vh = window.innerHeight;
		var p = (vh * 0.7 - r.top) / (r.height + vh * 0.15);
		var wk = p <= 0 ? 0 : Math.min(4, Math.max(1, Math.ceil(p * 4)));
		if (wk !== last) { last = wk; cal.setAttribute('data-wk', wk); }
	}
	window.addEventListener('scroll', tick, { passive: true }); window.addEventListener('resize', tick); tick();
})();
</script>
@endverbatim
