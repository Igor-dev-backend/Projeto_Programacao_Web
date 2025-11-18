// MenuExpress - JavaScript para o painel administrativo

let currentEditId = null;
let deleteId = null;

// Inicializar funcionalidades do admin
document.addEventListener('DOMContentLoaded', function() {
    initAdminFunctions();
    initFormValidation();
});

// Funções principais do admin
function initAdminFunctions() {
    // Limpar formulário ao carregar
    clearForm();
    
    // Configurar eventos dos botões
    const form = document.getElementById('pratoForm');
    if (form) {
        form.addEventListener('submit', handleFormSubmit);
    }
}

// Validação de formulário
function initFormValidation() {
    const form = document.getElementById('pratoForm');
    if (!form) return;
    
    const inputs = form.querySelectorAll('input[required], textarea[required]');
    inputs.forEach(input => {
        input.addEventListener('blur', validateField);
        input.addEventListener('input', clearFieldError);
    });
}

// Validar campo individual
function validateField(event) {
    const field = event.target;
    const value = field.value.trim();
    
    if (!value) {
        showFieldError(field, 'Este campo é obrigatório');
        return false;
    }
    
    // Validações específicas
    if (field.type === 'number' && field.name === 'preco') {
        if (parseFloat(value) <= 0) {
            showFieldError(field, 'O preço deve ser maior que zero');
            return false;
        }
    }
    
    if (field.type === 'url' && field.name === 'imagem' && value) {
        if (!isValidImageUrl(value)) {
            showFieldError(field, 'URL de imagem inválida');
            return false;
        }
    }
    
    clearFieldError(event);
    return true;
}

// Mostrar erro no campo
function showFieldError(field, message) {
    clearFieldError({ target: field });
    
    field.style.borderColor = '#e74c3c';
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.textContent = message;
    errorDiv.style.cssText = 'color: #e74c3c; font-size: 0.8rem; margin-top: 0.25rem;';
    
    field.parentNode.appendChild(errorDiv);
}

// Limpar erro do campo
function clearFieldError(event) {
    const field = event.target;
    field.style.borderColor = '#e9ecef';
    
    const errorDiv = field.parentNode.querySelector('.field-error');
    if (errorDiv) {
        errorDiv.remove();
    }
}

// Manipular envio do formulário
function handleFormSubmit(event) {
    event.preventDefault();
    
    if (!validateForm('pratoForm')) {
        showNotification('Preencha todos os campos obrigatórios corretamente!', 'error');
        return;
    }
    
    // Mostrar loading
    const submitBtn = event.target.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Salvando...';
    submitBtn.disabled = true;
    
    // Simular delay para melhor UX
    setTimeout(() => {
        event.target.submit();
    }, 500);
}

// Editar prato
function editPrato(prato) {
    currentEditId = prato.id;
    
    // Preencher formulário
    document.getElementById('editId').value = prato.id;
    document.getElementById('nome').value = prato.nome;
    document.getElementById('descricao').value = prato.descricao;
    document.getElementById('preco').value = prato.preco;
    document.getElementById('imagem').value = prato.imagem || '';
    
    // Alterar ação do formulário
    document.querySelector('input[name="action"]').value = 'edit';
    
    // Alterar título e botão
    const cardHeader = document.querySelector('.card-header h2');
    const submitBtn = document.querySelector('button[type="submit"]');
    
    cardHeader.innerHTML = '<i class="fas fa-edit"></i> Editar Prato';
    submitBtn.innerHTML = '<i class="fas fa-save"></i> Atualizar Prato';
    
    // Scroll para o formulário
    document.querySelector('.card').scrollIntoView({ 
        behavior: 'smooth',
        block: 'start'
    });
    
    showNotification('Prato carregado para edição', 'info');
}

// Excluir prato
function deletePrato(id) {
    deleteId = id;
    document.getElementById('deleteModal').style.display = 'block';
}

