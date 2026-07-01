// resources/views/constructor.blade.php — JavaScript конструктора букета
<script>
    let items = {}; // { flower_id: { name, price, qty } }

    function changeQty(flowerId, name, price, delta) {
        if (!items[flowerId]) {
            items[flowerId] = { name, price, qty: 0 };
        }
        items[flowerId].qty = Math.max(0, items[flowerId].qty + delta);
        if (items[flowerId].qty === 0) delete items[flowerId];
        updateSummary();
    }

    function updateSummary() {
        let total = 0;
        const list = document.getElementById('selected-items');
        list.innerHTML = '';

        for (const id in items) {
            const item = items[id];
            const sum = item.price * item.qty;
            total += sum;
            list.innerHTML += `<li>${item.name} × ${item.qty} = ${sum} ₽</li>`;
        }
        document.getElementById('total-sum').textContent = total + ' ₽';
    }

    function prepareOrder() {
        // Сериализуем выбранные цветы в JSON для отправки на сервер
        const data = {};
        for (const id in items) {
            data[id] = items[id].qty;
        }
        document.getElementById('constructor-items').value = JSON.stringify(data);
    }
</script>