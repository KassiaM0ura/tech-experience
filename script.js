const msg = document.getElementById('mensagem');
const contador = document.getElementById('contador');
const form = document.querySelector('form');
const erroOficinas = document.getElementById('erro-oficinas');


msg.addEventListener('input', () => {
  const restantes = 200 - msg.value.length;
  contador.textContent = `Restam ${restantes} caracteres`;
});

form.addEventListener('submit', (event) => {
  const marcadas = document.querySelectorAll('input[name="oficinas[]"]:checked');
  if (marcadas.length === 0) {
    event.preventDefault();
    erroOficinas.textContent = 'Selecione pelo menos uma oficina.';
  } else {
    erroOficinas.textContent = '';
  }
});