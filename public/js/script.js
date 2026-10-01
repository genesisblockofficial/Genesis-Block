document.addEventListener('DOMContentLoaded', () => {
	const loader = document.querySelector('[data-page-loader]');
	const modal = document.querySelector('[data-auth-modal]');

	window.setTimeout(() => loader?.classList.add('is-hidden'), 320);

	if (modal) {
		const emailInput = modal.querySelector('#auth-gate-email');
		const openModal = () => {
			modal.classList.add('is-visible');
			modal.setAttribute('aria-hidden', 'false');
			document.body.classList.add('auth-modal-open');
			window.setTimeout(() => emailInput?.focus(), 50);
		};
		const closeModal = () => {
			modal.classList.remove('is-visible');
			modal.setAttribute('aria-hidden', 'true');
			document.body.classList.remove('auth-modal-open');
		};

		document.querySelectorAll('[data-auth-close]').forEach((element) => element.addEventListener('click', closeModal));
		document.querySelectorAll('[data-auth-gate]').forEach((link) => link.addEventListener('click', (event) => {
			event.preventDefault();
			openModal();
		}));
		document.addEventListener('keydown', (event) => {
			if (event.key === 'Escape' && modal.classList.contains('is-visible')) closeModal();
		});
		window.setTimeout(openModal, 350);
	}

	document.querySelectorAll('a[href]').forEach((link) => link.addEventListener('click', (event) => {
		if (event.defaultPrevented || link.target === '_blank' || link.hasAttribute('data-auth-gate')) return;
		const url = new URL(link.href, window.location.href);
		if (url.origin === window.location.origin && url.pathname !== window.location.pathname && loader) {
			loader.classList.remove('is-hidden');
		}
	}));
});
