
const urlApi = "http://localhost/clase/Clasefront-back/app_ejemplo_php/libros";
let listaLibros = [];
let idLibro = 0;
let libro = null;

function librosApi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            listaLibros = response.data;
            asignarDatosTablaHtml();
        }
    };
    xhttp.open("GET", urlApi, true);
    xhttp.send();
}
librosApi();

function asignarDatosTablaHtml() {
    let html = '';
    for (let item of listaLibros) {
        console.log(item);
        html += '<tr>';
        html += '    <td>' + item.nombre + '</td>';
        html += '    <td>' + item.descripcion + '</td>';
        html += '    <td>' + item.fecha_publicacion + '</td>';
        html += '    <td>' + item.edicion + '</td>';
        html += '    <td>' + item.editorial_id + '</td>';
        html += '    <td>';
        html += '        <div class="contentButtons">';
        html += '           <button class="contentButtons__button contentButtons__button-verde" onclick="ver(' + item.id + ')">Ver detalle</button>';
        html += '           <button class="contentButtons__button contentButtons__button-azul" onclick="modificar(' + item.id + ')">Modificar</button>';
        html += '           <button class="contentButtons__button contentButtons__button-rojo" onclick="eliminar(' + item.id + ')">Eliminar</button>';
        html += '        <div>';
        html += '    </td>';
        html += '</tr>';
    }
    if (html == '') {
        html += '<tr>';
        html += '    <td class="3">No hay datos registrados</td>';
        html += '</tr>';
    }
    const element = document.getElementById('listaAutores').getElementsByTagName('tbody')[0];
    element.innerHTML = html;
}

function datailApi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            libro = response.data;
        }
    };
    xhttp.open("GET", urlApi + '/' + idLibro, false);
    xhttp.send();
}


function saveDataForm(event) {
    event.preventDefault();
    let data = 'nombre=' + document.getElementById('nombres').value;
    data += '&descripcion=' + document.getElementById('Descripcions').value;
    data += '&fecha_publicacion=' + document.getElementById('fecha_publicacions').value;
    data += '&edicion=' + document.getElementById('edicions').value;
    data += '&editorial_id=' + document.getElementById('editorial_ids').value;
    save(data);
}

function save(data) {
    let reponse = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            reponse = JSON.parse(this.response);
            console.log(reponse);
            librosApi();
            onClickCancelar();
        }
    };
    let param = idLibro > 0 ? '/' + idLibro : '';
    let metodo = idLibro > 0 ? 'PUT' : 'POST';
    xhttp.open(metodo, urlApi + param, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(data);
}

function crear() {
    idLibro = 0;
    libro = null;
    const elementTitulo = document.getElementById('controlForm').getElementsByTagName('h2')[0];
    elementTitulo.innerText = 'Registrar datos libro';
    document.getElementById('nombres').value = '';
    document.getElementById('Descripcions').value = '';
    document.getElementById('fecha_publicacions').value = '';
    document.getElementById('edicions').value = '';
    document.getElementById('editorial_ids').value = '';
    document.getElementsByClassName('popupControll')[0].classList.remove('popupControll-cerrar');
}

function modificar(id) {
    console.log(id);
    idLibro = id;
    libro = null;
    const elementTitulo = document.getElementById('controlForm').getElementsByTagName('h2')[0];
    elementTitulo.innerText = 'Modificar datos libro';
    datailApi();
    console.log(libro.edicion);
    if (libro != null) {
        document.getElementById('nombres').value = libro.nombre;
        document.getElementById('Descripcions').value = libro.descripcion;
        document.getElementById('fecha_publicacions').value = libro.fecha_publicacion;
        document.getElementById('edicions').value = libro.edicion;
        document.getElementById('editorial_ids').value = libro.editorial_id;
        document.getElementsByClassName('popupControll')[0].classList.remove('popupControll-cerrar');
    }
}

function eliminar(id) {
    console.log(id);
    idLibro = id;
    document.getElementsByClassName('popupControll')[2].classList.remove('popupControll-cerrar');
}

function onClickSi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            idLibro = 0;
            libro = null;
            librosApi();
            document.getElementsByClassName('popupControll')[2].classList.add('popupControll-cerrar');
        }
    };
    xhttp.open("DELETE", urlApi + '/' + idLibro, false);
    xhttp.send();
}

function onClickNo() {
    document.getElementsByClassName('popupControll')[2].classList.add('popupControll-cerrar');
}

function ver(id) {
    console.log(id);
    idLibro = id;
    libro = null;
    datailApi();
    console.log(libro.descripcion);

    if (libro != null) {
        document.getElementById('nombreLb').innerText = libro.nombre;
        document.getElementById('descripcionLb').innerText = libro.descripcion;
        document.getElementById('fecha_publicacionLb').innerText = libro.fecha_publicacion;
        document.getElementById('edicionLb').innerText = libro.edicion;
        document.getElementById('editorial_idLb').innerText = libro.editorial_id;
        document.getElementsByClassName('popupControll')[1].classList.remove('popupControll-cerrar');
    }
}

function onClickCancelar() {
    document.getElementsByClassName('popupControll')[0].classList.add('popupControll-cerrar');
}

function onClickCerrar() {
    document.getElementsByClassName('popupControll')[1].classList.add('popupControll-cerrar');
}


