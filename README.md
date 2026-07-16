# 🚀 Lucky Draw

<p align="center">
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" alt="HTML5" />
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" alt="CSS3" />
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript" />
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
</p>

> Uma plataforma completa de gerenciamento de rifas onde é possível criar, vender, comprar, sortear e acompanhar os resultados das ações de forma simples e intuitiva.

🎯 **[Clique aqui para jogar/testar a versão online!](https://lucky-draw.vercel.app)**
---

## 💻 Sobre o Projeto

Este projeto Full Stack foi desenvolvido com o objetivo de praticar a integração entre um sistema web interativo, regras de negócio complexas no servidor e persistência relacional de dados. A aplicação permite o ciclo completo de gerenciamento de rifas, desde o cadastro dos compradores até a realização de sorteios transparentes e acompanhamento de resultados.

---

## 🧠 Principais Funcionalidades

* 📄 **Criar Rifa:** Sistema de criação de campanhas personalizadas com foto, descrição de objetivo, definição de preços e quantidade de números.
* ❌ **Excluir Rifa:** Controle de segurança que permite a exclusão de rifas apenas se nenhum número tiver sido vendido para ela.
* 🙍‍♂️ **Cadastrar Compradores:** Cadastro de clientes locais registrando nome e telefone para contato rápido.
* ✏️ **Editar Comprador:** Atualização rápida dos dados de contato dos compradores cadastrados.
* ❌ **Excluir Comprador:** Regra de negócio que impede a exclusão de um comprador que possua números ativos vinculados ao seu nome.
* 💸 **Venda de Números:** Interface administrativa para selecionar e vender números específicos a compradores cadastrados.
* 💰 **Simulação de Compra:** Fluxo de reserva e compra de números (sem sistema monetário real, projetado para fins de demonstração).
* 🎲 **Sortear Número:** Sistema de sorteio aleatório e auditável para definir de forma justa o vencedor de cada rifa.
* 📊 **Acompanhar Resultados:** Dashboard visual para verificar o status de números vendidos e visualizar os sorteios já realizados das rifas adquiridas.
* 🔐 **Autenticação Segura em PHP:** Sistema de login e cadastro robusto com criptografia de senhas utilizando o algoritmo moderno **bcrypt** (`password_hash` e `password_verify`).
* 🛡️ **Gerenciamento Seguro de Sessões:** Controle de sessão nativo do PHP com regeneração de ID de sessão (`session_regenerate_id`) para prevenção de ataques de fixação de sessão.
* 🛡️ **Proteção contra SQL Injection:** Consultas ao banco de dados estruturadas de forma segura utilizando **Prepared Statements (PDO)**.
* 📱 **Layout Responsivo:** Otimizado para visualização e uso tanto no computador quanto no celular.

---

## 🛠️ Tecnologias Utilizadas

* **Front-end (Interface):**
  * **Estruturação:** [HTML5](https://developer.mozilla.org/pt-BR/docs/Web/HTML)
  * **Estilização:** [CSS3](https://developer.mozilla.org/pt-BR/docs/Web/CSS)
  * **Lógica e Dinâmica:** [JavaScript (ES6)](https://developer.mozilla.org/pt-BR/docs/Web/JavaScript)

* **Back-end (Servidor):**
  * **Lógica e APIs:** [PHP](https://www.php.net/) (com arquitetura MVC e manipulação segura de sessões)

* **Banco de Dados:**
  * **Persistência de Dados:** [MySQL](https://www.mysql.com/) (consultas seguras utilizando PDO e Prepared Statements)

* **Hospedagem & Deploy:**
  * **Servidor e Banco:** [HostGator](https://www.hostgator.com.br/)

---

## ⚙️ Como Executar o Projeto Localmente

Para rodar este projeto com servidor e banco de dados na sua máquina local, siga os passos abaixo:

### 📋 Pré-requisitos

Antes de começar, você precisará ter instalado em sua máquina:
1. **[Git](https://git-scm.com)** (para clonar o repositório).
2. Um ambiente de desenvolvimento PHP e MySQL local. Recomendo usar um dos seguintes programas que já configuram tudo de uma vez:
   * **[Laragon](https://laragon.org/)** (Recomendado para Windows - mais rápido e moderno).
   * **[XAMPP](https://www.apachefriends.org/)** (Excelente para Windows, macOS e Linux).

---

### 🚀 Passo a Passo

#### 1. Clonar o Repositório
Abra o seu terminal (ou Git Bash) e navegue até a pasta de servidores públicos do seu programa:
* Se usar o **Laragon**: vá para `C:/laragon/www/`
* Se usar o **XAMPP**: vá para `C:/xampp/htdocs/`

Rode o comando para clonar:
```bash
git clone [https://github.com/KaueMansur/lucky_draw.git](https://github.com/KaueMansur/lucky_draw.git)