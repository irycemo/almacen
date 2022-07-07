<x-app-layout>

    <div class="relative min-h-screen md:flex">

        {{-- Sidebar --}}
        <div id="sidebar" class="z-50 bg-white w-64 absolute inset-y-0 left-0 transform -translate-x-full transition duration-200 ease-in-out md:relative md:translate-x-0">

            {{-- Header --}}
            <div class="w-100 flex-none bg-white border-b-2 border-b-grey-200 flex flex-row p-5 pr-0 justify-between items-center h-20 ">

                {{-- Logo --}}
                <a href="/" class="mx-auto">

                    <img class="h-16" src="{{ asset('storage/img/logo2.png') }}" alt="Logo">

                </a>

                {{-- Side Menu hide button --}}
                <button  type="button" title="Cerrar Menú" id="sidebar-menu-button" class="md:hidden mr-2 inline-flex items-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">

                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>

            </div>

            {{-- Nav --}}
            <nav class="p-4 text-rojo">

                <a href="#usuarios" class="mb-3 capitalize font-medium text-md transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                        </svg>

                    Usuarios
                </a>

                <a href="#categorias" class="mb-3 capitalize font-medium text-md transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>

                    Categorías
                </a>

                <a href="#articulos" class="mb-3 capitalize font-medium text-md transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>

                    Artículos

                </a>

                <a href="#entradas" class="mb-3 capitalize font-medium text-md  transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20" />
                      </svg>

                    Entradas
                </a>

                <a href="#solicitudes" class="mb-3 capitalize font-medium text-md  transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>

                    Solicitudes
                </a>

                <a href="#seguimiento" class="mb-3 capitalize font-medium text-md  transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                      </svg>

                    Seguimiento
                </a>

                <a href="#reportes" class="mb-3 capitalize font-medium text-md  transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                    </svg>

                    Reportes
                </a>

            </nav>

        </div>

        <div class="flex-1 flex-col flex max-h-screen overflow-x-auto min-h-screen">

            <div class="w-100 bg-white border-b-2 border-b-grey-200 flex-none flex flex-row p-5 justify-between items-center h-20">

                <!-- Mobile menu button-->
                <div class="flex items-center">

                    <button  type="button" title="Abrir Menú" id="mobile-menu-button" class="md:hidden inline-flex items-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">

                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>

                    </button>

                </div>

                {{-- Logo --}}
                <p class="font-semibold text-2xl text-rojo">Manual de Usuario</p>

                <div></div>

            </div>

            <div class="bg-white flex-1 overflow-y-auto py-8 md:border-l-2 border-l-grey-200">

                <div class="lg:w-2/3 mx-auto rounded-xl">

                    <div class="capitulo mb-10" id="introduccion">

                        <p class="text-2xl font-semibold text-rojo mb-5">Introducción</p>

                        <div class="  px-3">

                            <p class="mb-2">El Sistema de Almacén, tiene como propósito administrar las existencias de los productos del Instituto Registral y Catastral de Michoacán de Ocampo,
                                 la administración de las solicitudes de material y el análisis de la información mediante reportes.
                            </p>

                        </div>

                    </div>

                    <div class="capitulo mb-10" id="usuarios">

                        <p class="text-2xl font-semibold text-rojo mb-5">Usuarios</p>

                        <div class="  px-3">

                            <p class="mb-2">
                                La sección de usuarios lleva el control del registro de los usuarios del sistema. Los usuarios estan clasificados por roles (Almacenista, Jefe(a) de Departamento, Contador(a), Delegado(a) Administrativo)
                                cada uno con atribuciones distintas. Solo los usuarios con rol de Delegado(a) Administrativo pueden agregar nuevos usuarios y editarlos.
                            </p>

                            <p>
                                <strong>Busqueda de usuario:</strong>
                                puede hacer busqueda de usuarios por cualquiera de las columnas que muestra la tabla.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/usuarios_buscar.jpg') }}" alt="Imágen buscar">

                            <p>
                                <strong>Agregar nuevo usuario:</strong>
                                puede agregar un nuevo usuario haciendo click el el botón "Agregar nuevo usuario" esta acción deplegará una ventana modal
                                en la cual se ingresará la información necesaria para el registro. Al hacer click en el botón "Guardar" se generará el registro con los datos
                                proporcionados. Al hacer click en cerrar se cerrará la ventana modal borrando la información proporcionada.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/usuarios_modal_crear.jpg') }}" alt="Imágen crear">

                            <p>
                                <strong>Editar usuario:</strong>
                                cada usuario tiene asociado dos botones de acciones, puede editar un usuario haciendo click el el botón "Editar" esta acción deplegará una ventana modal
                                en la cual se mostrará la información del usuario para actualizar.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/usuarios_editar.jpg') }}" alt="Imágen buscar">

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/usuarios_modal_editar.jpg') }}" alt="Imágen editar">

                            <p>
                                <strong>Borrar usuario:</strong>
                                puede borrar un usuario haciendo click el el botón "Borrar" esta acción deplegará una ventana modal
                                en la cual se mostrará una advertencia, dando la opcion de cancelar o borrar la información.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/usuarios_borrar.jpg') }}" alt="Imágen borrar">

                            <p>
                                Al crear un usuario, su credenciales para iniciar sesión seran su correo y la contraseña "sistema", al tratar de iniciar sesión le pedira actualizar su contraseña.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/actualizar_contraseña.jpg') }}" alt="Imágen contraseña">

                            <p>
                                Puede revisar su perfil de usuario haciendo click en el circulo superior izquierdo en la opción "Mi perfil"
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/perfil.jpg') }}" alt="Imágen perfil">

                        </div>

                    </div>

                    <div class="capitulo mb-10" id="categorias">

                        <p class="text-2xl font-semibold text-rojo mb-5">Categorías</p>

                        <div class="  px-3">

                            <p class="mb-2">
                                La sección de categorías lleva el control del registro de las categorías que son necesarias para distiguir los productos del almacén.
                            </p>

                            <p>
                                <strong>Busqueda de categoría:</strong>
                                puede hacer busqueda de categprías por cualquiera de las columnas que muestra la tabla.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/categorias_buscar.jpg') }}" alt="Imágen buscar">

                            <p>
                                <strong>Agregar nueva categoría:</strong>
                                puede agregar una nueva categoría haciendo click el el botón "Agregar nueva Categoría" esta acción deplegará una ventana modal
                                en la cual se ingresará la información necesaria para el registro. Al hacer click en el botón "Guardar" se generará el registro con los datos
                                proporcionados. Al hacer click en cerrar se cerrará la ventana modal borrando la información proporcionada.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/categorias_modal_crear.jpg') }}" alt="Imágen modal crear">

                            <p>
                                <strong>Editar categoría:</strong>
                                cada categoría tiene asociado dos botones de acciones, puede editar una dependencia haciendo click el el botón "Editar" esta acción deplegará una ventana modal
                                en la cual se mostrará la información de la categoría para actualizar.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/categorias_editar.jpg') }}" alt="Imágen editar">

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/categorias_modal_editar.jpg') }}" alt="Imágen editar modal">

                            <p>
                                <strong>Borrar categoría:</strong>
                                puede borrar una categoría haciendo click el el botón "Borrar" esta acción deplegará una ventana modal
                                en la cual se mostrará una advertencia, dando la opcion de cancelar o borrar la información.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/categorias_borrar.jpg') }}" alt="Imágen borrar">

                        </div>

                    </div>

                    <div class="capitulo mb-10" id="articulos">

                        <p class="text-2xl font-semibold text-rojo mb-5">Artículos</p>

                        <div class="  px-3">

                            <p class="mb-2">
                                La sección de artículos lleva el control del registro de los artículos. Estos estan segmentados por su ubicación ya sea Catastro o RPP.
                            </p>

                            <p>
                                <strong>Busqueda de artículos:</strong>
                                puede hacer busqueda de artículos por cualquiera de las columnas que muestra la tabla.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/articulos_buscar.jpg') }}" alt="Imágen buscar">

                            <p>
                                <strong>Agregar nuevo artículo:</strong>
                                puede agregar un nuevo artículo haciendo click el el botón "Agregar nueva Artículo" esta acción deplegará una ventana modal
                                en la cual se ingresará la información necesaria para el registro. Al hacer click en el botón "Guardar" se generará el registro con los datos
                                proporcionados. Al hacer click en cerrar se cerrará la ventana modal borrando la información proporcionada.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/articulos_modal_crear.jpg') }}" alt="Imágen modal crear">

                            <p>
                                <strong>Editar artículo:</strong>
                                cada artículo tiene asociado dos botones de acciones, puede editar una entrada haciendo click el el botón "Editar" esta acción deplegará una ventana modal
                                en la cual se mostrará la información de la entrada para actualizar.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/articulos_editar.jpg') }}" alt="Imágen editar">

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/articulos_modal_editar.jpg') }}" alt="Imágen editar modal">

                            <p>
                                <strong>Borrar artículo:</strong>
                                puede borrar una artículo haciendo click el el botón "Borrar" esta acción deplegará una ventana modal
                                en la cual se mostrará una advertencia, dando la opcion de cancelar o borrar la información.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/articulos_borrar.jpg') }}" alt="Imágen borrar">

                        </div>

                    </div>

                    <div class="capitulo mb-10" id="entradas">

                        <p class="text-2xl font-semibold text-rojo mb-5">Entradas</p>

                        <div class="  px-3">

                            <p class="mb-2">
                                La sección de entradas lleva el control del registro de las entradas. Una entrada representa y justifica la existencia de un producto en el almacén, esta puede
                                ser por Compra o Donación.
                            </p>

                            <p>
                                <strong>Busqueda de entradas:</strong>
                                puede hacer busqueda de entradas por cualquiera de las columnas que muestra la tabla.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/entradas_buscar.jpg') }}" alt="Imágen buscar">

                            <p>
                                <strong>Agregar nueva entrada:</strong>
                                puede agregar una nueva entrada haciendo click el el botón "Agregar nueva Entrada" esta acción deplegará una ventana modal
                                en la cual se ingresará la información necesaria para el registro. Al hacer click en el botón "Guardar" se generará el registro con los datos
                                proporcionados. Al hacer click en cerrar se cerrará la ventana modal borrando la información proporcionada.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/entradas_modal_crear.jpg') }}" alt="Imágen modal crear">

                            <p class="mb-2">
                                El primer paso para ingresar una entrada es buscar el artículo y seleccionarlo.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/articulos_modal_crear_buscar_articulo.jpg') }}" alt="Imágen modal crear">

                            <p class="mb-2">
                                Si el artículo seleccionado no tine Número de Serie el formulario le pedira que ingrese la cantidad que se esta ingresando.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/articulos_modal_crear_buscar_articulo_2.jpg') }}" alt="Imágen modal crear">

                            <p class="mb-2">
                                Si el artículo seleccionado tine Número de Serie el formulario no le pedira que ingrese la cantidad que se esta ingresando ya que solo puede haber un artículo con un número de serie.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/articulos_modal_crear_buscar_articulo_3.jpg') }}" alt="Imágen modal crear">

                            <p class="mb-2">
                                Al seleccionar el artículo, se debe seleccionar el origen de entrada e ingresar su descripción la cual puede incluir el número de factura con la que se hizo
                                la compra ó la descripción de la doación.
                            </p>

                            <p class="mb-2">
                                Al guardar la entrada automáticamente el artículo seleccionado cambiara su Stock.
                            </p>

                            <p>
                                <strong>Editar entrada:</strong>
                                cada entrada tiene asociado dos botones de acciones, puede editar una entrada haciendo click el el botón "Editar" esta acción deplegará una ventana modal
                                en la cual se mostrará la información del seguimiento para actualizar.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/entradas_editar.jpg') }}" alt="Imágen editar">

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/entradas_modal_editar.jpg') }}" alt="Imágen editar modal">

                            <p>
                                <strong>Borrar entrada:</strong>
                                puede borrar una entrada haciendo click el el botón "Borrar" esta acción deplegará una ventana modal
                                en la cual se mostrará una advertencia, dando la opcion de cancelar o borrar la información.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/entradas_borrar.jpg') }}" alt="Imágen borrar">

                        </div>

                    </div>

                    <div class="capitulo mb-10" id="solicitudes">

                        <p class="text-2xl font-semibold text-rojo mb-5">Solicitudes</p>

                        <div class="  px-3">

                            <p class="mb-2">
                                La sección de solicitudes lleva el control del registro de las solicitudes. Las solicitudes son hechas por los jefes de departamentos, las cuales se clasifican
                                por su "Estado" el cual puede ser:

                                <ul class="px-4 list-disc mb-4">
                                    <li>Solicitada: Representa una solicitud nueva.</li>
                                    <li>Aceptada: La solicitud es aceptada despues de que ha sido revisada.</li>
                                    <li>Rechazada: La solicitud es rechazada anexandosele el motivo.</li>
                                    <li>Entregada: La solicitud es entregada al solicitante.</li>
                                </ul>

                            </p>

                            <p>
                                <strong>Busqueda de solicitud:</strong>
                                puede hacer busqueda de solicitudes por cualquiera de las columnas que muestra la tabla.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/solicitudes_buscar.jpg') }}" alt="Imágen buscar">

                            <p>
                                <strong>Agregar nueva solicitud:</strong>
                                puede agregar una nueva solicitud haciendo click el el botón "Agregar nueva Solicitud" esta acción lo redireccionará la página de "Crear Solicitud"
                                en la cual se ingresará la información necesaria para el registro.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/solicitudes_crear.jpg') }}" alt="Imágen modal crear">

                            <p class="mb-4">
                                Para agregar artículos a la nueva solicitud es necesario indicar la cantidad requerida y hacer click el el boton azúl con el simbolo de "+", esto automáticamente
                                generará una nueva solicitud y descontara el "Stock" del artículo en cuestión.
                            </p>

                            <p class="mb-4">
                                Puede remover los artículos solicitados haciendo click en el boton rojo adyacente. Puede anexar un comentario a la solicitud de ser necesario. Si ha terminado de
                                solicitar artículos hacer click en el boton "Actualizar solicitud".
                            </p>

                            <p>
                                <strong>Ver solicitud:</strong>
                                cada solicitud tiene asociado tres botones de acciones, puede ver una solicitud haciendo click el el botón "Ver" esta acción deplegará una ventana modal
                                en la cual se mostrará la información de la solicitud.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/solicitudes_editar_boton.jpg') }}" alt="Imágen editar">

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/solicitudes_ver.jpg') }}" alt="Imágen ver">

                            <p class="mb-4">
                                La ventana modal "Detalles de la solicitud" muestra los datos de la solicitud y el listado de los artículos que contiene. La disponibilidad de cada artículo es mostrada para su
                                consideración al momento de aceptar, entregar o rechazar la solicitud. Al momento de hacer click en "Entregar" se abrira una nueva ventana mostrando un recibo de
                                entrega en PDF.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/solicitudes_pdf.jpg') }}" alt="Imágen PDF">

                            <p class="mb-4">
                                Al rechazar una solicitud el "Stock" de cada artículo en la solicitud se reestablecerá a su estado antes de ser solicitado.
                            </p>

                            <p>
                                <strong>Editar solicitud:</strong>
                                cada solicitud tiene asociado tres botones de acciones, puede editar una solicitud haciendo click el el botón "Editar" esta acción lo redireccionará la página de "Editar Solicitud"
                                en la cual se mostrará la información de la solicitud para actualizar.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/solicitudes_editar_boton.jpg') }}" alt="Imágen editar">

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/solicitudes_editar.jpg') }}" alt="Imágen editar modal">

                            <p class="mb-4">
                                Para agregar artículos a la solicitud es necesario indicar la cantidad requerida y hacer click el el boton azúl con el simbolo de "+", esto automáticamente
                                descontará el "Stock" del artículo en cuestión.
                            </p>

                            <p class="mb-4">
                                Puede remover los artículos solicitados haciendo click en el boton rojo adyacente. Puede editar el comentario a la solicitud de ser necesario. Si ha terminado de
                                solicitar artículos hacer click en el boton "Actualizar solicitud".
                            </p>

                            <p>
                                <strong>Borrar solicitud:</strong>
                                puede borrar una solicitud haciendo click el el botón "Borrar" esta acción deplegará una ventana modal
                                en la cual se mostrará una advertencia, dando la opcion de cancelar o borrar la información.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/solicitudes_borrar.jpg') }}" alt="Imágen borrar">

                            <p class="mb-4">
                                Al eliminar una solicitud el "Stock" de cada artículo de la solicitud se reestablecerá a su estado antes de ser solicitado.
                            </p>

                        </div>

                    </div>

                    <div class="capitulo mb-10" id="seguimiento">

                        <p class="text-2xl font-semibold text-rojo mb-5">Seguimiento</p>

                        <div class="  px-3">

                            <p class="mb-2">
                                La sección de seguimiento permite consultar todos los registros relacionados a algún artículo.
                            </p>

                            <p>
                                <strong>Busqueda de artículos:</strong>
                                puede hacer busqueda del artículo por nombre, marca ó número de serie.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/seguimiento_buscar.jpg') }}" alt="Imágen buscar">

                            <p>
                                Al seleccionar una artículo se mostrará la información del artículo, las entradas y solicitudes con las que se relaciona.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/seguimiento_detalles.jpg') }}" alt="Imágen modal crear">

                        </div>

                    </div>

                    <div class="capitulo mb-10" id="reportes">

                        <p class="text-2xl font-semibold text-rojo mb-5">Reportes</p>

                        <div class="  px-3">

                            <p class="mb-2">
                                La sección de reportes permite elaborar archivos de Excel con información de las áreas: entradas, artículos y solicitudes.
                            </p>

                            <p>
                                <strong>Generar reportes:</strong>
                                para generar un reportes es necesario seleccionar el área de interes y el intervalo de tiempo
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/reportes_buscar.jpg') }}" alt="Imágen buscar">

                            <p>
                                Cada área tiene campos de filtrado de datos para hacer consultas.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/reportes_entradas.jpg') }}" alt="Imágen modal crear">

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/reportes_articulos.jpg') }}" alt="Imágen modal crear">

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/reportes_solicitudes.jpg') }}" alt="Imágen modal crear">

                            <p>
                                Una vez ingresados los criterios de busqueda al hacer click en el boton "Filtrar", se mostraran los resultados de la busqueda.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/reportes_busqueda.jpg') }}" alt="Imágen modal crear">

                            <p>
                                Al hacer click en el boton "Exportar a Excel", automaticamente se generara un archivo Excel en e lcual estara una tabla con los resultados
                                de la busqueda.
                            </p>

                            <img class="mb-4 mt-4 rounded mx-auto" src="{{ asset('storage/img/manual/reportes_excel.jpg') }}" alt="Imágen modal crear">

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>

        const btn_close = document.getElementById('sidebar-menu-button');
        const btn_open = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');

        btn_open.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        btn_close.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        /* Change nav profile image */
        window.addEventListener('nav-profile-img', event => {

            document.getElementById('nav-profile').setAttribute('src', event.detail.img);

        });

    </script>

</x-app-layout>
