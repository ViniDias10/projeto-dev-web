document.getElementById('cadastro').addEventListener('submit', function(e) {
    e.preventDefault();
    

    const nome = document.getElementById('nome').value;
    const email = document.getElementById('email').value;
    const cpf = document.getElementById('cpf').value;
    const telefone = document.getElementById('telefone').value;

    
    setTimeout(function() {
        alert('Cadastro realizado com sucesso!');
        document.getElementById('formulario-container').classList.remove('hidden');
        document.getElementById('listar-ingresso').classList.remove('hidden');
        
    
        document.querySelector('.container-cadastro').classList.add('hidden');
    }, 500);
});



function changeQuantity(type, change) {
    var inputElement = document.getElementById(type);
    var currentValue = parseInt(inputElement.value);
    var newValue = currentValue + change;
    if (newValue < 0) {
        newValue = 0; // Prevent negative quantity
    }
    inputElement.value = newValue;

    updateTotalPrice();
}

function updateTotalPrice() {
    var valorArqInteira = parseFloat(document.getElementById('arqInteira').value) * 80;
    var valorArqMeia = parseFloat(document.getElementById('arqMeia').value) * 40;
    var valorVIPInteira = parseFloat(document.getElementById('vipInteira').value) * 200;
    var valorVIPMeia = parseFloat(document.getElementById('vipMeia').value) * 100;

    var totalPrice = valorArqInteira + valorArqMeia + valorVIPInteira + valorVIPMeia;

    document.getElementById('resultado').innerText = 'Total a pagar: R$ ' + totalPrice.toFixed(2);
}

// Atualiza o preço total inicialmente
updateTotalPrice();

// Atualiza o preço total quando a quantidade mudar
document.querySelectorAll('.quantity-container input').forEach(item => {
    item.addEventListener('input', updateTotalPrice);
});

