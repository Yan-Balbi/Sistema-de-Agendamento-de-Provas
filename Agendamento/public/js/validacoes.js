document.addEventListener('DOMContentLoaded', function () {
    // 1. Máscara para CPF e validação imediata após formatação
    const cpfInput = document.getElementById('cpf');
    if (cpfInput) {
      cpfInput.addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        e.target.value = value;

        // Valida o CPF após aplicar a máscara
        validateCPFField(cpfInput);
      });
    }

    // 2. Funções para exibir e limpar mensagens de erro
    function setError(field, message) {
      field.classList.add('is-invalid');
      let feedback = field.nextElementSibling;
      if (!feedback || !feedback.classList.contains('invalid-feedback')) {
        feedback = document.createElement('div');
        feedback.className = 'invalid-feedback';
        field.parentNode.appendChild(feedback);
      }
      feedback.innerText = message;
    }

    function clearError(field) {
      field.classList.remove('is-invalid');
      let feedback = field.nextElementSibling;
      if (feedback && feedback.classList.contains('invalid-feedback')) {
        feedback.innerText = ''; // Limpa a mensagem sem remover o elemento
      }
    }

    // 3. Funções de validação

    // Validação do Nome: obrigatório e máximo 80 caracteres
    function validateNameField(nameField) {
      const value = nameField.value.trim();
      if (value === '') {
        setError(nameField, "O nome é obrigatório.");
        return false;
      }
      if (value.length > 80) {
        setError(nameField, "O nome deve ter no máximo 80 caracteres.");
        return false;
      }
      clearError(nameField);
      return true;
    }

    // Validação do Email: obrigatório e formato válido
    function validateEmailField(emailField) {
      const value = emailField.value.trim();
      const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (value === '') {
        setError(emailField, "O email é obrigatório.");
        return false;
      }
      if (!regex.test(value)) {
        setError(emailField, "Email inválido.");
        return false;
      }
      clearError(emailField);
      return true;
    }

    // Validação de CPF: obrigatório e deve ter 11 dígitos válidos
    function validateCPFField(field) {
      let value = field.value.replace(/\D/g, '');
      if (value === '') {
        setError(field, "O CPF é obrigatório.");
        return false;
      }
      if (value.length !== 11 || !isValidCPF(value)) {
        setError(field, "CPF inválido.");
        return false;
      }
      clearError(field);
      return true;
    }

    // Validação de Senha: mínimo 8 caracteres com letras maiúsculas, minúsculas, número e símbolo
    function validatePasswordField(passwordField, confirmationField) {
      const password = passwordField.value;
      if (password === '') {
        setError(passwordField, "A senha é obrigatória.");
        return false;
      }
      const strongRegex = /^(?=.*[a-zç])(?=.*[A-ZÇ])(?=.*\d)(?=.*[@$!%*?&])[A-Za-zçÇ\d@$!%*?&]{8,}$/;
      if (!strongRegex.test(password)) {
        setError(passwordField, "Senha fraca: mínimo 8 caracteres. Permitidos: letras maiúsculas (A-Z), minúsculas (a-z), números (0-9) e símbolos (@$!%*?&).");
        return false;
      }
      if (confirmationField) {
        if (password !== confirmationField.value) {
          setError(passwordField, "Senhas não coincidem.");
          setError(confirmationField, "Senhas não coincidem.");
          return false;
        } else {
          clearError(passwordField);
          clearError(confirmationField);
        }
      } else {
        clearError(passwordField);
      }
      return true;
    }

    // Validação de CPF
    function isValidCPF(cpf) {
      if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) return false;
      let sum = 0;
      for (let i = 0; i < 9; i++) {
        sum += parseInt(cpf.charAt(i)) * (10 - i);
      }
      let remainder = (sum * 10) % 11;
      if (remainder === 10 || remainder === 11) remainder = 0;
      if (remainder !== parseInt(cpf.charAt(9))) return false;
      sum = 0;
      for (let i = 0; i < 10; i++) {
        sum += parseInt(cpf.charAt(i)) * (11 - i);
      }
      remainder = (sum * 10) % 11;
      if (remainder === 10 || remainder === 11) remainder = 0;
      if (remainder !== parseInt(cpf.charAt(10))) return false;
      return true;
    }

    // 4. Eventos de validação em tempo real

    // Nome
    const nameInput = document.querySelector('input[name="name"]');
    if (nameInput) {
      nameInput.addEventListener('input', function () {
        validateNameField(nameInput);
      });
    }

    // Email
    const emailInput = document.querySelector('input[name="email"]');
    if (emailInput) {
      emailInput.addEventListener('input', function () {
        validateEmailField(emailInput);
      });
    }

    // CPF
    if (cpfInput) {
      cpfInput.addEventListener('input', function () {
        validateCPFField(cpfInput);
      });
    }

    // Senha e Confirmação
    const passwordInput = document.querySelector('input[name="password"]');
    const passwordConfirmationInput = document.querySelector('input[name="password_confirmation"]');
    if (passwordInput) {
      passwordInput.addEventListener('input', function () {
        validatePasswordField(passwordInput, passwordConfirmationInput);
      });
    }
    if (passwordConfirmationInput) {
      passwordConfirmationInput.addEventListener('input', function () {
        validatePasswordField(passwordInput, passwordConfirmationInput);
      });
    }

    // 5. Validação final no submit para impedir o envio se houver campos inválidos
    document.querySelectorAll('form').forEach(function (form) {
      form.addEventListener('submit', function (e) {
        let valid = true;
        if (nameInput && !validateNameField(nameInput)) valid = false;
        if (emailInput && !validateEmailField(emailInput)) valid = false;
        if (cpfInput && !validateCPFField(cpfInput)) valid = false;
        if (passwordInput && !validatePasswordField(passwordInput, passwordConfirmationInput)) valid = false;

        if (!valid) {
          e.preventDefault();
          const firstError = form.querySelector('.is-invalid');
          if (firstError) firstError.focus();
        }
      });
    });
  });
