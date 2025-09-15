$(document).ready(function(){
  $('#telefone').mask('(00) 00000-0000');
});

// Botão bonito para upload de imagem
document.getElementById('btnUploadAvatar').onclick = function() {
  document.getElementById('avatarInput').click();
};
document.getElementById('avatarInput').addEventListener('change', function(e) {
  const avatarImg = document.getElementById('avatarImg');
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(evt) {
      avatarImg.src = evt.target.result;
    };
    reader.readAsDataURL(file);
  } else {
    avatarImg.src = "https://ui-avatars.com/api/?name=Usuário&background=5bc0de&color=fff&size=100";
  }
});

// Chuva animada suave
function createRainDrops(qtd) {
  const rain = document.getElementById('rain');
  for (let i = 0; i < qtd; i++) {
    const drop = document.createElement('div');
    drop.className = 'drop';
    drop.style.left = Math.random() * 100 + 'vw';
    drop.style.animationDelay = (Math.random() * 2.5) + 's';
    drop.style.animationDuration = (2 + Math.random() * 2.5) + 's';
    rain.appendChild(drop);
  }
}
createRainDrops(60);