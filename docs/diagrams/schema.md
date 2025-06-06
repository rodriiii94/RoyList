```mermaid
flowchart LR
  %% =========================================
  %% Diagrama de Componentes Mejorado de RoyList
  %% =========================================

  subgraph Cliente
    Navegador["Navegador Web"]
  end

  subgraph "Servidor Web (Laravel/PHP)"
    direction TB

    subgraph Controladores
      RegisterController["RegisterController"]
      LoginController["LoginController"]
      ListaCompraController["ListaCompraController"]
      ProductoListaController["ProductoListaController"]
      SupermercadoController["SupermercadoController"]
    end

    subgraph Servicios
      AuthServices["AuthServices"]
      EmailVerificacionCustom["EmailVerificacionCustom"]
    end

    subgraph "Modelos (Eloquent)"
      UserModel["User (Eloquent)"]
      SupermercadoModel["Supermercado (Eloquent)"]
      ListaCompraModel["ListaCompra (Eloquent)"]
      ProductoListaModel["ProductoLista (Eloquent)"]
    end

    subgraph "Vistas Blade + Tailwind"
      BladeTemplates["Plantillas Blade + Tailwind"]
    end
  end

  subgraph "Lógica Scraping"
    ScrapingLogic["API"]
    MercadonaWeb["Mercadona (sitio externo)"]
  end

  subgraph "Servidor de Base de Datos (MySQL/InnoDB)"
    MySQL["MySQL (InnoDB)"]
  end

  %% =========================================
  %% Flujo Cliente -> Servidor Web
  %% =========================================
  Navegador -->|Solicita páginas HTML| BladeTemplates

  %% =========================================
  %% Vistas -> Controladores
  %% =========================================
  BladeTemplates -->|POST/GET registro| RegisterController
  BladeTemplates -->|POST/GET login| LoginController
  BladeTemplates -->|GET listas/detalle| ListaCompraController
  BladeTemplates -->|GET productos| ProductoListaController
  BladeTemplates -->|GET supermercados| SupermercadoController

  %% =========================================
  %% Controladores -> Servicios (Autenticación y Notificaciones)
  %% =========================================
  RegisterController   -->|Usa| AuthServices
  LoginController      -->|Usa| AuthServices
  RegisterController   -->|Envía verificación| EmailVerificacionCustom

  %% =========================================
  %% Controladores -> Modelos
  %% =========================================
  RegisterController        -->|Crea/consulta| UserModel
  LoginController           -->|Valida| UserModel
  ListaCompraController     -->|CRUD Listas| ListaCompraModel
  ListaCompraController     -->|Consulta| UserModel
  ListaCompraController     -->|Consulta| SupermercadoModel
  ProductoListaController   -->|CRUD Productos| ProductoListaModel
  ProductoListaController   -->|Consulta Listas| ListaCompraModel
  SupermercadoController    -->|CRUD Supermercados| SupermercadoModel

  %% =========================================
  %% Modelos -> Base de Datos
  %% =========================================
  UserModel           -->|CRUD| MySQL
  SupermercadoModel   -->|CRUD| MySQL
  ListaCompraModel    -->|CRUD| MySQL
  ProductoListaModel  -->|CRUD| MySQL

  %% =========================================
  %% Scraping (ProductoListaController -> MercadonaWeb)
  %% =========================================
  ProductoListaModel -->|Extrae Datos| ScrapingLogic
  ScrapingLogic           -->|HTTP request| MercadonaWeb

  %% =========================================
  %% Componentes de Infraestructura
  %% =========================================
  style Navegador fill:#f0f8ff,stroke:#888,stroke-width:1px
  style Servidor Web Laravel/PHP fill:#f5f5dc,stroke:#888,stroke-width:1px
  style Servidor de Base de Datos MySQL/InnoDB fill:#ffe4e1,stroke:#888,stroke-width:1px
  style MercadonaWeb fill:#fafad2,stroke:#888,stroke-width:1px
```

| Escenario                                                                                 | Entrada                         | Resultado esperado                                                                                                                                                                                                                                                   |
|-------------------------------------------------------------------------------------------|---------------------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **1. Página inicio (index.php)**<br/>En base de datos hay varios muebles<br/>Sesión iniciada como __plopez__ | Usuario hace click en **Productos** | Se carga `listado.php` mostrando una tabla con los muebles: <br/> - Mesa TV / 35,00€<br/> - Mesa de centro / 40,00€<br/> - Mesa auxiliar / 20,00€<br/> - Mesa comedor plegable / 50,00€<br/>Y el menú con: Principal, Productos, Disponibilidad de piezas y Cerrar Sesión |
| **2. Página inicio (index.php)**<br/>Sin sesión iniciada                                  | Usuario hace click en **Productos** | Se redirige a `login.php` con mensaje: “Debe iniciar sesión para acceder a Productos”.                                                                                                                                                                               |
| **3. listado.php**<br/>Sesión iniciada como __plopez__                                    | Usuario hace click en **Disponibilidad de piezas** | Se carga `disponibilidad.php` mostrando la lista de piezas disponibles para cada mueble (ID, nombre, stock).                                                                                                                                                           |
| **4. disponibilidad.php**<br/>Sesión iniciada como __plopez__                              | Usuario hace click en **Cerrar Sesión** | Se destruye la sesión y redirige a `index.php` con mensaje: “Sesión cerrada correctamente”.                                                                                                                                                                            |
| **5. URL protegida (`disponibilidad.php`)**<br/>Sin sesión iniciada                       | Usuario accede directamente vía URL | Se redirige a `login.php` con mensaje: “Acceso denegado. Inicie sesión para continuar.”                                                                                                                                                                              |

