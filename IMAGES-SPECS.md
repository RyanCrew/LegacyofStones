# 🎨 Especificaciones de Imágenes Metin2 - Legacy of Stones

## 📋 Imágenes Necesarias

A continuación encontrarás especificaciones detalladas para cada imagen que se recomienda crear o descargar.

---

## 1. **Logo del Servidor** (`images/logo-modern.svg`)
**Estado:** ✅ Ya existe

**Especificaciones:**
- **Formato:** SVG (escalable, ideal)
- **Tamaño:** 50x50px (para cabecera), puede escalar
- **Descripción:** Logo con el nombre "Legacy of Stones"
- **Ubicación:** `/images/logo-modern.svg`
- **Uso:** Cabecera principal (izquierda)

---

## 2. **Banner Hero Principal**
**Estado:** ❌ Opcional pero recomendado

**Especificaciones:**
- **Formato:** JPG o PNG
- **Tamaño:** 1920x600px (ancho/alto)
- **Resolución:** 72 DPI
- **Descripción:** Imagen de fondo épica de Metin2 (dragones, castillos, magia)
- **Ubicación sugerida:** `/images/banner-hero.jpg`
- **Uso:** Fondo de la sección principal/heroica

**Dónde incluirlo:** Crea una sección nueva en `index.php` antes o después del contenido principal.

---

## 3. **Iconos de Imperio** (`images/empire/`)
**Estado:** ✅ Ya existe (1.jpg, 2.jpg, 3.jpg)

**Especificaciones:**
- **Formato:** JPG
- **Tamaño:** 32x32px a 64x64px
- **Cantidad:** 3 imágenes (Shinsoo, Chunjo, Jinno)
- **Ubicación:** `/images/empire/1.jpg`, `empire/2.jpg`, `empire/3.jpg`
- **Uso:** Identificar imperio de jugador en rankings

---

## 4. **Iconos de Clases** (`images/job/`)
**Estado:** ✅ Ya existe

**Especificaciones:**
- **Formato:** PNG
- **Tamaño:** 32x32px
- **Cantidad:** 4 imágenes (Guerrero, Ninja, Chamán, Sura)
- **Ubicación:** `/images/job/0.png` a `job/3.png`
- **Uso:** Mostrar clase de personaje

---

## 5. **Imágenes de Página Header** (opcionales)
**Estado:** ❌ Opcionales

### 5a. Imagen para Noticias
- **Formato:** JPG/PNG
- **Tamaño:** 800x400px
- **Ubicación:** `/images/news.png`
- **Descripción:** Pergamino antiguo, papel envejecido con runas
- **Uso:** Background del encabezado de noticias

### 5b. Imagen para Descargas
- **Formato:** JPG/PNG
- **Tamaño:** 800x400px
- **Ubicación:** `/images/download.png`
- **Descripción:** Descarga, cliente, caja de instalación
- **Uso:** Background del encabezado de descargas

### 5c. Imagen para Rankings
- **Formato:** JPG/PNG
- **Tamaño:** 800x400px
- **Ubicación:** `/images/ranking.png`
- **Descripción:** Rankings, trofeos, competencia
- **Uso:** Background del encabezado de rankings

### 5d. Imagen para Cuenta de Usuario
- **Formato:** JPG/PNG
- **Tamaño:** 800x400px
- **Ubicación:** `/images/user.png` (ya existe)
- **Descripción:** Perfil usuario, cuenta, información personal
- **Uso:** Background del encabezado de administración/usuarios

---

## 6. **Decoraciones/Separadores** (opcionales)
**Estado:** ❌ Opcionales

### 6a. Borde o Marco Decorativo
- **Formato:** PNG transparente
- **Tamaño:** Variable (230x50px)
- **Ubicación:** `/images/decorations/border-top.png`
- **Descripción:** Marco dorado/rojo Metin2 para separadores
- **Uso:** Separar secciones

### 6b. Insignia o Cristal Metin2
- **Formato:** PNG transparente
- **Tamaño:** 64x64px
- **Ubicación:** `/images/decorations/crystal.png`
- **Descripción:** Cristal mágico, metin, aura
- **Uso:** Decorar elementos en sidebar

---

## 7. **Favicon** (`images/favicon.ico`)
**Estado:** ✅ Ya existe

**Especificaciones:**
- **Formato:** ICO
- **Tamaño:** 16x16px, 32x32px, 64x64px
- **Descripción:** Pequeño ícono del servidor
- **Ubicación:** `/images/favicon.ico`
- **Uso:** Pestaña del navegador

