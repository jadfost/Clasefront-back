
const urlApi = "http://localhost/clase/Clasefront-back/app_ejemplo_php/editoriales";
let listaEditoriales = [];
let idEditorial = 0;
let editorial = null;

function editorialesApi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            listaEditoriales = response.data;
            asignarDatosTablaHtml();
        }
    };
    xhttp.open("GET", urlApi, true);
    xhttp.send();
}
editorialesApi();

function asignarDatosTablaHtml() {
    let html = '';
    for (let item of listaEditoriales) {
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
            editorial = response.data;
        }
    };
    xhttp.open("GET", urlApi + '/' + idEditorial, false);
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
            editorialesApi();
            onClickCancelar();
        }
    };
    let param = idEditorial > 0 ? '/' + idEditorial : '';
    let metodo = idEditorial > 0 ? 'PUT' : 'POST';
    xhttp.open(metodo, urlApi + param, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(data);
}

function crear() {
    idEditorial = 0;
    editorial = null;
    const elementTitulo = document.getElementById('controlForm').getElementsByTagName('h2')[0];
    elementTitulo.innerText = 'Registrar datos editorial';
    document.getElementById('nombre').value = '';
    document.getElementsByClassName('popupControll')[0].classList.remove('popupControll-cerrar');
}

function modificar(id) {
    console.log(id);
    idEditorial = id;
    editorial = null;
    const elementTitulo = document.getElementById('controlForm').getElementsByTagName('h2')[0];
    elementTitulo.innerText = 'Modificar datos editorial';
    datailApi();
    if (editorial != null) {
        document.getElementById('nombre').value = editorial.nombre;
        document.getElementsByClassName('popupControll')[0].classList.remove('popupControll-cerrar');
    }
}

function eliminar(id) {
    console.log(id);
    idEditorial = id;
    document.getElementsByClassName('popupControll')[2].classList.remove('popupControll-cerrar');
}

function onClickSi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            idEditorial = 0;
            editorial = null;
            editorialesApi();
            document.getElementsByClassName('popupControll')[2].classList.add('popupControll-cerrar');
        }
    };
    xhttp.open("DELETE", urlApi + '/' + idEditorial, false);
    xhttp.send();
}

function onClickNo() {
    document.getElementsByClassName('popupControll')[2].classList.add('popupControll-cerrar');
}

function ver(id) {
    console.log(id);
    idEditorial = id;
    editorial = null;
    datailApi();
    if (editorial != null) {
        document.getElementById('nombreLb').innerText = editorial.nombre;
        document.getElementsByClassName('popupControll')[1].classList.remove('popupControll-cerrar');
    }
}

function onClickCancelar() {
    document.getElementsByClassName('popupControll')[0].classList.add('popupControll-cerrar');
}

function onClickCerrar() {
    document.getElementsByClassName('popupControll')[1].classList.add('popupControll-cerrar');
}


