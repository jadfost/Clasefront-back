
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
        html += '    <td>';
        html += '        <div class="contentButtons">';
        html += '           <button class="contentButtons__button contentButtons__button-verde" onclick="ver(' + item.id + ')">Ver detalle</button>';
        html += '           <button class="contentButtons__button contentButtons__button-azul" onclick="modificar(' + item.id + ')">Modificar</button>';
        html += '           <button class="contentButtons__button contentButtons__button-rojo" onclick="eliminar(' + item.id + ')">Eliminar</button>';
        html += '        <div>';
        // html += '        <div class="contentButtons">';
        // html += '           <button class="button verde" onclick="ver(' + item.id + ')">Ver detalle</button>';
        // html += '           <button class="button azul" onclick="modificar(' + item.id + ')">Modificar</button>';
        // html += '           <button class="button rojo" onclick="eliminar(' + item.id + ')">Eliminar</button>';
        // html += '        <div>';
        html += '    </td>';
        html += '</tr>';
    }
    if (html == '') {
        html += '<tr>';
        html += '    <td class="3">No hay datos registrados</td>';
        html += '</tr>';
    }
    const element = document.getElementById('listaLibros').getElementsByTagName('tbody')[0];
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
    let data = '&nombre=' + document.getElementById('nombre').value;
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
    document.getElementById('nombre').value = '';
    document.getElementsByClassName('popupControll')[0].classList.remove('popupControll-cerrar');
}

function modificar(id) {
    console.log(id);
    idLibro = id;
    libro = null;
    const elementTitulo = document.getElementById('controlForm').getElementsByTagName('h2')[0];
    elementTitulo.innerText = 'Modificar datos libro';
    datailApi();
    if (libro != null) {
        document.getElementById('nombre').value = libro.nombre;
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
    if (libro != null) {
        document.getElementById('nombreLb').innerText = libro.nombre;
        document.getElementsByClassName('popupControll')[1].classList.remove('popupControll-cerrar');
    }
}

function onClickCancelar() {
    document.getElementsByClassName('popupControll')[0].classList.add('popupControll-cerrar');
}

function onClickCerrar() {
    document.getElementsByClassName('popupControll')[1].classList.add('popupControll-cerrar');
}


