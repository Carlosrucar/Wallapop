# Aplicación Wallapop

## Realizado por Carlos Rodríguez Ruiz

## Descripción
Esta aplicación es un clon de Wallapop, un popular mercado para comprar y vender artículos de segunda mano. Permite a los usuarios publicar artículos en venta, navegar por los listados y comunicarse con los vendedores.

## Características
- Autenticación y autorización de usuarios
- Crear, leer, actualizar y eliminar listados
- Buscar y filtrar listados
- Perfiles de usuario
- Sistema de mensajería

## Instalación
1. Clona el repositorio:
    ```bash
    git clone https://github.com/yourusername/wallapop-clone.git
    ```
2. Navega al directorio del proyecto:
    ```bash
    cd wallapop-clone
    ```
3. Instala las dependencias:
    ```bash
    composer install
    npm install
    ```
4. Configura las variables de entorno:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
5. Ejecuta las migraciones:
    ```bash
    php artisan migrate
    ```
6. Pobla la base de datos:
    ```bash
    php artisan db:seed
    ```
7. Inicia el servidor de desarrollo:
    ```bash
    php artisan serve
    ```

## Uso
1. Registra un nuevo usuario o inicia sesión con una cuenta existente.
2. Crea un nuevo listado haciendo clic en el botón "Publicar un artículo".
3. Navega por los listados por categoría o usa la barra de búsqueda para encontrar artículos específicos.
4. Haz clic en un listado para ver los detalles y contactar al vendedor.

## Capturas de Pantalla
### Página Principal
![Página Principal](/img/paginaprincipal.png)

### Página de Listado
![Página de Listado](/img/listado.png)

### Crear Listado
![Filtrado](/img/filtrado.png)

### Perfil de Usuario
![Perfil de Usuario](/img/Cuenta.png)


## Licencia
Este proyecto está licenciado bajo la Licencia MIT.
