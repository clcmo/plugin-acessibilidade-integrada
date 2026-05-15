# Título do Projeto

[![GitHub license](https://img.shields.io/github/license/clcmo/plugin-acessibilidade-integrada?style=for-the-badge)](https://github.com/clcmo/plugin-acessibilidade-integrada)
[![GitHub stars](https://img.shields.io/github/stars/clcmo/plugin-acessibilidade-integrada?style=for-the-badge)](https://github.com/clcmo/plugin-acessibilidade-integrada/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/clcmo/plugin-acessibilidade-integrada?style=for-the-badge)](https://github.com/clcmo/plugin-acessibilidade-integrada/network)
[![GitHub issues](https://img.shields.io/github/issues/clcmo/plugin-acessibilidade-integrada?style=for-the-badge)](https://github.com/clcmo/plugin-acessibilidade-integrada/issues)
[![GitHub donate](https://img.shields.io/github/sponsors/clcmo?color=pink&style=for-the-badge)](https://github.com/sponsors/clcmo)

# ♿ Plugin de Acessibilidade Integrado (PAI)

[![GitHub license](https://img.shields.io/github/license/clcmo/plugin-acessibilidade-integrada?style=for-the-badge)](https://github.com/clcmo/plugin-acessibilidade-integrada/blob/main/LICENCE)
[![GitHub stars](https://img.shields.io/github/stars/clcmo/plugin-acessibilidade-integrada?style=for-the-badge)](https://github.com/clcmo/plugin-acessibilidade-integrada/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/clcmo/plugin-acessibilidade-integrada?style=for-the-badge)](https://github.com/clcmo/plugin-acessibilidade-integrada/network)
[![GitHub issues](https://img.shields.io/github/issues/clcmo/plugin-acessibilidade-integrada?style=for-the-badge)](https://github.com/clcmo/plugin-acessibilidade-integrada/issues)
[![Version](https://img.shields.io/badge/version-5.2.0-blue?style=for-the-badge)](https://github.com/clcmo/plugin-acessibilidade-integrada/releases)

Plugin WordPress para adicionar um widget de acessibilidade integrado ao seu site, com suporte a alto contraste, ajuste de fonte, filtros para daltonismo e tradução em Libras via vLibras.

---

## ✨ Funcionalidades

- **Alto Contraste** — alterna o modo de alto contraste para melhor legibilidade
- **Ajuste de Fonte** — aumenta ou diminui o tamanho do texto da página
- **Filtros para Daltonismo** — suporte a quatro tipos de deficiência de visão de cores:
  - Protanopia
  - Deuteranopia
  - Tritanopia
  - Achromatopsia
- **Tradução em Libras** — integração com o [vLibras](https://vlibras.gov.br/), ferramenta oficial do Governo Federal Brasileiro
- **Botão flutuante** — widget acessível e discreto, renderizado no footer de todas as páginas
- **Reset geral** — botão para restaurar todas as configurações ao estado padrão

---

## 📋 Pré-requisitos

- WordPress **5.0** ou superior
- PHP **7.4** ou superior
- Acesso ao painel de administração do WordPress para instalar o plugin

---

## 🚀 Instalação

### Via upload manual

1. Faça o download ou clone este repositório:
   ```bash
   git clone https://github.com/clcmo/plugin-acessibilidade-integrada.git
   ```

2. Copie a pasta do plugin para o diretório de plugins do seu WordPress:
   ```bash
   cp -r plugin-acessibilidade-integrada /caminho/para/wp-content/plugins/
   ```

3. No painel do WordPress, acesse **Plugins → Plugins Instalados**.

4. Localize **Plugin de Acessibilidade Integrado (PAI)** e clique em **Ativar**.

### Via painel do WordPress

1. No painel, acesse **Plugins → Adicionar Novo → Enviar Plugin**.
2. Faça o upload do arquivo `.zip` do repositório.
3. Clique em **Instalar agora** e depois em **Ativar Plugin**.

---

## 🗂️ Estrutura do Projeto

```
plugin-acessibilidade-integrada/
├── .github/              # Configurações do GitHub (CI/CD, templates)
├── assets/
│   ├── css/
│   │   └── style.css     # Estilos do widget
│   └── js/
│       └── script.js     # Lógica de interação do widget
├── docs/                 # Documentação e arquivos de licença
├── scripts/              # Scripts auxiliares
├── .releaserc.json       # Configuração do Semantic Release
├── index.php             # Arquivo de segurança (evita acesso direto)
├── package.json          # Dependências de desenvolvimento (semantic-release)
├── plugin.php            # Arquivo principal do plugin
└── LICENCE               # Licença MIT
```

---

## ⚙️ Como Funciona

Após a ativação, o plugin injeta automaticamente:

- Um **botão flutuante** (ícone de acessibilidade) em todas as páginas públicas do site
- Um **menu de opções** que aparece ao clicar no botão, com todos os controles de acessibilidade
- Os **arquivos CSS e JS** necessários, carregados via `wp_enqueue_scripts`
- Os **filtros SVG** para simulação de daltonismo, renderizados de forma inline e invisível

O widget utiliza **Material Symbols** do Google para os ícones e integra o script externo do **vLibras** para a tradução em Língua Brasileira de Sinais.

---

## 🛠️ Desenvolvimento

Este projeto utiliza [Semantic Release](https://semantic-release.gitbook.io/semantic-release/) para versionamento automático com base em commits convencionais.

### Instalando dependências de desenvolvimento

```bash
npm install
```

### Publicando uma nova versão

```bash
npm run release
```

As versões são publicadas automaticamente a partir da branch `main` via GitHub Actions, seguindo o padrão [Conventional Commits](https://www.conventionalcommits.org/).

---

## 🤝 Contribuindo

Contribuições são muito bem-vindas! Por favor, leia o [guia de contribuição](https://github.com/clcmo/plugin-acessibilidade-integrada/blob/main/.github/CONTRIBUTING.md) antes de abrir um Pull Request.

1. Faça um **Fork** do projeto
2. Crie uma branch para sua feature: `git checkout -b feat/minha-feature`
3. Faça o commit seguindo os padrões convencionais: `git commit -m "feat: adiciona nova funcionalidade"`
4. Envie para o repositório remoto: `git push origin feat/minha-feature`
5. Abra um **Pull Request**

---

## 🔒 Segurança

Para reportar vulnerabilidades, consulte a [política de segurança](https://github.com/clcmo/plugin-acessibilidade-integrada/security/policy).

---

## 📄 Licença

Distribuído sob a licença **GNU**. Consulte o arquivo [LICENCE](https://github.com/clcmo/plugin-acessibilidade-integrada/blob/main/LICENCE) para mais informações.

---

## 👩‍💻 Autora

Desenvolvido por **Camila** — [milla@apprendendo.blog](mailto:milla@apprendendo.blog)

[![GitHub Sponsors](https://img.shields.io/github/sponsors/clcmo?color=pink&style=for-the-badge)](https://github.com/sponsors/clcmo)
