const minusBtn = document.getElementById('minus-btn');
const plusBtn = document.getElementById('plus-btn');
const quantityInput = document.getElementById('quantity-input');

minusBtn.addEventListener('click', () => {
    if (quantityInput.value > 1) {
        quantityInput.value = parseInt(quantityInput.value) - 1;
    }
});

plusBtn.addEventListener('click', () => {
    quantityInput.value = parseInt(quantityInput.value) + 1;
});


const minusBtn2 = document.getElementById('minus-btn2');
const plusBtn2 = document.getElementById('plus-btn2');
const quantityInput2 = document.getElementById('quantity-input2');

minusBtn2.addEventListener('click', () => {
    if (quantityInput2.value > 1) {
        quantityInput2.value = parseInt(quantityInput2.value) - 1;
    }
});

plusBtn2.addEventListener('click', () => {
    quantityInput2.value = parseInt(quantityInput2.value) + 1;
});