const initializeHourlyIncomeCharts = () => {
    document.querySelectorAll('[data-hourly-income-chart]').forEach((canvas) => {
        const labels = JSON.parse(canvas.dataset.labels ?? '[]');
        const values = JSON.parse(canvas.dataset.values ?? '[]')
            .map((value) => Number(value))
            .filter((value) => Number.isFinite(value));

        if (labels.length === 0 || values.length === 0) {
            return;
        }

        const context = canvas.getContext('2d');
        const drawChart = () => {
            const width = canvas.clientWidth;
            const height = canvas.clientHeight;
            const pixelRatio = window.devicePixelRatio || 1;

            if (width === 0 || height === 0) {
                return;
            }

            canvas.width = width * pixelRatio;
            canvas.height = height * pixelRatio;
            context.setTransform(pixelRatio, 0, 0, pixelRatio, 0, 0);
            context.clearRect(0, 0, width, height);

            const padding = { top: 12, right: 8, bottom: 28, left: 8 };
            const chartWidth = width - padding.left - padding.right;
            const chartHeight = height - padding.top - padding.bottom;
            const maximum = Math.max(...values, 1);
            const points = values.map((value, index) => ({
                x: padding.left + (index / Math.max(values.length - 1, 1)) * chartWidth,
                y: padding.top + chartHeight - (value / maximum) * chartHeight,
            }));

            context.beginPath();
            points.forEach((point, index) => {
                if (index === 0) {
                    context.moveTo(point.x, point.y);
                } else {
                    context.lineTo(point.x, point.y);
                }
            });
            context.lineTo(points.at(-1).x, padding.top + chartHeight);
            context.lineTo(points[0].x, padding.top + chartHeight);
            context.closePath();
            context.fillStyle = 'rgba(16, 185, 129, 0.12)';
            context.fill();

            context.beginPath();
            points.forEach((point, index) => {
                if (index === 0) {
                    context.moveTo(point.x, point.y);
                } else {
                    context.lineTo(point.x, point.y);
                }
            });
            context.strokeStyle = '#059669';
            context.lineWidth = 2.5;
            context.lineJoin = 'round';
            context.lineCap = 'round';
            context.stroke();

            context.fillStyle = '#94a3b8';
            context.font = '12px Instrument Sans, sans-serif';
            context.textAlign = 'center';
            labels.forEach((label, index) => {
                const point = points[index];

                if (point && (index === 0 || index === labels.length - 1 || index % 2 === 0)) {
                    context.fillText(label, point.x, height - 8);
                }
            });
        };

        canvas.style.width = '100%';
        canvas.style.height = '220px';
        drawChart();

        if ('ResizeObserver' in window) {
            new ResizeObserver(drawChart).observe(canvas);
        } else {
            window.addEventListener('resize', drawChart);
        }
    });
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeHourlyIncomeCharts);
} else {
    initializeHourlyIncomeCharts();
}

