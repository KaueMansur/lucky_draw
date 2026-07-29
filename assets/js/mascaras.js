const inputTelefone = document.getElementById("telefone");
const emailOuTelefone = document.getElementById("email_ou_telefone");
const valorPago = document.getElementById("valor_pago");

inputTelefone.addEventListener('keyup', function (e) {
  // Remove todos os caracteres não numéricos
  let valor = e.target.value.replace(/\D/g, '');

  // Garante que o valor não seja maior que 11 dígitos
  if (valor.length > 11) {
    valor = valor.substring(0, 11);
  }

  // Aplica a máscara para 11 dígitos
  if (valor.length >= 11) {
    valor = valor.replace(/^(\d{2})(\d{5})(\d{4}).*/, '($1) $2-$3');
  }
  // Aplica a máscara para 10 dígitos (padrão antigo)
  else if (valor.length >= 10) {
    valor = valor.replace(/^(\d{2})(\d{4})(\d{4}).*/, '($1) $2-$3');
  }
  // Aplica a máscara para o DDD
  else if (valor.length >= 2) {
    valor = valor.replace(/^(\d{2})(\d*)/, '($1) $2');
  }

  // Atualiza o valor do campo
  e.target.value = valor;
});

function formatarMoeda(input) {
  let valor = input.value;

  // Remove qualquer caractere que não seja número
  valor = valor.replace(/\D/g, "");

  // Converte para decimal (centavos)
  valor = (valor / 100).toFixed(2);

  // Formata para o padrão brasileiro (R$)
  input.value = new Intl.NumberFormat('pt-BR', {
    style: 'currency',
    currency: 'BRL'
  }).format(valor);
}