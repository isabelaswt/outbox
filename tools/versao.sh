#!/bin/sh
# Troca a versão em todos os lugares (topo da ferramenta e ?v= dos arquivos no HTML).
#   tools/versao.sh 2026-10-27.nome
[ -z "$1" ] && { echo "uso: tools/versao.sh AAAA-MM-DD.nome"; exit 1; }
cd "$(dirname "$0")/.."
sed -i "s/const BUILD = '[^']*'/const BUILD = '$1'/" js/app.js
sed -i "s/app\.js?v=[^\"]*\"/app.js?v=$1\"/; s/app\.css?v=[^\"]*\"/app.css?v=$1\"/" index.html
grep -o "const BUILD = '[^']*'" js/app.js; grep -o 'app\.[a-z]*?v=[^"]*' index.html
