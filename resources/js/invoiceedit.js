console.log('EXISTING_SERIALS:', window.EXISTING_SERIALS);
    let index = 0;
    const tableBody = document.querySelector('#itemsTable tbody');

    document.addEventListener('DOMContentLoaded', function() {
        
        // Clear any existing rows first
        tableBody.innerHTML = '';
        
        // Add existing items
        if (EXISTING_ITEMS && EXISTING_ITEMS.length > 0) {
            EXISTING_ITEMS.forEach(function(item) {
                console.log('Processing item:', item);
                addExistingItem(item);
            });
        } else {
            // If no items exist, add one empty row
            addRow();
        }
        
        // Initialize status-based visibility
        updateStatusVisibility();
        
        // Calculate totals
        calculateTotals();
    });

    document.getElementById('addRow').onclick = addRow;
    document.addEventListener('input', handleInput);
    document.addEventListener('click', handleRemove);

    document.getElementById('discountType').onchange = 
    document.getElementById('discountValue').oninput = 
    document.getElementById('categorySelect').onchange = calculateTotals;

    // Status change handler
    document.getElementById('statusSelect').addEventListener('change', updateStatusVisibility);

    function addExistingItem(item) {
        // Find serials for this item
        const itemSerials = EXISTING_SERIALS.filter(serial => serial.item_id == item.id);
        console.log('Item serials for item', item.id, ':', itemSerials);
        
        tableBody.insertAdjacentHTML('beforeend', `
            <tr data-index="${index}" class="hover:bg-gray-50">
                <td class="px-6 py-4">
                    <input name="items[${index}][product_name]"
                           class="w-full px-3 py-2 border rounded"
                           value="${escapeHtml(item.product_name || '')}">
                    
                    <input type="hidden" name="items[${index}][id]" value="${item.id}">
                </td>

                <td class="px-6 py-4">
                    <input type="number"
                           name="items[${index}][qty]"
                           value="${item.quantity || item.qty || 0}"
                           class="qty w-full px-3 py-2 border rounded">
                </td>

                <td class="px-6 py-4">
                    <input type="number"
                           step="0.01"
                           name="items[${index}][price]"
                           value="${item.price || 0}"
                           class="price w-full px-3 py-2 border rounded">
                </td>

                <td class="px-6 py-4">
                    <input class="itemTotal w-full px-3 py-2 border bg-gray-50"
                           value="${((item.quantity || item.qty || 0) * (item.price || 0)).toFixed(2)}"
                           readonly>
                </td>

                <td class="px-6 py-4 text-center">
                    <button type="button" class="removeRow text-red-600">✖</button>
                </td>
            </tr>

            <tr class="serialRow bg-gray-50">
                <td colspan="5" class="px-6 py-4">
                    <div class="serials space-y-2"></div>
                </td>
            </tr>
        `);
        
        // Get the quantity from item
        const quantity = parseInt(item.quantity || item.qty || 0);
        
        // Render serials
        const serialContainer = tableBody.querySelector(`tr[data-index="${index}"]`).nextElementSibling.querySelector('.serials');
        renderSerials(index, quantity, serialContainer, itemSerials);
        
        index++;
    }

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
                    <button type="button" class="removeRow text-red-600 hover:text-red-900">
                        <svg class="h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </td>
            </tr>
            <tr class="serialRow bg-gray-50">
                <td colspan="5" class="px-6 py-4">
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

    function renderSerials(index, qty, container, existingSerials = []) {
        container.innerHTML = '';

        if (qty > 0) {
            container.innerHTML = `
                <p class="text-sm font-medium text-gray-700 mb-2">
                    Serial Numbers (${qty} items):
                    <span class="text-red-400">
                        (Warranty Date is Greater than Invoice Date)
                    </span>
                </p>`;

            for (let i = 0; i < qty; i++) {
                // Get existing serial for this position if available
                const existingSerial = existingSerials[i];
                const serialValue = existingSerial ? (existingSerial.serial_number || existingSerial.asset_code) : '';
                const warrantyValue = existingSerial && existingSerial.warranty_end_date ? existingSerial.warranty_end_date : '';
                const assetId = existingSerial && existingSerial.asset_id ? existingSerial.asset_id : '';
                
                container.insertAdjacentHTML('beforeend', `
                    <div class="flex gap-2 mb-2">
                        <input name="items_serials[${index}][${i}]"
                            class="w-full px-3 py-2 border rounded"
                            placeholder="Serial ${i + 1}"
                            value="${escapeHtml(serialValue)}" required>
                        <input name="warranty_end_date[${index}][${i}]" 
                               type="date" 
                               class="serial-date w-full px-3 py-2 border rounded"
                               value="${warrantyValue}">
                        ${assetId ? `
                        <input type="hidden" name="existing_assets[${index}][${i}]" value="${assetId}" required>
                        ` : ''}
                    </div>
                `);
            }

            // ONE-TIME GLOBAL APPLY for warranty dates
            let isWarrantyApplied = false;
            const dateInputs = container.querySelectorAll('.serial-date');
            
            // Check if all dates are the same on initial load
            const firstDate = dateInputs[0]?.value;
            const allSame = firstDate && Array.from(dateInputs).every(input => input.value === firstDate);
            if (allSame && firstDate) {
                isWarrantyApplied = true;
            }

            dateInputs.forEach(dateInput => {
                dateInput.addEventListener('change', function() {
                    // First date entry → apply to all
                    if (!isWarrantyApplied && this.value) {
                        const selectedDate = this.value;

                        dateInputs.forEach(d => {
                            d.value = selectedDate;
                        });

                        isWarrantyApplied = true; // lock auto-apply
                    }
                });
            });
        }
    }

    function handleRemove(e) {
        if (!e.target.closest('.removeRow')) return;
        const row = e.target.closest('tr');
        row.nextElementSibling.remove();
        row.remove();
        calculateTotals();
    }

    function calculateTotals() {
        let sub = [...document.querySelectorAll('.itemTotal')]
            .reduce((sum, i) => sum + (+i.value || 0), 0);

        let discount = 0;
        const discountType = document.getElementById('discountType');
        const discountValue = document.getElementById('discountValue');
        
        if (discountType.value === 'percentage') {
            discount = sub * discountValue.value / 100;
            document.getElementById('discountPercentage').value = discountValue.value;
            document.getElementById('discountAmount').value = discount.toFixed(2);
        }
        if (discountType.value === 'amount') {
            discount = +discountValue.value || 0;
            document.getElementById('discountAmount').value = discount.toFixed(2);
            document.getElementById('discountPercentage').value = '';
        }

        discount = Math.min(discount, sub);
        const taxable = sub - discount;
        const taxRate = TAX_RATES[document.getElementById('categorySelect').value] || 0;
        const tax = taxable * taxRate / 100;

        document.getElementById('subTotal').value = sub.toFixed(2);
        document.getElementById('taxAmount').value = tax.toFixed(2);
        document.getElementById('grandTotal').value = (taxable + tax).toFixed(2);

        // Update display values
        document.getElementById('subTotalDisplay').textContent = sub.toFixed(2);
        document.getElementById('taxAmountDisplay').textContent = tax.toFixed(2);
        document.getElementById('grandTotalDisplay').textContent = (taxable + tax).toFixed(2);
    }

    function updateStatusVisibility() {
        const statusSelect = document.getElementById('statusSelect');
        const partialDiv = document.getElementById('partialAmountDiv');
        const duedateDiv = document.getElementById('duedateDiv');
        const value = statusSelect.value;

        // Reset both divs first
        partialDiv.classList.add('hidden');
        duedateDiv.classList.add('hidden');

        if (value === 'partial_paid') {
            partialDiv.classList.remove('hidden');
            duedateDiv.classList.remove('hidden');
        } else if (value === 'unpaid') {
            duedateDiv.classList.remove('hidden');
        }
        // 'paid' status keeps both hidden
    }

    // Helper function to escape HTML
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    setTimeout(() => {
        document.getElementById('success-alert')?.remove();
        document.getElementById('error-alert')?.remove();
        document.getElementById('validation-alert')?.remove();
    }, 5000);