---

## 📁 Estructura de Carpetas de Imágenes

```
/workspaces/LegacyofStones/images/
├── favicon.ico                    ✅ Existe
├── logo-modern.svg                ✅ Existe (usar en cabecera)
├── news.png                        ❌ Crear (opcional)
├── download.png                    ❌ Crear (opcional)
├── ranking.png                     ❌ Crear (opcional)
├── user.png                        ✅ Existe
├── players.png                     ✅ (referenciado en sidebar)
├── guilds.png                      ✅ (referenciado en sidebar)
├── banner-hero.jpg                 ❌ Crear (opcional, recomendado)
├── empire/
│   ├── 1.jpg (Shinsoo)            ✅ Existe
│   ├── 2.jpg (Chunjo)             ✅ Existe
│   └── 3.jpg (Jinno)              ✅ Existe
├── job/
│   ├── 0.png (Guerrero)           ✅ Existe
│   ├── 1.png (Ninja)              ✅ Existe
│   ├── 2.png (Chamán)             ✅ Existe
│   └── 3.png (Sura)               ✅ Existe
├── site/                           ✅ Existe (carpeta)
└── decorations/                    ❌ Crear (opcional)
    ├── border-top.png             ❌ Crear
    └── crystal.png                ❌ Crear
```

---

## 🎯 Dónde Colocar las Imágenes

### En HTML/CSS:
```html
<!-- Logo -->
<img src="/images/logo-modern.svg" alt="Logo">

<!-- Banner Hero -->
<div style="background-image: url(/images/banner-hero.jpg)"></div>

<!-- Page Headers -->
<div style="background-image: url(/images/news.png)"></div>

<!-- Empire Icons -->
<img src="/images/empire/<?php echo $empire; ?>.jpg">

<!-- Job/Class Icons -->
<img src="/images/job/<?php echo $job; ?>.png">
```

---

## 📸 Fuentes para Obtener Imágenes Metin2:

1. **Recursos Oficiales:**
   - Sitio web oficial de Metin2
   - Launcher del juego
   - Cliente instalado

2. **Comunidad:**
   - Servidores privados existentes
   - Foros de Metin2
   - Repositorios de skins

3. **Creación Personalizada:**
   - Usar Photoshop/GIMP
   - Canva (diseño rápido)
   - Adobe Stock, Unsplash, Pexels (para texturas)

---

## 🛠️ Cómo Integrar las Imágenes en el Sitio:

### Opción 1: Banner Hero en Index.php
Añade esto después de la cabecera:

```php
<!-- Banner Hero -->
<div class="hero-banner" style="background-image: url(<?php print $site_url; ?>images/banner-hero.jpg); background-size: cover; background-position: center; height: 400px; margin: 20px 0; border-radius: 8px; border: 2px solid var(--accent-red);">
    <div style="background: rgba(0,0,0,0.5); height: 100%; display: flex; align-items: center; justify-content: center;">
        <h1 style="color: white; font-size: 3rem; text-shadow: 2px 2px 8px rgba(0,0,0,0.8);">Legacy of Stones</h1>
    </div>
</div>
```

### Opción 2: Decoraciones en Sidebar
Añade esto en `clean.css`:

```css
.widget .bd::before {
    content: '';
    display: block;
    background-image: url('/images/decorations/border-top.png');
    background-repeat: repeat-x;
    height: 30px;
    margin-bottom: 15px;
    background-size: auto 100%;
}
```

---

## ✅ Checklist de Imágenes

- [ ] Logo (✅ Listo)
- [ ] Banner Hero (❌ Por crear/descargar)
- [ ] Iconos Empire (✅ Listos)
- [ ] Iconos Job (✅ Listos)
- [ ] Header Noticias (❌ Opcional)
- [ ] Header Descargas (❌ Opcional)
- [ ] Header Rankings (❌ Opcional)
- [ ] Decoraciones (❌ Opcional)
- [ ] Favicon (✅ Listo)

---

## 📞 Próximos Pasos:

1. **Revisa qué imágenes necesitas** - empezando por el Banner Hero
2. **Descarga o crea las imágenes** con las especificaciones arriba
3. **Sube las imágenes** a la carpeta `/images/` correspondiente
4. **Prueba en localhost** - verifica que se cargan correctamente
5. **Ajusta tamaños/colores** si es necesario

¡Si necesitas ayuda para integrar las imágenes en el sitio, avísame! 🎨
