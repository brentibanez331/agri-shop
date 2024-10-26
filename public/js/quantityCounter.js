const minusBtn = document.getElementById('minus-btn');
const plusBtn = document.getElementById('plus-btn');
const quantityInput = document.getElementById('quantity-input');

minusBtn.addEventListener('click', (event) => {
    event.preventDefault();
    if (quantityInput.value > 1) {
        quantityInput.value = parseInt(quantityInput.value) - 1;
    }
});

plusBtn.addEventListener('click', (event) => {
    event.preventDefault();
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

function validateQuantity(input) {
    const max = parseInt(input.getAttribute('max'));
    const inputValue = parseInt(input.value);

    if (inputValue > max) {
        input.value = max;
    } else if (inputValue < 1) {
        input.value = 1;
    }
}

const minusBtn3 = document.getElementById('minus-btn3');
const plusBtn3 = document.getElementById('plus-btn3');
const quantityInput3 = document.getElementById('quantity-input3');

minusBtn3.addEventListener('click', () => {
    if (quantityInput3.value > 1) {
        quantityInput3.value = parseInt(quantityInput3.value) - 1;
    }
});

plusBtn3.addEventListener('click', () => {
    quantityInput3.value = parseInt(quantityInput3.value) + 1;
});

function validateQuantity(input) {
    const max = parseInt(input.getAttribute('max'));
    const inputValue = parseInt(input.value);

    if (inputValue > max) {
        input.value = max;
    } else if (inputValue < 1) {
        input.value = 1;
    }
}