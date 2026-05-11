/**
 * scripts/bump-plugin-version.js
 *
 * Atualiza a linha "Version: X.Y.Z" no cabeçalho do plugin PHP.
 * Chamado automaticamente pelo semantic-release via @semantic-release/exec.
 *
 * Uso: node scripts/bump-plugin-version.js 4.1.0
 */

const fs   = require('fs');
const path = require('path');

const PLUGIN_FILE = path.resolve(__dirname, '..', 'pai-accessibility-plugin.php');
const newVersion  = process.argv[2];

if (!newVersion) {
    console.error('❌ Versão não informada. Uso: node bump-plugin-version.js <versão>');
    process.exit(1);
}

if (!/^\d+\.\d+\.\d+$/.test(newVersion)) {
    console.error('❌ Versão inválida. Use o formato semver: X.Y.Z');
    process.exit(1);
}

let content = fs.readFileSync(PLUGIN_FILE, 'utf8');

// Substitui a linha "Version:" no cabeçalho do plugin WordPress
content = content.replace(
    /(\s*\*\s*Version:\s*)[\d]+\.[\d]+\.[\d]+/,
    `$1${newVersion}`
);

fs.writeFileSync(PLUGIN_FILE, content, 'utf8');
console.log(`✅ Plugin atualizado para a versão ${newVersion}`);