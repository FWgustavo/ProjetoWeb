<div class="sidebar" id="sidebar" style="background:#2c3e50; color:white; height:100vh; width:60px; transition:width 0.3s; position:fixed; z-index:2; overflow-x:hidden; padding-top:20px;">
    <div class="toggle-btn text-center mb-3" onclick="toggleSidebar()" style="cursor:pointer; font-size:20px;">&#9776;</div>
    <a href="/" class="d-block px-3 py-2 text-white text-decoration-none">Inicio</a>
    <a href="/usuario" class="d-block px-3 py-2 text-white text-decoration-none">Usuário</a>
    <a href="/medico" class="d-block px-3 py-2 text-white text-decoration-none">Médico</a>
    <a href="/paciente" class="d-block px-3 py-2 text-white text-decoration-none">Paciente</a>
    <a href="/produto" class="d-block px-3 py-2 text-white text-decoration-none">Produto</a>
    <a href="/servico" class="d-block px-3 py-2 text-white text-decoration-none">Serviço</a>
    <a href="/logout" class="d-block px-3 py-2 text-white text-decoration-none">Sair</a>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('expanded');
        if(sidebar.classList.contains('expanded')) {
            sidebar.style.width = '180px';
        } else {
            sidebar.style.width = '60px';
        }
    }
</script>
