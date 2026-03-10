#!/bin/bash

# Script de instalación para Legacy of Stones - Modern Design Update
# Ejecutar en la raíz del proyecto Metin2CMS

echo "🎨 Legacy of Stones - Instalación del Diseño Moderno"
echo "=================================================="

# Verificar que estamos en el directorio correcto
if [ ! -f "config.php" ]; then
    echo "❌ Error: No se encuentra config.php. Asegúrate de estar en la raíz del proyecto Metin2CMS"
    exit 1
fi

echo "✅ Directorio correcto detectado"

# Backup de archivos originales
echo "📦 Creando backup de archivos originales..."
mkdir -p backup/$(date +%Y%m%d_%H%M%S)
cp index.php backup/$(date +%Y%m%d_%H%M%S)/ 2>/dev/null || true

echo "✅ Backup creado"

# Extraer archivos del update
echo "📤 Extrayendo archivos del update..."
tar -xzf modern-design-update.tar.gz

if [ $? -eq 0 ]; then
    echo "✅ Archivos extraídos correctamente"
else
    echo "❌ Error al extraer archivos"
    exit 1
fi

# Verificar archivos
echo "🔍 Verificando archivos instalados..."
files=("css/modern-theme.css" "css/logo-modern.css" "css/effects.css" "images/logo-modern.svg" "MODERN-DESIGN-README.md")

for file in "${files[@]}"; do
    if [ -f "$file" ]; then
        echo "✅ $file - OK"
    else
        echo "❌ $file - FALTANTE"
    fi
done

echo ""
echo "🎉 ¡Instalación completada!"
echo ""
echo "📖 Lee MODERN-DESIGN-README.md para más información"
echo "🌐 Visita tu sitio para ver los cambios"
echo ""
echo "💡 Si algo no funciona, revisa la consola del navegador (F12)"