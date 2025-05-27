document.addEventListener('DOMContentLoaded', function () {
  const resultado = document.getElementById("resultado");

  document.addEventListener('click', function (e) {
    if (e.target.matches('[data-page]')) {
      e.preventDefault();

      const page = e.target.getAttribute('data-page');

      fetch(`artigos.php?page=${page}&ajax=1`)
        .then(res => res.text())
        .then(html => {
          resultado.innerHTML = html;
        })
    }
  });
});