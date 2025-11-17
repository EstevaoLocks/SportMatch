document.addEventListener('DOMContentLoaded', function() {
    
    // 1. Validação com Microinteração de "Shake" (Tremida)
    const forms = document.querySelectorAll('.needs-validation');

    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();

                    // Encontra todos os campos inválidos
                    const invalidInputs = form.querySelectorAll(':invalid');
                    
                    invalidInputs.forEach(input => {
                        // Adiciona a classe de animação
                        input.classList.add('input-error-shake');

                        // Remove a classe após a animação acabar (450ms)
                        setTimeout(() => {
                            input.classList.remove('input-error-shake');
                        }, 450);
                    });
                }
                form.classList.add('was-validated');
            }, false);
        });

    // 2. Placeholder para ação do Google Sign In
    const googleBtns = document.querySelectorAll('.btn-google');
    googleBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            alert('Integração com API do Google seria iniciada aqui.');
        });
    });

    // 3. Lógica de Edição de Perfil
    const editLink = document.getElementById('editProfileLink');
    if(editLink) {
        editLink.addEventListener('click', function(e) {
            e.preventDefault();
            const inputs = document.querySelectorAll('.profile-input');
            let isReadOnly = inputs[0].readOnly;
            
            inputs.forEach(input => {
                // Pequena animação ao habilitar edição via CSS inline
                input.style.transition = "background-color 0.3s";
                
                if(isReadOnly) {
                    input.readOnly = false;
                    input.style.backgroundColor = "#fff"; // Destaca que é editável
                    input.classList.remove('form-control-plaintext'); // Opcional, dependendo do bootstrap
                } else {
                    input.readOnly = true;
                    input.style.backgroundColor = ""; // Volta ao padrão
                }
            });

            // Foca no primeiro campo se estiver habilitando edição
            if(isReadOnly) inputs[0].focus();
            
            // Troca o texto e ícone do botão
            this.innerHTML = isReadOnly ? 
                '<i class="fas fa-save me-2"></i> Salvar alterações' : 
                '<i class="fas fa-pen me-2"></i> Editar Informações pessoais';
        });
    }
});