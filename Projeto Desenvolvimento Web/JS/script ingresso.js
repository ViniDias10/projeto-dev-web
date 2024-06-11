// Funcionalidade formulário de cadastro

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




// Conexão com LocalStorage
let ingressos = getIngressosSalvos();

function getIngressosSalvos() {
    const savedIngressos = localStorage.getItem('ingressos');
    return savedIngressos ? JSON.parse(savedIngressos) : [];
}

function salvarIngressos() {
    localStorage.setItem('ingressos', JSON.stringify(ingressos));
}

function limparFormulario() {
    document.getElementById('partida').value = '';
    document.getElementById('arqInteira').value = '0';
    document.getElementById('arqMeia').value = '0';
    document.getElementById('vipInteira').value = '0';
    document.getElementById('vipMeia').value = '0';
}

document.getElementById('formulario').addEventListener('submit', function(event) {
    event.preventDefault();

    const nome = document.getElementById('nome').value;
    const email = document.getElementById('email').value;
    const partida = document.getElementById('partida').value;
    const arqInteira = parseInt(document.getElementById('arqInteira').value);
    const arqMeia = parseInt(document.getElementById('arqMeia').value);
    const vipInteira = parseInt(document.getElementById('vipInteira').value);
    const vipMeia = parseInt(document.getElementById('vipMeia').value);

    const ingresso = {
        nome,
        email,
        partida,
        setores: {
            arqInteira,
            arqMeia,
            vipInteira,
            vipMeia
        }
    };

    ingressos.push(ingresso);
    salvarIngressos();
    alert('Sua compra foi confirmada');
    limparFormulario();
    document.getElementById('botao-listar').style.display = 'block'; // Mostrar botão "Listar ingressos"
});

document.getElementById('cadastro').addEventListener('submit', function(event) {
    event.preventDefault();
    
});

// Função para renderizar a lista de ingressos
// Função para abrir o popup e exibir os ingressos
function abrirPopup() {
    const popup = document.getElementById('popup');
    popup.style.display = 'block';
    renderizarIngressos('popup-ingressos');
}

// Função para fechar o popup
function fecharPopup() {
    const popup = document.getElementById('popup');
    popup.style.display = 'none';
}

// Função para renderizar os ingressos (normal ou no popup)
function renderizarIngressos(elementId) {
    const container = document.getElementById(elementId);
    container.innerHTML = '';

    if (ingressos.length === 0) {
        container.innerHTML = '<p>Nenhum ingresso disponível.</p>';
        return;
    }

    ingressos.forEach((ingresso, index) => {
        const totalArqInteira = ingresso.setores.arqInteira * 80;
        const totalArqMeia = ingresso.setores.arqMeia * 40;
        const totalVipInteira = ingresso.setores.vipInteira * 200;
        const totalVipMeia = ingresso.setores.vipMeia * 100;
        const total = totalArqInteira + totalArqMeia + totalVipInteira + totalVipMeia;

        const listItem = document.createElement('div');
        listItem.classList.add('ingresso');
        listItem.innerHTML = `
            <p><strong>Nome:</strong> ${ingresso.nome}</p>
            <p><strong>Email:</strong> ${ingresso.email}</p>
            <p><strong>Partida:</strong> ${ingresso.partida}</p>
            <p><strong>Arquibancada Inteira:</strong> ${ingresso.setores.arqInteira}</p>
            <p><strong>Arquibancada Meia:</strong> ${ingresso.setores.arqMeia}</p>
            <p><strong>VIP Inteira:</strong> ${ingresso.setores.vipInteira}</p>
            <p><strong>VIP Meia:</strong> ${ingresso.setores.vipMeia}</p>
            <p><strong>Valor Total:</strong> R$ ${total.toFixed(2)}</p>
            <button onclick="excluirIngresso(${index}); fecharPopup();">Cancelar compra</button>
            <hr>
        `;
        container.appendChild(listItem);
    });
}

// Evento para mostrar os ingressos no popup ao clicar no botão "Listar ingressos"
document.getElementById('botao-listar').addEventListener('click', function() {
    abrirPopup();
});

// Função para mostrar mensagem de nenhum ingresso disponível ao clicar novamente em "Listar ingressos"
function mostrarMensagemNenhumIngresso() {
    const popup = document.getElementById('popup');
    const popupContent = document.querySelector('.popup-content');
    const popupIngressos = document.getElementById('popup-ingressos');

    popupContent.style.textAlign = 'center';
    popupIngressos.innerHTML = '<p>Nenhum ingresso disponível.</p>';
    popup.style.display = 'block';
}




// Evento para mostrar mensagem de nenhum ingresso disponível ao clicar novamente em "Listar ingressos"
document.getElementById('botao-listar').addEventListener('click', function() {
    if (ingressos.length === 0) {
        mostrarMensagemNenhumIngresso();
    } else {
        abrirPopup();
    }
});

// Atualizar
function changeQuantity(id, delta) {
    const input = document.getElementById(id);
    const newValue = Math.max(0, parseInt(input.value) + delta);
    input.value = newValue;
}

// Deletar
function excluirIngresso(index) {
    ingressos.splice(index, 1);
    alert("Sua compra foi cancelada");
    fecharPopup();
    renderizarIngressosNormal();
}




