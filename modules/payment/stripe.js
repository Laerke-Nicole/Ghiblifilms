// Initialize Stripe
const stripe = Stripe('pk_test_51QPRkfJdwUEjEc4UBGjodQoOpeveGMNyfRy8wz63ar2ZLQVcIdNir5MhfOQgHHvjNNYUFgccFEjLokPPf7r26cVM00DAscLhk8'); // Replace with your public key
const elements = stripe.elements();

// Style object for customization
const style = {
    base: {
        color: '#FFFFFF', 
        backgroundColor: '#1E1E1E', 
        fontFamily: 'Arial, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#BFBFBF',
        },
    },
    invalid: {
        color: '#FF5252',
        iconColor: '#FF5252',
    },
};

// Create the card element with custom styles
const card = elements.create('card', { style });
card.mount('#card-element');

// Handle form submission
const form = document.getElementById('payment-form');
form.addEventListener('submit', async (event) => {
    event.preventDefault();
    const { paymentMethod, error } = await stripe.createPaymentMethod({
        type: 'card',
        card: card,
    });

    if (error) {
        document.getElementById('error-message').textContent = error.message;
    } else {
        fetch('modules/payment/payment.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ paymentMethodId: paymentMethod.id }),
        })
        .then((response) => response.json())
        .then((data) => {
            console.log(data); // Add this line to debug
            if (data.success) {
                window.location.href = `index.php?page=invoicedetail&payment_intent=${data.payment_intent}`;
            } else {
                document.getElementById('error-message').textContent =
                    data.error || 'Payment failed';
            }
        })
        .catch((err) => {
            console.error('Fetch error:', err);
            document.getElementById('error-message').textContent = 'Unexpected error occurred.';
        });
    }
});