// Confirmar exclusão
function confirmDelete() {
    if (!deleteId) return;
    
    // Criar formulário para exclusão
    const form = document.createElement('form');
    form.method = 'POST';
    form.style.display = 'none';
    
    const actionInput = document.createElement('input');
    actionInput.type = 'hidden';
    actionInput.name = 'action';
    actionInput.value = 'delete';
    
    const idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'id';
    idInput.value = deleteId;
    
    form.appendChild(actionInput);
    form.appendChild(idInput);
    document.body.appendChild(form);
    
    // Mostrar loading
    showNotification('Excluindo prato...', 'info');
    
    form.submit();
}

// Fechar modal
function closeModal() {
    document.getElementById('deleteModal').style.display = 'none';
    deleteId = null;
}

// Limpar formulário
function clearForm() {
    currentEditId = null;
    
    // Limpar campos
    document.getElementById('pratoForm').reset();
    document.getElementById('editId').value = '';
    
    // Restaurar título e botão
    const cardHeader = document.querySelector('.card-header h2');
    const submitBtn = document.querySelector('button[type="submit"]');
    
    cardHeader.innerHTML = '<i class="fas fa-plus"></i> Adicionar Novo Prato';
    submitBtn.innerHTML = '<i class="fas fa-save"></i> Salvar Prato';
    
    // Limpar erros visuais
    const inputs = document.querySelectorAll('.form-group input, .form-group textarea');
    inputs.forEach(input => {
        input.style.borderColor = '#e9ecef';
    });
    
    const errors = document.querySelectorAll('.field-error');
    errors.forEach(error => error.remove());
}

// Fechar modal ao clicar fora
window.onclick = function(event) {
    const modal = document.getElementById('deleteModal');
    if (event.target === modal) {
        closeModal();
    }
}

// Atalhos de teclado
document.addEventListener('keydown', function(event) {
    // ESC para fechar modal
    if (event.key === 'Escape') {
        closeModal();
    }
    
    // Ctrl+Enter para salvar formulário
    if (event.ctrlKey && event.key === 'Enter') {
        const form = document.getElementById('pratoForm');
        if (form) {
            form.dispatchEvent(new Event('submit'));
        }
    }
});

// Função para preview de imagem em tempo real
function previewImage(input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Aqui você pode adicionar um preview da imagem
            console.log('Preview da imagem:', e.target.result);
        };
        reader.readAsDataURL(file);
    }
}

// Função para validar URL de imagem
function isValidImageUrl(url) {
    const imageExtensions = /\.(jpg|jpeg|png|gif|webp)$/i;
    return imageExtensions.test(url) || url.startsWith('data:image/');
}

// Função para formatar preço em tempo real
function formatPriceInput(input) {
    let value = input.value.replace(/[^\d,]/g, '');
    value = value.replace(',', '.');
    const numValue = parseFloat(value);
    
    if (!isNaN(numValue)) {
        input.value = numValue.toFixed(2);
    }
}

// Adicionar formatação de preço ao campo
document.addEventListener('DOMContentLoaded', function() {
    const precoInput = document.getElementById('preco');
    if (precoInput) {
        precoInput.addEventListener('blur', function() {
            formatPriceInput(this);
        });
    }
});

// Função para confirmar saída da página com alterações não salvas
let formChanged = false;

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('pratoForm');
    if (form) {
        const inputs = form.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                formChanged = true;
            });
        });
    }
});

window.addEventListener('beforeunload', function(event) {
    if (formChanged && currentEditId) {
        event.preventDefault();
        event.returnValue = 'Você tem alterações não salvas. Deseja realmente sair?';
    }
});

// Função para auto-save (opcional)
function autoSave() {
    if (formChanged && !currentEditId) {
        // Salvar automaticamente como rascunho
        console.log('Auto-save implementado aqui');
    }
}

// Auto-save a cada 30 segundos
setInterval(autoSave, 30000);
