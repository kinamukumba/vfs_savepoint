VFS Save Point API
📌 Descrição

O VFS Save Point API é uma solução completa para agilizar o preenchimento do formulário de agendamento de vistos no site da VFS Global
.
Ela permite:

Cadastrar usuários localmente.

Preparar um usuário para agendamento.

Recuperar dados do usuário preparado via API.

Integração com script Tampermonkey para preenchimento automático no site da VFS.

Funciona como um sistema de “save point” profissional, prevenindo perdas de dados em caso de falhas ou quedas da plataforma.

🏗️ Estrutura do Projeto
vfs-save-point/
├── backend/
│   ├── config.php           # Configurações do banco
│   ├── db.php               # Conexão PDO
│   ├── create_user.php      # Endpoint para criar usuário
│   ├── get_users.php        # Listar todos os usuários
│   ├── get_user.php         # Buscar usuário por ID
│   ├── set_active_user.php  # Definir usuário ativo
│   ├── get_active_user.php  # Retornar usuário ativo
├── frontend/
│   ├── index.html           # Painel local de cadastro
│   ├── style.css            # Estilo do painel
│   └── app.js               # Lógica do painel
├── tampermonkey/
│   └── vfs_autofill.user.js # Script de preenchimento automático
└── README.md

💾 Banco de Dados
Tabela users
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(100),
  last_name VARCHAR(100),
  passport_number VARCHAR(50),
  birth_date DATE,
  phone VARCHAR(30),
  email VARCHAR(100),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

⚡ Endpoints da API

Base URL: http://localhost/save_point/backend

Método	Endpoint	Descrição	Params/Body
POST	/create_user.php	Cria um usuário no banco	JSON: { first_name, last_name, passport_number, birth_date, phone, email }
GET	/get_users.php	Lista todos os usuários cadastrados	—
GET	/get_user.php	Busca um usuário pelo ID	Query: id
POST	/set_active_user.php	Define o usuário ativo	x-www-form-urlencoded: id
GET	/get_active_user.php	Retorna o usuário ativo atual	—
🖥️ Painel Local (Frontend)

Interface simples para:

Cadastrar novos usuários.

Selecionar um usuário e prepará-lo para VFS.

Botão “Preparar para VFS” define o usuário ativo na API, pronto para ser consumido pelo Tampermonkey.

📜 Tampermonkey Script
Funcionalidade

Busca o usuário ativo da API.

Preenche automaticamente os campos do formulário your-details no site da VFS.

Retry automático a cada 1.5s para páginas que carregam dinamicamente.

Uso

Instalar Tampermonkey no navegador.

Criar novo script e colar vfs_autofill.user.js.

Abrir site da VFS → campos preenchidos automaticamente.

🔧 Instalação

Instalar XAMPP (ou outro servidor PHP + MySQL).

Copiar pasta backend para htdocs.

Importar SQL no phpMyAdmin.

Abrir frontend/index.html para gerenciar usuários.

Configurar Tampermonkey com o script.

🛠️ Exemplo de Uso (JS Frontend)
// Preparar usuário para VFS
fetch("http://localhost/save_point/backend/set_active_user.php", {
  method: "POST",
  headers: { "Content-Type": "application/x-www-form-urlencoded" },
  body: "id=5"
});

// Tampermonkey irá consumir automaticamente
const user = await fetch("http://localhost/save_point/backend/get_active_user.php", { credentials: "include" })
                  .then(res => res.json());

🔐 Limitações

Não contorna CAPTCHAs nem validação biométrica.

Não submete automaticamente formulários.

Apenas otimiza o preenchimento e previne perda de dados.

🏆 Diferenciais

Save Point profissional por etapa.

Redução de 70–85% do tempo manual.

Compatível com múltiplos operadores.

Extensível para SaaS ou automação corporativa.
