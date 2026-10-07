@if ($paypal['ready'])
<script src="{!! $paypal['sdkUrl'] !!}" data-sdk-integration-source="button-factory"></script>
@verbatim
<script>
(function () {
	var box = document.getElementById('rm-paypal'); if (!box || !window.paypal) return;
	paypal.Buttons({
		style: { shape: 'pill', color: 'gold', layout: 'vertical', label: 'subscribe' },
		createSubscription: function (data, actions) { return actions.subscription.create({ plan_id: box.getAttribute('data-plan') }); },
		onApprove: function (data) { var u = box.getAttribute('data-return'); window.location.href = u + (u.indexOf('?') > -1 ? '&' : '?') + 'sid=' + encodeURIComponent(data.subscriptionID || '') + '#welcome'; }
	}).render('#rm-paypal');
})();
</script>
@endverbatim
@endif
