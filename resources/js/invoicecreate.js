let index = 0;
const tableBody = document.querySelector('#itemsTable tbody');

document.addEventListener('DOMContentLoaded', function () {

    // Restore old rows OR create one default row
    if (window.oldInvoiceData && Object.keys(window.oldInvoiceData.items).length > 0) {
        Object.entries(window.oldInvoiceData.items).forEach(([i, item]) => {
            addRow(item, i);
        });
    } else {
        addRow();
    }

    // Restore select values
    if (window.oldInvoiceData) {
        categorySelect.value = window.oldInvoiceData.category || '';
        statusSelect.value = window.oldInvoiceData.status || '';
        discountType.value = window.oldInvoiceData.discount_type || '';
        discountValue.value = window.oldInvoiceData.discount_value || '';
    }

    toggleStatusFields();
    calculateTotals();
});

document.getElementById('addRow').addEventListener('click', () => addRow());
document.addEventListener('input', handleInput);
document.addEventListener('click', handleRemove);

discountType.onchange =
discountValue.oninput =
categorySelect.onchange = calculateTotals;

statusSelect.addEventListener('change', toggleStatusFields);

/* =========================
   ADD ROW
========================= */
// function addRow(item = null, itemIndex = null) {

//     const rowIndex = itemIndex !== null ? itemIndex : index;

//     tableBody.insertAdjacentHTML('beforeend', `
//         <tr data-index="${rowIndex}">
//             <td class="px-4 py-2">
//                 <input name="items[${rowIndex}][product_name]"
//                        value="${item?.product_name ?? ''}"
//                        class="w-full border px-2 py-1 rounded">
//             </td>

//             <td class="px-4 py-2">
//                 <input type="number" name="items[${rowIndex}][qty]"
//                        value="${item?.qty ?? 0}"
//                        class="qty w-full border px-2 py-1 rounded">
//             </td>

//             <td class="px-4 py-2">
//                 <input type="number" step="0.01" name="items[${rowIndex}][price]"
//                        value="${item?.price ?? 0}"
//                        class="price w-full border px-2 py-1 rounded">
//             </td>

//             <td class="px-4 py-2">
//                 <input class="itemTotal w-full border px-2 py-1 bg-gray-50"
//                        value="${((item?.qty ?? 0) * (item?.price ?? 0)).toFixed(2)}"
//                        readonly>
//             </td>

//             <td class="px-4 py-2 text-center">
//                 <button type="button" class="removeRow text-red-600">Remove</button>
//             </td>
//         </tr>

//         <tr>
//             <td colspan="5">
//                 <div class="serials space-y-2"></div>
//             </td>
//         </tr>
//     `);

//     if (item?.qty > 0) {
//         renderSerials(
//             rowIndex,
//             item.qty,
//             tableBody.querySelector(`tr[data-index="${rowIndex}"]`)
//                 .nextElementSibling.querySelector('.serials'),
//             window.oldInvoiceData?.items_serials?.[rowIndex] || {},
//             window.oldInvoiceData?.warranty_end_date?.[rowIndex] || {}
//         );
//     }

//     index++;
// }


function handleInput(e) {
    if (!e.target.closest('.qty, .price')) return;

    const row = e.target.closest('tr');
    const qty = +row.querySelector('.qty').value || 0;
    const price = +row.querySelector('.price').value || 0;

    row.querySelector('.itemTotal').value = (qty * price).toFixed(2);

    renderSerials(
        row.dataset.index,
        qty,
        row.nextElementSibling.querySelector('.serials')
    );

    calculateTotals();
}

function renderSerials(index, qty, container, serials = {}, warranties = {}) {
    container.innerHTML = '';

    for (let i = 1; i <= qty; i++) {
        container.insertAdjacentHTML('beforeend', `
            <div class="flex gap-2">
                <input name="items_serials[${index}][${i}]"
                       value="${serials[i] ?? ''}"
                       class="w-full border px-2 py-1 rounded"
                       placeholder="Serial ${i}" required>

                <input type="date"
                       name="warranty_end_date[${index}][${i}]"
                       value="${warranties[i] ?? ''}"
                       class="w-full border px-2 py-1 rounded"
                       required>
            </div>
        `);
    }
}


function handleRemove(e) {
    if (!e.target.classList.contains('removeRow')) return;

    const row = e.target.closest('tr');
    row.nextElementSibling.remove();
    row.remove();
    calculateTotals();
}

function calculateTotals() {

    let sub = [...document.querySelectorAll('.itemTotal')]
        .reduce((sum, el) => sum + (+el.value || 0), 0);

    let discount = 0;

    if (discountType.value === 'percentage') {
        discount = sub * (discountValue.value / 100 || 0);
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
    const taxRate = window.TAX_RATES?.[categorySelect.value] || 0;
    const tax = taxable * taxRate / 100;

    subTotal.value = sub.toFixed(2);
    taxAmount.value = tax.toFixed(2);
    grandTotal.value = (taxable + tax).toFixed(2);

    subTotalDisplay.textContent = sub.toFixed(2);
    taxAmountDisplay.textContent = tax.toFixed(2);
    grandTotalDisplay.textContent = (taxable + tax).toFixed(2);
}

function toggleStatusFields() {

    partialAmountDiv.classList.add('hidden');
    duedateDiv.classList.add('hidden');
    partialAmount.value = '';

    if (statusSelect.value === 'partial_paid') {
        partialAmountDiv.classList.remove('hidden');
        duedateDiv.classList.remove('hidden');
    }

    if (statusSelect.value === 'unpaid') {
        duedateDiv.classList.remove('hidden');
    }
}

setTimeout(() => {
    document.getElementById('success-alert')?.remove();
    document.getElementById('error-alert')?.remove();
    document.getElementById('validation-alert')?.remove();
}, 5000);
