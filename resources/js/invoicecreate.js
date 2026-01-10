       let index = 0;
        const tableBody = document.querySelector('#itemsTable tbody');

        addRow();

        document.getElementById('addRow').onclick = addRow;
        document.addEventListener('input', handleInput);
        document.addEventListener('click', handleRemove);

        discountType.onchange = discountValue.oninput = categorySelect.onchange = calculateTotals;

        function addRow() {
            tableBody.insertAdjacentHTML('beforeend', `
            <tr data-index="${index}" class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                    <input name="items[${index}][product_name]" 
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Product name">
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <input type="number" name="items[${index}][qty]" min="0" value="0"
                        class="qty w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <input type="number" name="items[${index}][price]" value="0" step="0.01"
                        class="price w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <input class="itemTotal w-full px-3 py-2 border border-gray-300 rounded bg-gray-50" readonly>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                    <button type="button" class="removeRow  text-red-600 hover:text-red-900">
                        <svg class="h-5 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </td>
            </tr>
            <tr class="serialRow bg-gray-50">
                <td colspan="5" class="px-6  py-4">
                    <div class="serials space-y-2"></div>
                </td>
            </tr>
        `);
            index++;
        }

        function handleInput(e) {
            if (!e.target.closest('.qty, .price')) return;

            const row = e.target.closest('tr');
            const qty = +row.querySelector('.qty').value || 0;
            const price = +row.querySelector('.price').value || 0;
            row.querySelector('.itemTotal').value = (qty * price).toFixed(2);

            renderSerials(row.dataset.index, qty, row.nextElementSibling.querySelector('.serials'));
            calculateTotals();
        }
function renderSerials(index, qty, container) {
    container.innerHTML = '';

    if (qty > 0) {
        container.innerHTML = `
            <p class="text-sm font-medium text-gray-700 mb-2">
                Serial Numbers (${qty} items):
                <span class="text-red-400">
                    (Warranty Date is Greater than Invoice Date)
                    </span>
            </p>`;

        for (let i = 1; i <= qty; i += 2) {
            container.insertAdjacentHTML('beforeend', `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mb-2">
                    <div class="flex gap-2">
                        <input name="items_serials[${index}][${i}]"
                            class="w-full px-3 py-2 border rounded"
                            placeholder="Serial ${i}"required>
                        <input  name="warranty_end_date[${index}][${i}]" type="date" class="serial-date w-full px-3 py-2 border rounded" required>
                    </div>

                    ${i + 1 <= qty ? `
                    <div class="flex gap-2">
                        <input name="items_serials[${index}][${i + 1}]"
                            class="w-full px-3 py-2 border rounded"
                            placeholder="Serial ${i + 1}" required>
                        <input  name="warranty_end_date[${index}][${i + 1}]"  type="date" class="serial-date w-full px-3 py-2 border rounded" required>
                    </div>` : ''}
                </div>
            `);
        }

        // ✅ ONE-TIME GLOBAL APPLY
        let isWarrantyApplied = false;

        container.querySelectorAll('.serial-date').forEach(dateInput => {
            dateInput.addEventListener('change', function () {

                // First date entry → apply to all
                if (!isWarrantyApplied && this.value) {
                    const selectedDate = this.value;

                    container.querySelectorAll('.serial-date').forEach(d => {
                        d.value = selectedDate;
                    });

                    isWarrantyApplied = true; // 🔒 lock auto-apply
                }
            });
        });
    }
}

        

        // function handleRemove(e) {
        //     if (!e.target.closest('.removeRow')) return;
        //     const row = e.target.closest('tr');
        //     row.nextElementSibling.remove();
        //     row.remove();
        //     calculateTotals();
        // }

        function handleRemove(e) {
            console.log( 'log of handleRemove', e);           
    if (!e.target.classList.contains('removeRow')) return;
    var row = e.target.closest('tr');
    row.remove();
    calculateTotals();
}

        function calculateTotals() {
            let sub = [...document.querySelectorAll('.itemTotal')]
                .reduce((sum, i) => sum + (+i.value || 0), 0);

            let discount = 0;
            if (discountType.value === 'percentage') {
                discount = sub * discountValue.value / 100;
                discountPercentage.value = discountValue.value;
                discountAmount.value = discount.toFixed(2);
            }
            if (discountType.value === 'amount') {
                discount = +discountValue.value || 0;
                discountAmount.value = discount.toFixed(2);
                discountPercentage.value = '';
            }

            discount = Math.min(discount, sub);
            const taxable = sub - discount;
            const taxRate = TAX_RATES[categorySelect.value] || 0;
            console.log(taxRate)
            const tax = taxable * taxRate / 100;

            subTotal.value = sub.toFixed(2);
            taxAmount.value = tax.toFixed(2);
            grandTotal.value = (taxable + tax).toFixed(2);

            // Update display values
            document.getElementById('subTotalDisplay').textContent = sub.toFixed(2);
            document.getElementById('taxAmountDisplay').textContent = tax.toFixed(2);
            document.getElementById('grandTotalDisplay').textContent = (taxable + tax).toFixed(2);
        }

        // Partial paid functionality
        const statusSelect = document.getElementById('statusSelect');
        const partialDiv = document.getElementById('partialAmountDiv');
        const duedateDiv = document.getElementById('duedateDiv');

        statusSelect.addEventListener('change', function() {
            const value = this.value;

            // Reset both divs first
            partialDiv.classList.add('hidden');
            duedateDiv.classList.add('hidden');
            document.getElementById('partialAmount').value = '';

            if (value === 'partial_paid') {
                partialDiv.classList.remove('hidden');
                duedateDiv.classList.remove('hidden');
            } else if (value === 'unpaid') {
                duedateDiv.classList.remove('hidden');
            }
        });

        setTimeout(() => {
            document.getElementById('success-alert')?.remove();
            document.getElementById('error-alert')?.remove();
            document.getElementById('validation-alert')?.remove();
            
        }, 5000);