const initializeTransactionPage = () => {
    const form = document.getElementById('transaction-form');
    const cartContainer = document.querySelector('[data-cart-items]');
    const cartInput = document.getElementById('cart-items-input');

    if (!form || !cartContainer || !cartInput) {
        return;
    }

    const cart = new Map();
    const productCards = new Map();
    const formatCurrency = (value) => `Rp ${new Intl.NumberFormat('id-ID').format(value)}`;
    const escapeHtml = (value) => String(value)
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');

    document.querySelectorAll('[data-product-card]').forEach((card) => {
        const id = Number(card.dataset.productId);
        const product = {
            id,
            name: card.dataset.productName,
            price: Number(card.dataset.productPrice),
            unit: card.dataset.productUnit,
            stock: Number(card.dataset.productStock),
            card,
        };

        if (product.id && product.stock > 0) {
            productCards.set(product.id, product);
            card.addEventListener('click', () => addToCart(product));
        }
    });

    const updatePaymentMethodStyles = () => {
        form.querySelectorAll('input[name="payment_method"]').forEach((input) => {
            const label = input.closest('label');

            label.classList.toggle('border-2', input.checked);
            label.classList.toggle('border-emerald-600', input.checked);
            label.classList.toggle('text-emerald-700', input.checked);
            label.classList.toggle('bg-emerald-50', input.checked);
            label.classList.toggle('border', !input.checked);
            label.classList.toggle('border-slate-200', !input.checked);
            label.classList.toggle('text-slate-600', !input.checked);
            label.classList.toggle('hover:bg-slate-50', !input.checked);
        });
    };

    const updateSummary = () => {
        const subtotal = [...cart.values()].reduce((sum, item) => sum + item.price * item.quantity, 0);
        const subtotalElement = form.querySelector('[data-cart-subtotal]');
        const totalElement = form.querySelector('[data-cart-total]');
        const itemCountElement = form.querySelector('[data-cart-item-count]');
        const completeButton = form.querySelector('[data-complete-transaction]');
        const amountInput = form.querySelector('#amount_received');
        const previousTotal = Number(form.dataset.total || 0);
        const currentAmount = Number(amountInput.value || 0);

        subtotalElement.textContent = formatCurrency(subtotal);
        totalElement.textContent = formatCurrency(subtotal);
        itemCountElement.textContent = cart.size;
        cartInput.value = JSON.stringify([...cart.values()].map((item) => ({
            id: item.id,
            quantity: Number(item.quantity.toFixed(2)),
        })));

        if (currentAmount === 0 || currentAmount === previousTotal) {
            amountInput.value = subtotal > 0 ? subtotal : 0;
        }

        form.dataset.total = String(subtotal);
        completeButton.disabled = cart.size === 0;
        completeButton.classList.toggle('opacity-50', cart.size === 0);
        completeButton.classList.toggle('cursor-not-allowed', cart.size === 0);
    };

    const renderCart = () => {
        if (cart.size === 0) {
            cartContainer.innerHTML = '<p class="text-sm text-slate-400 text-center py-6" data-cart-empty>Belum ada item di keranjang.</p>';
            updateSummary();
            return;
        }

        cartContainer.innerHTML = [...cart.values()].map((item) => `
            <div class="border-b border-slate-100 pb-4" data-cart-row="${item.id}">
                <div class="flex items-start justify-between mb-2">
                    <div>
                        <p class="font-semibold text-slate-800 text-sm">${escapeHtml(item.name)}</p>
                        <p class="text-xs text-slate-400">${formatCurrency(item.price)} / ${escapeHtml(item.unit)}</p>
                    </div>
                    <p class="font-semibold text-emerald-700 text-sm">${formatCurrency(item.price * item.quantity)}</p>
                </div>
                <div class="flex items-center gap-3">
                    <button type="button" class="w-7 h-7 rounded-md border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-50" data-qty-decrease="${item.id}">−</button>
                    <span class="text-sm w-14 text-center">${item.quantity} ${escapeHtml(item.unit)}</span>
                    <button type="button" class="w-7 h-7 rounded-md border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-50" data-qty-increase="${item.id}">+</button>
                    <button type="button" class="ml-auto text-red-500 hover:text-red-600" data-remove-item="${item.id}" aria-label="Hapus ${escapeHtml(item.name)}">
                        <img src="/icons/delete_transaction.png" class="w-4 h-4 object-contain" alt="">
                    </button>
                </div>
            </div>
        `).join('');

        updateSummary();
    };

    const addToCart = (product) => {
        if (cart.has(product.id)) {
            return;
        }

        cart.set(product.id, { ...product, quantity: 1 });
        product.card.classList.add('hidden');
        renderCart();
    };

    cartContainer.addEventListener('click', (event) => {
        const button = event.target.closest('button');

        if (!button) {
            return;
        }

        const id = Number(button.dataset.qtyDecrease || button.dataset.qtyIncrease || button.dataset.removeItem);
        const item = cart.get(id);

        if (!item) {
            return;
        }

        if (button.dataset.qtyDecrease !== undefined) {
            item.quantity = Math.max(0.25, Number((item.quantity - 0.25).toFixed(2)));
        }

        if (button.dataset.qtyIncrease !== undefined) {
            item.quantity = Math.min(item.stock, Number((item.quantity + 0.25).toFixed(2)));
        }

        if (button.dataset.removeItem !== undefined) {
            cart.delete(id);
            productCards.get(id)?.card.classList.remove('hidden');
        }

        renderCart();
    });

    form.querySelectorAll('input[name="payment_method"]').forEach((input) => {
        input.addEventListener('change', updatePaymentMethodStyles);
    });

    form.addEventListener('submit', (event) => {
        if (cart.size === 0) {
            event.preventDefault();
        }
    });

    updatePaymentMethodStyles();
    renderCart();
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeTransactionPage);
} else {
    initializeTransactionPage();
}
